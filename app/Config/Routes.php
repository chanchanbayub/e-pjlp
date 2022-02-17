<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
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
// $routes->get('/', 'Home::index');
// landing pages
$routes->get("/", "Landing::index");

// 
$routes->get("/pjlp", function () {
	throw new \CodeIgniter\Exceptions\PageNotFoundException("Halaman Tidak ditemukan");
});
// Users
// login
$routes->get("/login", "Login::index");
$routes->post("/pjlp/login/", "Login::login");
$routes->post('/pjlp/logout', "Login::logout");

// beranda
$routes->get('/pjlp/beranda/', 'users\Beranda::index');

// Propil
$routes->get('/pjlp/profil/userinfo/(:any)', 'users\Profil::index/$1');
$routes->get('/pjlp/profil/(:any)/', 'users\Profil::edit/$1');
$routes->get('/pjlp/getData/(:any)', 'users\Profil::getData/$1');
$routes->POST('/pjlp/profil/save/', 'users\Profil::save');
$routes->POST('/pjlp/profil/saveImage/(:any)', 'users\Profil::saveImage/$1');

//absensi 
$routes->get('/pjlp/absensi/hari/(:any)', 'users\Absensi::index/$1');
$routes->get('/pjlp/absensi/rekap_absen/(:any)', 'users\Absensi::rekapAbsen/$1');
$routes->get('/pjlp/absensi/perbaikanAbsen/(:any)', 'users\Perbaikanabsen::index/$1');
$routes->get('/pjlp/absensi/cetakPDFPerbaikan/(:any)', 'users\Perbaikanabsen::cetakPDFPerbaikan/$1');

// ajax users Absensi
$routes->get('/pjlp/absensi/getRowAbsensi/(:any)', 'users\Absensi::getRowAbsensi/$1');
$routes->get('/pjlp/absensi/getResultAbsensi/(:any)', 'users\Absensi::getResultAbsensi/$1');
$routes->get('/pjlp/absensi/getPerbaikanAbsen/(:any)', 'users\Perbaikanabsen::getPerbaikanAbsen/$1');
$routes->get('/pjlp/absensi/getId/', 'users\Perbaikanabsen::getId');
$routes->post('/pjlp/absensi/savePerbaikan/', 'users\Perbaikanabsen::savePerbaikan');

// kegiatan
$routes->get('/pjlp/kegiatan/(:any)', 'users\Kegiatan::index/$1');
$routes->get('/pjlp/kegiatanData/getKinerja/(:any)', 'users\Kegiatan::getKinerja/$1');
$routes->POST('/pjlp/kegiatan/save', 'users\Kegiatan::save');
//  cetak PDF 
$routes->get('/pjlp/kegiatanKinerja/cetakPDF/(:any)', 'users\Kegiatan::cetakPDFKegitan/$1');

// capaian Kinerja
$routes->get('/pjlp/capaiankinerja/(:any)', 'users\CapaianKinerja::index/$1');
$routes->get('/pjlp/capaian/getAbsensiDataJadwal/(:any)', 'users\CapaianKinerja::getAbsensiDataJadwal/$1');
$routes->get('/pjlp/capaian/getGaji/(:any)', 'users\CapaianKinerja::getGaji/$1');

// jadwal Users
$routes->get('/pjlp/jadwal/(:any)/', 'users\Jadwal::index/$1');
$routes->get('/pjlp/getJadwalById/(:any)/', 'users\Jadwal::getJadwalById/$1');

$routes->get('/pjlp/suratPeringatan/(:any)/', 'users\Suratperingatan::index/$1');
// End Users


// Admin
$routes->get('/pjlp/admin/', 'admin\Beranda::index');
$routes->get('/pjlp/admin/absensi/(:any)', 'admin\Checkinout::index/$1');
$routes->get('/pjlp/admin/rekapAbsen/(:any)', 'admin\checkinout::rekapAbsen/$1');
$routes->get('/pjlp/admin/cetakPdf/(:any)', 'admin\Checkinout::cetakPdf/$1');

$routes->get('/pjlp/admin/kinerja/', 'admin\Kinerja::index');

// Profil Admin
$routes->get('/pjlp/admin/userinfo/(:any)', 'admin\Userinfo::getProfil/$1');
$routes->get('/pjlp/admin/edit-profil/(:any)', 'admin\Userinfo::editProfil/$1');
$routes->get('/pjlp/admin/getDataUser/', 'admin\Userinfo::getDataUser');
$routes->POST('/pjlp/admin/save/', 'admin\Userinfo::save');
$routes->POST('/pjlp/admin/saveImage/(:any)', 'admin\Userinfo::saveImage/$1');

// admin anggota
$routes->get('/pjlp/admin/anggota/', 'admin\UserInfo::index');
$routes->get('/pjlp/admin/viewAnggota/', 'admin\UserInfo::getAnggotaWhereId');
$routes->get('/pjlp/admin/anggota/detail/(:any)/', 'admin\UserInfo::detail/$1');

// Group Users
$routes->get('/pjlp/admin/groupUsers/', 'admin\Groupusers::index');
$routes->get('/pjlp/admin/getGroupUser/', 'admin\Groupusers::getGroupUser');
$routes->get('/pjlp/admin/filter/', 'admin\Groupusers::filter');
$routes->post('/pjlp/admin/deleteGroup/', 'admin\Groupusers::deleteGroup');

// Bidang
$routes->get('/pjlp/admin/bidang/', 'admin\Bidang::index');
$routes->get('/pjlp/admin/getBidang/', 'admin\Bidang::getBidang');
$routes->POST('/pjlp/admin/addBidang/', 'admin\Bidang::addBidang');
$routes->get('/pjlp/admin/getDataBidang/', 'admin\Bidang::getDataBidang');
$routes->post('/pjlp/admin/updateBidang/', 'admin\Bidang::update');
$routes->post('/pjlp/admin/deleteBidang/', 'admin\Bidang::delete');

