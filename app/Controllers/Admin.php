<?php

namespace App\Controllers;

use App\Models\AdminModel;
use CodeIgniter\RESTful\ResourceController;

class Admin extends ResourceController
{
    protected $admin;

    public function __construct()
    {
        session();
        $this->admin = new AdminModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //
    }

    // cek pin
    public function cekpin()
    {
        $admin =  $this->admin->getAdminByName(session()->get('nama'));
        if ($admin) {
            if (password_verify($this->request->getVar('pin'), $admin[0]['pin'])) {
                session()->set('appkey', true);
                $data = [
                    'status' => 201,
                    'error' => null,
                    'messages' => [
                        'success' => 'Aplikasi berhasil dibuka'
                    ]
                ];

                return $this->respond($data);
            } else {
                $data = [
                    'status' => 404,
                    'error' => true,
                    'token' => csrf_field(),
                    'messages' => 'Pin yang anda masukan salah !'
                ];

                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'Request Gagal']);
        }
    }

    public function updateData()
    {
        $admin =  $this->admin->getAdminByName(session()->get('nama'));
        if ($admin) {
            $update = [
                'id_admin' => $admin[0]['id_admin'],
                'nama' => $this->request->getVar('nama'),
            ];
            // tambahkan jika password diubah
            if ($this->request->getVar('password')) {
                $update['password'] = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
            }

            // tambahkan jika pin diubah
            if ($this->request->getVar('pin')) {
                $update['pin'] = password_hash($this->request->getVar('pin'), PASSWORD_BCRYPT);
            }

            if ($this->admin->save($update)) {
                $data = [
                    'status' => 201,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil diUbah'
                    ]
                ];
                // atur kembali sesi nama
                session()->set('nama', $this->request->getVar('nama'));
                return $this->respond($data);
            } else {
                return $this->fail(['message' => 'Data gagal diUbah']);
            }
        } else {
            return $this->fail(['message' => 'Request Gagal']);
        }
    }


    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
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
        //
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
}
