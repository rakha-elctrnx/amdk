<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class DashboardController extends CoreController
{
    public function index()
    {
        $products = $this->productModel->findAll();
        $suppliers = $this->supplierModel->findAll();
        $customers = $this->customerModel->findAll();

        $sales = $this->saleModel->orderBy("date","desc")->orderBy("id","desc")->findAll(5,0);
        $productions = $this->ProductionModel->orderBy("production_date","desc")->orderBy("id","desc")->findAll(5,0);

        $data = ([
            "products" => $products,
            "suppliers" => $suppliers,
            "customers" => $customers,
            "sales"=>$sales,
            "productions"=>$productions,
        ]);

        return view("modules/dashboard",$data);
    }
}
