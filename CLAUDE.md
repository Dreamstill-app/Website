# DreamStill Website + Sorty API

Laravel 12 application serving three roles:
1. **Marketing site** for dreamstill.ca (CMS-driven pages via `Page`/`PageSection`)
2. **Filament v5 admin panel** (`/admin`) — CMS + Sorty platform administration
3. **Sorty mobile API** (`/api/v1`) — backend for the Sorty Flutter app (`Dreamstill-app/sorty` repo)

## Branches & deployment

- `develop` — active work. Feature branches merge here.
- `finalsite` — **production**. Plesk auto-deploys this branch to
  `/data/plesk/vhosts/dreamstill.ca/httpdocs` on git pull ("Pull now"/"Deploy now" in Plesk UI).
  Never push half-done work to `finalsite`.

## Production server

- Plesk on Azure VM `52.233.89.141` (`ssh -i C:/inputly.ai/sero_azure_key.pem azureuser@52.233.89.141`)
- **PHP: use `/opt/plesk/php/8.3/bin/php`** for artisan/composer on the server — the system
  CLI is 8.1 which Laravel 12 rejects.
- Database: MariaDB 10.6 (Plesk-managed). Avoid MySQL-8-only SQL (no `CHECK` reliance,
  functional indexes, etc.).
- Deploy steps after pull: `composer install --no-dev && php artisan migrate --force
  && php artisan config:cache route:cache view:cache && php artisan queue:restart`

## Conventions

- API code lives under `app/Http/Controllers/Api/V1`, resources under `app/Http/Resources`,
  domain services under `app/Services` (e.g. `Sorting/DecisionTree`, `Ai/AzureOpenAi`).
- Every API response goes through an API Resource; errors use the JSON envelope
  `{"error": {"code", "message", "details"}}`.
- FormRequest validation on every write endpoint. Policies on every model.
- Tests: Pest, in `tests/Feature/Api`. Run `php artisan test` before committing.
- Style: `vendor/bin/pint` before commit.
- Secrets only in `.env` (see `.env.example` for the full catalog). Nothing secret in the
  Flutter app or in git.

## Key docs

- `docs/ARCHITECTURE.md` — system blueprint
- `docs/decision-tree.md` — the authoritative garment decision-tree spec (versioned)
- `docs/openapi.yaml` — API contract
- `docs/SECURITY.md` — security design & checklist
- `C:\dreamstill\sorty_todo.md` (local, not in repo) — master phase plan
