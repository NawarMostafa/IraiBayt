<?php

namespace App\Http\Controllers\Site;

use App\Currancy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrancyController extends Controller
{
    public function getCurrancies()
    {
        return Currancy::where('active', 1)->get();
    }
    public function getAllCurrancies()
    {
        return Currancy::all();
    }
}
