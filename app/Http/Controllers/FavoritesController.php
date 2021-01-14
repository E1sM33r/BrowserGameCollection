<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Like;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function index()
    {
        $likes = Like::where('user_id', auth()->user()->id)->get();
        $ids = [];

        foreach ($likes as $like){
            array_push($ids, $like->game_id);
        }

        $games = Game::whereIn('id', $ids)->paginate(6);

        return view('favorites.index', compact('games'));
    }
}
