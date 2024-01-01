<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes untuk halaman awal
$routes->get('/', 'Pages::index');

// Routes untuk halaman login, register dan logout
$routes->group('auth', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('/', 'Auth::index');
    $routes->post('login', 'Auth::login');
    $routes->post('register', 'Auth::register');
    $routes->get('logout', 'Auth::logout');
    $routes->get('do_logout', 'Auth::do_logout');
});

// routes untuk halaman dashboard Mahasiswa
$routes->get('dashboard_mahasiswa', 'Mahasiswa::dashboard_mahasiswa');

// routes untuk halaman Input, edit dan delete Matakuliah Mahasiswa
$routes->get('mahasiswa/input_matakuliah', 'Mahasiswa::input_matakuliah');
$routes->get('edit_matakuliah/(:num)', 'Mahasiswa::edit_matakuliah/$1');
$routes->post('edit_matakuliah/(:num)', 'Mahasiswa::edit_matakuliah/$1');
$routes->get('delete_matakuliah/(:num)', 'Mahasiswa::deleteMatakuliah/$1');

// routes untuk halaman Input, edit dan delete Program mbkm Mahasiswa
$routes->match(['get', 'post'], 'mahasiswa/input_programmbkm', 'Mahasiswa::input_programmbkm');
$routes->get('/edit_programmbkm/(:num)', 'Mahasiswa::edit_programmbkm/$1');
$routes->post('edit_programmbkm/(:num)', 'Mahasiswa::edit_programmbkm/$1');
$routes->get('delete_programmbkm/(:num)', 'Mahasiswa::delete_programmbkm/$1');
$routes->get('/delete_programmbkm/(:num)', 'Mahasiswa::delete_programmbkm/$1');

// routes untuk halaman Status data matakuliah dan Program mbkm Mahasiswa
$routes->get('mahasiswa/status', 'Mahasiswa::viewStatus');

// routes untuk halaman  input data, edit, dan hapus data konversi nilai Mahasiswa
$routes->get('mahasiswa/konversi_nilai', 'Mahasiswa::konversi_nilai');
$routes->get('mahasiswa/edit_konversi_nilai/(:num)', 'Mahasiswa::editKonversiNilai/$1');
$routes->post('mahasiswa/edit_konversi_nilai/(:num)', 'Mahasiswa::editKonversiNilai/$1');
$routes->get('mahasiswa/delete_konversi_nilai/(:num)', 'Mahasiswa::deleteKonversiNilai/$1');

// routes untuk menambah admin untuk pertama kali
$routes->get('auth/tambah_pengguna_secara_manual', 'Auth::tambah_pengguna_secara_manual');

// routes untuk halaman dashboard mahasiswa
$routes->get('admin/dashboard_admin', 'Admin::dashboard_admin');

// Routes untuk halaman validasi, proses validasi, menyetujui data dan menolak data matakuliah dan program mbkm mahasiswa 
$routes->group('admin', function ($routes) {
    $routes->get('validasi_data_input', 'Admin::validasi');
    $routes->post('prosesValidasi', 'Admin::prosesValidasi');
    $routes->get('setujuiData/(:segment)', 'Admin::setujuiData/$1');
    $routes->get('tolakData/(:segment)', 'Admin::tolakData/$1');
});

// Routes untuk halaman validasi, proses validasi, dan simpan perubahan konversi nilai data mahasiswa
$routes->get('admin/validasi_konversi_nilai', 'Admin::validasiKonversiNilai');
$routes->post('admin/proses_validasi_konversi_nilai', 'Admin::prosesValidasiKonversiNilai');
$routes->post('admin/simpan_perubahan_konversi_nilai/(:segment)', 'Admin::simpanPerubahanKonversiNilai/$1');

// Routes untuk halaman hasil konversi nilai mahasiswa 
$routes->get('mahasiswa/hasil_konversi_nilai', 'Mahasiswa::hasilKonversiNilai');

// Routes untuk halaman berita acara
$routes->get('mahasiswa/berita_acara', 'Mahasiswa::beritaAcara');
$routes->post('mahasiswa/cetakBeritaAcara', 'Mahasiswa::cetakBeritaAcara');

// Routes untuk halaman profil pengguna mahasiswa
$routes->get('mahasiswa/profil_pengguna', 'Mahasiswa::profilPengguna');
$routes->post('mahasiswa/profil_pengguna', 'Mahasiswa::profilPengguna');

$routes->get('admin/rekapitulasi_hasil_konversi_nilai', 'Admin::rekapitulasiHasilKonversiNilai');
$routes->get('admin/detail_hasil_konversi_nilai/(:segment)', 'Admin::detailHasilKonversiNilai/$1');

$routes->get('admin/rekapitulasi_berita_acara', 'Admin::rekapitulasiBeritaAcara');
$routes->post('admin/cetakBeritaAcara', 'Admin::cetakBeritaAcara');

// Menampilkan halaman data matakuliah_programstudi
$routes->get('/admin/data_matakuliah_programstudi', 'Admin::data_matakuliah_programstudi');

// Hapus data matakuliah_programstudi berdasarkan ID
$routes->get('/admin/delete_matakuliah_programstudi/(:num)', 'Admin::deleteMatakuliahProgramStudi/$1');


// Tambah data matakuliah_programstudi (menangani form submission)
$routes->post('/admin/tambah_data_matakuliah_programstudi', 'Admin::data_matakuliah_programstudi');

// routes untuk membuat halama, menambah, dan menghapus data dosen program studi
$routes->get('/admin/data_dosen', 'Admin::data_dosen');
$routes->post('/admin/data_dosen', 'Admin::data_dosen');
$routes->get('admin/delete_dosen/(:num)', 'Admin::deleteDosen/$1');

// routes untuk data mahasiswa
$routes->add('/admin/data_mahasiswa', 'Admin::data_mahasiswa');

// routes untuk membuat halama, menambah, dan menghapus informasi data akun admin
$routes->get('/admin/data_admin', 'Admin::data_admin');
$routes->post('/admin/data_admin', 'Admin::data_admin');
$routes->post('/admin/delete_admin', 'Admin::delete_admin');

// routes untuk membuat informasi profil pengguna admin
$routes->get('admin/profil_pengguna', 'Admin::profilPengguna');
$routes->post('admin/profil_pengguna', 'Admin::profilPengguna');

// routes untuk mendownload data hasil konversi nilai dalam bentuk Ms.Office Excel
$routes->get('admin/download_hasil_konversi_nilai_excel', 'Admin::downloadHasilKonversiNilaiExcel');


$routes->setAutoRoute(true);
