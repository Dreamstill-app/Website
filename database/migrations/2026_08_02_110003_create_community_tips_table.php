<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Community tips: user-shared advice with optional image.
     * AI-moderated on submit; admin can remove.
     */
    public function up(): void
    {
        Schema::create('community_tips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('text');
            $table->string('image_path')->nullable();
            $table->string('status')->default('pending'); // pending | approved | rejected
            $table->string('moderation_reason')->nullable();
            $table->string('moderation_source')->nullable(); // ai | admin
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('community_tips');
    }
};
