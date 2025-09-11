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
        Schema::create('finance_compliance_items', function (Blueprint $table) {
            $table->id();
            $table->string('standard');
            $table->enum('status', ['pending', 'in-progress', 'achieved'])->default('pending');
            $table->string('evidence_file')->nullable();
            $table->string('evidence_link')->nullable();
            $table->timestamp('last_updated')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_compliance_items');
    }
};
