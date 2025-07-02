@extends('layouts.landing')

@section('title', 'Company | ' . config('app.name'))

@section('content')

<div class="container mx-auto py-12 px-4">
    <h1 class="text-3xl font-bold mb-6">Company Overview</h1>
    <p class="mb-4">
        Sanaa Co. (<a href="https://www.sanaa.co" class="text-green-600 underline">www.sanaa.co</a>)
        is an East-African technology group registered in Uganda (2021) with four flagship verticals:
    </p>
    <ul class="list-disc ml-8 space-y-2 mb-4">
        <li><strong>EdTech</strong> &ndash; National laptop initiative (&ldquo;1 Student 1 Computer&rdquo;) and exam-delivery platform; 50&nbsp;000 devices shipped to date.</li>
        <li><strong>FinTech</strong> &ndash; Sanaa Finance SaaS, a cloud core-banking platform used by 30 licensed money-lenders and 7 SACCOs; US$4.2&nbsp;m annual TPV.</li>
        <li><strong>Device-as-a-Service</strong> &ndash; Smartphone &amp; laptop BNPL loans distributed through 180 retail points and WhatsApp bot.</li>
        <li><strong>Sanaa Media</strong> &ndash; Serving African content creators by enabling them to build fully digital media brands.</li>
    </ul>
    <p>
        We operate NOC facilities in Kampala (Tier-3 data centre), a 24&middot;7 call centre, and a certified field-engineer programme covering all 134 Ugandan districts. These operations are managed through our Sanaa OS/ERP.
    </p>
</div>
@endsection
