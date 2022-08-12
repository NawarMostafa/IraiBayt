<?php

namespace App\Http\Controllers\Site;

use App\Chat;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request, Post $id)
    {
        Chat::create([
            'send' => auth()->id(),
            'recive' => $id->user_id,
            'body' => $request->body,
            'post_id' => $id->id
        ]);
        return redirect()->back();
    }

    public function AllMsg()
    {
        $msgs = Chat::distinct()->where('recive', auth()->id())->get(['post_id', 'send']);
        return view('site.chat.msgs', compact('msgs'));
    }

    public function getMsgs($send, $post_id)
    {
        $msgs = Chat::where('post_id', $post_id)->where(function ($q) use ($send) {
            $q->where('send', $send);
            $q->orWhere('recive', $send);
        })->get();

        Chat::where('send', $send)->where('post_id', $post_id)->update([
            'seen' => 1
        ]);
        return view('site.chat.msg', compact('msgs'));
    }
    public function replay(Request $request, $send, $post)
    {
        Chat::create([
            'send' => auth()->id(),
            'recive' => $send,
            'body' => $request->body,
            'post_id' => $post
        ]);
        return redirect()->back();
    }
}
