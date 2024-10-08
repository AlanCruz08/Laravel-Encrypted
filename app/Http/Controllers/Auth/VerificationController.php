<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    public function showVerifyCodeForm()
    {
        return view('auth.verify');
    }
}
