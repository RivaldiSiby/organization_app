<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbsurat extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'id_surat' => [
        //         'type' => 'INT',
        //         'constraint' => 11,
        //         'auto_increment' => true
        //     ],
        //     'nomor_surat' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'judul_surat' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'jenis_surat' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'publikasi' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'created_at' => [
        //         'type' => 'DATETIME'
        //     ],
        //     'updated_at' => [
        //         'type' => 'DATETIME'
        //     ],
        //     'softdelete' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //         'default' => 'no'
        //     ],
        //     'file' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ],
        //     'angkatan' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ],
        // ]);
        // $this->forge->addPrimaryKey('id_surat', true);
        // $this->forge->createTable('tb_surat');
    }

    public function down()
    {
        // $this->forge->dropTable('tb_surat');
    }
}
