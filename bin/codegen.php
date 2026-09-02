<?php

declare(strict_types=1);

/**
 * Maintainer tool: regenerates the strongly-typed service clients and model
 * classes under the versioned service directories in `src/`.
 *
 * The generator reads upstream schema files that describe each Zenlayer Cloud
 * OpenAPI Action (one file per service) and emits one PHP class per Request,
 * Response, and nested Params/Info type. The generated tree is committed to
 * version control — package consumers never need to run this script.
 *
 *     composer codegen -- /path/to/zenlayercloud-sdk-go/zenlayercloud
 *     ZENLAYER_SCHEMA_SRC=/path/to/zenlayercloud-sdk-go/zenlayercloud composer codegen
 *
 * The expected schema is a typed-struct DSL where each field declaration has
 * the form `FieldName <Type> \`json:"jsonName,omitempty"\``. Supported types:
 *
 *   *string                  -> ?string
 *   *int, *int32, *int64     -> ?int
 *   *bool                    -> ?bool
 *   *float32, *float64       -> ?float
 *   *Xxx                     -> ?Xxx (nested AbstractModel)
 *   []string, []int, ...     -> ?array of runtime-validated scalars
 *   []*Xxx / []Xxx           -> ?array of Xxx (added to $_typeMap)
 *   embeds of base types     -> (ignored)
 *   Response struct {...}    -> auto-promoted to `{Wrapper}Params` class
 */
const ROOT = __DIR__.'/..';

/**
 * @phpstan-type FieldInfo array{name:string,jsonName:string,goType:string,doc:?string}
 * @phpstan-type StructInfo array{name:string,fields:list<FieldInfo>,doc:?string}
 * @phpstan-type ActionInfo array{action:string,requestType:string,responseType:string,doc:?string}
 */
final class SchemaParser
{
    public string $serviceName = '';

    public string $apiVersion = '';

    /** @var array<string,StructInfo> */
    public array $structs = [];

    /** @var list<ActionInfo> */
    public array $actions = [];

    public function __construct(
        public readonly string $modelsSrcPath,
        public readonly string $clientSrcPath,
    ) {}

    public function parse(): void
    {
        $modelsSource = file_get_contents($this->modelsSrcPath);
        $clientSource = file_get_contents($this->clientSrcPath);

        if ($modelsSource === false || $clientSource === false) {
            throw new RuntimeException('Unable to read one or more upstream schema files.');
        }

        $this->parseModels($modelsSource);
        $this->parseClient($clientSource);
        $this->validate();
    }

    private function validate(): void
    {
        if ($this->structs === [] || $this->actions === []) {
            throw new RuntimeException('Upstream schema contained no model structs or Action methods.');
        }

        $seenActions = [];
        foreach ($this->actions as $action) {
            if (isset($seenActions[$action['action']])) {
                throw new RuntimeException("Duplicate Action [{$action['action']}] in upstream client.");
            }
            $seenActions[$action['action']] = true;

            foreach (['requestType', 'responseType'] as $typeKey) {
                $type = $action[$typeKey];
                if (! isset($this->structs[$type])) {
                    throw new RuntimeException("Action [{$action['action']}] references missing model [{$type}].");
                }
            }
        }

        foreach ($this->structs as $struct) {
            $seenFields = [];
            foreach ($struct['fields'] as $field) {
                if (preg_match('/^[A-Za-z_][A-Za-z0-9_]*$/', $field['name']) !== 1 || $field['name'] === 'this') {
                    throw new RuntimeException("Model [{$struct['name']}] has unsupported JSON field name [{$field['name']}].");
                }
                if (isset($seenFields[$field['name']])) {
                    throw new RuntimeException("Model [{$struct['name']}] contains duplicate JSON field [{$field['name']}].");
                }
                $seenFields[$field['name']] = true;
            }
        }
    }

