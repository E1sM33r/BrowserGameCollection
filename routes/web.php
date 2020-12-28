<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfilesController;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

// Auth Routes

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [ResetPasswordController::class, 'sendResetLink'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->middleware('guest')->name('password.update');

// Other Routes

Route::get('/profile/{user}', [ProfilesController::class, 'show'])->name('profiles.show');
Route::get('/profile/{user}/edit', [ProfilesController::class, 'edit'])->name('profiles.edit');
Route::patch('/profile/{user}', [ProfilesController::class, 'update'])->name('profiles.update');

Route::get('/highscores', function () {
    return view('highscores.index');
})->name('highscores');

Route::get('/results', [GameController::class, 'index'])->name('results');
Route::post('/game', [GameController::class, 'store'])->name('game.store');
Route::get('/game/create', [GameController::class, 'create'])->name('game.create');
Route::get('/game/{game}', [GameController::class, 'show'])->name('game.show');

Route::get('/', function () {
    return view('home.index');
})->name('home');
