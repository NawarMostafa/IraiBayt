<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public  function getAll(Request $request)
    {
        $q = $request->q != 'null' && !empty($request->q) ? $request->q : null;
        $units = Unit::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
        })->latest()->paginate(10);
        return $units;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:units,name',
        ], [
            'name.required' => 'اسم الوحدة مطلوب',
            'name.min' => 'يجب أن يكون اسم الوحدة مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم الوحدة مستخدم من قبل',
        ]);

        Unit::create([
            'name' => $request->name,
        ]);
        return "success";
    }

    public function show($id)
    {
        return Unit::find($id);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:units,name,' . $request->id,
        ], [
            'name.required' => 'اسم الوحدة مطلوب',
            'name.min' => 'يجب أن يكون اسم الوحدة مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم الوحدة مستخدم من قبل',
        ]);
        $unit =  Unit::find($request->id);
        $unit->update([
            'name' => $request->name,

        ]);
        return "success";
    }

    public function all()
    {
        return Unit::all();
    }
    public  function delete($id)
    {
        $unit = Unit::find($id);

        $unit->delete();
        return "success";
    }
}
