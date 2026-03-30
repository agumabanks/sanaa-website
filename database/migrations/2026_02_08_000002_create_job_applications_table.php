<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('career_id')->constrained('careers')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');

            // Applicant Info
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('portfolio_url')->nullable();

            // Application Content
            $table->text('cover_letter')->nullable();
            $table->string('resume_path')->nullable();
            $table->json('additional_documents')->nullable();

            // Screening Questions
            $table->json('screening_answers')->nullable();

            // Status Tracking
            $table->enum('status', [
                'new',
                'reviewing',
                'screening',
                'interview',
                'offer',
                'hired',
                'rejected',
                'withdrawn'
            ])->default('new');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->timestamp('reviewed_at')->nullable();

            // Source Tracking
            $table->string('source')->nullable();
            $table->string('referral_code')->nullable();

            $table->timestamps();

            // Foreign key for reviewed_by
            $table->foreign('reviewed_by')->references('id')->on('users')->onDelete('set null');

            // Indexes
            $table->index('status');
            $table->index('email');
            $table->index(['career_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
