<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CustomerController extends CoreController
{
    public function customer(){
        $customers = $this->customerModel->orderBy("name","asc")->findAll();

        $data = ([
            "customers" => $customers
        ]);

        return view("modules/customer",$data);
    }
    public function customer_add(){
        return view("modules/customer_add");
    }
    public function customer_add_process(){
        $name = $this->request->getPost("name");
        $mobile = $this->request->getPost("mobile");
        $address = $this->request->getPost("address");

        $this->customerModel->insert([
            "name" => $name,
            "mobile" => $mobile,
            "address" => $address
        ]);

        $this->session->setFlashdata("msg_type","success");
        $this->session->setFlashdata("msg","<b>Berhasil</b> <br> <b>".$name."</b> berhasil ditambahkan.");
        return redirect()->to(base_url('customer'));
    }
    public function customer_delete_process($id){
        $customer = $this->customerModel->where("id", $id)->first();

        $sales = $this->saleModel->where("customer_id",$id)->findAll();

        if($sales != NULL){
            $this->session->setFlashdata("msg_type","error");
            $this->session->setFlashdata("msg","<b>Gagal</b> <br> <b>".$customer->name."</b> gagal dihapus, karena data sudah pernah digunakan.");
            return redirect()->to(base_url('customer'));
        }

        $this->customerModel->where("id",$id)->delete();

        $this->session->setFlashdata("msg_type","success");
        $this->session->setFlashdata("msg","<b>Berhasil</b> <br> <b>".$customer->name."</b> berhasil dihapus.");
        return redirect()->to(base_url('customer'));
    }
    public function customer_edit($id){
        $customer = $this->customerModel->where("id", $id)->first();

        if($customer == NULL){
            $this->session->setFlashdata("msg_type","error");
            $this->session->setFlashdata("msg","<b>Gagal</b> <br> Data pelanggan tidak ditemukan.");
            return redirect()->to(base_url('customer'));
        }

        $data = ([
            "customer"=> $customer
        ]);

        return view("modules/customer_edit",$data);
    }
    public function customer_edit_process(){
        $id = $this->request->getPost("id");
        $name = $this->request->getPost("name");
        $mobile = $this->request->getPost("mobile");
        $address = $this->request->getPost("address");

        $this->customerModel->where("id",$id)->set([
            "name" => $name,
            "mobile" => $mobile,
            "address" => $address
        ])->update();

        $this->session->setFlashdata("msg_type","success");
        $this->session->setFlashdata("msg","<b>Berhasil</b> <br> <b>".$name."</b> berhasil disimpan.");
        return redirect()->to(base_url('customer/'.$id.'/edit'));
    }
}
