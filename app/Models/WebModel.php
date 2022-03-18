<?php

namespace App\Models;

use CodeIgniter\Model;

class WebModel extends Model
{
    protected $table            = 'tb_web';
    protected $primaryKey       = 'id_web';
    protected $allowedFields    = ['template', 'color', 'font', 'slide1', 'slide2', 'slide3', 'slide4', 'slide5', 'bglogin'];

    public function getWeb()
    {
        return $this->table($this->table)->findAll();
    }

    public function getWebById($id)
    {
        return $this->table($this->table)->where('id_web', $id)->find();
    }
}
