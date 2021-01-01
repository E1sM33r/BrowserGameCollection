<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class HighscoreController extends Controller
{
    public function store(Game $game, Request $request)
    {
        if ($game->hasHighscore($request->user())){
            $game->highscores()->update([
                'user_id' => $request->user()->id,
                'score' => $request->highscore,
            ]);
        }else{
            $game->highscores()->create([
                'user_id' => $request->user()->id,
                'score' => $request->highscore,
            ]);
        }

        return back();
    }
}
