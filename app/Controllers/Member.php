<?php

namespace App\Controllers;

use App\Models\BidangModel;
use App\Models\LogModel;
use App\Models\MemberModel;
use App\Models\ModeratorModel;
use CodeIgniter\RESTful\ResourceController;

class Member extends ResourceController
{
    protected $member;
    protected $moderator;
    protected $validation;
    protected $log;
    protected $bidang;
    public function __construct()
    {
        session();
        $this->log = new LogModel();
        $this->member = new MemberModel();
        $this->moderator = new ModeratorModel();
        $this->bidang = new BidangModel();
        $this->validation = \Config\Services::validation();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $datamember = [
            'member' => $this->member->getMemberAll()
        ];
        $data = view('member/index', $datamember);
        return $this->respond($data);
    }
    // publik akses
    public function public()
    {
        $datamember = [
            'member' => $this->member->getMemberAll(),
        ];
        $data = view('member/index', $datamember);
        return $this->respond($data);
    }
    // publik akses
    public function add()
    {
        $add = [
            'validation' => \Config\Services::validation(),
            'moderator' => $this->moderator->getModerator(),
            'bidang' => $this->bidang->getBidang()
        ];
        $data = view('member/add', $add);
        return $this->respond($data);
    }

    public function backup()
    {
        $datamember = [
            'member' => $this->member->getMemberAllBackup(),
            'backup' => true
        ];
        $data = view('member/index', $datamember);
        return $this->respond($data);
    }
    public function clear()
    {
        $member = $this->member->getMemberAllBackup();

        // looping dan hapus semua data 
        foreach ($member as $data) {
            // hapus gambar/file
            unlink('data/member/img/' . $data['foto']);
            $this->member->delete($data['id_member']);
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
        $member = $this->member->getMemberById($id);
        if ($member) {
            $datas = [
                'member' => $member[0],
                'moderator' => $this->moderator->getModerator(),
                'bidang' => $this->bidang->getBidang()
            ];
            $data = view('member/edit', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'member tidak ditemukan']);
        }
    }

