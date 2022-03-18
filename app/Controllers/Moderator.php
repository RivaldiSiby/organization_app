<?php

namespace App\Controllers;

use App\Models\MemberModel;
use App\Models\ModeratorModel;
use CodeIgniter\RESTful\ResourceController;

class Moderator extends ResourceController
{
    protected $moderator;
    protected $member;
    public function __construct()
    {
        session();
        $this->moderator = new ModeratorModel();
        $this->member = new MemberModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    public function index()
    {
        $datamoderator = [
            'moderator' => $this->moderator->getModerator()
        ];
        $data = view('moderator/index', $datamoderator);
        return $this->respond($data);
    }
    public function add()
    {
        $add = [
            'validation' => \Config\Services::validation()
        ];
        $data = view('moderator/add', $add);
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $moder = $this->moderator->getModeratorById($id);
        if ($moder) {
            $datas = [
                'moderator' => $moder[0]
            ];
            $data = view('moderator/edit', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'Moderator tidak ditemukan']);
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
            'nama_moderator' => $this->request->getVar('moderator'),
            'rules' => $this->request->getVar('rules'),
        ];
        if ($this->moderator->save($simpan)) {
            $data = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data Berhasil ditambahkan'
                ]
            ];
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'Data Gagal ditambahkan']);
        }
    }
    public function updateData()
    {
        $moderator = $this->moderator->getModeratorById($this->request->getVar('id'));
        if ($moderator) {

            // simpan
            $simpan = [
                'id_moderator' => $this->request->getVar('id'),
                'nama_moderator' => $this->request->getVar('nama_moderator'),
                'rules' => $this->request->getVar('rules'),
            ];
            if ($this->moderator->save($simpan)) {
                $data = [
                    'status' => 201,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil diUbah'
                    ]
                ];

                // ganti nama jabatan pada member
                $datamember = $this->member->getMemberByJabatan($moderator[0]['nama_moderator']);
                foreach ($datamember as $data) {
                    $this->member->save([
                        'id_member' => $data['id_member'],
                        'jabatan' => $this->request->getVar('nama_moderator')
                    ]);
                }
                // ganti nama jabatan pada postingan
                $datamember = $this->member->getMemberByJabatan($moderator[0]['nama_moderator']);
                foreach ($datamember as $data) {
                    $this->member->save([
                        'id_member' => $data['id_member'],
                        'jabatan' => $this->request->getVar('nama_moderator')
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
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
    }
    public function deleteData()
    {
        $moderator = $this->moderator->getModeratorById($this->request->getVar('id'));
        if ($moderator) {
            if ($this->moderator->delete($this->request->getVar('id'))) {
                $data = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil dihapus'
                    ]
                ];
                // ganti nama jabatan yang dihapus pada member menjadi member
                $datamember = $this->member->getMemberByJabatan($moderator[0]['nama_moderator']);
                foreach ($datamember as $data) {
                    $this->member->save([
                        'id_member' => $data['id_member'],
                        'jabatan' => 'Member'
                    ]);
                }

                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'Moderator tidak ditemukan']);
        }
    }
}
