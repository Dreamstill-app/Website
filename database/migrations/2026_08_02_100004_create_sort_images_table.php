<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Images attached to a sort. Stored on the private disk under
     * sorts/{userId}/{sortId}/ — served only through an authorized controller.
     */
    public function up(): void
    {
        Schema::create('sort_images', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('sort_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // front | back | tag | marked
            $table->string('path');
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->unsignedInteger('bytes')->nullable();
            $table->string('sha256', 64)->nullable();
            $table->timestamps();

            $table->unique(['sort_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sort_images');
    }
};
