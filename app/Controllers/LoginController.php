<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LoginController extends BaseController
{
    private $session;
    private $db;
    private $adminModel;
    
    public function __construct(){
        $this->session = \Config\Services::session();
        $this->db      = \Config\Database::connect();
        $this->adminModel = new \App\Models\AdministratorModel();
    }
    public function login(){
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $admin = $this->adminModel
            ->where("username", $username)
            ->first();

        if ($admin) {
            if (password_verify($password, $admin->password)) {
                $session_data = [
                    "admin_id"           => $admin->id,
                    "name"           => $admin->name,
                    "username"           => $admin->username,
                ];
                session()->set($session_data);

                return redirect()->to(base_url('dashboard'));
            } else {
                $this->session->setFlashdata("msg", "<strong>Maaf, login gagal.</strong> <br> Periksa kembali data login anda.!");
                return redirect()->to(base_url());
            }
        } else {
            $this->session->setFlashdata("msg", "<strong>Maaf, login gagal.</strong> <br> Periksa kembali data login anda !");
            return redirect()->to(base_url());
        }
    }
}
