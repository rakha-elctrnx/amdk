<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Session\Handlers\FileHandler;

class Login extends BaseConfig
{
    public $adminUsername;
    public $adminName;

    private $session;
    private $db;
    private $adminModel;
    
    public function __construct(){
        $this->session = \Config\Services::session();
        $this->db      = \Config\Database::connect();
        $this->adminModel = new \App\Models\AdministratorModel();

        if($this->session->admin_id != null){
            $admin = $this->adminModel->where('id', $this->session->admin_id)->first();

            $this->adminUsername = $admin->username;
            $this->adminName = $admin->name;
        }
    }
}
?>