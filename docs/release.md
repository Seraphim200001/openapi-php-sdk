## Release 1.3.0 — Openapi® PHP SDK

The **1.3.0** release of the Openapi® PHP SDK introduces a redesigned transport layer, built-in environment support, and a cleaner class naming convention — making the SDK more composable, testable, and framework-friendly.

### 🔌 Pluggable HTTP Transport

* Introduced `HttpTransportInterface` — inject any HTTP client (Guzzle, PSR-18, Laravel HTTP) directly into `Client`.
* Added `CurlTransport` as the default implementation, extracted from `Client` to respect the single-responsibility principle.
* Full PSR-18 compatibility: `psr/http-client` is now a declared dependency.

### 🌿 Built-in DotEnv Support

* Added `DotEnv` loader for lightweight `.env` file parsing with no external dependencies.
* Added `Bootstrap` — automatically loaded via Composer's `files` autoload — for seamless environment bootstrapping in plain PHP projects.
* Framework-safe: does not override variables already set by Laravel, Symfony, or CI environments.

### 🧹 Cleaner Naming Convention

* Removed redundant `Openapi` prefix from all class and file names — the `Openapi\` namespace already provides the context.
* Renamed `Exception` → `ApiException` to avoid shadowing PHP's built-in `\Exception`.
* `OauthClient` now supports environment variable fallback for credentials and OAuth URLs.

### 👥 Contributors

* Added full author attribution in `composer.json` — Lorenzo Paderi, Mario Ugurcu, Francesco Bianco, and Claude Code.
* Work from the `upkeep` branch (Mario Ugurcu) has been properly integrated and credited.

### 🚀 Looking Ahead

Version **1.3.0** establishes the architectural foundation for future extensibility. Next milestones include middleware support, structured error responses, and a retry policy interface built on top of the new transport layer.
