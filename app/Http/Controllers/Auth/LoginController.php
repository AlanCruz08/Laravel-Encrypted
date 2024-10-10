<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerificationMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Mostramos el formulario de inicio de sesión
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Intentar iniciar sesión
    protected function attemptLogin(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');

        // Buscamos al usuario por su email
        $user = User::where('email', $credentials['email'])->first();

        // Verificamos si existe el usuario
        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'Usuario no encontrado.']);
        }

        // Verificamos si la contraseña SHA-256 coincide
        if (hash('sha256', $credentials['password']) !== $user->password) {
            return redirect()->back()->withErrors(['password' => 'Contraseña incorrecta.']);
        }

        // $guardado= $user->is_verified == 0;

        // dump($guardado);

        // Si la cuenta no está verificada, enviamos el código de verificación y redirigimos a la vista de verificación
        if ($user->is_verified == 0) {
            // Enviar el código de verificación por email
            $this->sendVerificationCode($user);

            // Guardar el ID del usuario temporalmente en sesión hasta que se verifique
            session(['unverified_user_id' => $user->id]);

            // Redirigimos al formulario de verificación para introducir el código
            return redirect()->route('verify.code.form.login')->with('status', 'Tu cuenta no está verificada. Se ha enviado un código a tu correo.');
        }

        // Si el usuario ya está verificado, autenticamos al usuario
        Auth::login($user);

        // Redirigimos a la página principal
        return redirect('/home');
    }

    // Método para cerrar sesión y resetear is_verified
    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            // Cambiar is_verified a 0
            $user->is_verified = 0;
            $user->save();
        }

        // Cerrar sesión
        Auth::logout();

        // Redirigir a la página de login
        return redirect('/login');
    }

    // Método para enviar el código de verificación por email
    protected function sendVerificationCode($user)
    {
        $verificationCode = Str::random(6);
        $user->verification_code = $verificationCode;
        $user->save();

        Mail::to($user->email)->send(new VerificationMail($verificationCode));
    }

    // Método para verificar el código ingresado en el formulario
    public function verifyCodeLogin(Request $request)
    {
        // Obtener el ID del usuario no verificado almacenado en la sesión
        $userId = session('unverified_user_id');
        $user = User::find($userId);

        // Verificar si se ha obtenido un usuario
        if (!$user) {
            return redirect()->back()->withErrors(['error' => 'No se ha encontrado un usuario.']);
        }

        // Verificamos si el código de verificación es correcto
        if ($user->verification_code === $request->verification_code) {
            // Actualizamos el estado de verificación
            $user->is_verified = 1;
            $user->verification_code = null;
            $user->save();

            // Autenticamos al usuario después de la verificación
            Auth::login($user);

            // Limpiar la sesión
            session()->forget('unverified_user_id');

            // Redirigimos a la página principal
            return redirect()->route('home');
        } else {
            return redirect()->back()->withErrors(['verification_code' => 'El código es incorrecto.']);
        }
    }
}
