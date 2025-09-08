<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function users(Request $request)
    {
        $currentUserId = Auth::id();
        $query = $request->get('query');

        $users = User::query()
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%");
            })
            ->where('id', '!=', $currentUserId)
            ->orderBy('name')
            ->select('id', 'name')
            ->limit(20)
            ->get();

        return response()->json($users);
    }

    public function messages(Request $request, int $userId)
    {
        $currentUserId = Auth::id();
        $sinceId = $request->integer('since_id');

        $messagesQuery = Message::where(function ($q) use ($currentUserId, $userId) {
                $q->where('sender_id', $currentUserId)->where('receiver_id', $userId);
            })
            ->orWhere(function ($q) use ($currentUserId, $userId) {
                $q->where('sender_id', $userId)->where('receiver_id', $currentUserId);
            })
            ->orderBy('id', 'asc');

        if ($sinceId) {
            $messagesQuery->where('id', '>', $sinceId);
        }

        $messages = $messagesQuery->limit(100)->get();

        // Mark as read incoming messages to current user
        Message::whereIn('id', $messages->where('receiver_id', $currentUserId)->pluck('id'))
            ->update(['read_at' => now()]);

        return response()->json($messages);
    }

    public function send(Request $request, int $userId)
    {
        $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $currentUserId = Auth::id();

        $message = Message::create([
            'sender_id' => $currentUserId,
            'receiver_id' => $userId,
            'body' => $request->string('body'),
        ]);

        return response()->json($message, 201);
    }
}


