<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('badge')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->string('currency')->default('UGX');
            $table->string('billing_period')->default('month');
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->string('cta_text')->nullable();
            $table->string('cta_link')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_pricing_plans');
    }
};
