<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Core sort records — one per garment assessment.
     * UUID primary keys (IDOR resistance, see docs/SECURITY.md §1).
     */
    public function up(): void
    {
        Schema::create('sorts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('status')->default('pending'); // pending | analyzed | accepted | rejected
            $table->string('decision')->nullable();       // resell | donate | repair | recycle
            $table->unsignedTinyInteger('condition_score')->nullable(); // 1–4
            $table->unsignedInteger('price_low')->nullable();  // CAD
            $table->unsignedInteger('price_high')->nullable(); // CAD
            $table->string('brand')->nullable();
            $table->string('category')->nullable(); // shirt | pants | dress | outerwear | shoes | accessory | other
            $table->json('analysis')->nullable();   // full engine output: damages, reasons, vision raw
            $table->string('analysis_source')->nullable(); // vision-llm | rules-only | custom-model
            $table->string('tree_version')->nullable();
            $table->string('model_version')->nullable();   // prompt/model or ML model version
            $table->string('corrected_decision')->nullable(); // user's correction → training label
            $table->text('feedback')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('analyzed_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
            $table->index('decision');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorts');
    }
};
