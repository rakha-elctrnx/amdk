<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Administrators extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            "id"    => [
                "type"              => "BIGINT",
                "constraint"        => 100,
                "unsigned"          => true,
                "auto_increment"    => true
            ],
            "username"  => [
                "type"          => "VARCHAR",
                "constraint"    => 255
            ],
            "password" => [
                "type" => "VARCHAR",
                "constraint" => 255,
            ],
            "name"  => [
                "type" => "VARCHAR",
                "constraint" => 255
            ]
        ]);

        $this->forge->addKey("id",TRUE);
        
        $this->forge->createTable('administrators', TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable("administrators", TRUE);
    }
}
