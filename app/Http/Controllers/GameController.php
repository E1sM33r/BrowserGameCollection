<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Highscore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $search = '%'.$request->search.'%';

        $gamesList = Game::where('title', 'LIKE', $search)->get();

        if ($request->order == 'ratings'){
            $gamesList = $gamesList->sortByDesc(function ($game){return $game->usersRated().$game->averageRating().$game->likes->count();});
            $selected = 'total';
        }elseif ($request->order == 'averageRating'){
            $gamesList = $gamesList->sortByDesc(function ($game){return $game->averageRating().$game->usersRated().$game->likes->count();});
            $selected = 'average';
        }elseif ($request->order == 'likes'){
            $gamesList = $gamesList->sortByDesc(function ($game){return $game->likes->count().$game->averageRating().$game->usersRated();});
            $selected = 'likes';
        }else{
            $gamesList = $gamesList->sortBy('title', SORT_NATURAL|SORT_FLAG_CASE);
            $selected = 'title';
        }

        $games = collect($gamesList)->paginate(6);

        $search = str_replace('%', '', $search);

        return view('games.index', compact('games', 'selected', 'search'));
    }

    public  function show(Game $game)
    {
        // Alte Version ohne Rank
        //$highscores = Highscore::where('game_id', $game->id)->orderByDesc('score')->orderBy('updated_at')->take(10)->get();

        $highscoresData = DB::select( DB::raw("SELECT *, RANK() OVER (ORDER BY score DESC, updated_at) rank FROM highscores WHERE game_id = :gameid GROUP BY id, user_id, game_id, score, created_at, updated_at ORDER BY rank LIMIT 10"), array(
            'gameid' => $game->id,
        ));

        $highscores = Highscore::hydrate($highscoresData);

        return view('games.show', compact('game', 'highscores'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required|unique:games',
            'developer' => 'required',
            'description' => 'required',
            'image' => 'image',
            'realGame' => '',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('games', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 600);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }


        $id = Game::create(array_merge(
            $data,
            $imageArray ?? []
        ))->id;

        $game = Game::find($id);
        $game->attachTags($request->tags);

        return redirect()->route('game.show', $id);
    }

    public function update(Game $game)
    {
        if(request('title') == $game->title){
            $data = request()->validate([
                'title' => '',
                'developer' => 'required',
                'description' => 'required',
                'image' => 'image',
                'realGame' => '',
            ]);
        }else {
            $data = request()->validate([
                'title' => 'required|unique:games',
                'developer' => 'required',
                'description' => 'required',
                'image' => 'image',
                'realGame' => '',
            ]);
        }

        if (request('image')) {
            $imagePath = request('image')->store('games', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 600);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        $game->update(array_merge(
            $data,
            $imageArray ?? [],
        ));

        return redirect()->route('game.show', $game->id);
    }
}
