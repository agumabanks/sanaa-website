<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('likes')->default(0);
            $table->unsignedBigInteger('shares')->default(0);
            $table->unsignedBigInteger('saves')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['views', 'likes', 'shares', 'saves']);
        });
    }
};
