<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramModel extends Model
{
    protected $table            = 'tb_programkerja';
    protected $primaryKey       = 'id_program';
    protected $allowedFields    = ['program', 'angkatan', 'bidang'];
    protected $useTimestamps    = true;

    public function getProgram()
    {
        return $this->table($this->table)->orderBy('id_program')->findAll();
    }

    public function getProgramById($id)
    {
        return $this->table($this->table)->where('id_program', $id)->find();
    }

    public function getProgramAngkatan()
    {
        return $this->table($this->table)->where('angkatan', session()->get('angkatanapp'))->findAll();
    }


    public function getProgramBidang($bidang)
    {
        return $this->table($this->table)->where(['bidang' => $bidang])->findAll();
    }
    public function getProgramBidangAngkatan($bidang)
    {
        return $this->table($this->table)->where(['bidang' => $bidang, 'angkatan' => session()->get('angkatanapp')])->findAll();
    }
}
