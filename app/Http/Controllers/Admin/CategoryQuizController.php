<?php

namespace App\Http\Controllers\Admin;

use App\CatQuiz;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryQuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public  function getAll(Request $request)
    {
        $q = $request->q != 'null' && !empty($request->q) ? $request->q : null;
        $countries = CatQuiz::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
        })->latest()->paginate(10);
        return $countries;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:cat_quizzes,name',
        ], [
            'name.required' => 'اسم القسم مطلوب',
            'name.min' => 'يجب أن يكون اسم القسم مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم القسم مستخدم من قبل',
        ]);



        //$extension = $request->image->extension();
        $file_name = $request->img->getClientOriginalName();

        //$image = $request->file('image')->store('app/public/images','public');
        //$imagePath = Storage::url($image);

        $img_name = time() . '.' . $file_name;
        Image::make($request->file('img'))
            ->resize(374, 374)->save(storage_path('app/public/images/' . $img_name));


        CatQuiz::create([
            'name' => $request->name,
            'img' => $img_name
        ]);

        $alert = 'تم إضافة القسم بنجاح';
        return view('admin.quiz.quiz', compact('alert'));
    }

    public function show($id)
    {
        return CatQuiz::find($id);
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|unique:cat_quizzes,name,' . $request->id,
        ], [
            'name.required' => 'اسم القسم مطلوب',
            'name.min' => 'يجب أن يكون اسم القسم مكون من 3 أحرف أو أكثر',
            'name.unique' => 'اسم القسم مستخدم من قبل',
        ]);
        $cat =  CatQuiz::find($request->id);
        $cat->update([
            'name' => $request->name,

        ]);
        if ($request->img != $cat->img) {
            $old = $cat->img;
            $path = storage_path('app/public/cats/' . $old);
            if (is_file($path)) {
                unlink($path);
            }

            $file_name = $request->img->getClientOriginalName();

            $img_name = time() . '.' . $file_name;
            Image::make($request->file('img'))
                ->resize(374, 374)->save(storage_path('app/public/images/' . $img_name));

            $cat->img = $img_name;
            $cat->save();
        }
        $alert = 'تم تعديل القسم بنجاح';
        return view('admin.quiz.quiz', compact('alert'));
    }

    public function all()
    {
        return CatQuiz::all();
    }
    public  function delete($id)
    {
        $country = CatQuiz::find($id);
        $asks = $country->asks;
        foreach ($asks as $ask) {
            $ask->answers()->delete();
            $ask->delete();
        }
        $country->delete();
        $alert = 'تم حذف القسم بنجاح';
        return view('admin.quiz.quiz', compact('alert'));
    }

    public function editquiz($id)
    {
        return view('admin.quiz.edit_quiz', compact('id'));
    }
}
