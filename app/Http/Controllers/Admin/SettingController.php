<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Setting;
use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function getAll()
    {
        return Setting::first();
    }
    public function save(Request $request)
    {
        $set = Setting::first();
        $set->name = $request->name;
        $set->email = $request->email;
        $set->about = $request->about;
        $set->priv = $request->priv;
        $set->terms = $request->terms;
        $set->face = $request->face;
        $set->twitter = $request->twitter;
        $set->lenkedin = $request->lenkedin;
        $img = '';
        if ($request->logo != $set->logo) {
            $old = $set->logo;
            $path = storage_path('app/public/cats/' . $old);
            if (is_file($path)) {
                unlink($path);
            }
            $img = uniqid() . '.' . explode('/', explode(':', substr($request->logo, 0, strpos($request->logo, ';')))[1])[1];
            Image::make($request->logo)->save(storage_path('app/public/cats/' . $img));
            $set->logo = asset('storage/app/public/cats/' . $img);
        }
        if ($request->default_img != $set->default_img) {
            $old = $set->default_img;
            $path = storage_path('app/public/posts/' . $old);
            if (is_file($path)) {
                unlink($path);
            }
            $img = uniqid() . '.' . explode('/', explode(':', substr($request->default_img, 0, strpos($request->default_img, ';')))[1])[1];
            Image::make($request->default_img)->save(storage_path('app/public/posts/' . $img));
            $set->default_img = $img;

            $posts = POST::WHERE('img', $old)->get();
            foreach ($posts as $post) {
                $p = POST::find($post->id);
                $p->img = $img;
                $p->save();
            }
        }

        if ($request->water_img != $set->water_img) {
            $old = $set->water_img;
            $path = storage_path('app/public/cats/' . $old);
            if (is_file($path)) {
                unlink($path);
            }
            $img1 = uniqid() . '.' . explode('/', explode(':', substr($request->water_img, 0, strpos($request->water_img, ';')))[1])[1];
            Image::make($request->water_img)->save(storage_path('app/public/cats/' . $img1));
            $set->water_img = $img1;
        }

        $set->save();
    }
}
