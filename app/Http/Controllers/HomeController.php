<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $games = Game::where('realGame', 'true')->paginate(6);

        //$games = Game::withAllTags(['Jump&Run', 'Arcade', 'Shooter'])->paginate(5);

        return view('home.index', compact('games'));
    }
}
