<?php

namespace App\Controllers;

use App\Models\BidangModel;
use App\Models\LogModel;
use App\Models\MemberModel;
use App\Models\ProgramModel;
use CodeIgniter\RESTful\ResourceController;

class Bidang extends ResourceController
{
    protected $bidang;
    protected $member;
    protected $program;
    protected $log;

    public function __construct()
    {
        session();
        $this->log = new LogModel();
        $this->bidang = new BidangModel();
        $this->member = new MemberModel();
        $this->program = new ProgramModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $databidang = [
            'bidang' => $this->bidang->getBidang()
        ];
        $data = view('bidang/index', $databidang);
        return $this->respond($data);
    }
    public function add()
    {
        $databidang = [
            'validation' => \Config\Services::validation()
        ];
        $data = view('bidang/add', $databidang);
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $bidang = $this->bidang->getBidangById($id);
        if ($bidang) {
            $datas = [
                'bidang' => $bidang[0]
            ];
            $data = view('bidang/edit', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'Bidang tidak ditemukan']);
        }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $simpan = [
            'bidang' => $this->request->getVar('bidang'),
        ];
        if ($this->bidang->save($simpan)) {
            $data = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data Berhasil ditambahkan'
                ]
            ];
            if (session()->get('level') != 'admin') {
                // tambah log
                $this->log->save([
                    'activity' => 'Menambahkan Bidang Organisasi ' . $this->request->getVar('bidang'),
                    'jenis_data' => 'Bidang Organisasi',
                    'jabatan' => session()->get('jabatan'),
                    'angkatan' => session()->get('angkatanapp')
                ]);
            }
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'Data Gagal ditambahkan']);
        }
    }

    public function updateData()
    {
        $bidang = $this->bidang->getBidangById($this->request->getVar('id'));
        if ($bidang) {

            // simpan
            $simpan = [
                'id_bidang' => $this->request->getVar('id'),
                'bidang' => $this->request->getVar('bidang'),
            ];
            if ($this->bidang->save($simpan)) {
                $data = [
                    'status' => 201,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil diUbah'
                    ]
                ];

                // ganti nama jabatan pada member
                $datamember = $this->member->getMemberByJabatan($bidang[0]['bidang']);
                foreach ($datamember as $data) {
                    $this->member->save([
                        'id_member' => $data['id_member'],
                        'jabatan' => $this->request->getVar('bidang')
                    ]);
                }
                // ganti nama bidang pada program kerja
                $dataprogram = $this->program->getProgramBidang($bidang[0]['bidang']);
                foreach ($dataprogram as $data) {
                    $this->program->save([
                        'id_program' => $data['id_program'],
                        'bidang' => $this->request->getVar('bidang')
                    ]);
                }
                if (session()->get('level') != 'admin') {
                    // tambah log
                    $this->log->save([
                        'activity' => 'Mengubah Bidang Organisasi ' . $this->request->getVar('bidang'),
                        'jenis_data' => 'Bidang Organisasi',
                        'jabatan' => session()->get('jabatan'),
                        'angkatan' => session()->get('angkatanapp')
                    ]);
                }

                return $this->respond($data);
            } else {
                return $this->fail(['message' => 'Data Gagal diubah']);
            }
        } else {
            return $this->fail(['message' => 'Data Gagal diubah']);
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
    public function deleteData()
    {
        $bidang = $this->bidang->getBidangById($this->request->getVar('id'));
        if ($bidang) {
            if ($this->bidang->delete($this->request->getVar('id'))) {
                $data = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil dihapus'
                    ]
                ];
                // ganti nama jabatan yang dihapus pada member menjadi member
                $datamember = $this->member->getMemberByJabatan($bidang[0]['bidang']);
                foreach ($datamember as $data) {
                    $this->member->save([
                        'id_member' => $data['id_member'],
                        'jabatan' => 'Member'
                    ]);
                }
                // hapus program pada bidang yang dihapus
                $dataprogram = $this->program->getProgramBidang($bidang[0]['bidang']);
                foreach ($dataprogram as $data) {
                    $this->program->delete($data['id_program']);
                }
                if (session()->get('level') != 'admin') {
                    // tambah log
                    $this->log->save([
                        'activity' => 'Menghapus Bidang Organisasi ' . $bidang[0]['bidang'],
                        'jenis_data' => 'Bidang Organisasi',
                        'jabatan' => session()->get('jabatan'),
                        'angkatan' => session()->get('angkatanapp')
                    ]);
                }

                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'Bidang tidak ditemukan']);
        }
    }
}
