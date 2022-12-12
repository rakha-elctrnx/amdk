<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AppController extends BaseController
{
    private $adminModel;

    public function __construct(){
        $this->adminModel = new App\Models\AdministratorModel();
    }    
    public function login(){
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $user = $this->userModel
            ->where("username", $username)
            ->first();

        if ($user) {
            if (password_verify($password, $user->password)) {
                $session_data = [
                    "user_id"           => $user->id,
                    "name"           => $user->name,
                    "username"           => $user->username,
                ];
                session()->set($session_data);

                if ($user->role == 1) {
                    return redirect()->to(base_url('app-admin/home'));
                } else {
                    return redirect()->to(base_url('app-cashier/home'));
                }
            } else {
                $this->session->setFlashdata('msg', "<strong>Maaf, login gagal.</strong> <br> Periksa kembali data login anda.!");
                return redirect()->to(base_url('/'));
            }
        } else {
            $this->session->setFlashdata('msg', "<strong>Maaf, login gagal.</strong> <br> Periksa kembali data login anda !");
            return redirect()->to(base_url('/'));
        }
    }
}
