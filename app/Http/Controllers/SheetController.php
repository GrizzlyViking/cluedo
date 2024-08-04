<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateClueRequest;
use App\Models\Clue;
use App\Models\Game;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SheetController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $game = Game::get()->first();

        $sheet = $game->clues->filter(function ($clue) {
            return $clue->user_id == auth()->id();
        })->sortBy('element')->groupBy(function (Clue $clue) {
            return $clue->element->cardType();
        });

        return Inertia::render('Dashboard', compact('game', 'sheet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Clue $clue, UpdateClueRequest $request)
    {
        $clue->row = Arr::map($clue->row, function ($row) use ($request) {
            if ($row['name'] == $request->name) {
                $row['state'] = $request->state;
            }

            return $row;
        });

        $clue->save();

        return to_route('sheet.show');
    }
}
