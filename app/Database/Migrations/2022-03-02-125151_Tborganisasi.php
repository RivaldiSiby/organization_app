<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tborganisasi extends Migration
{
    public function up()
    {
        // $this->forge->addField([
        //     'id_organisasi' => [
        //         'type' => 'INT',
        //         'constraint' => 11,
        //         'auto_increment' => true
        //     ],
        //     'nama_organisasi' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ],
        //     'singkatan' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ],
        //     'sejarah' => [
        //         'type' => 'TEXT',
        //     ],
        //     'visi_misi' => [
        //         'type' => 'TEXT',
        //     ],
        //     'tentang' => [
        //         'type' => 'TEXT',
        //     ],
        //     'moderator_utama' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ],
        //     'angkatan' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ],
        //     'wa' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ],
        //     'fb' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ],
        //     'ig' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ],
        //     'email' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ],
        //     'struktur' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ],
        //     'logo' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ],
        //     'icon' => [
        //         'type' => 'VARCHAR',
        //         'constraint' => 255,
        //     ],

        // ]);
        // $this->forge->addPrimaryKey('id_organisasi', true);
        // $this->forge->createTable('tb_organisasi');
    }


    public function down()
    {
        // $this->forge->dropTable('tb_organisasi');
    }
}
