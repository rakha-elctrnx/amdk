<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProductController extends CoreController
{
    public function product()
    {
        $products = $this->productModel->orderBy("name","asc")->findAll();

        $data = ([
            "products" => $products,
            "db" => $this->db
        ]);

        return view("modules/product",$data);
    }
    public function product_add(){
        return view("modules/product_add");
    }
    public function product_add_process(){
        $name = $this->request->getPost("name");
        $unit = $this->request->getPost("unit");
        $price = $this->request->getPost("price");
        $stocks = $this->request->getPost("stocks");

        $this->productModel->insert([
            "name" => $name,
            "unit" => $unit,
            "price" => $price,
            "stocks" => $stocks,
        ]);

        $productID = $this->productModel->getInsertID();

        $variant_unit = $this->request->getPost("variant_unit");
        $variant_price = $this->request->getPost("variant_price");
        $quantity_included = $this->request->getPost("quantity_included");

        $variant_unit_count = count($variant_unit) - 1;
        if($variant_unit_count > 0){
            for($v = 0; $v <= $variant_unit_count; $v++){
                if(strlen($variant_unit[$v]) > 0){
                    $this->productVariantModel->insert([
                        "product_id" => $productID,
                        "unit" => $variant_unit[$v],
                        "price" => $variant_price[$v],
                        "quantity_included" => $quantity_included[$v],
                    ]);
                }
            }
        }

        $this->session->setFlashdata("msg_type","success");
        $this->session->setFlashdata("msg","<b>Berhasil</b> <br> <b>".$name."</b> berhasil ditambahkan.");
        return redirect()->to(base_url('product'));
    }
}
