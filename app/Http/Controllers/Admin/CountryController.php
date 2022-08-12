<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public  function getAll(Request $request)
    {
        $q = $request->q != 'null' && !empty($request->q) ? $request->q : null;
        $countries = Country::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
        })->latest()->paginate(100);
        return $countries;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:countries,name',
        ], [
            'name.required' => 'اسم الدولة مطلوب',
            'name.min' => 'يجب أن يكون اسم الدولة مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم الدولة مستخدم من قبل',
        ]);
        Country::create([
            'name' => $request->name,
        ]);
        $alert = 'تم اضافة الدولة بنجاح';
        return view('admin.country', compact('alert'));
    }

    public function show($id)
    {
        return view('admin.edit_country', compact('id'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:countries,name,' . $request->id,
        ], [
            'name.required' => 'اسم الدولة مطلوب',
            'name.min' => 'يجب أن يكون اسم الدولة مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم الدولة مستخدم من قبل',
        ]);
        Country::find($request->id)->update([
            'name' => $request->name,
        ]);
        $alert = 'تم تعديل الدولة بنجاح';
        return view('admin.country', compact('alert'));
    }

    public function all()
    {
        return Country::all();
    }
    public  function delete($id)
    {
        $country = Country::find($id);
        $country->cities()->delete();
        $country->regions()->delete();
        $country->delete();

        $alert = 'تم حذف الدولة بنجاح';
        return view('admin.country', compact('alert'));
    }
}
