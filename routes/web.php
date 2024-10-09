<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rutas Login y registro
Route::get('/', [LoginController::class,'showLoginForm'])->name('login');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('verify-code', [VerificationController::class, 'showVerifyCodeForm'])->name('verify.code.form');
Route::post('verify-code', [RegisterController::class, 'verifyCode'])->name('verify.code');

// Rutas de mensajes
Route::get('/new-message', [MessageController::class, 'newMessage'])->name('new.message');
Route::get('/conversation/{contactId}', [MessageController::class, 'showConversation'])->name('conversation');
Route::post('/send-message/{contactId}', [MessageController::class, 'sendMessage'])->name('sendMessage');
Route::post('/search-user', [MessageController::class, 'searchUser'])->name('searchUser');

Route::get('/mensajes/{contacto}', [MessageController::class, 'show'])->name('mensajes.show');