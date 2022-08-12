<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAll(Request $request)
    {
        $q = $request->q;
        return User::where(function ($query) use ($q) {
            $query->where('name', 'like', "%$q%");
            $query->orWhere('email', 'like', "%$q%");
        })->latest()->paginate(200);
    }

    public function active($id)
    {
        $user = User::where('id', $id)->first();
        $user->active = !$user->active;
        $user->save();
    }

    public function delete($id)
    {
        if ($id != 1) {
            $user = User::where('id', $id)->first();
            $user->comments()->delete();
            $user->posts()->delete();
            $user->delete();
        }
    }

    public function edit($id)
    {
        return view('admin.users.edit', compact('id'));
    }
    public function getOne(User $id)
    {
        return $id;
    }
    public function update(Request $request, User $id)
    {
        if ($id->id == 1 && auth()->id() != 1) {
        } else {
            $id->name = $request->name;
            $id->email = $request->email;
            $id->role = $request->role;
            $id->password = trim($request->password) == '' ? $id->password : bcrypt($request->password);
            $id->save();
        }
    }
}
