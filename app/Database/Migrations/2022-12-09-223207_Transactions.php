<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transactions extends Migration
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
            "details" => [
                "type" => "LONGTEXT",
            ],
            "date" => [
                "type" => "DATE"
            ],
            "debit" => [
                "type" => "DOUBLE",
                "null" => true,
            ],
            "credit" => [
                "type" => "DOUBLE",
                "null" => true,
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
            ]
        ]);

        $this->forge->addKey("id", TRUE);
        $this->forge->createTable("transactions", TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable("transactions", TRUE);
    }
}
