<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sales extends Migration
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
            "customer_id" => [
                "type" => "BIGINT",
                "constraint" => 100,
                "unsigned" => true,
            ],            
            "date"  => [
                "type"=>"DATE"
            ],
            "paid" => [
                "type"=> "DOUBLE"
            ],
            "notes" => [
                "type" => "LONGTEXT",
                "null" => true,
            ]
        ]);

        $this->forge->addKey("id", TRUE);

        $this->forge->createTable("sales", TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable("sales", TRUE);
    }
}
