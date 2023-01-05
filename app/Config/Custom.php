<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Session\Handlers\FileHandler;

class Custom extends BaseConfig
{
    public $appName = "AMDK";
    public $yearMade = 2022;

    public $months = ([
        "",
        "Januari","Februari","Maret","April","Mei","Juni",
        "Juli","Agustus","September","Oktober","November","Desember",
    ]);

    public $materialTypes = (["","Bahan Baku","Bahan Produksi"]);

    // Letter for number of transactions
    public $buyLetter = "B";
    public $saleLetter = "J";
    public $productionLetter = "P";

    // Company Identity
    public $companyName = "SMTQua";
    public $companyAddress = "Jl. Cirebon No. 1";
    public $companyAreaLetter = "Cirebon";
    public $companyMail = "smtqua@gmail.com";
    public $companyPhone = "(022) 81283";
    public $companyMobile = "0821 2111 2123";
}
?>