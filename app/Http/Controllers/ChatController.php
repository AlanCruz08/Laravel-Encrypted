<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ChatController extends Controller
{
    public function showChat(User $user)
    {
        // Obtener los mensajes entre el usuario actual y el usuario especificado
        $messages = Message::where(function ($query) use ($user) {
            $query->where('sender_id', auth()->user()->id)
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', auth()->user()->id);
        })->orderBy('created_at', 'asc')->get();

        return view('chat', compact('user', 'messages')); 
    }

    public function sendMessage(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $encryptedMessage = Crypt::encrypt($request->input('message'));

        Log:info('Mensaje encriptado: ' . $encryptedMessage);

        Message::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $user->id,
            'content' => $encryptedMessage, // Guardar en el campo 'content'
        ]);

        return redirect()->back()->with('status', 'Mensaje enviado correctamente'); 
    }
}