<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LogoutController extends CoreController
{
    public function index()
    {
        session()->destroy();
        return redirect()->to(base_url("/"));
    }
}
