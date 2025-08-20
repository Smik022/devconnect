<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Admin;
use App\Models\User;

class TextController extends Controller
{
    private function currentUser()
    {
        if (auth()->guard('admin')->check()) {
            return [auth()->guard('admin')->user(), Admin::class];
        } elseif (auth()->check()) {
            return [auth()->user(), User::class];
        }

        abort(403, 'Unauthorized');
    }

    private function resolveReceiverType(string $type)
    {
        return match ($type) {
            'Admin' => Admin::class,
            'User' => User::class,
            default => abort(422, 'Invalid receiver type'),
        };
    }

    public function index(Request $request)
    {
        [$user, $userType] = $this->currentUser();

        $receiverId = $request->query('receiver_id');
        $receiverTypeStr = $request->query('receiver_type');

        $chatWith = null;
        $messages = collect();

        if ($receiverId && $receiverTypeStr) {
            $receiverClass = $this->resolveReceiverType($receiverTypeStr);
            $chatWith = $receiverClass::find($receiverId);

            if ($chatWith) {
                $messages = Message::where(function ($q) use ($user, $userType, $receiverId, $receiverClass) {
                        $q->where('sender_id', $user->id)
                          ->where('sender_type', $userType)
                          ->where('receiver_id', $receiverId)
                          ->where('receiver_type', $receiverClass);
                    })
                    ->orWhere(function ($q) use ($user, $userType, $receiverId, $receiverClass) {
                        $q->where('sender_id', $receiverId)
                          ->where('sender_type', $receiverClass)
                          ->where('receiver_id', $user->id)
                          ->where('receiver_type', $userType);
                    })
                    ->with(['sender', 'receiver'])
                    ->orderBy('created_at')
                    ->get();
            }
        }

        $admins = Admin::all(['id', 'name']);
        $developers = User::where('role', 'Developer')->get(['id', 'name']);
        $employers = User::where('role', 'Employer')->get(['id', 'name']);

        return view('/dashboard/messages', compact('messages', 'admins', 'developers', 'employers', 'chatWith'));
    }

    public function store(Request $request)
    {
        [$user, $userType] = $this->currentUser();

        $request->validate([
            'receiver_type' => 'required|string',
            'receiver_id'   => 'required|integer',
            'body'          => 'required|string|max:2000',
        ]);

        $receiverTypeStr = str_replace('\\\\', '\\', $request->input('receiver_type'));
        $receiverId = $request->input('receiver_id');
        $body = $request->input('body');

        \Log::info('storeMessage called', [
            'sender_id' => $user->id,
            'sender_type' => $userType,
            'receiver_id' => $receiverId,
            'receiver_type' => $receiverTypeStr,
            'body' => $body,
        ]);

        if (!class_exists($receiverTypeStr)) {
            \Log::warning("Invalid receiver type: {$receiverTypeStr}");
            return response()->json(['error' => 'Invalid receiver type.'], 422);
        }

        try {
            $message = Message::create([
                'sender_id'     => $user->id,
                'sender_type'   => $userType,
                'receiver_id'   => $receiverId,
                'receiver_type' => $receiverTypeStr,
                'body'          => $body,
            ]);

            return response()->json([
                'id'        => $message->id,
                'body'      => $message->body,
                'timestamp' => $message->created_at->format('Y-m-d H:i'),
            ]);
        } catch (\Exception $e) {

            \Log::error('Message creation failed: '.$e->getMessage(), [
                'exception' => $e,
                'input' => [
                    'sender_id' => $user->id,
                    'sender_type' => $userType,
                    'receiver_id' => $receiverId,
                    'receiver_type' => $receiverTypeStr,
                    'body' => $body,
                ]
            ]);

            return response()->json([
                'error' => 'Failed to store message. Check logs for details.'
            ], 500);
        }
    }



    public function fetchMessages(Request $request)
    {
        [$user, $userType] = $this->currentUser();
        $receiverTypeStr = $request->query('receiver_type');
        $receiverId = $request->query('receiver_id');
        if (!$receiverTypeStr || !$receiverId) {
            return response()->json(['messages' => []]);
        }
        $receiverTypeStr = str_replace('\\\\', '\\', $receiverTypeStr);
        if (!class_exists($receiverTypeStr)) {
            return response()->json(['messages' => []]);
        }
        $messages = Message::where(function ($q) use ($user, $userType, $receiverId, $receiverTypeStr) {
                $q->where('sender_id', $user->id)
                  ->where('sender_type', $userType)
                  ->where('receiver_id', $receiverId)
                  ->where('receiver_type', $receiverTypeStr);
            })
            ->orWhere(function ($q) use ($user, $userType, $receiverId, $receiverTypeStr) {
                $q->where('sender_id', $receiverId)
                  ->where('sender_type', $receiverTypeStr)
                  ->where('receiver_id', $user->id)
                  ->where('receiver_type', $userType);
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at')
            ->get();
        $messagesFormatted = $messages->map(function ($msg) use ($user, $userType) {
            return [
                'id' => $msg->id,
                'sender_name' => $msg->sender->name ?? 'Unknown',
                'body' => $msg->body,
                'timestamp' => $msg->created_at->format('Y-m-d H:i'),
                'is_sender' => $msg->sender_id === $user->id && $msg->sender_type === $userType,
            ];
        });

        return response()->json(['messages' => $messagesFormatted]);
    }

}
