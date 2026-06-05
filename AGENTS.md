# AGENTS.md

## Development commands

| Task | Command |
|------|---------|
| Install | `npm install` |
| Dev server | `npm run dev` |
| Lint | `npm run lint` |
| Build | `npm run build` |

## Cursor Cloud specific instructions

- **Update script:** `npm install` only.
- **Dev server:** `npm run dev` in tmux on port 3000.
- **Event photos:** Add JPGs under `public/images/events/` per `public/images/events/README.md`; components fall back to SVG placeholders.
- **Forms:** Optional `CONTACT_WEBHOOK_URL` and `NEWSLETTER_WEBHOOK_URL` for production submissions.
- **Analytics:** Set `NEXT_PUBLIC_PLAUSIBLE_DOMAIN` for Plausible.
