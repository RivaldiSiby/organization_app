<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanModel extends Model
{
    protected $table            = 'tb_kegiatan';
    protected $primaryKey       = 'id_kegiatan';
    protected $allowedFields     = ['kegiatan', 'pesan_kegiatan', 'mulai_kegiatan', 'selesai_kegiatan', 'angkatan', 'gambar', 'ditujukan', 'softdelete'];
    protected $useTimestamps    = true;

    public function getKegiatan()
    {
        return $this->table($this->table)->where('softdelete', 'no')->orderBy('id_kegiatan', 'desc')->findAll();
    }
    public function getKegiatanPublic()
    {
        return $this->table($this->table)->where(['softdelete' => 'no', 'ditujukan' => 'publik'])->orderBy('id_kegiatan', 'desc')->findAll();
    }

    public function getKegiatanBackup()
    {
        return $this->table($this->table)->where('softdelete', 'yes')->orderBy('id_kegiatan', 'desc')->findAll();
    }

    public function getKegiatanById($id)
    {
        return $this->table($this->table)->where('id_kegiatan', $id)->find();
    }
    public function getKegiatanByAngkatan()
    {
        return $this->table($this->table)->where(['softdelete' => 'no', 'angkatan' => session()->get('angkatanapp')])->orderBy('id_kegiatan', 'desc')->findAll();
    }
}
