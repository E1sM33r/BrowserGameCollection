<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Request $request, Game $game)
    {

        $game->rateOnce($request->rating);

        return back();
    }
}