    /**
     * Iterate top-level `type {Name} struct { ... }` blocks. We rely on the fact
     * that the upstream schema uses zero-indent for top-level type
     * declarations and the matching closing brace is also at column zero.
     */
    private function parseModels(string $source): void
    {
        $lines = explode("\n", $source);
        $i = 0;
        $n = count($lines);

        while ($i < $n) {
            $line = $lines[$i];
            if (preg_match('/^type\s+([A-Z][A-Za-z0-9_]*)\s+struct\s*\{/', $line, $m)) {
                $structName = $m[1];

                // Grab struct-doc: contiguous comment block immediately above the line
                $doc = $this->collectDocAbove($lines, $i);

                // Find matching closing brace at column 0
                $bodyLines = [];
                $i++;
                while ($i < $n && rtrim($lines[$i]) !== '}') {
                    $bodyLines[] = $lines[$i];
                    $i++;
                }

                $fields = $this->parseFieldBlock($bodyLines, $structName);
                if (isset($this->structs[$structName])) {
                    throw new RuntimeException("Duplicate model struct [{$structName}] in upstream schema.");
                }
                $this->structs[$structName] = [
                    'name' => $structName,
                    'doc' => $doc,
                    'fields' => $fields,
                ];
            }
            $i++;
        }
    }

    /**
     * @param  list<string>  $bodyLines
     * @return list<FieldInfo>
     */
    private function parseFieldBlock(array $bodyLines, string $parentStruct): array
    {
        $fields = [];
        $pending = [];     // accumulator for comments preceding a field
        $count = count($bodyLines);

        for ($idx = 0; $idx < $count; $idx++) {
            $raw = $bodyLines[$idx];
            $line = trim($raw);

            // Embed (skip): "*common.BaseRequest" / "*common.BaseResponse"
            if (preg_match('/^\*common\.Base(Request|Response)$/', $line)) {
                $pending = [];

                continue;
            }
            // Comment line — accumulate
            if (str_starts_with($line, '//')) {
                $pending[] = ltrim(substr($line, 2));

                continue;
            }
            // Blank line — drop pending
            if ($line === '') {
                $pending = [];

                continue;
            }

            // Inline anonymous struct: "Response struct {" — read until matching "} `tag`"
            if (preg_match('/^([A-Z][A-Za-z0-9_]*)\s+struct\s*\{/', $line, $m)) {
                $inlineName = $m[1];
                $inlineKey = $this->emitInlineStruct($parentStruct, $inlineName, $bodyLines, $idx);
                // Now scan to closing brace line "}" followed by tag
                $jsonName = null;
                while ($idx < $count) {
                    $inline = trim($bodyLines[$idx]);
                    if (preg_match('/^\}\s*`json:"([^",]+)/', $inline, $jm)) {
                        $jsonName = $jm[1];
                        break;
                    }
                    $idx++;
                }
                if ($jsonName === null) {
                    throw new RuntimeException(
                        "Inline struct [{$parentStruct}.{$inlineName}] has no closing JSON field tag.",
                    );
                }
                $fields[] = [
                    'name' => $jsonName,
                    'jsonName' => $jsonName,
                    'goType' => '*'.$inlineKey,
                    'doc' => $pending !== [] ? implode("\n", $pending) : null,
                ];
                $pending = [];

                continue;
            }

            // Regular field: `FieldName Type \`json:"tag,..."\``
            if (preg_match('/^([A-Z][A-Za-z0-9_]*)\s+(\S+)\s+`json:"([^",]+)/', $line, $m)) {
                $fieldType = $m[2];
                $jsonName = $m[3];

                $fields[] = [
                    'name' => $jsonName,
                    'jsonName' => $jsonName,
                    'goType' => $fieldType,
                    'doc' => $pending !== [] ? implode("\n", $pending) : null,
                ];
                $pending = [];

                continue;
            }

            throw new RuntimeException(
                "Unrecognized field declaration in [{$parentStruct}]: {$line}",
            );
        }

        return $fields;
    }

