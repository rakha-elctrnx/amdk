<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UserController extends CoreController
{
    public function user()
    {
        $administrators = $this->adminModel->orderBy("name", "asc")->findAll();

        $data = ([
            "administrators" => $administrators,
            "db" => $this->db
        ]);

        return view("modules/user", $data);
    }

    public function user_add()
    {
        return view("modules/user_add");
    }

    public function user_add_process()
    {
        if (!$this->validate([
            'name'          => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Masukkan nama terlebih dahulu',
                ],
            ],
            'username'          => [
                'rules' => 'required|is_unique[administrators.username]',
                'errors' => [
                    'required' => 'Masukkan username terlebih dahulu',
                    'is_unique' => 'username sudah teregistrasi !',
                ],
            ],
            'password'      => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => 'Masukkan password terlebih dahulu',
                    'min_length' => 'password terlalu pendek !',
                ],
            ],
            'confirm_password'      => [
                'confpassword'  => 'matches[password]',
                'errors' => [
                    'matches' => 'konfirmasi password salah !'
                ],
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/user/add')->withInput()->with('validation', $validation);
        }

        $name = $this->request->getPost("name");
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $dataInsert = ([
            "name"                      => $name,
            "username"                  => $username,
            "password"                  => password_hash($password, PASSWORD_BCRYPT),
        ]);

        $this->adminModel->insert($dataInsert);

        $this->session->setFlashdata("msg_type", "success");
        $this->session->setFlashdata("msg", "<b>Berhasil</b> <br> Akun Pengguna : <b>" . $name . "</b> berhasil ditambahkan.");
        return redirect()->to(base_url('user'));
    }
}
