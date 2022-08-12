<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Material;
use App\Materialexchange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    public function priceLess()
    {
        return view('site.priceless');
    }
    public function priceLessGet($id)
    {
        $res =   Materialexchange::where(function ($query) use ($id) {
            $query->where('city_id', $id);
            $query->whereHas('material', function ($q) {
                $q->where('group', 'معادن ثمينة');
            });
        })->with(['material', 'currancy'])->latest()->get();
        return collect($res)->unique('material_id');
    }

    public function priceOther()
    {
        return view('site.priceother');
    }
    public function priceOtherGet($id)
    {
        $res =   Materialexchange::where(function ($query) use ($id) {
            $query->where('city_id', $id);
            $query->whereHas('material', function ($q) {
                $q->where('group', '!=', 'معادن ثمينة');
            });
        })->with(['material', 'currancy'])->latest()->get();
        return collect($res)->unique('material_id');
    }
}
