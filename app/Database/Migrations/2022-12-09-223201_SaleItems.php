<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SaleItems extends Migration
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
            "sale_id"  => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
            ],
            "product_id"  => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
            ],
            "product_variant_id"  => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
                "null" => true,
            ],
            "snapshot_product_name"  => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "snapshot_product_unit"  => [
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
                "null" => true,
            ],
        ]);

        $this->forge->addKey("id", TRUE);
        $this->forge->createTable("sale_items", TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable("sale_items", TRUE);
    }
}
