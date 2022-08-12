<?php

namespace App\Http\Controllers\Admin;

use App\Anylizise;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalizeController extends Controller
{
    public function all()
    {
        return Anylizise::all();
    }

    public function create()
    {
        return view('admin.analize.add');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        Anylizise::create([
            'title' => $request->title,
            'body' => $request->body
        ]);
    }

    public function edit($id)
    {
        return view('admin.analize.edit', compact('id'));
    }
    public function getOne(Anylizise $id)
    {
        return $id;
    }
    public function update(Request $request, Anylizise $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $id->update([
            'title' => $request->title,
            'body' => $request->body
        ]);
    }
    public function delete(Anylizise $id)
    {
        $id->delete();
    }
}
