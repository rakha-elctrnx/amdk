<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ingredients extends Migration
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
            "production_id"  => [
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
            "snapshot_material_price"  => [
                "type" => "DOUBLE",
            ],
            "quantity" => [
                "type" => "DOUBLE",
            ],
        ]);

        $this->forge->addKey("id", TRUE);
        $this->forge->createTable("ingredients", TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable("ingredients", TRUE);
    }
}
