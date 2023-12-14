<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\adminChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class chatApiController extends Controller
{

    public function index()
    {
        try {
            $msgs = adminChat::latest()->paginate(3);
            return response()->json(['messages' => $msgs], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching messages'], 500);
        }
    }
    public function showAllChats()
    {
        try {
            $chats = adminChat::orderBy('created_at', 'desc')->get();
            return response()->json(['chats' => $chats], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching chat messages'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $input = $request->all();

            // return response()->json(['message' => $input], 200);

            $createdChat = adminChat::create([
                'content' => $input['msg_content'],
                'sender_id' => Auth::user()->id,
                'sender_name' => Auth::user()->name,
            ]);

            if ($createdChat) {
                return response()->json(['message' => 'Message sent!'], 200);
            }

            return response()->json(['error' => 'Failed to send message'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while sending the message : ' . $e->getMessage()], 500);
        }
    }

    // public function storeShowChat(Request $request)
    // {
    //     try {
    //         $input = $request->all();
    //         $createdChat = adminChat::create([
    //             'content' => $input['msg_content'],
    //             'sender_id' => $input['sender_id'],
    //             'sender_name' => $input['sender_name'],
    //         ]);

    //         if ($createdChat) {
    //             return response()->json(['message' => 'Message sent!'], 200);
    //         }

    //         return response()->json(['error' => 'Failed to send message'], 500);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => 'An error occurred while sending the message'], 500);
    //     }
    // }
}
