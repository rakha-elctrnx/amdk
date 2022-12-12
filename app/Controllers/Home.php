<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $session;
    private $db;
    
    public function __construct(){
        $this->session = \Config\Services::session();
        $this->db      = \Config\Database::connect();
    }
    public function index()
    {
        if($this->session->admin_id == null){
            return view('login');
        }else{
            return redirect()->to(base_url('dashboard'));
        }
    }
}
