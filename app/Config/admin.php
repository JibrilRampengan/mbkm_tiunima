<?php
// app/Controllers/Admin.php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
{
    public function dashboardAdmin()
    {
        // Pastikan sesi pengguna memiliki tipe_pengguna 'admin' sebelum menampilkan halaman
        if (session('user_type') !== 'admin') {
            // Redirect ke halaman lain jika pengguna bukan admin
            return redirect()->to(site_url('mahasiswa/dashboard_mahasiswa'));
        }

        // Load view atau tampilkan halaman admin_dashboard
        return view('admin/dashboard_admin');
    }
}
