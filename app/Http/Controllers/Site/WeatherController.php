<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function getWeather($city = null)
    {
        return  Weather::where(function ($q) use ($city) {
            if ($city != null) {
                $q->where('city_id', $city);
            }
        })->where('day', date('Y-m-d'))->latest()->with('city')->get()->unique('city_id')->toArray();
    }
}
