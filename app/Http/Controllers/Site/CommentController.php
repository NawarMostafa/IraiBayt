<?php

namespace App\Http\Controllers\Site;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        Comment::create([
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            'body' => $request->body
        ]);
    }
    public function getAll(Post $id)
    {
        return $id->comments()->with('user')->limit(15)->orderBy('id', 'desc')->get();
    }
    //API---------------------------------------------------

    public function getAllComments($id)
    {
        $post = Post::find($id);
        return $post->comments()->with('user')->orderBy('id', 'desc')->get();
    }

    public function storeComment(Request $request)
    {

        try {
            Comment::create([
                'user_id' => $request->user_id,
                'post_id' => $request->post_id,
                'body' => $request->body
            ]);

            return response()->json([
                'success' => true,
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
            ], 500);
        }
    }
}
