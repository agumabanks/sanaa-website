<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // User bookmarks/saved posts
        Schema::create('user_bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('blog_id')->constrained('blogs')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'blog_id']);
        });

        // Reading history
        Schema::create('reading_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('blog_id')->constrained('blogs')->onDelete('cascade');
            $table->integer('read_percentage')->default(0); // 0-100
            $table->integer('time_spent')->default(0); // seconds
            $table->timestamp('last_read_at')->useCurrent();
            $table->timestamps();

            $table->index(['user_id', 'last_read_at']);
        });

        // Reading lists/collections
        Schema::create('reading_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->boolean('is_private')->default(false);
            $table->timestamps();

            $table->index(['user_id', 'slug']);
        });

        Schema::create('reading_list_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reading_list_id')->constrained()->onDelete('cascade');
            $table->foreignId('blog_id')->constrained('blogs')->onDelete('cascade');
            $table->integer('position')->default(0);
            $table->text('note')->nullable();
            $table->timestamps();

            $table->unique(['reading_list_id', 'blog_id']);
        });

        // User follows
        if (!Schema::hasTable('user_follows')) {
            Schema::create('user_follows', function (Blueprint $table) {
                $table->id();
                $table->foreignId('follower_id')->constrained('users')->onDelete('cascade');
                $table->foreignId('following_id')->constrained('users')->onDelete('cascade');
                $table->timestamps();

                $table->unique(['follower_id', 'following_id']);
                $table->index('follower_id');
                $table->index('following_id');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('reading_list_items');
        Schema::dropIfExists('reading_lists');
        Schema::dropIfExists('reading_history');
        Schema::dropIfExists('user_bookmarks');
        Schema::dropIfExists('user_follows');
    }
};
