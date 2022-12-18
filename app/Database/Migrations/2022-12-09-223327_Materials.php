<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Materials extends Migration
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
            "type" => [
                "type" => "INT",
                "constraint" => 2,
                "default" => 1, // 1 = bahan produksi | 2 = bahan baku
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
        $this->forge->createTable("materials", TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable("buy_items", TRUE);
    }
}
