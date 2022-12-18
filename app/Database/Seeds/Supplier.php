<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Supplier extends Seeder
{
    public function run()
    {
        //
        $rows = [
            [
                "name"  => "Pemasok Satu",
                "address"  => "Jl. Perjuangan No.01",
                "phone"      => "(0231) 2837213",
                "mobile"      => "0852 2131 2345",
                "email" => "pemasok@gmail.com"
            ],
            [
                "name"  => "Pemasok Dua",
                "address"  => "Jl. Perjuangan No.12",
                "phone"      => "(0231) 2837213",
                "mobile"      => "0852 2131 2345",
                "email" => "pemasok@gmail.com"
            ],
            [
                "name"  => "Pemasok Tiga",
                "address"  => "Jl. Perjuangan No.01",
                "phone"      => "(0231) 2837213",
                "mobile"      => "0852 2131 2345",
                "email" => "pemasok@gmail.com"
            ],
        ];

        foreach($rows as $row){
            $this->db->table("suppliers")->insert($row);
        }
    }
}