    /**
     * Synthesize a class name and stash an inline struct as if it were a top-level struct.
     */
    /** @param list<string> $bodyLines */
    private function emitInlineStruct(string $parentStruct, string $inlineName, array $bodyLines, int $startIdx): string
    {
        // Read inline body until matching "}" (allowing trailing tag)
        $inner = [];
        $idx = $startIdx + 1;
        $count = count($bodyLines);
        $closed = false;
        while ($idx < $count) {
            $line = $bodyLines[$idx];
            $t = trim($line);
            if (preg_match('/^\}\s*`/', $t) || $t === '}') {
                $closed = true;
                break;
            }
            $inner[] = $line;
            $idx++;
        }
        if (! $closed) {
            throw new RuntimeException("Inline struct [{$parentStruct}.{$inlineName}] is not closed.");
        }

        // Most common case: `Response struct { ... }` inside a {Action}Response.
        // Promote the inline struct to a top-level `{Action}ResponseParams`
        // class so the response wrapper can reference it via a typed property.
        $synthName = $inlineName === 'Response' && preg_match('/Response$/', $parentStruct) === 1
            ? $parentStruct.'Params'
            : $parentStruct.$inlineName;

        if (isset($this->structs[$synthName])) {
            throw new RuntimeException("Duplicate synthesized model [{$synthName}] in upstream schema.");
        }
        $this->structs[$synthName] = [
            'name' => $synthName,
            'doc' => null,
            'fields' => $this->parseFieldBlock($inner, $synthName),
        ];

        return $synthName;
    }

    /** @param list<string> $lines */
    private function collectDocAbove(array $lines, int $structLineIdx): ?string
    {
        $doc = [];
        $i = $structLineIdx - 1;
        while ($i >= 0 && str_starts_with(trim($lines[$i]), '//')) {
            $doc[] = ltrim(substr(trim($lines[$i]), 2));
            $i--;
        }

        return $doc === [] ? null : implode("\n", array_reverse($doc));
    }

    /**
     * Parse client.go to extract Action methods.
     */
    private function parseClient(string $source): void
    {
        if (preg_match('/^\s*SERVICE\s*=\s*"([^"]+)"\s*$/m', $source, $service) !== 1) {
            throw new RuntimeException('Upstream client has no recognizable SERVICE constant.');
        }
        if (preg_match('/^\s*APIVersion\s*=\s*"([^"]+)"\s*$/m', $source, $version) !== 1) {
            throw new RuntimeException('Upstream client has no recognizable APIVersion constant.');
        }
        $this->serviceName = $service[1];
        $this->apiVersion = $version[1];

        $lines = explode("\n", $source);
        $n = count($lines);

        for ($i = 0; $i < $n; $i++) {
            $line = $lines[$i];
            if (preg_match(
                '/^func\s+\(c\s+\*Client\)\s+([A-Z][A-Za-z0-9_]*)\s*\(\s*request\s+\*([A-Z][A-Za-z0-9_]*)\s*\)\s*\(\s*response\s+\*([A-Z][A-Za-z0-9_]*)/',
                $line,
                $m,
            )) {
                $action = $m[1];
                $requestType = $m[2];
                $responseType = $m[3];

                // Doc on the line above (`// ActionName 描述...`)
                $doc = null;
                if ($i > 0 && str_starts_with(trim($lines[$i - 1]), '//')) {
                    $docLines = [];
                    $k = $i - 1;
                    while ($k >= 0 && str_starts_with(trim($lines[$k]), '//')) {
                        $docLines[] = ltrim(substr(trim($lines[$k]), 2));
                        $k--;
                    }
                    $doc = implode("\n", array_reverse($docLines));
                    // strip leading "ActionName " from first line
                    $doc = preg_replace('/^'.preg_quote($action, '/').'\s+/', '', $doc);
                }

                $this->actions[] = [
                    'action' => $action,
                    'requestType' => $requestType,
                    'responseType' => $responseType,
                    'doc' => $doc,
                ];
            } elseif (str_starts_with($line, 'func (c *Client) ')) {
                throw new RuntimeException("Unrecognized Client method signature: {$line}");
            }
        }
    }
}

/**
 * Small, explicit corrections for contract details published in the API
 * reference but missing from an upstream schema snapshot. Keeping these here
 * makes regeneration deterministic and the divergence auditable.
 */
final class DocumentedSchemaOverrides
{
    public static function apply(string $service, SchemaParser $parser): void
    {
        if ($service !== 'vm') {
            return;
        }

        self::preserveStopInstancesForceShutdownDefault($parser);
    }

