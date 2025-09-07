<?php
// config/blog.php

return [
    /*
    |--------------------------------------------------------------------------
    | Blog Settings
    |--------------------------------------------------------------------------
    */
    
    'pagination' => [
        'per_page' => 12,
        'infinite_scroll' => true,
        'load_more_button' => true,
    ],
    
    'seo' => [
        'default_image' => '/images/sanaa-blog-default.jpg',
        'site_name' => 'Sanaa Blog',
        'twitter_handle' => '@sanaa_co',
        'facebook_app_id' => env('FACEBOOK_APP_ID', ''),
        'google_analytics_id' => env('GOOGLE_ANALYTICS_ID', ''),
        'google_tag_manager_id' => env('GOOGLE_TAG_MANAGER_ID', ''),
    ],
    
    'analytics' => [
        'track_reading_time' => true,
        'track_scroll_depth' => true,
        'track_engagement' => true,
        'track_text_selection' => true,
        'track_page_performance' => true,
        'session_timeout' => 1800, // 30 minutes
    ],
    
    'features' => [
        'text_to_speech' => true,
        'reading_progress' => true,
        'keyboard_shortcuts' => true,
        'font_adjustment' => true,
        'infinite_scroll' => true,
        'dark_mode_toggle' => false, // Always dark for Steve Jobs style
        'comments' => false, // Minimalist approach
        'social_login' => true,
        'newsletter' => true,
        'related_posts' => true,
        'table_of_contents' => true,
        'breadcrumbs' => true,
        'reading_time' => true,
        'view_count' => true,
        'like_system' => true,
        'bookmark_system' => true,
        'share_tracking' => true,
    ],
    
    'cache' => [
        'trending_posts_ttl' => 3600, // 1 hour
        'popular_topics_ttl' => 3600, // 1 hour
        'related_posts_ttl' => 1800, // 30 minutes
        'blog_feed_ttl' => 3600, // 1 hour
        'sitemap_ttl' => 86400, // 24 hours
    ],
    
    'content' => [
        'excerpt_length' => 160,
        'reading_speed' => 200, // words per minute
        'max_related_posts' => 3,
        'max_trending_posts' => 5,
        'max_popular_tags' => 10,
        'max_categories' => 8,
    ],
    
    'images' => [
        'featured_image_sizes' => [
            'thumbnail' => [300, 200],
            'medium' => [600, 400],
            'large' => [1200, 800],
            'og' => [1200, 630], // Open Graph
        ],
        'quality' => 85,
        'optimize' => true,
        'webp_support' => true,
    ],
    
    'email' => [
        'newsletter_from' => env('NEWSLETTER_FROM_EMAIL', 'noreply@sanaa.co'),
        'newsletter_name' => env('NEWSLETTER_FROM_NAME', 'Sanaa Blog'),
        'mailchimp_api_key' => env('MAILCHIMP_API_KEY', ''),
        'mailchimp_list_id' => env('MAILCHIMP_LIST_ID', ''),
    ],
    
    'social' => [
        'twitter_username' => '@sanaa_co',
        'facebook_page' => 'https://facebook.com/sanaa.co',
        'linkedin_company' => 'https://linkedin.com/company/sanaa',
        'instagram_username' => '@sanaa_co',
        'youtube_channel' => '',
        'github_username' => 'sanaa-co',
    ],
    
    'rss' => [
        'title' => 'Sanaa Blog - Latest Insights',
        'description' => 'Minimalist insights on technology, design, and innovation',
        'language' => 'en-us',
        'ttl' => 60, // minutes
        'max_items' => 20,
    ],
    
    'search' => [
        'enabled' => true,
        'engine' => 'database', // database, algolia, elasticsearch
        'min_query_length' => 3,
        'max_results' => 50,
        'highlight_matches' => true,
    ],
    
    'security' => [
        'rate_limit_engagement' => '60,1', // 60 actions per minute
        'rate_limit_analytics' => '120,1', // 120 events per minute
        'honeypot_field' => 'website', // Spam protection
        'csrf_protection' => true,
    ],
    
    'performance' => [
        'lazy_load_images' => true,
        'minify_html' => env('APP_ENV') === 'production',
        'gzip_compression' => true,
        'browser_caching' => true,
        'cdn_url' => env('CDN_URL', ''),
        'cdn_enabled' => env('CDN_ENABLED', true),
    ],
];

?>