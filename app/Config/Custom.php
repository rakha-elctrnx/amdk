<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Session\Handlers\FileHandler;

class Custom extends BaseConfig
{
    public $appName = "AMDK";
    public $yearMade = 2022;

    // Company Identity
    public $companyName = "SMTQua";
    public $companyAddress = "Jl. Cirebon No. 1";
    public $companyMail = "smmtqua@gmail.com";
    public $companyPhone = "(022) 81283";
    public $companyMobile = "0821 2111 2123";
}
?>