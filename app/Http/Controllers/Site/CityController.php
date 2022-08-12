<?php

namespace App\Http\Controllers\Site;

use App\City;
use App\Region;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public  function getCities()
    {
        return City::with('regions')->get();
    }

    public function getRegionByCity_list($id)
    {
        return  Region::where('city_id', $id)->get();
    }

    public function getBaghdadId()
    {
        $city = City::where('name', 'بغداد')->get();
        return $city;
    }
}
