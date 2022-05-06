<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\ModeratorModel;
use App\Models\OrganisasiModel;
use App\Models\WebModel;
use CodeIgniter\RESTful\ResourceController;

class Organisasi extends ResourceController
{
    protected $organisasi;
    protected $admin;
    protected $moderator;
    protected $web;

    public function __construct()
    {
        session();
        $this->organisasi = new OrganisasiModel();
        $this->admin = new AdminModel();
        $this->moderator = new ModeratorModel();
        $this->web = new WebModel();
        $this->validation = \Config\Services::validation();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $organisasi = $this->organisasi->getOrganisasi();
        $admin = $this->admin->getAdminByName(session()->get('nama'));
        $admin = $admin[0];
        $web = $this->web->getWeb();
        $dataorganisasi = [
            'organisasi' => $organisasi,
            'admin' => $admin,
            'web' => $web,
            'moderator' => $this->moderator->getModerator(),
            'validation' => \Config\Services::validation(),
        ];
        if ($web) {
            $dataorganisasi['web'] = $web[0];
        }
        // cek data organisasi sudah ada atau belum
        if (count($organisasi) > 0) {
            if (session()->get('appkey') == true) {
                $data = view('organisasi/view', $dataorganisasi);
            } else {
                $data = view('admin/lock', $dataorganisasi);
            }
        } else {
            if (session()->get('appkey') == true) {
                $data = view('organisasi/index', $dataorganisasi);
            } else {
                $data = view('admin/lock', $dataorganisasi);
            }
        }

        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $organisasi = $this->organisasi->getOrganisasiById($id);
        if ($organisasi) {
            $dataorganisasi = [
                'organisasi' => $organisasi,
                'web'       => $this->web->getWeb(),
                'moderator' => $this->moderator->getModerator(),
                'validation' => \Config\Services::validation(),
            ];
            $data = view('organisasi/edit', $dataorganisasi);
            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'Data tidak ditemukan']);
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
            'struktur' => [
                'rules' => 'uploaded[struktur]|max_size[struktur,1024]|is_image[struktur]|mime_in[struktur,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Gambar Struktur Organisasi tidak boleh kosong',
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1mb',
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar'
                ]
            ],
            'logo' => [
                'rules' => 'uploaded[logo]|max_size[logo,1024]|is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Gambar logo tidak boleh kosong',
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1mb',
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar'
                ]
            ],
            'icon' => [
                'rules' => 'uploaded[icon]|max_size[icon,1024]|is_image[icon]|mime_in[icon,image/x-icon,image/vnd.microsoft.icon,image/ico,image/icon]',
                'errors' => [
                    'uploaded' => 'Gambar icon tidak boleh kosong',
                    'max_size' => 'Ukuran gambar tidak boleh lebih dari 1mb',
                    'is_image' => 'yang anda upload bukan berformat gambar',
                    'mime_in' => 'yang anda upload bukan berformat .ico'
                ]
            ],

        ];
        if (!$this->validate($rules)) {
            $data = [
                'status' => 400,
                'error' => true,
                'token' => csrf_field(),
                'messages' => [
                    'struktur' => $this->validation->getError('struktur'),
                    'logo' => $this->validation->getError('logo'),
                    'icon' => $this->validation->getError('icon'),

                ]
            ];
            return $this->respond($data);
        }
        // kelola gambar struktur
        $filestruktur = $this->request->getFile('struktur');
        $struktur = $filestruktur->getRandomName();
        $filestruktur->move('data/organisasi/struktur', $struktur);
        session()->set('strukturapp', $struktur);
        // kelola gambar logo
        $filelogo = $this->request->getFile('logo');
        $logo = $filelogo->getRandomName();
        $filelogo->move('data/organisasi/logo', $logo);
        session()->set('logoapp', $logo);
        // kelola gambar icon
        $fileicon = $this->request->getFile('icon');
        $icon = $fileicon->getRandomName();
        $fileicon->move('data/organisasi/icon', $icon);
        session()->set('iconapp', $icon);


        $simpan = [
            'nama_organisasi' => $this->request->getVar('nama_organisasi'),
            'singkatan' => $this->request->getVar('singkatan'),
            'sejarah' => $this->request->getVar('sejarah'),
            'visi_misi' => $this->request->getVar('visi_misi'),
            'angkatan' => $this->request->getVar('angkatan'),
            'tentang' => $this->request->getVar('tentang'),
            'moderator_utama' => $this->request->getVar('moderator_utama'),
            'wa' => $this->request->getVar('wa'),
            'fb' => $this->request->getVar('fb'),
            'ig' => $this->request->getVar('ig'),
            'email' => $this->request->getVar('email'),
            'struktur' => $struktur,
            'logo' => $logo,
            'icon' => $icon,

        ];
        if ($this->organisasi->save($simpan)) {
            $data = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data Berhasil ditambahkan'
                ]
            ];

            session()->set('angkatanapp', $this->request->getVar('angkatan'));
            session()->set('nameapp', $this->request->getVar('nama_organisasi'));
            session()->set('tagapp', $this->request->getVar('singkatan'));


            return $this->respond($data);
        } else {
            return $this->fail(['message' => 'Data Gagal ditambahkan']);
        }
    }
    public function updateData()
    {

        $organisasi = $this->organisasi->getOrganisasiById($this->request->getVar('id_organisasi'));
        if ($organisasi) {
            $rules = [];
            // cek validasi gambar

            if ($this->request->getFile('struktur')->getFilename() != "") {
                $rules['struktur'] = [
                    'rules' => 'max_size[struktur,1024]|is_image[struktur]|mime_in[struktur,image/jpg,image/jpeg,image/png]',
                    'errors' => [

                        'max_size' => 'Ukuran gambar tidak boleh lebih dari 1mb',
                        'is_image' => 'yang anda upload bukan gambar',
                        'mime_in' => 'yang anda upload bukan gambar'
                    ]
                ];
            }

            if ($this->request->getFile('logo')->getFilename() != "") {
                $rules['logo'] = [
                    'rules' => 'max_size[logo,1024]|is_image[logo]|mime_in[logo,image/jpg,image/jpeg,image/png]',
                    'errors' => [

                        'max_size' => 'Ukuran gambar tidak boleh lebih dari 1mb',
                        'is_image' => 'yang anda upload bukan gambar',
                        'mime_in' => 'yang anda upload bukan gambar'
                    ]
                ];
            }
            if ($this->request->getFile('icon')->getFilename() != "") {
                $rules['icon'] = [
                    'rules' => 'max_size[icon,1024]|is_image[icon]|mime_in[icon,image/x-icon,image/vnd.microsoft.icon,image/ico,image/icon]',
                    'errors' => [
                        'max_size' => 'Ukuran gambar tidak boleh lebih dari 1mb',
                        'is_image' => 'yang anda upload bukan berformat gambar',
                        'mime_in' => 'yang anda upload bukan berformat .ico'
                    ]
                ];
            }



            // cek ketika rules kosong atau tidak
            if (count($rules) > 0) {
                if (!$this->validate($rules)) {
                    $data = [
                        'status' => 400,
                        'error' => true,
                        'token' => csrf_field(),
                        'messages' => [
                            'struktur' => $this->validation->getError('struktur'),
                            'logo' => $this->validation->getError('logo'),
                            'icon' => $this->validation->getError('icon'),

                        ]
                    ];
                    return $this->respond($data);
                }
            }



            // cek dan kelola gambar
            if ($this->request->getFile('struktur')->getFilename() != "") {
                // kelola gambar struktur

                $filestruktur = $this->request->getFile('struktur');
                $struktur = $filestruktur->getRandomName();
                $filestruktur->move('data/organisasi/struktur', $struktur);
                // hapus gambar lama
                if ($organisasi[0]['struktur'] != '') {
                    unlink('data/organisasi/struktur/' . $organisasi[0]['struktur']);
                }
            }

            if ($this->request->getFile('logo')->getFilename() != "") {
                // kelola gambar logo

                $filelogo = $this->request->getFile('logo');
                $logo = $filelogo->getRandomName();
                $filelogo->move('data/organisasi/logo', $logo);
                // hapus gambar lama
                if ($organisasi[0]['logo'] != '') {
                    unlink('data/organisasi/logo/' . $organisasi[0]['logo']);
                }
            }
            if ($this->request->getFile('icon')->getFilename() != "") {
                // kelola gambar icon

                $fileicon = $this->request->getFile('icon');
                $icon = $fileicon->getRandomName();
                $fileicon->move('data/organisasi/icon', $icon);
                // hapus gambar lama
                if ($organisasi[0]['icon'] != '') {
                    unlink('data/organisasi/icon/' . $organisasi[0]['icon']);
                }
            }




            $simpan = [
                'id_organisasi' => $this->request->getVar('id_organisasi'),
                'nama_organisasi' => $this->request->getVar('nama_organisasi'),
                'singkatan' => $this->request->getVar('singkatan'),
                'sejarah' => $this->request->getVar('sejarah'),
                'visi_misi' => $this->request->getVar('visi_misi'),
                'angkatan' => $this->request->getVar('angkatan'),
                'tentang' => $this->request->getVar('tentang'),
                'moderator_utama' => $this->request->getVar('moderator_utama'),
                'wa' => $this->request->getVar('wa'),
                'fb' => $this->request->getVar('fb'),
                'ig' => $this->request->getVar('ig'),
                'email' => $this->request->getVar('email'),
            ];

            if ($this->request->getFile('struktur')->getFilename() != "") {
                $simpan['struktur'] = $struktur;
                session()->set('strukturapp', $struktur);
            }
            if ($this->request->getFile('logo')->getFilename() != "") {
                $simpan['logo'] = $logo;
                session()->set('logoapp', $logo);
            }
            if ($this->request->getFile('icon')->getFilename() != "") {
                $simpan['icon'] = $icon;
                session()->set('iconapp', $icon);
            }

            if ($this->organisasi->save($simpan)) {
                $data = [
                    'status' => 201,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil diUbah'
                    ]
                ];
                // Set sesi nama dan angkatan
                session()->set('angkatanapp', $this->request->getVar('angkatan'));
                session()->set('nameapp', $this->request->getVar('nama_organisasi'));
                session()->set('tagapp', $this->request->getVar('singkatan'));
                // Set sesi nama dan angkatan

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
        $organisasi = $this->organisasi->getOrganisasiById($this->request->getVar('id'));
        if ($organisasi) {
            // hapus gambar dari data organisasi

            unlink('data/organisasi/logo/' . $organisasi[0]['logo']);
            unlink('data/organisasi/struktur/' . $organisasi[0]['struktur']);

            if ($this->organisasi->delete($this->request->getVar('id'))) {
                $data = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil dihapus'
                    ]
                ];
                // atur sesi baru
                session()->set('nameapp', 'Organization-App');
                session()->set('tagapp', 'Organization-App');
                session()->set('logoapp', 'iconapp.jpg');
                session()->set('strukturapp', '');

                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'Organiasi tidak ditemukan']);
        }
    }
}
