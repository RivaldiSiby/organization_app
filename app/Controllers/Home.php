<?php

namespace App\Controllers;

use App\Models\BidangModel;
use App\Models\MemberModel;
use App\Models\OrganisasiModel;
use App\Models\PostinganModel;
use App\Models\ProgramModel;
use App\Models\WebModel;

class Home extends BaseController
{
    protected $organisasi;
    protected $postingan;
    protected $bidang;
    protected $program;
    protected $member;
    protected $web;

    public function __construct()
    {
        $this->organisasi = new OrganisasiModel();
        $this->postingan = new PostinganModel();
        $this->bidang = new BidangModel();
        $this->program = new ProgramModel();
        $this->member = new MemberModel();
        $this->web = new WebModel();
        $home = $this->organisasi->getOrganisasi();
        $web = $this->web->getWeb();
        session();

        // atur Sesi Awal 
        if (count($home) > 0) {

            session()->set('nameapp', $home[0]['nama_organisasi']);
            session()->set('tagapp', $home[0]['singkatan']);
            session()->set('logoapp', $home[0]['logo']);
            session()->set('strukturapp', $home[0]['struktur']);
            session()->set('angkatanapp', $home[0]['angkatan']);

            if (count($web) > 0) {
                // website sesi
                session()->set('imgbg', $web[0]['bglogin']);
                session()->set('slide1app', $web[0]['slide1']);
                session()->set('slide2app', $web[0]['slide2']);
                session()->set('slide3app', $web[0]['slide3']);
                session()->set('slide4app', $web[0]['slide4']);
                session()->set('slide5app', $web[0]['slide5']);
                session()->set('template', $web[0]['template']);
                session()->set('color', $web[0]['color']);
                session()->set('font', $web[0]['font']);
                // website sesi
            }
        } else {
            session()->set('imgbg', '');
            session()->set('nameapp', 'Organization-App');
            session()->set('tagapp', 'Organization-App');
            session()->set('logoapp', 'iconapp.jpg');
            session()->set('strukturapp', '');
        }
    }
    public function index()
    {
        $web = $this->web->getWeb();
        $organisasi = $this->organisasi->getOrganisasi();
        // cek apakah data orgnasisasi sudah dimasukan
        if (count($organisasi) > 0 && count($web) > 0) {
            $datamode = explode(',', $organisasi[0]['moderator_utama']);
            $member = [];
            foreach ($datamode as $data) {
                $member["$data"] = $this->member->getMemberByJabatan($data);
            }
            $data = [
                'postingan' => $this->postingan->getPostinganNew(),
                'member' => $member
            ];
            if (session()->get('template') == 'Basic') {
                return view('template/basic/starterpage', $data);
            }
        } else {
            return redirect()->to(base_url('/login'));
        }
    }
    public function homeview()
    {
        $data = [
            'postingan' => $this->postingan->getPostinganNew()
        ];

        if (session()->get('template') == 'Basic') {
            return view('template/basic/index', $data);
        }
    }
    public function postingan()
    {
        $data = [
            'postingan' => $this->postingan->getPostinganPublik(),
            'postingannew' => $this->postingan->getPostinganNew()
        ];
        if (session()->get('template') == 'Basic') {
            return view('template/basic/postingan', $data);
        }
    }
    public function postinganview($id)
    {
        $postingan = $this->postingan->getPostinganById($id);
        if ($postingan) {
            $data = [
                'postingan' => $postingan[0]
            ];
            if (session()->get('template') == 'Basic') {
                return view('template/basic/view', $data);
            }
        } else {
            $data = view('errors/notfound');
            return $data;
        }
    }
    public function program()
    {
        $data = [
            'program' => $this->program->getProgram(),
            'bidang' => $this->bidang->getBidang(),
        ];
        if (session()->get('template') == 'Basic') {
            return view('template/basic/program', $data);
        }
    }
    public function history()
    {
        $data = [
            'organisasi' => $this->organisasi->getOrganisasi()
        ];
        if (session()->get('template') == 'Basic') {
            return view('template/basic/history', $data);
        }
    }
    public function struktur()
    {
        $data = [
            'organisasi' => $this->organisasi->getOrganisasi()
        ];
        if (session()->get('template') == 'Basic') {
            return view('template/basic/struktur', $data);
        }
    }
    public function about()
    {
        $data = [
            'organisasi' => $this->organisasi->getOrganisasi()
        ];
        if (session()->get('template') == 'Basic') {
            return view('template/basic/tentang', $data);
        }
    }
    public function login()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('login.php', $data);
    }
}
