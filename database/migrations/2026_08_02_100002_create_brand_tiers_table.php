<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Brand → pricing tier lookup used by the price estimator.
     * Admin-editable in Filament. See docs/decision-tree.md §Price estimation.
     */
    public function up(): void
    {
        Schema::create('brand_tiers', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->unique();
            $table->string('tier'); // luxury | premium | mainstream | fast_fashion
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand_tiers');
    }
};
