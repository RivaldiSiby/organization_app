<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbprogram extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'id_program' => [
        //         'type' => 'INT',
        //         'constraint' => 11,
        //         'auto_increment' => true,
        //     ],
        //     'program' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,

        //     ],
        //     'angkatan' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,

        //     ],
        //     'bidang' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,

        //     ],
        //     'created_at' => [
        //         'type' => 'DATETIME'
        //     ],
        //     'updated_at' => [
        //         'type' => 'DATETIME'
        //     ],
        // ]);
        // $this->forge->addPrimaryKey('id_program', true);
        // $this->forge->createTable('tb_programkerja');
    }

    public function down()
    {
        // $this->forge->dropTable('tb_programkerja');
    }
}
