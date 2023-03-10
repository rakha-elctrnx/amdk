<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Buys extends Migration
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
                "constraint" => 255
            ],
            "admin_id"  => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
            ],
            "supplier_id" => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
            ],            
            "invoice_reference" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => true,
            ],
            "date"  => [
                "type"=>"DATE"
            ],
            "notes" => [
                "type" => "LONGTEXT",
                "null" => true
            ]
        ]);

        $this->forge->addKey("id", TRUE);

        $this->forge->createTable("buys", TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable("buys", TRUE);
    }
}
