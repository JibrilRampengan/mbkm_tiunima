<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AdminModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Admin extends Controller
{

    // dashboard Admin
    public function dashboard_admin()
    {
        $adminModel = new AdminModel();

        // Mengambil data admin dari tabel users dengan tipe_pengguna sebagai admin
        $adminList = $adminModel->getAdminList();

        // untuk menampilkan username
        $username = htmlspecialchars(session()->get("username"));

        // untuk menampilkan nim berdasarkan username
        $nim = $adminModel->getNIMByUsername($username);

        // mengambil URL gambar profil dari database berdasarkan username
        $profilePictureUrl = $adminModel->getProfilePictureByUsername($username);

        // Menghitung jumlah mahasiswa yang mengajukan konversi nilai berdasarkan grup_id
        $jumlahKonversi = $adminModel->countKonversiByGrupId($nim);

        // Menghitung jumlah pengajuan mahasiswa yang disetujui berdasarkan nim
        $jumlahDisetujui = $adminModel->countPengajuanDisetujui($nim);

        // Menghitung jumlah konversi nilai yang telah selesai berdasarkan nim
        $jumlahSelesai = $adminModel->countKonversiSelesai($nim);

        // Mendapatkan data admin dari model
        $data['admin'] = [
            'username' => $username,
            'nim' => $nim,
            'profile_picture' => $profilePictureUrl,
            'jumlah_konversi' => $jumlahKonversi,
            'jumlah_disetujui' => $jumlahDisetujui,
            'jumlah_selesai' => $jumlahSelesai,
        ];

        // Mendapatkan data hasil_konversi_nilai berdasarkan program MBKM
        $data['programMBKMData'] = $adminModel->getProgramMBKMData();

        // Menambahkan data adminList ke dalam data yang akan dikirim ke view
        $data['adminList'] = $adminList;

        // Memuat view dashboard_admin dengan data
        return view('admin/dashboard_admin', $data);
    }


    // Validasi data input matakuliah dan progra mbkm mahasiswa
    public function validasi()
    {
        helper('form');

        $adminModel = new AdminModel();
        $grupIds = $adminModel->getUniqueGrupIds();

        $username = htmlspecialchars(session()->get("username"));
        $nim = $adminModel->getNIMByUsername($username);
        $profilePictureUrl = $adminModel->getProfilePictureByUsername($username);

        $admin = [
            'username' => $username,
            'nim' => $nim,
            'profile_picture' => $profilePictureUrl,
        ];

        return view('admin/validasi_data_input', [
            'grupIds' => $grupIds,
            'admin' => $admin,
            'adminModel' => $adminModel,
        ]);
    }

    public function prosesValidasi()
    {
        helper('form');

        $grupId = $this->request->getPost('grup_id');

        if (empty($grupId)) {
            return redirect()->to('/admin/validasi')->with('error', 'Silakan pilih grup_id.');
        }

        $adminModel = new AdminModel();
        $dataMatakuliah = $adminModel->getMatakuliahByGrupId($grupId);
        $dataProgramMbkm = $adminModel->getProgramMbkmByGrupId($grupId);

        $username = htmlspecialchars(session()->get("username"));
        $nim = $adminModel->getNIMByUsername($username);
        $profilePictureUrl = $adminModel->getProfilePictureByUsername($username);

        $admin = [
            'username' => $username,
            'nim' => $nim,
            'profile_picture' => $profilePictureUrl,
        ];

        return view('admin/proses_validasi', [
            'grupId' => $grupId,
            'dataMatakuliah' => $dataMatakuliah,
            'dataProgramMbkm' => $dataProgramMbkm,
            'admin' => $admin,
            'adminModel' => $adminModel,
        ]);
    }

    // Logika untuk menyetujui data input matakuliah dan program mbkm
    public function setujuiData($grupId)
    {
        helper('form');

        $adminModel = new AdminModel();

        $adminModel->setujuiDataMatakuliah($grupId);
        $adminModel->setujuiDataProgramMbkm($grupId);

        return redirect()->to('/admin/validasi_data_input')->with('success', 'Data untuk grup_id ' . $grupId . ' telah disetujui.');
    }

    // Logika untuk menolak data input matakuliah dan program mbkm
    public function tolakData($grupId)
    {
        helper('form');

        $adminModel = new AdminModel();

        $adminModel->tolakDataMatakuliah($grupId);
        $adminModel->tolakDataProgramMbkm($grupId);

        return redirect()->to('/admin/validasi_data_input')->with('success', 'Data untuk grup_id ' . $grupId . ' telah ditolak.');
    }

    // Validasi data konversi nilai yang diajukkan oleh mahasiswa
    public function validasiKonversiNilai()
    {
        helper('form');

        $adminModel = new AdminModel();
        $grupIds = $adminModel->getUniqueGrupIdsKonversiNilai();

        $username = htmlspecialchars(session()->get("username"));
        $nim = $adminModel->getNIMByUsername($username);
        $profilePictureUrl = $adminModel->getProfilePictureByUsername($username);

        $admin = [
            'username' => $username,
            'nim' => $nim,
            'profile_picture' => $profilePictureUrl,
        ];

        return view('admin/validasi_konversi_nilai', [
            'grupIds' => $grupIds,
            'admin' => $admin,
            'adminModel' => $adminModel,
        ]);
    }

    public function prosesValidasiKonversiNilai()
    {
        helper('form');

        $grupId = $this->request->getPost('grup_id');

        if (empty($grupId)) {
            return redirect()->to('/admin/validasi_konversi_nilai')->with('error', 'Silakan pilih grup_id.');
        }

        // Mendapatkan data konversi_nilai berdasarkan grup_id
        $adminModel = new AdminModel();
        $dataKonversiNilai = $adminModel->getKonversiNilaiByGrupId($grupId);

        $username = htmlspecialchars(session()->get("username"));
        $nim = $adminModel->getNIMByUsername($username);
        $profilePictureUrl = $adminModel->getProfilePictureByUsername($username);

        // Set status 'diproses' pada tabel konversi_nilai
        $adminModel->setGrupIdStatusDiproses($grupId);

        $admin = [
            'username' => $username,
            'nim' => $nim,
            'profile_picture' => $profilePictureUrl,
        ];

        return view('admin/proses_validasi_konversi_nilai', [
            'grupId' => $grupId,
            'dataKonversiNilai' => $dataKonversiNilai,
            'admin' => $admin,
            'adminModel' => $adminModel,
        ]);
    }

    // Menyimpan proses validasi data konversi nilai mahasiswa
    public function simpanPerubahanKonversiNilai($grupId)
    {
        helper('form');

        $updatedData = [];

        $totalData = count($this->request->getPost('nama_mahasiswa'));

        echo "grup_id pada simpanPerubahanKonversiNilai: " . $grupId;

        for ($i = 0; $i < $totalData; $i++) {
            $updatedData[] = [
                'grup_id' => $grupId,
                'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa')[$i],
                'nim' => $this->request->getPost('nim')[$i],
                'semester' => $this->request->getPost('semester')[$i],
                'fakultas' => $this->request->getPost('fakultas')[$i],
                'program_studi' => $this->request->getPost('program_studi')[$i],
                'lokasi_program' => $this->request->getPost('lokasi_program')[$i],
                'dosen_pembimbing_lapangan' => $this->request->getPost('dosen_pembimbing_lapangan')[$i],
                'nip_dosen_pembimbing_lapangan' => $this->request->getPost('nip_dosen_pembimbing_lapangan')[$i],
                'program_mbkm' => $this->request->getPost('program_mbkm')[$i],
                'kegiatan' => $this->request->getPost('kegiatan')[$i],
                'rekognisi_mk' => $this->request->getPost('rekognisi_mk')[$i],
                'kode_matakuliah' => $this->request->getPost('kode_matakuliah')[$i],
                'sks' => $this->request->getPost('sks')[$i],
                'nilai' => $this->request->getPost('nilai')[$i],
            ];
        }

        $adminModel = new AdminModel();
        $adminModel->simpanHasilKonversiNilai($grupId, $updatedData);

        // Set status 'selesai' pada tabel konversi_nilai
        $adminModel->setGrupIdStatusSelesai($grupId);

        return redirect()->to('/admin/validasi_konversi_nilai')->with('success', 'Perubahan data untuk grup_id ' . $grupId . ' telah disimpan.');
    }

    // Untuk menampilkan seluruh hasil konversi nilai mahasiswa
    public function rekapitulasiHasilKonversiNilai()
    {
        helper('form');
        $adminModel = new AdminModel();

        $grupData = $adminModel->getUniqueGrupDataHasilKonversiNilai();

        $username = htmlspecialchars(session()->get("username"));
        $nim = $adminModel->getNIMByUsername($username);
        $profilePictureUrl = $adminModel->getProfilePictureByUsername($username);

        $admin = [
            'username' => $username,
            'nim' => $nim,
            'profile_picture' => $profilePictureUrl,
        ];

        return view('admin/rekapitulasi_hasil_konversi_nilai', [
            'grupData' => $grupData,
            'admin' => $admin,
            'adminModel' => $adminModel,
        ]);
    }


    public function detailHasilKonversiNilai($grupId)
    {
        helper('form');

        $adminModel = new AdminModel();
        $dataHasilKonversiNilai = $adminModel->getHasilKonversiNilaiByGrupId($grupId);

        $username = htmlspecialchars(session()->get("username"));
        $nim = $adminModel->getNIMByUsername($username);
        $profilePictureUrl = $adminModel->getProfilePictureByUsername($username);

        $admin = [
            'username' => $username,
            'nim' => $nim,
            'profile_picture' => $profilePictureUrl,
        ];

        return view('admin/detail_hasil_konversi_nilai', [
            'grupId' => $grupId,
            'dataHasilKonversiNilai' => $dataHasilKonversiNilai,
            'admin' => $admin,
            'adminModel' => $adminModel,
        ]);
    }

    // Untuk menampilkan seluruh berita acara hasil konversi nilai mahasiswa
    public function rekapitulasiBeritaAcara()
    {
        $adminModel = new AdminModel();

        $grupIds = $adminModel->getDistinctGrupIds();

        return view('admin/rekapitulasi_berita_acara', [
            'admin' => [
                'username' => session()->get("username"),
                'nim' => $adminModel->getNIMByUsername(session()->get("username")),
                'profile_picture' => $adminModel->getProfilePictureByUsername(session()->get("username")),
            ],
            'grupIds' => $grupIds,
        ]);
    }

    // Untuk mencetak berita acara hasil konversi nilai mahasiswa
    public function cetakBeritaAcara()
    {
        $adminModel = new AdminModel();

        $grupId = $this->request->getPost('grup_id');

        // Mendapatkan data konversi nilai berdasarkan grup_id
        $konversiNilaiData = $adminModel->getKonversiNilaiByGrupId($grupId);

        // Mendapatkan Dosen Pembimbing Name Value berdasarkan grup_id
        $dosenPembimbingValue = $adminModel->getDosenPembimbingByGrupId($grupId);

        // Mendapatkan NIP Dosen Pembimbing Value berdasarkan grup_id
        $nipDosenPembimbingValue = $adminModel->getNipDosenPembimbingByGrupId($grupId);

        // Mendapatkan Program MBKM Value berdasarkan grup_id
        $programMbkmValue = $adminModel->getProgramMbkmValueByGrupId($grupId);

        // Mendapatkan NIM Value berdasarkan grup_id
        $nimValue = $adminModel->getNimByGrupId($grupId);

        // Mendapatkan Nama Lengkap Value berdasarkan grup_id
        $namaLengkapValue = $adminModel->getNamaLengkapByGrupId($grupId);

        // Mendapatkan Semester Value berdasarkan grup_id
        $semesterValue = $adminModel->getSemesterByGrupId($grupId);

        // Mendapatkan Program Studi Value berdasarkan grup_id
        $programStudiValue = $adminModel->getProgramStudiByGrupId($grupId);

        // Mendapatkan Lokasi MBKM Value berdasarkan grup_id
        $lokasiMbkmValue = $adminModel->getLokasiMbkmByGrupId($grupId);

        // Memuat view cetak_berita_acara.php dengan data
        return view('mahasiswa/cetak_berita_acara', [
            'konversiNilaiData' => $konversiNilaiData,
            'dosenPembimbingValue' => $dosenPembimbingValue,
            'nipDosenPembimbingValue' => $nipDosenPembimbingValue,
            'programMbkmValue' => $programMbkmValue,
            'nimValue' => $nimValue,
            'namaLengkapValue' => $namaLengkapValue,
            'semesterValue' => $semesterValue,
            'programStudiValue' => $programStudiValue,
            'lokasiMbkmValue' => $lokasiMbkmValue,
        ]);
    }

    // Untuk menampilkan seluruh data matakuliah program studi dan menambahkan matakuliah program studi yang baru
    public function data_matakuliah_programstudi()
    {
        helper('form');
        $adminModel = new AdminModel();

        $matakuliahProgramStudiData = $adminModel->getAllMatakuliahProgramStudi();

        $username = htmlspecialchars(session()->get("username"));
        $nim = $adminModel->getNIMByUsername($username);
        $profilePictureUrl = $adminModel->getProfilePictureByUsername($username);


        $admin = [
            'username' => $username,
            'nim' => $nim,
            'profile_picture' => $profilePictureUrl,
        ];

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'nama_matakuliah' => 'required',
                'kode_matakuliah' => 'required',
                'sks' => 'required|numeric',
            ];

            if ($this->validate($validationRules)) {
                $data = [
                    'nama_matakuliah' => $this->request->getPost('nama_matakuliah'),
                    'kode_matakuliah' => $this->request->getPost('kode_matakuliah'),
                    'sks' => $this->request->getPost('sks'),
                ];

                $adminModel->insertMatakuliahProgramStudi($data);

                return redirect()->to('/admin/data_matakuliah_programstudi')->with('success', 'Data matakuliah_programstudi berhasil ditambahkan.');
            } else {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }
        }

        return view('admin/data_matakuliah_programstudi', [
            'matakuliahProgramStudiData' => $matakuliahProgramStudiData,
            'admin' => $admin,
        ]);
    }

    // Untuk menghapus matakuliah program studi
    public function deleteMatakuliahProgramStudi($id)
    {
        $adminModel = new AdminModel();

        $matakuliahExist = $adminModel->getMatakuliahProgramStudiById($id);

        if (!$matakuliahExist) {
            return redirect()->to('/admin/data_matakuliah_programstudi')->with('error', 'Data matakuliah_programstudi tidak ditemukan.');
        }

        // Hapus data dari database
        $adminModel->deleteMatakuliahProgramStudi($id);

        return redirect()->to('/admin/data_matakuliah_programstudi')->with('success', 'Data matakuliah_programstudi berhasil dihapus.');
    }

    // Untuk menampilkan seluruh data dosen program studi dan menambahkan dosen program studi yang baru
    public function data_dosen()
    {
        helper('form');
        $adminModel = new AdminModel();

        $dosenData = $adminModel->getAllDosen();

        $username = htmlspecialchars(session()->get("username"));
        $nim = $adminModel->getNIMByUsername($username);
        $profilePictureUrl = $adminModel->getProfilePictureByUsername($username);

        $admin = [
            'username' => $username,
            'nim' => $nim,
            'profile_picture' => $profilePictureUrl,
        ];

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'nama_dosen' => 'required',
                'nip_dosen' => 'required',
            ];

            if ($this->validate($validationRules)) {
                $data = [
                    'nama_dosen' => $this->request->getPost('nama_dosen'),
                    'nip_dosen' => $this->request->getPost('nip_dosen'),
                ];

                $adminModel->insertDosen($data);

                return redirect()->to('/admin/data_dosen')->with('success', 'Data dosen berhasil ditambahkan.');
            } else {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }
        }

        return view('admin/data_dosen', [
            'dosenData' => $dosenData,
            'admin' => $admin,
        ]);
    }

    // Untuk menghapus data doen program studi
    public function deleteDosen($id)
    {

        $adminModel = new AdminModel();


        $dosenData = $adminModel->getDosenById($id);

        if (!$dosenData) {
            return redirect()->to('/admin/data_dosen')->with('error', 'Data dosen tidak ditemukan.');
        }

        $deleted = $adminModel->deleteDosen($id);

        if ($deleted) {
            return redirect()->to('/admin/data_dosen')->with('success', 'Data dosen berhasil dihapus.');
        } else {
            return redirect()->to('/admin/data_dosen')->with('error', 'Gagal menghapus data dosen.');
        }
    }

    // Untuk menampilkan seluruh informasi akun mahasiswa dan untuk mengganti kata sandi akunnya, jika mereka lupa.
    public function data_mahasiswa()
    {
        helper('form');
        $adminModel = new AdminModel();

        $mahasiswaData = $adminModel->getAllMahasiswa();

        $username = htmlspecialchars(session()->get("username"));
        $nim = $adminModel->getNIMByUsername($username);
        $profilePictureUrl = $adminModel->getProfilePictureByUsername($username);

        $admin = [
            'username' => $username,
            'nim' => $nim,
            'profile_picture' => $profilePictureUrl,
        ];

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'username' => 'required',
                'new_password' => 'required|min_length[6]',
            ];

            if ($this->validate($validationRules)) {
                $usernameToUpdate = $this->request->getPost('username');
                $newPassword = $this->request->getPost('new_password');

                $adminModel->updateMahasiswaPassword($usernameToUpdate, $newPassword);

                return redirect()->to('/admin/data_mahasiswa')->with('success', 'Password mahasiswa berhasil diubah.');
            } else {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }
        }
        return view('admin/data_mahasiswa', [
            'mahasiswaData' => $mahasiswaData,
            'admin' => $admin,
            'validation' => $this->validator,
        ]);
    }

    // Untuk menampilkan seluruh informasi data admin dan menambahkan admin yang baru
    public function data_admin()
    {
        helper('form');
        $adminModel = new AdminModel();

        $adminData = $adminModel->getAllAdmin();

        $username = htmlspecialchars(session()->get("username"));
        $nim = $adminModel->getNIMByUsername($username);
        $profilePictureUrl = $adminModel->getProfilePictureByUsername($username);

        $admin = [
            'username' => $username,
            'nim' => $nim,
            'profile_picture' => $profilePictureUrl,
        ];

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'new_username' => 'required|alpha_numeric|min_length[6]|is_unique[users.username]',
                'new_password' => 'required|min_length[6]',
                'nim' => 'required|numeric',
                'tipe_pengguna' => 'required',
            ];

            if ($this->validate($validationRules)) {
                $data = [
                    'username' => $this->request->getPost('new_username'),
                    'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT),
                    'nim' => $this->request->getPost('nim'),
                    'tipe_pengguna' => $this->request->getPost('tipe_pengguna'),
                ];

                $adminModel->insertAdmin($data);

                return redirect()->to('/admin/data_admin')->with('success', 'Admin baru berhasil ditambahkan.');
            } else {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }
        }

        return view('admin/data_admin', [
            'adminData' => $adminData,
            'admin' => $admin,
            'validation' => $this->validator,
        ]);
    }


    // Untuk menghapus admin
    public function delete_admin()
    {
        $adminModel = new AdminModel();

        if ($this->request->getMethod() === 'post') {
            $adminId = $this->request->getPost('admin_id');

            // Hapus admin dari database
            $adminModel->deleteAdmin($adminId);

            return redirect()->to('/admin/data_admin')->with('success', 'Admin berhasil dihapus.');
        }

        return redirect()->to('/admin/data_admin');
    }

    // Untuk menampilkan seluruh informasi profil admin dan dapat mengubahnya
    public function profilPengguna()
    {
        helper('form');

        $adminModel = new AdminModel();
        $userData = $adminModel->getUserDataByUsername(session()->get("username"));

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'username' => 'permit_empty|min_length[5]|max_length[255]|is_unique[users.username,id,' . $userData['id'] . ']',
                'password' => 'permit_empty|min_length[8]',
                'confirm_password' => 'matches[password]',
                'nim' => 'permit_empty|numeric',
                'profile_picture' => 'uploaded[profile_picture]|max_size[profile_picture,1024]|mime_in[profile_picture,image/jpg,image/jpeg,image/png]',
            ];

            if ($this->validate($validationRules)) {
                $username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                $nim = $this->request->getPost('nim');

                $userDataUpdate = [
                    'username' => $username,
                ];

                if (!empty($password)) {
                    $userDataUpdate['password'] = password_hash($password, PASSWORD_DEFAULT);
                }

                if (!empty($nim)) {
                    $userDataUpdate['nim'] = $nim;
                }

                $profilePicture = $this->request->getFile('profile_picture');

                if ($profilePicture->isValid()) {
                    $uploadPath = 'writable/uploads';

                    $oldProfilePicture = $adminModel->getProfilePictureByUsername(session()->get("username"));
                    if (!empty($oldProfilePicture)) {
                        $oldProfilePicturePath = $uploadPath . '/' . $oldProfilePicture;
                        if (file_exists($oldProfilePicturePath)) {
                            unlink($oldProfilePicturePath);
                        }
                    }

                    $newProfilePictureName = $profilePicture->getRandomName();
                    $profilePicture->move($uploadPath, $newProfilePictureName);

                    $userDataUpdate['profile_picture'] = $newProfilePictureName;

                    $adminData['admin']['profile_picture'] = $newProfilePictureName;
                    $admin['profile_picture'] = $newProfilePictureName;
                }

                $adminModel->updateUserData($userData['id'], $userDataUpdate);

                return redirect()->to('admin/profil_pengguna')->with('success', 'Profil berhasil diperbarui.');
            } else {
                return view('admin/profil_pengguna', [
                    'validation' => $this->validator,
                    'userData' => $userData,
                    'admin' => [
                        'username' => session()->get("username"),
                        'nim' => $adminModel->getNIMByUsername(session()->get("username")),
                        'profile_picture' => $adminModel->getProfilePictureByUsername(session()->get("username")),
                    ],
                ]);
            }
        }

        $adminData = [
            'admin' => [
                'username' => session()->get("username"),
                'nim' => $adminModel->getNIMByUsername(session()->get("username")),
                'profile_picture' => $adminModel->getProfilePictureByUsername(session()->get("username")),
            ],
            'userData' => $userData,
        ];

        return view('admin/profil_pengguna', $adminData);
    }


    // Untuk mendownload data hasil konversi nilai dalam bentuk ms excel
    public function downloadHasilKonversiNilaiExcel()
    {
        $adminModel = new AdminModel();

        // Dapatkan semua data dari tabel hasil_konversi_nilai
        $dataHasilKonversiNilai = $adminModel->getAllHasilKonversiNilai();

        // Buat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Gabungkan sel dan tambahkan judul
        $sheet->mergeCells('A1:N1');
        $sheet->setCellValue('A1', 'Laporan Hasil Konversi Nilai Mahasiswa');
        $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:N1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFA500');

        // Tambahkan header ke file Excel
        $headerRow = 3; // dimulai dari baris ketiga
        $sheet->setCellValue('A' . $headerRow, 'Nama Mahasiswa');
        $sheet->setCellValue('B' . $headerRow, 'NIM');
        $sheet->setCellValue('C' . $headerRow, 'Semester');
        $sheet->setCellValue('D' . $headerRow, 'Program Studi');
        $sheet->setCellValue('E' . $headerRow, 'Program MBKM');
        $sheet->setCellValue('F' . $headerRow, 'Lokasi Program');
        $sheet->setCellValue('G' . $headerRow, 'Dosen Pembimbing Lapangan');
        $sheet->setCellValue('H' . $headerRow, 'NIP Dosen Pembimbing Lapangan');
        $sheet->setCellValue('I' . $headerRow, 'Kegiatan');
        $sheet->setCellValue('J' . $headerRow, 'Rekognisi MK');
        $sheet->setCellValue('K' . $headerRow, 'Kode Matakuliah');
        $sheet->setCellValue('L' . $headerRow, 'SKS');
        $sheet->setCellValue('M' . $headerRow, 'Nilai');
        $sheet->setCellValue('N' . $headerRow, 'Grup ID');

        // Set warna latar belakang untuk baris header
        $sheet->getStyle('A' . $headerRow . ':N' . $headerRow)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFD700');

        // Loop melalui data dan tambahkan baris ke file Excel
        $row = $headerRow + 1; // dimulai dari baris berikutnya
        foreach ($dataHasilKonversiNilai as $rowdata) {
            $sheet->setCellValue('A' . $row, $rowdata['nama_mahasiswa']);
            $sheet->setCellValue('B' . $row, $rowdata['nim']);
            $sheet->setCellValue('C' . $row, $rowdata['semester']);
            $sheet->setCellValue('D' . $row, $rowdata['program_studi']);
            $sheet->setCellValue('E' . $row, $rowdata['program_mbkm']);
            $sheet->setCellValue('F' . $row, $rowdata['lokasi_program']);
            $sheet->setCellValue('G' . $row, $rowdata['dosen_pembimbing_lapangan']);
            $sheet->setCellValue('H' . $row, $rowdata['nip_dosen_pembimbing_lapangan']);
            $sheet->setCellValue('I' . $row, $rowdata['kegiatan']);
            $sheet->setCellValue('J' . $row, $rowdata['rekognisi_mk']);
            $sheet->setCellValue('K' . $row, $rowdata['kode_matakuliah']);
            $sheet->setCellValue('L' . $row, $rowdata['sks']);
            $sheet->setCellValue('M' . $row, $rowdata['nilai']);
            $sheet->setCellValue('N' . $row, $rowdata['grup_id']);

            // Set warna latar belakang untuk baris data bergantian
            if ($row % 2 == 0) {
                $sheet->getStyle('A' . $row . ':N' . $row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('F0F0F0');
            }

            $row++;
        }

        // Simpan file Excel
        $filename = 'hasil_konversi_nilai_' . date('d-M-Y_His') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save(WRITEPATH . 'uploads/' . $filename);

        // Atur header untuk memaksa pengunduhan
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Keluarkan file Excel ke browser
        $writer->save('php://output');
    }
}
