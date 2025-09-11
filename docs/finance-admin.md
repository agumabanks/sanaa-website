# Sanaa Finance — Admin Guide

Location: Admin → Finance (`/admin/finance`)

Roles allowed: `FinanceEditor`, `FinancePublisher`, `FinanceAdmin` (enforced by `finance` middleware).

Sections available:

- Pricing Plans: create/edit plans with features and limits.
- Cards: manage card products, fees, features, eligibility and attach T&Cs (PDF).
- Technologies: list rails/integrations with ordering.
- Team: manage team members and bios.
- Communities: segments with needs and value propositions.
- Compliance: standards with status and evidence.
- Analytics: simple counters (stub).

Publishing workflow:

- Pages use statuses (`draft`, `review`, `published`) and optional `scheduled_at` (DB). Drafts are visible to creators; published pages are public.
- Use the CMS Pages (coming soon via Filament) to build page content with blocks.

Security & uploads:

- Image uploads: PNG/JPG/GIF/SVG (where allowed). PDFs only for compliance/card T&Cs.
- Files are stored on the configured filesystem; sensitive uploads use `private` disk.

Contact Sales:

- Form at `/finance/contact-sales` emails `FINANCE_SALES_EMAIL` (default `banks@sanaa.co`), posts to `FINANCE_SALES_SLACK_WEBHOOK` if set, and optionally to `FINANCE_CRM_WEBHOOK`.
- Honeypot + throttle are enabled.

