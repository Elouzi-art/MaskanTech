<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    /**
     * Liste des conversations (groupées par interlocuteur).
     */
    public function index()
    {
        $userId = Auth::id();

        // Récupérer les interlocuteurs uniques (dernier message par conversation)
        $conversations = Message::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver'])
            ->latest()
            ->get()
            ->groupBy(fn($m) => $m->sender_id === $userId ? $m->receiver_id : $m->sender_id)
            ->map(fn($msgs) => $msgs->first()); // dernier message de chaque conversation

        return view('messages.index', compact('conversations'));
    }

    /**
     * Conversation avec un utilisateur donné.
     */
    public function show(User $user)
    {
        $me = Auth::user();

        $messages = Message::where(fn($q) =>
                $q->where('sender_id', $me->id)->where('receiver_id', $user->id)
            )->orWhere(fn($q) =>
                $q->where('sender_id', $user->id)->where('receiver_id', $me->id)
            )
            ->orderBy('created_at')
            ->get();

        // Marquer comme lus
        Message::where('sender_id', $user->id)
               ->where('receiver_id', $me->id)
               ->where('is_read', false)
               ->update(['is_read' => true]);

        return view('messages.show', compact('messages', 'user'));
    }

    /**
     * Envoyer un message.
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message'     => 'required|string|max:2000',
            'property_id' => 'nullable|exists:properties,id',
        ]);

        Message::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'property_id' => $request->property_id,
            'message'     => $request->message,
        ]);

        // TODO: broadcast MessageSent event via Laravel Reverb

        return back()->with('success', 'Message envoyé.');
    }
}
