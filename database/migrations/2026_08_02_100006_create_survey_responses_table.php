<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The capstone survey — one optional response per sort.
     * All fields nullable: the survey is skippable in the app.
     */
    public function up(): void
    {
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('sort_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('reason')->nullable();      // dont_like | closet_cleanout | doesnt_fit
            $table->string('time_owned')->nullable();  // lt_6m | 6m_1y | 1_2y | 2_5y | gt_5y
            $table->boolean('thrifted')->nullable();
            $table->string('style')->nullable();       // fast_fashion | microtrend | athleisure | luxury | handmade | other
            $table->string('times_worn')->nullable();  // once | 1_5 | 5_30 | 30_50 | 50_100 | gt_100
            $table->decimal('purchase_price', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_responses');
    }
};
