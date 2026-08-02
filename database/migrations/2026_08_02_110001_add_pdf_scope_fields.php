<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Scope additions from the SortyAI product requirements (July 31, 2026):
     * user points + persona, event submission workflow, sourced facts.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('total_points')->default(0)->after('preferences');
            // personal | donation_center | consignment (partner types = "coming soon")
            $table->string('account_type')->default('personal')->after('total_points');
            $table->json('social_links')->nullable()->after('account_type');
            $table->string('occupation')->nullable()->after('social_links');
        });

        Schema::table('events', function (Blueprint $table) {
            // pending | approved | rejected — admin-created events default approved
            $table->string('status')->default('approved')->after('is_published');
            $table->foreignId('submitted_by')->nullable()->after('status')->constrained('users')->nullOnDelete();
        });

        Schema::table('facts', function (Blueprint $table) {
            $table->string('source')->nullable()->after('category');
            $table->string('source_url')->nullable()->after('source');
            $table->unsignedSmallInteger('year')->nullable()->after('source_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('facts', function (Blueprint $table) {
            $table->dropColumn(['source', 'source_url', 'year']);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropConstrainedForeignId('submitted_by');
            $table->dropColumn('status');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['total_points', 'account_type', 'social_links', 'occupation']);
        });
    }
};
