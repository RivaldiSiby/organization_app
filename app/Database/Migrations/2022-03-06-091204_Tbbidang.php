<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbbidang extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'id_bidang' => [
        //         'type' => 'INT',
        //         'constraint' => 11,
        //         'auto_increment' => true
        //     ],
        //     'bidang' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ]
        // ]);
        // $this->forge->addPrimaryKey('id_bidang', true);
        // $this->forge->createTable('tb_bidangorganisasi');
    }

    public function down()
    {
        // $this->forge->dropTable('tb_bidangorganisasi');
    }
}
