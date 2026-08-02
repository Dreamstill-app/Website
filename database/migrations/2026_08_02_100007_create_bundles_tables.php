<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bundles group sorted items for a drop-off trip.
     */
    public function up(): void
    {
        Schema::create('bundles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('decision')->nullable(); // resell | donate | repair | recycle
            $table->foreignId('partner_location_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index('user_id');
        });

        Schema::create('bundle_items', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('bundle_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('sort_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['bundle_id', 'sort_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bundle_items');
        Schema::dropIfExists('bundles');
    }
};
