<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public  function getAll(Request $request)
    {
        $q = $request->q != 'null' && !empty($request->q) ? $request->q : null;
        $currancies = Material::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
            $query->orWhere('short_name', 'like', "%$q%");
            $query->orWhere('group', 'like', "%$q%");
        })->latest()->paginate(10);
        return $currancies;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:currancies,name',
            'short_name' => 'required|unique:currancies,short_name',
        ], [
            'name.required' => 'اسم المعدن مطلوب',
            'name.min' => 'يجب أن يكون اسم الوحدة مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم المعدن مستخدم من قبل',
            'short_name.required' => 'رمز المعدن مطلوب',
            'short_name.unique' => 'رمز المعدن مستخدم من قبل',
        ]);

        Material::create([
            'name' => $request->name,
            'short_name' => $request->short_name,
            'group' => $request->group,
        ]);
        return "success";
    }

    public function show($id)
    {
        return Material::find($id);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:currancies,name,' . $request->id,
            'short_name' => 'required|unique:currancies,short_name,' . $request->id,
        ], [
            'name.required' => 'اسم المعدن مطلوب',
            'name.min' => 'يجب أن يكون اسم المعدن مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم المعدن مستخدم من قبل',
            'short_name.required' => 'رمز المعدن مطلوب',
            'short_name.unique' => 'رمز المعدن مستخدم من قبل',
        ]);
        $unit =  Material::find($request->id);
        $unit->update([
            'name' => $request->name,
            'short_name' => $request->short_name,
            'group' => $request->group

        ]);
        return "success";
    }

    public function all()
    {
        return Material::all();
    }
    public  function delete($id)
    {
        $unit = Material::find($id);

        $unit->delete();
        return "success";
    }
}
