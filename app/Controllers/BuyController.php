<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class BuyController extends CoreController
{
    public function buy()
    {
        $buys = $this->buyModel
            ->where("admin_id", $this->session->admin_id)
            ->orderBy("date", "desc")
            ->orderBy("id", "desc")
            ->findAll();

        $data = ([
            "db" => $this->db,
            "buys" => $buys
        ]);

        return view("modules/buy", $data);
    }
    public function buy_add()
    {
        $suppliers = $this->supplierModel->orderBy("name", "asc")->findAll();

        $data = ([
            "suppliers" => $suppliers
        ]);

        return view("modules/buy_add", $data);
    }
    public function buy_add_process()
    {
        $supplier = $this->request->getPost("supplier");
        $invoice = $this->request->getPost("invoice");
        $date = $this->request->getPost("date");
        $notes = $this->request->getPost("notes");

        $this->buyModel->insert([
            "number" => "-",
            "admin_id"          => $this->session->admin_id,
            "supplier_id"       => $supplier,
            "invoice_reference" => $invoice,
            "date"              => $date,
            "notes"             => $notes,
        ]);

        $newID = $this->buyModel->getInsertID();

        if ($newID < 10) {
            $textNewID = "00" . $newID;
        } elseif ($newID < 100) {
            $textNewID = "0" . $newID;
        } else {
            $textNewID = $newID;
        }

        $number = config("custom")->buyLetter . date("Ymd") . $textNewID;

        $this->buyModel->where("id", $newID)->set(["number" => $number])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Pembelian berhasil dibuat.");
        return redirect()->to(base_url('buy/' . $newID . '/manage'));
    }
    public function buy_manage($id)
    {
        $buy = $this->buyModel->where("id", $id)->first();

        if ($buy == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Data pembelian tidak ditemukan.");
            return redirect()->to(base_url('buy'));
        }

        $items = $this->buyItemModel->where("buy_id", $id)->findAll();
        $suppliers = $this->supplierModel->orderBy("name", "asc")->findAll();
        $materials = $this->materialModel->orderBy("name", "asc")->findAll();

        $data = ([
            "db"    => $this->db,
            "buy"   => $buy,
            "items" => $items,
            "suppliers" => $suppliers,
            "materials" => $materials,
        ]);

        return view("modules/buy_manage", $data);
    }
    public function buy_edit_process()
    {
        $id = $this->request->getPost("id");
        $supplier = $this->request->getPost("supplier");
        $invoice = $this->request->getPost("invoice");
        $date = $this->request->getPost("date");
        $notes = $this->request->getPost("notes");

        $this->buyModel->where("id", $id)->set([
            "supplier_id"       => $supplier,
            "invoice_reference" => $invoice,
            "date"              => $date,
            "notes"             => $notes,
        ])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Data pembelian berhasil disimpan.");
        return redirect()->to(base_url('buy/' . $id . '/manage'));
    }

    public function buy_delete($Buyid)
    {
        $BuyData = $this->buyModel->where('id', $Buyid)->first();
        if ($BuyData == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Pembelian tidak ditemukan.");
            return redirect()->to(base_url('buy'));
        }

        $BuyItemData = $this->buyItemModel->where('buy_id', $Buyid)->first();

        if ($BuyItemData) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Pembelian yang memiliki item tidak dapat dihapus.");
            return redirect()->to(base_url('buy/' . $Buyid . '/manage'));
        }

        $this->buyModel->where("id", $Buyid)->delete();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Pembelian berhasil dihapus.");
        return redirect()->to(base_url('buy'));
    }

    public function buy_print($buyId)
    {
        $buy = $this->buyModel->where("id", $buyId)->where("admin_id", $this->session->admin_id)->first();

        if ($buy == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Data pembelian tidak ditemukan.");
            return redirect()->to(base_url('buy'));
        }

        $buy = $this->buyModel
            ->join('suppliers', 'buys.supplier_id = suppliers.id')
            ->where("buys.id", $buyId)
            ->first();
        $items = $this->buyItemModel->where('buy_id', $buyId)->findAll();

        $data = ([
            "db"    => $this->db,
            "buy"   => $buy,
            "items" => $items,
        ]);

        return view("modules/buy_print", $data);
    }

    public function buy_item_add()
    {
        $buy = $this->request->getPost("buy");
        $material = $this->request->getPost("material");
        $price = $this->request->getPost("price");
        $quantity = $this->request->getPost("quantity");
        $discount = $this->request->getPost("discount");

        $thisMaterial = $this->materialModel->where("id", $material)->first();

        if ($thisMaterial == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Bahan tidak ditemukan.");
            return redirect()->to(base_url('buy/' . $buy . '/manage'));
        }

        // if($thisMaterial->stocks < $quantity){
        //     $this->session->setFlashdata("msg_type","error");
        //     $this->session->setFlashdata("msg","<b>Gagal</b> <br> Persediaan bahan tidak cukup.");
        //     return redirect()->to(base_url('buy/'.$buy.'/manage'));
        // }

        $exist = $this->buyItemModel->where("buy_id", $buy)->where("material_id", $material)->findAll();

        if ($exist != NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Bahan sudah ditambahkan.");
            return redirect()->to(base_url('buy/' . $buy . '/manage'));
        }

        $this->buyItemModel->insert([
            "buy_id"                    => $buy,
            "material_id"               => $material,
            "snapshot_material_name"    => $thisMaterial->name,
            "snapshot_material_unit"    => $thisMaterial->unit,
            "quantity"                  => $quantity,
            "price"                     => $price,
            "discount"                  => $discount,
        ]);

        $this->materialModel->where("id", $material)->set([
            "stocks"        => ($thisMaterial->stocks + $quantity)
        ])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Item pembelian berhasil ditambahkan.");
        return redirect()->to(base_url('buy/' . $buy . '/manage'));
    }
    public function buy_item_edit()
    {
        $buy = $this->request->getPost("buy");
        $buyItemId = $this->request->getPost("id");
        $material = $this->request->getPost("material");
        $price = $this->request->getPost("price");
        $quantity = $this->request->getPost("quantity");
        $discount = $this->request->getPost("discount");

        $thisItem = $this->buyItemModel->where("id", $buyItemId)->first();
        $thisMaterial = $this->materialModel->where("id", $material)->first();

        if ($thisMaterial == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Bahan tidak ditemukan.");
            return redirect()->to(base_url('buy/' . $buy . '/manage'));
        }

        if($quantity < $thisItem->quantity){
            $diffQuantity = $thisItem->quantity - $quantity;

            if(($thisMaterial->stocks - $diffQuantity) <= 0){
                $this->session->setFlashdata("msg_type", "error");
                $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Item tidak dapat diubah <br> karena sangat mempengaruhi persediaan.");
                return redirect()->to(base_url('buy/' . $buy . '/manage'));
            }
        }
        
        if($quantity < $thisItem->quantity){
            $materialStocks = $thisMaterial->stocks - ($thisItem->quantity - $quantity);
        }elseif($quantity > $thisItem->quantity){
            $materialStocks = $thisMaterial->stocks + ($quantity - $thisItem->quantity);
        }elseif($quantity == $thisItem->quantity){
            $materialStocks = $thisMaterial->stocks;
        }

        $this->buyItemModel->where("id", $buyItemId)->set([
            "quantity"                  => $quantity,
            "price"                     => $price,
            "discount"                  => $discount,
        ])->update();        

        $this->materialModel->where("id", $material)->set([
            "stocks"        => $materialStocks
        ])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Item pembelian berhasil diubah.");
        return redirect()->to(base_url('buy/' . $buy . '/manage'));
    }

    public function buy_item_delete($buyId, $itemId)
    {
        $thisItem = $this->buyItemModel->where("id", $itemId)->first();        

        if ($thisItem == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Item tidak ditemukan.");
            return redirect()->to(base_url('buy/' . $buyId . '/manage'));
        }

        $thisMaterial = $this->materialModel->where("id", $thisItem->material_id)->first();

        if ($thisMaterial == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Bahan tidak ditemukan.");
            return redirect()->to(base_url('buy/' . $buyId . '/manage'));
        }

        $materialStocks = $thisMaterial->stocks - $thisItem->quantity;

        if ($materialStocks <= 0) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Item tidak dapat dihapus <br> karena sangat mempengaruhi persediaan.");
            return redirect()->to(base_url('buy/' . $buyId . '/manage'));
        }

        $this->buyItemModel->where("id", $itemId)->delete();

        $this->materialModel->where("id", $thisItem->material_id)->set([
            "stocks"        => $materialStocks
        ])->update();        

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Item pembelian berhasil dihapus.");
        return redirect()->to(base_url('buy/' . $buyId . '/manage'));
    }
}
