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
        Schema::create('investor_relations_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Investor Relations');
            $table->longText('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('last_updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investor_relations_pages');
    }
};

