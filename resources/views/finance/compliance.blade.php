@extends('layouts.finance', [
    'title' => 'Compliance — Sanaa Finance',
    'breadcrumbs' => [ ['name' => 'Compliance'] ],
])
@section('content')
<section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-semibold mb-6">Compliance</h1>
    <div class="space-y-4 text-gray-700">
        <p>SOC 2, ISO 27001, PCI DSS, GDPR, and API security following OAuth2/OIDC and FAPI best practices.</p>
        <ul class="list-disc pl-5">
            <li>Regular audits and penetration testing.</li>
            <li>Strict CSRF and input validation on all forms.</li>
            <li>Secure file upload allowlist and storage separation.</li>
        </ul>
    </div>
</section>
@endsection

