<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Game;
use App\Models\Clue;
use App\Models\User;
use Tests\TestCase;

class ClueTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_create_a_model(): void
    {
        $model = Clue::factory()->create();

        $this->assertInstanceOf(Clue::class, $model);
    }

    public function test_build_clue_in_game()
    {
        $game = Game::factory()->create();
        $clue = Clue::factory()->make();
        $game->clues()->save($clue);

        $this->assertCount(1,$game->clues);
        $this->assertTrue($game->clues->contains($clue));
    }

    public function test_connecting_games_to_row()
    {
        $clue = Clue::factory()->make();
        $game = Game::factory()->create();
        $clue->game()->associate($game)->save();

        $this->assertInstanceOf(Game::class, $clue->game);
        $game->refresh();
        $this->assertTrue($game->clues->contains($clue));
    }
}
