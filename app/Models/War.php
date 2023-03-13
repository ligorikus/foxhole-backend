<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string war_id
 * @property int war_number
 * @property int winner
 * @property \DateTime conquest_start_time
 * @property \DateTime conquest_end_time
 * @property \DateTime resistance_start_time
 * @property int required_victory_towns
 * @property boolean is_active
 */
class War extends Model
{
    use HasFactory;

    protected $fillable = [
        'war_id',
        'war_number',
        'winner',
        'conquest_start_time',
        'conquest_end_time',
        'resistance_start_time',
        'required_victory_towns',
        'is_active'
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_wars')->withPivot(['fraction']);
    }
}
