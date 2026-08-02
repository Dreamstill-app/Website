# Deploying Sorty API + Admin to Plesk (dreamstill.ca)

> The `finalsite` branch auto-deploys to `/httpdocs` via Plesk Git.
> Merging `develop` → `finalsite` IS the deployment trigger — do the server
> prep (§1–§3) BEFORE merging the first time.

## 1. One-time server prep (before first deploy)

### PHP handler
Plesk → dreamstill.ca → PHP Settings → set **PHP 8.3** (FPM).
Verify required extensions are on: `intl, gd, pdo_mysql, zip, bcmath, fileinfo, curl, mbstring`.

### Database
Plesk → Databases → Add:
- DB name: `dreamstill_prod` (or keep existing if the CMS already has one — check `.env` on server)
- User: dedicated user, this DB only, localhost only

### Production .env (server: /httpdocs/.env)
The existing site already has a `.env` — **extend it**, don't replace. Add/verify:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://dreamstill.ca

DB_CONNECTION=mysql
DB_DATABASE=<prod db>
DB_USERNAME=<prod user>
DB_PASSWORD=<prod password>

QUEUE_CONNECTION=database
CACHE_STORE=database

MAIL_MAILER=smtp
MAIL_HOST=localhost
MAIL_PORT=587
MAIL_FROM_ADDRESS=info@dreamstill.ca
MAIL_FROM_NAME="DreamStill"

SANCTUM_TOKEN_EXPIRATION=43200
SORTY_ANALYZE_DAILY_QUOTA=50
SORTY_DECISION_TREE_VERSION=1.0

AZURE_OPENAI_ENDPOINT=https://inputly-openai-2.cognitiveservices.azure.com/
AZURE_OPENAI_DEPLOYMENT=gpt-5-mini
AZURE_OPENAI_API_KEY=<key>
```

### Queue worker (required — analysis emails, purge jobs)
Plesk → Scheduled Tasks → add (run as the domain's system user):

| Task | Command | Schedule |
|---|---|---|
| Scheduler | `/opt/plesk/php/8.3/bin/php /data/plesk/vhosts/dreamstill.ca/httpdocs/artisan schedule:run` | `* * * * *` |
| Queue | `/opt/plesk/php/8.3/bin/php /data/plesk/vhosts/dreamstill.ca/httpdocs/artisan queue:work --max-time=290 --tries=3 --stop-when-empty` | `*/5 * * * *` |

(The queue task uses stop-when-empty + 5-min cadence so Plesk cron acts as a
supervisor. Move to a systemd unit later if volume grows.)

### Plesk Git deployment actions
Plesk → dreamstill.ca → Git → Repository settings → "Enable additional deployment actions":

```bash
/opt/plesk/php/8.3/bin/php -d memory_limit=512M /usr/lib64/plesk-9.0/composer.phar install --no-dev --optimize-autoloader --no-interaction
/opt/plesk/php/8.3/bin/php artisan migrate --force
/opt/plesk/php/8.3/bin/php artisan config:cache
/opt/plesk/php/8.3/bin/php artisan route:cache
/opt/plesk/php/8.3/bin/php artisan view:cache
/opt/plesk/php/8.3/bin/php artisan storage:link
/opt/plesk/php/8.3/bin/php artisan queue:restart
```

(If the composer.phar path differs, `which composer` on the server or use
`composer` if it's on PATH for the vhost user.)

### Backups
Plesk → Backup Manager: nightly, include databases + `/httpdocs/storage/app/private`, 14-day retention.

## 2. Deploy

```bash
git checkout finalsite
git merge develop
git push origin finalsite
```

Then Plesk → Git → **Pull now** (or wait for webhook) → deployment actions run.

## 3. Post-deploy smoke test

```bash
curl -s https://dreamstill.ca/api/v1/health
```
Expect `{"status":"ok","checks":{"db":true,"storage":true,"ai":true},...}`.

- `https://dreamstill.ca` — marketing site renders
- `https://dreamstill.ca/admin` — login works for info@dreamstill.ca (role granted by migration)
- Admin → Sorts / Events / Rewards / Community Tips resources visible
- Register a test user via API; run one sort with a photo; verify it appears in admin

## 4. Rollback

```bash
git checkout finalsite
git reset --hard poc-baseline   # or the previous finalsite commit
git push --force origin finalsite
```
Then "Pull now" in Plesk. Migrations are additive; the old site ignores the new tables.
