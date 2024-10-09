<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function attemptLogin(Request $request)
    {
        // Obtenemos las credenciales ingresadas en el formulario de login
        $credentials = $request->only($this->username(), 'password');

        // Buscamos al usuario en la base de datos usando su email
        $user = \App\Models\User::where('email', $credentials['email'])->first();

        // Verificamos si el usuario está verificado
        if ($user && !$user->is_verified) {
            return redirect()->back()->withErrors(['email' => 'Debes verificar tu cuenta antes de iniciar sesión.']);
        }

        // Verificamos si la contraseña SHA-256 es igual a la ingresada
        if ($user && hash('sha256', $credentials['password']) === $user->password) {
            // Si coincide, autenticamos al usuario manualmente
            Auth::login($user);
            return true;
        }

        // Si no coincide o no existe el usuario, devolvemos false
        return false;
    }

    protected function authenticated(Request $request, $user)
    {
        session()->flash('login_success', 'Inicio de sesión exitoso.');
        
        return redirect()->route('chat.show', 1); // Redirige al "home" después del login
    }
}
