<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Game;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Game $game, Request $request)
    {
        $data = $request->validate([
            'comment' => 'required|max:800',
        ]);

        $game->comments()->create([
            'user_id' => $request->user()->id,
            'comment' => $data['comment'],
        ]);

        return back();
    }

    public function destroy(Comment $comment)
    {
        if ($comment->ownedBy(auth()->user())){
            $comment->delete();
        }

        return back();
    }

}
