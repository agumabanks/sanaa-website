<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services_page_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, textarea, number, json
            $table->timestamps();
        });

        // Seed default values
        $defaults = [
            // Hero Section
            ['key' => 'hero_eyebrow', 'value' => 'Implementation & Deployment', 'type' => 'text'],
            ['key' => 'hero_title', 'value' => 'Turning Products into Real Change', 'type' => 'text'],
            ['key' => 'hero_subtitle', 'value' => 'From SACCO digitisation to SME POS deployments, we provide hands-on services that bring our products to life on the ground in Uganda, DRC, and beyond.', 'type' => 'textarea'],
            ['key' => 'hero_cta_primary_text', 'value' => 'Book a Consultation', 'type' => 'text'],
            ['key' => 'hero_cta_secondary_text', 'value' => 'View Services', 'type' => 'text'],
            
            // Stats Section
            ['key' => 'stat_1_value', 'value' => '2018', 'type' => 'text'],
            ['key' => 'stat_1_label', 'value' => 'Founded', 'type' => 'text'],
            ['key' => 'stat_2_value', 'value' => '134', 'type' => 'text'],
            ['key' => 'stat_2_label', 'value' => 'Districts Covered', 'type' => 'text'],
            ['key' => 'stat_3_value', 'value' => '37+', 'type' => 'text'],
            ['key' => 'stat_3_label', 'value' => 'Financial Institutions', 'type' => 'text'],
            ['key' => 'stat_4_value', 'value' => '5', 'type' => 'text'],
            ['key' => 'stat_4_label', 'value' => 'Countries', 'type' => 'text'],
            
            // Services Section
            ['key' => 'services_eyebrow', 'value' => 'What We Do', 'type' => 'text'],
            ['key' => 'services_title', 'value' => 'Implementation Services', 'type' => 'text'],
            ['key' => 'services_subtitle', 'value' => "We don't just sell software — we deploy, configure, train, and support your team until you're running confidently.", 'type' => 'textarea'],
            
            // Why Sanaa Section
            ['key' => 'why_eyebrow', 'value' => 'Why Sanaa', 'type' => 'text'],
            ['key' => 'why_title', 'value' => 'Built for African Realities', 'type' => 'text'],
            ['key' => 'why_subtitle', 'value' => 'We design around your power, network, and staff constraints — not against them.', 'type' => 'textarea'],
            ['key' => 'why_features', 'value' => json_encode([
                ['title' => 'Built for Africa', 'description' => 'We design around your power, network, and staff constraints — not against them.', 'color' => 'emerald'],
                ['title' => 'Local + Global Expertise', 'description' => 'Teams in Uganda & DRC, with partners in Europe, North America, China and across Africa.', 'color' => 'blue'],
                ['title' => 'End-to-End Ecosystem', 'description' => 'Software, devices, finance and logistics that work together — not standalone tools.', 'color' => 'purple'],
                ['title' => 'Training & Long-term Support', 'description' => "We don't just deploy and disappear; we train your people and stay available.", 'color' => 'orange'],
            ]), 'type' => 'json'],
            
            // Who We Serve Section
            ['key' => 'sectors_eyebrow', 'value' => 'Who We Serve', 'type' => 'text'],
            ['key' => 'sectors_title', 'value' => 'Trusted Across Sectors', 'type' => 'text'],
            ['key' => 'sectors', 'value' => json_encode([
                ['name' => 'SACCOs & MFIs', 'color' => 'emerald'],
                ['name' => 'SMEs & Retailers', 'color' => 'blue'],
                ['name' => 'Schools', 'color' => 'purple'],
                ['name' => 'Logistics', 'color' => 'orange'],
                ['name' => 'Agriculture', 'color' => 'teal'],
                ['name' => 'NGOs', 'color' => 'pink'],
            ]), 'type' => 'json'],
            
            // CTA Section
            ['key' => 'cta_eyebrow', 'value' => "Let's Talk", 'type' => 'text'],
            ['key' => 'cta_title', 'value' => 'Ready to Get Started?', 'type' => 'text'],
            ['key' => 'cta_subtitle', 'value' => "Tell us about your SACCO, school, SME, or logistics operation. We'll recommend the right mix of Sanaa products and services for your needs.", 'type' => 'textarea'],
            ['key' => 'cta_primary_text', 'value' => 'Book a Consultation', 'type' => 'text'],
            ['key' => 'cta_secondary_text', 'value' => 'Explore Sanaa Finance', 'type' => 'text'],
            ['key' => 'cta_secondary_link', 'value' => '/finance', 'type' => 'text'],
            ['key' => 'cta_footer', 'value' => 'Serving businesses across Uganda, Kenya, Tanzania, Rwanda, and DRC', 'type' => 'text'],
        ];

        foreach ($defaults as $setting) {
            \DB::table('services_page_settings')->insert([
                'key' => $setting['key'],
                'value' => $setting['value'],
                'type' => $setting['type'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('services_page_settings');
    }
};
