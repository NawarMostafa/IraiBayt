<?php

namespace App\Http\Controllers\Admin;

use App\Clim;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClimController extends Controller
{
    public function index()
    {
        $clims = Clim::orderBy('active')->latest()->paginate(10);
        return view('admin.clims.index', compact('clims'));
    }

    public function delete(Clim $id)
    {
        $id->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }

    public function read(Clim $id)
    {
        $id->active = 1;
        $id->save();
        return redirect()->back()->with('success', 'تم تعديل الحالة بنجاح');
    }

    public function delet_all()
    {
        Clim::truncate();
        return 'ok';
    }
}
