<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Caas::factory(20)->create();

        \App\Models\User::factory()->create([
            'nim' => '1234',
            'password' => '1234',
            'is_admin' => true,
        ]);

        \App\Models\Role::factory()->createMany([
            [
                'name' => 'Fire Opal',
                'description' => 'BERAPI-API',
                'image' => '/assets/Gems Card/Gems (1).webp',
                'quota' => 20,
            ],
            [
                'name' => 'Radiant Quartz',
                'description' => 'MENYALA-NYALA',
                'image' => '/assets/Gems Card/Gems (6).webp',
                'quota' => 20,
            ],
            [
                'name' => 'Crystal Of The Prism',
                'description' => 'PRISMA',
                'image' => '/assets/Gems Card/Gems (7).webp',
                'quota' => 20,
            ],
            [
                'name' => 'Moonstone',
                'description' => 'BULAN',
                'image' => '/assets/Gems Card/Gems (8).webp',
                'quota' => 20,
            ],
            [
                'name' => 'Opal Gem',
                'description' => 'WISDOM',
                'image' => '/assets/Gems Card/Gems (9).webp',
                'quota' => 20,
            ],
        ]);
    }
}
