<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeratorModel extends Model
{
    protected $table            = 'tb_moderator';
    protected $primaryKey       = 'id_moderator';
    protected $allowedFields    = ['nama_moderator', 'rules'];

    public function getModerator()
    {
        return $this->table($this->table)->findAll();
    }
    public function getModeratorByName($moderator)
    {
        return $this->table($this->table)->where('nama_moderator', $moderator)->find();
    }
    public function getModeratorById($id)
    {
        return $this->table($this->table)->where('id_moderator', $id)->find();
    }
}
