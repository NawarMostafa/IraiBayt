<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function getInfo()
    {
        return Info::latest()->get();
    }
    public function all()
    {
        $notes = Info::latest()->paginate(10);
        return view('site.notes', compact('notes'));
    }
}
