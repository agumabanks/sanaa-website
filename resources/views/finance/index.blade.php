@extends('layouts.finance', [
    'title' => 'Sanaa Finance SaaS — SACCO & MFI Management Software Uganda',
    'metaDescription' => 'Cloud-based financial management software for SACCOs, MFIs, and money lenders in Uganda and East Africa. Loan tracking, member management, repayment schedules, and reporting.',
    'breadcrumbs' => [ ['name' => 'Overview'] ],
])

@push('schema')
    <x-schema-product
        name="Sanaa Finance SaaS"
        description="Cloud-based financial management software for SACCOs, MFIs, and money lenders in Uganda and East Africa."
        url="https://sanaa.ug/finance"
        category="FinanceApplication" />
@endpush

@section('content')
{{-- Hero Section --}}
<section class="bg-gradient-to-br from-emerald-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="grid gap-12 lg:grid-cols-2 items-center">
            <div>
                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700 mb-4">
                    Built for Uganda
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold tracking-tight text-gray-900">
                    SACCO and MFI Management Software Built for Africa
                </h1>
                <p class="mt-6 text-lg text-gray-600 max-w-xl">
                    Sanaa Finance is the leading SACCO software Uganda trusts for loan tracking, member management, and regulatory reporting. Our cloud-based MFI loan management platform replaces spreadsheets with a cooperative management system East Africa can scale — from Kampala to Kinshasa. Built for SACCOs, microfinance institutions, money lenders, investment clubs, and schools that need clear repayment schedules, automated alerts, and Bank of Uganda-ready compliance.
                </p>
                <ul class="mt-6 grid grid-cols-2 gap-3 text-sm text-gray-700">
                    <li class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        No monthly fees
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Mobile Money integrated
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Same-day settlements
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-5 w-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Bank of Uganda compliant
                    </li>
                </ul>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('finance.contact-sales') }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600 text-white px-6 py-3 text-base font-semibold hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-500/25">
                        Get Started Free
                    </a>
                    <a href="{{ route('finance.pricing') }}" class="inline-flex items-center justify-center rounded-lg border-2 border-gray-200 px-6 py-3 text-base font-semibold text-gray-900 hover:bg-gray-50 transition-colors">
                        View Pricing
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="rounded-2xl bg-white shadow-2xl border border-gray-100 p-8">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <p class="text-sm text-gray-500">Today's Balance</p>
                            <p class="text-3xl font-bold text-gray-900">UGX 24,580,000</p>
                        </div>
                        <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-700">
                            +12.5%
                        </span>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-yellow-100 flex items-center justify-center">
                                    <span class="text-yellow-600 font-bold text-sm">MM</span>
                                </div>
                                <div>
                                    <p class="font-medium text-sm">MTN MoMo Collection</p>
                                    <p class="text-xs text-gray-500">Just now</p>
                                </div>
                            </div>
                            <span class="text-green-600 font-semibold">+850,000</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                    <span class="text-red-600 font-bold text-sm">AT</span>
                                </div>
                                <div>
                                    <p class="font-medium text-sm">Airtel Money Payout</p>
                                    <p class="text-xs text-gray-500">2 mins ago</p>
                                </div>
                            </div>
                            <span class="text-red-600 font-semibold">-125,000</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-emerald-100 flex items-center justify-center">
                                    <span class="text-emerald-600 font-bold text-sm">SK</span>
                                </div>
                                <div>
                                    <p class="font-medium text-sm">Soko24 Sale</p>
                                    <p class="text-xs text-gray-500">5 mins ago</p>
                                </div>
                            </div>
                            <span class="text-green-600 font-semibold">+1,250,000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Stats Section --}}