    private static function preserveStopInstancesForceShutdownDefault(SchemaParser $parser): void
    {
        if (! isset($parser->structs['StopInstancesRequest'])) {
            throw new RuntimeException('Documented override target [StopInstancesRequest] is missing.');
        }

        foreach ($parser->structs['StopInstancesRequest']['fields'] as &$field) {
            if ($field['name'] !== 'forceShutdown') {
                continue;
            }
            if ($field['jsonName'] !== 'forceShutdown' || $field['goType'] !== '*bool') {
                throw new RuntimeException('Documented field [StopInstancesRequest.forceShutdown] changed type.');
            }

            $field['doc'] = "ForceShutdown 是否强制关机。\n"
                .'不指定时默认为 true。详见 https://docs.console.zenlayer.com/api-reference/compute/vm/virtual-machine-instance/stopinstances';

            return;
        }
        unset($field);

        throw new RuntimeException('Documented field [StopInstancesRequest.forceShutdown] is missing.');
    }
}

/** @phpstan-import-type StructInfo from SchemaParser */
final class PhpEmitter
{
    private const GENERATED_FILE_HEADER = <<<'PHP'
<?php

/*
 * SPDX-License-Identifier: Apache-2.0
 * Derived from the official Zenlayer Cloud SDK schema and modified for
 * PHP/Laravel. See NOTICE and UPSTREAM.md for attribution and revisions.
 */

declare(strict_types=1);
PHP;

    public function __construct(
        public readonly SchemaParser $parser,
        public readonly string $clientClassName,    // 'VmClient' / 'IptClient' / 'ZecClient'
        public readonly string $serviceName,        // 'vm' / 'ipt' / 'zec'
        public readonly string $apiVersion,         // '2026-04-01'
        public readonly string $namespacePrefix,    // 'ZenlayerCloud\\Laravel\\Vm\\V20260401'
        public readonly string $outClientPath,      // src/Vm/V20260401/VmClient.php
        public readonly string $outModelsDir,       // src/Vm/V20260401/Models
        public readonly string $serviceDescription, // human-readable service label
        public readonly string $referenceUrl,       // official API reference URL
    ) {}

    /** @return array{models:int,actions:int} */
    public function emit(): array
    {
        if (! is_dir($this->outModelsDir) && ! mkdir($this->outModelsDir, 0755, true) && ! is_dir($this->outModelsDir)) {
            throw new RuntimeException("Unable to create output directory [{$this->outModelsDir}].");
        }

        $modelCount = 0;
        foreach ($this->parser->structs as $info) {
            $this->emitModel($info);
            $modelCount++;
        }
        $this->emitClient();

        return ['models' => $modelCount, 'actions' => count($this->parser->actions)];
    }

    public function validateSchema(): void
    {
        if ($this->parser->serviceName !== $this->serviceName) {
            throw new RuntimeException(
                "Configured service [{$this->serviceName}] does not match upstream SERVICE [{$this->parser->serviceName}].",
            );
        }
        if ($this->parser->apiVersion !== $this->apiVersion) {
            throw new RuntimeException(
                "Configured API version [{$this->apiVersion}] does not match upstream APIVersion [{$this->parser->apiVersion}].",
            );
        }

        foreach ($this->parser->structs as $info) {
            foreach ($info['fields'] as $field) {
                $this->mapGoTypeToPhp($field['goType']);
            }
        }
    }

