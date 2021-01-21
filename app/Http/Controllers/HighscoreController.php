<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Highscore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HighscoreController extends Controller
{
    public function index(Game $game)
    {
        $games = Game::all();

        //$highscores = Highscore::where('game_id', $game->id)->orderByDesc('score')->orderBy('updated_at')->paginate(1);

        $highscoresData = DB::select( DB::raw("SELECT *, RANK() OVER (ORDER BY score DESC, updated_at) rank FROM highscores WHERE game_id = :gameid GROUP BY id, user_id, game_id, score, created_at, updated_at ORDER BY rank LIMIT 10"), array(
            'gameid' => $game->id,
        ));

        $highscoresList = Highscore::hydrate($highscoresData);

        $highscores = collect($highscoresList)->paginate(50);

        $selected = $game;

        return view('highscores.index', compact('games', 'highscores', 'selected'));
    }

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
