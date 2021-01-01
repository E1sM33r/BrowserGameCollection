<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => ['index', 'store']]);
        $this->middleware('auth', ['only' => ['edit', 'update', 'editPW', 'changePW']]);
    }

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('home');

    }

    public function edit(User $user)
    {
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {

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
        return view('auth.changePW', compact('user'));
    }

    public function updatePW(Request $request, User $user)
    {
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
}
