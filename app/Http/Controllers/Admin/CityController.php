<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public  function getAll(Request $request)
    {
        $q = $request->q != 'null' && !empty($request->q) ? $request->q : null;

        $countries = City::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
            $query->orWhereHas('country', function ($query1) use ($q) {
                $query1->where('name', 'like', "%$q%");
            });
        })->with(['country'])->latest()->paginate(100);
        return $countries;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:cities,name',
            'country_id' => 'required|integer',
        ], [
            'name.required' => 'اسم المحافظة مطلوب',
            'name.min' => 'يجب أن يكون اسم المحافظة مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم المحافظة مستخدم من قبل',
            'country_id.required' => 'حقل الدولة مطلوب',
            'country_id.integer' => 'الرجاء إختيار دولة'
        ]);
        City::create([
            'name' => $request->name,
            'sort' => $request->sort,
            'country_id' => $request->country_id
        ]);
        return "success";
    }

    public function show($id)
    {
        return City::find($id);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:cities,name,',
            'country_id' => 'required|integer',
        ], [
            'name.required' => 'اسم المحافظة مطلوب',
            'name.min' => 'يجب أن يكون اسم المحافظة مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم المحافظة مستخدم من قبل',
            'country_id.required' => 'حقل الدولة مطلوب',
            'country_id.integer' => 'الرجاء إختيار دولة'
        ]);
        City::find($request->id)->update([
            'name' => $request->name,
            'sort' => $request->sort,
            'country_id' => $request->country_id
        ]);
        return "success";
    }

    public function all()
    {
        return City::all();
    }

    public  function delete($id)
    {
        $city = City::find($id);
        $city->regions()->delete();
        $city->delete();
        return \Redirect('dashboard/country');
    }

    public function edit($id)
    {
        $city = City::find($id);
        $name = $city->name;
        $sort = $city->sort;
        $country_id = $city->country_id;
        return view('admin.cityedit', compact('id', 'name', 'sort', 'country_id'));
    }

    public function getCityByCountry($id)
    {

        return City::where('country_id', 1)->with('regions')->get();
    }

    public function addcity()
    {
        return view('admin.addcity');
    }

    public function addcity_form(Request $request)
    {


        $this->validate($request, [
            'name' => 'required|min:3|unique:cities,name',
            'country_id' => 'required|integer',
        ], [
            'name.required' => 'اسم المحافظة مطلوب',
            'name.min' => 'يجب أن يكون اسم المحافظة مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم المحافظة مستخدم من قبل',
            'country_id.required' => 'حقل الدولة مطلوب',
            'country_id.integer' => 'الرجاء إختيار دولة'
        ]);
        City::create([
            'name' => $request->name,
            'sort' => $request->sort,
            'country_id' => $request->country_id
        ]);
        return \Redirect('dashboard/country');
    }

    public function editcity_form(Request $request)
    {


        $this->validate($request, [
            'name' => 'required|min:3|unique:cities,name,',
            'country_id' => 'required|integer',
        ], [
            'name.required' => 'اسم المحافظة مطلوب',
            'name.min' => 'يجب أن يكون اسم المحافظة مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم المحافظة مستخدم من قبل',
            'country_id.required' => 'حقل الدولة مطلوب',
            'country_id.integer' => 'الرجاء إختيار دولة'
        ]);

        City::find($request->id)->update([
            'name' => $request->name,
            'sort' => $request->sort,
            'country_id' => $request->country_id
        ]);
        return view('admin.country');
    }
}
