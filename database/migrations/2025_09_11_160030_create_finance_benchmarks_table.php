<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('finance_benchmarks', function (Blueprint $table) {
            $table->id();
            $table->string('metric');
            $table->string('sanaa_value');
            $table->string('competitor_value')->nullable();
            $table->text('footnote')->nullable();
            $table->date('as_of_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finance_benchmarks');
    }
};

