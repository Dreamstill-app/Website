<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Circular-economy partner locations (thrift, repair, donation, recycler,
     * retail take-back). Admin-managed now; partner self-service later
     * (partner_user_id reserved for that).
     */
    public function up(): void
    {
        Schema::create('partner_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // thrift | repair | donation | recycler | retail_takeback
            $table->decimal('lat', 10, 7);
            $table->decimal('lng', 10, 7);
            $table->string('address');
            $table->string('city')->default('Vancouver');
            $table->json('hours')->nullable();
            $table->json('accepted_categories')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('partner_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index('type');
            $table->index(['lat', 'lng']);
            $table->index('is_published');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_locations');
    }
};
