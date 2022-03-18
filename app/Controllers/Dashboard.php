<?php

namespace App\Controllers;

use App\Models\BidangModel;
use App\Models\KegiatanModel;
use App\Models\KeuanganModel;
use App\Models\MemberModel;
use App\Models\ModeratorModel;
use App\Models\PostinganModel;
use App\Models\ProgramModel;
use App\Models\SuratModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\I18n\Time;

class Dashboard extends ResourceController
{


    protected $moderator;
    protected $bidang;
    protected $member;
    protected $keuangan;
    protected $surat;
    protected $postingan;
    protected $program;
    protected $kegiatan;

    public function __construct()
    {
        $this->moderator = new ModeratorModel();
        $this->surat = new SuratModel();
        $this->member = new MemberModel();
        $this->keuangan = new KeuanganModel();
        $this->postingan = new PostinganModel();
        $this->bidang = new BidangModel();
        $this->program = new ProgramModel();
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

        $data = [
            'moderator' => $this->moderator->getModerator(),
            'bidang' => $this->bidang->getBidang(),
            'member' => $this->member->getMemberAll(),
            'surat' => $this->surat->getSuratNew(),
            'keuangan' => $this->keuangan->getLaporanNew(),
            'postingan' => $this->postingan->getPostinganNew(),
            'kegiatan' => $this->kegiatan->getKegiatan(),
            'program' => $this->program->getProgram(),
            'memberbackup' => $this->member->getMemberAllBackup(),
            'suratbackup' => $this->surat->getSuratBackup(),
            'keuanganbackup' => $this->keuangan->getLaporanBackup(),
            'postinganbackup' => $this->postingan->getPostinganBackup(),
            'kegiatanbackup' => $this->kegiatan->getKegiatanBackup(),
            'time' => $this->myTime->now()
        ];
        return view('dashboard/dashboard', $data);
    }
    public function view()
    {
        $datas = [
            'moderator' => $this->moderator->getModerator(),
            'bidang' => $this->bidang->getBidang(),
            'member' => $this->member->getMemberAll(),
            'surat' => $this->surat->getSuratNew(),
            'keuangan' => $this->keuangan->getLaporanNew(),
            'postingan' => $this->postingan->getPostinganNew(),
            'kegiatan' => $this->kegiatan->getKegiatan(),
            'program' => $this->program->getProgram(),
            'memberbackup' => $this->member->getMemberAllBackup(),
            'suratbackup' => $this->surat->getSuratBackup(),
            'keuanganbackup' => $this->keuangan->getLaporanBackup(),
            'postinganbackup' => $this->postingan->getPostinganBackup(),
            'kegiatanbackup' => $this->kegiatan->getKegiatanBackup(),
            'time' => $this->myTime->now()
        ];
        $data = view('dashboard/home', $datas);
        return $this->respond($data);
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
