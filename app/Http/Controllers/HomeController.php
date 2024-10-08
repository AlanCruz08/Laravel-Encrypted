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

        $contactos = User::where('id', '!=', $currentUser->id)
            ->where(function ($query) use ($currentUser) {
                $query->whereHas('sentMessages', function ($q) use ($currentUser) {
                    $q->where('receiver_id', $currentUser->id);
                })->orWhereHas('receivedMessages', function ($q) use ($currentUser) {
                    $q->where('sender_id', $currentUser->id);
                });
            })
            ->get();

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
}
