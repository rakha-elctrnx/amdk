<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CoreController extends BaseController
{
    protected $session;
    protected $db;
    protected $adminModel;
    
    public function __construct(){
        $this->session = \Config\Services::session();
        $this->db      = \Config\Database::connect();
        $this->adminModel = new \App\Models\AdministratorModel();

        if ($this->session->admin_id == null) {
            $this->session->setFlashdata('msg', 'Login terlebih dahulu!');
            header("location:" . base_url('/'));
            exit();
        }
    }
}
