<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tbmoderator extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_moderator' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'nama_moderator' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ],
            'rules' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ]
        ]);
        $this->forge->addPrimaryKey('id_moderator', true);
        $this->forge->createTable('tb_moderator');
    }

    public function down()
    {
        // $this->forge->dropTable('tb_moderator');
    }
}
