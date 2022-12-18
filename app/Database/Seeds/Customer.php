<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Customer extends Seeder
{
    public function run()
    {
        //
        $rows = [
            [
                "name"  => "Pelanggan Satu",
                "address"  => "Jl. Perjuangan No.01",
                "mobile"      => "0852 2131 2345",
            ],
            [
                "name"  => "Pelanggan Dua",
                "address"  => "Jl. Perjuangan No.12",
                "mobile"      => "0852 2131 2345",
            ],
            [
                "name"  => "Pelanggan Tiga",
                "address"  => "Jl. Perjuangan No.01",
                "mobile"      => "0852 2131 2345",
            ],
        ];

        foreach($rows as $row){
            $this->db->table("customers")->insert($row);
        }
    }
}
