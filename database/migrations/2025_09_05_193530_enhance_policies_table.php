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
        Schema::table('policies', function (Blueprint $table) {
            // Add new fields for enhanced policy management
            $table->text('excerpt')->nullable()->after('content');
            $table->string('meta_title')->nullable()->after('excerpt');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->text('meta_keywords')->nullable()->after('meta_description');
            $table->boolean('status')->default(true)->after('meta_keywords');
            $table->string('category')->nullable()->after('status');
            $table->integer('order')->nullable()->after('category');
            $table->unsignedBigInteger('last_updated_by')->nullable()->after('order');

            // Add foreign key
            $table->foreign('last_updated_by')->references('id')->on('users')->onDelete('set null');

            // Add indexes for better performance
            $table->index('status');
            $table->index('category');
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('policies', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['last_updated_by']);

            // Drop indexes
            $table->dropIndex(['status']);
            $table->dropIndex(['category']);
            $table->dropIndex(['order']);

            // Drop columns
            $table->dropColumn([
                'excerpt',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'status',
                'category',
                'order',
                'last_updated_by'
            ]);
        });
    }
};
