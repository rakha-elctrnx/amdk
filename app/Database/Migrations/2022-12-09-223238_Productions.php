<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Productions extends Migration
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
            "number" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true,
            ],
            "admin_id" => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
            ],
            "product_id" => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
            ],
            "snapshot_product_name"  => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "snapshot_product_unit"  => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "snapshot_product_price"  => [
                "type" => "DOUBLE"
            ],
            "targets" => [
                "type" => "DOUBLE",
            ],
            "production_date" => [
                "type" => "DATE"
            ],
            "estimation_date" => [
                "type" => "DATE"
            ],
            "finish_date" => [
                "type" => "DATE",
                "null" => true,
            ],
            "achieveds" => [
                "type" => "DOUBLE",
                "null" => true,
            ],
            "faileds" => [
                "type" => "DOUBLE",
                "null" => true,
            ],
        ]);

        $this->forge->addKey("id", TRUE);
        $this->forge->createTable("productions", TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable("productions", TRUE);
    }
}
