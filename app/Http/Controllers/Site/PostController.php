<?php

namespace App\Http\Controllers\Site;

use App\Chat;
use App\Img;
use App\Http\Controllers\Controller;
use App\Post;
use App\Setting;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Favorit;
use DB;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('active')->only(['save', 'addPost']);
    }

    public function get_default_img()
    {
        $img = Setting::first()->default_img;
        return $img;
    }

    public function getSpecialPost()
    {
        $posts = Post::where('level', '1')->where('active', '!=', 'pending')->with(['city', 'region', 'user', 'category', 'sub', 'currancy', 'unit'])->latest()->limit(8)->get();
        $replace = [
            '"city":null' => '"city":{"name":"-"}',
            '"region":null' => '"region":{"name":"-"}',

        ];
        $new_message =  str_replace(array_keys($replace), $replace, $posts);
        return $new_message;
    }

    public function getLatestPost()
    {
        $posts = Post::where('active', '!=', 'pending')->with(['city', 'region', 'user', 'category', 'sub', 'currancy', 'unit'])->latest()->limit(8)->get();
        $replace = [
            '"city":null' => '"city":{"name":"-"}',
            '"region":null' => '"region":{"name":"-"}',

        ];
        $new_message =  str_replace(array_keys($replace), $replace, $posts);
        return $new_message;
    }

    public function addPost()
    {
        return view('site.addPost');
    }

    public function posts(Request $request)
    {
        $city = $request->city;
        $subCats = $request->input('subCats');
        $regions = $request->input('regions');
        $category = $request->category;
        $posts = Post::where(function ($query) use ($city, $regions, $subCats, $category) {
            if ($city != '') {
                $query->where('city_id', $city);
            }
            if ($regions != '') {
                $query->whereIn('region_id', $regions);
            }
            if ($category != '') {
                $query->where('category_id', $category);
            }
            if ($subCats != '') {
                $query->whereIn('subcat_id', $subCats);
            }
        })->with(['city', 'region', 'category', 'currancy', 'sub', 'unit'])->latest()->paginate(16);
        return view('site.search', compact('posts'));
    }

    public function postsAdvanced(Request $request)
    {
        $city = $request->city;
        $regions = $request->input('regions');
        $category = $request->category;
        $subCats = $request->input('subCats');
        $sortBy = $request->input('sortBy');

        $posts = Post::where(function ($query) use ($city, $regions, $subCats, $category, $sortBy) {
            if ($city != '') {
                $query->where('city_id', $city);
            }
            if ($regions != '') {
                $query->whereIn('region_id', $regions);
            }
            if ($category != '') {
                $query->where('category_id', $category);
            }
            if ($subCats != '') {
                $query->whereIn('subcat_id', $subCats);
            }

            switch ($sortBy) {
                case '1': {
                        $query->latest();
                    }
                    break;
                case '2': {
                        $query->orderBy('created_at', 'asc');
                    }
                    break;
                case '3': {
                        $query->orderBy('bedroom', 'desc');
                    }
                    break;
                case '4': {
                        $query->orderBy('bedroom', 'asc');
                    }
                    break;
            }
        })->with(['city', 'region', 'category', 'currancy', 'sub', 'unit'])->paginate(16);
        return view('site.search', compact('posts'));
    }

    public function getAllPosts()
    {
        $posts = Post::with(['city', 'region', 'category', 'currancy', 'sub', 'unit'])->latest()->paginate(16);
        return view('site.allPosts', compact('posts'));
    }

    public function getAllSpicialPosts()
    {
        $posts = Post::where('level', '1')->where('active', '!=', 'pending')->with(['city', 'region', 'category', 'currancy', 'sub', 'unit'])->latest()->paginate(16);
        return view('site.all_spicial_post', compact('posts'));
    }

    public function save(Request $request)
    {

        if ($request->type == 'سكني') {
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
                'bedroom' => 'required',
            ], [
                'title.required' => '***عنوان الإعلان مطلوب',
                'title.min' => 'يجب أن يكون العنوان مكون من 3 أحرف أو أكثر',
                'description.required' => '***وصف الإعلان مطلوب',
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
                'bedroom.required' => 'عدد غرف النوم مطلوب',

            ]);
        } else {
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
                //'price.required' => 'سعر العرض مطلوب',
                'price.string' => 'أدخل تنسيق صحيح للسعر',
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
        }
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


        $publish_state_json = DB::select('Select default (active) from posts limit 1');
        $publish_state_string = json_encode($publish_state_json);
        if (strpos($publish_state_string, "pending")) {
            $post->active = 'pending';
        } else {
            $post->active = 'active';
        }

        $post->save();

        return redirect('/profile');
    }

    public function postsView()
    {
        return view('site.posts');
    }

    public function show(Post $id)
    {
        $msgs = '';
        $myFavorite = null;
        if (auth()->check()) {
            $msgs = Chat::where('post_id', $id->id)->where(function ($q) {
                $q->where('send', auth()->id());
                $q->orWhere('recive', auth()->id());
            })->latest()->get();
            Chat::where('recive', auth()->id())->update(['seen' => 1]);

            $myFavorite = Favorit::where('post_id', $id->id)->where(function ($q) {
                $q->where('user_id', auth()->id());
            })->get();
        }
        $posts = Post::where('id', '!=', $id->id)->where(function ($q) use ($id) {
            $q->where('city_id', $id->city_id);
            $q->where('category_id', $id->category_id);
        })->inRandomOrder()->limit(4)->get();
        return view('site.post', compact('id', 'msgs', 'posts', 'myFavorite'));
    }

    public function search(Request $request)
    {
    }

    public function getPostByUser(User $id, Request $request)
    {
        $username = $request->username;

        $posts = Post::where('user_id', $id->id)->paginate(15);

        return view('site.search', compact('posts'), ['byUser' => $username]);
    }



    //api
    public function getAllPosts_api()
    {
        $posts = Post::with(['city', 'region', 'category', 'currancy', 'sub', 'unit'])->latest()->paginate(16);
        return response()->json($posts, 200);
    }

    public function get_my_posts_api(Request $request)
    {
        $user = User::where('customToken', $request->token)->first();


        if ($user) {
            $posts = Post::where('user_id', '=', $user->id)->with(['city', 'region', 'category', 'currancy', 'sub', 'unit'])->latest()->paginate(16);
            return response()->json(['success' => true, 'posts' => $posts], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }


    public function get_post_by_id(Request $request)
    {
        $post = Post::WHERE('id', '=', $request->id)->with(['user', 'city', 'region', 'category', 'currancy', 'sub', 'unit'])->get();
        return response()->json($post, 200);
    }

    public function get_default_post_image_api()
    {
        return Setting::first()->default_img;
    }

    public function postsSearch_api(Request $request)
    {
        $city = $request->city;
        $subCats = $request->input('subCats');
        $regions = $request->input('regions');
        $category = $request->category;
        $posts = Post::where(function ($query) use ($city, $regions, $subCats, $category) {
            if ($city != '') {
                $query->where('city_id', $city);
            }
            if ($regions != '') {
                $query->whereIn('region_id', $regions);
            }
            if ($category != '') {
                $query->where('category_id', $category);
            }
            if ($subCats != '') {
                $query->whereIn('subcat_id', $subCats);
            }
        })->with(['city', 'region', 'category', 'currancy', 'sub', 'unit'])->latest();
        return response()->json($posts, 200);
    }

    public function postsAdvancedSearch_api(Request $request)
    {
        $city = $request->city;
        $regions = $request->input('regions');
        $category = $request->category;
        $subCats = $request->input('subCats');
        $sortBy = $request->sortBy;

        $posts = Post::where(function ($query) use ($city, $regions, $subCats, $category, $sortBy) {
            if ($city != '') {
                $query->where('city_id', $city);
            }
            if ($regions != '') {
                $query->whereIn('region_id', $regions);
            }
            if ($category != '') {
                $query->where('category_id', $category);
            }
            if ($subCats != '') {
                $query->whereIn('subcat_id', $subCats);
            }

            switch ($sortBy) {
                case '1': {
                        $query->latest();
                    }
                    break;
                case '2': {
                        $query->orderBy('created_at', 'asc');
                    }
                    break;
                case '3': {
                        $query->orderBy('bedroom', 'desc');
                    }
                    break;
                case '4': {
                        $query->orderBy('bedroom', 'asc');
                    }
                    break;
            }
        })->with(['city', 'region', 'category', 'currancy', 'sub', 'unit'])->paginate(16);
        return response()->json($posts, 200);
    }

    public function save_api(Request $request)
    {
        $user = User::where('customToken', $request->token)->first();

        if ($user) {
            $post = new Post();
            $setting = Setting::first();
            $headImgName = '';
            $break = 0;
            $imgs = [];
            $contact = [];

            foreach ($request->all() as $k => $v) {


                if (Str::contains($k, 'imgs_file')) {

                    $val = $request->file($k);

                    $photo = $request->file($k);
                    $ext = $photo->getClientOriginalExtension();
                    $fileName = uniqid() . rand(10000, 50000) . '.' . $ext;
                    if ($break == 0) {
                        $headImgName = $fileName;
                        Image::make($val)
                            ->insert(storage_path('app/public/cats/') . $setting->water_img, 'center')
                            ->save(storage_path('app/public/posts/' . $fileName));




                        $break = 1;
                    } else {
                        //$name = uniqid() . '.' . explode('/', explode(':', substr($val, 0, strpos($val, ';')))[1])[1];
                        Image::make($val)
                            ->insert(storage_path('app/public/cats/') . $setting->water_img, 'center')
                            ->save(storage_path('app/public/posts/' . $fileName));
                        $imgs[] = $fileName;
                    }
                } else if ($k == 'token') {
                } else if ($k == 'type') {
                } else if ($k == 'call') {
                    if ($request->call == 'true') {
                        $contact[] = 'إتصال مباشر';
                    }
                } else if ($k == 'whatsapp') {
                    if ($request->whatsapp == 'true') {
                        $contact[] = 'واتسآب';
                    }
                } else if ($k == 'telegram') {
                    if ($request->telegram == 'true') {
                        $contact[] = 'تلغرام';
                    }
                } else if ($k == 'viber') {
                    if ($request->viber == 'true') {
                        $contact[] = 'فايبر';
                    }
                } else {
                    $post->$k = $request->$k;
                }
            }

            $post->imgs = $imgs;
            $post->contact = $contact;



            $post->user_id = $user->id;
            $post->country_id = 1;
            $post->img = $headImgName;


            $publish_state_json = DB::select('Select default (active) from posts limit 1');
            $publish_state_string = json_encode($publish_state_json);
            if (strpos($publish_state_string, "pending")) {
                $post->active = 'pending';
            } else {
                $post->active = 'active';
            }

            $post->save();

            return response()->json([
                'success' => true,
                'message' => 'yes',
            ], 401);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'errorr',
            ], 401);
        }
    }

    public function update_api(Request $request)
    {
        $user = User::where('customToken', $request->token)->first();

        if ($user) {
            try {
                $post = Post::find($request->id);
                $setting = Setting::first();
                $headImgName = '';
                $break = 0;
                $imgs = [];
                $contact = [];

                foreach ($request->all() as $k => $v) {


                    if (Str::contains($k, 'imgs_file')) {

                        $val = $request->file($k);

                        $photo = $request->file($k);
                        $ext = $photo->getClientOriginalExtension();
                        $fileName = uniqid() . rand(10000, 50000) . '.' . $ext;
                        if ($break == 0) {
                            $headImgName = $fileName;
                            Image::make($val)
                                ->insert(storage_path('app/public/cats/') . $setting->water_img, 'center')
                                ->save(storage_path('app/public/posts/' . $fileName));




                            $break = 1;
                        } else {
                            Image::make($val)
                                ->insert(storage_path('app/public/cats/') . $setting->water_img, 'center')
                                ->save(storage_path('app/public/posts/' . $fileName));
                            $imgs[] = $fileName;
                        }
                    } else if ($k == 'token') {
                    } else if ($k == 'id') {
                    } else if ($k == 'type') {
                    } else if ($k == 'call') {
                        if ($request->call == 'true') {
                            $contact[] = 'إتصال مباشر';
                        }
                    } else if ($k == 'whatsapp') {
                        if ($request->whatsapp == 'true') {
                            $contact[] = 'واتسآب';
                        }
                    } else if ($k == 'telegram') {
                        if ($request->telegram == 'true') {
                            $contact[] = 'تلغرام';
                        }
                    } else if ($k == 'viber') {
                        if ($request->viber == 'true') {
                            $contact[] = 'فايبر';
                        }
                    } else {
                        $post->$k = $request->$k;
                    }
                }

                $post->imgs = $imgs;
                $post->contact = $contact;



                $post->user_id = $user->id;
                $post->country_id = 1;
                $post->img = $headImgName;


                $publish_state_json = DB::select('Select default (active) from posts limit 1');
                $publish_state_string = json_encode($publish_state_json);
                if (strpos($publish_state_string, "pending")) {
                    $post->active = 'pending';
                } else {
                    $post->active = 'active';
                }

                $post->save();

                return response()->json([
                    'success' => true,
                    'message' => 'RockNRoll',
                ], 401);
            } catch (Throwable $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                ], 500);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'error',
            ], 401);
        }
    }

    public function get_spical_posts_api()
    {
        $posts = Post::where('level', '1')->where('active', '!=', 'pending')->with(['city', 'region', 'user', 'category', 'sub', 'currancy', 'unit'])->latest()->limit(8)->get();


        return response()->json($posts, 200);
    }

    public function get_all_spical_posts_api()
    {
        $posts = Post::where('level', '1')->where('active', '!=', 'pending')->with(['city', 'region', 'user', 'category', 'sub', 'currancy', 'unit'])->get();


        return response()->json($posts, 200);
    }

    public function get_latest_posts_api()
    {
        $posts = Post::where('active', '!=', 'pending')->with(['city', 'region', 'user', 'category', 'sub', 'currancy', 'unit'])->latest()->limit(8)->get();

        return response()->json($posts, 200);
    }

    public function delete_api(Request $request)
    {
        $user = User::where('customToken', $request->token)->first();
        if ($user) {

            $post = Post::find($request->id);
            $post->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }

    public function build_api()
    {
        $counter = 1;

        $users = User::all();

        foreach ($users as $user) {
            $user->customToken = Str::random(300);

            $user->save();

            $counter = $counter + 1;
        }

        return $counter;
    }
}