    /** @param StructInfo $info */
    private function emitModel(array $info): void
    {
        $className = $info['name'];
        $modelsNs = $this->namespacePrefix.'\\Models';

        $properties = [];
        $typeMap = [];
        $scalarArrayTypeMap = [];

        foreach ($info['fields'] as $field) {
            $mapped = $this->mapGoTypeToPhp($field['goType']);

            $properties[] = [
                'name' => $field['name'],
                'phpType' => $mapped['phpType'],
                'comment' => $field['doc'],
                'varAnnotation' => $mapped['varAnnotation'],
                'modelClass' => $mapped['modelClass'],
                'scalarArrayType' => $mapped['scalarArrayType'],
            ];

            if ($mapped['modelClass'] !== null && str_starts_with($field['goType'], '[]')) {
                $typeMap[$field['name']] = $mapped['modelClass'];
            }
            if ($mapped['scalarArrayType'] !== null) {
                $scalarArrayTypeMap[$field['name']] = $mapped['scalarArrayType'];
            }
        }

        $out = self::GENERATED_FILE_HEADER."\n\nnamespace {$modelsNs};\n\nuse ZenlayerCloud\\Laravel\\Common\\AbstractModel;\n\n";

        if ($info['doc'] !== null) {
            $out .= $this->renderDocBlock($info['doc'])."\n";
        }

        // Pint-friendly single-line form for empty model bodies.
        if ($properties === [] && $typeMap === [] && $scalarArrayTypeMap === []) {
            $out .= "class {$className} extends AbstractModel {}\n";
            $this->writeFile($this->outModelsDir.'/'.$className.'.php', $out);

            return;
        }

        $out .= "class {$className} extends AbstractModel\n{\n";

        foreach ($properties as $idx => $p) {
            if ($p['comment'] !== null && $p['comment'] !== '') {
                $out .= $this->indent($this->renderDocBlock($p['comment'], $p['varAnnotation']), 1)."\n";
            } elseif ($p['varAnnotation'] !== null) {
                $out .= "    /** @var {$p['varAnnotation']} */\n";
            }
            $out .= "    public {$p['phpType']} \${$p['name']} = null;\n";
            if ($idx !== count($properties) - 1) {
                $out .= "\n";
            }
        }

        if ($typeMap !== []) {
            $out .= "\n    /** @var array<string,class-string<AbstractModel>> */\n";
            $out .= "    protected static array \$_typeMap = [\n";
            foreach ($typeMap as $field => $cls) {
                $out .= "        '{$field}' => {$cls}::class,\n";
            }
            $out .= "    ];\n";
        }

        if ($scalarArrayTypeMap !== []) {
            $out .= "\n    /** @var array<string,'string'|'int'|'float'|'bool'> */\n";
            $out .= "    protected static array \$_scalarArrayTypeMap = [\n";
            foreach ($scalarArrayTypeMap as $field => $type) {
                $out .= "        '{$field}' => '{$type}',\n";
            }
            $out .= "    ];\n";
        }

        $out .= "}\n";

        $this->writeFile($this->outModelsDir.'/'.$className.'.php', $out);
    }

    private function emitClient(): void
    {
        $ns = $this->namespacePrefix;
        $className = $this->clientClassName;
        $service = $this->serviceName;
        $apiVersion = $this->apiVersion;

        // Note: we deliberately do not `use {$modelsNs};` — PHP's namespace
        // resolution already handles `Models\Foo` references inside this
        // namespace, and Pint's no_unused_imports would strip the import.
        $out = self::GENERATED_FILE_HEADER."\n\nnamespace {$ns};\n\nuse ZenlayerCloud\\Laravel\\Common\\AbstractClient;\n\n";
        $out .= "/**\n * {$this->serviceDescription} client (API version {$apiVersion}).\n *\n * Each public method maps 1:1 to an official Action name. The public API\n * reference is at {$this->referenceUrl};\n * UPSTREAM.md records any Action currently present only in the official SDKs.\n * Method names remain PascalCase so the protocol mapping is unambiguous.\n *\n * @generated by bin/codegen.php — do not edit by hand.\n */\n";
        $out .= "class {$className} extends AbstractClient\n{\n";
        $out .= "    protected function service(): string\n    {\n        return '{$service}';\n    }\n\n";
        $out .= "    protected function apiVersion(): string\n    {\n        return '{$apiVersion}';\n    }\n";

        foreach ($this->parser->actions as $action) {
            $a = $action['action'];
            $rq = $action['requestType'];
            $rp = $action['responseType'];

            $out .= "\n";

            $doc = $action['doc'] !== null && $action['doc'] !== ''
                ? $action['doc']
                : ('Calls action '.$a.'.');
            $out .= $this->indent($this->renderDocBlock($doc), 1)."\n";

            $out .= "    public function {$a}(#[\\SensitiveParameter] Models\\{$rq} \$request): Models\\{$rp}\n";
            $out .= "    {\n";
            $out .= "        return \$this->call('{$a}', \$request, Models\\{$rp}::class);\n";
            $out .= "    }\n";
        }

        $out .= "}\n";

        if (! is_dir(dirname($this->outClientPath)) && ! mkdir(dirname($this->outClientPath), 0755, true) && ! is_dir(dirname($this->outClientPath))) {
            throw new RuntimeException('Unable to create client output directory.');
        }
        $this->writeFile($this->outClientPath, $out);
    }

