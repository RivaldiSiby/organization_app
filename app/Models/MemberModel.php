<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table            = 'tb_member';
    protected $primaryKey       = 'id_member';
    protected $allowedFields    = ['nama', 'password', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'angkatan', 'alamat', 'kta', 'foto', 'softdelete', 'jabatan'];

    public function getMemberAll()
    {
        return $this->table($this->table)->where('softdelete', 'no')->orderBy('id_member', 'desc')->findAll();
    }
    public function getMemberByJabatan($jabatan)
    {
        return $this->table($this->table)->where('jabatan', $jabatan)->orderBy('id_member', 'desc')->findAll();
    }
    public function getMemberAllBackup()
    {
        return $this->table($this->table)->where('softdelete', 'yes')->orderBy('id_member', 'desc')->findAll();
    }
    public function getMemberAngkatan($angkatan)
    {
        return $this->table($this->table)->where('angkatan', $angkatan)->orderBy('id_member', 'desc')->findAll();
    }
    public function getMemberById($id)
    {
        return $this->table($this->table)->where('id_member', $id)->find();
    }
    public function getMemberByName($name)
    {
        return $this->table($this->table)->where('nama', $name)->find();
    }
}
