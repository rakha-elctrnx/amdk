<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Product extends Seeder
{
    public function run()
    {
        //
        $rows = [
            [
                "name"  => "Air Cup",
                "unit" => "Gelas",
                "price" => 1000,
                "stocks" => 250
            ],
            [
                "name"  => "Air Botol",
                "unit" => "Botol",
                "price" => 5000,
                "stocks" => 125
            ],
            [
                "name"  => "Air Galon",
                "unit" => "Galon",
                "price" => 15000,
                "stocks" => 100
            ],
        ];

        foreach($rows as $row){
            $this->db->table("products")->insert($row);
        }
    }
}
