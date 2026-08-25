# Security Policy

## Supported versions

| Version  | Supported |
|----------|-----------|
| `0.1.x`  | ✅        |

## Reporting a vulnerability

If you believe you have found a security issue in this package, **please do
not open a public GitHub issue**. Instead, use GitHub's private vulnerability
reporting at:

    https://github.com/augusl/zenlayercloud-sdk-laravel/security/advisories/new

Include:

- A description of the issue and the impact.
- Steps to reproduce.
- The affected version(s).
- Any patches or mitigations you can suggest.

You can expect an acknowledgement within five business days. We will keep
you updated as we work on a fix, and we will credit you in the release
notes unless you ask us not to.

## What counts as a vulnerability

In the context of this package, the most likely security concerns include:

- Leaking the secret key password through logs, exception messages, or
  serialised debug output.
- Signature-construction bugs that would cause requests to be authenticated
  with the wrong credentials.
- Insecure default transport settings (e.g. accepting invalid TLS certs).

This SDK does **not** persist credentials anywhere; it consumes them at
runtime from your Laravel configuration. SDK debug mode intentionally logs
only request metadata and response status; it does not log Authorization
headers or request/response bodies. Treat application-level HTTP middleware
and custom log processors as separate parts of your security boundary.

## Not in scope

- Issues with the upstream Zenlayer Cloud OpenAPI itself. Please report
  those through Zenlayer's official channels.
- Vulnerabilities in third-party dependencies that have already been fixed
  upstream — please bump the dependency and open a regular PR.
