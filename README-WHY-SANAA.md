# Why Sanaa page

Location: `resources/views/pages/why-sanaa.blade.php`

Copy/config: `resources/content/why-sanaa.php`
- Update meta, hero, logos, capability blurbs, industries, KPIs, testimonials, FAQs in this file.
- Logos are in `public/why-sanaa/`. Replace the placeholder SVGs with your partners’ logos (keep sizes small and optimized).

Route: `/why-sanaa` → defined in `routes/web.php` and `PageController::whySanaa()`.

Assets:
- OG image: `public/og/why-sanaa-default.jpg` (replace with a 1200×630 JPG).

SEO & JSON‑LD:
- Title, meta description, canonical, Open Graph, Twitter card are server‑rendered.
- JSON‑LD for WebSite, Organization, and FAQPage is embedded.

CTAs:
- `data-cta="get-started"` and `data-cta="contact-sales"` are attached for analytics.
- “Contact sales” opens a modal posting to `route('contact.store')`.

Performance:
- Images lazy‑load via `loading="lazy"` where applicable.
- Tailwind + minimal JS, generous whitespace.

Notes:
- This page is server‑rendered (Laravel + Blade). If you later migrate to Next.js, port the content object and section layout 1:1. Keep links and data-cta attributes.
