<?php

use App\Http\Controllers\Auth\LoginController;
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

// logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// home 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas web
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
// autenticacion registro
Route::get('verify-code', [VerificationController::class, 'showVerifyCodeForm'])->name('verify.code.form');
Route::post('verify-code', [RegisterController::class, 'verifyCode'])->name('verify.code');
// autenticacion login
Route::get('verify-code-login', [VerificationController::class, 'showVerifyCodeFormLogin'])->name('verify.code.form.login');
Route::post('verify-code-login', [LoginController::class, 'verifyCodeLogin'])->name('verify.code.login');


Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('send.message');

Route::get('/chat/{user}', [ChatController::class, 'showChat'])->name('chat.show');
Route::post('/chat/{user}/send', [ChatController::class, 'sendMessage'])->name('chat.send');
