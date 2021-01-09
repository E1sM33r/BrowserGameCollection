<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        if((request('username') == $user->username) && (request('email') == $user->email)){
            $data = $request->validate([
                'name' => 'required|max:255',
                'username' => '',
                'email' => '',
            ]);
        }elseif(request('username') == $user->username){
            $data = $request->validate([
                'name' => 'required|max:255',
                'username' => '',
                'email' => 'required|email|max:255|unique:users',
            ]);
        }elseif(request('email') == $user->email){
            $data = $request->validate([
                'name' => 'required|max:255',
                'username' => 'required|max:255|unique:users',
                'email' => '',
            ]);
        }else{
            $data = $request->validate([
                'name' => 'required|max:255',
                'username' => 'required|max:255|unique:users',
                'email' => 'required|email|max:255|unique:users',
            ]);
        }

        $user->update($data);

        return redirect()->route('profiles.show', $user->username)->with('status', 'Accountdaten geändert');
    }

    public function editPW(User $user)
    {
        $this->authorize('update', $user);
        return view('users.changePW', compact('user'));
    }

    public function updatePW(Request $request, User $user)
    {
        $this->authorize('update', $user);
        
        if (Hash::check($request->oldPassword, $user->password)){
            $data = $request->validate([
                'password' => 'required|min:8|confirmed',
            ]);

            auth()->user()->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('profiles.show', $user->username)->with('status', 'Passwort geändert');
        }else{
            return back()->with('status', 'Aktuelles Passwort inkorrekt');
        }
    }

    public function destroy(User $user)
    {
        $this->authorize('update', $user);

        auth()->logout();

        $user->delete();

        return redirect()->route('home')->with('status', 'Account gelöscht');;

    }
}
