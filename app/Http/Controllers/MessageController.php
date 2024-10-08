<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function showConversation($contactId = null)
    {
        $currentUser = Auth::user();
        
        // Si no hay contacto seleccionado, `$contact` será null.
        $contact = $contactId ? User::find($contactId) : null;

        if ($contact && !$contact->exists) {
            return redirect()->route('home')->with('error', 'Contacto no encontrado');
        }

        // Obtener los contactos
        $contactos = User::where('id', '!=', $currentUser->id)
            ->where(function ($query) use ($currentUser) {
                $query->whereHas('sentMessages', function ($q) use ($currentUser) {
                    $q->where('receiver_id', $currentUser->id);
                })->orWhereHas('receivedMessages', function ($q) use ($currentUser) {
                    $q->where('sender_id', $currentUser->id);
                });
            })
            ->get();

        $selectedContact = User::find($contactId);
        $mensajes = Message::where(function ($query) use ($currentUser, $selectedContact) {
            $query->where('sender_id', $currentUser->id)
                ->where('receiver_id', $selectedContact->id);
        })
        ->orWhere(function ($query) use ($currentUser, $selectedContact) {
            $query->where('sender_id', $selectedContact->id)
                ->where('receiver_id', $currentUser->id);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        // Pasar a la vista
        return view('home', compact('contact', 'mensajes', 'contactos', 'selectedContact'));
    }


    public function sendMessage(Request $request, $contactId)
    {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $currentUser = Auth::user();

        // Verificar si el contacto existe
        $contact = User::find($contactId);
        if (!$contact) {
            return redirect()->route('home')->with('error', 'Contacto no encontrado');
        }

        // Crear un nuevo mensaje
        $mensaje = new Message();
        $mensaje->content = $request->message;
        $mensaje->sender_id = $currentUser->id;
        $mensaje->receiver_id = $contactId;
        $mensaje->save();

        return redirect()->route('conversation', $contactId)->with('success', 'Mensaje enviado');
    }
}
