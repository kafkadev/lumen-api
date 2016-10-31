<?php

namespace App\Http\Controllers\Theme;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostsController extends ThemeController
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

    public function show($slug)
    {
        $this->viewData['post'] = Post::where('slug', $slug)->firstOrFail();
        $countViews = $this->viewData['post']->views;
        $this->viewData['post']->update(['views' => $countViews + 1]);
        return view('theme.post', $this->viewData);
    }
}
