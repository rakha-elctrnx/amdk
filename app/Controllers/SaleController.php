<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SaleController extends CoreController
{
    public function sale()
    {
        $sales = $this->saleModel
            ->where("admin_id", $this->session->admin_id)
            ->orderBy("date", "desc")
            ->orderBy("id", "desc")
            ->findAll();

        $data = ([
            "db" => $this->db,
            "sales" => $sales
        ]);

        return view("modules/sale", $data);
    }

    public function sale_add()
    {
        $customers = $this->customerModel->orderBy("name", "asc")->findAll();

        $data = ([
            "customers" => $customers
        ]);

        return view("modules/sale_add", $data);
    }

    public function sale_add_process()
    {
        $customer = $this->request->getPost("customer");
        $date = $this->request->getPost("date");
        $paid = $this->request->getPost("paid");
        $notes = $this->request->getPost("notes");

        $this->saleModel->insert([
            "number" => "-",
            "admin_id"          => $this->session->admin_id,
            "customer_id"       => $customer,
            "date"              => $date,
            "paid"              => $paid,
            "notes"             => $notes,
        ]);

        $newID = $this->saleModel->getInsertID();

        if ($newID < 10) {
            $textNewID = "00" . $newID;
        } elseif ($newID < 100) {
            $textNewID = "0" . $newID;
        } else {
            $textNewID = $newID;
        }

        $number = config("custom")->saleLetter . date("Ymd") . $textNewID;

        $this->saleModel->where("id", $newID)->set(["number" => $number])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Penjualan berhasil dibuat.");
        return redirect()->to(base_url('sale/' . $newID . '/manage'));
    }

    public function sale_manage($id)
    {
        $sale = $this->saleModel->where("id", $id)->where("admin_id", $this->session->admin_id)->first();

        if ($sale == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Data pembelian tidak ditemukan.");
            return redirect()->to(base_url('sale'));
        }

        $items = $this->saleItemModel->where("sale_id", $id)->findAll();
        $customers = $this->customerModel->orderBy("name", "asc")->findAll();
        // $products = $this->productVariantModel
        //     ->join('products', 'product_variants.product_id = products.id')
        //     ->select([
        //         'product_variants.id as product_variant_id',
        //         'product_variants.unit as product_variant_unit',
        //         'products.id as product_id',
        //         'products.unit as product_unit',
        //         'products.name as product_name',
        //     ])->findAll();
        $products = $this->productModel->orderBy("name", "asc")->findAll();
        $product_variants = $this->productVariantModel->orderBy("unit", "asc")->findAll();

        // dd($products);

        $data = ([
            "db"    => $this->db,
            "sale"   => $sale,
            "items" => $items,
            "customers" => $customers,
            "products" => $products,
            "product_variants" => $product_variants,
        ]);

        return view("modules/sale_manage", $data);
    }
}
