<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function show($user)
    {
        $user = User::where('username', $user)->firstOrFail();

        return view('profiles.show', [
            'user' => $user,
        ]);
    }
}
