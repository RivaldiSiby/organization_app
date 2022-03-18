<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
// Erorrs
$routes->resource('errors');
$routes->get('/404', 'Errors::page404');
$routes->get('/noapp', 'Errors::noapps');
// Erorrs

// dashboard
$routes->get('/logout', 'Otentikasi::logout');
$routes->resource('dashboard');
$routes->get('/homepage', 'Dashboard::view');
// dashboard

// public akses dahsboard
$routes->get('/apiMember', 'Member::public');
$routes->get('/apiSurat', 'Surat::public');
$routes->get('/apiKeuangan', 'Keuangan::public');
$routes->get('/apiPostingan', 'Postingan::public');
$routes->get('/apiKegiatan', 'Kegiatan::public');
$routes->post('/editProfile', 'Member::profile');
$routes->get('/apiprogram', 'Program::publicview');
$routes->get('/memberPengaturan/(:segment)', 'Member::pengaturan/$1');
// public akses dashboard

// public akses home
$routes->get('postview', 'Home::postingan');
$routes->get('programview', 'Home::program');
$routes->get('historyview', 'Home::history');
$routes->get('strukturview', 'Home::struktur');
$routes->get('aboutview', 'Home::about');
$routes->get('homeview', 'Home::homeview');
$routes->get('viewpost/(:segment)', 'Home::postinganview/$1');
// public akses home

// log
$routes->resource('log');
$routes->get('/clearMonth', 'Log::clearMonth');
$routes->get('/clearAngkatan', 'Log::clearAngkatan');
$routes->get('/clearAll', 'Log::clearAll');
// log

// admin
$routes->post('/cekpin', 'Admin::cekpin');
$routes->post('/editAdmin', 'Admin::updateData');
$routes->resource('admin');
// admin

// web
$routes->resource('web');
$routes->post('/editWeb', 'Web::updateData');
// web

// bidang
$routes->post('/editBidang', 'Bidang::updateData');
$routes->post('/deleteBidang', 'Bidang::deleteData');
$routes->resource('bidang');
$routes->get('/addBidang', 'Bidang::add');
// bidang

// program
$routes->post('/editProgram', 'Program::updateData');
$routes->post('/deleteProgram', 'Program::deleteData');
$routes->resource('program');
$routes->get('/addProgram', 'Program::add');
// program

// moderator
$routes->post('/editModerator', 'Moderator::updateData');
$routes->post('/deleteModerator', 'Moderator::deleteData');
$routes->resource('moderator');
$routes->get('/addModerator', 'Moderator::add');
// moderator


// organisasi
$routes->post('/deleteOrganisasi', 'Organisasi::deleteData');
$routes->post('/editOrganisasi', 'Organisasi::updateData');
$routes->resource('organisasi');
// organisasi

// member
$routes->post('/editMember', 'Member::updateData');
$routes->resource('member');
$routes->get('/addMember', 'Member::add');
$routes->get('/delMember/(:segment)', 'Member::softdelete/$1');
$routes->get('/memberEdit/(:segment)', 'Member::editData/$1');

// position fitur
$routes->get('/positionMember/(:segment)', 'Member::position/$1');
$routes->post('/position', 'Member::updatePosition');
// position fitur

// backup
$routes->get('/backupMember', 'Member::backup');
$routes->get('/clearMember', 'Member::clear');
$routes->post('/deleteMember', 'Member::deleteData');
$routes->get('/restoreMember/(:segment)', 'Member::restore/$1');
// backup
// member

// Surat
$routes->get('/addSurat', 'Surat::add');
$routes->post('/editSurat', 'Surat::updateData');
$routes->get('/suratEdit/(:segment)', 'Surat::editData/$1');
$routes->resource('surat');
$routes->get('/delSurat/(:segment)', 'Surat::softdelete/$1');
// backup
$routes->get('/backupSurat', 'Surat::backup');
$routes->get('/clearSurat', 'Surat::clear');
$routes->post('/deleteSurat', 'Surat::deleteData');
$routes->get('/restoreSurat/(:segment)', 'Surat::restore/$1');
// backup
// Surat

// Keuangan
$routes->get('/addKeuangan', 'Keuangan::add');
$routes->post('/editKeuangan', 'Keuangan::updateData');
$routes->get('/keuanganEdit/(:segment)', 'Keuangan::editData/$1');
$routes->resource('keuangan');
$routes->get('/delKeuangan/(:segment)', 'Keuangan::softdelete/$1');
// backup
$routes->get('/backupKeuangan', 'Keuangan::backup');
$routes->get('/clearKeuangan', 'Keuangan::clear');
$routes->post('/deleteKeuangan', 'Keuangan::deleteData');
$routes->get('/restoreKeuangan/(:segment)', 'Keuangan::restore/$1');
// backup
// Keuangan

// Postingan
$routes->get('/addPostingan', 'Postingan::add');
$routes->post('/editPostingan', 'Postingan::updateData');
$routes->get('/postinganEdit/(:segment)', 'Postingan::editData/$1');
$routes->resource('postingan');
$routes->get('/delPostingan/(:segment)', 'Postingan::softdelete/$1');
// backup
$routes->get('/backupPostingan', 'Postingan::backup');
$routes->get('/clearPostingan', 'Postingan::clear');
$routes->post('/deletePostingan', 'Postingan::deleteData');
$routes->get('/restorePostingan/(:segment)', 'Postingan::restore/$1');
// backup
// Postingan

// kegiatan
$routes->get('/addKegiatan', 'Kegiatan::add');
$routes->post('/editKegiatan', 'Kegiatan::updateData');
$routes->get('/kegiatanEdit/(:segment)', 'Kegiatan::editData/$1');
$routes->resource('kegiatan');
$routes->get('/delKegiatan/(:segment)', 'Kegiatan::softdelete/$1');
// backup
$routes->get('/backupKegiatan', 'Kegiatan::backup');
$routes->get('/clearKegiatan', 'Kegiatan::clear');
$routes->post('/deleteKegiatan', 'Kegiatan::deleteData');
$routes->get('/restoreKegiatan/(:segment)', 'Kegiatan::restore/$1');
// backup
// kegiatan


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
