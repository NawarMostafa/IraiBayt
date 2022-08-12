<?php

namespace App\Http\Controllers\Site;

use App\Chat;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Favorit;
use DB;

class ProfileController extends Controller
{
    public function __constract()
    {
        $this->middleware('auth');
    }
    public function edit()
    {
        $user = auth()->user();
        $msgs = Chat::where('recive', auth()->id())->where('send', '!=', auth()->id())->orderBy('seen')->limit(20)->latest()->get();
        $count = Chat::where('recive', auth()->id())->where('seen', 0)->count();
        return view('site.profile.profile', compact('user', 'count', 'msgs'));
    }
    public function store(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }
    public function getPost(Post $id)
    {
        return $id;
    }
    public function editPost($id)
    {
        return view('site.editPost', compact('id'));
    }
    public function update(Request $request, Post $id)
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
        $post = $id;
        $imgs = [];
        $break = 0;
        $isHImgEmpty;
        $headImgName = '';

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

        return 'success';
    }
    public function delete(Post $id)
    {
        $id->delete();
        return redirect()->back();
    }

    //--------API-------------
    public function store_api(Request $request)
    {
        $user = User::where('customToken', $request->token)->first();
        if ($user) {
            $user->name = $request->name;
            if ($request->new_password != '')
                $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'second case'
            ]);
        }
    }

    public function get_user_favorit_api(Request $request)
    {

        $user = User::where('customToken', $request->token)->first();

        if ($user) {

            $favorites = Favorit::where('user_id', '=', $user->id)->with(['post'])->get();
            return response()->json(['success' => true, 'favorites' => $favorites], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }
}
