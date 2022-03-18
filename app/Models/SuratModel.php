<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratModel extends Model
{
    protected $table            = 'tb_surat';
    protected $primaryKey       = 'id_surat';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nomor_surat', 'judul_surat', 'jenis_surat', 'publikasi', 'softdelete', 'file', 'angkatan'];

    public function getSurat()
    {
        return $this->table($this->table)->where('softdelete', 'no')->orderBy('id_surat', 'desc')->findAll();
    }
    public function getSuratNew()
    {
        return $this->table($this->table)->where('softdelete', 'no')->orderBy('id_surat', 'desc')->findAll(3, 0);
    }
    public function getSuratAngkatan($angkatan)
    {
        return $this->table($this->table)->where('angkatan', $angkatan)->orderBy('id_surat', 'desc')->findAll();
    }
    public function getSuratById($id)
    {
        return $this->table($this->table)->where('id_surat', $id)->find();
    }
    public function getSuratBackup()
    {
        return $this->table($this->table)->where('softdelete', 'yes')->orderBy('id_surat', 'desc')->findAll();
    }
}
