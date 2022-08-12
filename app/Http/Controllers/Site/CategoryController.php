<?php

namespace App\Http\Controllers\Site;

use App\Category;
use App\Subcat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        return Category::with('subCats')->get();
    }

    public function getSubCategories(Request $request)
    {

        if ($request->has('cat_id')) {
            $categoryId = $request->get('cat_id');
            $data = Subcat::where('category_id', $categoryId)->get();
            return ['success' => true, 'data' => $data];
        }
    }


    //Mini SubCategory Controller for test purposes
    public  function fromCat($cat)
    {
        return Subcat::where('category_id', $cat)->get();
    }

    public function show($id)
    {
        return Subcat::find($id);
    }
}
