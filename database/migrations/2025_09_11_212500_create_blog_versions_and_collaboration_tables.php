<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blog_versions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_id');
            $table->integer('version_number');
            $table->string('title');
            $table->longText('body');
            $table->text('excerpt')->nullable();
            $table->text('changes_summary')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->index(['blog_id', 'version_number']);
        });

        Schema::create('blog_collaborators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('role', ['viewer','editor','admin'])->default('editor');
            $table->json('permissions')->nullable();
            $table->timestamp('joined_at')->nullable();
            $table->timestamps();
            $table->unique(['blog_id','user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_collaborators');
        Schema::dropIfExists('blog_versions');
    }
};

