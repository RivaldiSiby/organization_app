<?php

namespace App\Models;

use CodeIgniter\Model;

class PostinganModel extends Model
{
    protected $table            = 'tb_postingan';
    protected $primaryKey       = 'id_postingan';
    protected $useTimestamps    = true;
    protected $allowedFields    = ['judul_postingan', 'postingan', 'file', 'ditujukan', 'angkatan', 'softdelete'];

    public function getPostingan()
    {
        return $this->table($this->table)->where('softdelete', 'no')->orderBy('id_postingan', 'desc')->findAll();
    }
    public function getPostinganNew()
    {
        return $this->table($this->table)->where(['softdelete' => 'no', 'ditujukan' => 'publik'])->orderBy('id_postingan', 'desc')->findAll(3, 0);
    }
    public function getPostinganPublik()
    {
        return $this->table($this->table)->where(['softdelete' => 'no', 'ditujukan' => 'publik'])->orderBy('id_postingan', 'desc')->findAll();
    }

    public function getPostinganAngkatan($angkatan)
    {
        return $this->table($this->table)->where('angkatan', $angkatan)->orderBy('id_postingan', 'desc')->findAll();
    }

    public function getPostinganById($id)
    {
        return $this->table($this->table)->where('id_postingan', $id)->find();
    }

    public function getPostinganBackup()
    {
        return $this->table($this->table)->where('softdelete', 'yes')->orderBy('id_postingan', 'desc')->findAll();
    }
}
