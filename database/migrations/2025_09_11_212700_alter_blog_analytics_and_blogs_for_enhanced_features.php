<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('blog_analytics')) {
            Schema::table('blog_analytics', function (Blueprint $table) {
                if (!Schema::hasColumn('blog_analytics', 'session_id')) {
                    $table->string('session_id')->nullable()->after('ip_address');
                }
                if (!Schema::hasColumn('blog_analytics', 'device_info')) {
                    $table->json('device_info')->nullable()->after('metadata');
                }
                if (!Schema::hasColumn('blog_analytics', 'session_data')) {
                    $table->json('session_data')->nullable()->after('device_info');
                }
                $table->index(['event_type', 'created_at'], 'idx_event_date');
                $table->index(['session_id'], 'idx_session');
            });
        }

        if (Schema::hasTable('blogs')) {
            Schema::table('blogs', function (Blueprint $table) {
                if (!Schema::hasColumn('blogs', 'ai_suggestions')) {
                    $table->json('ai_suggestions')->nullable()->after('keywords');
                }
                if (!Schema::hasColumn('blogs', 'seo_analysis')) {
                    $table->json('seo_analysis')->nullable()->after('ai_suggestions');
                }
                if (!Schema::hasColumn('blogs', 'collaboration_metadata')) {
                    $table->json('collaboration_metadata')->nullable()->after('seo_analysis');
                }
                if (!Schema::hasColumn('blogs', 'version_number')) {
                    $table->integer('version_number')->default(1)->after('collaboration_metadata');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('blog_analytics')) {
            Schema::table('blog_analytics', function (Blueprint $table) {
                if (Schema::hasColumn('blog_analytics', 'session_id')) {
                    $table->dropColumn('session_id');
                }
                if (Schema::hasColumn('blog_analytics', 'device_info')) {
                    $table->dropColumn('device_info');
                }
                if (Schema::hasColumn('blog_analytics', 'session_data')) {
                    $table->dropColumn('session_data');
                }
                $table->dropIndex('idx_event_date');
                $table->dropIndex('idx_session');
            });
        }

        if (Schema::hasTable('blogs')) {
            Schema::table('blogs', function (Blueprint $table) {
                foreach (['ai_suggestions','seo_analysis','collaboration_metadata','version_number'] as $c) {
                    if (Schema::hasColumn('blogs', $c)) {
                        $table->dropColumn($c);
                    }
                }
            });
        }
    }
};

