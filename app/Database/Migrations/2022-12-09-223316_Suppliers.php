<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Suppliers extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            "id" => [
                "type"      => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
                "auto_increment" => true
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => 255
            ],
            "address"   => [
                "type" => "LONGTEXT",
            ],
            "phone" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true,
            ],
            "mobile" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "email" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true
            ]
        ]);

        $this->forge->addKey("id",TRUE);
        
        $this->forge->createTable('suppliers', TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable('suppliers', TRUE);
    }
}
