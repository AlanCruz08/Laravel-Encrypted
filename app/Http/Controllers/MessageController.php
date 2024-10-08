<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $encryptedMessage = Crypt::encrypt($request->input('message'));

        Message::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $user->id,
            'message' => $encryptedMessage, // Guardar en el campo 'message'
        ]);

        // Puedes retornar una respuesta adecuada, como una redirección o un mensaje de éxito.
        return redirect()->back()->with('status', 'Mensaje enviado correctamente'); 
    }
}