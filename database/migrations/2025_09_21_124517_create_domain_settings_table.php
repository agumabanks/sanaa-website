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
        Schema::create('domain_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // e.g., 'soko_domain', 'media_domain'
            $table->string('domain'); // e.g., 'soko.sanaa.ug'
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('last_updated_by')->nullable();
            $table->timestamps();

            $table->foreign('last_updated_by')->references('id')->on('users')->onDelete('set null');
            $table->index(['key', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('domain_settings');
    }
};
