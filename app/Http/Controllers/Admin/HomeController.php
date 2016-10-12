<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends AdminController
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
        $this->viewData['pageTitle'] = 'Admin Dashboard';
        return view('admin.dashboard', $this->viewData);
    }
}
