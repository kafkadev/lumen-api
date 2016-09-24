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
     * @return void
     */
    public function __construct()
    {
        $this->viewData['auth'] = isset($_SESSION["logged_id"]) ? User::find($_SESSION['logged_id']) : null;
    }
}
