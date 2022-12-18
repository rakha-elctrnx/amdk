<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Costs extends Migration
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
            "details" => [
                "type" => "LONGTEXT"
            ],
            "price" => [
                "type" => "DOUBLE"
            ],
            "date" => [
                "type" => "DATE"
            ]
        ]);

        $this->forge->addKey("id", TRUE);
        $this->forge->createTable("costs", TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable("costs", TRUE);
    }
}