    /**
     * @return array{phpType:string,varAnnotation:?string,modelClass:?string,scalarArrayType:?string}
     */
    private function mapGoTypeToPhp(string $goType): array
    {
        // *string / *bool / *int / *int64 / *int32 / *float64 / *float32
        if (preg_match('/^\*(string|bool|int|int32|int64|float32|float64)$/', $goType, $m)) {
            $map = ['string' => 'string', 'bool' => 'bool', 'int' => 'int', 'int32' => 'int', 'int64' => 'int', 'float32' => 'float', 'float64' => 'float'];

            return ['phpType' => '?'.$map[$m[1]], 'varAnnotation' => null, 'modelClass' => null, 'scalarArrayType' => null];
        }

        // []string, []int, []int64, []float64, []bool
        if (preg_match('/^\[\](string|int|int32|int64|float32|float64|bool)$/', $goType, $m)) {
            $map = ['string' => 'string', 'bool' => 'bool', 'int' => 'int', 'int32' => 'int', 'int64' => 'int', 'float32' => 'float', 'float64' => 'float'];
            $valueType = $map[$m[1]];

            return ['phpType' => '?array', 'varAnnotation' => "list<{$valueType}>|null", 'modelClass' => null, 'scalarArrayType' => $valueType];
        }

        // []*XxxStruct or []XxxStruct
        if (preg_match('/^\[\]\*?([A-Z][A-Za-z0-9_]*)$/', $goType, $m)) {
            $this->assertModelExists($m[1], $goType);

            return ['phpType' => '?array', 'varAnnotation' => "list<{$m[1]}>|null", 'modelClass' => $m[1], 'scalarArrayType' => null];
        }

        // *XxxStruct
        if (preg_match('/^\*([A-Z][A-Za-z0-9_]*)$/', $goType, $m)) {
            $this->assertModelExists($m[1], $goType);

            return ['phpType' => '?'.$m[1], 'varAnnotation' => null, 'modelClass' => $m[1], 'scalarArrayType' => null];
        }

        // Non-pointer plain `string` (rare; happens in inline structs)
        if ($goType === 'string') {
            return ['phpType' => '?string', 'varAnnotation' => null, 'modelClass' => null, 'scalarArrayType' => null];
        }

        throw new RuntimeException("Unmapped Go type [{$goType}]; refusing to emit a lossy mixed property.");
    }

    private function assertModelExists(string $modelClass, string $goType): void
    {
        if (! isset($this->parser->structs[$modelClass])) {
            throw new RuntimeException("Go type [{$goType}] references missing model [{$modelClass}].");
        }
    }

    private function renderDocBlock(string $text, ?string $varAnnotation = null): string
    {
        $lines = explode("\n", trim($text));
        $out = "/**\n";
        foreach ($lines as $line) {
            // A Go line comment may legally contain the PHPDoc terminator.
            // Break it so upstream prose can never escape the generated block.
            $out .= ' * '.str_replace('*/', '* /', rtrim($line))."\n";
        }
        if (preg_match('/(^|\n)Deprecated:/', $text) === 1) {
            $out .= ' *'."\n";
            $out .= ' * @deprecated'."\n";
        }
        if ($varAnnotation !== null) {
            $out .= ' *'."\n";
            $out .= ' * @var '.$varAnnotation."\n";
        }
        $out .= ' */';

        return $out;
    }

    private function indent(string $text, int $levels): string
    {
        $pad = str_repeat('    ', $levels);

        return $pad.str_replace("\n", "\n".$pad, $text);
    }

    private function writeFile(string $path, string $contents): void
    {
        if (file_put_contents($path, $contents) === false) {
            throw new RuntimeException("Unable to write generated file [{$path}].");
        }
    }
}

// --- Driver ------------------------------------------------------------------

$schemaSrc = $argv[1] ?? getenv('ZENLAYER_SCHEMA_SRC') ?: null;
if (! is_string($schemaSrc) || trim($schemaSrc) === '') {
    fwrite(STDERR, "[codegen] FATAL: upstream schema path is required.\n");
    fwrite(STDERR, "  Pass /path/to/zenlayercloud-sdk-go/zenlayercloud as the first argument\n");
    fwrite(STDERR, "  or set ZENLAYER_SCHEMA_SRC.\n");
    exit(1);
}
$schemaSrc = rtrim($schemaSrc, '/');

