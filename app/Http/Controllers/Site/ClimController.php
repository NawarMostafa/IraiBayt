<?php

namespace App\Http\Controllers\Site;

use App\Clim;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClimController extends Controller
{
    public function store(Request $request)
    {
        Clim::create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
            'type' => $request->type,
        ]);
        return redirect()->back()->with('success', 'تم الإبلاغ بنجاح');
    }
}
