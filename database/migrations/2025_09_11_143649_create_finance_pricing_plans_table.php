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
        Schema::create('finance_pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('summary')->nullable();
            $table->decimal('monthly_price', 10, 2)->nullable();
            $table->decimal('annual_price', 10, 2)->nullable();
            $table->json('features')->nullable();
            $table->json('limits')->nullable();
            $table->string('cta_link')->nullable();
            $table->string('badge')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_pricing_plans');
    }
};
