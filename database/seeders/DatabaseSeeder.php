<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->createMany([[
            'name' => 'Papa',
            'email' => 'sebastian@schlossberg-edelmann.com',
            'password' => bcrypt('gokqaq-jegdy7-fadwoC'),
        ], [
            'name' => 'Mummy',
            'email' => 'natalia@schlossberg-edelmann.com',
            'password' => bcrypt('bamby'),
        ], [
            'name' => 'Livia',
            'email' => 'livia@schlossberg-edelmann.com',
            'password' => bcrypt('PinPon2017'),
        ]]);

        $this->call([
            SheetSeeder::class,
        ]);
    }
}
