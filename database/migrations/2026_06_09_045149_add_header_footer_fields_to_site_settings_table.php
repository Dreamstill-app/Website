<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('logo_path')->nullable()->after('top_ribbon');
            $table->string('header_cta_label')->nullable()->after('logo_path');
            $table->string('header_cta_url')->nullable()->after('header_cta_label');
            $table->text('footer_cta_text')->nullable()->after('footer_blurb');
            $table->string('footer_cta_button_label')->nullable()->after('footer_cta_text');
            $table->string('footer_cta_button_url')->nullable()->after('footer_cta_button_label');
            $table->string('mobile_cta_primary_label')->nullable()->after('footer_cta_button_url');
            $table->string('mobile_cta_primary_url')->nullable()->after('mobile_cta_primary_label');
            $table->string('mobile_cta_secondary_label')->nullable()->after('mobile_cta_primary_url');
            $table->string('mobile_cta_secondary_url')->nullable()->after('mobile_cta_secondary_label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'logo_path',
                'header_cta_label',
                'header_cta_url',
                'footer_cta_text',
                'footer_cta_button_label',
                'footer_cta_button_url',
                'mobile_cta_primary_label',
                'mobile_cta_primary_url',
                'mobile_cta_secondary_label',
                'mobile_cta_secondary_url',
            ]);
        });
    }
};
