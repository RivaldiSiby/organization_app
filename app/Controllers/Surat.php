<?php

namespace App\Controllers;

use App\Models\LogModel;
use App\Models\SuratModel;
use CodeIgniter\RESTful\ResourceController;

class Surat extends ResourceController
{
    protected $surat;
    protected $validation;
    protected $log;

    public function __construct()
    {
        session();
        $this->log = new LogModel();
        $this->surat = new SuratModel();
        $this->validation = \Config\Services::validation();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $datasurat = [
            'surat' => $this->surat->getSurat()
        ];
        $data = view('surat/index', $datasurat);
        return $this->respond($data);
    }
    // publik akses
    public function public()
    {
        $datasurat = [
            'surat' => $this->surat->getSurat()
        ];
        if (session()->get('jabatan') != 'Member') {
            $data = view('surat/index', $datasurat);
        } else {
            $data = view('surat/public', $datasurat);
        }
        return $this->respond($data);
    }
    public function add()
    {
        $add = [
            'validation' => \Config\Services::validation()
        ];
        $data = view('surat/add', $add);
        return $this->respond($data);
    }

    public function backup()
    {
        $datasurat = [
            'surat' => $this->surat->getSuratBackup(),
            'backup' => true
        ];
        $data = view('surat/index', $datasurat);
        return $this->respond($data);
    }
    public function clear()
    {
        $surat = $this->surat->getSuratBackup();

        // looping dan hapus semua data 
        foreach ($surat as $data) {
            // hapus gambar/file
            unlink('data/surat/' . $data['file']);
            $this->surat->delete($data['id_surat']);
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
        $surat = $this->surat->getSuratById($id);
        if ($surat) {
            $datas = [
                'surat' => $surat[0],
            ];
            $data = view('surat/edit', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'Surat tidak ditemukan']);
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $surat = $this->surat->getSuratById($id);
        if ($surat) {
            $datas = [
                'surat' => $surat[0],
            ];
            $data = view('surat/view', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'Surat tidak ditemukan']);
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
                'rules' => "ext_in[file,pdf,docx,doc,xls,xlsx]|mime_in[file,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]",
                'errors' => [
                    'ext_in' => 'Format File yang dimasukan tidak didukung',
                    'mine_in' => 'Format File yang dimasukan tidak didukung'
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

        // kelola gambar
        $file = $this->request->getFile('file');
        $files = $file->getRandomName();
        $file->move('data/surat', $files);

        $simpan = [
            'nomor_surat' => $this->request->getVar('nomor_surat'),
            'judul_surat' => $this->request->getVar('judul_surat'),
            'jenis_surat' => $this->request->getVar('jenis_surat'),
            'publikasi' => $this->request->getVar('publikasi'),
            'angkatan' => $this->request->getVar('angkatan'),
            'file' => $files,

        ];
        if ($this->surat->save($simpan)) {
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
                    'activity' => 'Menambahkan Surat ' . $this->request->getVar('judul_surat'),
                    'jenis_data' => 'Surat',
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
        $surat = $this->surat->getSuratById($this->request->getVar('id_surat'));
        if ($surat) {
            $simpan = [
                'id_surat' => $this->request->getVar('id_surat'),
                'nomor_surat' => $this->request->getVar('nomor_surat'),
                'judul_surat' => $this->request->getVar('judul_surat'),
                'jenis_surat' => $this->request->getVar('jenis_surat'),
                'publikasi' => $this->request->getVar('publikasi'),
                'angkatan' => $this->request->getVar('angkatan'),
            ];
            if ($this->request->getFile('file')->getFilename() != "") {
                $rules = [
                    'file' => [
                        'rules' => "ext_in[file,pdf,docx,doc,xls,xlsx]|mime_in[file,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]",
                        'errors' => [
                            'ext_in' => 'Format File yang dimasukan tidak didukung',
                            'mine_in' => 'Format File yang dimasukan tidak didukung'
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

                // kelola  file
                unlink('data/surat/' . $surat[0]['file']);
                $file = $this->request->getFile('file');
                $files = $file->getRandomName();
                $file->move('data/surat', $files);
                // simpan data file
                $simpan['file'] = $files;
            }

            if ($this->surat->save($simpan)) {
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
                        'activity' => 'Mengubah Surat ' . $this->request->getVar('judul_surat'),
                        'jenis_data' => 'Surat',
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
        $surat = $this->surat->getSuratById($id);
        if ($surat) {
            $softdelete = [
                'id_surat' => $id,
                'softdelete' => 'yes'
            ];
            if ($this->surat->save($softdelete)) {
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
                        'activity' => 'Menghapus Surat ' . $surat[0]['judul_surat'],
                        'jenis_data' => 'Surat',
                        'jabatan' => session()->get('jabatan'),
                        'angkatan' => session()->get('angkatanapp')
                    ]);
                }
                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'Surat tidak ditemukan']);
        }
    }
    public function restore($id = null)
    {
        if ($this->surat->getSuratById($id)) {
            $softdelete = [
                'id_surat' => $id,
                'softdelete' => 'no'
            ];
            if ($this->surat->save($softdelete)) {
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
            return $this->fail(['message' => 'surat tidak ditemukan']);
        }
    }
    public function deleteData()
    {
        $surat = $this->surat->getSuratById($this->request->getVar('id'));
        if ($surat) {
            if ($this->surat->delete($this->request->getVar('id'))) {
                $data = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil dihapus'
                    ]
                ];

                // hapus gambar
                unlink('data/surat/' . $surat[0]['file']);

                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'surat tidak ditemukan']);
        }
    }
}
