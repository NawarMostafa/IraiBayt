<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Setting;
use App\Http\Controllers\Controller;
use App\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public  function getAll(Request $request)
    {
        $q = $request->q != 'null' && !empty($request->q) ? $request->q : null;
        $countries = Info::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
        })->latest()->paginate(10);
        return $countries;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:infos,name',
        ], [
            'name.required' => 'الحقل مطلوب',
            'name.min' => 'يجب أن يكون الحقل مكون من 3 أحرف أو أكثر',
            'name.unique' => 'المعلومة مكررة من قبل',
        ]);
        Info::create([
            'name' => $request->name,
        ]);
        return "success";
    }

    public function show($id)
    {
        return Info::find($id);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:infos,name,' . $request->id,
        ], [
            'name.required' => 'الحقل مطلوب',
            'name.min' => 'يجب أن يكون الحقل مكون من 3 أحرف أو أكثر',
            'name.unique' => 'المعلومة مكررة من قبل',
        ]);
        Info::find($request->id)->update([
            'name' => $request->name,
        ]);
        return "success";
    }

    public function all()
    {
        return Info::all();
    }
    public  function delete(Info $id)
    {

        $id->delete();
        return "success";
    }

    public function info_timeupdate(Request $request)
    {
        $set = Setting::first()->update([
            'info_time' => $request->time,
        ]);

        $alert = 'تم التعديل بنجاح';
        return view('admin.info', compact('alert'));
    }
}
