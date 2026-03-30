<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('careers', function (Blueprint $table) {
            // Core fields
            $table->string('slug')->unique()->after('title');
            $table->string('department')->nullable()->after('description');
            $table->string('location')->after('department');
            $table->enum('job_type', ['full-time', 'part-time', 'contract', 'internship', 'remote'])->default('full-time')->after('location');
            $table->string('salary_range')->nullable()->after('job_type');
            $table->text('requirements')->nullable()->after('salary_range');
            $table->text('responsibilities')->nullable()->after('requirements');
            $table->text('benefits')->nullable()->after('responsibilities');

            // Publishing
            $table->enum('status', ['draft', 'published', 'closed'])->default('draft')->after('benefits');
            $table->timestamp('published_at')->nullable()->after('status');
            $table->timestamp('closes_at')->nullable()->after('published_at');

            // SEO
            $table->string('meta_title')->nullable()->after('closes_at');
            $table->text('meta_description')->nullable()->after('meta_title');

            // Tracking
            $table->unsignedBigInteger('created_by')->nullable()->after('meta_description');
            $table->unsignedInteger('view_count')->default(0)->after('created_by');
            $table->unsignedInteger('application_count')->default(0)->after('view_count');

            // Foreign key
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');

            // Indexes
            $table->index('status');
            $table->index('department');
            $table->index('location');
            $table->index('job_type');
        });
    }

    public function down(): void
    {
        Schema::table('careers', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['created_by']);

            // Drop indexes
            $table->dropIndex(['status']);
            $table->dropIndex(['department']);
            $table->dropIndex(['location']);
            $table->dropIndex(['job_type']);

            // Drop columns
            $table->dropColumn([
                'slug',
                'department',
                'location',
                'job_type',
                'salary_range',
                'requirements',
                'responsibilities',
                'benefits',
                'status',
                'published_at',
                'closes_at',
                'meta_title',
                'meta_description',
                'created_by',
                'view_count',
                'application_count',
            ]);
        });
    }
};