// Shift
$routes->get('/pjlp/admin/shift/', 'admin\Shift::index');
$routes->get('/pjlp/admin/getShift/', 'admin\Shift::getShift');
$routes->POST('/pjlp/admin/addShift/', 'admin\Shift::addShift');
$routes->get('/pjlp/admin/getDataShift/', 'admin\Shift::getDataShift');
$routes->POST('/pjlp/admin/updateShift/', 'admin\Shift::update');
$routes->POST('/pjlp/admin/deleteShift/', 'admin\Shift::delete');

// Bulan
$routes->get('/pjlp/admin/bulan/', 'admin\Bulan::index');
$routes->POST('/pjlp/admin/addBulan/', 'admin\Bulan::addBulan');
$routes->get('/pjlp/admin/getBulan/', 'admin\Bulan::getBulan');

// Jadwal
$routes->get('/pjlp/admin/jadwal/(:any)', 'admin\Jadwal::index/$1');
$routes->post('/pjlp/admin/addJadwal/', 'admin\Jadwal::addJadwal');
$routes->get('/pjlp/admin/getJadwal/(:any)', 'admin\Jadwal::getJadwal/$1');
$routes->post('/pjlp/admin/hapusJadwal', 'admin\Jadwal::hapusJadwal');

// Perbaikan Absen
$routes->get('/pjlp/admin/perbaikanAbsen/', 'admin\Perbaikanabsen::index');
$routes->get('/pjlp/admin/getPerbaikanAbsen/', 'admin\Perbaikanabsen::getPerbaikanAbsen');
$routes->get('/pjlp/admin/getDataImage/(:any)', 'admin\Perbaikanabsen::getDataImage/$1');
$routes->post('/pjlp/admin/updatePerbaikan/', 'admin\Perbaikanabsen::update');

// Jadwal
$routes->get('/pjlp/admin/getJadwal/(:any)', 'admin\Jadwal::getJadwal/$1');
$routes->get('/pjlp/admin/editJadwal/', 'admin\Jadwal::editJadwal');
$routes->post('/pjlp/admin/hapusJadwal/', 'admin\Jadwal::hapusJadwal');
$routes->post('/pjlp/admin/updateJadwal/', 'admin\Jadwal::updateJadwal');

// Gaji
$routes->get('/pjlp/admin/gaji/(:any)', 'admin\Gaji::index/$1');
$routes->post('/pjlp/admin/addGaji/', 'admin\Gaji::addGaji');
$routes->get('/pjlp/admin/getGaji/(:any)', 'admin\Gaji::getGaji/$1');
$routes->post('/pjlp/admin/hapusGaji/', 'admin\Gaji::delete');
$routes->get('/pjlp/admin/editGaji/', 'admin\Gaji::edit');
$routes->post('/pjlp/admin/updateGaji/', 'admin\Gaji::update');

// Role
$routes->get('/pjlp/admin/role/', 'admin\Role::index');
$routes->get('/pjlp/admin/getRole/', 'admin\Role::getRole');
$routes->POST('/pjlp/admin/addRole/', 'admin\Role::addRole');
$routes->get('/pjlp/admin/getDataRole/', 'admin\Role::getDataRole');
$routes->POST('/pjlp/admin/updateRole/', 'admin\Role::update');
$routes->POST('/pjlp/admin/deleteRole/', 'admin\Role::delete');

// Seksi
$routes->get('/pjlp/admin/seksi/', 'admin\Seksibagian::index');
$routes->get('/pjlp/admin/getDataSeksi/', 'admin\Seksibagian::getDataSeksi');
$routes->post('/pjlp/admin/addSeksi/', 'admin\Seksibagian::addSeksi');
$routes->get('/pjlp/admin/getRowSeksi/', 'admin\Seksibagian::getRowSeksi');
$routes->post('/pjlp/admin/updateSeksi/', 'admin\Seksibagian::updateSeksi');
$routes->post('/pjlp/admin/deleteSeksi/', 'admin\Seksibagian::deleteSeksi');

// Users Management
$routes->get('/pjlp/admin/usersmanagement/', 'admin\Usersmanagement::index');
$routes->get('/pjlp/admin/getUsers/', 'admin\Usersmanagement::getUsers');
$routes->POST('/pjlp/admin/users/', 'admin\Usersmanagement::addUsers');
$routes->POST('/pjlp/admin/updateUsers/', 'admin\Usersmanagement::updateUser');
$routes->POST('/pjlp/admin/deleteUser/', 'admin\Usersmanagement::deleteUser');

// Surat Peringatan
$routes->get('/pjlp/admin/suratperingatan/', 'admin\Suratperingatan::index');
$routes->get('/pjlp/admin/editSurat/', 'admin\Suratperingatan::editSurat');
$routes->POST('/pjlp/admin/addSurat/', 'admin\SuratPeringatan::addSurat');
$routes->POST('/pjlp/admin/updateSurat/', 'admin\SuratPeringatan::updateSurat');
$routes->POST('/pjlp/admin/delete/', 'admin\SuratPeringatan::delete');

// Keterangan
$routes->get('/pjlp/admin/keterangan/', 'admin\Keterangan::index');
$routes->get('/pjlp/admin/editKeterangan/', 'admin\Keterangan::editKeterangan');
$routes->post('/pjlp/admin/aadKeterangan/', 'admin\Keterangan::addKeterangan');
$routes->post('/pjlp/admin/updateKeterangan/', 'admin\Keterangan::updateKeterangan');
$routes->POST('/pjlp/admin/deleteKeterangan/', 'admin\Keterangan::deleteKeterangan');

// end Admin
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
