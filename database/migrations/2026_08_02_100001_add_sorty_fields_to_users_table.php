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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('password'); // user | partner | admin
            $table->boolean('is_guest')->default(false)->after('role');
            $table->string('avatar_path')->nullable()->after('is_guest');
            $table->string('city')->nullable()->after('avatar_path');
            $table->string('postal_prefix', 3)->nullable()->after('city');
            $table->json('preferences')->nullable()->after('postal_prefix');
            $table->softDeletes();

            $table->index('role');
            $table->index('is_guest');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropIndex(['is_guest']);
            $table->dropColumn([
                'role',
                'is_guest',
                'avatar_path',
                'city',
                'postal_prefix',
                'preferences',
                'deleted_at',
            ]);
        });
    }
};
