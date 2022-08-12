<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public  function getAll(Request $request)
    {
        $q = $request->q != 'null' && !empty($request->q) ? $request->q : null;
        $countries = Category::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
        })->latest()->paginate(10);
        return $countries;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:categories,name',
        ], [
            'name.required' => 'اسم القسم مطلوب',
            'name.min' => 'يجب أن يكون اسم القسم مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم القسم مستخدم من قبل',
        ]);

        /*        $img=null;
        if(!empty($request->img)){
            $img=uniqid().'.'.explode('/',explode(':',substr($request->img,0,strpos($request->img,';')))[1])[1];
            Image::make($request->img)->save(storage_path('app/public/cats/'.$img));
        }*/

        Category::create([
            'name' => $request->name,
            //'description'=>$request->description,
            // 'img'=>$img
        ]);
        return "success";
    }

    public function show($id)
    {
        return Category::find($id);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:categories,name,' . $request->id,
        ], [
            'name.required' => 'اسم القسم مطلوب',
            'name.min' => 'يجب أن يكون اسم القسم مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم القسم مستخدم من قبل',
        ]);
        $cat =  Category::find($request->id);
        $cat->update([
            'name' => $request->name,
            //'description'=>$request->description
        ]);
        /* if($request->img!=$cat->img){
          $old=$cat->img;
          $path=storage_path('app/public/cats/'.$old);
          if(is_file($path)){
              unlink($path);
          }
          $img=uniqid().'.'.explode('/',explode(':',substr($request->img,0,strpos($request->img,';')))[1])[1];
          Image::make($request->img)->save(storage_path('app/public/cats/'.$img));
          $cat->img=$img;
          $cat->save();
      }*/
        return "success";
    }

    public function all()
    {
        return Category::with('subCats')->get();
    }
    public  function delete($id)
    {
        $country = Category::find($id);

        $country->delete();
        return "success";
    }
}
