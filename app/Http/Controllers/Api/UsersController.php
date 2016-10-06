<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('api-auth');
    }

    /**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        return response()->json([
            'users' => User::all()
        ], 200);
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
            'name' => 'required|unique:users',
            'username' => 'required|alpha_dash|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $data = $request->all();
        $user = User::create($data);

        return response()->json([
            'success' => 'Create User successfully!',
            'user' => $user
        ], 200);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'error' => 'User does not exist.',
            ], 404);
        }

        return response()->json([
            'user' => $user
        ], 200);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'error' => 'User does not exist.',
            ], 404);
        }

        $request->merge(array_map('trim', $request->except(['password', 'password_confirmation'])));
        $this->validate($request, [
            'name' => 'required|unique:users,name,' . $id,
            'username' => 'required|alpha_dash|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'confirmed',
        ]);

        $data = $request->has('password') ? $request->all() : $request->except(['password', 'password_confirmation']);

        $user->update($data);

        return response()->json([
            'success' => 'Update user successfully!',
            'user' => $user
        ], 200);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'error' => 'User does not exist.',
            ], 404);
        }

        User::destroy($id);

        return response()->json([
            'success' => 'Delete user successfully.'
        ], 200);
    }
}
