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
        $this->viewData['pageTitle'] = 'Tags';
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->viewData['tags'] = Tag::orderBy('name')->with('posttags')->paginate();
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
            'name' => 'required|max:20|unique:tags',
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
        $this->viewData['tag'] = Tag::findOrFail($id);
        $this->viewData['posts'] = $this->viewData['tag']->posts()->paginate();
        $this->viewData['posts']->load(['category', 'user']);
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
        $this->viewData['tags'] = Tag::orderBy('name')->get();
        $this->viewData['tag'] = Tag::findOrFail($id);
        return view('admin.tags.index', $this->viewData);
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
            'name' => 'required|max:20|unique:tags,name,'.$id,
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
        $tag = Tag::findOrfail($id);
        foreach ($tag->posttags as $posttag) {
            $posttag->delete();
        }
        $tag->delete();
        $_SESSION['success'] = 'Delete Tag successfully!';
        return redirect('admin/tags');
    }
}
