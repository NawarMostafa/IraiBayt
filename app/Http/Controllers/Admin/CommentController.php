<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use App\Comment;
use App\Img;
use App\Post;
use App\Setting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Schema;

class CommentController extends Controller
{
    public function getCommentsByUserId($userId)
    {
        $comments = Comment::where('user_id', $userId)->latest()->paginate(100);
        return $comments;
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
    }
}
