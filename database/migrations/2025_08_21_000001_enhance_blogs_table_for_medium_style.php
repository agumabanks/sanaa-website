<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Add missing columns for Medium-style blog
            if (!Schema::hasColumn('blogs', 'featured_image')) {
                $table->string('featured_image')->nullable()->after('body');
            }
            if (!Schema::hasColumn('blogs', 'author_id')) {
                $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null')->after('featured_image');
            }
            if (!Schema::hasColumn('blogs', 'status')) {
                $table->enum('status', ['draft', 'published', 'archived'])->default('draft')->after('author_id');
            }
            if (!Schema::hasColumn('blogs', 'featured')) {
                $table->boolean('featured')->default(false)->after('status');
            }
            if (!Schema::hasColumn('blogs', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('featured');
            }
            if (!Schema::hasColumn('blogs', 'reading_time')) {
                $table->integer('reading_time')->nullable()->after('published_at');
            }
            if (!Schema::hasColumn('blogs', 'bookmarks')) {
                $table->unsignedBigInteger('bookmarks')->default(0)->after('saves');
            }
            if (!Schema::hasColumn('blogs', 'meta_title')) {
                $table->string('meta_title')->nullable()->after('bookmarks');
            }
            if (!Schema::hasColumn('blogs', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
            if (!Schema::hasColumn('blogs', 'keywords')) {
                $table->text('keywords')->nullable()->after('meta_description');
            }
            if (!Schema::hasColumn('blogs', 'category_id')) {
                $table->foreignId('category_id')->nullable()->constrained('blog_categories')->onDelete('set null')->after('keywords');
            }

            // Add indexes for performance
            $table->index(['status', 'published_at']);
            $table->index(['featured', 'published_at']);
            $table->index('views');
            $table->index('likes');
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['category_id']);
            $table->dropIndex(['status', 'published_at']);
            $table->dropIndex(['featured', 'published_at']);
            $table->dropIndex(['views']);
            $table->dropIndex(['likes']);

            $table->dropColumn([
                'featured_image', 'author_id', 'status', 'featured',
                'published_at', 'reading_time', 'bookmarks',
                'meta_title', 'meta_description', 'keywords', 'category_id',
            ]);
        });
    }
};

