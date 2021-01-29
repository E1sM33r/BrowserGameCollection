<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;
use willvincent\Rateable\Rateable;

class Game extends Model
{
    protected $guarded = [];

    use HasFactory, Rateable, HasTags;

    public function gameImage()
    {
        $imagePath = ($this->image) ? $this->image : 'default';

        if ($imagePath == 'default'){
            return '/images/defaultImages/GameDefault.png';
        }else{
            return '/storage/' . $imagePath;
        }
    }

    public function hasHighscore(User $user)
    {
        return $this->highscores->contains('user_id', $user->id);
    }

    public function hasLiked(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    public function highscores()
    {
        return $this->hasMany(Highscore::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
