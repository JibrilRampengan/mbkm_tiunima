<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MahasiswaModel;

class Mahasiswa extends Controller
{

    // dashboard Mahasiswa
    public function dashboard_mahasiswa()
    {
        $mahasiswaModel = new MahasiswaModel();

        $username = htmlspecialchars(session()->get("username"));
        $nim = $mahasiswaModel->getNIMByUsername($username);
        $profilePictureUrl = $mahasiswaModel->getProfilePictureByUsername($username);

        // Menghitung jumlah mahasiswa yang mengajukan konversi nilai
        $jumlahKonversi = $mahasiswaModel->countKonversiByGrupId($nim);

        // Menghitung jumlah pengajuan mahasiswa yang disetujui berdasarkan nim
        $jumlahDisetujui = $mahasiswaModel->countPengajuanDisetujui($nim);

        // Menghitung jumlah konversi nilai yang telah selesai berdasarkan nim
        $jumlahSelesai = $mahasiswaModel->countKonversiSelesai($nim);

        $data['mahasiswa'] = [
            'username' => $username,
            'nim' => $nim,
            'profile_picture' => $profilePictureUrl,
            'jumlah_konversi' => $jumlahKonversi,
            'jumlah_disetujui' => $jumlahDisetujui,
            'jumlah_selesai' => $jumlahSelesai,
        ];

        return view('mahasiswa/dashboard_mahasiswa', $data);
    }


    // logika untuk input matakuliah
    public function input_matakuliah()
    {
        $mahasiswaModel = new MahasiswaModel();

        $data['matakuliahOptions'] = $mahasiswaModel->getMatakuliahOptions();
        $data['dosenOptions'] = $mahasiswaModel->getDosenOptions();

        if ($this->request->getMethod() === 'post') {
            $validationRules = [
                'nama' => 'required',
                'fakultas' => 'required',
                'program_studi' => 'required',
                'semester' => 'required|numeric',
            ];

            if ($this->request->getFile('file_krs')) {
                $validationRules['file_krs'] = 'max_size[file_krs,1024]|ext_in[file_krs,pdf,doc,docx]';
            }

            if ($this->validate($validationRules)) {
                $namaMahasiswa = $this->request->getPost('nama');
                $fakultas = $this->request->getPost('fakultas');
                $programStudi = $this->request->getPost('program_studi');
                $semester = $this->request->getPost('semester');

                $namaMatakuliahArray = is_array($this->request->getPost('nama_matakuliah'))
                    ? $this->request->getPost('nama_matakuliah')
                    : [$this->request->getPost('nama_matakuliah')];

                $kodeMatakuliahArray = is_array($this->request->getPost('kode_matakuliah'))
                    ? $this->request->getPost('kode_matakuliah')
                    : [$this->request->getPost('kode_matakuliah')];

                $sksArray = is_array($this->request->getPost('sks'))
                    ? $this->request->getPost('sks')
                    : [$this->request->getPost('sks')];

                $namaDosenArray = is_array($this->request->getPost('nama_dosen'))
                    ? $this->request->getPost('nama_dosen')
                    : [$this->request->getPost('nama_dosen')];

                $namaDosenManualArray = is_array($this->request->getPost('nama_dosen_manual'))
                    ? $this->request->getPost('nama_dosen_manual')
                    : [$this->request->getPost('nama_dosen_manual')];

                $grupId = strtolower(str_replace(' ', '_', $namaMahasiswa)) . '_semester_' . $semester;

                $fileKrs = $this->request->getFile('file_krs');
                $originalNameKrs = null;

                if ($fileKrs->isValid() && !$fileKrs->hasMoved()) {
                    $originalNameKrs = $fileKrs->getName();
                    $fileKrs->move('./uploads/' . $grupId . '/krs', $originalNameKrs);
                }

                foreach ($namaMatakuliahArray as $key => $namaMatakuliah) {
                    $namaDosen = ($namaDosenArray[$key] === 'tambah_manual') ? $namaDosenManualArray[$key] : $namaDosenArray[$key];

                    $dataMatakuliah = [
                        'nama_mahasiswa' => $namaMahasiswa,
                        'fakultas' => $fakultas,
                        'program_studi' => $programStudi,
                        'semester' => $semester,
                        'nama_matakuliah' => $namaMatakuliah,
                        'kode_matakuliah' => $kodeMatakuliahArray[$key],
                        'sks' => $sksArray[$key],
                        'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                        'nama_dosen' => $namaDosen,
                        'status' => 'menunggu verifikasi',
                        'grup_id' => $grupId,
                        'file_krs' => $originalNameKrs,
                    ];

                    $mahasiswaModel->saveMatakuliah($dataMatakuliah);
                }

                return redirect()->to('mahasiswa/input_matakuliah')->with('success', 'Matakuliah berhasil diinput. Menunggu verifikasi.');
            } else {
                return view('mahasiswa/input_matakuliah', [
                    'validation' => $this->validator,
                    'mahasiswa' => [
                        'username' => session()->get("username"),
                        'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                        'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
                    ],
                    'matakuliahOptions' => $data['matakuliahOptions'],
                    'dosenOptions' => $data['dosenOptions'],
                ]);
            }
        }

        $data['allMatakuliah'] = $mahasiswaModel->getAllMatakuliah();

        return view('mahasiswa/input_matakuliah', [
            'mahasiswa' => [
                'username' => session()->get("username"),
                'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
            ],
            'matakuliahOptions' => $data['matakuliahOptions'],
            'dosenOptions' => $data['dosenOptions'],
            'allMatakuliah' => $data['allMatakuliah'],
        ]);
    }

