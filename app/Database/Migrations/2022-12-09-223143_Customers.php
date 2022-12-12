<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customers extends Migration
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
                "null" => true
            ],
            "phone" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true
            ]
        ]);

        $this->forge->addKey("id",TRUE);
        
        $this->forge->createTable('customers', TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable('customers', TRUE);
    }
}