<section class="border-y border-gray-100 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <p class="text-2xl font-bold text-emerald-600">Loan tracking</p>
                <p class="mt-1 text-sm text-gray-600">Applications, approvals, disbursements, and arrears in one workflow</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-emerald-600">Member records</p>
                <p class="mt-1 text-sm text-gray-600">Profiles, KYC, savings, shares, and account history</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-emerald-600">Repayments</p>
                <p class="mt-1 text-sm text-gray-600">Schedules, reminders, penalties, and reconciliation</p>
            </div>
            <div>
                <p class="text-2xl font-bold text-emerald-600">Reporting</p>
                <p class="mt-1 text-sm text-gray-600">Portfolio visibility, exports, and compliance-ready records</p>
            </div>
        </div>
    </div>
</section>

{{-- Features Grid --}}
<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Your money, on your time</h2>
            <p class="mt-4 text-lg text-gray-600">Manage all your money in one place. Instantly access and spend your sales revenue. Automate everyday financial chores.</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Feature 1 --}}
            <div class="group relative bg-white rounded-2xl border border-gray-200 p-8 hover:shadow-xl hover:border-emerald-200 transition-all">
                <div class="h-12 w-12 rounded-xl bg-emerald-100 flex items-center justify-center mb-6">
                    <svg class="h-6 w-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Access Money Instantly</h3>
                <p class="text-gray-600">Keep member contributions, collections, and institution cash flow visible in one place so your team can act on current balances without waiting for manual reconciliation.</p>
                <a href="{{ route('finance.solutions') }}" class="mt-4 inline-flex items-center text-emerald-600 font-medium text-sm hover:text-emerald-700">
                    Explore Business Accounts
                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            {{-- Feature 2 --}}
            <div class="group relative bg-white rounded-2xl border border-gray-200 p-8 hover:shadow-xl hover:border-emerald-200 transition-all">
                <div class="h-12 w-12 rounded-xl bg-blue-100 flex items-center justify-center mb-6">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Budget Automatically</h3>
                <p class="text-gray-600">Plan ahead for future expenses. Automatically set aside part of your sales for URA taxes, NSSF contributions, business expenses, and savings goals.</p>
                <a href="{{ route('finance.solutions') }}" class="mt-4 inline-flex items-center text-emerald-600 font-medium text-sm hover:text-emerald-700">
                    Explore Savings Tools
                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            {{-- Feature 3 --}}
            <div class="group relative bg-white rounded-2xl border border-gray-200 p-8 hover:shadow-xl hover:border-emerald-200 transition-all">
                <div class="h-12 w-12 rounded-xl bg-purple-100 flex items-center justify-center mb-6">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Secure Business Loans</h3>
                <p class="text-gray-600">Weather the ups and downs of your business. Get custom loan offers based on your Sanaa Finance transaction history. No long forms, no collateral required for qualified businesses.</p>
                <a href="{{ route('finance.solutions') }}" class="mt-4 inline-flex items-center text-emerald-600 font-medium text-sm hover:text-emerald-700">
                    Explore Sanaa Loans
                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            {{-- Feature 4 --}}
            <div class="group relative bg-white rounded-2xl border border-gray-200 p-8 hover:shadow-xl hover:border-emerald-200 transition-all">
                <div class="h-12 w-12 rounded-xl bg-orange-100 flex items-center justify-center mb-6">
                    <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Sanaa Cards & Loyalty</h3>
                <p class="text-gray-600">Launch custom loyalty programs and reward systems. Issue physical and virtual cards that drive customer loyalty, automate rewards, and grow your client base.</p>
                <a href="{{ route('finance.cards') }}" class="mt-4 inline-flex items-center text-emerald-600 font-medium text-sm hover:text-emerald-700">
                    Explore Cards & Loyalty
                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            {{-- Feature 5 --}}
            <div class="group relative bg-white rounded-2xl border border-gray-200 p-8 hover:shadow-xl hover:border-emerald-200 transition-all">
                <div class="h-12 w-12 rounded-xl bg-pink-100 flex items-center justify-center mb-6">
                    <svg class="h-6 w-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Pay Bills & Suppliers</h3>
                <p class="text-gray-600">Get ahead of your bills. Use your sales to automatically pay suppliers, UMEME, NWSC, and other utilities on time, every time. Batch payments to multiple vendors.</p>
                <a href="{{ route('finance.solutions') }}" class="mt-4 inline-flex items-center text-emerald-600 font-medium text-sm hover:text-emerald-700">
                    Explore Bill Pay
                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            {{-- Feature 6 --}}
            <div class="group relative bg-white rounded-2xl border border-gray-200 p-8 hover:shadow-xl hover:border-emerald-200 transition-all">
                <div class="h-12 w-12 rounded-xl bg-teal-100 flex items-center justify-center mb-6">
                    <svg class="h-6 w-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-3">SACCO & Group Banking</h3>
                <p class="text-gray-600">Powerful tools for SACCOs, investment clubs, and chamas. Member management, share tracking, loan disbursement, and automated dividend calculations.</p>
                <a href="{{ route('finance.communities') }}" class="mt-4 inline-flex items-center text-emerald-600 font-medium text-sm hover:text-emerald-700">
                    Explore Group Solutions
                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Core ERP Capabilities --}}
