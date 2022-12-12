<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends CoreController
{
    public function index()
    {
        //
        return view("modules/dashboard");
    }
}
