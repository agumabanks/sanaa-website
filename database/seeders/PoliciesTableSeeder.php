<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Policy;

class PoliciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void 
    {
        $policies = [
            // Legal & Compliance
            [
                'key' => 'terms',
                'title' => 'Terms & Conditions',
                'category' => 'legal',
                'order' => 1,
                'content' => $this->getTermsContent(),
                'excerpt' => 'Terms and conditions for using Sanaa services and platform.',
                'meta_title' => 'Terms & Conditions | Sanaa',
                'meta_description' => 'Read our terms and conditions for using Sanaa services, platform access, and user agreements.',
                'status' => true
            ],
            [
                'key' => 'seller-policies',
                'title' => 'Seller Policies',
                'category' => 'legal',
                'order' => 2,
                'content' => $this->getSellerPoliciesContent(),
                'excerpt' => 'Guidelines and policies for sellers using the Sanaa platform.',
                'meta_title' => 'Seller Policies | Sanaa',
                'meta_description' => 'Comprehensive seller policies, guidelines, and requirements for using the Sanaa marketplace.',
                'status' => true
            ],

            // Privacy & Security
            [
                'key' => 'privacy-notice',
                'title' => 'Privacy Notice',
                'category' => 'privacy',
                'order' => 3,
                'content' => $this->getPrivacyNoticeContent(),
                'excerpt' => 'How we collect, use, and protect your personal information.',
                'meta_title' => 'Privacy Notice | Sanaa',
                'meta_description' => 'Learn about our privacy practices, data collection, and how we protect your personal information.',
                'status' => true
            ],
            [
                'key' => 'security',
                'title' => 'Security',
                'category' => 'privacy',
                'order' => 4,
                'content' => $this->getSecurityContent(),
                'excerpt' => 'Security measures and practices to protect your data and transactions.',
                'meta_title' => 'Security | Sanaa',
                'meta_description' => 'Discover our security measures, encryption practices, and data protection protocols.',
                'status' => true
            ],
            [
                'key' => 'consumer-health-privacy',
                'title' => 'Consumer Health Privacy',
                'category' => 'privacy',
                'order' => 5,
                'content' => $this->getConsumerHealthPrivacyContent(),
                'excerpt' => 'Privacy practices for health-related data and consumer health information.',
                'meta_title' => 'Consumer Health Privacy | Sanaa',
                'meta_description' => 'Our privacy practices for handling consumer health data and medical information.',
                'status' => true
            ],

            // Licenses & Certifications
            [
                'key' => 'government-licenses',
                'title' => 'Government Licenses',
                'category' => 'licenses',
                'order' => 6,
                'content' => $this->getGovernmentLicensesContent(),
                'excerpt' => 'Official government licenses and regulatory approvals.',
                'meta_title' => 'Government Licenses | Sanaa',
                'meta_description' => 'View our official government licenses, regulatory approvals, and compliance certifications.',
                'status' => true
            ],
            [
                'key' => 'sanaa-brands-licenses',
                'title' => 'Sanaa Brands Licenses',
                'category' => 'licenses',
                'order' => 7,
                'content' => $this->getSanaaBrandsLicensesContent(),
                'excerpt' => 'Brand licensing information and intellectual property rights.',
                'meta_title' => 'Sanaa Brands Licenses | Sanaa',
                'meta_description' => 'Information about Sanaa brand licensing, trademarks, and intellectual property.',
                'status' => true
            ],
            [
                'key' => 'sanaa-finance-licenses',
                'title' => 'Sanaa Finance Licenses',
                'category' => 'licenses',
                'order' => 8,
                'content' => $this->getSanaaFinanceLicensesContent(),
                'excerpt' => 'Financial services licenses and regulatory compliance.',
                'meta_title' => 'Sanaa Finance Licenses | Sanaa',
                'meta_description' => 'Financial services licenses, regulatory compliance, and banking authorizations.',
                'status' => true
            ],
            [
                'key' => 'hardware-compliance-certifications',
                'title' => 'Hardware Compliance Certifications',
                'category' => 'licenses',
                'order' => 9,
                'content' => $this->getHardwareComplianceContent(),
                'excerpt' => 'Hardware certifications, safety standards, and compliance documentation.',
                'meta_title' => 'Hardware Compliance Certifications | Sanaa',
                'meta_description' => 'Hardware compliance certifications, safety standards, and regulatory documentation.',
                'status' => true
            ],

            // Corporate Information
            [
                'key' => 'open-corporates',
                'title' => 'Open Corporates',
                'category' => 'corporate',
                'order' => 10,
                'content' => $this->getOpenCorporatesContent(),
                'excerpt' => 'Corporate information, business registration, and company details.',
                'meta_title' => 'Open Corporates | Sanaa',
                'meta_description' => 'Corporate information, business registration details, and company transparency data.',
                'status' => true
            ]
        ];

        foreach ($policies as $policy) {
            Policy::updateOrCreate(
                ['key' => $policy['key']],
                $policy
            );
        }
    }

    private function getTermsContent()
    {
        return '<h2>Terms & Conditions</h2>
        <p>Welcome to Sanaa. These terms and conditions outline the rules and regulations for the use of our platform.</p>

        <h3>Acceptance of Terms</h3>
        <p>By accessing and using our services, you accept and agree to be bound by the terms and provision of this agreement.</p>

        <h3>Use License</h3>
        <p>Permission is granted to temporarily access the materials on our platform for personal, non-commercial transitory viewing only.</p>

        <h3>User Responsibilities</h3>
        <ul>
            <li>Provide accurate and complete information</li>
            <li>Maintain the security of your account</li>
            <li>Comply with all applicable laws and regulations</li>
            <li>Respect the rights of other users</li>
        </ul>';
    }

    private function getSellerPoliciesContent()
    {
        return '<h2>Seller Policies</h2>
        <p>Guidelines for sellers using the Sanaa marketplace platform.</p>

        <h3>Seller Requirements</h3>
        <ul>
            <li>Valid business registration</li>
            <li>Compliance with local laws</li>
            <li>Quality product standards</li>
            <li>Customer service commitment</li>
        </ul>

        <h3>Product Listings</h3>
        <p>All product listings must be accurate, complete, and comply with our content policies.</p>';
    }

    private function getPrivacyNoticeContent()
    {
        return '<h2>Privacy Notice</h2>
        <p>Your privacy is important to us. This notice explains how we collect, use, and protect your information.</p>

        <h3>Information We Collect</h3>
        <ul>
            <li>Personal information you provide</li>
            <li>Usage data and analytics</li>
            <li>Device and browser information</li>
            <li>Location data (with permission)</li>
        </ul>

        <h3>How We Use Your Information</h3>
        <p>We use your information to provide services, improve our platform, and communicate with you.</p>';
    }

    private function getSecurityContent()
    {
        return '<h2>Security Measures</h2>
        <p>We implement comprehensive security measures to protect your data and transactions.</p>

        <h3>Data Protection</h3>
        <ul>
            <li>End-to-end encryption</li>
            <li>Secure data centers</li>
            <li>Regular security audits</li>
            <li>Multi-factor authentication</li>
        </ul>

        <h3>Transaction Security</h3>
        <p>All financial transactions are processed through secure, PCI-compliant gateways.</p>';
    }

    private function getConsumerHealthPrivacyContent()
    {
        return '<h2>Consumer Health Privacy</h2>
        <p>Special privacy considerations for health-related data and consumer health information.</p>

        <h3>Health Data Protection</h3>
        <p>We adhere to strict standards for protecting sensitive health information.</p>

        <h3>HIPAA Compliance</h3>
        <p>Our health data practices comply with HIPAA and other relevant regulations.</p>';
    }

    private function getGovernmentLicensesContent()
    {
        return '<h2>Government Licenses</h2>
        <p>Official government licenses and regulatory approvals held by Sanaa.</p>

        <h3>Business Licenses</h3>
        <ul>
            <li>Business registration certificates</li>
            <li>Tax identification numbers</li>
            <li>Trade licenses</li>
            <li>Professional certifications</li>
        </ul>';
    }

    private function getSanaaBrandsLicensesContent()
    {
        return '<h2>Sanaa Brands Licenses</h2>
        <p>Brand licensing information and intellectual property rights for Sanaa brands.</p>

        <h3>Trademark Registrations</h3>
        <p>Our trademarks are registered in multiple jurisdictions and protected under international law.</p>

        <h3>Brand Usage Guidelines</h3>
        <p>Guidelines for proper use of Sanaa branding and logos.</p>';
    }

    private function getSanaaFinanceLicensesContent()
    {
        return '<h2>Sanaa Finance Licenses</h2>
        <p>Financial services licenses and regulatory compliance for Sanaa Finance.</p>

        <h3>Financial Licenses</h3>
        <ul>
            <li>Banking licenses</li>
            <li>Payment processing authorizations</li>
            <li>Investment advisory licenses</li>
            <li>Insurance licenses</li>
        </ul>';
    }

    private function getHardwareComplianceContent()
    {
        return '<h2>Hardware Compliance Certifications</h2>
        <p>Hardware certifications, safety standards, and compliance documentation.</p>

        <h3>Safety Certifications</h3>
        <ul>
            <li>CE marking</li>
            <li>FCC certification</li>
            <li>RoHS compliance</li>
            <li>Safety testing reports</li>
        </ul>';
    }

    private function getOpenCorporatesContent()
    {
        return '<h2>Open Corporates</h2>
        <p>Corporate information, business registration, and company transparency data.</p>

        <h3>Company Information</h3>
        <ul>
            <li>Legal entity name</li>
            <li>Registration details</li>
            <li>Directors and officers</li>
            <li>Shareholding structure</li>
        </ul>

        <h3>Transparency Commitment</h3>
        <p>We are committed to corporate transparency and open business practices.</p>';
    }
}
