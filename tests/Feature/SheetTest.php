<?php

namespace Tests\Feature;

use App\Enums\State;
use App\Enums\WhoWhatWhere;
use App\Models\Game;
use App\Models\User;
use App\Utilities\Sheet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SheetTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_populate_sheet(): void
    {
        $game = Game::factory()->create();
        $game->participants()->attach($participants = User::factory()->count(6)->create());
        $game->save();

        $this->assertCount(6, $game->participants);

        $sheet = new Sheet($game);

        $sheet->initiate();
        $this->assertIsArray($game->clues->first()->row);
        $this->assertCount(6, $game->clues->first()->row);

        $participants->each(function ($participant) use ($game) {
            $this->assertDatabaseHas('participants', [
                'game_id' => $game->id,
                'user_id' => $participant->id,
            ]);
            $this->assertTrue(in_array(['name' => $participant->name, 'state' => State::unknown->name], $game->clues->first()->row));
        });

    }
}
