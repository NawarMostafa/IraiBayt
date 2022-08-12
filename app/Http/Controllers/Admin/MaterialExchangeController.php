<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Materialexchange;
use Illuminate\Http\Request;

class MaterialExchangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function MatEx($id)
    {
        return  Materialexchange::where('id', $id)->with('city')->first();
    }
    public function edit($id)
    {
        return  view('admin.editEx', compact('id'));
    }
    public function update(Request $request, Materialexchange $id)
    {
        $id->update([
            'material_id' => $request->material_id,
            'price' => $request->price,
            'day' => $request->day,
            'currancy_id' => $request->currancy_id
        ]);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'city_id' => 'required|min:1',
            'material_id' => 'required',
            'price' => 'required',
            'currancy_id' => 'required',
            'day' => 'required',
        ], [
            'city_id.required' => 'يرجى تحديد المدينة',
            'city_id.min' => 'يرجى تحديد المدينة',
            'currancy_id.required' => 'يرجى تحديد العملة',
            'price.required' => 'يرجى تحديد السعر',
            'material_id.required' => 'يرجى تحديد المعدن',
            'day.required' => 'يرجى تحديد التاريخ',
        ]);
        foreach ($request->city_id as $city) {
            Materialexchange::create([
                'price' => $request->price,
                'material_id' => $request->material_id,
                'currancy_id' => $request->currancy_id,
                'day' => $request->day,
                'city_id' => $city
            ]);
        }
    }
    public function get()
    {
        return Materialexchange::orderBy('day', 'desc')->orderBy('city_id', 'desc')->with(['currancy', 'city', 'material'])->orderBy('city_id')->paginate(10);
    }
    public function delete(Materialexchange $id)
    {
        $id->delete();
    }
}
