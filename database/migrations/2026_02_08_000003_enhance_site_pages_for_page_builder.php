<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_pages', function (Blueprint $table) {
            // Block-based content (JSON)
            $table->json('blocks')->nullable()->after('content');

            // Page template
            $table->string('template')->default('default')->after('status');

            // Publishing workflow
            $table->timestamp('published_at')->nullable()->after('template');
            $table->timestamp('scheduled_at')->nullable()->after('published_at');

            // Enhanced SEO
            $table->string('canonical_url')->nullable()->after('meta_image');
            $table->string('og_image')->nullable()->after('canonical_url');
            $table->string('schema_type')->nullable()->after('og_image');
            $table->boolean('is_indexed')->default(true)->after('schema_type');

            // User tracking
            $table->unsignedBigInteger('created_by')->nullable()->after('is_indexed');

            // Page settings
            $table->boolean('show_header')->default(true)->after('created_by');
            $table->boolean('show_footer')->default(true)->after('show_header');
            $table->string('custom_css')->nullable()->after('show_footer');

            // Indexes
            $table->index('template');
            $table->index('published_at');
        });
    }

    public function down(): void
    {
        Schema::table('site_pages', function (Blueprint $table) {
            $table->dropIndex(['template']);
            $table->dropIndex(['published_at']);

            $table->dropColumn([
                'blocks',
                'template',
                'published_at',
                'scheduled_at',
                'canonical_url',
                'og_image',
                'schema_type',
                'is_indexed',
                'created_by',
                'show_header',
                'show_footer',
                'custom_css',
            ]);
        });
    }
};
