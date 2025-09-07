<?php

return [
    'meta' => [
        'title' => 'Why Sanaa — Sell, finance, and grow on one platform',
        'description' => 'Sanaa unifies payments, BNPL, POS, marketing, and devices so African businesses can sell, fund growth, and scale—fast.',
        'og_image' => '/og/why-sanaa-default.jpg',
        'canonical' => url('/why-sanaa'),
        'brand' => [
            'name' => 'Sanaa',
            'url' => url('/'),
            'logo' => cdn_asset('storage/images/sanaa.png'),
        ],
    ],
    'hero' => [
        'title' => 'Why Sanaa',
        'subhead' => 'One platform to sell, finance, and grow—built for African businesses.',
        'blurb' => 'Sanaa connects your sales, customers, and capital so you can focus on growth—not busywork.',
        'bullets' => [
            'Take payments online & in-person',
            'Offer BNPL safely',
            'Manage inventory & POS',
            'Reach customers via Sanaa Media',
            'Finance devices & growth with Sanaa Finance',
        ],
    ],
    'logos' => [
        '/why-sanaa/logo-1.svg','/why-sanaa/logo-2.svg','/why-sanaa/logo-3.svg',
        '/why-sanaa/logo-4.svg','/why-sanaa/logo-5.svg','/why-sanaa/logo-6.svg',
    ],
    'capabilities' => [
        ['title' => 'Payments & POS','icon' => '🧾','copy' => 'Accept mobile money and card payments across channels. Reconcile instantly and settle fast. Works with Soko24 POS.'],
        ['title' => 'Online Store & Marketplace','icon' => '🛍️','copy' => 'Launch a storefront on Soko24 in hours. Sync inventory, orders, and delivery in one place.'],
        ['title' => 'BNPL & Lending Rails','icon' => '💳','copy' => 'Offer device financing and pay-later safely with built-in risk controls and approvals.'],
        ['title' => 'Customer Marketing','icon' => '📣','copy' => 'Reach buyers via Sanaa Media—emails, SMS, and placements that drive repeat purchases.'],
        ['title' => 'Education OS (EdOS)','icon' => '🎓','copy' => 'Fees, parent portals, and device programs for schools and universities—built for Africa.'],
        ['title' => 'Hardware & Devices','icon' => '💻','copy' => 'Laptops, POS terminals, and peripherals—tested for Sanaa and deployable at scale.'],
        ['title' => 'Staff & Branches','icon' => '👥','copy' => 'Roles, approvals, and audit trails. Operate branches confidently with separation of duties.'],
        ['title' => 'Reporting & Compliance','icon' => '📊','copy' => 'Exports, audit logs, and regulatory-ready records. Your data, always portable.'],
    ],
    'industries' => [
        'Money Lenders & Microfinance' => [
            'outcomes' => [
                'Launch BNPL with credit controls',
                'Automate KYC and approvals',
                'Reduce defaults with reminders',
                'Track devices and repayments',
            ],
            'case' => '↑ financed orders; ↓ days-to-approval'
        ],
        'SACCOs & Investment Clubs' => [
            'outcomes' => [
                'Digital member onboarding',
                'Flexible share & savings products',
                'Dividends and statements in one click',
            ],
            'case' => '↑ active members; ↓ back-office time'
        ],
        'Retail & Wholesale' => [
            'outcomes' => ['Fast POS and stock sync','Multi-branch control','Cashless and cash workflows'],
            'case' => '↑ conversion; ↑ repeat purchases'
        ],
        'Education (schools, universities)' => [
            'outcomes' => ['Fees collection & reconciliation','Device programs with BNPL','Parent communications built-in'],
            'case' => '↓ arrears; ↑ on-time payments'
        ],
        'Health & Services' => [
            'outcomes' => ['Bookings and invoicing','Device financing for staff','Secure records and permissions'],
            'case' => '↓ admin time; ↑ utilization'
        ],
    ],
    'kpis' => ['↑ conversion','↓ ops time','↑ repeat purchases','↑ financed orders'],
    'testimonials' => [
        ['quote' => 'Sanaa helped us launch pay‑later devices in weeks, not months.','name' => 'Finance Partner','role' => 'CEO'],
        ['quote' => 'Our branches finally run on one system. Recon is a non‑issue.','name' => 'Retailer','role' => 'Operations Lead'],
        ['quote' => 'Parents pay on time, and our team saves hours each week.','name' => 'School','role' => 'Bursar'],
    ],
    'faqs' => [
        ['q' => 'How does BNPL stay safe?', 'a' => 'We use approvals, limits, and repayment controls. You set rules, we enforce them.'],
        ['q' => 'Can we finance devices?', 'a' => 'Yes. Offer device financing with escrow and recovery workflows.'],
        ['q' => 'How fast are settlements?', 'a' => 'Most mobile money settles same or next business day.'],
        ['q' => 'Do you support POS hardware?', 'a' => 'Yes. We supply and support terminals and peripherals ready for Sanaa.'],
        ['q' => 'What about mobile money?', 'a' => 'We support major providers in Uganda and the EAC.'],
        ['q' => 'Do you integrate with our systems?', 'a' => 'We offer APIs and exports. Start simple; integrate as you grow.'],
        ['q' => 'Support hours?', 'a' => 'Business hours with priority SLAs on paid plans.'],
        ['q' => 'Is my data portable?', 'a' => 'Yes. Export anytime. Your data stays yours.'],
    ],
];

