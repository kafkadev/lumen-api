<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class PostsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->viewData['posts'] = Post::orderBy('created_at', 'desc')->orderBy('title')->with('category', 'user')->paginate();
        return view('admin.posts.index', $this->viewData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->viewData['users'] = User::orderBy('name')->pluck('name', 'id');
        $this->viewData['categories'] = Category::orderBy('name')->get();
        return view('admin.posts.create', $this->viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->merge(array_map('trim', $request->except(['excerpt', 'content'])));
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|alpha_dash|unique:posts',
            'excerpt' => 'required',
            'image' => 'image|max:2048',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $this->setUrlImage($request);
        }
        Post::create($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->viewData['users'] = User::orderBy('name')->pluck('name', 'id');
        $this->viewData['post'] = Post::findOrFail($id);
        $this->viewData['categories'] = Category::orderBy('name')->get();
        return view('admin.posts.edit', $this->viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->merge(array_map('trim', $request->except(['excerpt', 'content'])));
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|alpha_dash|unique:posts,slug,' . $id,
            'excerpt' => 'required',
            'image' => 'image|max:2048',
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $this->setUrlImage($request);
        }
        if ($request->remove_image == 'remove') {
            $data['image'] = null;
        }
        $post = Post::findOrfail($id);
        $post->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect('admin/posts');
    }

    /**
     * Create image url.
     *
     * @param  array  $request
     * @return string
     */
    private function setUrlImage($request)
    {
        $fileName = date("Ymdhis") . $this->viewData['auth']->username . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path() . '/posts/', $fileName);
        return url('/') . '/posts/' . $fileName;
    }
}