    // logika untuk edit data matakuliah mahasiswa
    public function edit_matakuliah($matakuliahId)
    {
        helper('form');

        $mahasiswaModel = new MahasiswaModel();

        $matakuliah = $mahasiswaModel->getMatakuliahById($matakuliahId);

        $data['matakuliahOptions'] = $mahasiswaModel->getMatakuliahOptions();
        $data['dosenOptions'] = $mahasiswaModel->getDosenOptions();

        if ($this->request->getMethod() === 'post') {
            // Validasi form
            $validationRules = [
                'nama' => 'required',
                'fakultas' => 'required',
                'program_studi' => 'required',
                'semester' => 'required|numeric',
                'file_krs' => 'max_size[file_krs,1024]|ext_in[file_krs,pdf,doc,docx]',
            ];

            if ($this->validate($validationRules)) {
                $namaMahasiswa = $this->request->getPost('nama');
                $fakultas = $this->request->getPost('fakultas');
                $programStudi = $this->request->getPost('program_studi');
                $semester = $this->request->getPost('semester');

                // Simpan data ke database
                $dataMatakuliah = [
                    'nama_mahasiswa' => $namaMahasiswa,
                    'fakultas' => $fakultas,
                    'program_studi' => $programStudi,
                    'semester' => $semester,
                    'nama_matakuliah' => $this->request->getPost('nama_matakuliah'),
                    'kode_matakuliah' => $this->request->getPost('kode_matakuliah'),
                    'sks' => $this->request->getPost('sks'),
                    'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                    'nama_dosen' => $this->request->getPost('nama_dosen'),
                    'status' => 'menunggu verifikasi',
                    'grup_id' => strtolower(str_replace(' ', '_', $namaMahasiswa)) . '_semester_' . $semester,
                ];

                $fileKrs = $this->request->getFile('file_krs');
                $originalNameKrs = null;

                if ($fileKrs->isValid() && !$fileKrs->hasMoved()) {
                    $grupId = $dataMatakuliah['grup_id'];

                    if ($matakuliah['file_krs']) {
                        unlink('./uploads/' . $grupId . '/krs/' . $matakuliah['file_krs']);
                    }

                    $originalNameKrs = $fileKrs->getName();
                    $fileKrs->move('./uploads/' . $grupId . '/krs', $originalNameKrs);

                    $dataMatakuliah['file_krs'] = $originalNameKrs;
                }


                $mahasiswaModel->updateMatakuliah($matakuliahId, $dataMatakuliah);

                return redirect()->to('mahasiswa/input_matakuliah')->with('success', 'Matakuliah berhasil diupdate. Menunggu verifikasi.');
            } else {
                return view('mahasiswa/edit_matakuliah', [
                    'validation' => $this->validator,
                    'mahasiswa' => [
                        'username' => session()->get("username"),
                        'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                        'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
                    ],
                    'matakuliahOptions' => $data['matakuliahOptions'],
                    'dosenOptions' => $data['dosenOptions'],
                    'matakuliah' => $matakuliah,
                ]);
            }
        }

        return view('mahasiswa/edit_matakuliah', [
            'mahasiswa' => [
                'username' => session()->get("username"),
                'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
            ],
            'matakuliahOptions' => $data['matakuliahOptions'],
            'dosenOptions' => $data['dosenOptions'],
            'matakuliah' => $matakuliah,
        ]);
    }


