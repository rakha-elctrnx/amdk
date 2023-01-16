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
        $notes = $this->request->getPost("notes");

        $this->saleModel->insert([
            "number" => "-",
            "admin_id"          => $this->session->admin_id,
            "customer_id"       => $customer,
            "date"              => $date,
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

        $number = config("Custom")->saleLetter . date("Ymd") . $textNewID;

        $this->saleModel->where("id", $newID)->set(["number" => $number])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Penjualan berhasil dibuat.");
        return redirect()->to(base_url('sale/' . $newID . '/manage'));
    }

    public function sale_edit_process()
    {
        $sale_id = $this->request->getPost("sale_id");
        $customer_id = $this->request->getPost("customer_id");
        $date = $this->request->getPost("date");
        $notes = $this->request->getPost("notes");

        $this->saleModel->where("id", $sale_id)->set([
            "customer_id"       => $customer_id,
            "date"              => $date,
            "notes"             => $notes,
        ])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Data penjualan berhasil disimpan.");
        return redirect()->to(base_url('sale/' . $sale_id . '/manage'));
    }

    public function sale_delete($sale_id)
    {
        $data_sale = $this->saleModel->where('id', $sale_id)->first();
        if ($data_sale == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Penjualan tidak ditemukan.");
            return redirect()->to(base_url('sale'));
        }

        $cek_sale_items = $this->saleItemModel->where('sale_id', $sale_id)->findAll();

        if ($cek_sale_items) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Penjualan No. Transaksi : $data_sale->number gagal dihapus karena data tidak kosong.");
            return redirect()->to(base_url('sale/' . $sale_id . '/manage'));
        }

        $this->saleModel->where("id", $sale_id)->delete();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Penjualan berhasil dihapus.");
        return redirect()->to(base_url('sale'));
    }

    public function sale_manage($id)
    {
        $sale = $this->saleModel->where("id", $id)->first();

        if ($sale == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Data Penjualan tidak ditemukan.");
            return redirect()->to(base_url('sale'));
        }

        $items = $this->saleItemModel->where("sale_id", $id)->findAll();
        $customers = $this->customerModel->orderBy("name", "asc")->findAll();

        $products = $this->productModel->orderBy("name", "asc")->findAll();
        $product_variants = $this->productVariantModel->orderBy("unit", "asc")->findAll();



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

    public function sale_item_add()
    {
        $sale_id = $this->request->getPost("sale_id");
        $product = $this->request->getPost("product_id");
        $quantity = $this->request->getPost("quantity");
        $discount = $this->request->getPost("discount");
        $productExplode = explode('-', $product);

        $thisSale = $this->saleModel->where('id', $sale_id)->first();

        $productData = null;
        $productId = null;
        $productVariantId = null;
        $productUnit = null;
        $productPrice = null;
        if ($productExplode[1] && $productExplode[3] == 0) {
            $productData = $this->productModel->where('id', $productExplode[1])->first();
            $productId = $productData->id;
            $productUnit = $productData->unit;
            $productPrice = $productData->price;
            $perhitungan_qty = $quantity;
            $productStock = $productData->stocks;
        } elseif ($productExplode[1] && $productExplode[3] != 0) {
            $productData = $this->productVariantModel
                ->select([
                    'product_variants.id as product_variants_id',
                    'product_variants.unit as product_variants_unit',
                    'product_variants.price as product_variants_price',
                    'product_variants.quantity_included as product_variants_quantity_included',
                    'products.id as product_id',
                    'products.name',
                    'products.unit as product_unit',
                    'products.stocks as product_stock',
                ])
                ->join('products', 'product_variants.product_id = products.id')
                ->where(['product_variants.id' => $productExplode[3], 'product_variants.product_id' => $productExplode[1]])
                ->first();
            $productVariantId = $productData->product_variants_id;
            $productId = $productData->product_id;
            $productUnit = $productData->product_variants_unit;
            $productPrice = $productData->product_variants_price;
            $perhitungan_qty = $productData->product_variants_quantity_included * $quantity;
            $productStock = $productData->product_stock;
        }


        if ($productStock < $perhitungan_qty) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Stok Produk Kurang !");
            return redirect()->to(base_url('sale/' . $sale_id . '/manage'));
        } else {

            $this->saleItemModel->insert([
                "sale_id" =>  $sale_id,
                "product_id"                => $productId,
                "product_variant_id"        => $productVariantId,
                "snapshot_product_name"     => $productData->name,
                "snapshot_product_unit"     => $productUnit,
                "quantity"              => $quantity,
                "price"             => $productPrice,
                "discount"             => $discount,
            ]);

            $this->productModel->where("id", $productId)->set([
                "stocks"        => ($productStock - $perhitungan_qty)
            ])->update();

            $transactionDetails = "Penjualan ".$productData->name." (Ref : ".$thisSale->number.")";
            $transactionNominal = $productPrice * $quantity - ($productPrice * $quantity * $discount / 100);

            $this->transactionModel->insert([
                "admin_id"  => $thisSale->admin_id,
                "details"   => $transactionDetails,
                "date"      => $thisSale->date,
                "debit"    => $transactionNominal,
                "reference_table" => "sale_items",
                "reference_id"  => $this->saleItemModel->getInsertID()
            ]);

            $this->session->setFlashdata("msg_type", "success");
            $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Item Penjualan berhasil ditambahkan.");
            return redirect()->to(base_url('sale/' . $sale_id . '/manage'));
        }
    }

    public function sale_item_edit()
    {
        $sale_id = $this->request->getPost("sale_id");
        $sale_item_id = $this->request->getPost("sale_item_id");
        $quantity_old = $this->request->getPost("quantity_old");
        $quantity = $this->request->getPost("quantity");
        $discount = $this->request->getPost("discount");
        $product_id = $this->request->getPost("product_id");
        $product_variant_id = $this->request->getPost("product_variant_id");

        $thisItem = $this->saleItemModel->where('id', $sale_item_id)->first();
        $data_product = $this->productModel->where('id', $product_id)->first();

        if ($product_variant_id == null) {
            $newStock = 0;
            if ($quantity_old != $quantity) {
                $newStock = $quantity - $quantity_old;
            }
        } else {
            $data_product_variant = $this->productVariantModel->where('id', $product_variant_id)->where('product_id', $product_id)->first();
            $perhitungan_qty = $quantity * $data_product_variant->quantity_included;
            $quantity_old_variant = $quantity_old * $data_product_variant->quantity_included;

            $newStock = 0;
            if ($quantity_old != $quantity) {
                $newStock = $perhitungan_qty - $quantity_old_variant;
            }
        }

        if ($data_product->stocks - $newStock < 0) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Stok Produk Kurang !");
            return redirect()->to(base_url('sale/' . $sale_id . '/manage'));
        }

        $this->productModel->where("id", $product_id)->set([
            "stocks"        => ($data_product->stocks - $newStock)
        ])->update();

        $this->saleItemModel->where("id", $sale_item_id)->set([
            "quantity"                  => $quantity,
            "discount"                  => $discount,
        ])->update();

        $transactionNominal = $thisItem->price * $quantity - ($thisItem->price * $quantity * $discount / 100);

        $this->transactionModel
                ->where("reference_table","sale_items")
                ->where("reference_id",$sale_item_id)
                ->set([ "debit"=>$transactionNominal ])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Item Penjualan berhasil disimpan.");
        return redirect()->to(base_url('sale/' . $sale_id . '/manage'));
    }

    public function sale_item_delete($sale_id, $sale_items_id)
    {
        $data_sale_item = $this->saleItemModel->where('id', $sale_items_id)->first();

        if ($data_sale_item->product_variant_id == null) {
            $quantity = $data_sale_item->quantity;
        } else {
            $data_product_variant = $this->productVariantModel->where('id', $data_sale_item->product_variant_id)->where('product_id', $data_sale_item->product_id)->first();
            $quantity = $data_sale_item->quantity * $data_product_variant->quantity_included;
        }

        $data_product = $this->productModel->where('id', $data_sale_item->product_id)->first();

        $this->productModel->where("id", $data_product->id)->set([
            "stocks" => $data_product->stocks + $quantity,
        ])->update();

        $this->saleItemModel->delete($sale_items_id);

        $this->transactionModel
                ->where("reference_table","sale_items")
                ->where("reference_id",$sale_items_id)
                ->delete();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Item Penjualan berhasil dihapus.");
        return redirect()->to(base_url('sale/' . $sale_id . '/manage'));
    }

    public function sale_print($sale_id)
    {
        $sale = $this->saleModel->where("id", $sale_id)->where("admin_id", $this->session->admin_id)->first();

        if ($sale == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Data Penjualan tidak ditemukan.");
            return redirect()->to(base_url('sale'));
        }

        $items = $this->saleItemModel->where("sale_id", $sale_id)->findAll();
        $products = $this->productModel->orderBy("name", "asc")->findAll();

        $data = ([
            "db"    => $this->db,
            "sale"   => $sale,
            "items" => $items,
            "products" => $products,
        ]);

        return view("modules/sale_print", $data);
    }
}
