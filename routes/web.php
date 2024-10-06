<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas web
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('verify-code', [VerificationController::class, 'showVerifyCodeForm'])->name('verify.code.form');
Route::post('verify-code', [RegisterController::class, 'verifyCode'])->name('verify.code');


// use Illuminate\Support\Facades\Mail;

// Route::get('/send-email', function () {
//     $details = [
//         'title' => 'Correo de Prueba',
//         'body' => 'Este es un correo de prueba enviado desde Laravel usando Gmail SMTP.'
//     ];

//     Mail::raw($details['body'], function ($message) {
//         $message->to('carlosduron973@gmail.com') 
//                 ->subject('Prueba de Correo');
//         $message->from('carlosduron973@gmail.com', 'Chat_cifrado');
//     });

//     return 'Correo enviado con éxito';
// });
