<?php

namespace Database\Seeders;

use App\Models\FinancePage;
use App\Models\FinancePricingPlan;
use App\Models\FinanceCard;
use App\Models\FinanceTechnology;
use App\Models\FinanceCommunity;
use App\Models\FinanceTeamMember;
use App\Models\FinanceComplianceItem;
use Illuminate\Database\Seeder;

class FinanceSeeder extends Seeder
{
    public function run(): void
    {
        // Pricing plans with UGX pricing for Ugandan market
        FinancePricingPlan::truncate();
        $plans = [
            [
                'name' => 'Starter',
                'summary' => 'Perfect for solo entrepreneurs and small businesses just getting started',
                'monthly_price' => 0,
                'annual_price' => 0,
                'features' => [
                    'Free business account',
                    'MTN MoMo & Airtel Money collections',
                    'Up to 50 transactions/month free',
                    'Basic invoicing',
                    'Mobile app access',
                    'Email support',
                ],
                'limits' => ['50 free transactions/month', '1 user', 'Basic reports'],
                'badge' => null,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Growth',
                'summary' => 'For growing SMEs, retailers, and Soko24 sellers who need more power',
                'monthly_price' => 75000, // UGX 75,000
                'annual_price' => 750000, // UGX 750,000 (save 2 months)
                'features' => [
                    'Everything in Starter',
                    'Unlimited transactions',
                    'Physical & virtual Sanaa Cards',
                    'Bulk payouts to suppliers',
                    'Automated tax (URA) remittance',
                    'Multi-user access (up to 5)',
                    'Soko24 integration',
                    'Priority WhatsApp support',
                ],
                'limits' => ['Unlimited transactions', '5 users', 'Advanced reports'],
                'badge' => 'Most Popular',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Business',
                'summary' => 'For established businesses with higher volumes and complex needs',
                'monthly_price' => 250000, // UGX 250,000
                'annual_price' => 2500000, // UGX 2,500,000
                'features' => [
                    'Everything in Growth',
                    'Dedicated account manager',
                    'Custom card designs',
                    'API access for integrations',
                    'Expense management tools',
                    'Multi-branch support',
                    'Up to 20 team members',
                    'Working capital loans eligibility',
                    'Phone support',
                ],
                'limits' => ['Unlimited everything', '20 users', 'Custom reports'],
                'badge' => null,
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'SACCO Pro',
                'summary' => 'Complete solution for SACCOs, investment clubs, and cooperative societies',
                'monthly_price' => 500000, // UGX 500,000
                'annual_price' => 5000000, // UGX 5,000,000
                'features' => [
                    'Member management system',
                    'Share capital tracking',
                    'Loan origination & management',
                    'Automated loan recovery',
                    'Dividend calculation & distribution',
                    'Mobile Money collection for members',
                    'URBRA compliance reports',
                    'AGM voting system',
                    'Member mobile app',
                    'Unlimited members',
                    'Dedicated support team',
                ],
                'limits' => ['Unlimited members', 'Full SACCO features', 'Compliance ready'],
                'badge' => 'For SACCOs',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Enterprise',
                'summary' => 'Custom solutions for large institutions, schools, and corporations',
                'monthly_price' => null,
                'annual_price' => null,
                'features' => [
                    'Everything in Business/SACCO Pro',
                    'Custom integrations',
                    'On-premise deployment option',
                    'SLA guarantees (99.9% uptime)',
                    'Dedicated infrastructure',
                    'White-label options',
                    'Custom compliance packages',
                    'Training & onboarding',
                    '24/7 phone support',
                ],
                'limits' => ['Custom limits', 'Unlimited users', 'Enterprise SLA'],
                'badge' => 'Contact Us',
                'sort_order' => 5,
                'is_active' => true,
            ],
        ];
        foreach ($plans as $p) { FinancePricingPlan::create($p); }

        // Overview page with comprehensive content
        FinancePage::updateOrCreate(['slug' => 'overview'], [
            'title' => 'Sanaa Finance: Banking Where African Businesses Thrive',
            'content' => ['blocks' => [
                ['type' => 'richtext', 'html' => '<h2>Welcome to Sanaa Finance</h2><p>Sanaa Finance is Uganda\'s leading digital banking platform built specifically for SMEs, SACCOs, investment clubs, schools, and solo entrepreneurs. We understand the unique challenges of running a business in Uganda and have designed our platform to help you succeed.</p>'],
                ['type' => 'richtext', 'html' => '<h3>What We Offer</h3><ul><li><strong>Digital Wallets:</strong> Accept payments via MTN Mobile Money, Airtel Money, and bank transfers</li><li><strong>Instant Payments:</strong> Pay suppliers, staff, and utilities in seconds</li><li><strong>Savings & Investments:</strong> Earn competitive interest on idle funds</li><li><strong>Business Loans:</strong> Access working capital based on your transaction history</li><li><strong>Sanaa Cards:</strong> Physical and virtual cards for business expenses</li></ul>'],
                ['type' => 'richtext', 'html' => '<h3>Built for Uganda</h3><p>We integrate seamlessly with MTN MoMo, Airtel Money, and the Soko24 marketplace. Our platform is compliant with Bank of Uganda regulations and provides tools for URA tax remittance, NSSF contributions, and URBRA reporting for SACCOs.</p>'],
            ]],
            'status' => 'published',
            'seo_title' => 'Sanaa Finance: Digital Banking for Ugandan Businesses',
            'meta_description' => 'Discover Sanaa Finance: digital wallets, instant payments, savings & investments, loans and Sanaa Cards for African businesses.',
        ]);

        // Additional informational pages
        FinancePage::updateOrCreate(['slug' => 'mobile-money-integration'], [
            'title' => 'Mobile Money Integration',
            'content' => ['blocks' => [
                ['type' => 'richtext', 'html' => '<h2>Seamless Mobile Money Integration</h2><p>Accept payments from your customers via MTN Mobile Money and Airtel Money directly into your Sanaa Finance account. Instant settlement means your money is available immediately.</p>'],
                ['type' => 'richtext', 'html' => '<h3>Collection Features</h3><ul><li>Generate payment links and QR codes</li><li>USSD collection codes for offline payments</li><li>Bulk collection for schools and SACCOs</li><li>Automated reconciliation</li><li>Real-time SMS notifications</li></ul>'],
                ['type' => 'richtext', 'html' => '<h3>Payout Features</h3><ul><li>Single and bulk payouts</li><li>Scheduled payments</li><li>Supplier payment automation</li><li>Payroll disbursement</li><li>Flat UGX 500 fee per payout</li></ul>'],
            ]],
            'status' => 'published',
            'seo_title' => 'Mobile Money Integration - MTN MoMo & Airtel Money',
            'meta_description' => 'Accept MTN Mobile Money and Airtel Money payments instantly with Sanaa Finance. Seamless integration for Ugandan businesses.',
        ]);

        FinancePage::updateOrCreate(['slug' => 'sacco-management'], [
            'title' => 'SACCO Management System',
            'content' => ['blocks' => [
                ['type' => 'richtext', 'html' => '<h2>Complete SACCO Management Solution</h2><p>Sanaa Finance provides a comprehensive platform for Savings and Credit Cooperative Organizations (SACCOs) in Uganda. Manage members, shares, loans, and compliance all in one place.</p>'],
                ['type' => 'richtext', 'html' => '<h3>Member Management</h3><ul><li>Digital member registration with KYC</li><li>Share capital tracking</li><li>Contribution collection via Mobile Money</li><li>Member statements and passbooks</li><li>Mobile app for members</li></ul>'],
                ['type' => 'richtext', 'html' => '<h3>Loan Management</h3><ul><li>Loan application and approval workflows</li><li>Interest calculation (reducing balance, flat rate)</li><li>Automated loan recovery from Mobile Money</li><li>Guarantor management</li><li>Defaulter tracking and notifications</li></ul>'],
                ['type' => 'richtext', 'html' => '<h3>URBRA Compliance</h3><ul><li>Automated regulatory reports</li><li>Financial statements generation</li><li>Audit trail for all transactions</li><li>Annual return preparation</li></ul>'],
            ]],
            'status' => 'published',
            'seo_title' => 'SACCO Management System Uganda - Sanaa Finance',
            'meta_description' => 'Complete SACCO management software for Ugandan cooperatives. Member management, loans, URBRA compliance reports.',
        ]);

        FinancePage::updateOrCreate(['slug' => 'school-fee-collection'], [
            'title' => 'School Fee Collection System',
            'content' => ['blocks' => [
                ['type' => 'richtext', 'html' => '<h2>Digital School Fee Collection</h2><p>Make school fee collection effortless for both your institution and parents. Accept payments via Mobile Money with automatic reconciliation and instant receipts.</p>'],
                ['type' => 'richtext', 'html' => '<h3>Features for Schools</h3><ul><li>Student database management</li><li>Fee structure configuration by class/term</li><li>Payment tracking per student</li><li>Automatic SMS receipts to parents</li><li>Outstanding balance reminders</li><li>Financial reports by term/class</li></ul>'],
                ['type' => 'richtext', 'html' => '<h3>Convenient for Parents</h3><ul><li>Pay via MTN MoMo or Airtel Money</li><li>No need to visit school premises</li><li>Instant payment confirmation</li><li>View payment history on mobile</li><li>Partial payments supported</li></ul>'],
            ]],
            'status' => 'published',
            'seo_title' => 'School Fee Collection System Uganda',
            'meta_description' => 'Digital school fee collection via Mobile Money. Automatic receipts, student tracking, and financial reports for Ugandan schools.',
        ]);

        FinancePage::updateOrCreate(['slug' => 'business-loans'], [
            'title' => 'Sanaa Business Loans',
            'content' => ['blocks' => [
                ['type' => 'richtext', 'html' => '<h2>Working Capital When You Need It</h2><p>Get access to business loans based on your Sanaa Finance transaction history. No collateral required for qualified businesses. Fast approval, instant disbursement.</p>'],
                ['type' => 'richtext', 'html' => '<h3>Loan Features</h3><ul><li>Loans from UGX 500,000 to UGX 50,000,000</li><li>Repayment terms: 1-12 months</li><li>No collateral for qualified sellers</li><li>Decision within 24 hours</li><li>Instant disbursement to your account</li><li>Automated repayment from sales</li></ul>'],
                ['type' => 'richtext', 'html' => '<h3>Who Qualifies?</h3><ul><li>Active Sanaa Finance users (3+ months)</li><li>Consistent transaction history</li><li>Soko24 sellers with good track record</li><li>SACCOs and investment clubs</li></ul>'],
            ]],
            'status' => 'published',
            'seo_title' => 'Business Loans Uganda - Sanaa Finance',
            'meta_description' => 'Get working capital loans for your Ugandan business. No collateral, fast approval, automatic repayment from sales.',
        ]);

        // Cards with Uganda-specific details
        FinanceCard::truncate();
        $cards = [
            [
                'name' => 'Sanaa Business Debit Card',
                'features' => [
                    'Instant issuance',
                    'Works at any Visa ATM in Uganda',
                    'Online & in-store payments',
                    'Contactless (tap to pay)',
                    'Real-time spending alerts',
                    'Freeze/unfreeze via app',
                    'Works with Stanbic, Centenary, dfcu ATMs',
                ],
                'fees' => [
                    'Card Issuance' => 'UGX 25,000',
                    'Monthly Fee' => 'UGX 0',
                    'ATM Withdrawal (Uganda)' => 'UGX 2,500',
                    'ATM Withdrawal (International)' => '3%',
                    'POS Transactions' => 'Free',
                    'Online Transactions' => 'Free',
                    'FX Markup' => '2.5%',
                ],
                'eligibility' => 'Available to all Growth, Business, and Enterprise plan users. Valid Ugandan National ID required.',
                'status' => 'published',
            ],
            [
                'name' => 'Sanaa Virtual Card',
                'features' => [
                    'Create instantly in the app',
                    'Perfect for online purchases',
                    'Single-use or recurring options',
                    'Custom spending limits',
                    'Auto-lock after transaction',
                    'Great for subscriptions (AWS, Google, etc.)',
                    'Multiple cards per account',
                ],
                'fees' => [
                    'Card Creation' => 'Free',
                    'Monthly Fee' => 'UGX 0',
                    'Online Transactions' => 'Free',
                    'FX Markup' => '2.5%',
                    'Card Replacement' => 'Free',
                ],
                'eligibility' => 'Available to all Sanaa Finance users on any plan.',
                'status' => 'published',
            ],
            [
                'name' => 'Sanaa Staff Expense Card',
                'features' => [
                    'Issue cards to employees',
                    'Set spending limits per card',
                    'Category restrictions (fuel only, etc.)',
                    'Real-time expense tracking',
                    'Receipt capture via mobile',
                    'Automatic expense reports',
                    'Instant freeze for lost cards',
                ],
                'fees' => [
                    'Card Issuance' => 'UGX 15,000/card',
                    'Monthly Fee' => 'UGX 0',
                    'All Transactions' => 'Free',
                    'Minimum Cards' => '5 cards',
                ],
                'eligibility' => 'Available to Business and Enterprise plan users with 5+ employees.',
                'status' => 'published',
            ],
        ];
        foreach ($cards as $c) { FinanceCard::create($c); }

        // Technologies with Uganda context
        FinanceTechnology::truncate();
        $technologies = [
            ['name' => 'MTN Mobile Money', 'description' => 'Uganda\'s largest mobile money network with 15M+ users', 'is_active' => true, 'sort_order' => 1],
            ['name' => 'Airtel Money', 'description' => 'Fast-growing mobile money platform in Uganda', 'is_active' => true, 'sort_order' => 2],
            ['name' => 'Visa', 'description' => 'Global card network accepted at 70M+ merchants worldwide', 'is_active' => true, 'sort_order' => 3],
            ['name' => 'Bank of Uganda RTGS', 'description' => 'Real-time gross settlement for large value transfers', 'is_active' => true, 'sort_order' => 4],
            ['name' => 'UG-EFT', 'description' => 'Uganda Electronic Funds Transfer for local bank transfers', 'is_active' => true, 'sort_order' => 5],
            ['name' => 'PCI-DSS Level 1', 'description' => 'Highest level of payment card security compliance', 'is_active' => true, 'sort_order' => 6],
            ['name' => 'ISO 27001', 'description' => 'International information security management standard', 'is_active' => true, 'sort_order' => 7],
            ['name' => 'ISO 20022', 'description' => 'International standard for financial messaging', 'is_active' => true, 'sort_order' => 8],
        ];
        foreach ($technologies as $t) { FinanceTechnology::create($t); }

        // Communities for Ugandan market segments
        FinanceCommunity::truncate();
        $communities = [
            [
                'segment_name' => 'SMEs & Retailers',
                'needs' => [
                    'Accept Mobile Money payments',
                    'Pay suppliers efficiently',
                    'Access working capital',
                    'Manage cash flow',
                    'URA tax compliance',
                ],
                'value_props' => [
                    'No monthly fees on Starter plan',
                    '1.5% collection fee (lowest in Uganda)',
                    'Same-day settlements',
                    'Business loans from UGX 500K',
                    'Free business account',
                ],
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'segment_name' => 'SACCOs & Credit Unions',
                'needs' => [
                    'Member account management',
                    'Share capital tracking',
                    'Loan origination & recovery',
                    'URBRA compliance reporting',
                    'Dividend distribution',
                ],
                'value_props' => [
                    'Complete SACCO management system',
                    'Mobile Money collection for members',
                    'Automated loan recovery',
                    'URBRA-ready reports',
                    'Member mobile app included',
                ],
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'segment_name' => 'Investment Clubs & Chamas',
                'needs' => [
                    'Pool funds from members',
                    'Track contributions',
                    'Vote on investments',
                    'Distribute returns fairly',
                    'Transparent record keeping',
                ],
                'value_props' => [
                    'Group account with multi-signatory',
                    'Contribution tracking & reminders',
                    'Investment voting via app',
                    'Automated profit sharing',
                    'Full audit trail',
                ],
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'segment_name' => 'Schools & Educational Institutions',
                'needs' => [
                    'Collect school fees digitally',
                    'Track payments per student',
                    'Pay staff salaries',
                    'Manage supplier payments',
                    'Generate financial reports',
                ],
                'value_props' => [
                    'Mobile Money fee collection',
                    'Automatic SMS receipts to parents',
                    'Student balance tracking',
                    'Bulk salary disbursement',
                    'Term-wise financial reports',
                ],
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'segment_name' => 'Solo Entrepreneurs & Freelancers',
                'needs' => [
                    'Separate business from personal',
                    'Professional invoicing',
                    'Accept payments easily',
                    'Track income & expenses',
                    'Build credit history',
                ],
                'value_props' => [
                    'Free business account forever',
                    'Invoice generator included',
                    'Payment links & QR codes',
                    'Expense categorization',
                    'Qualify for loans based on activity',
                ],
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'segment_name' => 'Soko24 Marketplace Sellers',
                'needs' => [
                    'Instant access to sales revenue',
                    'Finance inventory purchases',
                    'Understand sales performance',
                    'Scale business operations',
                    'Manage multiple product lines',
                ],
                'value_props' => [
                    'Instant settlement of Soko24 sales',
                    'Inventory financing loans',
                    'Sales analytics dashboard',
                    'Automatic tax calculations',
                    'Priority seller support',
                ],
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];
        foreach ($communities as $c) { FinanceCommunity::create($c); }

        // Team members
        FinanceTeamMember::truncate();
        $team = [
            ['name' => 'Finance Product Team', 'role' => 'Product Development', 'is_active' => true, 'sort_order' => 1],
            ['name' => 'Risk & Compliance', 'role' => 'Regulatory Compliance & Risk Management', 'is_active' => true, 'sort_order' => 2],
            ['name' => 'Partnerships', 'role' => 'Mobile Money & Banking Partnerships', 'is_active' => true, 'sort_order' => 3],
            ['name' => 'Customer Success', 'role' => 'SME & SACCO Onboarding', 'is_active' => true, 'sort_order' => 4],
        ];
        foreach ($team as $t) { FinanceTeamMember::create($t); }

        // Compliance items (status enum: pending, in-progress, achieved)
        if (class_exists(FinanceComplianceItem::class)) {
            FinanceComplianceItem::truncate();
            $compliance = [
                [
                    'standard' => 'Bank of Uganda Payment Systems License',
                    'status' => 'achieved',
                    'is_active' => true,
                    'last_updated' => now(),
                ],
                [
                    'standard' => 'KYC & AML Compliance',
                    'status' => 'achieved',
                    'is_active' => true,
                    'last_updated' => now(),
                ],
                [
                    'standard' => 'PCI-DSS Level 1',
                    'status' => 'achieved',
                    'is_active' => true,
                    'last_updated' => now(),
                ],
                [
                    'standard' => 'Data Protection (Uganda PDPA)',
                    'status' => 'achieved',
                    'is_active' => true,
                    'last_updated' => now(),
                ],
                [
                    'standard' => 'URBRA Tier 4 MFI Regulations',
                    'status' => 'achieved',
                    'is_active' => true,
                    'last_updated' => now(),
                ],
            ];
            foreach ($compliance as $c) { FinanceComplianceItem::create($c); }
        }
    }
}

