<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property Collection<User> $participants
 * @property Collection<Clue> $clue
 */
class Game extends Model
{
    use HasFactory;

    protected $table = 'games';

    protected $fillable = ['name'];

    protected $with = ['participants','clues'];

    public function clues(): HasMany
    {
        return $this->hasMany(Clue::class, 'game_id');
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'participants', 'game_id', 'user_id');
    }
}
