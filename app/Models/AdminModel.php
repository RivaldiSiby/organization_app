<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'tb_admin';
    protected $primaryKey       = 'id_admin';
    protected $allowedFields    = ['nama', 'password', 'pin'];

    public function getAdminById($id)
    {
        return $this->table($this->table)->where('id_admin', $id)->find();
    }

    public function getAdminByName($name)
    {
        return $this->table($this->table)->where('nama', $name)->find();
    }
}
