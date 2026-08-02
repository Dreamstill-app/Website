<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * The panel is now gated to role=admin (User::canAccessPanel). Existing
     * production users predate the role column, so grant the site owner
     * admin explicitly or the panel locks everyone out on deploy.
     */
    public function up(): void
    {
        DB::table('users')
            ->where('email', 'info@dreamstill.ca')
            ->update(['role' => 'admin']);
    }

    public function down(): void
    {
        DB::table('users')
            ->where('email', 'info@dreamstill.ca')
            ->update(['role' => 'user']);
    }
};
