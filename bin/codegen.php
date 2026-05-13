<?php

declare(strict_types=1);

/**
 * Maintainer tool: regenerates the strongly-typed service clients and model
 * classes under `src/Vm/V20260401/` and `src/Zec/V20250901/`.
 *
 * The generator reads upstream schema files that describe each Zenlayer Cloud
 * OpenAPI Action (one file per service) and emits one PHP class per Request,
 * Response, and nested Params/Info type. The generated tree is committed to
 * version control — package consumers never need to run this script.
 *
 *     ZENLAYER_SCHEMA_SRC=/path/to/upstream/schema composer codegen
 *
 * If `ZENLAYER_SCHEMA_SRC` is unset the default development path is used
 * (override it when regenerating in CI or against a fresh schema drop).
 *
 * The expected schema is a typed-struct DSL where each field declaration has
 * the form `FieldName <Type> \`json:"jsonName,omitempty"\``. Supported types:
 *
 *   *string                  -> ?string
 *   *int, *int32, *int64     -> ?int
 *   *bool                    -> ?bool
 *   *float32, *float64       -> ?float
 *   *Xxx                     -> ?Xxx (nested AbstractModel)
 *   []string, []int, ...     -> ?array of scalars
 *   []*Xxx / []Xxx           -> ?array of Xxx (added to $_typeMap)
 *   embeds of base types     -> (ignored)
 *   Response struct {...}    -> auto-promoted to `{Wrapper}Params` class
 */
const ROOT = __DIR__.'/..';
const DEFAULT_SCHEMA_SRC = '/tmp/zenlayer-research/zenlayercloud-sdk-go/zenlayercloud';

final class SchemaParser
{
    /** @var array<string,array{name:string, fields:array<int,array>, doc:?string}> */
    public array $structs = [];

    /** @var array<int,array{action:string, requestType:string, responseType:string, doc:?string}> */
    public array $actions = [];

    public function __construct(
        public readonly string $modelsSrcPath,
        public readonly string $clientSrcPath,
        public readonly string $wrapperPrefix,    // 'Vm' or 'Zec' — disambiguates inline struct names
    ) {}

    public function parse(): void
    {
        $this->parseModels(file_get_contents($this->modelsSrcPath));
        $this->parseClient(file_get_contents($this->clientSrcPath));
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
     * @return array<int,array{name:string, jsonName:string, goType:string, doc:?string}>
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
                $jsonName = $inlineName;
                while ($idx < $count) {
                    $inline = trim($bodyLines[$idx]);
                    if (preg_match('/^\}\s*`json:"([^",]+)/', $inline, $jm)) {
                        $jsonName = $jm[1];
                        break;
                    }
                    $idx++;
                }
                $fields[] = [
                    'name' => lcfirst($inlineName),
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

            // Anything else: drop pending
            $pending = [];
        }

        return $fields;
    }

    /**
     * Synthesize a class name and stash an inline struct as if it were a top-level struct.
     */
    private function emitInlineStruct(string $parentStruct, string $inlineName, array $bodyLines, int $startIdx): string
    {
        // Read inline body until matching "}" (allowing trailing tag)
        $inner = [];
        $idx = $startIdx + 1;
        $count = count($bodyLines);
        while ($idx < $count) {
            $line = $bodyLines[$idx];
            $t = trim($line);
            if (preg_match('/^\}\s*`/', $t) || $t === '}') {
                break;
            }
            $inner[] = $line;
            $idx++;
        }

        // Most common case: `Response struct { ... }` inside a {Action}Response.
        // Promote the inline struct to a top-level `{Action}ResponseParams`
        // class so the response wrapper can reference it via a typed property.
        $synthName = preg_match('/Response$/', $parentStruct) === 1
            ? $parentStruct.'Params'
            : $parentStruct.$inlineName;

        $this->structs[$synthName] = [
            'name' => $synthName,
            'doc' => null,
            'fields' => $this->parseFieldBlock($inner, $synthName),
        ];

        return $synthName;
    }

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
            }
        }
    }
}

