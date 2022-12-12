<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Administrator extends Seeder
{
    public function run()
    {
        //
        $rows = [
            [
                "username"  => "admin",
                "password"  => password_hash("12345", PASSWORD_BCRYPT),
                "name"      => "Administrator" 
            ]
        ];

        foreach($rows as $row){
            $this->db->table("administrators")->insert($row);
        }
    }
}
