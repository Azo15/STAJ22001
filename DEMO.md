# Public read-only demo

On Render, create a Docker Web Service from this repository and select the
`codex/read-only-demo` branch. Set `APP_KEY` to a fresh Laravel application key
(generate it locally with `php artisan key:generate --show`). Set the health
check path to `/up`.

The image creates and seeds its own SQLite database during the build. The
Apache worker runs with read-only access to that file. Do not attach a
production database or reuse a production key. `DEMO_MODE=true` enables the
catalog route allowlist.
