<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('finance_resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['case_study','whitepaper','sdk','api_doc','video','one_pager']);
            $table->string('file_path')->nullable();
            $table->string('url')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finance_resources');
    }
};

