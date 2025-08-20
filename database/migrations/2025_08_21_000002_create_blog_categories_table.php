<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('color', 7)->default('#00ff00'); // Green accent color
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed default categories
        DB::table('blog_categories')->insert([
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Latest in tech and innovation', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Business', 'slug' => 'business', 'description' => 'Business insights and strategies', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Design', 'slug' => 'design', 'description' => 'Design principles and aesthetics', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Innovation', 'slug' => 'innovation', 'description' => 'Innovative ideas and solutions', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_categories');
    }
};

