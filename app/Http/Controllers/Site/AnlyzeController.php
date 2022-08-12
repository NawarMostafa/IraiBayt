<?php

namespace App\Http\Controllers\Site;

use App\Anylizise;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnlyzeController extends Controller
{
    public function index()
    {
        $ans = Anylizise::all();
        return view('site.priceother', compact('ans'));
    }

    public function index_api()
    {
        return Anylizise::all();
    }
}
