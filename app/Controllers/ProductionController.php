<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProductionController extends CoreController
{
    public function production()
    {
        $productions = $this->ProductionModel
            ->join('products', 'productions.product_id = products.id')
            ->where('productions.admin_id', $this->session->admin_id)
            ->findAll();
        $data = [
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
        $achieveds = $this->request->getPost('achieveds');
        $faileds = $this->request->getPost('faileds');
        $production_date = $this->request->getPost('production_date');
        $estimation_date = $this->request->getPost('estimation_date');
        $finish_date = $this->request->getPost('finish_date');
        $productData = $this->productModel->where('id', $product)->first();
        $this->ProductionModel->insert([
            'product_id' => $product,
            'admin_id' => $this->session->admin_id,
            'snapshot_product_name' => $productData->name,
            'snapshot_product_unit' => $productData->unit,
            'snapshot_product_price' => $productData->price,
            'targets' => $targets,
            'achieveds' => $achieveds,
            'faileds' => $faileds,
            'production_date' => $production_date,
            'estimation_date' => $estimation_date,
            'finish_date' => null,
        ]);

        if ($finish_date != NULL && $achieveds != NULL) {
            $this->productModel->where('id', $product)->set([
                'stocks' => $productData->stocks + $achieveds,
            ])->update();
        }

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

        $thisProduction = $this->ProductionModel->where('id', $production_id)->first();

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

        if ($thisProduction->finish_date == null) {
            $newStock = $productData->stocks + $achieveds;
        } else {
            $newStock = $productData->stocks - ($thisProduction->achieveds - $achieveds);
        }

        if ($finish_date == null) {
            $finish_date = null;
        }

        if ($newStock <= 0) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produk Sudah Digunakan!");
            return redirect()->to(base_url('production/' . $production_id . '/manage'));
        }

        if ($finish_date != NULL && $achieveds != NULL) {
            $this->productModel->where('id', $newID)->set([
                'stocks' => $newStock,
            ])->update();
        }

        $this->ProductionModel->where('id', $production_id)->set([
            'product_id' => $newID,
            'admin_id' => $this->session->admin_id,
            'snapshot_product_name' => $name,
            'snapshot_product_unit' => $unit,
            'snapshot_product_price' => $price,
            'targets' => $targets,
            'achieveds' => $achieveds,
            'faileds' => $faileds,
            'production_date' => $production_date,
            'estimation_date' => $estimation_date,
            'finish_date' => $finish_date,
        ])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Produksi berhasil diubah.");
        return redirect()->to(base_url('production/' . $production_id . '/manage'));
    }

    public function production_manage($production_id)
    {
        $productionData = $this->ProductionModel->where(['admin_id' => $this->session->admin_id, 'id' => $production_id])->first();
        $cost = $this->costModel->where(['production_id' => $production_id])->first();
        $materials = $this->materialModel->findAll();
        $products = $this->productModel->findAll();
        $ingredients = $this->ingredientModel
            ->where(['production_id' => $production_id])
            ->findAll();
        $data = [
            'production' => $productionData,
            'products' => $products,
            'cost' => $cost,
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

        if ($productData->stocks < $producitonData->achieveds) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produksi sudah digunakan.");
            return redirect()->to(base_url('production/' . $produciton_id . '/manage'));
        }

        if ($ingredientData) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produksi tidak dapat dihapus <br> karena bahan sudah ditambahkan.");
            return redirect()->to(base_url('production/' . $produciton_id . '/manage'));
        }
        if ($costData) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Produksi tidak dapat dihapus <br> karena biaya sudah ditambahkan.");
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

        $this->costModel->insert([
            'production_id' => $production_id,
            'price' => $price,
            'date' => $date,
            'details' => $details,
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

        $this->costModel->where('id', $cost_id)->set([
            'production_id' => $production_id,
            'price' => $price,
            'date' => $date,
            'details' => $details,
        ])->update();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Biaya Produksi berhasil diubah.");
        $this->session->setFlashdata("active", "biaya");
        return redirect()->to(base_url('production/' . $production_id . '/manage'));
    }

    public function cost_delete($production_id, $cost_id)
    {
        $thisCost = $this->costModel->where('id', $cost_id)->first();

        if ($thisCost == NULL) {
            $this->session->setFlashdata("msg_type", "error");
            $this->session->setFlashdata("msg", "<b>Gagal</b> <br> Biaya tidak ditemukan.");
            return redirect()->to(base_url('production/' . $production_id . '/manage'));
        }

        $this->costModel->where('id', $cost_id)->delete();

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Biaya Produksi berhasil dihapus.");
        $this->session->setFlashdata("active", "biaya");
        return redirect()->to(base_url('production/' . $production_id . '/manage'));
    }
}
