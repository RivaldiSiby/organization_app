<?php

namespace App\Controllers;

use App\Models\KeuanganModel;
use App\Models\LogModel;
use CodeIgniter\RESTful\ResourceController;

class Keuangan extends ResourceController
{
    protected $keuangan;
    protected $validation;
    protected $log;

    public function __construct()
    {
        session();
        $this->log = new LogModel();
        $this->keuangan = new KeuanganModel();
        $this->validation = \Config\Services::validation();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $datakeuangan = [
            'keuangan' => $this->keuangan->getLaporan()
        ];
        $data = view('keuangan/index', $datakeuangan);
        return $this->respond($data);
    }
    public function public()
    {
        $datakeuangan = [
            'keuangan' => $this->keuangan->getLaporan()
        ];
        if (session()->get('jabatan') != 'Member') {
            $data = view('keuangan/index', $datakeuangan);
        } else {
            $data = view('keuangan/public', $datakeuangan);
        }
        return $this->respond($data);
    }
    public function add()
    {
        $add = [
            'validation' => \Config\Services::validation()
        ];
        $data = view('keuangan/add', $add);
        return $this->respond($data);
    }

    public function backup()
    {
        $datakeuangan = [
            'keuangan' => $this->keuangan->getLaporanBackup(),
            'backup' => true
        ];
        $data = view('keuangan/index', $datakeuangan);
        return $this->respond($data);
    }
    public function clear()
    {
        $keuangan = $this->keuangan->getLaporanBackup();

        // looping dan hapus semua data 
        foreach ($keuangan as $data) {
            // hapus gambar/file
            unlink('data/keuangan/' . $data['file']);
            $this->keuangan->delete($data['id_laporan']);
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
        $keuangan = $this->keuangan->getLaporanById($id);
        if ($keuangan) {
            $datas = [
                'keuangan' => $keuangan[0],
            ];
            $data = view('keuangan/edit', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'Laporan Keuangan tidak ditemukan']);
        }
    }


    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $keuangan = $this->keuangan->getLaporanById($id);
        if ($keuangan) {
            $datas = [
                'keuangan' => $keuangan[0],
            ];
            $data = view('keuangan/view', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'Laporan keuangan tidak ditemukan']);
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
        $file->move('data/keuangan', $files);

        $simpan = [
            'nomor_laporan' => $this->request->getVar('nomor_laporan'),
            'judul_laporan' => $this->request->getVar('judul_laporan'),
            'publikasi' => $this->request->getVar('publikasi'),
            'angkatan' => $this->request->getVar('angkatan'),
            'file' => $files,

        ];
        if ($this->keuangan->save($simpan)) {
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
                    'activity' => 'Menambahkan Laporan Keuangan ' . $this->request->getVar('judul_laporan'),
                    'jenis_data' => 'Laporan Keuangan',
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
        $keuangan = $this->keuangan->getLaporanById($this->request->getVar('id_laporan'));
        if ($keuangan) {
            $simpan = [
                'id_laporan' => $this->request->getVar('id_laporan'),
                'nomor_laporan' => $this->request->getVar('nomor_laporan'),
                'judul_laporan' => $this->request->getVar('judul_laporan'),
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
                unlink('data/keuangan/' . $keuangan[0]['file']);
                $file = $this->request->getFile('file');
                $files = $file->getRandomName();
                $file->move('data/keuangan', $files);
                // simpan data file
                $simpan['file'] = $files;
            }

            if ($this->keuangan->save($simpan)) {
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
                        'activity' => 'Mengubah Laporan Keuangan ' . $this->request->getVar('judul_laporan'),
                        'jenis_data' => 'Laporan Keuangan',
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
        $keuangan = $this->keuangan->getLaporanById($id);
        if ($keuangan) {
            $softdelete = [
                'id_laporan' => $id,
                'softdelete' => 'yes'
            ];
            if ($this->keuangan->save($softdelete)) {
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
                        'activity' => 'Menghapus Laporan Keuangan ' . $keuangan[0]['judul_laporan'],
                        'jenis_data' => 'Laporan Keuangan',
                        'jabatan' => session()->get('jabatan'),
                        'angkatan' => session()->get('angkatanapp')
                    ]);
                }
                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'keuangan tidak ditemukan']);
        }
    }
    public function restore($id = null)
    {
        if ($this->keuangan->getLaporanById($id)) {
            $softdelete = [
                'id_laporan' => $id,
                'softdelete' => 'no'
            ];
            if ($this->keuangan->save($softdelete)) {
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
            return $this->fail(['message' => 'keuangan tidak ditemukan']);
        }
    }
    public function deleteData()
    {
        $keuangan = $this->keuangan->getLaporanById($this->request->getVar('id'));
        if ($keuangan) {
            if ($this->keuangan->delete($this->request->getVar('id'))) {
                $data = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil dihapus'
                    ]
                ];

                // hapus gambar
                unlink('data/keuangan/' . $keuangan[0]['file']);

                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'keuangan tidak ditemukan']);
        }
    }
}
