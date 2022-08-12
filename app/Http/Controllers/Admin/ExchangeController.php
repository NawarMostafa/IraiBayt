<?php

namespace App\Http\Controllers\Admin;

use App\Exchange;
use App\Http\Controllers\Controller;
use App\Setting;
use DB;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function save(Request $request)
    {
        $this->validate($request, [
            'city_id' => 'required|min:1',
            'from' => 'required',
            'to' => 'required',
            'val_from' => 'required',
            'val_to' => 'required',
            'direction' => 'required',
        ], [
            'direction.required' => 'يرجى تحديد الجهة',
            'city_id.required' => 'يرجى تحديد المدينة',
            'city_id.min' => 'يرجى تحديد المدينة',
            'from.required' => 'يرجى تحديد العملة',
            'to.required' => 'يرجى تحديد العملة',
            'val_from.required' => 'يرجى تحديد القيمة',
            'val_to.required' => 'يرجى تحديد القيمة',
        ]);
        foreach ($request->city_id as $city) {
            Exchange::create([
                'from' => $request->from,
                'to' => $request->to,
                'val_from' => $request->val_from,
                'val_to' => $request->val_to,
                'day' => $request->day,
                'city_id' => $city,
                'direction' => $request->direction,
            ]);
        }
    }
    public function get()
    {
        return Exchange::latest()->with(['city', 'from', 'to'])->paginate(100);
    }
    public function delete(Exchange $id)
    {
        $id->delete();
    }
    public function edit($id)
    {
        return view('admin.exchangeedit', compact('id'));
    }
    public function getExchange($id)
    {
        return Exchange::where('id', $id)->with('city')->first();
    }

    public function update(Request $request, Exchange $id)
    {
        $this->validate($request, [
            'city_id' => 'required|min:1',
            'from' => 'required',
            'to' => 'required',
            'val_from' => 'required',
            'val_to' => 'required',
            'direction' => 'required',
        ], [
            'direction.required' => 'يرجى تحديد الجهة',
            'city_id.required' => 'يرجى تحديد المدينة',
            'city_id.min' => 'يرجى تحديد المدينة',
            'from.required' => 'يرجى تحديد العملة',
            'to.required' => 'يرجى تحديد العملة',
            'val_from.required' => 'يرجى تحديد القيمة',
            'val_to.required' => 'يرجى تحديد القيمة',
        ]);

        $id->update([
            'from' => $request->from,
            'to' => $request->to,
            'val_from' => $request->val_from,
            'val_to' => $request->val_to,
            'day' => $request->day,

            'direction' => $request->direction,
        ]);
    }
    public function showTitle()
    {
        return view('admin.showTitle');
    }

    public function editTablesTitle()
    {
        $t1 =  Setting::first()->table1_title;
        $t2 =  Setting::first()->table2_title;


        return view('admin.editTablesTitle', compact('t1', 't2'));
    }

    public function getTitle()
    {
        return Setting::select('header_ex')->first();
    }

    public function saveTitle(Request $request)
    {
        Setting::first()->update([
            'header_ex' => $request->header_ex
        ]);
    }

    public function get_default_value()
    {
        $publish_state_json = DB::select("ALTER TABLE `settings` ADD `table1_title` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `terms`, ADD `table2_title` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER `table1_title`");

        $publish_state_string = json_encode($publish_state_json);


        if (strpos($publish_state_string, "pending")) {

            return 'النشر المباشر غير مفعل';
        } else {
            return 'النشر المباشر مفعل';
        }
    }

    public function activeAll()
    {

        $publish_state_json = DB::select('Select default (active) from posts limit 1');
        $publish_state_string = json_encode($publish_state_json);

        if (strpos($publish_state_string, "pending")) {
            $query_result = DB::statement("ALTER TABLE posts ALTER COLUMN active SET DEFAULT 'active'");
            return redirect('dashboard/posts')->with('direct_publish', $publish_state_string);
        } else {
            $query_result = DB::statement("ALTER TABLE posts ALTER COLUMN active SET DEFAULT 'pending'");
            return redirect('dashboard/posts')->with('direct_publish', $publish_state_string);
        }
    }

    public function updateTablesTitle(Request $request)
    {
        Setting::first()->update([
            'table1_title' => $request->table1title,
            'table2_title' => $request->table2title
        ]);
        $t1 = $request->table1title;
        $t2 = $request->table2title;
        $alert = 'تم التعديل بنجاح.';

        return view('admin.editTablesTitle', compact('t1', 't2', 'alert'));
    }
}
