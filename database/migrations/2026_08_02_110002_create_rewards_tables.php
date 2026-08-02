<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Rewards catalog + user claims. Claims notify info@dreamstill.ca.
     */
    public function up(): void
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('points_cost');
            $table->string('reward_type')->default('discount_code'); // discount_code | voucher | other
            $table->string('partner_name')->nullable(); // e.g. thrift store offering the discount
            $table->string('image_path')->nullable();
            $table->unsignedInteger('stock')->nullable(); // null = unlimited
            $table->dateTime('expires_at')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index(['is_published', 'expires_at']);
        });

        Schema::create('reward_claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reward_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('points_spent');
            $table->string('status')->default('claimed'); // claimed | fulfilled | cancelled
            $table->timestamps();

            $table->index(['user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_claims');
        Schema::dropIfExists('rewards');
    }
};
