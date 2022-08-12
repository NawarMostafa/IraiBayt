<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use App\Img;
use App\Post;
use App\Setting;
use App\Comment;
use App\Favorit;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Schema;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function getAll(Request $request)
    {
        $q = $request->q != 'null' && !empty($request->q) ? $request->q : null;
        $posts = Post::where(function ($query) use ($q) {
            $query->where('title', 'like', "%$q%");
            $query->orWhereHas('category', function ($query) use ($q) {
                $query->where('name', 'like', "%$q%");
            });
            $query->orWhereHas('region', function ($query) use ($q) {
                $query->where('name', 'like', "%$q%");
            });
            $query->orWhereHas('user', function ($query) use ($q) {
                $query->where('name', 'like', "%$q%");
            });
        })->with(['user', 'region', 'category'])->latest()->paginate(100);

        return $posts;
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|min:3',
            'description' => 'required|string',
            'price' => 'required',
            'payment' => 'required|string',
            'area' => 'required',
            'currancy_id' => 'required|integer',
            'unit_id' => 'required|integer',
            'city_id' => 'required|integer',
            'region_id' => 'required|integer',
            'category_id' => 'required|integer',
            'subcat_id' => 'required|integer',
            //'name' => 'required',
            'phone' => 'required',
            //'bedroom' => 'required',
        ], [
            'title.required' => 'عنوان الإعلان مطلوب',
            'title.min' => 'يجب أن يكون العنوان مكون من 3 أحرف أو أكثر',
            'description.required' => 'وصف الإعلان مطلوب',
            'description.string' => 'يجب أن يكون الوصف واضح',
            'price.required' => 'سعر العرض مطلوب',
            //'price.string' => 'أدخل تنسيق صحيح للسعر',
            'area.required' => 'مساحة العقار مطلوبة',
            'payment.required' => 'طريقة الدفع مطلوبة',
            'currancy_id.required' => 'العملة مطلوبة',
            'unit_id.required' => 'الوحدة مطلوبة',
            //'country_id.integer'=>'حقل الدولة مطلوب',
            'city_id.required' => 'حقل المدينة مطلوب',
            'city_id.integer' => 'حقل المدينة مطلوب',
            'category_id.required' => 'حقل القسم مطلوب',
            'subcat_id.*' => 'حقل القسم مطلوب',
            'category_id.integer' => 'حقل القسم مطلوب',
            'region_id.required' => 'حقل المنطقة مطلوب',
            'region_id.integer' => 'حقل المنطقة مطلوب',
            //'name.required' => 'الرجاء إدخال اسم المعلن',
            'phone.required' => 'الرجاء إدخال رقم هاتف للتواصل',
            //'bedroom.required' => 'الرجاء إدخال عدد غرف النوم',

        ]);


        $post = new Post();
        $setting = Setting::first();
        $headImgName = '';
        $break = 0;
        $imgs = [];

        foreach ($request->all() as $k => $v) {
            if ($k == 'imgs') {
                foreach ($request->$k as $val) {
                    if ($break == 0) {
                        $headImgName = uniqid() . '.' . explode('/', explode(':', substr($val, 0, strpos($val, ';')))[1])[1];
                        Image::make($val)
                            ->insert(storage_path('app/public/cats/') . $setting->water_img, 'center')
                            ->save(storage_path('app/public/posts/' . $headImgName));
                        $break = 1;
                    } else {
                        $name = uniqid() . '.' . explode('/', explode(':', substr($val, 0, strpos($val, ';')))[1])[1];
                        Image::make($val)
                            ->insert(storage_path('app/public/cats/') . $setting->water_img, 'center')
                            ->save(storage_path('app/public/posts/' . $name));
                        $imgs[] = $name;
                    }
                }
                $post->$k = $imgs;
            } else {
                $post->$k = $request->$k;
            }
        }



        $post->user_id = auth()->user()->id;
        $post->country_id = 1;
        $post->img = $headImgName;



        $post->save();

        return 'success';
    }


    public function update(Request $request, Post $post)
    {

        $this->validate($request, [
            'title' => 'required|min:3',
            'description' => 'required|string',
            'price' => 'required',
            'payment' => 'required|string',
            'area' => 'required',
            'currancy_id' => 'required|integer',
            'unit_id' => 'required|integer',
            //'country_id'=>'required|integer',
            'city_id' => 'required|integer',
            'region_id' => 'required|integer',
            'category_id' => 'required|integer',
            'subcat_id' => 'required|integer',
            //'name' => 'required',
            'phone' => 'required'
        ], [
            'title.required' => 'عنوان الإعلان مطلوب',
            'title.min' => 'يجب أن يكون العنوان مكون من 3 أحرف أو أكثر',
            'description.required' => 'وصف الإعلان مطلوب',
            'description.string' => 'يجب أن يكون الوصف واضح',
            'price.required' => 'سعر العرض مطلوب',
            //'price.numeric' => 'أدخل تنسيق صحيح للسعر',
            'area.required' => 'مساحة العقار مطلوبة',
            'payment.required' => 'طريقة الدفع مطلوبة',
            'currancy_id.required' => 'العملة مطلوبة',
            'unit_id.required' => 'الوحدة مطلوبة',
            // 'country_id.required'=>'حقل الدولة مطلوب',
            //'country_id.integer'=>'حقل الدولة مطلوب',
            'city_id.required' => 'حقل المدينة مطلوب',
            'city_id.integer' => 'حقل المدينة مطلوب',
            'category_id.required' => 'حقل القسم مطلوب',
            'subcat_id.*' => 'حقل القسم مطلوب',
            'category_id.integer' => 'حقل القسم مطلوب',
            'region_id.required' => 'حقل المنطقة مطلوب',
            'region_id.integer' => 'حقل المنطقة مطلوب',
            //'name.required' => 'الرجاء إدخال اسم المعلن',
            'phone.required' => 'الرجاء إدخال رقم هاتف للتواصل'
        ]);


        $setting = Setting::first();

        $imgs = [];
        $break = 0;
        $headImgName = '';
        $isHImgEmpty;

        foreach ($request->all() as $k => $v) {
            if ($k == 'img') {
                if (empty($request->$k)) {
                    $isHImgEmpty = true;
                } else {
                    $isHImgEmpty = false;
                }
            } elseif ($k == 'imgs') {
                if (empty($request->$k)) // case images are empty
                {
                    if ($isHImgEmpty) {
                        //case head image is empty
                        //Do nothing
                    } else {
                        //case head image isn't empty
                        //Do nothing
                    }
                } else //case images aren't empty
                {
                    $old = $post->imgs;
                    if ($isHImgEmpty) {
                        //case head image is empty
                        foreach ($request->$k as $val) {
                            if ($break  == 0) {
                                if (!in_array($val, $old)) {
                                    $headImgName = uniqid() . '.' . explode('/', explode(':', substr($val, 0, strpos($val, ';')))[1])[1];
                                    Image::make($val)->save(storage_path('app/public/posts/' . $headImgName));
                                    $break = 1;
                                } else {
                                    $headImgName = $val;
                                    $break = 1;
                                }
                            } else {
                                if (!in_array($val, $old)) {
                                    $name = uniqid() . '.' . explode('/', explode(':', substr($val, 0, strpos($val, ';')))[1])[1];
                                    Image::make($val)->save(storage_path('app/public/posts/' . $name));
                                    $imgs[] = $name;
                                } else {
                                    $imgs[] = $val;
                                }
                            }
                        }
                        $post->$k = $imgs;
                    } else {
                        //case head image isn't empty
                        foreach ($request->$k as $val) {
                            if (!in_array($val, $old)) {
                                $name = uniqid() . '.' . explode('/', explode(':', substr($val, 0, strpos($val, ';')))[1])[1];
                                Image::make($val)->save(storage_path('app/public/posts/' . $name));
                                $imgs[] = $name;
                            } else {
                                $imgs[] = $val;
                            }
                        }
                        $post->$k = $imgs;
                    }
                }
            } else {
                $post->$k = $request->$k;
            }
        }

        if ($break == 1) {
            $post->img = $headImgName;
        }

        $post->save();
    }


    public function active($id)
    {
        $post = Post::find($id);
        if ($post->active == 'pending') {
            $post->update([
                'active' => 'active'
            ]);
        } else {
            $post->update([
                'active' => 'pending'
            ]);
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

    public function delete($id)
    {
        $post = Post::find($id);
        $imgs = $post->imgs;

        $path = storage_path('app/public/posts/');

        foreach ($imgs as $img) {

            if (is_file($path . $img)) {
                unlink($path . $img);
            }
        }

        $post->delete();
    }

    public function edit(Post $post)
    {
        return view('admin.editPost', compact('post'));
    }

    public function show($post)
    {
        return Post::where('id', $post)->with(['unit', 'currancy'])->first();
    }

    public function get_default_value()
    {
        $publish_state_json = DB::select('Select default (active) from posts limit 1');

        $publish_state_string = json_encode($publish_state_json);


        if (strpos($publish_state_string, "pending")) {

            return 'النشر المباشر غير مفعل';
        } else {
            return 'النشر المباشر مفعل';
        }
    }

    public function getPostsByUserId($userId)
    {
        $posts = Post::where('user_id', $userId)->with(['user', 'region', 'category'])->latest()->paginate(100);
        return $posts;
    }

    public static function getPostsByRegionId($post)
    {
        return Post::where('region_id', $post)->count();
    }

    public static function getPostsByRId($post)
    {
        return Post::where('region_id', $post)->with(['user', 'region', 'category'])->latest()->paginate(100);
    }
}
