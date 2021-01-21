<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameLikeController;
use App\Http\Controllers\HighscoreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
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
Route::get('/account/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::get('/account/{user}/changepw', [UserController::class, 'editPW'])->name('user.editPW');
Route::patch('/account/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/account/{user}/delete', [UserController::class, 'destroy'])->name('user.delete');
Route::patch('/achangepw/{user}', [UserController::class, 'updatePW'])->name('user.updatePW');


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

Route::get('/highscores', [HighscoreController::class, 'index'])->name('highscores');
Route::get('/highscores/{game}', [HighscoreController::class, 'index'])->name('highscores.game');

Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites');

Route::get('/results', [GameController::class, 'index'])->name('results');
Route::post('/game', [GameController::class, 'store'])->name('game.store');
Route::get('/game/create', [GameController::class, 'create'])->name('game.create');
Route::get('/game/{game}', [GameController::class, 'show'])->name('game.show');
Route::get('/game/{game}/edit', [GameController::class, 'edit'])->name('game.edit');
Route::patch('/game/{game}', [GameController::class, 'update'])->name('game.update');
Route::post('/game/{game}/highscore', [HighscoreController::class, 'store'])->name('game.addHighscore');
Route::post('/game/{game}/rate', [RatingController::class, 'store'])->name('game.rate');

Route::post('/game/{game}/likes', [GameLikeController::class, 'store'])->name('game.like');
Route::delete('/game/{game}/likes', [GameLikeController::class, 'destroy'])->name('game.like');

Route::get('/', [HomeController::class, 'index'])->name('home');
