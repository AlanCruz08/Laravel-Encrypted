<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Events\NewMessage;
use Illuminate\Support\Facades\DB;

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

        $contactos = DB::table('users as u')
        ->select('u.*', 
                DB::raw('(SELECT content FROM messages as m
                        WHERE (m.sender_id = ' . auth()->user()->id . '
                        AND  m.receiver_id = u.id) 
                        OR (m.receiver_id = ' . auth()->user()->id . '
                        AND m.sender_id = u.id)
                        ORDER BY m.created_at DESC LIMIT 1) as lastMessage'),
                DB::raw('(SELECT DATE_FORMAT(m.created_at, "%H:%i") 
                        FROM messages as m
                        WHERE (m.sender_id = ' . auth()->user()->id . '
                        AND  m.receiver_id = u.id) 
                        OR (m.receiver_id = ' . auth()->user()->id . '
                        AND m.sender_id = u.id)
                        ORDER BY m.created_at DESC 
                        LIMIT 1) as hora'))
        ->where('u.id', '!=', auth()->user()->id)
        ->get();


        return view('chat', compact('user', 'messages', 'contactos')); 
    }

    public function sendMessage(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $encryptedMessage = Crypt::encrypt($request->input('message'));

        Log:info('Mensaje encriptado: ' . $encryptedMessage);

        $message = Message::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $user->id,
            'content' => $encryptedMessage, 
        ]);
    
        event(new NewMessage($message)); // Ahora $message está definido
    
        return redirect()->back()->with('status', 'Mensaje enviado correctamente'); 
    }
}