<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbpostingan extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'id_postingan' => [
        //         'type' => 'INT',
        //         'constraint' => 11,
        //         'auto_increment' => true
        //     ],
        //     'judul_postingan' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'postingan' => [
        //         'type' => 'TEXT',
        //     ],
        //     'file' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'ditujukan' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'created_at' => [
        //         'type' => 'DATETIME'
        //     ],
        //     'updated_at' => [
        //         'type' => 'DATETIME'
        //     ],
        //     'angkatan' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'softdelete' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //         'default' => 'no'
        //     ]
        // ]);
        // $this->forge->addPrimaryKey('id_postingan', true);
        // $this->forge->createTable('tb_postingan');
    }

    public function down()
    {
        // $this->forge->dropTable('tb_postingan');
    }
}
