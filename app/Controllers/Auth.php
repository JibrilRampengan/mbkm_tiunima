<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Auth extends Controller
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $model = new UserModel();

        if ($this->request->getMethod() === 'post' && $this->validate([
            'nim' => 'required',  // login menggunakan nim
            'password' => 'required'
        ])) {
            $nim = $this->request->getPost('nim');
            $password = $this->request->getPost('password');

            $user = $model->where('nim', $nim)->first();

            if ($user && password_verify($password, $user['password'])) {
                // Login berhasil
                $session = session();
                $session->set([
                    'username' => $user['username'],
                    'user_type' => $user['tipe_pengguna'],
                    'login_success_message' => "Login Berhasil! Selamat datang, " . $user['username'] . "."
                ]);

                $targetPage = ($user['tipe_pengguna'] === 'admin') ? 'admin/dashboard_admin' : 'mahasiswa/dashboard_mahasiswa';

                return redirect()->to(site_url($targetPage));
            } else {
                // Login gagal
                session()->setFlashdata('login_error', 'NIM atau password salah.');  // Menyesuaikan pesan error
                return redirect()->to(site_url('auth'));
            }
        } else {
            // Validasi gagal
            session()->setFlashdata('login_error', 'Mohon isi kedua kolom NIM dan password.');  // Menyesuaikan pesan error
            return redirect()->to(site_url('auth'));
        }
    }


    public function register()
    {
        if ($this->request->getMethod() === 'post' && $this->validate([
            'username' => 'required',
            'password' => 'required|min_length[6]',
            'nim' => 'required'
        ])) {
            $model = new UserModel();

            $username = $this->request->getPost('username');
            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $nim = $this->request->getPost('nim');

            // Cek apakah username atau NIM sudah ada
            if (!$model->isUnique(['username' => $username, 'nim' => $nim])) {
                session()->setFlashdata('signup_error', 'Username atau NIM sudah digunakan.');
                return redirect()->to(site_url('auth'));
            }

            // Masukkan data pengguna ke dalam database
            $model->insert([
                'username' => $username,
                'password' => $password,
                'nim' => $nim,
                'tipe_pengguna' => 'mahasiswa'
            ]);

            // Registrasi berhasil
            session()->setFlashdata('signup_success', 'Registrasi berhasil. Silakan login untuk melanjutkan.');
            return redirect()->to(site_url('auth'));
        } else {
            // Validasi gagal
            session()->setFlashdata('signup_error', 'Mohon isi semua kolom yang dibutuhkan.');
            return redirect()->to(site_url('auth'));
        }
    }

    public function tambah_pengguna_secara_manual()
    {
        $model = new UserModel();

        // Nilai untuk pengguna baru
        $username = 'TI UNIMA';
        $password = 'unimambkm';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $nim = '24012016';

        // Periksa apakah nama pengguna atau NIM sudah digunakan
        if (!$model->isUnique(['username' => $username, 'nim' => $nim])) {
            return "Error: Nama pengguna atau NIM sudah digunakan.";
        }

        // Sisipkan pengguna baru ke dalam database
        $data = [
            'username' => $username,
            'password' => $hashedPassword,
            'nim' => $nim,
            'tipe_pengguna' => 'admin'
        ];

        $model->insert($data);

        // Registrasi berhasil
        return "Registrasi berhasil. Pengguna ditambahkan dengan sukses.";
    }

    public function logout()
    {
        if (session()->has('username')) {
            echo view('auth/logout_confirmation');
        } else {
            // Jika pengguna belum login, redirect ke halaman login
            return redirect()->to(site_url('auth'));
        }
    }

    public function do_logout()
    {
        if (session()->has('username')) {
            session()->destroy();

            session()->setFlashdata('logout_success', 'Logout berhasil.');
        }

        // Redirect ke halaman login
        return redirect()->to(site_url('auth'));
    }
}
