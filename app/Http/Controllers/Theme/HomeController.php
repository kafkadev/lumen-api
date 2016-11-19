<?php

namespace App\Http\Controllers\Theme;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Comment;
use Illuminate\Http\Request;

class HomeController extends ThemeController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->viewData['posts'] = Post::status()->with('user')->orderBy('created_at', 'desc')->paginate(12);
        return view('theme.home', $this->viewData);
    }

    public function about()
    {
        $this->viewData['post'] = Post::where('slug', 'about')->first();
        if (!$this->viewData['post']) {
            return redirect('/');
        }
        return view('theme.about', $this->viewData);
    }

    public function getContact()
    {
        return view('theme.contact');
    }

    public function postContact(Request $request)
    {
        $request->merge(array_map('trim', $request->all()));
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['msg'] = $request->message;
        Comment::create($data);
    }
}
