<?php

namespace App\Controllers;

use App\Models\LogModel;
use App\Models\PostinganModel;
use CodeIgniter\RESTful\ResourceController;

class Postingan extends ResourceController
{
    protected $postingan;
    protected $validation;
    protected $log;
    public function __construct()
    {
        session();
        $this->log = new LogModel();
        $this->postingan = new PostinganModel();
        $this->validation = \Config\Services::validation();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */

    public function index()
    {
        $datapostingan = [
            'postingan' => $this->postingan->getPostingan()
        ];
        $data = view('postingan/index', $datapostingan);
        return $this->respond($data);
    }
    // publik akses 
    public function public()
    {
        $datapostingan = [
            'postingan' => $this->postingan->getPostingan()
        ];
        if (session()->get('jabatan') != 'Member') {
            $data = view('postingan/index', $datapostingan);
        } else {
            $data = view('postingan/public', $datapostingan);
        }

        return $this->respond($data);
    }

    public function add()
    {
        $add = [
            'validation' => \Config\Services::validation(),
        ];
        $data = view('postingan/add', $add);
        return $this->respond($data);
    }

    public function backup()
    {
        $datapostingan = [
            'postingan' => $this->postingan->getPostinganBackup(),
            'backup' => true
        ];
        $data = view('postingan/index', $datapostingan);
        return $this->respond($data);
    }

    public function clear()
    {
        $postingan = $this->postingan->getPostinganBackup();

        // looping dan hapus semua data 
        foreach ($postingan as $data) {
            // hapus gambar/file
            if ($data['file'] != '') {
                unlink('data/postingan/' . $data['file']);
            }
            $this->postingan->delete($data['id_postingan']);
        }
        $data = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data Backup berhasil dibersihkan'
            ]
        ];
        return $this->respond($data);
    }
    public function editData($id)
    {
        $postingan = $this->postingan->getPostinganById($id);
        if ($postingan) {
            $datas = [
                'postingan' => $postingan[0],
            ];
            $data = view('postingan/edit', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'postingan tidak ditemukan']);
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $postingan = $this->postingan->getPostinganById($id);
        if ($postingan) {
            $datas = [
                'postingan' => $postingan[0],
            ];
            $data = view('postingan/view', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'postingan tidak ditemukan']);
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
        $rules = [
            'file' => [
                'rules' => 'max_size[file,2048]|is_image[file]|mime_in[file,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 2mb',
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar'
                ]
            ]
        ];
        if (!$this->validate($rules)) {
            $data = [
                'status' => 400,
                'error' => true,
                'token' => csrf_field(),
                'messages' => $this->validation->getError('file')
            ];
            return $this->respond($data);
        }
        $simpan = [
            'judul_postingan' => $this->request->getVar('judul_postingan'),
            'postingan' => $this->request->getVar('postingan'),
            'angkatan' => $this->request->getVar('angkatan'),
            'ditujukan' => $this->request->getVar('ditujukan'),
        ];

        if ($this->request->getFile('file')->getFilename() != "") {
            // kelola gambar
            $file = $this->request->getFile('file');
            $files = $file->getRandomName();
            $file->move('data/postingan', $files);
            // masukan gambar
            $simpan['file'] = $files;
        }

        if ($this->postingan->save($simpan)) {
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
                    'activity' => 'Menambahkan Postingan ' . $this->request->getVar('judul_postingan'),
                    'jenis_data' => 'Postingan',
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
        $postingan = $this->postingan->getPostinganById($this->request->getVar('id_postingan'));
        if ($postingan) {
            $rules = [
                'file' => [
                    'rules' => 'max_size[file,2048]|is_image[file]|mime_in[file,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar tidak boleh lebih dari 2mb',
                        'is_image' => 'yang anda upload bukan gambar',
                        'mime_in' => 'yang anda upload bukan gambar'
                    ]
                ]
            ];
            if (!$this->validate($rules)) {
                $data = [
                    'status' => 400,
                    'error' => true,
                    'token' => csrf_field(),
                    'messages' => $this->validation->getError('file')
                ];
                return $this->respond($data);
            }
            $simpan = [
                'id_postingan' => $this->request->getVar('id_postingan'),
                'judul_postingan' => $this->request->getVar('judul_postingan'),
                'postingan' => $this->request->getVar('postingan'),
                'angkatan' => $this->request->getVar('angkatan'),
                'ditujukan' => $this->request->getVar('ditujukan'),
            ];

            if ($this->request->getFile('file')->getFilename() != "") {

                // kelola gambar
                $file = $this->request->getFile('file');
                $files = $file->getRandomName();
                $file->move('data/postingan', $files);
                // masukan gambar
                $simpan['file'] = $files;
                // hapus gambar lama jika ada
                if ($postingan[0]['file'] != '') {
                    unlink('data/postingan/' . $postingan[0]['file']);
                }
            }

            if ($this->postingan->save($simpan)) {
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
                        'activity' => 'Mengubah Postingan ' . $this->request->getVar('judul_postingan'),
                        'jenis_data' => 'Postingan',
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
    public function softdelete($id = null)
    {
        $postingan = $this->postingan->getPostinganById($id);
        if ($postingan) {
            $softdelete = [
                'id_postingan' => $id,
                'softdelete' => 'yes'
            ];
            if ($this->postingan->save($softdelete)) {
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
                        'activity' => 'Menghapus Postingan ' . $postingan[0]['judul_postingan'],
                        'jenis_data' => 'Postingan',
                        'jabatan' => session()->get('jabatan'),
                        'angkatan' => session()->get('angkatanapp')
                    ]);
                }
                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'postingan tidak ditemukan']);
        }
    }
    public function restore($id = null)
    {
        if ($this->postingan->getPostinganById($id)) {
            $softdelete = [
                'id_postingan' => $id,
                'softdelete' => 'no'
            ];
            if ($this->postingan->save($softdelete)) {
                $data = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil dipulihakan'
                    ]
                ];
                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'postingan tidak ditemukan']);
        }
    }
    public function deleteData()
    {
        $postingan = $this->postingan->getPostinganById($this->request->getVar('id'));
        if ($postingan) {
            if ($this->postingan->delete($this->request->getVar('id'))) {
                $data = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil dihapus'
                    ]
                ];

                // hapus gambar
                if ($postingan[0]['file'] != '') {
                    unlink('data/postingan/' . $postingan[0]['file']);
                }

                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'postingan tidak ditemukan']);
        }
    }
}
