@extends('layouts.finance', [
    'title' => 'Solutions — Sanaa Finance',
    'metaDescription' => 'Financial solutions for Ugandan businesses: SME banking, SACCO management, school fee collection, investment clubs, and Soko24 seller tools.',
    'breadcrumbs' => [['name'=>'Solutions']]
])
@section('content')
{{-- Hero --}}
<section class="bg-gradient-to-br from-emerald-50 to-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900">Financial Solutions for Every Business</h1>
        <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">Purpose-built tools for the unique needs of Ugandan SMEs, SACCOs, schools, investment clubs, and solo entrepreneurs.</p>
    </div>
</section>

{{-- Solutions Grid --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="space-y-16">
        
        {{-- Business Accounts --}}
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700 mb-4">For All Businesses</span>
                <h2 class="text-3xl font-bold text-gray-900">Business Accounts</h2>
                <p class="mt-4 text-gray-600">Open a free business account in minutes. Accept payments via MTN MoMo, Airtel Money, and bank transfers. Get instant access to your funds.</p>
                <ul class="mt-6 space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>No monthly fees</strong> - Free forever on Starter plan</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Instant settlements</strong> - Money available immediately</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Mobile app</strong> - Manage everything from your phone</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Tax ready</strong> - Export reports for URA compliance</span>
                    </li>
                </ul>
                <a href="{{ route('finance.contact-sales') }}" class="mt-6 inline-flex items-center text-emerald-600 font-semibold hover:text-emerald-700">
                    Open Free Account
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Business Account</p>
                        <p class="text-2xl font-bold text-gray-900">UGX 15,480,000</p>
                    </div>
                    <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">Active</span>
                </div>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Today's Collections</span>
                        <span class="font-semibold text-green-600">+UGX 2,340,000</span>
                    </div>
                    <div class="flex justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Today's Payouts</span>
                        <span class="font-semibold text-red-600">-UGX 850,000</span>
                    </div>
                    <div class="flex justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Pending</span>
                        <span class="font-semibold">UGX 125,000</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- SACCO Management --}}
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="lg:order-2">
                <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700 mb-4">For SACCOs & Credit Unions</span>
                <h2 class="text-3xl font-bold text-gray-900">SACCO Management</h2>
                <p class="mt-4 text-gray-600">Complete digital platform for Savings and Credit Cooperative Organizations. Manage members, shares, loans, and compliance all in one place.</p>
                <ul class="mt-6 space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Member management</strong> - Digital KYC, share tracking</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Loan lifecycle</strong> - Application, approval, recovery</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Mobile Money</strong> - Collect contributions via MoMo</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-blue-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>URBRA reports</strong> - Compliance-ready reporting</span>
                    </li>
                </ul>
                <a href="{{ route('finance.contact-sales') }}" class="mt-6 inline-flex items-center text-blue-600 font-semibold hover:text-blue-700">
                    Request Demo
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="lg:order-1 bg-blue-50 rounded-2xl p-8">
                <h3 class="font-semibold text-blue-900 mb-4">SACCO Dashboard</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold text-blue-600">1,245</p>
                        <p class="text-sm text-gray-600">Active Members</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold text-green-600">UGX 450M</p>
                        <p class="text-sm text-gray-600">Total Shares</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold text-purple-600">UGX 320M</p>
                        <p class="text-sm text-gray-600">Loans Outstanding</p>
                    </div>
                    <div class="bg-white rounded-lg p-4 text-center">
                        <p class="text-2xl font-bold text-orange-600">94%</p>
                        <p class="text-sm text-gray-600">Recovery Rate</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- School Fee Collection --}}
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-flex items-center rounded-full bg-orange-100 px-3 py-1 text-xs font-medium text-orange-700 mb-4">For Schools & Institutions</span>
                <h2 class="text-3xl font-bold text-gray-900">School Fee Collection</h2>
                <p class="mt-4 text-gray-600">Digital fee collection that makes life easier for schools and parents. Accept payments via Mobile Money with automatic reconciliation.</p>
                <ul class="mt-6 space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Student database</strong> - Track every student's balance</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>SMS receipts</strong> - Automatic confirmation to parents</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Bulk payroll</strong> - Pay all staff in one click</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-orange-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Term reports</strong> - Financial summary by class/term</span>
                    </li>
                </ul>
                <a href="{{ route('finance.contact-sales') }}" class="mt-6 inline-flex items-center text-orange-600 font-semibold hover:text-orange-700">
                    Get Started
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="bg-orange-50 rounded-2xl p-8">
                <h3 class="font-semibold text-orange-900 mb-4">Term 1 Collection Summary</h3>
                <div class="space-y-4">
                    <div class="bg-white rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Collected</span>
                            <span class="text-sm font-semibold text-green-600">UGX 145,000,000</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 72%"></div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-gray-600">Outstanding</span>
                            <span class="text-sm font-semibold text-orange-600">UGX 56,000,000</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-orange-500 h-2 rounded-full" style="width: 28%"></div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div class="text-center">
                            <p class="text-xl font-bold text-gray-900">487</p>
                            <p class="text-xs text-gray-600">Students Paid</p>
                        </div>
                        <div class="text-center">
                            <p class="text-xl font-bold text-gray-900">156</p>
                            <p class="text-xs text-gray-600">Balance Due</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Soko24 Integration --}}
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="lg:order-2">
                <span class="inline-flex items-center rounded-full bg-emerald-100 px-3 py-1 text-xs font-medium text-emerald-700 mb-4">For Soko24 Sellers</span>
                <h2 class="text-3xl font-bold text-gray-900">Soko24 Marketplace Integration</h2>
                <p class="mt-4 text-gray-600">Connected to Soko24 marketplace data so sellers can track sales activity, financing needs, and performance in one place.</p>
                <ul class="mt-6 space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Instant payouts</strong> - Access sales revenue immediately</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Stock financing</strong> - Loans to grow inventory</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Sales analytics</strong> - Understand your performance</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Auto tax calc</strong> - URA-ready transaction reports</span>
                    </li>
                </ul>
                <a href="{{ route('finance.contact-sales') }}" class="mt-6 inline-flex items-center text-emerald-600 font-semibold hover:text-emerald-700">
                    Connect Your Store
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="lg:order-1 bg-emerald-50 rounded-2xl p-8">
                <h3 class="font-semibold text-emerald-900 mb-4">Your Soko24 Performance</h3>
                <div class="space-y-4">
                    <div class="bg-white rounded-lg p-4">
                        <p class="text-sm text-gray-600 mb-1">This Month's Sales</p>
                        <p class="text-2xl font-bold text-gray-900">UGX 8,450,000</p>
                        <p class="text-xs text-green-600">+23% from last month</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white rounded-lg p-4 text-center">
                            <p class="text-lg font-bold text-emerald-600">156</p>
                            <p class="text-xs text-gray-600">Orders</p>
                        </div>
                        <div class="bg-white rounded-lg p-4 text-center">
                            <p class="text-lg font-bold text-purple-600">4.8</p>
                            <p class="text-xs text-gray-600">Rating</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        <p class="text-sm text-gray-600 mb-2">Loan Eligibility</p>
                        <p class="text-lg font-bold text-green-600">Up to UGX 5,000,000</p>
                        <p class="text-xs text-gray-500">Based on your sales history</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Business Loans --}}
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-medium text-purple-700 mb-4">Working Capital</span>
                <h2 class="text-3xl font-bold text-gray-900">Business Loans</h2>
                <p class="mt-4 text-gray-600">Access working capital based on your Sanaa Finance transaction history. No collateral required for qualified businesses.</p>
                <ul class="mt-6 space-y-3">
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>UGX 500K - 50M</strong> - Based on your activity</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>No collateral</strong> - For qualified businesses</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>24-hour decision</strong> - Fast approval process</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="h-6 w-6 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <span><strong>Auto repayment</strong> - From your daily sales</span>
                    </li>
                </ul>
                <a href="{{ route('finance.contact-sales') }}" class="mt-6 inline-flex items-center text-purple-600 font-semibold hover:text-purple-700">
                    Check Eligibility
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="bg-purple-50 rounded-2xl p-8">
                <h3 class="font-semibold text-purple-900 mb-4">Loan Calculator</h3>
                <div class="space-y-4">
                    <div class="bg-white rounded-lg p-4">
                        <p class="text-sm text-gray-600 mb-2">Loan Amount</p>
                        <p class="text-3xl font-bold text-gray-900">UGX 5,000,000</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white rounded-lg p-4">
                            <p class="text-sm text-gray-600">Term</p>
                            <p class="text-lg font-bold">6 months</p>
                        </div>
                        <div class="bg-white rounded-lg p-4">
                            <p class="text-sm text-gray-600">Fee</p>
                            <p class="text-lg font-bold">5%</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        <p class="text-sm text-gray-600">Daily Repayment</p>
                        <p class="text-xl font-bold text-purple-600">~UGX 29,167</p>
                        <p class="text-xs text-gray-500">Deducted from your sales</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-emerald-600">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Find the Right Solution for Your Business</h2>
        <p class="text-emerald-100 mb-8">Talk to our team to discover which Sanaa Finance products are right for you.</p>
        <a href="{{ route('finance.contact-sales') }}" class="inline-flex items-center justify-center rounded-lg bg-white text-emerald-600 px-8 py-3 text-base font-semibold hover:bg-emerald-50 transition-colors">
            Schedule a Demo
        </a>
    </div>
</section>
@endsection
