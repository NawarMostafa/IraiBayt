<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function getUnits()
    {
        return Unit::all();
    }
}
