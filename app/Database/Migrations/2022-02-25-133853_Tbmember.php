<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbmember extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_member' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'jenis_kelamin' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'tempat_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'tanggal_lahir' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'angkatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'kta' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'foto' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'softdelete' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'default' => 'no'
            ],
            'jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => 'member'
            ]
        ]);
        $this->forge->addPrimaryKey('id_member', true);
        $this->forge->createTable('tb_member');
    }

    public function down()
    {
        // $this->forge->dropTable('tb_member');
    }
}
