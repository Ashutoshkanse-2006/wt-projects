# Adore & Adorn — Vercel version
See ../README.md for steps. Layout:
- `app/` the original PHP pages (served through `api/index.php`)
- `public/` css, js and product images (served as static files)
- `database/` SQL to run on your hosted MySQL
- `vercel.json` runtime + routing
Env vars: DB_HOST, DB_PORT, DB_USER, DB_PASS, DB_NAME=adore_adorn, DB_SSL=1
