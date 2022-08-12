<?php

namespace App\Http\Controllers\Admin;

use App\Currancy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CurrancyController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public  function getAll(Request $request)
    {
        $q = $request->q != 'null' && !empty($request->q) ? $request->q : null;
        $currancies = Currancy::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
            $query->orWhere('short_name', 'like', "%$q%");
        })->latest()->paginate(100);
        return $currancies;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:currancies,name',
            'short_name' => 'required|unique:currancies,short_name',
        ], [
            'name.required' => 'اسم الوحدة مطلوب',
            'name.min' => 'يجب أن يكون اسم الوحدة مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم الوحدة مستخدم من قبل',
            'short_name.required' => 'رمز الوحدة مطلوب',
            'short_name.unique' => 'رمز الوحدة مستخدم من قبل',
        ]);

        Currancy::create([
            'name' => $request->name,
            'short_name' => $request->short_name,
            'active' => $request->active
        ]);
        return "success";
    }

    public function show($id)
    {
        return Currancy::find($id);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:currancies,name,' . $request->id,
            'short_name' => 'required|unique:currancies,short_name,' . $request->id,
        ], [
            'name.required' => 'اسم الوحدة مطلوب',
            'name.min' => 'يجب أن يكون اسم الوحدة مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم الوحدة مستخدم من قبل',
            'short_name.required' => 'رمز الوحدة مطلوب',
            'short_name.unique' => 'رمز الوحدة مستخدم من قبل',
        ]);
        $unit =  Currancy::find($request->id);
        $unit->update([
            'name' => $request->name,
            'short_name' => $request->short_name,
            'active' => $request->active

        ]);
        return "success";
    }

    public function all()
    {
        return Currancy::all();
    }
    public function get_active()
    {
        return Currancy::where('active', '=', '1')->get();
    }
    public  function delete($id)
    {
        $unit = Currancy::find($id);

        $unit->delete();
        return "success";
    }
}
