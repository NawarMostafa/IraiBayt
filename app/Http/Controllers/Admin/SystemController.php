<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SystemController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function save(Request $request)
    {
        $validat = Validator::make($request->all(), [
            'name' => 'required',
            'url' => 'nullable|mimes:pdf'
        ], [
            'name.required' => 'اسم القانون مطلوب',
            'url.mimes' => 'الملف غير صالح الملفات المسموح بها من نوع pdf'
        ]);
        if ($validat->fails()) {
            return  $validat->errors();
        }
        if ($request->hasFile('url')) {
            $file = $request->file('url')->store('public/pdf');
        } else {
            $file = '';
        }

        System::create([
            'name' => $request->name,
            'url' => $file,
            'description' => $request->description,
            'type' => $request->type,
        ]);
        return "success";
    }
    public function all()
    {
        return System::WHERE('type', '=', 'system')->latest()->paginate(10);
    }

    public function all_tips()
    {
        return System::WHERE('type', '=', 'other')->latest()->paginate(10);
    }

    public function edit($id)
    {
        return view('admin.systemEdit', compact('id'));
    }

    public function getOne(System $id)
    {
        return $id;
    }

    public function update(Request $request, System $id)
    {
        $validat = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'اسم القانون مطلوب',
            'url.mimes' => 'الملف غير صالح الملفات المسموح بها من نوع pdf'
        ]);
        if ($validat->fails()) {
            return  $validat->errors();
        }
        if ($request->hasFile('url') && $request->url != $id->url) {
            if (is_file(storage_path('app/' . $id->url))) {
                unlink(storage_path('app/' . $id->url));
            }
            $file = $request->file('url')->store('public/pdf');
        } else {
            $file = $id->url;
        }
        $id->update([
            'name' => $request->name,
            'url' => $file,
            'description' => $request->description
        ]);
        return "success";
    }
    public function delete(System $id)
    {
        if (is_file(storage_path('app/' . $id->url))) {
            unlink(storage_path('app/' . $id->url));
        }
        $id->delete();
    }
}
