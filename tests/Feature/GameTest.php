<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\Clue;
use App\Models\User;
use Tests\TestCase;

class GameTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_factory(): void
    {
        $game = Game::factory()->create();

        $this->assertInstanceOf(Game::class, $game);
    }

    public function test_add_participant(): void
    {
        $game = Game::factory()->create();
        $participant = User::factory()->create();
        $game->participants()->attach($participant);

        $this->assertTrue($game->participants->contains($participant));
    }

    public function test_many_rows_in_game_with_participants()
    {
        $game = Game::factory()->create();
        $game->participants()->attach(User::factory()->count(6)->create());
        $game->clues()->saveMany(Clue::factory()->count(12)->create());

        $this->assertCount(6, $game->participants);
        $this->assertTrue($game->participants->contains($game->participants()->first()));

        $this->assertCount(12, $game->clues);
        $this->assertTrue($game->clues->contains($game->clues()->first()));
    }
}
