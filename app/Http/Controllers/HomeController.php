<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $currentUser = Auth::user();

        if (!$currentUser) {
            return redirect()->route('login');
        }

        $contactos = $this->getContactInfo($currentUser);

        $selectedContact = null;
        $mensajes = collect();

        if ($request->has('contact_id')) {
            $selectedContact = User::find($request->contact_id);
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
        }

        return view('home', compact('contactos', 'mensajes', 'selectedContact'));
    }

    private function getContactInfo($currentUser)
    {
        $contacts = User::whereIn('id', function ($query) use ($currentUser) {
            $query->selectRaw('CASE 
                                    WHEN sender_id = ? THEN receiver_id 
                                    ELSE sender_id 
                                END as contact_id', [$currentUser->id])
                  ->from('messages')
                  ->where(function ($query) use ($currentUser) {
                      $query->where('sender_id', $currentUser->id)
                            ->orWhere('receiver_id', $currentUser->id);
                  })
                  ->distinct();
        })->get();
    
        return $contacts->map(function ($contact) use ($currentUser) {
            $lastSentMessage = $contact->sentMessages()->latest()->first();
            $lastReceivedMessage = $contact->receivedMessages()->latest()->first();
    
            if ($lastSentMessage && $lastReceivedMessage) {
                $lastMessage = $lastSentMessage->created_at > $lastReceivedMessage->created_at ? $lastSentMessage : $lastReceivedMessage;
            } elseif ($lastSentMessage) {
                $lastMessage = $lastSentMessage;
            } elseif ($lastReceivedMessage) {
                $lastMessage = $lastReceivedMessage;
            } else {
                $lastMessage = null;
            }
    
            return [
                'id' => $contact->id,
                'name' => $contact->name,
                'message' => $lastMessage ? $lastMessage->content : 'No hay mensajes',
                'hour' => $lastMessage ? $lastMessage->created_at->format('H:i') : 'No disponible',
            ];
        });
    }
}
