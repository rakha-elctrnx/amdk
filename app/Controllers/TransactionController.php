<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class TransactionController extends CoreController
{
    public function transaction(){
        $transactions = $this->transactionModel->orderBy("date","desc")->orderBy("id","desc")->findAll();

        $data = ([
            "db" => $this->db,
            "transactions" => $transactions,
        ]);

        return view("modules/transaction",$data);
    }
    public function transaction_add(){
        return view("modules/transaction_add");
    }
    public function transaction_add_process(){
        $type = $this->request->getPost("type");
        $details = $this->request->getPost("details");
        $date = $this->request->getPost("date");
        $nominal = $this->request->getPost("nominal");

        if($type == 1){
            $credit = NULL;
            $debit = $nominal;
        }else{
            $credit = $nominal;
            $debit = NULL;
        }

        $this->transactionModel->insert([
            "admin_id" => $this->session->admin_id,
            "details" => $details,
            "credit" => $credit,
            "debit" => $debit,
            "date" => $date
        ]);

        $this->session->setFlashdata("msg_type","success");
        $this->session->setFlashdata("msg","<b>Berhasil</b> <br> <b>".$details."</b> berhasil ditambahkan.");
        return redirect()->to(base_url('transaction'));
    }
    public function transaction_delete_process($id){
        $transaction = $this->transactionModel->where("id", $id)->first();

        $this->transactionModel->where("id",$id)->delete();

        $this->session->setFlashdata("msg_type","success");
        $this->session->setFlashdata("msg","<b>Berhasil</b> <br> <b>".$transaction->details."</b> berhasil dihapus.");
        return redirect()->to(base_url('transaction'));
    }
    public function transaction_edit($id){
        $transaction = $this->transactionModel->where("id", $id)->first();

        if($transaction == NULL){
            $this->session->setFlashdata("msg_type","error");
            $this->session->setFlashdata("msg","<b>Gagal</b> <br> Data transaksi arus kas tidak ditemukan.");
            return redirect()->to(base_url('transaction'));
        }

        $data = ([
            "transaction"=> $transaction
        ]);

        return view("modules/transaction_edit",$data);
    }
    public function transaction_edit_process(){
        $id = $this->request->getPost("id");
        $type = $this->request->getPost("type");
        $details = $this->request->getPost("details");
        $date = $this->request->getPost("date");
        $nominal = $this->request->getPost("nominal");

        if($type == 1){
            $credit = NULL;
            $debit = $nominal;
        }else{
            $credit = $nominal;
            $debit = NULL;
        }

        $this->transactionModel->where("id",$id)->set([
            "details" => $details,
            "credit" => $credit,
            "debit" => $debit,
            "date" => $date
        ])->update();

        $this->session->setFlashdata("msg_type","success");
        $this->session->setFlashdata("msg","<b>Berhasil</b> <b>".$details."</b> berhasil disimpan.");
        return redirect()->to(base_url('transaction/'.$id.'/edit'));
    }
}
