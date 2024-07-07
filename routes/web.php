<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::view('/login', 'pages.auth.login');

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/chat/{id}',[DashboardController::class,'gotoChat'])->name('chat');
    Route::get('/app/{id}',[DashboardController::class,'gotoChatApp'])->name('chatApp');
});
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
