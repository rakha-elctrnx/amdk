<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProductionController extends CoreController
{
    public function production()
    {
        $productions = $this->ProductionModel
            ->findAll();
        $data = [
            "db"    => $this->db,
            'productions' => $productions,
        ];
        return view('modules/production', $data);
    }

    public function production_add()
    {
        $products = $this->productModel->findAll();
        $data = [
            'products' => $products,
        ];
        return view('modules/production_add', $data);
    }

    public function production_add_process()
    {
        $product = $this->request->getPost('product');
        $targets = $this->request->getPost('targets');
        $production_date = $this->request->getPost('production_date');
        $estimation_date = $this->request->getPost('estimation_date');
        $notes = $this->request->getPost('notes');
        $productData = $this->productModel->where('id', $product)->first();
        $this->ProductionModel->insert([
            'product_id' => $product,
            'admin_id' => $this->session->admin_id,
            'snapshot_product_name' => $productData->name,
            'snapshot_product_unit' => $productData->unit,
            'snapshot_product_price' => $productData->price,
            'targets' => $targets,
            'production_date' => $production_date,
            'estimation_date' => $estimation_date,
            'notes' => $notes,
        ]);

        $newID = $this->ProductionModel->getInsertID();

        if ($newID < 10) {
            $textNewID = "00" . $newID;
        } elseif ($newID < 100) {
            $textNewID = "0" . $newID;
        } else {
            $textNewID = $newID;
        }

        $number = config("custom")->productionLetter . date("Ymd") . $textNewID;

        $this->ProductionModel->where("id", $newID)->set(["number" => $number])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Produksi berhasil dibuat.");
        return redirect()->to(base_url('production/' . $newID . '/manage'));
    }

    public function production_edit_process()
    {
        $production_id = $this->request->getPost('production_id');
        $product_id = $this->request->getPost('product_id');
        $product = $this->request->getPost('product');
        $targets = $this->request->getPost('targets');
        $achieveds = $this->request->getPost('achieveds');
        $faileds = $this->request->getPost('faileds');
        $production_date = $this->request->getPost('production_date');
        $estimation_date = $this->request->getPost('estimation_date');
        $finish_date = $this->request->getPost('finish_date');
        $notes = $this->request->getPost('notes');

        $thisProduction = $this->ProductionModel->where('id', $production_id)->first();

        if($thisProduction->finish_date != NULL){
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produksi yang sudah diselesaikan tidak dapat dimodifikasi.");
            return redirect()->to(base_url('production/' . $production_id . '/manage'));
        }

        if ($product_id == null) {
            $newID = $product;
        } else {
            $newID = $product_id;
        }

        $productData = $this->productModel->where('id', $newID)->first();

        $name = null;
        $unit = null;
        $price = null;

        if ($product == NULL) {
            $name = $thisProduction->snapshot_product_name;
            $unit = $thisProduction->snapshot_product_unit;
            $price = $thisProduction->snapshot_product_price;
        } else {
            $name = $productData->name;
            $unit = $productData->unit;
            $price = $productData->price;
        }        

        if ($finish_date == null) {
            $finish_date = null;
            $achieveds = NULL;
            $faileds = NULL;
        }

        $this->ProductionModel->where('id', $production_id)->set([
            'product_id' => $newID,
            'admin_id' => $this->session->admin_id,
            'snapshot_product_name' => $name,
            'snapshot_product_unit' => $unit,
            'snapshot_product_price' => $price,
            'targets' => $targets,
            'production_date' => $production_date,
            'estimation_date' => $estimation_date,
            "notes"=>$notes,
        ])->update();

        if($finish_date != NULL){
            if($achieveds == NULL || $faileds == NULL){
                $this->session->setFlashdata("msg_type", "error");
                $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Penyelesaian produksi gagal karena jumlah produk berhasil atau jumlah produk gagal belum di isi.");
                return redirect()->to(base_url('production/' . $production_id . '/manage'));
            }else{
                $this->ProductionModel->where('id', $production_id)->set([
                    'achieveds' => $achieveds,
                    'faileds' => $faileds,
                    'finish_date' => $finish_date,
                ])->update();
            }
        }

        if ($finish_date != NULL) {
            $newStock = $productData->stocks + $achieveds;

            $this->productModel->where('id', $newID)->set([
                'stocks' => $newStock,
            ])->update();
        }

        $totalBiaya = 0;
        
        $ingredients = $this->ingredientModel->where("production_id",$production_id)->findAll();
        $costs = $this->costModel->where("production_id",$production_id)->findAll();

        foreach($ingredients as $ingredient){
            $totalBiaya = $totalBiaya + ($ingredient->snapshot_material_price * $ingredient->quantity); 
        }
        foreach($costs as $cost){
            $totalBiaya += $cost->price;
        }

        $percentageFailed = $faileds / $targets * 100;

        if ($finish_date != NULL) {
            if($faileds > 0){
                $transactionDetails = "Kegagalan produksi ".$thisProduction->snapshot_product_name." (Ref : ".$thisProduction->number.")";
                $transactionNominal = $totalBiaya * $percentageFailed / 100;

                $this->transactionModel->insert([
                    "admin_id"  => $thisProduction->admin_id,
                    "details"   => $transactionDetails,
                    "date"      => $finish_date,
                    "credit"    => $transactionNominal,
                    "reference_table" => "productions",
                    "reference_id"  => $production_id,
                ]);
            }
        }

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Produksi berhasil diubah.");
        return redirect()->to(base_url('production/' . $production_id . '/manage'));
    }

    public function production_manage($production_id)
    {
        $productionData = $this->ProductionModel->where(['id' => $production_id])->first();
        $costs = $this->costModel->where(['production_id' => $production_id])->findAll();
        $materials = $this->materialModel->findAll();
        $products = $this->productModel->findAll();
        $ingredients = $this->ingredientModel
            ->where(['production_id' => $production_id])
            ->findAll();
        $data = [
            'production' => $productionData,
            'products' => $products,
            'costs' => $costs,
            'materials' => $materials,
            'session' => $this->session,
            'ingredients' => $ingredients,
            'db' => $this->db,
        ];
        return view('modules/production_manage', $data);
    }

    public function production_delete($produciton_id)
    {
        $producitonData = $this->ProductionModel->where('id', $produciton_id)->first();
        if ($producitonData == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produksi tidak ditemukan.");
            return redirect()->to(base_url('buy'));
        }

        $ingredientData = $this->ingredientModel->where('production_id', $produciton_id)->first();

        $costData = $this->costModel->where('production_id', $produciton_id)->first();

        $productData = $this->productModel->where('id', $producitonData->product_id)->first();

        if($producitonData->finish_date != NULL){
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produksi yang sudah diselesaikan tidak dapat dihapus.");
            return redirect()->to(base_url('production/' . $produciton_id . '/manage'));
        }

        if ($productData->stocks < $producitonData->achieveds) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produksi sudah digunakan.");
            return redirect()->to(base_url('production/' . $produciton_id . '/manage'));
        }

        if ($ingredientData != NULL  || $costData != NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produksi tidak dapat dihapus <br> karena data tidak kosong.");
            return redirect()->to(base_url('production/' . $produciton_id . '/manage'));
        }

        $this->productModel->where('id', $producitonData->product_id)->set([
            'stocks' => $productData->stocks - $producitonData->achieveds,
        ])->update();

        $this->ProductionModel->where("id", $produciton_id)->delete();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Produksi berhasil dihapus.");
        return redirect()->to(base_url('production'));
    }

    public function ingredient_add_process()
    {
        $production_id = $this->request->getPost('production_id');
        $material = $this->request->getPost('material');
        $quantity = $this->request->getPost('quantity');

        $thisProduction = $this->ProductionModel->where('id', $production_id)->first();

        if($thisProduction->finish_date != NULL){
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produksi yang sudah diselesaikan tidak dapat dimodifikasi.");
            return redirect()->to(base_url('production/' . $production_id . '/manage'));
        }

        $thisMaterial = $this->materialModel->where("id", $material)->first();

        if ($thisMaterial == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Bahan tidak ditemukan.");
            return redirect()->to(base_url('production/' . $production_id . '/manage'));
        }

        $this->ingredientModel->insert([
            'production_id' => $production_id,
            'material_id' => $material,
            'snapshot_material_name' => $thisMaterial->name,
            'snapshot_material_unit' => $thisMaterial->unit,
            'snapshot_material_price' => $thisMaterial->price,
            'quantity' => $quantity,
        ]);

        $this->materialModel->where("id", $material)->set([
            'stocks' => $thisMaterial->stocks - $quantity,
        ])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Bahan Produksi berhasil dibuat.");
        return redirect()->to(base_url('production/' . $production_id . '/manage'));
    }

    public function ingredient_edit_process()
    {
        $production_id = $this->request->getPost('production_id');
        $ingredient_id = $this->request->getPost('ingredient_id');
        $material_id = $this->request->getPost('material_id');
        $quantity = $this->request->getPost('quantity');

        $thisProduction = $this->ProductionModel->where('id', $production_id)->first();

        if($thisProduction->finish_date != NULL){
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produksi yang sudah diselesaikan tidak dapat dimodifikasi.");
            return redirect()->to(base_url('production/' . $production_id . '/manage'));
        }

        $thisIngredient = $this->ingredientModel->where('id', $ingredient_id)->first();
        $thisMaterial = $this->materialModel->where('id', $material_id)->first();

        $newStock = $thisMaterial->stocks + ($thisIngredient->quantity - $quantity);

        if ($newStock < 0) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Stok Material Kurang !");
            return redirect()->to(base_url('production/' . $production_id . '/manage'));
        }

        $this->ingredientModel->where('id', $ingredient_id)->set([
            'quantity' => $quantity,
        ])->update();

        $thisMaterial = $this->materialModel->where('id', $material_id)->set([
            'stocks' => $newStock,
        ])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Bahan Produksi berhasil diubah.");
        return redirect()->to(base_url('production/' . $production_id . '/manage'));
    }

    public function ingredient_delete($production_id, $ingredient_id)
    {
        $thisProduction = $this->ProductionModel->where('id', $production_id)->first();

        if($thisProduction->finish_date != NULL){
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produksi yang sudah diselesaikan tidak dapat dimodifikasi.");
            return redirect()->to(base_url('production/' . $production_id . '/manage'));
        }
        $thisProduction = $this->ProductionModel->where('id', $production_id)->first();
        $thisIngredient = $this->ingredientModel->where('id', $ingredient_id)->first();
        if (!$thisIngredient || !$thisProduction) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Data tidak ditemukan.");
            return redirect()->to(base_url('production/' . $production_id . '/manage'));
        }

        $thisMaterial = $this->materialModel->where('id', $thisIngredient->material_id)->first();
        $this->materialModel->where('id', $thisIngredient->material_id)->set([
            'stocks' => $thisMaterial->stocks + $thisIngredient->quantity,
        ])->update();

        $this->ingredientModel->where('id', $ingredient_id)->delete();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Bahan Produksi berhasil dihapus.");
        return redirect()->to(base_url('production/' . $production_id . '/manage'));
    }

    public function cost_add_process()
    {
        $production_id = $this->request->getPost('production_id');
        $price = $this->request->getPost('price');
        $date = $this->request->getPost('date');
        $details = $this->request->getPost('details');

        $thisProduction = $this->ProductionModel->where('id', $production_id)->first();

        if($thisProduction->finish_date != NULL){
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produksi yang sudah diselesaikan tidak dapat dimodifikasi.");
            $this->session->setFlashdata("active", "biaya");
            return redirect()->to(base_url('production/' . $production_id . '/manage'));
        }

        $this->costModel->insert([
            'production_id' => $production_id,
            'price' => $price,
            'date' => $date,
            'details' => $details,
        ]);

        $transactionDetails = $details." (Ref : ".$thisProduction->number.")";
        $transactionNominal = $price;

        $this->transactionModel->insert([
            "admin_id"  => $thisProduction->admin_id,
            "details"   => $transactionDetails,
            "date"      => $date,
            "credit"    => $transactionNominal,
            "reference_table" => "costs",
            "reference_id"  => $this->costModel->getInsertID()
        ]);

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Biaya Produksi berhasil ditambahkan.");
        $this->session->setFlashdata("active", "biaya");
        return redirect()->to(base_url('production/' . $production_id . '/manage'));
    }

    public function cost_edit_process()
    {
        $cost_id = $this->request->getPost('cost_id');
        $production_id = $this->request->getPost('production_id');
        $price = $this->request->getPost('price');
        $date = $this->request->getPost('date');
        $details = $this->request->getPost('details');

        $thisProduction = $this->ProductionModel->where('id', $production_id)->first();

        if($thisProduction->finish_date != NULL){
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produksi yang sudah diselesaikan tidak dapat dimodifikasi.");
            $this->session->setFlashdata("active", "biaya");
            return redirect()->to(base_url('production/' . $production_id . '/manage'));
        }

        $this->costModel->where('id', $cost_id)->set([
            'production_id' => $production_id,
            'price' => $price,
            'date' => $date,
            'details' => $details,
        ])->update();

        $this->transactionModel
                ->where("reference_table","costs")
                ->where("reference_id",$cost_id)
                ->set([ "credit"=>$price ])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Biaya Produksi berhasil diubah.");
        $this->session->setFlashdata("active", "biaya");
        return redirect()->to(base_url('production/' . $production_id . '/manage'));
    }

    public function cost_delete($production_id, $cost_id)
    {
        $thisProduction = $this->ProductionModel->where('id', $production_id)->first();

        if($thisProduction->finish_date != NULL){
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produksi yang sudah diselesaikan tidak dapat dimodifikasi.");
            $this->session->setFlashdata("active", "biaya");
            return redirect()->to(base_url('production/' . $production_id . '/manage'));
        }
        $thisCost = $this->costModel->where('id', $cost_id)->first();

        if ($thisCost == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Biaya tidak ditemukan.");
            $this->session->setFlashdata("active", "biaya");
            return redirect()->to(base_url('production/' . $production_id . '/manage'));
        }

        $this->costModel->where('id', $cost_id)->delete();

        $this->transactionModel
                ->where("reference_table","costs")
                ->where("reference_id",$cost_id)
                ->delete();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Biaya Produksi berhasil dihapus.");
        $this->session->setFlashdata("active", "biaya");
        return redirect()->to(base_url('production/' . $production_id . '/manage'));
    }
}
