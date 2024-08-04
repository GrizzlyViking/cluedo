<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SheetController;
use App\Models\Clue;
use App\Models\Game;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $game = Game::get()->first();

    $sheet = $game->clues->filter(function ($clue) {
        return $clue->user_id == auth()->id();
    })->groupBy(function (Clue $clue) {
        return $clue->element->cardType();
    });

    return Inertia::render('Dashboard', compact('game', 'sheet'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/sheet', [SheetController::class, 'show'])->middleware(['auth', 'verified'])->name('sheet.show');
Route::post('/sheet/{clue}', [SheetController::class, 'update'])->middleware(['auth', 'verified'])->name('clue.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
