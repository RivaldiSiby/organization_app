<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbadmin extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'id_admin' => [
        //         'type' => 'INT',
        //         'constraint' => 11,
        //         'auto_increment' => true
        //     ],
        //     'nama' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'password' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'pin' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ]
        // ]);
        // $this->forge->addPrimaryKey('id_admin', true);
        // $this->forge->createTable('tb_admin');
    }

    public function down()
    {
        // $this->forge->dropTable('tb_admin');
    }
}
