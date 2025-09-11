<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('finance_menus', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('url');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_external')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('group')->nullable(); // e.g., primary, footer
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finance_menus');
    }
};

