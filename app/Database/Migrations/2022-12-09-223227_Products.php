<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            "id" => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
                "auto_increment" => true
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => 255
            ],
            "unit" => [
                "type" => "VARCHAR",
                "constraint" => 255
            ],
            "price" => [
                "type" => "DOUBLE"
            ],            
            "stocks" => [
                "type" => "DOUBLE"
            ]
        ]);

        $this->forge->addKey("id", TRUE);
        $this->forge->createTable("products", TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable("id", TRUE);
    }
}
