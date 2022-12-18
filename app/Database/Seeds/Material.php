<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Material extends Seeder
{
    public function run()
    {
        //
        $rows = [
            [
                "type"  => 1,
                "name"  => "Air Gunung",
                "unit" => "Galon",
                "price" => 50000,
                "stocks" => 25
            ],
            [
                "type"  => 2,
                "name"  => "Plastik Tutup Gelas",
                "unit" => "Roll",
                "price" => 5000,
                "stocks" => 15
            ],
            [
                "type"  => 2,
                "name"  => "Gelas Plastik",
                "unit" => "Pcs",
                "price" => 250,
                "stocks" => 500
            ],
        ];

        foreach($rows as $row){
            $this->db->table("materials")->insert($row);
        }
    }
}
