<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProductController extends CoreController
{
    public function product()
    {
        //
        return view("modules/product");
    }
}
