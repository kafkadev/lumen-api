<?php

namespace App\Http\Controllers\Theme;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
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
        $this->viewData['posts'] = Post::orderBy('created_at', 'desc')->paginate(12);
        return view('theme.home', $this->viewData);
    }

    public function about()
    {
        return view('theme.about', $this->viewData);
    }

    public function getContact()
    {
        return view('theme.contact', $this->viewData);
    }

    public function postContact(Request $request)
    {
        dd($request->all());
    }
}
