<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use League\OAuth2\Server\Entities\UserEntityInterface;
use PhpParser\Builder;

class User extends Authenticatable implements UserEntityInterface
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'steam_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    public function getIdentifier()
    {
        return $this->id;
    }

    public function wars(): BelongsToMany
    {
        return $this->belongsToMany(War::class, 'user_wars')->withPivot(['fraction']);
    }

    public function currentWar(): BelongsToMany
    {
        return $this->belongsToMany(War::class, 'user_wars')->where('is_active', true)->withPivot(['fraction']);
    }
}
