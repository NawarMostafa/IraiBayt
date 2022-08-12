<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendMsg(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'type' => 'required',
            'msg' => 'required'
        ], [
            'type.required' => 'يرجى تحديد نوع الرسالة',
            'email.required' => 'يرجى إدخال البريد الإلكتروني',
            'msg.required' => 'يرجى كتابة الرسالة',
            'email.email' => 'تنسيق البريد غير صالح',
        ]);
        Message::create([
            'type' => $request->type,
            'email' => $request->email,
            'msg' => $request->msg,
            'user_id' => '0',
        ]);
    }

    public function sendMsg_api(Request $request)
    {

        Message::create([
            'type' => $request->type,
            'email' => $request->email,
            'msg' => $request->msg,
            'user_id' => '0',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'second case'
        ]);
    }
}
