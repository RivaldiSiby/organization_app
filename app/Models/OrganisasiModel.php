<?php

namespace App\Models;

use CodeIgniter\Model;

class OrganisasiModel extends Model
{
    protected $table            = 'tb_organisasi';
    protected $primaryKey       = 'id_organisasi';
    protected $allowedFields    = ['nama_organisasi', 'tentang', 'slide1', 'slide2', 'slide3', 'singkatan', 'sejarah', 'visi_misi', 'angkatan', 'struktur', 'logo', 'background_login', 'wa', 'fb', 'ig', 'email', 'moderator_utama'];

    public function getOrganisasi()
    {
        return $this->table($this->table)->find();
    }
    public function getOrganisasiById($id)
    {
        return $this->table($this->table)->where('id_organisasi', $id)->find();
    }
}
