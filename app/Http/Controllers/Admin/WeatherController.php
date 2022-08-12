<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function getAll(Request $request)
    {
        $q = $request->q;
        return Weather::where(function ($query) use ($q) {
            $query->whereHas('city', function ($query) use ($q) {
                $query->where('name', 'like', "%$q%");
            });
        })->orderBy('day', 'desc')->latest()->with('city')->paginate(100);
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'city_id' => 'required',
            'day' => 'required',
            'temp' => 'required',

            'img' => 'required',

        ], [
            'city_id.required' => 'يرجى تحديد مدينة على الأقل',
            'day.required' => 'يرجى تحديد تاريخ',
            'temp.required' => 'يرجى إدخال درجة الحرارة',
            'max_temp.required' => 'يرجى إدخال درجة الحرارة العليا',
            'min_temp.required' => 'يرجى إدخال درجة الحرارة العظمى',
            'wind_speed.required' => 'يرجى تحديد سرعة الرياح',
            'wind_dir.required' => 'يرجى تحديد إتجاه الرياح',
            'img.required' => 'يرجى إختيار صورة',
            'hum.required' => 'يرجى تحديد نسبة الرطوبة',
            'direction.required' => 'يرجى تحديد مركز الأرصاد',
        ]);
        foreach ($request->city_id as $v) {
            Weather::create([
                'city_id' => $v,
                'day' => $request->day,
                'temp' => $request->temp,
                'max_temp' => $request->max_temp,
                'min_temp' => $request->min_temp,
                'wind_speed' => $request->wind_speed,
                'wind_dir' => $request->wind_dir,
                'icon' => $request->img,
                'hum' => $request->hum,
                'direction' => $request->direction,
            ]);
        }
    }
    public function delete(Weather $id)
    {
        $id->delete();
    }

    public function edit($id)
    {
        return view('admin.weatheredit', compact('id'));
    }
    public function getWeather($id)
    {
        return Weather::where('id', $id)->with('city')->first();
    }
    public function update(Request $request, Weather $id)
    {
        $this->validate($request, [
            'city_id' => 'required',
            'day' => 'required',
            'temp' => 'required',

            'icon' => 'required',

        ], [
            'city_id.required' => 'يرجى تحديد مدينة على الأقل',
            'day.required' => 'يرجى تحديد تاريخ',
            'temp.required' => 'يرجى إدخال درجة الحرارة',
            'max_temp.required' => 'يرجى إدخال درجة الحرارة العليا',
            'min_temp.required' => 'يرجى إدخال درجة الحرارة العظمى',
            'wind_speed.required' => 'يرجى تحديد سرعة الرياح',
            'wind_dir.required' => 'يرجى تحديد إتجاه الرياح',
            'icon.required' => 'يرجى إختيار صورة',
            'hum.required' => 'يرجى تحديد نسبة الرطوبة',
            'direction.required' => 'يرجى تحديد مركز الأرصاد',
        ]);
        $id->update([
            'day' => $request->day,
            'temp' => $request->temp,
            'max_temp' => $request->max_temp ?? ' ',
            'min_temp' => $request->min_temp ?? ' ',
            'wind_speed' => $request->wind_speed ?? ' ',
            'wind_dir' => $request->wind_dir ?? ' ',
            'icon' => $request->icon,
            'hum' => $request->hum ?? ' ',
            'direction' => $request->direction,
        ]);
    }
}
