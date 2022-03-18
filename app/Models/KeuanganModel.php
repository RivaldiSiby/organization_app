<?php

namespace App\Models;

use CodeIgniter\Model;

class KeuanganModel extends Model
{
    protected $table            = 'tb_keuangan';
    protected $primaryKey       = 'id_laporan';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['nomor_laporan', 'judul_laporan', 'publikasi', 'softdelete', 'file', 'angkatan'];

    public function getLaporan()
    {
        return $this->table($this->table)->where('softdelete', 'no')->orderBy('id_laporan', 'desc')->findAll();
    }
    public function getLaporanNew()
    {
        return $this->table($this->table)->where('softdelete', 'no')->orderBy('id_laporan', 'desc')->findAll(3, 0);
    }
    public function getLaporanAngkatan($angkatan)
    {
        return $this->table($this->table)->where('angkatan', $angkatan)->orderBy('id_laporan', 'desc')->findAll();
    }
    public function getLaporanById($id)
    {
        return $this->table($this->table)->where('id_laporan', $id)->find();
    }
    public function getLaporanBackup()
    {
        return $this->table($this->table)->where('softdelete', 'yes')->orderBy('id_laporan', 'desc')->findAll();
    }
}
