<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbkegiatan extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'id_kegiatan' => [
        //         'type' => 'INT',
        //         'constraint' => 11,
        //         'auto_increment' => true
        //     ],
        //     'kegiatan' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'pesan_kegiatan' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'mulai_kegiatan' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'selesai_kegiatan' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'angkatan' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'softdelete' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //         'default' => 'no'
        //     ],
        //     'gambar' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'ditujukan' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255
        //     ],
        //     'created_at' => [
        //         'type' => 'DATETIME',
        //     ],
        //     'updated_at' => [
        //         'type' => 'DATETIME',
        //     ],
        // ]);
        // $this->forge->addPrimaryKey('id_kegiatan', true);
        // $this->forge->createTable('tb_kegiatan');
    }

    public function down()
    {
        // $this->forge->dropTable('tb_kegiatan');
    }
}
