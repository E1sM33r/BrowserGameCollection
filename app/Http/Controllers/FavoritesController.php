<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Like;
use Illuminate\Http\Request;


class FavoritesController extends Controller
{
    public function index(Request $request)
    {
        $likes = Like::where('user_id', auth()->user()->id)->get();
        $ids = [];

        foreach ($likes as $like){
            array_push($ids, $like->game_id);
        }

        $gamesList = Game::whereIn('id', $ids)->get();

        if ($request->order == 'ratings'){
            $gamesList = $gamesList->sortByDesc(function ($game){return $game->usersRated().$game->averageRating();});
            $selected = 'total';
        }elseif ($request->order == 'averageRating'){
            $gamesList = $gamesList->sortByDesc(function ($game){return $game->averageRating().$game->usersRated();});
            $selected = 'average';
        }elseif ($request->order == 'likes'){
            $gamesList = $gamesList->sortByDesc(function ($game){return $game->likes->count().$game->averageRating();});
            $selected = 'likes';
        }else{
            $gamesList = $gamesList->sortBy('title', SORT_NATURAL|SORT_FLAG_CASE);
            $selected = 'title';
        }

        $games = collect($gamesList)->paginate(6);

        return view('favorites.index', compact('games', 'selected'));
    }
}
