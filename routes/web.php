<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/email/verify', 'showVerificationNotice')->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', 'resendVerificationEmail')->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [MovieController::class, 'index'])->name('home');
    Route::post('/swipe', [MovieController::class, 'storeSwipe'])->name('swipe');
    Route::post('/groups/join', [GroupController::class, 'join'])->name('groups.join');
    Route::resource('groups', GroupController::class)->only(['create', 'store', 'show']);
    Route::get('/groups/{group}/feedback/{tmdbMovieId}', [GroupController::class, 'showFeedbackForm'])->name('groups.feedback.create');
    Route::post('/groups/{group}/feedback/{tmdbMovieId}', [GroupController::class, 'storeFeedback'])->name('groups.feedback.store');
});