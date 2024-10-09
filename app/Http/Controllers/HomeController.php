<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        // Obtener los mensajes del usuario actual (como remitente o destinatario)
        $messages = Message::where(function ($query) {
            $query->where('sender_id', auth()->user()->id)
                ->orWhere('receiver_id', auth()->user()->id);
        })->get(); 
        return view('home', compact('users', 'messages'));
    }
}