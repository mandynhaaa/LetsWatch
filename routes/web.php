<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
    
    Route::get('/email/verify', 'showVerificationNotice')->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', 'resendVerificationEmail')->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});

Auth::routes([
    'login' => false, 
    'register' => false, 
    'verify' => false
]);

Route::get('/', [MovieController::class, 'index'])->name('index');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/home', [MovieController::class, 'home'])->name('home');
    Route::post('/swipe', [MovieController::class, 'storeSwipe'])->name('swipe'); 

    Route::get('/groups', [GroupController::class, 'listMyGroups'])->name('groups.index');
    Route::post('/groups/join', [GroupController::class, 'join'])->name('groups.join');
    Route::get('/groups/{group}/feedback/{tmdbMovieId}', [GroupController::class, 'showFeedbackForm'])->name('groups.feedback.create');
    Route::post('/groups/{group}/feedback/{tmdbMovieId}', [GroupController::class, 'storeFeedback'])->name('groups.feedback.store');
    Route::resource('groups', GroupController::class)->only(['create', 'store', 'show']);

    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::post('/account', [AccountController::class, 'update'])->name('account.update');
});