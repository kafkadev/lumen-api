<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoriesController extends AdminController
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->viewData['pageTitle'] = 'Categories';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->viewData['optionCategories'] = Category::with('posts')->orderBy('name')->get();
        $this->viewData['categories'] = Category::with('posts')->orderBy('name')->get();
        return view('admin.categories.index', $this->viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->merge(array_map('trim', $request->all()));
        $this->validate($request, [
            'name' => 'required|max:20',
            'slug' => 'required|unique:categories',
        ]);
        $data = $request->all();
        Category::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $this->viewData['category'] = Category::findOrFail($id);
        $this->viewData['posts'] = $this->viewData['category']->posts()->with('category', 'user')->paginate();
        return view('admin.posts.index', $this->viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->viewData['optionCategories'] = Category::with('posts')->orderBy('name')->get();
        $this->viewData['categories'] = Category::orderBy('name')->get();
        $this->viewData['category'] = Category::findOrFail($id);
        return view('admin.categories.index', $this->viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->merge(array_map('trim', $request->all()));
        $this->validate($request, [
            'name' => 'required|max:20',
            'slug' => 'required|unique:categories,slug,'.$id,
        ]);
        $data = $request->all();
        $category = Category::findOrfail($id);
        $category->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        foreach ($category->posts as $post) {
            $post->delete();
        }
        $category->delete();
        $_SESSION['success'] = 'Delete Category successfully!';
        return redirect('admin/categories');
    }
}
