<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index($type = null)
    {
        return view('site.system', compact('type'));
    }
    public function tips()
    {
        return view('site.tip');
    }

    public function getTip()
    {
        return System::where('type', '!=', 'system')->get();
    }

    public function getAbouts()
    {
        return System::where('type', 'system')->get();
    }

    public function show_tips($id)
    {
        return view('site.show_tips', compact('id'));
    }

    //API
    public function tips_api()
    {
        $tips = System::WHERE('type', '=', 'other')->latest()->get();
        return $tips;
    }

    public function showTip_api($id)
    {
        $tip = System::find($id);
        return $tip;
    }

    public function systems_api()
    {
        $systems = System::WHERE('type', '=', 'system')->latest()->get();
        return $systems;
    }
}
