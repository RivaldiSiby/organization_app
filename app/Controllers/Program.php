<?php

namespace App\Controllers;

use App\Models\BidangModel;
use App\Models\LogModel;
use App\Models\ProgramModel;
use CodeIgniter\RESTful\ResourceController;

class Program extends ResourceController
{
    protected $program;
    protected $bidang;
    protected $log;

    public function __construct()
    {
        session();
        $this->log = new LogModel();
        $this->program = new ProgramModel();
        $this->bidang = new BidangModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $databidang = $this->bidang->getBidangByName(session()->get('jabatan'));
        if (session()->get('level') == 'admin') {
            $dataprogram = [
                'program' => $this->program->getProgram(),
                'bidang' => $this->bidang->getBidang()
            ];
        } else if (count($databidang) > 0) {
            $dataprogram = [
                'program' => $this->program->getProgramBidangAngkatan(session()->get('jabatan')),
                'jabatanbidang' => session()->get('jabatan'),
                'bidang' => $this->bidang->getBidang()
            ];
        }

        $data = view('program/index', $dataprogram);
        return $this->respond($data);
    }
    public function publicview()
    {
        if (session()->get('level') == 'member') {
            $dataprogram = [
                'program' => $this->program->getProgram(),
                'bidang' => $this->bidang->getBidang()
            ];
            $data = view('program/view', $dataprogram);
            return $this->respond($data);
        }
    }
    public function add()
    {
        $dataprogram = [
            'validation' => \Config\Services::validation(),
            'bidang' => $this->bidang->getBidang()
        ];
        if (session()->get('level') == 'member') {
            $dataprogram['jabatanbidang'] = session()->get('jabatan');
        }
        $data = view('program/add', $dataprogram);
        return $this->respond($data);
    }


    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $program = $this->program->getProgramById($id);
        if ($program) {
            $datas = [
                'program' => $program[0],
                'bidang' => $this->bidang->getBidang()
            ];
            if (session()->get('level') == 'member') {
                $datas['jabatanbidang'] = session()->get('jabatan');
            }
            $data = view('program/edit', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'Program tidak ditemukan']);
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
            'program' => $this->request->getVar('program'),
            'bidang' => $this->request->getVar('bidang'),
            'angkatan' => $this->request->getVar('angkatan'),
        ];
        if ($this->program->save($simpan)) {
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
                    'activity' => 'Menambahkan Program Kerja ' . $this->request->getVar('program'),
                    'jenis_data' => 'Program Kerja',
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
        $program = $this->program->getProgramById($this->request->getVar('id'));
        if ($program) {
            $simpan = [
                'id_program' => $this->request->getVar('id'),
                'program' => $this->request->getVar('program'),
                'bidang' => $this->request->getVar('bidang'),
                'angkatan' => $this->request->getVar('angkatan'),
            ];
            if ($this->program->save($simpan)) {
                $data = [
                    'status' => 201,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil diUbah'
                    ]
                ];
                if (session()->get('level') != 'admin') {
                    // tambah log
                    $this->log->save([
                        'activity' => 'Mengubah Program Kerja ' . $this->request->getVar('program'),
                        'jenis_data' => 'Program Kerja',
                        'jabatan' => session()->get('jabatan'),
                        'angkatan' => session()->get('angkatanapp')
                    ]);
                }
                return $this->respond($data);
            } else {
                return $this->fail(['message' => 'Data Gagal diUbah']);
            }
        } else {
            return $this->fail(['message' => 'Data Gagal diUbah']);
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
        $program = $this->program->getProgramById($this->request->getVar('id'));
        if ($program) {
            if ($this->program->delete($this->request->getVar('id'))) {
                $data = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil dihapus'
                    ]
                ];
                if (session()->get('level') != 'admin') {
                    // tambah log
                    $this->log->save([
                        'activity' => 'Menghapus Program Kerja ' . $program[0]['program'],
                        'jenis_data' => 'Program Kerja',
                        'jabatan' => session()->get('jabatan'),
                        'angkatan' => session()->get('angkatanapp')
                    ]);
                }

                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'Program tidak ditemukan']);
        }
    }
}
