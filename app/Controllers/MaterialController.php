<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MaterialController extends CoreController
{
    public function material(){
        $materials = $this->materialModel->orderBy("name","asc")->findAll();

        $data = ([
            "materials" => $materials
        ]);

        return view("modules/material",$data);
    }
    public function material_add(){
        return view("modules/material_add");
    }
    public function material_add_process(){
        $type = $this->request->getPost("type");
        $name = $this->request->getPost("name");
        $unit = $this->request->getPost("unit");
        $price = $this->request->getPost("price");
        $stocks = $this->request->getPost("stocks");        

        $this->materialModel->insert([
            "type" => $type,
            "name" => $name,
            "unit" => $unit,
            "price" => $price,
            "stocks" => $stocks,
        ]);

        $this->session->setFlashdata("msg_type","success");
        $this->session->setFlashdata("msg","<b>Berhasil</b> <br> <b>".$name."</b> berhasil ditambahkan.");
        return redirect()->to(base_url('material'));
    }
    public function material_delete_process($id){
        $material = $this->materialModel->where("id", $id)->first();

        $buy_items = $this->buyItemModel->where("material_id",$id)->findAll();
        $ingredients = $this->ingredientModel->where("material_id",$id)->findAll();
        $stocks = $this->stockModel->where("reference_table","materials")->where("reference_id",$id)->findAll();

        if($buy_items != NULL || $ingredients != NULL || $stocks != NULL){
            $this->session->setFlashdata("msg_type","error");
            $this->session->setFlashdata("msg","<b>Gagal</b> <br> <b>".$material->name."</b> gagal dihapus, karena data sudah pernah digunakan.");
            return redirect()->to(base_url('material'));
        }

        $this->materialModel->where("id",$id)->delete();

        $this->session->setFlashdata("msg_type","success");
        $this->session->setFlashdata("msg","<b>Berhasil</b> <br> <b>".$material->name."</b> berhasil dihapus.");
        return redirect()->to(base_url('material'));
    }
    public function material_edit($id){
        $material = $this->materialModel->where("id", $id)->first();

        if($material == NULL){
            $this->session->setFlashdata("msg_type","error");
            $this->session->setFlashdata("msg","<b>Gagal</b> <br> Data bahan (baku/produksi) tidak ditemukan.");
            return redirect()->to(base_url('material'));
        }

        $data = ([
            "material"=> $material
        ]);

        return view("modules/material_edit",$data);
    }
    public function material_edit_process(){
        $id = $this->request->getPost("id");
        $type = $this->request->getPost("type");
        $name = $this->request->getPost("name");
        $unit = $this->request->getPost("unit");
        $price = $this->request->getPost("price");

        $this->materialModel->where("id",$id)->set([
            "type" => $type,
            "name" => $name,
            "unit" => $unit,
            "price" => $price,
        ])->update();

        $this->session->setFlashdata("msg_type","success");
        $this->session->setFlashdata("msg","<b>Berhasil</b> <br> <b>".$name."</b> berhasil disimpan.");
        return redirect()->to(base_url('material/'.$id.'/edit'));
    }
}
