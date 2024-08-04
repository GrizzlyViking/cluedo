<?php

namespace App\Utilities;

use App\Enums\State;
use App\Enums\WhoWhatWhere;
use App\Models\Game;
use App\Models\User;

class Sheet
{
    public function __construct(protected Game $game)
    {}

    public function initiate(): void
    {
        $this->game->participants->each(function (User $participant) {
            collect(WhoWhatWhere::cases())->map(function (WhoWhatWhere $clue) use ($participant) {
                return $this->game->clues()->create([
                    'row' => $this->game->participants->map(fn (User $participant) => ['name' => $participant->name, 'state' => State::unknown->name])->toArray(),
                    'element' => $clue->value,
                    'user_id' => $participant->id,
                    'game_id' => $this->game->id,
                ]);
            });
        });
    }
}
