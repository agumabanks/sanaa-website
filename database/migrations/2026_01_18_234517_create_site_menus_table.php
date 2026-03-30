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
        Schema::create('site_menus', function (Blueprint $table) {
            $table->id();
            $table->string('location', 50); // 'main', 'footer', 'mobile', 'products', etc.
            $table->string('label', 100);
            $table->string('url', 500)->nullable();
            $table->string('route_name', 100)->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('site_menus')->cascadeOnDelete();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_external')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('icon', 100)->nullable();
            $table->text('description')->nullable(); // For mega-menu descriptions
            $table->string('badge')->nullable(); // e.g., "NEW", "BETA"
            $table->string('badge_color', 20)->nullable(); // e.g., "emerald", "blue"
            $table->timestamps();

            // Indexes
            $table->index(['location', 'is_active', 'sort_order']);
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_menus');
    }
};
