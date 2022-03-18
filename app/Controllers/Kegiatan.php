<?php

namespace App\Controllers;

use App\Models\KegiatanModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\I18n\Time;

class Kegiatan extends ResourceController
{
    protected $kegiatan;
    public function __construct()
    {
        session();
        $this->kegiatan = new KegiatanModel();
        $this->myTime = new Time('now', 'Asia/Makassar', 'en_US');
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $datakegiatan = [
            'kegiatan' => $this->kegiatan->getKegiatan()
        ];
        $data = view('kegiatan/index', $datakegiatan);
        return $this->respond($data);
    }

    public function public()
    {
        $datakegiatan = [
            'kegiatan' => $this->kegiatan->getKegiatan()
        ];
        if (session()->get('jabatan') != 'Member') {
            $data = view('kegiatan/index', $datakegiatan);
        } else {
            $datakegiatan['time'] = $this->myTime->now();
            $data = view('kegiatan/public', $datakegiatan);
        }
        return $this->respond($data);
    }

    public function backup()
    {
        $datakegiatan = [
            'kegiatan' => $this->kegiatan->getKegiatanBackup(),
            'backup' => true
        ];
        $data = view('kegiatan/index', $datakegiatan);
        return $this->respond($data);
    }

    // bersihkan data
    public function clear()
    {
        $kegiatan = $this->kegiatan->getKegiatanBackup();

        // looping dan hapus semua data 
        foreach ($kegiatan as $data) {
            // hapus gambar/file
            if ($data['gambar'] != '') {
                unlink('data/kegiatan/' . $data['gambar']);
            }
            $this->kegiatan->delete($data['id_kegiatan']);
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


    public function add()
    {
        $add = [
            'validation' => \Config\Services::validation(),
        ];
        $data = view('kegiatan/add', $add);
        return $this->respond($data);
    }
    public function editData($id)
    {
        $kegiatan = $this->kegiatan->getKegiatanById($id);
        if ($kegiatan) {
            $datas = [
                'kegiatan' => $kegiatan[0],
            ];
            $data = view('kegiatan/edit', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'kegiatan tidak ditemukan']);
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $kegiatan = $this->kegiatan->getKegiatanById($id);
        if ($kegiatan) {
            $now = $this->myTime->now();
            if ($now->isBefore($kegiatan[0]['mulai_kegiatan'])) {
                $waktu = 'belum';
            } elseif ($now->isAfter($kegiatan[0]['selesai_kegiatan'])) {
                $waktu = 'selesai';
            } elseif ($now->isAfter($kegiatan[0]['mulai_kegiatan'])) {
                $waktu = 'dimulai';
            }

            $datas = [
                'kegiatan' => $kegiatan[0],
                'time' => $waktu,
            ];
            $data = view('kegiatan/view', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'kegiatan tidak ditemukan']);
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
            'kegiatan' => $this->request->getVar('kegiatan'),
            'pesan_kegiatan' => $this->request->getVar('pesan_kegiatan'),
            'angkatan' => $this->request->getVar('angkatan'),
            'ditujukan' => $this->request->getVar('ditujukan'),
            'mulai_kegiatan' => $this->request->getVar('mulai_kegiatan'),
            'selesai_kegiatan' => $this->request->getVar('selesai_kegiatan'),
        ];

        if ($this->request->getFile('file')->getFilename() != "") {
            // kelola gambar
            $file = $this->request->getFile('file');
            $files = $file->getRandomName();
            $file->move('data/kegiatan', $files);
            // masukan gambar
            $simpan['gambar'] = $files;
        }

        if ($this->kegiatan->save($simpan)) {
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
                    'activity' => 'Menambahkan Kegiatan ' . $this->request->getVar('kegiatan'),
                    'jenis_data' => 'Kegiatan',
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
        $kegiatan = $this->kegiatan->getKegiatanById($this->request->getVar('id_kegiatan'));
        if ($kegiatan) {
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
                'id_kegiatan' => $this->request->getVar('id_kegiatan'),
                'kegiatan' => $this->request->getVar('kegiatan'),
                'pesan_kegiatan' => $this->request->getVar('pesan_kegiatan'),
                'angkatan' => $this->request->getVar('angkatan'),
                'ditujukan' => $this->request->getVar('ditujukan'),
                'mulai_kegiatan' => $this->request->getVar('mulai_kegiatan'),
                'selesai_kegiatan' => $this->request->getVar('selesai_kegiatan'),
            ];

            if ($this->request->getFile('file')->getFilename() != "") {

                // kelola gambar
                $file = $this->request->getFile('file');
                $files = $file->getRandomName();
                $file->move('data/kegiatan', $files);
                // masukan gambar
                $simpan['gambar'] = $files;
                // hapus gambar lama jika ada
                if ($kegiatan[0]['gambar'] != '') {
                    unlink('data/kegiatan/' . $kegiatan[0]['gambar']);
                }
            }

            if ($this->kegiatan->save($simpan)) {
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
                        'activity' => 'Mengubah Kegiatan ' . $this->request->getVar('kegiatan'),
                        'jenis_data' => 'Kegiatan',
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
        $kegiatan = $this->kegiatan->getKegiatanById($id);
        if ($kegiatan) {
            $softdelete = [
                'id_kegiatan' => $id,
                'softdelete' => 'yes'
            ];
            if ($this->kegiatan->save($softdelete)) {
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
                        'activity' => 'Menghapus kegiatan ' . $kegiatan[0]['kegiatan'],
                        'jenis_data' => 'kegiatan',
                        'jabatan' => session()->get('jabatan'),
                        'angkatan' => session()->get('angkatanapp')
                    ]);
                }
                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'kegiatan tidak ditemukan']);
        }
    }
    public function restore($id = null)
    {
        if ($this->kegiatan->getKegiatanById($id)) {
            $softdelete = [
                'id_kegiatan' => $id,
                'softdelete' => 'no'
            ];
            if ($this->kegiatan->save($softdelete)) {
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
            return $this->fail(['message' => 'kegiatan tidak ditemukan']);
        }
    }

    public function deleteData()
    {
        $kegiatan = $this->kegiatan->getKegiatanById($this->request->getVar('id'));
        if ($kegiatan) {
            if ($this->kegiatan->delete($this->request->getVar('id'))) {
                $data = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil dihapus'
                    ]
                ];

                // hapus gambar
                if ($kegiatan[0]['gambar'] != '') {
                    unlink('data/kegiatan/' . $kegiatan[0]['gambar']);
                }

                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'kegiatan tidak ditemukan']);
        }
    }
}
