# Sanaa Finance — Dev Notes

Stack: Laravel 11 (PHP 8.2+), Blade + Tailwind, minimal JS.

Key Paths

- Routes: `routes/web.php` under `Route::prefix('finance')` and `Route::prefix('admin/finance')`.
- Controllers: `app/Http/Controllers/FinanceController.php`, `FinanceContactController.php`, Admin controllers in `App\Http\Controllers\Admin\Finance`.
- Middleware: `app/Http/Middleware/FinanceMiddleware.php` (aliased as `finance` in `bootstrap/app.php`).
- Models: `app/Models/Finance*`.
- Migrations: `database/migrations/2025_*_create_finance_*`.
- Views (frontend): `resources/views/finance/*` using `layouts/finance.blade.php`.
- Views (admin): `resources/views/admin/finance/*` using `layouts/dashboard.blade.php`.
- Sitemaps: `SitemapController@finance` outputs `/sitemap-finance.xml`.

ENV

- `FINANCE_SALES_EMAIL` (default: `banks@sanaa.co`)
- `FINANCE_SALES_SLACK_WEBHOOK` (optional)
- `FINANCE_CRM_WEBHOOK` (optional)

Testing

- Pest tests under `tests/Feature/*Finance*Test.php`.
- PHPUnit uses sqlite `:memory:`.

Security

- CSRF is on by default; `finance` middleware enforces roles via Spatie if present, plus fallbacks.
- File allowlists enforced in validators (images and PDFs only).
- Contact form throttled and has honeypot.

Performance

- Minimal CSS/JS; Tailwind via Vite. Breadcrumb JSON-LD injected in partials.

Future work

- Add Filament v3 resources for all Finance collections with draft/preview/scheduling and activity logs (Spatie Activitylog) for diff/rollback.
- Add finance menus builder, testimonials, clients/resources/news full modules.
- Extract critical CSS and add analytics events.

