<?php

namespace App\Console\Commands;

use App\Models\Clue;
use App\Models\Game;
use App\Models\User;
use App\Utilities\Sheet;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class reset extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sheet:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will reset sheet for all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $game = Game::first();
        $game->participants()->detach();
        $game->participants()->attach(User::all());

        $sheet = new Sheet($game);

        Clue::query()->truncate();

        $sheet->initiate();

    }
}
