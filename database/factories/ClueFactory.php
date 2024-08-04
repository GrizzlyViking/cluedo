<?php

namespace Database\Factories;

use App\Enums\WhoWhatWhere;
use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clue>
 */
class ClueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'game_id' => Game::factory()->create()->id,
            'element' => fake()->randomElement(WhoWhatWhere::whoCards()),
            'row' => fake()->randomElement(WhoWhatWhere::whoCards()),
        ];
    }
}