    // logika untuk mendelete data matakuliah yang di input oleh mahasiswa
    public function deleteMatakuliah($matakuliahId)
    {
        $mahasiswaModel = new MahasiswaModel();

        $matakuliah = $mahasiswaModel->getMatakuliahById($matakuliahId);

        var_dump($matakuliah);

        $mahasiswaModel->deleteMatakuliah($matakuliahId);

        if (empty($otherMatakuliahWithSameGrupId)) {
            if (!empty($matakuliah['file_krs'])) {
                $filePath = FCPATH . 'uploads/' . $matakuliah['grup_id'] . '/krs/' . $matakuliah['file_krs'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                    rmdir(FCPATH . 'uploads/' . $matakuliah['grup_id'] . '/krs');
                }
            }
        }

        return redirect()->to('mahasiswa/input_matakuliah')->with('success', 'Matakuliah berhasil dihapus.');
    }



    // Logika untuk input_programmbkm
    public function input_programmbkm()
    {
        $mahasiswaModel = new MahasiswaModel();

        $data['programMbkmList'] = $mahasiswaModel->getProgramMbkmList();
        $data['dosenOptions'] = $mahasiswaModel->getDosenOptions();

        if ($this->request->getMethod() === 'post') {
            // Validasi form
            $validationRules = [
                'nama' => 'required',
                'nim' => 'required',
                'semester' => 'required|numeric',
                'fakultas' => 'required',
                'program_studi' => 'required',
                'program_mbkm' => 'required',
                'lokasi_program' => 'required',
                'dosen_pembimbing' => 'required',
                'nip_dosen_pembimbing' => 'required',
                'kegiatan' => 'required',
                'nilai' => 'required',
                'file_bukti' => 'uploaded[file_bukti]|max_size[file_bukti,1024]|ext_in[file_bukti,pdf,doc,docx]',
            ];

            if ($this->validate($validationRules)) {
                $namaMahasiswa = $this->request->getPost('nama');
                $nim = $this->request->getPost('nim');
                $semester = $this->request->getPost('semester');
                $fakultas = $this->request->getPost('fakultas');
                $programStudi = $this->request->getPost('program_studi');
                $lokasiProgram = $this->request->getPost('lokasi_program');
                $dosenPembimbing = $this->request->getPost('dosen_pembimbing');
                $nipDosenPembimbing = $this->request->getPost('nip_dosen_pembimbing');
                $fileBukti = $this->request->getFile('file_bukti');

                $programMbkm = $this->request->getPost('program_mbkm') === 'Lainnya'
                    ? $this->request->getPost('other_program_mbkm')
                    : $this->request->getPost('program_mbkm');

                $kegiatanList = $this->request->getPost('kegiatan');
                $nilaiList = $this->request->getPost('nilai');

                if ($fileBukti->isValid() && !$fileBukti->hasMoved()) {
                    $originalNameBukti = $fileBukti->getName();

                    // Grup_id berdasarkan nama_mahasiswa dan program_mbkm
                    $grupId = strtolower(str_replace(' ', '_', $namaMahasiswa)) . '_semester_' . strtolower(str_replace(' ', '_', $semester));

                    // Simpan file_bukti
                    $fileBukti->move('./uploads/' . $grupId . '/bukti/', $originalNameBukti);

                    // Loop foreach untuk menyimpan data dinamis
                    foreach ($kegiatanList as $key => $kegiatan) {
                        $dataProgramMbkm = [
                            'nama_mahasiswa' => $namaMahasiswa,
                            'nim' => $nim,
                            'semester' => $semester,
                            'fakultas' => $fakultas,
                            'program_studi' => $programStudi,
                            'program_mbkm' => $programMbkm,
                            'lokasi_program' => $lokasiProgram,
                            'dosen_pembimbing' => $dosenPembimbing,
                            'nip_dosen_pembimbing' => $nipDosenPembimbing,
                            'kegiatan' => $kegiatan,
                            'nilai' => $nilaiList[$key],
                            'file_bukti' => $originalNameBukti,
                            'status' => 'menunggu verifikasi',
                            'grup_id' => $grupId,
                        ];

                        // Simpan data ke database
                        $mahasiswaModel->saveProgramMbkm($dataProgramMbkm);
                    }

                    return redirect()->to('mahasiswa/input_programmbkm')->with('success', 'Program MBKM berhasil diinput. Menunggu verifikasi.');
                }
            } else {
                return view('mahasiswa/input_programmbkm', [
                    'validation' => $this->validator,
                    'mahasiswa' => [
                        'username' => session()->get("username"),
                        'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                        'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
                    ],
                    'dosenOptions' => $data['dosenOptions'],
                    'programMbkmList' => $data['programMbkmList'],
                ]);
            }
        }

        return view('mahasiswa/input_programmbkm', [
            'mahasiswa' => [
                'username' => session()->get("username"),
                'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
            ],
            'dosenOptions' => $data['dosenOptions'],
            'programMbkmList' => $data['programMbkmList'],
        ]);
    }

