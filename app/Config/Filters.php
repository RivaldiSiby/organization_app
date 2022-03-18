<?php

namespace Config;

use App\Filters\MasterAdmin;
use App\Filters\Masterbidang;
use App\Filters\Masterjabatan;
use App\Filters\Masterkegiatan;
use App\Filters\Masterkeuangan;
use App\Filters\Mastermember;
use App\Filters\Masterpostingan;
use App\Filters\Masterprogram;
use App\Filters\Mastersurat;
use App\Filters\Moderator;
use App\Filters\Otentikasi;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'membermaster'  => Mastermember::class,
        'suratmaster'   => Mastersurat::class,
        'postinganmaster' => Masterpostingan::class,
        'keuanganmaster' => Masterkeuangan::class,
        'jabatanmaster' => Masterjabatan::class,
        'bidangmaster'  => Masterbidang::class,
        'kegiatanmaster' => Masterkegiatan::class,
        'adminmaster'   => MasterAdmin::class,
        'programmaster' => Masterprogram::class,
        'otentikasi'    => Otentikasi::class,
        'moderator'     => Moderator::class

    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            'csrf',
            // 'invalidchars',
        ],
        'after' => [
            // 'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        'otentikasi' => [
            'before' => [
                'dashboard/*',
                'dashboard',
                'logout',
                'homepage',
                'errors',
                'errors/*',
                'member/*',
                'surat/*',
                'keuangan/*',
                'postingan/*',
                'kegiatan/*'
            ],
            'after' => [
                'login'
            ]
        ],

        'moderator' => [
            'before' => [
                // 'apiKeuangan',
                // 'apiKegiatan',
                'apiMember',
                // 'apiSurat',
                // 'apiPostingan',
            ]
        ],

        'adminmaster' => [
            'before' => [
                // organisasi
                'organisasi',
                'organisasi/*',
                'editOrganisasi',
                'deleteOrganisasi',
                // admin
                'admin',
                'admin/*',
                'cekpin',
                'editAdmin',
                // moderator
                'moderator',
                'moderator/*',
                'editModerator',
                'deleteModerator',
                'addModerator',
                // fitur backup member
                'backupMember',
                'clearMember',
                'deletepMember',
                'restoreMember/*',
                // fitur backup Surat
                'backupSurat',
                'clearSurat',
                'deletepSurat',
                'restoreSurat/*',
                // fitur backup Keuangan
                'backupKeuangan',
                'clearKeuangan',
                'deletepKeuangan',
                'restoreKeuangan/*',
                // fitur backup Postingan
                'backupPostingan',
                'clearPostingan',
                'deletepPostingan',
                'restorePostingan/*',
                // fitur backup Kegiatan
                'backupKegiatan',
                'clearKegiatan',
                'deletepKegiatan',
                'restoreKegiatan/*',
                // fitur Log
                'log/*',
                'clearMonth',
                'clearAngkatan',
                'clearAll',
                // fitur web
                'web',
                'web/*',
                'editWeb',

            ]
        ],

        'programmaster' => [
            'before' => [
                'program',
                'program/*',
                'editProgram',
                'addProgram',
                'deleteProgram',
            ]
        ],
        'membermaster' => [
            'before' => [
                'member',
                'editMember',
                'addMember',
                'delMember/*',
                'memberEdit/*'
            ]
        ],

        'kegiatanmaster' => [
            'before' => [
                'kegiatan',
                'editKegiatan',
                'addKegiatan',
                'delKegiatan/*',
                'kegitanEdit/*'
            ]
        ],

        'suratmaster' => [
            'before' => [
                'surat',
                'editSurat',
                'addSurat',
                'delSurat/*',
                'suratEdit/*'
            ]
        ],
        'keuanganmaster' => [
            'before' => [
                'keuangan',
                'editKeuangan',
                'addKeuangan',
                'delKeuangan/*',
                'keuanganEdit/*'
            ]
        ],
        'postinganmaster' => [
            'before' => [
                'postingan',
                'editpostingan',
                'addpostingan',
                'delpostingan/*',
                'postinganEdit/*'
            ]
        ],
        'bidangmaster' => [
            'before' => [
                'bidang',
                'bidang/*',
                'editBidang',
                'addBidang',
                'deleteBidang/*',
            ]
        ],
        'jabatanmaster' => [
            'before' => [
                'positionMember/*',
                'position'
            ]
        ],


    ];
}
