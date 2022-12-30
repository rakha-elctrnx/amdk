<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProductController extends CoreController
{
    public function product()
    {
        $products = $this->productModel->orderBy("name", "asc")->findAll();

        $data = ([
            "products" => $products,
            "db" => $this->db
        ]);

        return view("modules/product", $data);
    }
    public function product_add()
    {
        return view("modules/product_add");
    }
    public function product_add_process()
    {
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
        if ($variant_unit_count > 0) {
            for ($v = 0; $v <= $variant_unit_count; $v++) {
                if (strlen($variant_unit[$v]) > 0) {
                    $this->productVariantModel->insert([
                        "product_id" => $productID,
                        "unit" => $variant_unit[$v],
                        "price" => $variant_price[$v],
                        "quantity_included" => $quantity_included[$v],
                    ]);
                }
            }
        }

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> <b>" . $name . "</b> berhasil ditambahkan.");
        return redirect()->to(base_url('product'));
    }

    public function product_edit($id)
    {
        $product = $this->productModel->where('id', $id)->orderBy("name", "asc")->first();
        $productVariants = $this->productVariantModel->where('product_id', $id)->findAll();
        $data = ([
            "product" => $product,
            "product_variants" => $productVariants,
            "db" => $this->db
        ]);

        return view("modules/product_edit", $data);
    }

    public function product_edit_process()
    {
        $productID = $this->request->getPost("product_id");
        $name = $this->request->getPost("name");
        $unit = $this->request->getPost("unit");
        $price = $this->request->getPost("price");

        $production = $this->ProductionModel->where('product_id', $productID)->findAll();
        $sale_items = $this->saleItemModel->where('product_id', $productID)->findAll();

        if ($production != NULL || $sale_items != NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> <b>" . $name . "</b> gagal diubah, karena data sudah pernah digunakan.");
            return redirect()->to(base_url('product/' . $productID . '/edit'));
        }

        $variant_unit_edit = $this->request->getPost("variant_unit_edit");
        $variant_price_edit = $this->request->getPost("variant_price_edit");
        $variant_id = $this->request->getPost("variant_id");
        $quantity_included_edit = $this->request->getPost("quantity_included_edit");
        if ($quantity_included_edit) {
            $variant_unit_count_edit = count($variant_unit_edit) - 1;
            for ($v = 0; $v <= $variant_unit_count_edit; $v++) {
                if (strlen($variant_unit_edit[$v]) > 0) {
                    $this->productVariantModel->where(['id' => $variant_id[$v], 'product_id' => $productID])->set([
                        "unit" => $variant_unit_edit[$v],
                        "price" => $variant_price_edit[$v],
                        "quantity_included" => $quantity_included_edit[$v],
                    ])->update();
                }
            }
        }

        $variant_unit = $this->request->getPost("variant_unit");
        $variant_price = $this->request->getPost("variant_price");
        $quantity_included = $this->request->getPost("quantity_included");

        if ($variant_unit) {
            $variant_unit_count = count($variant_unit) - 1;
            for ($v = 0; $v <= $variant_unit_count; $v++) {
                if (strlen($variant_unit[$v]) > 0) {
                    $this->productVariantModel->insert([
                        "product_id" => $productID,
                        "unit" => $variant_unit[$v],
                        "price" => $variant_price[$v],
                        "quantity_included" => $quantity_included[$v],
                    ]);
                }
            }
        }

        $this->productModel->where('id', $productID)->set([
            "name" => $name,
            "unit" => $unit,
            "price" => $price,
        ])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> <b>" . $name . "</b> berhasil diubah.");
        return redirect()->to(base_url('product/' . $productID . '/edit'));
    }

    public function product_delete_process($productID)
    {
        $productData = $this->productModel->where('id', $productID)->first();

        $production = $this->ProductionModel->where('product_id', $productID)->findAll();
        $product_variant = $this->productVariantModel->where('product_id', $productID)->findAll();
        $sale_items = $this->saleItemModel->where(['product_id' => $productID])->findAll();

        if ($production != NULL || $sale_items != NULL || $product_variant != NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> <b> " . $productData->name . "</b> gagal dihapus, karena data sudah pernah digunakan.");
            return redirect()->to(base_url('product'));
        }

        $this->productModel->where('id', $productID)->delete();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> <b>" . $productData->name . "</b> berhasil dihapus.");
        return redirect()->to(base_url('product'));
    }

    public function product_varian_delete_process($productID, $variant_id)
    {
        $variantData = $this->productVariantModel->where('id', $variant_id)->first();

        $production = $this->ProductionModel->where('product_id', $productID)->findAll();
        $sale_items = $this->saleItemModel->where(['product_id' => $productID, 'product_variant_id' => $variant_id])->findAll();

        if ($production != NULL || $sale_items != NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> <b> varian" . $variantData->unit . "</b> gagal dihapus, karena data sudah pernah digunakan.");
            return redirect()->to(base_url('product/' . $productID . '/edit'));
        }

        $this->productVariantModel->where('id', $variant_id)->delete();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br>varian <b>" . $variantData->unit . "</b> berhasil dihapus.");
        return redirect()->to(base_url('product/' . $productID . '/edit'));
    }
}
