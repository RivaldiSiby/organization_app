<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table            = 'tb_log';
    protected $primaryKey       = 'id_log';
    protected $useTimestamps    = true;
    protected $allowedFields     = ['activity', 'jenis_data', 'jabatan', 'angkatan'];

    public function getLog()
    {
        return $this->table($this->table)->orderBy('id_log', 'desc')->findAll();
    }
    public function getLogAngkatan()
    {
        return $this->table($this->table)->where('angkatan', session()->get('angkatanapp'))->orderBy('id_log', 'desc')->findAll();
    }
    public function getAngkatanById($id)
    {
        return $this->table($this->table)->where('id_log', $id)->find();
    }
}
