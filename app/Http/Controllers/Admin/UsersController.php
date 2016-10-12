<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Posts;
use Illuminate\Http\Request;

class UsersController extends AdminController
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
        $this->viewData['pageTitle'] = 'Users List';
        $this->viewData['users'] = User::orderBy('created_at', 'desc')->orderBy('username')->with('posts')->paginate(10);
        return view('admin.users.index', $this->viewData);
    }

    /**
    * Display create form.
    *
    * @return Response
    */
    public function create()
    {
        $this->viewData['pageTitle'] = 'Create User';
        $this->viewData['roleOptions'] = User::getAllRoles();
        return view('admin.users.create', $this->viewData);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
    public function store(Request $request)
    {
        $request->merge(array_map('trim', $request->except(['password', 'password_confirmation'])));
        $this->validate($request, [
            'name' => 'required|max:50|min:6|unique:users',
            'username' => 'required|alpha_dash|max:50|min:6|unique:users',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|confirmed|min:6|max:50',
        ]);
        $data = $request->all();
        User::create($data);
    }

    public function show($id)
    {
        $this->viewData['pageTitle'] = 'Posts List';
        $this->viewData['user'] = User::findOrfail($id);
        $this->viewData['posts'] = $this->viewData['user']->posts()->with('category', 'user')->paginate();
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
        $this->viewData['pageTitle'] = 'Edit User';
        $this->viewData['user'] = User::findOrfail($id);
        $this->viewData['roleOptions'] = User::getAllRoles();
        return view('admin.users.edit', $this->viewData);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:50|min:6|unique:users,name,'.$id,
            'username' => 'required|alpha_dash|max:50|min:6|unique:users,username,'.$id,
            'email' => 'required|email|max:50|unique:users,email,'.$id,
            'password' => 'confirmed|min:6|max:50',
        ]);
        $data = $request->has('password') ? $request->all() : $request->except(['password', 'password_confirmation']);
        $user = User::findOrfail($id);
        $user->update($data);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('admin/users');
    }
}
