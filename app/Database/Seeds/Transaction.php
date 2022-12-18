<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Transaction extends Seeder
{
    public function run()
    {
        //
        $rows = [
            [
                "admin_id"  => 1,
                "details"  => "Pembelian bahan",
                "date"      => date("Y-m-d"),
                "credit"    => 2000000, 
            ],
            [
                "admin_id"  => 1,
                "details"  => "Pembayaran listrik",
                "date"      => date("Y-m-d"),
                "credit"    => 250000,
            ],
            [
                "admin_id"  => 1,
                "details"  => "Penambahan modal",
                "date"      => date("Y-m-d"),
                "debit"    => 5000000,
            ],
            [
                "admin_id"  => 1,
                "details"  => "Pembayaran PDAM",
                "date"      => date("Y-m-d"),
                "credit"    => 150000,
            ],
        ];

        foreach($rows as $row){
            $this->db->table("transactions")->insert($row);
        }
    }
}
