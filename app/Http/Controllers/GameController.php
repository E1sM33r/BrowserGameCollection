<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Highscore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Spatie\Tags\Tag;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $search = '%'.$request->search.'%';

        if ($request->tagsGenre || $request->tagsControl || $request->tagsType){
            $gamesList = collect([]);
            if ($request->tagsGenre){
                $gamesListGenre = Game::withAnyTagsOfAnyType($request->tagsGenre)->where('title', 'LIKE', $search)->get();
                $gamesList = $gamesListGenre;
            }
            if ($request->tagsControl){
                $gamesListControl = Game::withAnyTagsOfAnyType($request->tagsControl)->where('title', 'LIKE', $search)->get();
                if ($gamesList->count() == 0){
                    $gamesList = $gamesListControl;
                }else{
                    $gamesFiltered = collect();
                    $gamesListDiff = $gamesList->diff($gamesListControl);
                    foreach ($gamesList as $game){
                        if (!$gamesListDiff->contains($game)){
                            $gamesFiltered->push($game);
                        }
                    }
                    $gamesList = $gamesFiltered;
                }
            }
            if ($request->tagsType){
                $gamesListType = Game::withAnyTagsOfAnyType($request->tagsType)->where('title', 'LIKE', $search)->get();
                if ($gamesList->count() == 0){
                    $gamesList = $gamesListType;
                }else{
                    $gamesFiltered = collect();
                    $gamesListDiff = $gamesList->diff($gamesListType);
                    foreach ($gamesList as $game){
                        if (!$gamesListDiff->contains($game)){
                            $gamesFiltered->push($game);
                        }
                    }
                    $gamesList = $gamesFiltered;
                }
            }
        }else{
            $gamesList = Game::where('title', 'LIKE', $search)->get();
        }

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

        $tagsGenre = $request->tagsGenre;
        $tagsControl = $request->tagsControl;
        $tagsType = $request->tagsType;

        return view('games.index', compact('games', 'selected', 'search', 'tagsGenre', 'tagsControl', 'tagsType'));
    }

    public  function show(Game $game)
    {
        // Alte Version ohne Rank
        //$highscores = Highscore::where('game_id', $game->id)->orderByDesc('score')->orderBy('updated_at')->take(10)->get();

        $highscoresData = DB::select( DB::raw("SELECT *, RANK() OVER (ORDER BY score DESC, updated_at) rank FROM highscores WHERE game_id = :gameid GROUP BY id, user_id, game_id, score, created_at, updated_at ORDER BY rank LIMIT 10"), array(
            'gameid' => $game->id,
        ));

        $highscores = Highscore::hydrate($highscoresData);

        $comments = collect($game->comments)->sortByDesc('created_at')->paginate(10);

        //dd($comments);

        return view('games.show', compact('game', 'highscores', 'comments'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function edit(Game $game)
    {
        $tags = Tag::all();

        return view('games.edit', compact('game', 'tags'));
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required|unique:games',
            'developer' => 'required',
            'description' => 'required',
            'image' => 'image',
            'realGame' => '',
            'tagsGenre' => 'required',
            'tagsControl' => 'required',
            'tagsType' => 'required',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('games', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 600);
            $image->save();

            $imageArray = ['image' => $imagePath];
            $data = array_slice($data, 0, 5);
        }else{
            $data = array_slice($data, 0, 4);
        }

        $id = Game::create(array_merge(
            $data,
            $imageArray ?? []
        ))->id;

        $game = Game::find($id);
        $game->attachTags($request->tagsGenre, 'genre');
        $game->attachTags($request->tagsControl, 'control');
        $game->attachTags($request->tagsType, 'type');

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
                'tagsGenre' => 'required',
                'tagsControl' => 'required',
                'tagsType' => 'required',
            ]);
        }else {
            $data = request()->validate([
                'title' => 'required|unique:games',
                'developer' => 'required',
                'description' => 'required',
                'image' => 'image',
                'realGame' => '',
                'tagsGenre' => 'required',
                'tagsControl' => 'required',
                'tagsType' => 'required',
            ]);
        }

        if (request('image')) {
            $imagePath = request('image')->store('games', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 600);
            $image->save();

            $imageArray = ['image' => $imagePath];
            $data = array_slice($data, 0, 5);
        }else{
            $data = array_slice($data, 0, 4);
        }

        $game->update(array_merge(
            $data,
            $imageArray ?? [],
        ));


        $game->syncTagsWithType(\request('tagsGenre'), 'genre');
        $game->syncTagsWithType(\request('tagsControl'), 'control');
        $game->syncTagsWithType(\request('tagsType'), 'type');

        return redirect()->route('game.show', $game->id);
    }
}
