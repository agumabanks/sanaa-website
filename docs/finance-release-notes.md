# Release Notes — Sanaa Finance

Date: 2025-09-11

Highlights

- Introduces `/finance` with dedicated nav, breadcrumbs, and pages (overview, pricing, cards, technologies, team, communities, compliance, resources, contact-sales, and more placeholders).
- Adds Admin → Finance (`/admin/finance`) with CRUD for pricing plans, cards, technologies, team, communities, and compliance.
- Implements Contact Sales form with email, Slack webhook, optional CRM webhook, honeypot + throttle, and success page.
- Adds `sitemap-finance.xml` and breadcrumb JSON-LD across Finance pages.
- Seeders create starter content (overview page, starter pricing plan).
- Pest tests cover key routes and form submission.

New ENV

- `FINANCE_SALES_EMAIL` — recipient for finance sales (default: `banks@sanaa.co`).
- `FINANCE_SALES_SLACK_WEBHOOK` — optional Slack webhook for notifications.
- `FINANCE_CRM_WEBHOOK` — optional CRM intake webhook.

Routes

- Public: `/finance`, `/finance/pricing`, `/finance/cards`, `/finance/technologies`, `/finance/team`, `/finance/communities`, `/finance/compliance`, `/finance/resources`, `/finance/contact-sales`, `/finance/search?q=`, `/finance/p/{slug}`.
- Admin: `/admin/finance` plus resource routes for pricing-plans, cards, technologies, team-members, communities, compliance-items.
- Sitemaps: `/sitemap-finance.xml` now linked from main `sitemap.xml`.

Security & Access

- Admin routes protected by `finance` middleware; supports Spatie roles or basic role columns.
- Strict file type validation for uploads; private disk for sensitive RFP files.

Upgrade Steps

1. Run migrations: `php artisan migrate`.
2. Seed initial content: `php artisan db:seed --class=DatabaseSeeder`.
3. Set ENV (see above) and mailer config.
4. Ensure users who need access have one of roles: `FinanceEditor`, `FinancePublisher`, `FinanceAdmin`.