<section class="py-16 md:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700 mb-4">ERP Capabilities</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Everything you need to run a financial institution</h2>
            <p class="mt-4 text-lg text-gray-600">From loan management to regulatory compliance — Sanaa Finance ERP covers every aspect of your financial operations.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Loan Management --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="h-10 w-10 rounded-lg bg-emerald-100 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Loan Management</h3>
                <ul class="space-y-1.5 text-sm text-gray-600">
                    <li>• Digital applications with approval workflows</li>
                    <li>• Reducing balance, flat & compound interest</li>
                    <li>• Automated arrears & penalty calculation</li>
                    <li>• Guarantor & collateral tracking</li>
                    <li>• Loan restructuring & top-ups</li>
                </ul>
            </div>

            {{-- Member Management --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="h-10 w-10 rounded-lg bg-blue-100 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Member & Customer Management</h3>
                <ul class="space-y-1.5 text-sm text-gray-600">
                    <li>• Complete profiles with KYC documents</li>
                    <li>• Credit scoring & payment behaviour</li>
                    <li>• Member self-service portal</li>
                    <li>• Bulk import from Excel/CSV</li>
                    <li>• Group lending & solidarity groups</li>
                </ul>
            </div>

            {{-- Accounting --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="h-10 w-10 rounded-lg bg-purple-100 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Accounting & Financial</h3>
                <ul class="space-y-1.5 text-sm text-gray-600">
                    <li>• Double-entry bookkeeping</li>
                    <li>• Balance sheet, P&L, cash flow</li>
                    <li>• Bank reconciliation</li>
                    <li>• Multi-currency support (UGX, USD, EUR)</li>
                    <li>• URA tax compliance ready</li>
                </ul>
            </div>

            {{-- Reports --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="h-10 w-10 rounded-lg bg-orange-100 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Reports & Analytics</h3>
                <ul class="space-y-1.5 text-sm text-gray-600">
                    <li>• 50+ built-in report types</li>
                    <li>• Portfolio at risk (PAR) analysis</li>
                    <li>• Branch performance comparison</li>
                    <li>• Export to PDF, Excel, CSV</li>
                    <li>• BOU-compliant regulatory reports</li>
                </ul>
            </div>

            {{-- Savings --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="h-10 w-10 rounded-lg bg-teal-100 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Savings & Deposits</h3>
                <ul class="space-y-1.5 text-sm text-gray-600">
                    <li>• Multiple savings products</li>
                    <li>• Fixed deposits with auto-renewal</li>
                    <li>• Shares management & dividends</li>
                    <li>• Mobile money deposits (MTN, Airtel)</li>
                    <li>• Automated interest calculations</li>
                </ul>
            </div>

            {{-- Security & Mobile --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-lg transition-shadow">
                <div class="h-10 w-10 rounded-lg bg-red-100 flex items-center justify-center mb-4">
                    <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Security & Integrations</h3>
                <ul class="space-y-1.5 text-sm text-gray-600">
                    <li>• Role-based access & 2FA</li>
                    <li>• Full audit trails & data encryption</li>
                    <li>• MTN MoMo & Airtel Money APIs</li>
                    <li>• PayPal, Stripe & Sanaa Cards</li>
                    <li>• Daily automatic backups & 99.9% uptime</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Solutions by Segment --}}
<section class="py-16 md:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Banking for every Ugandan business</h2>
            <p class="mt-4 text-lg text-gray-600">Purpose-built financial tools for the unique needs of Ugandan enterprises.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- SMEs --}}
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-12 w-12 rounded-lg bg-emerald-600 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">SMEs & Retailers</h3>
                <p class="text-gray-600 text-sm mb-4">Accept payments via Mobile Money, manage inventory financing, and get working capital loans to grow your business.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        POS integration
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Supplier payments
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        URA tax remittance
                    </li>
                </ul>
            </div>

            {{-- SACCOs --}}
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-12 w-12 rounded-lg bg-blue-600 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">SACCOs & Credit Unions</h3>
                <p class="text-gray-600 text-sm mb-4">Complete member management, savings accounts, loan lifecycle, and URBRA compliance reporting tools.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Member share tracking
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Loan origination & recovery
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        URBRA reports
                    </li>
                </ul>
            </div>

            {{-- Investment Clubs --}}
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-12 w-12 rounded-lg bg-purple-600 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Investment Clubs & Chamas</h3>
                <p class="text-gray-600 text-sm mb-4">Pool funds, track contributions, vote on investments, and distribute returns with full transparency.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Contribution tracking
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Investment voting
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Dividend distribution
                    </li>
                </ul>
            </div>

            {{-- Schools --}}
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-12 w-12 rounded-lg bg-orange-600 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Schools & Institutions</h3>
                <p class="text-gray-600 text-sm mb-4">Collect school fees via Mobile Money, manage staff payroll, and track expenses with parent-friendly receipts.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Fee collection portal
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Bulk payroll
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        SMS receipts to parents
                    </li>
                </ul>
            </div>

            {{-- Solo Entrepreneurs --}}
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="h-12 w-12 rounded-lg bg-pink-600 flex items-center justify-center mb-4">
                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Solo Entrepreneurs</h3>
                <p class="text-gray-600 text-sm mb-4">Separate business and personal finances, create professional invoices, and track income and expenses effortlessly.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Free business account
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Invoice generator
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Expense tracking
                    </li>
                </ul>
            </div>

            {{-- Soko24 Sellers --}}
            <div class="bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-shadow border-2 border-emerald-200">
                <div class="flex items-center gap-2 mb-4">
                    <div class="h-12 w-12 rounded-lg bg-emerald-600 flex items-center justify-center">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full">Integrated</span>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Soko24 Marketplace Sellers</h3>
                <p class="text-gray-600 text-sm mb-4">Connected to Soko24 marketplace data so sellers and member businesses can reconcile sales activity, financing needs, and account history in one workflow.</p>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Instant payouts
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Stock financing
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Sales analytics
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- Testimonials --}}
<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Trusted by Ugandan businesses</h2>
            <p class="mt-4 text-lg text-gray-600">See how businesses across Uganda are growing with Sanaa Finance.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gray-50 rounded-2xl p-8">
                <div class="flex items-center gap-1 mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <blockquote class="text-gray-700 mb-6">
                    "Sanaa Finance has transformed how we manage our SACCO. Member contributions via Mobile Money are automatic, and our loan recovery improved by 40%. The URBRA reports save us weeks of work."
                </blockquote>
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-semibold">JN</div>
                    <div>
                        <p class="font-medium text-gray-900">Joseph Nakamya</p>
                        <p class="text-sm text-gray-500">Manager, Kampala Teachers SACCO</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-2xl p-8">
                <div class="flex items-center gap-1 mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <blockquote class="text-gray-700 mb-6">
                    "As a Soko24 seller, instant payouts mean I can restock faster. The working capital loan helped me expand from 50 to 500 products. My business has grown 3x in just 6 months."
                </blockquote>
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-emerald-600 flex items-center justify-center text-white font-semibold">SA</div>
                    <div>
                        <p class="font-medium text-gray-900">Sarah Auma</p>
                        <p class="text-sm text-gray-500">Owner, Auma Electronics - Soko24</p>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-2xl p-8">
                <div class="flex items-center gap-1 mb-4">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <blockquote class="text-gray-700 mb-6">
                    "School fee collection used to be a nightmare. Now parents pay via MTN MoMo and Airtel Money directly. Automatic SMS receipts, no queues, no cash handling. Parents love it too!"
                </blockquote>
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-full bg-orange-600 flex items-center justify-center text-white font-semibold">PO</div>
                    <div>
                        <p class="font-medium text-gray-900">Peter Okello</p>
                        <p class="text-sm text-gray-500">Bursar, St. Mary's Secondary School, Jinja</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Pricing Preview --}}
<section class="py-16 md:py-24 bg-emerald-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Simple, transparent pricing</h2>
        <p class="text-emerald-100 text-lg mb-12 max-w-2xl mx-auto">No hidden fees. No long-term contracts. Start with our Starter package and scale as your business grows. All plans include mobile money integration.</p>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto text-left">
            {{-- Starter --}}
            <div class="bg-white/10 backdrop-blur rounded-xl p-6 border border-white/10">
                <p class="text-emerald-200 text-xs font-medium uppercase tracking-wide">Starter</p>
                <p class="text-3xl font-bold text-white mt-2">UGX 150K</p>
                <p class="text-emerald-200 text-sm">/month</p>
                <p class="text-emerald-100 text-xs mt-2">Setup: UGX 300,000</p>
                <ul class="mt-4 space-y-2 text-sm text-emerald-100">
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Up to 100 customers
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Basic loan management
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        100 SMS/month
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        10 report types
                    </li>
                </ul>
            </div>

            {{-- Professional --}}
            <div class="bg-white/10 backdrop-blur rounded-xl p-6 border border-white/10">
                <p class="text-emerald-200 text-xs font-medium uppercase tracking-wide">Professional</p>
                <p class="text-3xl font-bold text-white mt-2">UGX 200K</p>
                <p class="text-emerald-200 text-sm">/month</p>
                <p class="text-emerald-100 text-xs mt-2">Setup: UGX 500,000</p>
                <ul class="mt-4 space-y-2 text-sm text-emerald-100">
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Up to 500 customers
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Savings & deposits module
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        300 SMS/month
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        25+ report types
                    </li>
                </ul>
            </div>

            {{-- Business (Recommended) --}}
            <div class="bg-white rounded-xl p-6 border-2 border-emerald-300 relative shadow-xl">
                <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-white text-emerald-700 text-xs font-bold px-3 py-1 rounded-full shadow-sm border border-emerald-200">MOST POPULAR</span>
                <p class="text-emerald-700 text-xs font-medium uppercase tracking-wide">Business</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">UGX 350K</p>
                <p class="text-gray-500 text-sm">/month</p>
                <p class="text-gray-400 text-xs mt-2">Setup: UGX 800,000</p>
                <ul class="mt-4 space-y-2 text-sm text-gray-700">
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Up to 2,000 customers
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Full SACCO + WhatsApp
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        1,000 SMS/month
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Unlimited reports
                    </li>
                </ul>
            </div>

            {{-- Enterprise --}}
            <div class="bg-white/10 backdrop-blur rounded-xl p-6 border border-white/10">
                <p class="text-emerald-200 text-xs font-medium uppercase tracking-wide">Enterprise</p>
                <p class="text-3xl font-bold text-white mt-2">UGX 700K</p>
                <p class="text-emerald-200 text-sm">/month</p>
                <p class="text-emerald-100 text-xs mt-2">Setup: UGX 1,500,000</p>
                <ul class="mt-4 space-y-2 text-sm text-emerald-100">
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Unlimited + 5 branches
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Multi-branch management
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        5,000 SMS + API access
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="h-4 w-4 text-emerald-300 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Priority support
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-10 flex flex-wrap justify-center gap-4">
            <a href="{{ route('finance.pricing') }}" class="inline-flex items-center justify-center rounded-lg bg-white text-emerald-600 px-8 py-3 text-base font-semibold hover:bg-emerald-50 transition-colors">
                View Full Pricing
            </a>
            <a href="{{ route('finance.contact-sales') }}" class="inline-flex items-center justify-center rounded-lg border-2 border-white text-white px-8 py-3 text-base font-semibold hover:bg-white/10 transition-colors">
                Get a Free Demo
            </a>
        </div>
    </div>
</section>

{{-- Sanaa Finance ERP Systems --}}
<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700 mb-4">Complete ERP Solutions</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Enterprise-grade financial management</h2>
            <p class="mt-4 text-lg text-gray-600">Purpose-built ERP systems for SACCOs, microfinance institutions, money lenders, and financial cooperatives in Uganda.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
            {{-- SACCO Management System --}}
            <a href="https://soko.sanaa.ug/service/sanaa-finance-erp-system-complete-financial-management-solution-zi9mue" target="_blank" rel="noopener" class="group block bg-gradient-to-br from-emerald-50 to-white rounded-2xl border border-emerald-200 p-8 hover:shadow-2xl hover:border-emerald-300 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-12 w-12 rounded-xl bg-emerald-600 flex items-center justify-center">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full">Multi-Branch</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-emerald-600 transition-colors">Sanaa SACCO Management System</h3>
                <p class="text-gray-600 text-sm mb-4">Complete multi-branch loan & savings solution for SACCOs, MFIs, credit unions, and village savings groups. Manage members, loans, savings, and compliance from one platform.</p>
                <ul class="space-y-2 text-sm text-gray-600 mb-6">
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Loan management & member portal
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        MTN MoMo & Airtel Money integration
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-emerald-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        50+ reports & BOU compliance
                    </li>
                </ul>
                <span class="inline-flex items-center text-emerald-600 font-semibold text-sm group-hover:underline">
                    View plans from UGX 250,000/mo
                    <svg class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </span>
            </a>

            {{-- Finance ERP System --}}
            <a href="https://soko.sanaa.ug/service/sanaa-finance-erp-system-complete-financial-management-solution-ir8wgd" target="_blank" rel="noopener" class="group block bg-gradient-to-br from-blue-50 to-white rounded-2xl border border-blue-200 p-8 hover:shadow-2xl hover:border-blue-300 transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-12 w-12 rounded-xl bg-blue-600 flex items-center justify-center">
                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-medium bg-blue-100 text-blue-700 px-2 py-1 rounded-full">All-in-One</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">Sanaa Finance ERP System</h3>
                <p class="text-gray-600 text-sm mb-4">Complete financial management solution for money lenders, SACCOs, and microfinance institutions. Loans, accounting, payments, and analytics in one powerful platform.</p>
                <ul class="space-y-2 text-sm text-gray-600 mb-6">
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Full accounting & financial statements
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Loan origination & repayment tracking
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Mobile money & payment gateway integration
                    </li>
                </ul>
                <span class="inline-flex items-center text-blue-600 font-semibold text-sm group-hover:underline">
                    View plans from UGX 150,000/mo
                    <svg class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </span>
            </a>
        </div>
    </div>
</section>

{{-- SMS & WhatsApp Alerts --}}
<section class="py-16 md:py-24 bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-flex items-center rounded-full bg-emerald-500/20 px-3 py-1 text-xs font-medium text-emerald-400 mb-4">Instant Notifications</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">SMS & WhatsApp alerts that keep you in control</h2>
                <p class="text-lg text-gray-400 mb-8">Never miss a transaction. Get instant SMS and WhatsApp notifications for every deposit, withdrawal, loan repayment, and account activity — delivered straight to your phone.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('finance.contact-sales') }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600 text-white px-6 py-3 text-sm font-semibold hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-500/25">
                        Enable Alerts for Your Business
                    </a>
                    <a href="https://soko.sanaa.ug/service/sanaa-finance-erp-system-complete-financial-management-solution-zi9mue" target="_blank" rel="noopener" class="inline-flex items-center justify-center rounded-lg border border-white/20 text-white px-6 py-3 text-sm font-semibold hover:bg-white/10 transition-colors">
                        See Full ERP Features
                    </a>
                </div>
            </div>
            <div class="grid sm:grid-cols-2 gap-4">
                {{-- SMS Alerts --}}
                <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                    <div class="h-10 w-10 rounded-lg bg-emerald-500/20 flex items-center justify-center mb-4">
                        <svg class="h-5 w-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">SMS Alerts</h3>
                    <p class="text-gray-400 text-sm">Instant SMS on deposits, withdrawals, loan approvals, repayment reminders & overdue alerts.</p>
                </div>

                {{-- WhatsApp Alerts --}}
                <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                    <div class="h-10 w-10 rounded-lg bg-green-500/20 flex items-center justify-center mb-4">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">WhatsApp Notifications</h3>
                    <p class="text-gray-400 text-sm">Rich WhatsApp messages with transaction details, statements & customer communication.</p>
                </div>

                {{-- Loan Reminders --}}
                <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                    <div class="h-10 w-10 rounded-lg bg-yellow-500/20 flex items-center justify-center mb-4">
                        <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">Auto Repayment Reminders</h3>
                    <p class="text-gray-400 text-sm">Automated 7-day, 3-day & 1-day reminders before loan due dates. Overdue alerts included.</p>
                </div>

                {{-- Multi-Gateway --}}
                <div class="bg-white/5 border border-white/10 rounded-xl p-6">
                    <div class="h-10 w-10 rounded-lg bg-purple-500/20 flex items-center justify-center mb-4">
                        <svg class="h-5 w-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-white font-semibold mb-2">4 SMS Gateways</h3>
                    <p class="text-gray-400 text-sm">Nexmo, Twilio, Africa's Talking & Trust SMS. Choose the best fit for your business.</p>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- CTA Section --}}
<section class="py-16 md:py-24 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Ready to take control of your finances?</h2>
        <p class="text-lg text-gray-600 mb-8">Join thousands of Ugandan businesses already using Sanaa Finance. Get started in minutes.</p>
        
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('finance.contact-sales') }}" class="inline-flex items-center justify-center rounded-lg bg-emerald-600 text-white px-8 py-3 text-base font-semibold hover:bg-emerald-700 transition-colors shadow-lg shadow-emerald-500/25">
                Open Free Account
            </a>
            <a href="{{ route('finance.contact-sales') }}" class="inline-flex items-center justify-center rounded-lg border-2 border-gray-300 px-8 py-3 text-base font-semibold text-gray-700 hover:bg-white transition-colors">
                Talk to Sales
            </a>
        </div>

        <div class="mt-12 flex flex-wrap items-center justify-center gap-x-8 gap-y-4 text-sm text-gray-500">
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Bank of Uganda Regulated
            </div>
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                PCI-DSS Compliant
            </div>
            <div class="flex items-center gap-2">
                <svg class="h-5 w-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                Local Support
            </div>
        </div>
    </div>
</section>

{{-- Latest Finance Pages --}}
@if($pages->isNotEmpty())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h2 class="text-2xl font-bold text-gray-900 mb-8">Resources & Guides</h2>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($pages as $p)
            <a href="{{ route('finance.show', ['page' => $p->slug]) }}" class="group block bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg hover:border-emerald-200 transition-all">
                <h3 class="font-semibold text-gray-900 group-hover:text-emerald-600 transition-colors">{{ $p->title }}</h3>
                <p class="text-sm text-gray-600 line-clamp-2 mt-2">{{ $p->meta_description ?? 'Learn more about Sanaa Finance' }}</p>
                <span class="mt-4 inline-flex items-center text-emerald-600 font-medium text-sm">
                    Read more
                    <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </span>
            </a>
        @endforeach
    </div>
</section>
@endif
@endsection
