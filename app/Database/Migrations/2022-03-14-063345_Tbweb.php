<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbweb extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_web' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'template' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'color' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'font' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slide1' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slide2' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slide3' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slide4' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'slide5' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'bglogin' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);
        $this->forge->addPrimaryKey('id_web', true);
        $this->forge->createTable('tb_web');
    }

    public function down()
    {
        //
    }
}
