<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'admin/dashboard';

    /**
     * @return \Illuminate\View\View
     */
    public function showLogin()
    {
        if (isset($_SESSION["logged_api_token"])) {
            return redirect($this->redirectTo);
        }
        return view('auth.login');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Laravel\Lumen\Http\Redirector
     */
    public function logout()
    {
        if (isset($_SESSION["logged_api_token"])) {
            // $api_token = sha1(time());
            // Auth::user()->update(['api_token' => $api_token]);
            session_unset($_SESSION["logged_api_token"]);
        }
        return redirect('login');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function showRegister()
    {
        if (isset($_SESSION["logged_api_token"])) {
            return redirect($this->redirectTo);
        }
        return view('auth.register');
    }

    /**
     * Index login controller
     *
     * When user success login will retrive callback as api_token
     */
    public function postLogin(Request $request)
    {
        $hasher = app()->make('hash');

        $username = $request->get('username');
        $password = $request->get('password');

        $user = User::where('username', $username)->first();

        if (!$user) {
            $_SESSION['errors']['fail'] = 'Wrong Username or Password!';
            return redirect('login');
        }

        if ( !$hasher->check($password, $user->password) ) {
            $_SESSION['errors']['fail'] = 'Wrong Username or Password!';
            return redirect('login');
        }

        $api_token = sha1(time());
        $user->update(['api_token' => $api_token]);

        $_SESSION['logged_api_token'] = $user->api_token;
        return redirect($this->redirectTo);
    }

    /**
     * Register new user
     *
     * @param $request Request
     */
    public function postRegister(Request $request)
    {
        $hasher = app()->make('hash');
        $request->merge(array_map('trim', $request->except(['password', 'password_confirmation'])));

        $username = $request->get('username');
        $password = $request->get('password');
        $name = $request->get('name');

        if ($name == '') {
            $_SESSION['errors']['name'] = 'Name is required!';
            return redirect('register');
        }

        if ($username == '') {
            $_SESSION['errors']['username'] = 'Username is required!';
            return redirect('register');
        }

        if ( User::where('username', $username)
                 ->count() > 0 ) {
            $_SESSION['errors']['username_exist'] = 'Username existed!';
            return redirect('register');
        }

        if ($password == '') {
            $_SESSION['errors']['password'] = 'Password is required!';
            return redirect('register');
        }

        if ($password != $request->get('password_confirmation')) {
            $_SESSION['errors']['password_confirmation'] = 'Password does not match';
            return redirect('register');
        }

        $user = User::create([
            'name' => $request->get('name'),
            'username' => $username,
            'email' => $email,
            'password' => $hasher->make($password),
            'role' => 0,
        ]);

        return $this->postLogin($request);
    }
}
