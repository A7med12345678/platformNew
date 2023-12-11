<?php
namespace App\Http\Controllers;

use App\Models\adminChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminChatController extends Controller
{
   
    public function index()
    {
        try {
            $msgs = adminChat::latest()->paginate(3);
            return $msgs;
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching messages'], 500);
        }
    }

    public function showAllChats()
    {
        try {
            $chat = adminChat::orderBy('created_at', 'desc')->get();
            return view('admin.showAllChats', compact('chat'));
        } catch (\Exception $e) {
            return back()->with('error_msg', 'An error occurred while fetching chat messages');
        }
    }
    
    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $createdChat = adminChat::create([
                'content' => $input['msg_content'],
                'sender_id' => Auth::user()->id,
                'sender_name' =>Auth::user()->name,
            ]);

            if ($createdChat) {
                return redirect()->route('Admin/showAllChats')->with('flash_msg', 'Message sent!');
            }

            return back()->with('flash_msg', 'Failed to send message');
        } catch (\Exception $e) {
            return back()->with('flash_msg', 'An error occurred while sending the message');
        }
    }
    
    public function storeShowChat(Request $request)
    {
        try {
            $input = $request->all();
            $createdChat = adminChat::create([
                'content' => $input['msg_content'],
                'sender_id' => $input['sender_id'],
                'sender_name' => $input['sender_name'],
            ]);

            if ($createdChat) {
                return redirect()->route('Admin/showAllChats')->with('flash_msg', 'Message sent!');
            }

            return back()->with('flash_msg', 'Failed to send message');
        } catch (\Exception $e) {
            return back()->with('flash_msg', 'An error occurred while sending the message');
        }
    }


}
