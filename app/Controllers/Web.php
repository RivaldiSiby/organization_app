<?php

namespace App\Controllers;

use App\Models\WebModel;
use CodeIgniter\RESTful\ResourceController;

class Web extends ResourceController
{
    protected $web;

    public function __construct()
    {
        session();
        $this->web = new WebModel();
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
        $rules = [

            'slide1' => [
                'rules' => 'uploaded[slide1]|is_image[slide1]|mime_in[slide1,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Gambar slide1 tidak boleh kosong',
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar'
                ]
            ],
            'slide2' => [
                'rules' => 'uploaded[slide2]|is_image[slide2]|mime_in[slide2,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Gambar slide2 tidak boleh kosong',
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar'
                ]
            ],
            'slide3' => [
                'rules' => 'uploaded[slide3]|is_image[slide3]|mime_in[slide3,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Gambar slide3 tidak boleh kosong',
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar'
                ]
            ],
            'slide4' => [
                'rules' => 'is_image[slide4]|mime_in[slide4,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar'
                ]
            ],
            'slide5' => [
                'rules' => 'is_image[slide5]|mime_in[slide5,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar'
                ]
            ],
            'bglogin' => [
                'rules' => 'is_image[bglogin]|mime_in[bglogin,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_in' => 'yang anda upload bukan gambar'
                ]
            ],
        ];
        if (!$this->validate($rules)) {
            $data = [
                'status' => 400,
                'error' => true,
                'token' => csrf_field(),
                'messages' => [
                    'slide1' => $this->validation->getError('slide1'),
                    'slide2' => $this->validation->getError('slide2'),
                    'slide3' => $this->validation->getError('slide3'),
                    'slide4' => $this->validation->getError('slide4'),
                    'slide5' => $this->validation->getError('slide5'),
                    'bglogin' => $this->validation->getError('bglogin'),
                ]
            ];
            return $this->respond($data);
        }
        // kelola slide1
        $fileslide1 = $this->request->getFile('slide1');
        $slide1 = $fileslide1->getRandomName();
        $fileslide1->move('data/organisasi/slide', $slide1);
        session()->set('slide1app', $slide1);

        // kelola slide2
        $fileslide2 = $this->request->getFile('slide2');
        $slide2 = $fileslide2->getRandomName();
        $fileslide2->move('data/organisasi/slide', $slide2);
        session()->set('slide2app', $slide2);

        // kelola slide3
        $fileslide3 = $this->request->getFile('slide3');
        $slide3 = $fileslide3->getRandomName();
        $fileslide3->move('data/organisasi/slide', $slide3);
        session()->set('slide3app', $slide3);

        if ($this->request->getFile('slide4')->getFilename()) {
            // kelola slide4 jika ada
            $fileslide4 = $this->request->getFile('slide4');
            $slide4 = $fileslide4->getRandomName();
            $fileslide4->move('data/organisasi/slide', $slide4);
            session()->set('slide4app', $slide4);
        }

        if ($this->request->getFile('slide5')->getFilename()) {
            // kelola slide5 jika ada
            $fileslide5 = $this->request->getFile('slide5');
            $slide5 = $fileslide5->getRandomName();
            $fileslide5->move('data/organisasi/slide', $slide5);
            session()->set('slide5app', $slide5);
        }
        if ($this->request->getFile('bglogin')->getFilename()) {
            // kelola bglogin jika ada
            $filebglogin = $this->request->getFile('bglogin');
            $bglogin = $filebglogin->getRandomName();
            $filebglogin->move('data/organisasi/background', $bglogin);
            session()->set('imgbg', $bglogin);
        }

        // simpan data pada data base
        $simpan = [
            'template' => $this->request->getVar('template'),
            'color' => $this->request->getVar('color'),
            'font' => $this->request->getVar('font'),
            'slide1' => $slide1,
            'slide2' => $slide2,
            'slide3' => $slide3,
        ];

        if ($this->request->getFile('slide4')->getFilename()) {
            $simpan['slide4'] = $slide4;
        }
        if ($this->request->getFile('slide5')->getFilename()) {
            $simpan['slide5'] = $slide5;
        }
        if ($this->request->getFile('bglogin')->getFilename()) {
            $simpan['bglogin'] = $bglogin;
        }

        if ($this->web->save($simpan)) {
            $data = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data Berhasil ditambahkan'
                ]
            ];

            $sesi = [
                'template' => $this->request->getVar('template'),
                'color' => $this->request->getVar('color'),
                'font' => $this->request->getVar('font'),
            ];

            // buat sesi tampilan website 
            session()->set($sesi);

            return $this->respond($data);
        }
    }
    public function updateData()
    {
        $web = $this->web->getWeb();
        if ($web) {
            $rules = [

                'slide1' => [
                    'rules' => 'is_image[slide1]|mime_in[slide1,image/jpg,image/jpeg,image/png]',
                    'errors' => [

                        'is_image' => 'yang anda upload bukan gambar',
                        'mime_in' => 'yang anda upload bukan gambar'
                    ]
                ],
                'slide2' => [
                    'rules' => 'is_image[slide2]|mime_in[slide2,image/jpg,image/jpeg,image/png]',
                    'errors' => [

                        'is_image' => 'yang anda upload bukan gambar',
                        'mime_in' => 'yang anda upload bukan gambar'
                    ]
                ],
                'slide3' => [
                    'rules' => 'is_image[slide3]|mime_in[slide3,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'uploaded' => 'Gambar slide3 tidak boleh kosong',
                        'is_image' => 'yang anda upload bukan gambar',
                        'mime_in' => 'yang anda upload bukan gambar'
                    ]
                ],
                'slide4' => [
                    'rules' => 'is_image[slide4]|mime_in[slide4,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'is_image' => 'yang anda upload bukan gambar',
                        'mime_in' => 'yang anda upload bukan gambar'
                    ]
                ],
                'slide5' => [
                    'rules' => 'is_image[slide5]|mime_in[slide5,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'is_image' => 'yang anda upload bukan gambar',
                        'mime_in' => 'yang anda upload bukan gambar'
                    ]
                ],
                'bglogin' => [
                    'rules' => 'is_image[bglogin]|mime_in[bglogin,image/jpg,image/jpeg,image/png]',
                    'errors' => [
                        'is_image' => 'yang anda upload bukan gambar',
                        'mime_in' => 'yang anda upload bukan gambar'
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                $data = [
                    'status' => 400,
                    'error' => true,
                    'token' => csrf_field(),
                    'messages' => [
                        'slide1' => $this->validation->getError('slide1'),
                        'slide2' => $this->validation->getError('slide2'),
                        'slide3' => $this->validation->getError('slide3'),
                        'slide4' => $this->validation->getError('slide4'),
                        'slide5' => $this->validation->getError('slide5'),
                        'bglogin' => $this->validation->getError('bglogin'),
                    ]
                ];
                return $this->respond($data);
            }
            if ($this->request->getFile('slide1')->getFilename()) {
                // kelola slide1
                $fileslide1 = $this->request->getFile('slide1');
                $slide1 = $fileslide1->getRandomName();
                $fileslide1->move('data/organisasi/slide', $slide1);
                session()->set('slide1app', $slide1);

                if ($web[0]['slide1'] != '') {
                    unlink('data/organisasi/slide/' . $web[0]['slide1']);
                }
            }

            if ($this->request->getFile('slide2')->getFilename()) {
                // kelola slide2
                $fileslide2 = $this->request->getFile('slide2');
                $slide2 = $fileslide2->getRandomName();
                $fileslide2->move('data/organisasi/slide', $slide2);
                session()->set('slide2app', $slide2);

                if ($web[0]['slide2'] != '') {
                    unlink('data/organisasi/slide/' . $web[0]['slide2']);
                }
            }

            if ($this->request->getFile('slide3')->getFilename()) {
                // kelola slide3
                $fileslide3 = $this->request->getFile('slide3');
                $slide3 = $fileslide3->getRandomName();
                $fileslide3->move('data/organisasi/slide', $slide3);
                session()->set('slide3app', $slide3);

                if ($web[0]['slide3'] != '') {
                    unlink('data/organisasi/slide/' . $web[0]['slide3']);
                }
            }

            if ($this->request->getFile('slide4')->getFilename()) {
                // kelola slide4 jika ada
                $fileslide4 = $this->request->getFile('slide4');
                $slide4 = $fileslide4->getRandomName();
                $fileslide4->move('data/organisasi/slide', $slide4);
                session()->set('slide4app', $slide4);

                if ($web[0]['slide4'] != '') {
                    unlink('data/organisasi/slide/' . $web[0]['slide4']);
                }
            }

            if ($this->request->getFile('slide5')->getFilename()) {
                // kelola slide5 jika ada
                $fileslide5 = $this->request->getFile('slide5');
                $slide5 = $fileslide5->getRandomName();
                $fileslide5->move('data/organisasi/slide', $slide5);
                session()->set('slide5app', $slide5);

                if ($web[0]['slide5'] != '') {
                    unlink('data/organisasi/slide/' . $web[0]['slide5']);
                }
            }
            if ($this->request->getFile('bglogin')->getFilename()) {
                // kelola bglogin jika ada
                $filebglogin = $this->request->getFile('bglogin');
                $bglogin = $filebglogin->getRandomName();
                $filebglogin->move('data/organisasi/background', $bglogin);
                session()->set('imgbg', $bglogin);

                // hapus gambar lama
                if ($web[0]['background_login'] != '') {
                    unlink('data/organisasi/background/' . $web[0]['background_login']);
                }
            }


            // simpan data pada data base
            $simpan = [
                'id_web' => $this->request->getVar('id_web'),
                'template' => $this->request->getVar('template'),
                'color' => $this->request->getVar('color'),
                'font' => $this->request->getVar('font'),
            ];

            if ($this->request->getFile('slide1')->getFilename()) {
                $simpan['slide1'] = $slide1;
            }
            if ($this->request->getFile('slide2')->getFilename()) {
                $simpan['slide2'] = $slide2;
            }
            if ($this->request->getFile('slide3')->getFilename()) {
                $simpan['slide3'] = $slide3;
            }
            if ($this->request->getFile('slide4')->getFilename()) {
                $simpan['slide4'] = $slide4;
            }
            if ($this->request->getFile('slide5')->getFilename()) {
                $simpan['slide5'] = $slide5;
            }
            if ($this->request->getFile('bglogin')->getFilename()) {
                $simpan['bglogin'] = $bglogin;
            }

            if ($this->web->save($simpan)) {
                $data = [
                    'status' => 201,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data Berhasil Diperbaharui'
                    ]
                ];

                $sesi = [
                    'template' => $this->request->getVar('template'),
                    'color' => $this->request->getVar('color'),
                    'font' => $this->request->getVar('font'),
                ];


                // buat sesi tampilan website 
                session()->set($sesi);

                return $this->respond($data);
            }
        } else {
            return $this->fail(['message' => 'Data Berhasil Diperbaharui']);
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
}
