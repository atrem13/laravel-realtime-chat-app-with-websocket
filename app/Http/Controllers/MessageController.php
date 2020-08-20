<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Message;
use Exception;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exact;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ChatRoom()
    {
        return view('chat.index');
    }

    public function GetChat()
    {
        return Message::with('user')->get();
    }

    public function SendChat(Request $request)
    {
        try{
            $message = new Message();
            $message->text = $request->text;
            $message->user_id = auth()->user()->id;
            $message->save();
            // dd($message);
            broadcast(new MessageSent($message->load('user')))->toOthers();
            // broadcast(new MessageSent($message));

            return ['status' => 'success'];
        }catch(Exception $e){
            return $e;
        }
    }
}
