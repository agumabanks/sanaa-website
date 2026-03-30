<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('loyalty_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('industry')->nullable();
            $table->boolean('active')->default(true);
            $table->json('settings')->nullable(); // Points name, widget colors, etc.
            $table->timestamps();
        });

        Schema::create('loyalty_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loyalty_program_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Bronze, Silver, Gold
            $table->integer('min_points')->default(0);
            $table->decimal('multiplier', 5, 2)->default(1.0); // Reward multiplier
            $table->json('perks')->nullable();
            $table->timestamps();
        });

        Schema::create('reward_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loyalty_program_id')->constrained()->onDelete('cascade');
            $table->string('event_type'); // purchase, referral, review, etc.
            $table->integer('points_awarded');
            $table->decimal('min_spend', 12, 2)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('referral_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loyalty_program_id')->constrained()->onDelete('cascade');
            $table->integer('referrer_points')->default(0);
            $table->integer('referee_points')->default(0);
            $table->decimal('referee_discount', 8, 2)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('referral_programs');
        Schema::dropIfExists('reward_rules');
        Schema::dropIfExists('loyalty_tiers');
        Schema::dropIfExists('loyalty_programs');
    }
};
