<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('page_url', 500);
            $table->string('page_title', 255)->nullable();
            $table->string('route_name', 100)->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->string('referrer', 500)->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('session_id', 100)->nullable();
            $table->string('device_type', 20)->nullable(); // desktop, mobile, tablet
            $table->string('browser', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->timestamps();

            // Indexes for efficient queries
            $table->index(['page_url', 'created_at']);
            $table->index(['route_name', 'created_at']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
