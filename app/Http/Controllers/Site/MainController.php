<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class MainController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('site.index', compact('categories'))->with('auth_user',  auth()->user());
    }
    public function about()
    {
        return view('site.aboutUs');
    }
    public function sitemap()
    {
        return view('site.sitemap');
    }
    public function privacy()
    {
        return view('site.privacy');
    }
    public function terms()
    {
        return view('site.terms');
    }
}
