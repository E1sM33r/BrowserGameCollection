<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class HighscoreController extends Controller
{
    public function store(Game $game, Request $request)
    {
        if ($game->hasHighscore($request->user())){
            $request->user()->highscores->where('game_id', $game->id)->first()->update([
                'game_id' => $game->id,
                'score' => $request->highscore,
            ]);
        }else{
            $request->user()->highscores()->create([
                'game_id' => $game->id,
                'score' => $request->highscore,
            ]);
        }

        return back();
    }
}
