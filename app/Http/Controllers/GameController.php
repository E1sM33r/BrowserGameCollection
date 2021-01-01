<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Highscore;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::paginate(6);

        return view('games.index', compact('games'));
    }

    public  function show(Game $game)
    {
        $highscores = Highscore::where('game_id', $game->id)->orderByDesc('score')->orderBy('updated_at')->get();


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
