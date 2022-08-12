<?php

namespace App\Http\Controllers\Site;

use App\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;

class AboutIraqController extends Controller
{
    public  function index()
    {
        return view('site.aboutIraq');
    }
    public  function getAbouts()
    {
        return   About::orderBy('id', 'asc')->get();
    }
    public  function getAbouts_api()
    {
        $about =   Setting::orderBy('id', 'asc')->get();

        return response()->json($about, 200);
    }
}
