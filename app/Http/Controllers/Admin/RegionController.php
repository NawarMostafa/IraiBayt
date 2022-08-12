<?php

namespace App\Http\Controllers\Admin;

use App\City;
use App\Http\Controllers\Controller;
use App\Region;
use App\Post;
use Illuminate\Http\Request;
use DB;

class RegionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public  function getAll(Request $request)
    {
        $q = $request->q != 'null' && !empty($request->q) ? $request->q : null;

        $countries = Region::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
            $query->orWhereHas('city', function ($query1) use ($q) {
                $query1->where('name', 'like', "%$q%");
            });
            $query->orWhereHas('country', function ($query1) use ($q) {
                $query1->where('name', 'like', "%$q%");
            });
        })

            ->with(['city', 'country'])->latest()->paginate(100);
        return $countries;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:regions,name',
            'city_id' => 'required|integer',
        ], [
            'name.required' => 'اسم المنطقة مطلوب',
            'name.min' => 'يجب أن يكون اسم المنطقة مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم المنطقة مستخدم من قبل',
            'city_id.required' => 'حقل المحافظة مطلوب',
            'city_id.integer' => 'الرجاء إختيار المحافظة',
        ]);

        $id = $request->city_id;
        $city = City::find($request->city_id);
        $country_id = $city->country_id;

        Region::create([
            'name' => $request->name,
            'city_id' => $request->city_id,
            'country_id' => $country_id
        ]);

        $alert = 'تم اضافة المنطقة بنجاح';
        return view('admin.region', compact('id', 'alert'));
    }

    public function show($id)
    {
        return Region::find($id);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:regions,name,' . $request->id,
        ], [
            'name.required' => 'اسم المنطقة مطلوب',
            'name.min' => 'يجب أن يكون اسم المنطقة مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم المنطقة مستخدم من قبل',
        ]);
        Region::find($request->id)->update([
            'name' => $request->name,
        ]);


        $region = Region::find($request->id);
        $city_id = $region->city_id;
        $id = $city_id;
        $alert = 'تم تعديل المنطقة بنجاح';
        return view('admin.region', compact('id', 'alert'));
    }

    public function all()
    {
        return City::all();
    }

    public function delete($id)
    {

        Region::find($id)->delete();
    }

    public function getRegionByCity_list($id)
    {
        return  Region::where('city_id', $id)->get();
    }

    public function getRegionByCity($id)
    {
        return view('admin.region', compact('id'));
    }

    public function edit($id)
    {
        $region = Region::find($id);
        $name = $region->name;
        return view('admin.edit_region', compact('id', 'name'));
    }
}
