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

    public function show($slug)
    {
        $this->viewData['post'] = Post::where('slug', $slug)->first();
        return view('theme.post', $this->viewData);
    }
}
