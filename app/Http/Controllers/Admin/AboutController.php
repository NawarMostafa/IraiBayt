<?php

namespace App\Http\Controllers\Admin;

use App\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function getAll(Request $request)
    {
        $q = $request->q;
        return About::where(function ($query) use ($q) {
            $query->where('title', 'like', "%$q%");
            $query->orWhere('body', 'like', "%$q%");
        })->latest()->paginate(10);
    }
    public function create()
    {
        return view('admin.about.add');
    }
    public  function store(Request $request)
    {
        About::create([
            'title' => $request->title,
            'body' => $request->body
        ]);
    }
    public function show(About $post)
    {
        return $post;
    }
    public function edit($post)
    {
        return view('admin.about.edit', compact('post'));
    }
    public function update(Request $request, About $id)
    {
        $id->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);
    }

    public function delete($id)
    {
        $post = About::find($id);
        $post->delete();
    }
}