    // Logika untuk mengedit data edit_programmbkm
    public function edit_programmbkm($programMbkmId)
    {
        helper('form');

        $mahasiswaModel = new MahasiswaModel();

        $programMbkm = $mahasiswaModel->getProgramMbkmById($programMbkmId);

        $grupId = strtolower(str_replace(' ', '_', $programMbkm['nama_mahasiswa'])) . '_semester_' . strtolower(str_replace(' ', '_', $programMbkm['semester']));

        if ($this->request->getMethod() === 'post') {
            // Validasi form
            $validationRules = [
                'nama' => 'required',
                'nim' => 'required',
                'semester' => 'required|numeric',
                'fakultas' => 'required',
                'program_studi' => 'required',
                'program_mbkm' => 'required',
                'lokasi_program' => 'required',
                'dosen_pembimbing' => 'required',
                'nip_dosen_pembimbing' => 'required',
                'kegiatan' => 'required',
                'nilai' => 'required',
                'file_bukti' => 'max_size[file_bukti,1024]|ext_in[file_bukti,pdf,doc,docx]',
            ];

            if ($this->validate($validationRules)) {
                $namaMahasiswa = $this->request->getPost('nama');
                $nim = $this->request->getPost('nim');
                $semester = $this->request->getPost('semester');
                $fakultas = $this->request->getPost('fakultas');
                $programStudi = $this->request->getPost('program_studi');
                $programMbkm = $this->request->getPost('program_mbkm');
                $lokasiProgram = $this->request->getPost('lokasi_program');
                $dosenPembimbing = $this->request->getPost('dosen_pembimbing');
                $nipDosenPembimbing = $this->request->getPost('nip_dosen_pembimbing');
                $kegiatan = $this->request->getPost('kegiatan');
                $nilai = $this->request->getPost('nilai');

                $fileBukti = $this->request->getFile('file_bukti');
                $originalName = null;

                // Jika file bukti diunggah
                if ($fileBukti->isValid() && !$fileBukti->hasMoved()) {
                    // Hapus file lama jika sudah ada
                    if (!empty($programMbkm['file_bukti'])) {
                        $oldFilePath = './uploads/' . $grupId . '/bukti/' . $programMbkm['file_bukti'];
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }

                    $originalName = $fileBukti->getName();

                    // Simpan file_bukti ke direktori yang sesuai
                    $fileBukti->move('./uploads/' . $grupId . '/bukti/', $originalName);
                } else {
                    $originalName = $programMbkm['file_bukti'];
                }

                $dataProgramMbkm = [
                    'nama_mahasiswa' => $namaMahasiswa,
                    'nim' => $nim,
                    'semester' => $semester,
                    'fakultas' => $fakultas,
                    'program_studi' => $programStudi,
                    'program_mbkm' => $programMbkm,
                    'lokasi_program' => $lokasiProgram,
                    'dosen_pembimbing' => $dosenPembimbing,
                    'nip_dosen_pembimbing' => $nipDosenPembimbing,
                    'kegiatan' => $kegiatan,
                    'nilai' => $nilai,
                    'file_bukti' => $originalName,
                    'status' => 'menunggu verifikasi',
                ];

                // Simpan data ke database
                $mahasiswaModel->updateProgramMbkm($programMbkmId, $dataProgramMbkm);

                return redirect()->to('mahasiswa/input_programmbkm')->with('success', 'Program MBKM berhasil diupdate. Menunggu verifikasi.');
            } else {
                return view('mahasiswa/edit_programmbkm', [
                    'validation' => $this->validator,
                    'mahasiswa' => [
                        'username' => session()->get("username"),
                        'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                        'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
                    ],
                    'programMbkm' => $programMbkm,
                ]);
            }
        }

        return view('mahasiswa/edit_programmbkm', [
            'mahasiswa' => [
                'username' => session()->get("username"),
                'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
            ],
            'programMbkm' => $programMbkm,
        ]);
    }

