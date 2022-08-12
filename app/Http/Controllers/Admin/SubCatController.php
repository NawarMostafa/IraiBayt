<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Subcat;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SubCatController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public  function getAll(Request $request)
    {
        $q = $request->q != 'null' && !empty($request->q) ? $request->q : null;
        $countries = Subcat::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
        })->with('category')->latest()->paginate(10);
        return $countries;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:categories,name',
            'category_id' => 'required',
            'type' => 'required'
        ], [
            'name.required' => 'اسم القسم مطلوب',
            'name.min' => 'يجب أن يكون اسم القسم مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم القسم مستخدم من قبل',
            'category_id.required' => 'يرجى تحديد قسم رئيسي'
        ]);

        $img = null;
        if (!empty($request->img)) {
            $img = uniqid() . '.' . explode('/', explode(':', substr($request->img, 0, strpos($request->img, ';')))[1])[1];
            Image::make($request->img)->save(storage_path('app/public/cats/' . $img));
        }

        Subcat::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'img' => $img,
            'category_id' => $request->category_id
        ]);
        return "success";
    }

    public function show($id)
    {
        return Subcat::find($id);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:categories,name,' . $request->id,
            'category_id' => 'required'
        ], [
            'name.required' => 'اسم القسم مطلوب',
            'name.min' => 'يجب أن يكون اسم القسم مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم القسم مستخدم من قبل',
            'category_id.required' => 'يرجى تحديد قسم رئيسي'
        ]);
        $cat =  Subcat::find($request->id);
        $cat->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'type' => $request->type,
        ]);
        if ($request->img != $cat->img) {
            $old = $cat->img;
            $path = storage_path('app/public/cats/' . $old);
            if (is_file($path)) {
                unlink($path);
            }
            $img = uniqid() . '.' . explode('/', explode(':', substr($request->img, 0, strpos($request->img, ';')))[1])[1];
            Image::make($request->img)->save(storage_path('app/public/cats/' . $img));
            $cat->img = $img;
            $cat->save();
        }
        return "success";
    }

    public function all()
    {
        return Subcat::all();
    }
    public  function delete($id)
    {
        $country = Subcat::find($id);

        $country->delete();
        return "success";
    }
    public  function fromCat($cat)
    {
        return  Subcat::where('category_id', $cat)->get();
    }
}
