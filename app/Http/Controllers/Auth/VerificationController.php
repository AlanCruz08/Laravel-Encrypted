<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function showVerifyCodeForm()
    {
        return view('auth.verify');  // Vista donde el usuario ingresa el código
    }

    public function showVerifyCodeFormLogin(){
        return view('auth.verifyLogin');
    }
}
