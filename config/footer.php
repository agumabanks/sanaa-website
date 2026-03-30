<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Footer Support Contact Information
    |--------------------------------------------------------------------------
    |
    | Contact information displayed in the footer Help & Support section
    |
    */

    'support' => [
        'customer' => [
            'label' => 'Customer Support',
            'phone' => '0706 27-2481',
            'phone_raw' => '0706272481',
        ],
        'sales' => [
            'label' => 'Sales Enquiries',
            'phone' => '0200 90-3222',
            'phone_raw' => '0200903222',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Social Media Links
    |--------------------------------------------------------------------------
    |
    | Social media profile URLs for the footer
    |
    */

    'social' => [
        'twitter' => [
            'url' => 'https://twitter.com/sanaa_co',
            'label' => 'Follow us on Twitter',
            'icon' => 'twitter',
        ],
        'linkedin' => [
            'url' => 'https://www.linkedin.com/company/sanaa',
            'label' => 'Connect with us on LinkedIn',
            'icon' => 'linkedin',
        ],
        'instagram' => [
            'url' => 'https://www.instagram.com/sanaa_co',
            'label' => 'Follow us on Instagram',
            'icon' => 'instagram',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Footer Legal Links
    |--------------------------------------------------------------------------
    |
    | Links displayed in the footer bottom bar
    |
    */

    'legal_links' => [
        [
            'label' => 'Privacy',
            'route' => 'policies.privacy-notice',
        ],
        [
            'label' => 'Terms',
            'route' => 'terms',
        ],
        [
            'label' => 'Security',
            'route' => 'policies.security',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Footer Copyright
    |--------------------------------------------------------------------------
    |
    | Copyright text template (year is automatically inserted)
    |
    */

    'copyright' => [
        'text' => 'Sanaa Co.',
        'show_year' => true,
    ],

];
