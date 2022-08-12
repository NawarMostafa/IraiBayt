<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function getAll(Request $request)
    {
        return Message::with('user')->orderBy('isread', 'asc')->latest()->paginate(10);
    }

    public function replay(Request $request)
    {
        Message::find($request->id)->update(['isread' => $request->isread]);
        Mail::to($request->email)->send(new ContactMail($request->msg));
    }
    public function read(Message $id)
    {
        $id->update([
            'isread' => true
        ]);
    }

    public function delete(Message $id)
    {
        $id->delete();
    }

    public function getMessagesByUserId($mid)
    {
        return Message::where('user_id', $mid)->orderBy('isread', 'asc')->latest()->paginate(100);
    }
}
