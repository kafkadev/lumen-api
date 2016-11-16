<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\User;

class Controller extends BaseController
{
    protected $viewData = [];

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        //
    }
}