    public function pengaturan($id)
    {

        $member = $this->member->getMemberById($id);
        if ($member) {
            $datas = [
                'member' => $member[0],
            ];
            $data = view('member/setting', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'member tidak ditemukan']);
        }
    }

    public function position($id)
    {
        $member = $this->member->getMemberById($id);
        if ($member) {
            $datas = [
                'member' => $member[0],
                'moderator' => $this->moderator->getModerator(),
                'bidang' => $this->bidang->getBidang()
            ];
            $data = view('member/position', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'member tidak ditemukan']);
        }
    }


    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $member = $this->member->getMemberById($id);
        if ($member) {
            $datas = [
                'member' => $member[0],
            ];
            $data = view('member/view', $datas);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'member tidak ditemukan']);
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
        // simpan data
        $simpan = [
            'nama' => $this->request->getVar('nama'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir' => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'angkatan' => $this->request->getVar('angkatan'),
            'alamat' => $this->request->getVar('alamat'),
            'kta' => $this->request->getVar('kta'),
            'jabatan' => $this->request->getVar('jabatan'),

        ];
        if ($this->request->getFile('foto')->getFilename() != '') {
            $rules = [
                'foto' => [
                    'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar tidak boleh lebih dari 1mb',
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
                    'messages' => $this->validation->getError('foto')
                ];
                return $this->respond($data);
            }

            // kelola gambar
            $file = $this->request->getFile('foto');
            $foto = $file->getRandomName();
            $file->move('data/member/img', $foto);
            // masukan nam foto jika ada
            if ($this->request->getFile('foto')->getFilename() != '') {
                $simpan['foto'] = $foto;
            }
        }




        if ($this->member->save($simpan)) {
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
                    'activity' => 'Menambahkan Member ' . $this->request->getVar('nama'),
                    'jenis_data' => 'Member',
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
        $memberdata = $this->member->getMemberById($this->request->getVar('id_member'));
        if ($memberdata) {

            if ($this->request->getFile('foto')) {
                $rules = [
                    'foto' => [
                        'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'max_size' => 'Ukuran gambar tidak boleh lebih dari 1mb',
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
                        'messages' => $this->validation->getError('foto')
                    ];
                    return $this->respond($data);
                }
                // kelola gambar

                if ($memberdata[0]['foto'] != '') {
                    // hapus gambar lama
                    unlink('data/member/img/' . $memberdata[0]['foto']);
                }

                // tambah gambar baru
                $file = $this->request->getFile('foto');
                $foto = $file->getRandomName();
                $file->move('data/member/img', $foto);

                // simpan
                $simpan = [
                    'id_member' => $this->request->getVar('id_member'),
                    'nama' => $this->request->getVar('nama'),
                    'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                    'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                    'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                    'angkatan' => $this->request->getVar('angkatan'),
                    'alamat' => $this->request->getVar('alamat'),
                    'kta' => $this->request->getVar('kta'),
                    'foto' => $foto,
                    'jabatan' => $this->request->getVar('jabatan'),

                ];
            } else {
                // simpan
                $simpan = [
                    'id_member' => $this->request->getVar('id_member'),
                    'nama' => $this->request->getVar('nama'),
                    'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                    'tempat_lahir' => $this->request->getVar('tempat_lahir'),
                    'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
                    'angkatan' => $this->request->getVar('angkatan'),
                    'alamat' => $this->request->getVar('alamat'),
                    'kta' => $this->request->getVar('kta'),
                    'jabatan' => $this->request->getVar('jabatan'),

                ];
            }
            // tambahkan password ketika variable password ada 
            if ($this->request->getVar('password')) {
                $simpan['password'] = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
            }
            if ($this->member->save($simpan)) {
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
                        'activity' => 'Mengubah Member ' . $this->request->getVar('nama'),
                        'jenis_data' => 'Member',
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

    public function profile()
    {
        $profile = $this->member->getMemberById(session()->get('id'));
        if ($profile) {
            $update = [
                'id_member' => $profile[0]['id_member'],
                'nama' => $this->request->getVar('nama'),

            ];
            if ($this->request->getFile('foto')->getFilename() != '') {
                $rules = [
                    'foto' => [
                        'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                        'errors' => [
                            'max_size' => 'Ukuran gambar tidak boleh lebih dari 1mb',
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
                        'messages' => $this->validation->getError('foto')
                    ];
                    return $this->respond($data);
                }

                if ($profile[0]['foto'] != '') {
                    // hapus gambar lama
                    unlink('data/member/img/' . $profile[0]['foto']);
                }

                // kelola gambar
                $file = $this->request->getFile('foto');
                $foto = $file->getRandomName();
                $file->move('data/member/img', $foto);

                // masuka nam foto jika ada
                if ($this->request->getFile('foto')->getFilename() != '') {
                    $update['foto'] = $foto;
                }
            }

            // jika password diganti maka update passowrd baru
            if ($this->request->getVar('password')) {
                $update['password'] = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
            }


            // simpan perubahan
            if ($this->member->save($update)) {
                $data = [
                    'status' => 201,
                    'error' => null,
                    'messages' => [
                        'success' => 'Profile Berhasil diPerbaharui'
                    ]
                ];

                // atur sesi ketika merubah data 
                session()->set('nama', $this->request->getVar('nama'));
                session()->set('profile', $foto);

                return $this->respond($data);
            } else {
                return $this->fail(['message' => 'Profile Gagal diPerbaharui']);
            }
        } else {
            return $this->fail(['message' => 'Profile Gagal diPerbaharui']);
        }
    }

    public function updatePosition()
    {
        $memberdata = $this->member->getMemberById($this->request->getVar('id'));
        if ($memberdata) {
            $simpan = [
                'id_member' => $this->request->getVar('id'),
                'jabatan' => $this->request->getVar('jabatan')
            ];
            if ($this->member->save($simpan)) {
                $data = [
                    'status' => 201,
                    'error' => null,
                    'messages' => [
                        'success' => 'Jabatan ' . $memberdata[0]['nama'] . ' Berhasil diAtur menjadi ' . $this->request->getVar('jabatan')
                    ]
                ];
                if (session()->get('level') != 'admin') {
                    // tambah log
                    $this->log->save([
                        'activity' => 'Mengatur Jabatan Member ' . $memberdata[0]['nama'] . ' Menjadi ' . $this->request->getVar('jabatan'),
                        'jenis_data' => 'Member',
                        'jabatan' => session()->get('jabatan'),
                        'angkatan' => session()->get('angkatanapp')
                    ]);
                }
                return $this->respond($data);
            } else {
                return $this->fail(['message' => 'Jabatan Gagal diAtur']);
            }
        } else {
            return $this->fail(['message' => 'Jabatan Gagal diAtur']);
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
    public function restore($id = null)
    {
        if ($this->member->getMemberById($id)) {
            $softdelete = [
                'id_member' => $id,
                'softdelete' => 'no'
            ];
            if ($this->member->save($softdelete)) {
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
            return $this->fail(['message' => 'Member tidak ditemukan']);
        }
    }
    public function softdelete($id = null)
    {
        $member = $this->member->getMemberById($id);
        if ($member) {
            $softdelete = [
                'id_member' => $id,
                'softdelete' => 'yes'
            ];
            if ($this->member->save($softdelete)) {
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
                        'activity' => 'Menghapus Member ' . $member[0]['nama'],
                        'jenis_data' => 'Member',
                        'jabatan' => session()->get('jabatan'),
                        'angkatan' => session()->get('angkatanapp')
                    ]);
                }
                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'Member tidak ditemukan']);
        }
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
        $member = $this->member->getMemberById($this->request->getVar('id'));
        if ($member) {
            if ($this->member->delete($this->request->getVar('id'))) {
                $data = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil dihapus'
                    ]
                ];

                // hapus gambar
                unlink('data/member/img/' . $member[0]['foto']);

                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'member tidak ditemukan']);
        }
    }
}
