<?php

namespace App\Http\Controllers\Site;

use App\Depart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartController extends Controller
{
    public function getAll()
    {
        return Depart::all();
    }

    public function getdep(Depart $id)
    {
        $name = $id->name;
        $url = $id->url;
        return view('site.depart', compact('name'), compact('url'));
    }
}
