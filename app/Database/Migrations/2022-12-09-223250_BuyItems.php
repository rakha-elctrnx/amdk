<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuyItems extends Migration
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
            "buy_id"  => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
            ],
            "material_id"  => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
            ],
            "snapshot_material_name"  => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "snapshot_material_unit"  => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "quantity" => [
                "type" => "DOUBLE",
            ],
            "price" => [
                "type" => "DOUBLE",
            ],
            "discount" => [
                "type" => "DOUBLE",
            ],
        ]);

        $this->forge->addKey("id", TRUE);
        $this->forge->createTable("buy_items", TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable("buy_items", TRUE);
    }
}
