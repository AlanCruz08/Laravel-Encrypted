<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $currentUser = Auth::user();

        $contactos = $this->getContactInfo($currentUser);

        return view('home', compact('contactos'));
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
                'name' => $contact->name,
                'message' => $lastMessage ? $lastMessage->content : 'No hay mensajes',
                'hour' => $lastMessage ? $lastMessage->created_at->format('H:i') : 'No disponible',
            ];
        });
    }

}
