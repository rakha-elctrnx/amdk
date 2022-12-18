<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SupplierController extends CoreController
{
    public function supplier(){
        $suppliers = $this->supplierModel->orderBy("name","asc")->findAll();

        $data = ([
            "suppliers" => $suppliers
        ]);

        return view("modules/supplier",$data);
    }
    public function supplier_add(){
        return view("modules/supplier_add");
    }
    public function supplier_add_process(){
        $name = $this->request->getPost("name");
        $phone = $this->request->getPost("phone");
        $mobile = $this->request->getPost("mobile");
        $email = $this->request->getPost("email");
        $address = $this->request->getPost("address");

        $this->supplierModel->insert([
            "name" => $name,
            "phone" => $phone,
            "mobile" => $mobile,
            "email" => $email,
            "address" => $address
        ]);

        $this->session->setFlashdata("msg_type","success");
        $this->session->setFlashdata("msg","<b>Berhasil</b> <br> <b>".$name."</b> berhasil ditambahkan.");
        return redirect()->to(base_url('supplier'));
    }
    public function supplier_delete_process($id){
        $supplier = $this->supplierModel->where("id", $id)->first();

        $buys = $this->buyModel->where("supplier_id",$id)->findAll();

        if($buys != NULL){
            $this->session->setFlashdata("msg_type","error");
            $this->session->setFlashdata("msg","<b>Gagal</b> <br> <b>".$supplier->name."</b> gagal dihapus, karena data sudah pernah digunakan.");
            return redirect()->to(base_url('supplier'));
        }

        $this->supplierModel->where("id",$id)->delete();

        $this->session->setFlashdata("msg_type","success");
        $this->session->setFlashdata("msg","<b>Berhasil</b> <br> <b>".$supplier->name."</b> berhasil dihapus.");
        return redirect()->to(base_url('supplier'));
    }
    public function supplier_edit($id){
        $supplier = $this->supplierModel->where("id", $id)->first();

        if($supplier == NULL){
            $this->session->setFlashdata("msg_type","error");
            $this->session->setFlashdata("msg","<b>Gagal</b> <br> Data pemasok tidak ditemukan.");
            return redirect()->to(base_url('supplier'));
        }

        $data = ([
            "supplier"=> $supplier
        ]);

        return view("modules/supplier_edit",$data);
    }
    public function supplier_edit_process(){
        $id = $this->request->getPost("id");
        $name = $this->request->getPost("name");
        $phone = $this->request->getPost("phone");
        $mobile = $this->request->getPost("mobile");
        $email = $this->request->getPost("email");
        $address = $this->request->getPost("address");

        $this->supplierModel->where("id",$id)->set([
            "name" => $name,
            "phone" => $phone,
            "mobile" => $mobile,
            "email" => $email,
            "address" => $address
        ])->update();

        $this->session->setFlashdata("msg_type","success");
        $this->session->setFlashdata("msg","<b>Berhasil</b> <br> <b>".$name."</b> berhasil disimpan.");
        return redirect()->to(base_url('supplier/'.$id.'/edit'));
    }
}
