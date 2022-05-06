<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tblog extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_log' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'activity' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'jenis_data' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'angkatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME'
            ]
        ]);
        $this->forge->addPrimaryKey('id_log', true);
        $this->forge->createTable('tb_log');
    }

    public function down()
    {
        // $this->forge->dropTable('tb_log');
    }
}
