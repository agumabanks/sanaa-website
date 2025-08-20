<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_analytics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();
            $table->string('referrer', 500)->nullable();
            $table->string('event_type'); // page_view, like, bookmark, share, scroll_depth, reading_time
            $table->json('metadata')->nullable(); // Store additional data like scroll percentage, time spent, etc.
            $table->integer('value')->nullable(); // For numerical values like scroll depth percentage
            $table->timestamps();

            $table->index(['blog_id', 'event_type']);
            $table->index('created_at');
            $table->index(['ip_address', 'event_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_analytics');
    }
};

