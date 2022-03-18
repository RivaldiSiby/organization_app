<?php

namespace App\Models;

use CodeIgniter\Model;

class BidangModel extends Model
{
    protected $table            = 'tb_bidangorganisasi';
    protected $primaryKey       = 'id_bidang';
    protected $allowedFields    = ['bidang'];

    public function getBidang()
    {
        return $this->table($this->table)->orderBy('id_bidang')->findAll();
    }

    public function getBidangById($id)
    {
        return $this->table($this->table)->where('id_bidang', $id)->find();
    }

    public function getBidangByName($bidang)
    {
        return $this->table($this->table)->where('bidang', $bidang)->find();
    }
}
