<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

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
                'image' => 'default',
            ]);
        });
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
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

    public function getHighscoreRank(Game $game)
    {
        $highscoresData = DB::select( DB::raw("SELECT *, RANK() OVER (ORDER BY score DESC, updated_at) rank FROM highscores WHERE game_id = :gameid GROUP BY id, user_id, game_id, score, created_at, updated_at ORDER BY rank"), array(
            'gameid' => $game->id,
        ));

        $highscores = Highscore::hydrate($highscoresData);
        $highscoresLength = count($highscores);

        for ($i=0; $i < $highscoresLength; $i++){
            if ($highscores[$i]->user_id == $this->id){
                return $highscores[$i]->rank;
            }
        }
    }
}
