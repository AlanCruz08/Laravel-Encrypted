<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();

        if (!$currentUser) {
            return redirect()->route('login');
        }

        $contacts = DB::table('messages')
            ->where('sender_id', '=', $currentUser->id, 'and', 'receiver_id', '=', $currentUser->id)
            ->limit(50)
            ->get();

        if ($contacts->isEmpty()) {
            $contacts = collect();
        }

        $messages = collect();

        return view('message.index', compact('contacts','messages'));
    }
}