    // Logika untuk menghapus data program_mbkm berdasarkan id
    public function delete_programmbkm($programMbkmId)
    {
        $mahasiswaModel = new MahasiswaModel();

        $programMbkm = $mahasiswaModel->getProgramMbkmById($programMbkmId);

        if (!empty($programMbkm['file_bukti'])) {
            $filePath = './uploads/' . $programMbkm['grup_id'] . '/bukti/' . $programMbkm['file_bukti'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $mahasiswaModel->deleteProgramMbkm($programMbkmId);

        return redirect()->to('mahasiswa/input_programmbkm')->with('success', 'Program MBKM berhasil dihapus.');
    }


    // Untuk menampilkan status data matakuliah dan program mbkm di halaman status 
    public function viewStatus()
    {
        $mahasiswaModel = new MahasiswaModel();

        $matakuliahStatus = $mahasiswaModel->getFirstMatakuliahStatusByUsername(session()->get("username"));

        $programMbkmStatus = $mahasiswaModel->getFirstProgramMbkmStatusByUsername(session()->get("username"));

        $combinedData = [];

        foreach ($matakuliahStatus as $matakuliah) {
            $combinedData[$matakuliah['grup_id']]['nama_mahasiswa'] = $matakuliah['nama_mahasiswa'];
            $combinedData[$matakuliah['grup_id']]['nim'] = $matakuliah['nim'];
            $combinedData[$matakuliah['grup_id']]['semester'] = $matakuliah['semester'];
            $combinedData[$matakuliah['grup_id']]['program_mbkm'] = '';
            $combinedData[$matakuliah['grup_id']]['status'] = $matakuliah['status'];
        }

        foreach ($programMbkmStatus as $programMbkm) {
            $combinedData[$programMbkm['grup_id']]['program_mbkm'] = $programMbkm['program_mbkm'];
        }

        return view('mahasiswa/status', [
            'mahasiswa' => [
                'username' => session()->get("username"),
                'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
            ],
            'combinedData' => $combinedData,
        ]);
    }

    // untuk menyesuaikan data matakuliah da program mbkm
    public function konversi_nilai()
    {
        $mahasiswaModel = new MahasiswaModel();

        $matakuliahStatus = $mahasiswaModel->getApprovedMatakuliahStatusByUsername(session()->get("username"));

        $programMbkmStatus = $mahasiswaModel->getApprovedProgramMbkmStatusByUsername(session()->get("username"));

        $kegiatan = $mahasiswaModel->getDistinctApprovedProgramMbkmActivities();

        $namaMatakuliahOptions = $mahasiswaModel->getDistinctApprovedMatakuliahMbkmMahasiswa();

        $kodeMatakuliahOptions = $mahasiswaModel->getDistinctApprovedKodeMatakuliah();

        $sksOptions = $mahasiswaModel->getDistinctApprovedSKS();

        $nilaiOptions = $mahasiswaModel->getDistinctApprovedNilai();

        $dosenPembimbingOptions = $mahasiswaModel->getDistinctApprovedDosenPembimbing();

        $nipDosenPembimbingOptions = $mahasiswaModel->getDistinctApprovedNipDosenPembimbing();

        $lokasiProgramOptions = $mahasiswaModel->getDistinctApprovedLokasiProgram();

        $konversiNilaiData = $mahasiswaModel->getKonversiNilaiData(session()->get("username"));


        // menggabungkan data matakuliah dan program mbkm
        $combinedData = [];

        foreach ($matakuliahStatus as $matakuliah) {
            $combinedData[$matakuliah['grup_id']]['nama_mahasiswa'] = $matakuliah['nama_mahasiswa'];
            $combinedData[$matakuliah['grup_id']]['nim'] = $matakuliah['nim'];
            $combinedData[$matakuliah['grup_id']]['semester'] = $matakuliah['semester'];
            $combinedData[$matakuliah['grup_id']]['program_mbkm'] = '';
            $combinedData[$matakuliah['grup_id']]['fakultas'] = $matakuliah['fakultas'];
            $combinedData[$matakuliah['grup_id']]['program_studi'] = $matakuliah['program_studi'];
            $combinedData[$matakuliah['grup_id']]['status'] = $matakuliah['status'];
        }

        foreach ($programMbkmStatus as $programMbkm) {
            $grup_id = $programMbkm['grup_id'];
            $combinedData[$grup_id]['program_mbkm'] = $programMbkm['program_mbkm'];
        }

        return view('mahasiswa/konversi_nilai', [
            'mahasiswa' => [
                'username' => session()->get("username"),
                'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
            ],
            'combinedData' => $combinedData,
            'kegiatan' => $kegiatan,
            'namaMatakuliahOptions' => $namaMatakuliahOptions,
            'kodeMatakuliahOptions' => $kodeMatakuliahOptions,
            'sksOptions' => $sksOptions,
            'nilaiOptions' => $nilaiOptions,
            'konversiNilaiData' => $konversiNilaiData,
            'dosenPembimbingOptions' => $dosenPembimbingOptions,
            'nipDosenPembimbingOptions' => $nipDosenPembimbingOptions,
            'lokasiProgramOptions' => $lokasiProgramOptions,
        ]);
    }

    // menyimpan data gabungan antara data matakuliah dan program mbkm ke dalam database
    public function saveKonversiNilai()
    {
        $mahasiswaModel = new MahasiswaModel();

        $namaMahasiswa = $this->request->getPost('nama_mahasiswa');
        $nim = $this->request->getPost('nim');
        $programMbkm = $this->request->getPost('program_mbkm');

        $semester = $this->request->getPost('semester');
        $fakultas = $this->request->getPost('fakultas');
        $programStudi = $this->request->getPost('program_studi');
        $lokasiProgram = $this->request->getPost('lokasi_program');
        $dosenPembimbing = $this->request->getPost('dosen_pembimbing_lapangan');
        $nipDosenPembimbing = $this->request->getPost('nip_dosen_pembimbing_lapangan');

        $kegiatan = $this->request->getPost('kegiatan');
        $rekognisiMk = $this->request->getPost('rekognisi_mk');
        $kodeMatakuliah = $this->request->getPost('kode_matakuliah');
        $sks = $this->request->getPost('sks');
        $nilai = $this->request->getPost('nilai');

        // Grup_id berdasarkan nama_mahasiswa dan program_mbkm
        $grupId = strtolower(str_replace(' ', '_', $namaMahasiswa)) . '_program_' . strtolower(str_replace(' ', '_', $programMbkm));

        for ($i = 0; $i < count($kegiatan); $i++) {
            $dataKonversiNilai = [
                'nama_mahasiswa' => $namaMahasiswa,
                'nim' => $nim,
                'semester' => $semester,
                'fakultas' => $fakultas,
                'program_studi' => $programStudi,
                'lokasi_program' => $lokasiProgram,
                'dosen_pembimbing_lapangan' => $dosenPembimbing,
                'nip_dosen_pembimbing_lapangan' => $nipDosenPembimbing,
                'program_mbkm' => $programMbkm,
                'kegiatan' => $kegiatan[$i],
                'rekognisi_mk' => $rekognisiMk[$i],
                'kode_matakuliah' => $kodeMatakuliah[$i],
                'sks' => $sks[$i],
                'nilai' => $nilai[$i],
                'grup_id' => $grupId,
                'status' => 'Menunggu Verifikasi',
            ];

            $mahasiswaModel->saveKonversiNilai($dataKonversiNilai);
        }

        return redirect()->to('mahasiswa/konversi_nilai')->with('success', 'Data konversi nilai berhasil disimpan.');
    }

    // Logika untuk mengedit data konversi nilai
    public function editKonversiNilai($konversiNilaiId)
    {
        helper('form');

        $mahasiswaModel = new MahasiswaModel();

        $konversiNilai = $mahasiswaModel->getKonversiNilaiById($konversiNilaiId);

        if ($this->request->getMethod() === 'post') {
            // Validasi form
            $validationRules = [
                'nama_mahasiswa' => 'required',
                'nim' => 'required',
                'semester' => 'required|numeric',
                'fakultas' => 'required',
                'program_studi' => 'required',
                'lokasi_program' => 'required',
                'dosen_pembimbing_lapangan' => 'required',
                'nip_dosen_pembimbing_lapangan' => 'required',
                'program_mbkm' => 'required',
                'kegiatan' => 'required',
                'rekognisi_mk' => 'required',
                'kode_matakuliah' => 'required',
                'sks' => 'required|numeric',
                'nilai' => 'required',
            ];

            if ($this->validate($validationRules)) {
                // Ambil data dari form
                $namaMahasiswa = $this->request->getPost('nama_mahasiswa');
                $nim = $this->request->getPost('nim');
                $semester = $this->request->getPost('semester');
                $fakultas = $this->request->getPost('fakultas');
                $programStudi = $this->request->getPost('program_studi');
                $lokasiProgram = $this->request->getPost('lokasi_program');
                $dosenPembimbing = $this->request->getPost('dosen_pembimbing_lapangan');
                $nipDosenPembimbing = $this->request->getPost('nip_dosen_pembimbing_lapangan');
                $programMbkm = $this->request->getPost('program_mbkm');
                $kegiatan = $this->request->getPost('kegiatan');
                $rekognisiMk = $this->request->getPost('rekognisi_mk');
                $kodeMatakuliah = $this->request->getPost('kode_matakuliah');
                $sks = $this->request->getPost('sks');
                $nilai = $this->request->getPost('nilai');

                // Simpan data ke database
                $dataKonversiNilai = [
                    'nama_mahasiswa' => $namaMahasiswa,
                    'nim' => $nim,
                    'semester' => $semester,
                    'fakultas' => $fakultas,
                    'program_studi' => $programStudi,
                    'lokasi_program' => $lokasiProgram,
                    'dosen_pembimbing_lapangan' => $dosenPembimbing,
                    'nip_dosen_pembimbing_lapangan' => $nipDosenPembimbing,
                    'program_mbkm' => $programMbkm,
                    'kegiatan' => $kegiatan,
                    'rekognisi_mk' => $rekognisiMk,
                    'kode_matakuliah' => $kodeMatakuliah,
                    'sks' => $sks,
                    'nilai' => $nilai,
                    'status' => 'Menunggu Verifikasi',
                ];

                $mahasiswaModel->updateKonversiNilai($konversiNilaiId, $dataKonversiNilai);

                return redirect()->to('mahasiswa/konversi_nilai')->with('success', 'Data konversi nilai berhasil diupdate. Menunggu verifikasi.');
            } else {
                return view('mahasiswa/edit_konversi_nilai', [
                    'validation' => $this->validator,
                    'mahasiswa' => [
                        'username' => session()->get("username"),
                        'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                        'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
                    ],
                    'konversiNilai' => $konversiNilai,
                ]);
            }
        }

        return view('mahasiswa/edit_konversi_nilai', [
            'mahasiswa' => [
                'username' => session()->get("username"),
                'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
            ],
            'konversiNilai' => $konversiNilai,
        ]);
    }

    //menghapus data konversi nilai gabungan dari data matakuliah dan program mbkm
    public function deleteKonversiNilai($konversiNilaiId)
    {
        $mahasiswaModel = new MahasiswaModel();


        $konversiNilai = $mahasiswaModel->getKonversiNilaiById($konversiNilaiId);
        if (!$konversiNilai) {
            return redirect()->to('mahasiswa/konversi_nilai')->with('error', 'Data konversi nilai tidak ditemukan.');
        }

        // Hapus data konversi nilai dari database
        $mahasiswaModel->deleteKonversiNilai($konversiNilaiId);

        return redirect()->to('mahasiswa/konversi_nilai')->with('success', 'Data konversi nilai berhasil dihapus.');
    }

    // menampilkan data hasil konversi nilai
    public function hasilKonversiNilai()
    {
        $mahasiswaModel = new MahasiswaModel();

        $hasilKonversiNilaiData = $mahasiswaModel->getHasilKonversiNilaiData();

        return view('mahasiswa/hasil_konversi_nilai', [
            'mahasiswa' => [
                'username' => session()->get("username"),
                'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
            ],
            'hasilKonversiNilaiData' => $hasilKonversiNilaiData,
        ]);
    }

    // menampilkan berita acara dari data hasil konversi nilai
    public function beritaAcara()
    {
        $mahasiswaModel = new MahasiswaModel();

        $grupIds = $mahasiswaModel->getDistinctGrupIds();

        return view('mahasiswa/berita_acara', [
            'mahasiswa' => [
                'username' => session()->get("username"),
                'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
            ],
            'grupIds' => $grupIds,
        ]);
    }

    // pembuatan berita acara hasil konversi nilai
    public function cetakBeritaAcara()
    {
        $mahasiswaModel = new MahasiswaModel();

        $grupId = $this->request->getPost('grup_id');

        // Mendapatkan data konversi nilai berdasarkan grup_id
        $konversiNilaiData = $mahasiswaModel->getKonversiNilaiByGrupId($grupId);

        // Mendapatkan Dosen Pembimbing Name Value berdasarkan grup_id
        $dosenPembimbingValue = $mahasiswaModel->getDosenPembimbingByGrupId($grupId);

        // Mendapatkan NIP Dosen Pembimbing Value berdasarkan grup_id
        $nipDosenPembimbingValue = $mahasiswaModel->getNipDosenPembimbingByGrupId($grupId);

        // Mendapatkan Program MBKM Value berdasarkan grup_id
        $programMbkmValue = $mahasiswaModel->getProgramMbkmValueByGrupId($grupId);

        // Mendapatkan NIM Value berdasarkan grup_id
        $nimValue = $mahasiswaModel->getNimByGrupId($grupId);

        // Mendapatkan Nama Lengkap Value berdasarkan grup_id
        $namaLengkapValue = $mahasiswaModel->getNamaLengkapByGrupId($grupId);

        // Mendapatkan Semester Value berdasarkan grup_id
        $semesterValue = $mahasiswaModel->getSemesterByGrupId($grupId);

        // Mendapatkan Program Studi Value berdasarkan grup_id
        $programStudiValue = $mahasiswaModel->getProgramStudiByGrupId($grupId);

        // Mendapatkan Lokasi MBKM Value berdasarkan grup_id
        $lokasiMbkmValue = $mahasiswaModel->getLokasiMbkmByGrupId($grupId);

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


    // Logika untuk informasi akun mahasiswa
    public function profilPengguna()
    {
        helper('form');

        $mahasiswaModel = new MahasiswaModel();
        $userData = $mahasiswaModel->getUserDataByUsername(session()->get("username"));

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

                    $oldProfilePicture = $mahasiswaModel->getProfilePictureByUsername(session()->get("username"));
                    if (!empty($oldProfilePicture)) {
                        $oldProfilePicturePath = $uploadPath . '/' . $oldProfilePicture;
                        if (file_exists($oldProfilePicturePath)) {
                            unlink($oldProfilePicturePath);
                        }
                    }

                    // Upload foto profil baru
                    $newProfilePictureName = $profilePicture->getRandomName();
                    $profilePicture->move($uploadPath, $newProfilePictureName);

                    $userDataUpdate['profile_picture'] = $newProfilePictureName;

                    $mahasiswaData['mahasiswa']['profile_picture'] = $newProfilePictureName;
                    $mahasiswa['profile_picture'] = $newProfilePictureName;
                }

                $mahasiswaModel->updateUserData($userData['id'], $userDataUpdate);

                return redirect()->to('mahasiswa/profil_pengguna')->with('success', 'Profil berhasil diperbarui.');
            } else {
                return view('mahasiswa/profil_pengguna', [
                    'validation' => $this->validator,
                    'userData' => $userData,
                    'mahasiswa' => [
                        'username' => session()->get("username"),
                        'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                        'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
                    ],
                ]);
            }
        }

        $mahasiswaData = [
            'mahasiswa' => [
                'username' => session()->get("username"),
                'nim' => $mahasiswaModel->getNIMByUsername(session()->get("username")),
                'profile_picture' => $mahasiswaModel->getProfilePictureByUsername(session()->get("username")),
            ],
            'userData' => $userData,
        ];

        return view('mahasiswa/profil_pengguna', $mahasiswaData);
    }
}
