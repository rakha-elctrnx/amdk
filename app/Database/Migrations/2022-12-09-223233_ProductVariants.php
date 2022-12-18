<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductVariants extends Migration
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
            "product_id" => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
            ],
            "quantity_included" => [
                "type" => "DOUBLE"
            ],
            "unit" => [
                "type" => "VARCHAR",
                "constraint" => 255
            ],
            "price" => [
                "type" => "DOUBLE"
            ]
        ]);

        $this->forge->addKey("id", TRUE);
        $this->forge->createTable("product_variants", TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable("product_variants", TRUE);
    }
}
