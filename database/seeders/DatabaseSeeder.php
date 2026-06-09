<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'info@dreamstill.ca'],
            [
                'name' => 'DreamStill Admin',
                'password' => bcrypt('DreamStill123#@$'),
                'email_verified_at' => now(),
            ]
        );

        $this->call(CmsSeeder::class);
        $this->call(PageSectionsSeeder::class);
    }
}
