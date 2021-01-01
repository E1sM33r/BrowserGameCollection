<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function($user) {
            $user->profile()->create([
                'description' => "Keine Beschreibung vorhanden...",
                'image' => '/profile/default/90FudTwfyrxMl6BJkTdqqxN3E9qK6yHnUq7P7YlU.png',
            ]);
        });
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function highscores()
    {
        return$this->hasMany(Highscore::class);
    }

    public function hasHighscore(Game $game)
    {
        $highscores = $this->highscores;

        foreach ($highscores as $highscore){
            if ($highscore->game_id == $game->id){
                return $highscore->score;
            }
        }

        return '0';
    }
}
