<?php

namespace App\Http\Controllers\Site;

use App\Currancy;
use App\Exchange;
use App\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExchangeController extends Controller
{
    public function getExchange()
    {
        return Exchange::latest()->where(function ($query) {
            $query->whereHas('city', function ($query) {
                $query->where('name', 'بغداد');
            });
        })->with(['from', 'to', 'city'])->first();
    }

    public function index()
    {
        $exs = Exchange::where('day', date('Y-m-d'))->get();
        $appId = '96c284fa75e8442cba7d968897ea1425';
        $result = Http::get("https://openexchangerates.org/api/latest.json?app_id=$appId&base=USD")->json()['rates'];
        $curs = Currancy::all();
        $t1 =  Setting::first()->table1_title;
        $t2 =  Setting::first()->table2_title;
        return view('site.exchange', compact('exs', 'result', 'curs', 't1', 't2'));
    }

    public function apiIndex()
    {
        $exs = Exchange::where('day', date('Y-m-d'))->get();
        $appId = '96c284fa75e8442cba7d968897ea1425';
        $result = Http::get("https://openexchangerates.org/api/latest.json?app_id=$appId&base=USD")->json()['rates'];
        $curs = Currancy::all();
        $sHeader = Setting::first()->header_ex;
        $t1 =  Setting::first()->table1_title;
        $t2 =  Setting::first()->table2_title;
        return compact('exs', 'result', 'curs', 'sHeader', 't1', 't2');
    }

    public function apiExc()
    {
        return Exchange::where('day', date('Y-m-d'))->with(['from', 'to', 'city'])->get();
    }

    public function apiOpenExc()
    {
        $t2 =  Setting::first()->table2_title;
        $appId = '96c284fa75e8442cba7d968897ea1425';
        $result = Http::get("https://openexchangerates.org/api/latest.json?app_id=$appId&base=USD")->json()['rates'];
        $curs = Currancy::all();
        return compact('t2', 'result', 'curs');
    }

    public function apiExcHeader()
    {
        $sHeader = Setting::first()->header_ex;
        return response()->json($sHeader);
    }
}
