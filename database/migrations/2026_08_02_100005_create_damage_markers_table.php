<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Damage annotations — user-placed markers and vision-model detections.
     * Doubles as training labels for the Phase-9 custom model.
     */
    public function up(): void
    {
        Schema::create('damage_markers', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('sort_id')->constrained()->cascadeOnDelete();
            $table->string('image_type'); // front | back
            $table->string('damage_type'); // stain | damaged_text | shrinkage | faded_colour | pilling | tear | seam_breakage | missing_button | broken_zipper
            $table->unsignedTinyInteger('severity')->nullable(); // 1–3
            $table->decimal('x', 6, 5); // normalized 0–1
            $table->decimal('y', 6, 5); // normalized 0–1
            $table->string('source')->default('user'); // user | vision
            $table->timestamps();

            $table->index(['sort_id', 'source']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('damage_markers');
    }
};
