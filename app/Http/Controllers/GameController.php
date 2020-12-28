<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        return view('games.index');
    }

    public  function show(Game $game)
    {
        return view('games.show', compact('game'));
    }

    public function create()
    {
        return view('games.create');
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required',
            'developer' => 'required',
            'description' => 'required',
            'image' => 'image',
        ]);

        $id = Game::create($data)->id;

        return redirect()->route('game.show', $id);
    }
}
