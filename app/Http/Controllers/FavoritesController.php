<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class FavoritesController extends Controller
{
    public function index(Request $request)
    {

        if ($request->order == 'ratings'){
            $order = function ($game){return $game->usersRated();};
            $selected = 'total';
        }elseif ($request->order == 'averageRating'){
            $order = function ($game){return $game->averageRating();};
            $selected = 'average';
        }elseif ($request->order == 'likes'){
            $order = function ($game){return $game->likes->count();};
            $selected = 'likes';
        }else{
            $order = 'title';
            $selected = 'title';
        }


        $likes = Like::where('user_id', auth()->user()->id)->get();
        $ids = [];

        foreach ($likes as $like){
            array_push($ids, $like->game_id);
        }

        $gamesList = Game::whereIn('id', $ids)->get();

        if($request->order == 'title'){
            $gamesList = $gamesList->sortBy($order, SORT_NATURAL|SORT_FLAG_CASE);
        }else{
            $gamesList = $gamesList->sortByDesc($order);
        }

        $games = collect($gamesList)->paginate(6);

        return view('favorites.index', compact('games', 'selected'));
    }
}
