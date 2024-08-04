<?php

namespace App\Models;

use App\Enums\WhoWhatWhere;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property array $row
 * @property string $element
 * @property User $user
 * @property Game $game
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Clue extends Model
{
    use HasFactory;

    protected $table = 'clues';

    protected $fillable = ['row', 'element', 'user_id', 'game_id'];

    protected $casts = [
        'row' => 'array',
        'element' => WhoWhatWhere::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
