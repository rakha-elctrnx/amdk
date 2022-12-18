<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Stocks extends Migration
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
            "admin_id"  => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
            ],
            "reference_table" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true,
            ],
            "reference_id" => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
                "null" => true
            ],
            "target_table" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true,
            ],
            "target_id" => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
                "null" => true,
            ],
            "details" => [
                "type" => "LONGTEXT",
            ],
            "date" => [
                "type" => "DATE",
            ],
            "notes" => [
                "type" => "LONGTEXT",
                "null" => true
            ]
        ]);

        $this->forge->addKey("id", TRUE);
        $this->forge->createTable("stocks", TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable("stocks", TRUE);
    }
}
