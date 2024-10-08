<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validación de los datos
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Crear código de verificación
        $verificationCode = Str::random(6); // Genera un código aleatorio
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash('sha256', $request->password), // Aquí usamos SHA-256
            'verification_code' => $verificationCode,
            'is_verified' => false,
        ]);
    
        // Enviar el correo
        Mail::to($user->email)->send(new VerificationMail($verificationCode));
    
        // Redirigir al formulario de verificación de código
        return redirect()->route('verify.code.form')->with('status', 'Se ha enviado un código de verificación a tu correo.');
    }
    

    public function verifyCode(Request $request)
    {
        $user = User::where('verification_code', $request->verification_code)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['verification_code' => 'Código inválido']);
        }

        // Activar el usuario
        $user->is_verified = true;
        $user->verification_code = null; // Limpia el código de verificación
        $user->save();

        return redirect()->route('login')->with('status', 'Tu cuenta ha sido verificada exitosamente.');
    }

    public function showRegistrationForm()
    {
        return view('auth.register'); // Esta es la vista donde tienes tu formulario de registro.
    }
}
