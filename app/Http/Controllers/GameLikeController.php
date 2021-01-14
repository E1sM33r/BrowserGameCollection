<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Game $game, Request $request)
    {
        if (!$game->hasLiked($request->user())) {

            $game->likes()->create([
                'user_id' => $request->user()->id,
            ]);
        }
            return back();
    }

    public function destroy(Game $game, Request $request)
    {
        $request->user()->likes()->where('game_id', $game->id)->delete();

        return back();
    }
}
