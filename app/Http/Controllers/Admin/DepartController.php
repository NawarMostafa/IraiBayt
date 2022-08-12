<?php

namespace App\Http\Controllers\Admin;

use App\Depart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class DepartController extends Controller
{
    public function get(Depart $id)
    {
        return $id;
    }
    public function edit($id)
    {
        return view('admin.departs.edit', compact('id'));
    }
    public function getAll()
    {
        return Depart::all();
    }

    public function get_second()
    {
        return Depart::where('id', '>', '8')->latest()->paginate(100);
    }

    public function update(Request $request, Depart $id)
    {
        $data = $request->obj;
        if ($data['img'] != $id->data['img'] && $data['img'] != '') {
            $name = uniqid() . '.' . explode('/', explode(':', substr($data['img'], 0, strpos($data['img'], ';')))[1])[1];
            Image::make($data['img'])->save(storage_path('app/public/images/' . $name));
            $data['img'] = $name;
        }
        $id->data = $data;
        $id->save();
    }

    public function store_depart_second(Request $request)
    {

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $validated = $request->validate([
                    'name' => 'string|max:40',
                    'image' => 'mimes:jpeg,png|max:1014',
                    'url' => 'string|max:400',
                ]);
                $file_name = $request->image->getClientOriginalName();

                $img_name = time() . '.' . $file_name;
                Image::make($request->file('image'))
                    ->resize(374, 374)->save(storage_path('app/public/images/' . $img_name));

                $Depart = Depart::create([
                    'data' => 'second depart',
                    'name' => $validated['name'],
                    'img' => $img_name,
                    'url' => $validated['url'],
                ]);
                Session::flash('success', "Success!");
                return \Redirect('dashboard/departs_second');
            }
        }
        abort(500, 'لم نتمكن من رفع الصورة :(');
    }

    public function delete(Depart $id)
    {
        $id->delete();
        return \Redirect('dashboard/departs_second');
    }

    public function edit_depart_second(Depart $id)
    {
        $hh = $id;
        $name = $id->name;
        $url = $id->url;
        return view('admin.departs.edit_depart_second', compact('name'), compact('url'), compact('hh'));
    }

    public function update_depart_second(Request $request, Depart $id)
    {
        if ($request->file('image')->isValid()) {



            $file_name = $request->image->getClientOriginalName();

            $validated = $request->validate([
                'name' => 'string|max:40',
                'image' => 'mimes:jpeg,png|max:1014',
                'url' => 'string|max:400',
            ]);

            $img_name = time() . '.' . $file_name;
            Image::make($request->file('image'))->resize(374, 374)->save(storage_path('app/public/images/' . $img_name));

            $id->name = $request->name;
            $id->img = $img_name;
            $id->url = $request->url;
            $id->save();

            return \Redirect('dashboard/departs_second');
        }

        abort(500, 'لم نتمكن من رفع الصورة :(');
    }
}
