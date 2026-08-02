# Sorty Platform — Security Design v1.0

> 2026-08-02 · Applies to the Laravel API/admin and the Flutter client.

## 1. Authentication & authorization

| Concern | Design |
|---|---|
| API auth | Laravel Sanctum personal access tokens, per-device (`device_name`), 30-day expiry (`SANCTUM_TOKEN_EXPIRATION`), revocable per device or all |
| Password policy | min 10 chars, `Password::default()->uncompromised()` (haveibeenpwned k-anonymity) |
| Guest mode | real user row with `is_guest=1`, random internal email, limited abilities token (`role:guest`); upgrade endpoint preserves data and requires email+password |
| Admin panel | Filament behind session auth + `role=admin` gate; enforced 2FA for admin accounts (Filament plugin); `/admin` optionally IP-allowlisted via Plesk |
| Authorization | Policy per model. Users access only their own sorts/bundles/chats. Partner role scoped to owned locations. No role checks inline in controllers — policies only |
| Object IDs | UUIDs for sorts/bundles (no enumerable integer IDs in API) — IDOR resistance |

## 2. API hardening

- **Rate limits** (per user or IP): auth endpoints 5/min; `/sorts` create+analyze 10/min +
  daily quota `SORTY_ANALYZE_DAILY_QUOTA`; chat 20/min; general 60/min. 429 with Retry-After.
- **Validation**: FormRequest on every write; strict types; unknown fields rejected.
- **Responses**: API Resources only — model attributes never leak (`password`, internals).
  Uniform error envelope; no stack traces (`APP_DEBUG=false` in prod); generic 401/404
  messages (no user-enumeration).
- **Headers**: HSTS, `X-Content-Type-Options: nosniff`, `X-Frame-Options: DENY`,
  restrictive CSP on web routes.
- **CORS**: API allows the app schemes + dreamstill.ca only.

## 3. Upload pipeline (images)

1. Accept only `image/jpeg|png|webp|heic`, max 8 MB pre-compression, 3 files max per sort.
2. Server-side: mime **sniffed** (finfo, not extension), decoded and **re-encoded** via
   Intervention Image (destroys polyglot/embedded-payload files), EXIF (incl. GPS) stripped,
   max dimension 2048px, stored as `.jpg`.
3. Stored under `storage/app/private/sorts/{userId}/{sortId}/` — **outside web root**,
   randomized names, never user-supplied filenames.
4. Served only through an authorized controller (policy check + streamed response).
   No public disk, no direct URLs.
5. `sha256` recorded per image (integrity + dataset dedup).

## 4. Secrets management

- All secrets in server `.env` (not in git — verified; `.env.example` documents keys).
- Flutter app ships **zero secrets**; verified pre-release by scanning the APK
  (`strings`/apktool grep for `key`, `secret`, `nvapi`, `AIza`).
- ⚠️ Historical exposures to rotate (Phase 0 action): NVIDIA NIM key (was in
  `test_nvidia.py`, file deleted, key never committed to git but present on disk/drive
  copies) and scrapingdog key (hardcoded in POC `price_estimation.dart`, still in git
  history of the sorty repo — rotate at provider, do not attempt history rewrite).
- Azure keys: separate deployments for vision vs chat allow independent rotation;
  quarterly rotation calendar.

## 5. Privacy (PIPEDA-aligned)

- Data minimization: no precise home location stored; city + postal prefix only.
  Map queries use ephemeral lat/lng, not persisted.
- EXIF GPS stripped from all uploads (see §3).
- Account deletion: `DELETE /me` cascades sorts, images (disk), chats, progress; 30-day
  soft-delete window then hard purge (scheduled job).
- Chat logs: stored for product improvement; admin views are user-pseudonymized;
  retention 12 months.
- Dataset exports (ML): images + labels only, keyed by sort UUID, no user identifiers.
- Privacy Policy & Terms (from `Sorty-The App/App Pages and Policies` drafts) served as
  CMS pages, linked in-app; consent checkbox at registration.

## 6. Infrastructure

- HTTPS enforced (Plesk Let's Encrypt), TLS 1.2+.
- MariaDB user: least-privilege (no GRANT/SUPER/FILE), localhost-only.
- Backups: nightly Plesk backup (DB + `storage/app/private`), 14-day retention,
  restore tested once before demo.
- Queue worker and scheduler run as the domain's system user, not root.
- SSH: key-only auth for deploy access.
- Logging: structured JSON logs with request IDs; auth failures and 429s logged;
  no request bodies containing images/PII in logs.

## 7. Pre-release checklist (Phase 7 gate)

- [ ] `composer audit` and `npm audit` clean
- [ ] Larastan level 6 clean; Pint clean
- [ ] Feature tests: authz matrix (user A cannot read/modify user B's sort/bundle/chat/image)
- [ ] Rate limits verified firing (test hits 429)
- [ ] APK secret scan clean
- [ ] `APP_DEBUG=false`, `config:cache` applied, `.env` perms 600
- [ ] Upload smuggling test (PHP-in-JPEG, SVG, polyglot) rejected/neutralized
- [ ] Token expiry + logout-all verified
- [ ] Account deletion cascade verified (disk + DB)
- [ ] Old keys rotated (NVIDIA, scrapingdog)
