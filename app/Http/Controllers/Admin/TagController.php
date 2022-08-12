<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public  function getAll(Request $request)
    {
        $q = $request->q != 'null' && !empty($request->q) ? $request->q : null;
        $countries = Tag::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
        })->latest()->paginate(10);
        return $countries;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:tags,name',
        ], [
            'name.required' => 'اسم التصنيف مطلوب',
            'name.min' => 'يجب أن يكون اسم التصنيف مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم التصنيف مستخدم من قبل',
        ]);
        Tag::create([
            'name' => $request->name,
        ]);
        return "success";
    }

    public function show($id)
    {
        return Tag::find($id);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:tags,name,' . $request->id,
        ], [
            'name.required' => 'اسم التصنيف مطلوب',
            'name.min' => 'يجب أن يكون اسم التصنيف مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم التصنيف مستخدم من قبل',
        ]);
        Tag::find($request->id)->update([
            'name' => $request->name,
        ]);
        return "success";
    }

    public function all()
    {
        return Tag::all();
    }
    public  function delete($id)
    {
        $country = Tag::find($id);

        $country->delete();
        return "success";
    }
}