final class PhpEmitter
{
    public function __construct(
        public readonly SchemaParser $parser,
        public readonly string $clientClassName,    // 'VmClient' / 'ZecClient'
        public readonly string $serviceName,        // 'vm' / 'zec'
        public readonly string $apiVersion,         // '2026-04-01'
        public readonly string $namespacePrefix,    // 'ZenlayerCloud\\Laravel\\Vm\\V20260401'
        public readonly string $outClientPath,      // src/Vm/V20260401/VmClient.php
        public readonly string $outModelsDir,       // src/Vm/V20260401/Models
        public readonly string $serviceDescription, // human-readable service label
    ) {}

    public function emit(): array
    {
        if (! is_dir($this->outModelsDir)) {
            mkdir($this->outModelsDir, 0755, true);
        }

        $modelCount = 0;
        foreach ($this->parser->structs as $info) {
            $this->emitModel($info);
            $modelCount++;
        }
        $this->emitClient();

        return ['models' => $modelCount, 'actions' => count($this->parser->actions)];
    }

    private function emitModel(array $info): void
    {
        $className = $info['name'];
        $modelsNs = $this->namespacePrefix.'\\Models';

        $properties = [];
        $typeMap = [];

        foreach ($info['fields'] as $field) {
            $mapped = $this->mapGoTypeToPhp($field['goType']);

            $properties[] = [
                'name' => $field['name'],
                'phpType' => $mapped['phpType'],
                'comment' => $field['doc'],
                'isModelArray' => $mapped['isModelArray'],
                'modelClass' => $mapped['modelClass'],
            ];

            if ($mapped['isModelArray'] && $mapped['modelClass'] !== null) {
                $typeMap[$field['name']] = $mapped['modelClass'];
            }
        }

        $out = "<?php\n\ndeclare(strict_types=1);\n\nnamespace {$modelsNs};\n\nuse ZenlayerCloud\\Laravel\\Common\\AbstractModel;\n\n";

        if ($info['doc'] !== null) {
            $out .= $this->renderDocBlock($info['doc'])."\n";
        }

        // Pint-friendly single-line form for empty model bodies.
        if ($properties === [] && $typeMap === []) {
            $out .= "class {$className} extends AbstractModel {}\n";
            file_put_contents($this->outModelsDir.'/'.$className.'.php', $out);

            return;
        }

        $out .= "class {$className} extends AbstractModel\n{\n";

        foreach ($properties as $idx => $p) {
            if ($p['comment'] !== null && $p['comment'] !== '') {
                $out .= $this->indent($this->renderDocBlock($p['comment'], $p['isModelArray'] ? $p['modelClass'].'[]|null' : null), 1)."\n";
            } elseif ($p['isModelArray'] && $p['modelClass'] !== null) {
                $out .= "    /** @var {$p['modelClass']}[]|null */\n";
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

        $out .= "}\n";

        file_put_contents($this->outModelsDir.'/'.$className.'.php', $out);
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
        $out = "<?php\n\ndeclare(strict_types=1);\n\nnamespace {$ns};\n\nuse ZenlayerCloud\\Laravel\\Common\\AbstractClient;\n\n";
        $out .= "/**\n * {$this->serviceDescription} client (API version {$apiVersion}).\n *\n * Each public method maps 1:1 to an Action name documented at\n * https://docs.console.zenlayer.com/api-reference/cn. Method names are\n * intentionally PascalCase to keep that mapping unambiguous when copy-\n * pasting examples between the API reference and PHP code.\n *\n * @generated by bin/codegen.php — do not edit by hand.\n */\n";
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

            $out .= "    public function {$a}(Models\\{$rq} \$request): Models\\{$rp}\n";
            $out .= "    {\n";
            $out .= "        return \$this->call('{$a}', \$request, Models\\{$rp}::class);\n";
            $out .= "    }\n";
        }

        $out .= "}\n";

        if (! is_dir(dirname($this->outClientPath))) {
            mkdir(dirname($this->outClientPath), 0755, true);
        }
        file_put_contents($this->outClientPath, $out);
    }

    /**
     * @return array{phpType:string, isModelArray:bool, modelClass:?string}
     */
    private function mapGoTypeToPhp(string $goType): array
    {
        // *string / *bool / *int / *int64 / *int32 / *float64 / *float32
        if (preg_match('/^\*(string|bool|int|int32|int64|float32|float64)$/', $goType, $m)) {
            $map = ['string' => 'string', 'bool' => 'bool', 'int' => 'int', 'int32' => 'int', 'int64' => 'int', 'float32' => 'float', 'float64' => 'float'];

            return ['phpType' => '?'.$map[$m[1]], 'isModelArray' => false, 'modelClass' => null];
        }

        // []string, []int, []int64, []float64, []bool
        if (preg_match('/^\[\](string|int|int32|int64|float32|float64|bool)$/', $goType)) {
            return ['phpType' => '?array', 'isModelArray' => false, 'modelClass' => null];
        }

        // []*XxxStruct or []XxxStruct
        if (preg_match('/^\[\]\*?([A-Z][A-Za-z0-9_]*)$/', $goType, $m)) {
            return ['phpType' => '?array', 'isModelArray' => true, 'modelClass' => $m[1]];
        }

        // *XxxStruct
        if (preg_match('/^\*([A-Z][A-Za-z0-9_]*)$/', $goType, $m)) {
            return ['phpType' => '?'.$m[1], 'isModelArray' => false, 'modelClass' => null];
        }

        // Non-pointer plain `string` (rare; happens in inline structs)
        if ($goType === 'string') {
            return ['phpType' => '?string', 'isModelArray' => false, 'modelClass' => null];
        }

        // Fallback — leave as mixed nullable
        fwrite(STDERR, "[codegen] WARN: unmapped Go type [{$goType}] — defaulting to mixed.\n");

        return ['phpType' => 'mixed', 'isModelArray' => false, 'modelClass' => null];
    }

    private function renderDocBlock(string $text, ?string $varAnnotation = null): string
    {
        $lines = explode("\n", trim($text));
        $out = "/**\n";
        foreach ($lines as $line) {
            $out .= ' * '.rtrim($line)."\n";
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
}

// --- Driver ------------------------------------------------------------------

$schemaSrc = getenv('ZENLAYER_SCHEMA_SRC') ?: DEFAULT_SCHEMA_SRC;

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
        'wrapperPfx' => 'Vm',
        'description' => 'Zenlayer Cloud Virtual Machine (VM)',
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
        'wrapperPfx' => 'Zec',
        'description' => 'Zenlayer Cloud Elastic Compute (ZEC)',
    ],
];

foreach ($jobs as $job) {
    if (! is_file($job['modelsSrc']) || ! is_file($job['clientSrc'])) {
        fwrite(STDERR, "[codegen] FATAL: upstream schema not found at {$job['modelsSrc']}.\n");
        fwrite(STDERR, "  Set ZENLAYER_SCHEMA_SRC to the directory containing\n");
        fwrite(STDERR, "  vm20260401/{models.go,client.go} and zec20250901/{models.go,client.go}.\n");
        exit(1);
    }

    // Wipe stale models so removed Actions don't linger
    if (is_dir($job['outModels'])) {
        foreach (glob($job['outModels'].'/*.php') as $f) {
            unlink($f);
        }
    }

    $parser = new SchemaParser($job['modelsSrc'], $job['clientSrc'], $job['wrapperPfx']);
    $parser->parse();
    $emitter = new PhpEmitter(
        parser: $parser,
        clientClassName: $job['clientClass'],
        serviceName: $job['service'],
        apiVersion: $job['apiVersion'],
        namespacePrefix: $job['nsPrefix'],
        outClientPath: $job['outClient'],
        outModelsDir: $job['outModels'],
        serviceDescription: $job['description'],
    );
    $stats = $emitter->emit();

    printf(
        "[codegen] %-3s api %s  ->  %d model classes, %d action methods\n",
        $job['service'],
        $job['apiVersion'],
        $stats['models'],
        $stats['actions'],
    );
}

echo "[codegen] done.\n";
