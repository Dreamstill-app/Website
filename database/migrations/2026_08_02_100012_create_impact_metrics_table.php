<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pre-computed impact rollups (nightly job). user_id NULL = platform-wide.
     * Served to the app home screen and the Filament impact dashboard.
     */
    public function up(): void
    {
        Schema::create('impact_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('period')->default('all_time'); // all_time | YYYY-MM
            $table->unsignedInteger('sorts_total')->default(0);
            $table->json('by_decision')->nullable(); // {"resell": n, "donate": n, ...}
            $table->decimal('ghg_kg_avoided', 12, 3)->default(0);
            $table->decimal('textiles_kg_diverted', 12, 3)->default(0);
            $table->timestamp('computed_at')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'period']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impact_metrics');
    }
};
