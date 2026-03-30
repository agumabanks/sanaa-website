<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Auto-save drafts
        Schema::create('blog_auto_saves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('blog_id')->nullable()->constrained('blogs')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('body')->nullable();
            $table->json('content_json')->nullable(); // For rich text editor state
            $table->string('featured_image')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'blog_id']);
        });

        // Writing streaks and stats
        Schema::create('writing_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->integer('words_written')->default(0);
            $table->integer('minutes_writing')->default(0);
            $table->integer('posts_published')->default(0);
            $table->timestamps();

            $table->unique(['user_id', 'date']);
        });

        // Add fields to blogs table if they don't exist
        if (!Schema::hasColumn('blogs', 'content_json')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->json('content_json')->nullable()->after('body');
                $table->boolean('is_rich_text')->default(false)->after('content_json');
            });
        }
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['content_json', 'is_rich_text']);
        });
        
        Schema::dropIfExists('writing_stats');
        Schema::dropIfExists('blog_auto_saves');
    }
};
