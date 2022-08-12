<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Post;

class DashBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin']);
    }

    public function about()
    {
        return view('admin.about.index');
    }

    public function analize()
    {
        return view('admin.analize.index');
    }

    public function settings()
    {
        return view('admin.settings');
    }
    public function users()
    {
        return view('admin.users.index');
    }

    public function info()
    {
        return view('admin.info');
    }
    public function index()
    {
        return view('admin.home');
    }
    public function messages()
    {
        return view('admin.messages');
    }
    public function country()
    {
        return view('admin.country');
    }
    public function category()
    {
        return view('admin.category');
    }
    public function subcategory()
    {
        return view('admin.subcategory');
    }
    public function exchange()
    {
        return view('admin.exchange');
    }
    public function categoryQuiz()
    {
        return view('admin.quiz.quiz');
    }
    public function materials()
    {
        return view('admin.materials');
    }
    public function materialExchange()
    {
        return view('admin.materialexchange');
    }
    public function posts()
    {
        $publish_state_json = DB::select('Select default (active) from posts limit 1');

        $publish_state_string = json_encode($publish_state_json);


        if (strpos($publish_state_string, "pending")) {

            $value = 'النشر المباشر غير مفعل';
        } else {
            $value = 'النشر المباشر مفعل';
        }
        return view('admin.post', compact('value'));
    }

    public function posts_region(Request $request)
    {
        $region_id = $request->route('post');

        return view('admin.posts_by_region', compact('region_id'));
    }

    public function createPost()
    {
        return view('admin.addPost');
    }
    public function units()
    {
        return view('admin.unit');
    }
    public function currancies()
    {
        return view('admin.currancy');
    }
    public function tags()
    {
        return view('admin.tags');
    }
    public function askQuiz($id)
    {
        return view('admin.quiz.ask', compact('id'));
    }

    public function weather()
    {
        return view('admin.weather');
    }
    public function answerQuiz($id)
    {
        return view('admin.quiz.answer', compact('id'));
    }
    public function systems()
    {
        return view('admin.systems');
    }
    public function departs()
    {
        return view('admin.departs.index');
    }
    public function departs_second()
    {
        return view('admin.departs.departs_second');
    }
    public function add_depart_second()
    {
        return view('admin.departs.add_depart_second');
    }
}
