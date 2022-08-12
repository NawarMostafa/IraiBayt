<?php

namespace App\Http\Controllers\Site;

use App\Favorit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\User;

class FavoritController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save($id)
    {


        return Favorit::firstOrcreate([
            'user_id' => auth()->id(),
            'post_id' => $id
        ]);
    }
    public function delete(Favorit $id)
    {
        $id->delete();
        return redirect()->back();
    }

    public function reset()
    {
        return Favorit::truncate();
    }

    public function delete_api(Request $request)
    {
        $user = User::where('customToken', $request->token)->first();

        if ($user) {
            $fav = Favorit::find($request->id);
            $fav->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }

    public function save_api(Request $request)
    {
        $user = User::where('customToken', $request->token)->first();

        if ($user) {
            $fav = Favorit::firstOrcreate([
                'user_id' => $user->id,
                'post_id' => $request->id
            ]);
            return response()->json(['success' => $fav]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }
}
