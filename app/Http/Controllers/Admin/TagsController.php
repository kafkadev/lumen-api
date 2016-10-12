<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

class TagsController extends AdminController
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

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->viewData['pageTitle'] = 'Tags List';
        $this->viewData['tags'] = Tag::orderBy('name')->paginate();
        return view('admin.tags.index', $this->viewData);
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
            'name' => 'required',
            'slug' => 'required|alpha_dash|unique:categories',
        ]);
        $data = $request->all();
        Tag::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $this->viewData['pageTitle'] = 'Posts List';
        $this->viewData['category'] = Tag::findOrFail($id);
        $this->viewData['posts'] = $this->viewData['category']->posts()->with('category', 'user')->paginate();
        return view('admin.tags.index', $this->viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->viewData['pageTitle'] = 'Create Tag';
        $this->viewData['categories'] = Tag::orderBy('name')->get();
        return view('admin.tags.create', $this->viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->viewData['pageTitle'] = 'Edit Tag';
        $this->viewData['categories'] = Tag::orderBy('name')->get();
        $this->viewData['category'] = Tag::findOrFail($id);
        return view('admin.tags.edit', $this->viewData);
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
            'name' => 'required',
            'slug' => 'required|alpha_dash|unique:categories,slug,' . $id,
        ]);
        $data = $request->all();
        $tags = Tag::findOrfail($id);
        $tags->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Tag::destroy($id);
        return redirect('admin/tags');
    }
}