$jobs = [
    [
        'modelsSrc' => $schemaSrc.'/vm20260401/models.go',
        'clientSrc' => $schemaSrc.'/vm20260401/client.go',
        'clientClass' => 'VmClient',
        'service' => 'vm',
        'apiVersion' => '2026-04-01',
        'nsPrefix' => 'ZenlayerCloud\\Laravel\\Vm\\V20260401',
        'outClient' => ROOT.'/src/Vm/V20260401/VmClient.php',
        'outModels' => ROOT.'/src/Vm/V20260401/Models',
        'description' => 'Zenlayer Cloud Virtual Machine (VM)',
        'referenceUrl' => 'https://docs.console.zenlayer.com/api-reference/compute/vm',
    ],
    [
        'modelsSrc' => $schemaSrc.'/ipt20240901/models.go',
        'clientSrc' => $schemaSrc.'/ipt20240901/client.go',
        'clientClass' => 'IptClient',
        'service' => 'ipt',
        'apiVersion' => '2024-09-01',
        'nsPrefix' => 'ZenlayerCloud\\Laravel\\Ipt\\V20240901',
        'outClient' => ROOT.'/src/Ipt/V20240901/IptClient.php',
        'outModels' => ROOT.'/src/Ipt/V20240901/Models',
        'description' => 'Zenlayer Cloud IP Transit (IPT)',
        'referenceUrl' => 'https://docs.console.zenlayer.com/api-reference/cn/networking/ipt',
    ],
    [
        'modelsSrc' => $schemaSrc.'/zec20250901/models.go',
        'clientSrc' => $schemaSrc.'/zec20250901/client.go',
        'clientClass' => 'ZecClient',
        'service' => 'zec',
        'apiVersion' => '2025-09-01',
        'nsPrefix' => 'ZenlayerCloud\\Laravel\\Zec\\V20250901',
        'outClient' => ROOT.'/src/Zec/V20250901/ZecClient.php',
        'outModels' => ROOT.'/src/Zec/V20250901/Models',
        'description' => 'Zenlayer Cloud Elastic Compute (ZEC)',
        'referenceUrl' => 'https://docs.console.zenlayer.com/api-reference/compute/zec',
    ],
];

/** @var list<array{job:array<string,string>,emitter:PhpEmitter}> $prepared */
$prepared = [];

try {
    // Parse and validate every service before touching committed output. A
    // missing or newly unsupported upstream type can therefore never leave
    // one service refreshed and another half-deleted.
    foreach ($jobs as $job) {
        if (! is_file($job['modelsSrc']) || ! is_file($job['clientSrc'])) {
            throw new RuntimeException("Upstream schema not found at {$job['modelsSrc']}.");
        }

        $parser = new SchemaParser($job['modelsSrc'], $job['clientSrc']);
        $parser->parse();
        DocumentedSchemaOverrides::apply($job['service'], $parser);

        $emitter = new PhpEmitter(
            parser: $parser,
            clientClassName: $job['clientClass'],
            serviceName: $job['service'],
            apiVersion: $job['apiVersion'],
            namespacePrefix: $job['nsPrefix'],
            outClientPath: $job['outClient'],
            outModelsDir: $job['outModels'],
            serviceDescription: $job['description'],
            referenceUrl: $job['referenceUrl'],
        );
        $emitter->validateSchema();
        $prepared[] = ['job' => $job, 'emitter' => $emitter];
    }

    foreach ($prepared as $item) {
        $job = $item['job'];

        // Wipe stale models so removed upstream types do not linger.
        if (is_dir($job['outModels'])) {
            foreach (glob($job['outModels'].'/*.php') ?: [] as $file) {
                if (! unlink($file)) {
                    throw new RuntimeException("Unable to remove stale generated model [{$file}].");
                }
            }
        }

        $stats = $item['emitter']->emit();

        printf(
            "[codegen] %-3s api %s  ->  %d model classes, %d action methods\n",
            $job['service'],
            $job['apiVersion'],
            $stats['models'],
            $stats['actions'],
        );
    }
} catch (Throwable $e) {
    fwrite(STDERR, "[codegen] FATAL: {$e->getMessage()}\n");
    exit(1);
}

echo "[codegen] done.\n";
