<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas Login y registro
Route::get('/', function () {
    return view('auth.login');
});
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('verify-code', [VerificationController::class, 'showVerifyCodeForm'])->name('verify.code.form');
Route::post('verify-code', [RegisterController::class, 'verifyCode'])->name('verify.code');
Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('send.message');
Route::get('/chat/{user}', [ChatController::class, 'showChat'])->name('chat.show');
Route::post('/chat/{user}/send', [ChatController::class, 'sendMessage'])->name('chat.send');

Route::get('/mensajes/{contacto}', [MessageController::class, 'show'])->name('mensajes.show');

