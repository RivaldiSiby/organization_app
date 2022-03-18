<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\BidangModel;
use App\Models\MemberModel;
use App\Models\ModeratorModel;

class Otentikasi extends BaseController
{
    protected $admin;
    protected $member;
    protected $moderator;
    protected $bidang;
    public function __construct()
    {
        session();
        $this->admin = new AdminModel();
        $this->member = new MemberModel();
        $this->moderator = new ModeratorModel();
        $this->bidang = new BidangModel();
    }
    public function index()
    {
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Tidak Boleh Kosong'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password Tidak Boleh Kosong'
                ]
            ],
        ];
        if (!$this->validate($rules)) {
            session()->setFlashdata('fail', 'Proses Login Gagal');
            return redirect()->to(base_url('/login'))->withInput();
        }

        // cek user admin
        $admin = $this->admin->getAdminByName($this->request->getVar('nama'));
        // cek user members
        $member = $this->member->getMemberByName($this->request->getVar('nama'));

        if ($admin) {
            // cek pass 
            if (password_verify($this->request->getVar('password'), $admin[0]['password'])) {
                $session = [
                    'nama' => $admin[0]['nama'],
                    'level' => 'admin',
                ];
                session()->set($session);
                session()->setFlashdata('login', 'Berhasil Login dengan Aman');


                return redirect()->to(base_url('/dashboard'));
            } else {
                session()->setFlashdata('failpass', 'Password yang dimasukan salah');
                return redirect()->to(base_url('/login'))->withInput();
            }
        } else if ($member) {
            // cek pass 
            if (password_verify($this->request->getVar('password'), $member[0]['password'])) {
                $session = [
                    'nama' => $member[0]['nama'],
                    'id' => $member[0]['id_member'],
                    'level' => 'member',
                    'jabatan' => $member[0]['jabatan'],
                    'profile' => $member[0]['foto']
                ];

                // cek jabatan dan buat sesi
                $jabatan = $this->moderator->getModeratorByName($member[0]['jabatan']);
                $bidang = $this->bidang->getBidangByName($member[0]['jabatan']);
                // cek jabatan member
                if (count($jabatan) > 0) {
                    // buat sesi jabatan
                    $fitur = explode(',', $jabatan[0]['rules']);
                    foreach ($fitur as $data) {
                        if ($data == 'Mengatur Arsip Surat') {
                            $session['mastersurat'] = true;
                        }
                        if ($data == 'Mengatur Master Member') {
                            $session['mastermember'] = true;
                        }
                        if ($data == 'Mengatur Postingan') {
                            $session['masterpostingan'] = true;
                        }
                        if ($data == 'Mengatur Arsip Laporan Keuangan') {
                            $session['masterkeuangan'] = true;
                        }
                        if ($data == 'Mengatur Bidang Organisasi') {
                            $session['masterbidang'] = true;
                        }
                        if ($data == 'Mengatur Jabatan Organisasi') {
                            $session['masterjabatan'] = true;
                        }
                        if ($data == 'Mengatur Kegiatan Organisasi') {
                            $session['masterkegiatan'] = true;
                        }
                    }
                } elseif (count($bidang) > 0) {
                    $session[$bidang[0]['bidang']] = true;
                }

                session()->set($session);
                session()->setFlashdata('login', 'Berhasil Login dengan Aman');

                return redirect()->to(base_url('/dashboard'));
            } else {
                session()->setFlashdata('failpass', 'Password yang dimasukan salah');
                return redirect()->to(base_url('/login'))->withInput();
            }
        } else {
            session()->setFlashdata('failnama', 'Nama Tidak Terdaftar sebagai Member');
            return redirect()->to(base_url('/login'));
        }
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
