<?php

namespace App\Http\Controllers\Theme;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends ThemeController
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
        $this->viewData['posts'] = Post::status()->techs()->with('user')->orderBy('created_at', 'desc')->paginate(12);
        return view('theme.posts', $this->viewData);
    }

    public function show($slug)
    {
        $this->viewData['tag'] = Tag::where('slug', $slug)->firstOrFail();
        $this->viewData['posts'] = $this->viewData['tag']->posts()->paginate();
        return view('theme.posts', $this->viewData);
    }
}
