<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use App\Utilities\Sheet;
use Illuminate\Database\Seeder;

class SheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $game = Game::firstOrCreate(
            ['name' => 'family game'],
            ['name' => 'family game']
        );

        $game->participants()->attach(User::all());

        $sheet = new Sheet($game);

        $sheet->initiate();
    }
}
