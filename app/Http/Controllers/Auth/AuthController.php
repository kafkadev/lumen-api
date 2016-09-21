<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Index login controller
     *
     * When user success login will retrive callback as api_token
     */
    public function login(Request $request)
    {
        $hasher = app()->make('hash');

        $username = $request->get('username');
        $password = $request->get('password');

        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Your username or password incorrect!'
            ]);
        }

        if ( !$hasher->check($password, $user->password) ) {
            return response()->json([
                'message' => 'Your username or password incorrect!'
            ]);
        }

        $api_token = sha1(time());
        $create_token = User::where('id', $user->id)->update(['api_token' => $api_token]);

        return response([
            'success' => true,
            'message' => 'Logged in!',
            'api_token' => $api_token,
            'authUser' => \Auth::user(),
        ]);
    }

    /**
     * Register new user
     *
     * @param $request Request
     */
    public function register(Request $request)
    {
        $hasher = app()->make('hash');

        $request->merge(array_map('trim', $request->except(['password', 'password_confirmation'])));
        $this->validate($request, [
            'name' => 'required|unique:users',
            'username' => 'required|alpha_dash|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $data = $request->all();
        $data['password'] = $hasher->make($request->get('password'));

        $register = User::create($data);

        if ($register) {
            return response([
                'success' => true,
                'message' => 'Success register!',
            ]);
        }else{
            return response([
                'success' => false,
                'message' => 'Failed to register!',
            ]);
        }
    }
}
