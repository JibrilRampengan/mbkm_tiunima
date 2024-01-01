<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'users';

    public function getNIMByUsername($username)
    {
        // Mendapatkan nim berdasarkan username
        $result = $this->select('nim')
            ->where('username', $username)
            ->first();

        return $result ? $result['nim'] : null;
    }

    // Mendapatkan foto profile
    public function getProfilePictureByUsername($username)
    {
        $result = $this->select('profile_picture')
            ->where('username', $username)
            ->first();

        return $result ? $result['profile_picture'] : null;
    }

    // Mendapatkan jumlah mahasiswa yang mengajukan konversi nilai
    public function countKonversiByGrupId($grupId)
    {
        try {
            $table = 'matakuliah_mahasiswa';
            $primaryKey = 'nim';

            $result = $this->table($table)->where('nim', $grupId)->countAllResults();

            return $result;
        } catch (\Exception $e) {
            log_message('error', 'Error counting konversi: ' . $e->getMessage());
            return 0;
        }
    }

    // Mendapatkan jumlah pengajuan yang telah disetujui
    public function countPengajuanDisetujui($nim)
    {
        return $this->db->table('matakuliah_mahasiswa')
            ->distinct()
            ->select('nim')
            ->where('nim', $nim)
            ->where('status', 'disetujui')
            ->countAllResults();
    }

    // Mendapat jumlah hasil konversi nilai
    public function countKonversiSelesai($nim)
    {
        return $this->db->table('hasil_konversi_nilai')
            ->distinct()
            ->select('nim')
            ->where('nim', $nim)
            ->countAllResults();
    }

    // Menyimpan data matakuliah kedalam database dan ke server
    public function saveMatakuliah($data)
    {
        $data['file_krs'] = isset($data['file_krs']) ? $data['file_krs'] : null;

        return $this->db->table('matakuliah_mahasiswa')->insert($data);
    }

    // Mengambil data nama_matakuliah, kode_matakuliah, dan sks dari tabel matakuliah_programstudi pada database untuk dropdown
    public function getMatakuliahOptions()
    {
        $result = $this->db->table('matakuliah_programstudi')
            ->select('id, nama_matakuliah, kode_matakuliah, sks')
            ->get()
            ->getResultArray();

        $options = [];
        foreach ($result as $matakuliah) {
            $options[$matakuliah['id']] = $matakuliah;
        }

        return $options;
    }

    // Mengambil Data Dosen dari tabel dosen_tiunima pada database untuk dropdown
    public function getDosenOptions()
    {
        $result = $this->db->table('dosen_tiunima')
            ->select('nama_dosen, nip_dosen')
            ->get()
            ->getResultArray();

        $dosenOptions = [];
        foreach ($result as $row) {
            $dosenOptions[$row['nip_dosen']] = $row['nama_dosen'];
        }

        return $dosenOptions;
    }

    // Mengambil semua data matakuliah mahasiswa dari database untuk dropdown
    public function getAllMatakuliah()
    {
        return $this->db->table('matakuliah_mahasiswa')->where('nim', $this->getNIMByUsername(session()->get("username")))->get()->getResultArray();
    }


    // Mendapatkan data matakuliah berdasarkan ID
    public function getMatakuliahById($matakuliahId)
    {
        return $this->db->table('matakuliah_mahasiswa')
            ->where('id', $matakuliahId)
            ->get()
            ->getRowArray();
    }

    public function getMatakuliahByGrupId($grupId)
    {
        return $this->db->table('matakuliah_mahasiswa')
            ->where('grup_id', $grupId)
            ->get()
            ->getResultArray();
    }

    // Update data matakuliah mahasiswa berdasarkan ID
    public function updateMatakuliah($matakuliahId, $data)
    {
        $data['file_krs'] = isset($data['file_krs']) ? $data['file_krs'] : null;

        return $this->db->table('matakuliah_mahasiswa')
            ->where('id', $matakuliahId)
            ->update($data);
    }

    // Hapus data matakuliah dari database
    public function deleteMatakuliah($matakuliahId)
    {
        return $this->db->table('matakuliah_mahasiswa')
            ->where('id', $matakuliahId)
            ->delete();
    }

    // Menyimpan data program mbkm mahasiswa kedalam database
    public function saveProgramMbkm($data)
    {
        $data['file_bukti'] = isset($data['file_bukti']) ? $data['file_bukti'] : null;

        return $this->db->table('program_mbkm')->insert($data);
    }

    public function getProgramMbkmList()
    {
        $nim = $this->getNIMByUsername(session()->get("username"));

        if ($nim) {
            return $this->db->table('program_mbkm')
                ->where('nim', $nim)
                ->get()
                ->getResultArray();
        }

        return [];
    }

    //Mengambil data Program MBKM berdasarkan ID
    public function getProgramMbkmById($id)
    {
        return $this->db->table('program_mbkm')
            ->where('id', $id)
            ->get()
            ->getRowArray();
    }

    // Logika Update Data Program MBKM Mahasiswa
    public function updateProgramMbkm($programMbkmId, $data)
    {
        $this->db->table('program_mbkm')
            ->where('id', $programMbkmId)
            ->update($data);
    }

    // Logika hapus data program MBKM mahasiswa
    public function deleteProgramMbkm($programMbkmId)
    {
        $this->db->transStart();

        $this->db->table('program_mbkm')->where('id', $programMbkmId)->delete();

        $this->db->transComplete();

        if ($this->db->transStatus() === false) {
            return false;
        }

        return true;
    }

    // Logika untuk menampilkan grup_id tabel matakuliah_mahasiswa
    public function getFirstMatakuliahStatusByUsername($username)
    {
        return $this->db->table('matakuliah_mahasiswa')
            ->where('nama_mahasiswa', $username)
            ->groupBy('grup_id')
            ->get()
            ->getResultArray();
    }

    //logika untuk menampilkan grup_id tabel program_mbkm
    public function getFirstProgramMbkmStatusByUsername($username)
    {
        return $this->db->table('program_mbkm')
            ->where('nama_mahasiswa', $username)
            ->groupBy('grup_id')
            ->get()
            ->getResultArray();
    }

    // Mengambil data nama_mahasiswa dari tabel matakuliah_mahasiswa pada database untuk digunakan dalam dropdwon pengisian data konversi nilai
    public function getApprovedMatakuliahStatusByUsername($username)
    {
        return $this->db->table('matakuliah_mahasiswa')
            ->select('grup_id, nama_mahasiswa, nim, semester, fakultas, program_studi, status')
            ->where('nama_mahasiswa', $username)
            ->where('status', 'disetujui')
            ->get()
            ->getResultArray();
    }

    // Mengambil data program_mbkm dari tabel program_mbkm pada database untuk digunakan dalam dropdwon pengisian data konversi nilai
    public function getApprovedProgramMbkmStatusByUsername($username)
    {
        return $this->db->table('program_mbkm')
            ->select('grup_id, program_mbkm')
            ->where('nama_mahasiswa', $username)
            ->where('status', 'disetujui')
            ->get()
            ->getResultArray();
    }

    // Mengambil data kegiatan dari tabel program_mbkm pada database untuk digunakan dalam dropdwon pengisian data konversi nilai
    public function getDistinctApprovedProgramMbkmActivities()
    {
        return $this->db->table('program_mbkm')
            ->select('kegiatan')
            ->distinct()
            ->where('status', 'disetujui')
            ->get()
            ->getResultArray();
    }

    // Mengambil data nama matakuliah dari matakuliah_mahasiswa pada database untuk digunakan dalam dropdwon pengisian data konversi nilai
    public function getDistinctApprovedMatakuliahMbkmMahasiswa()
    {
        return $this->db->table('matakuliah_mahasiswa')
            ->select('nama_matakuliah')
            ->distinct()
            ->where('status', 'disetujui')
            ->get()
            ->getResultArray();
    }

    // Mengambil data kode matakuliah dari tabel matakuliah_mahasiswa pada database untuk digunakan dalam dropdwon pengisian data konversi nilai
    public function getDistinctApprovedKodeMatakuliah()
    {
        return $this->db->table('matakuliah_mahasiswa')
            ->select('kode_matakuliah')
            ->distinct()
            ->where('status', 'disetujui')
            ->get()
            ->getResultArray();
    }

    // Mengambil data sks dari tabel Matakuliah_mahasiswa pada database untuk digunakan dalam dropdwon pengisian data konversi nilai
    public function getDistinctApprovedSKS()
    {
        return $this->db->table('matakuliah_mahasiswa')
            ->select('sks')
            ->distinct()
            ->where('status', 'disetujui')
            ->get()
            ->getResultArray();
    }

    // Mengambil data nilai dari tabel program_mbkm pada database untuk digunakan dalam dropdwon pengisian data konversi nilai
    public function getDistinctApprovedNilai()
    {
        return $this->db->table('program_mbkm')
            ->select('nilai')
            ->distinct()
            ->where('status', 'disetujui')
            ->get()
            ->getResultArray();
    }

    // Mengambil data nama dosen_pembimbing dari tabel program_mbkm sesuai dengan data yang di input oleh mahasiswa
    public function getDistinctApprovedDosenPembimbing()
    {
        return $this->db->table('program_mbkm')
            ->select('dosen_pembimbing')
            ->distinct()
            ->where('status', 'disetujui')
            ->get()
            ->getResultArray();
    }

    // Mengambil data nip_dosen_pembimbing dari tabel program_mbkm sesuai dengan data yang di input oleh mahasiswa
    public function getDistinctApprovedNipDosenPembimbing()
    {
        return $this->db->table('program_mbkm')
            ->select('nip_dosen_pembimbing')
            ->distinct()
            ->where('status', 'disetujui')
            ->get()
            ->getResultArray();
    }

    // Mengambil data lokasi program mbkm dari tabel program_mbkm sesuai dengan data yang di input oleh mahasiswa
    public function getDistinctApprovedLokasiProgram()
    {
        return $this->db->table('program_mbkm')
            ->select('lokasi_program')
            ->distinct()
            ->where('status', 'disetujui')
            ->get()
            ->getResultArray();
    }

    // Simpan data konversi nilai ke database pada tabel konversi_nilai
    public function saveKonversiNilai($data)
    {
        return $this->db->table('konversi_nilai')->insert($data);
    }

    // Untuk menampilkan data konversi nilai dari database
    public function getKonversiNilaiData($username)
    {
        return $this->db->table('konversi_nilai')
            ->where('nama_mahasiswa', $username)
            ->get()
            ->getResultArray();
    }

    public function updateKonversiNilai($konversiNilaiId, $dataKonversiNilai)
    {
        $this->db->table('konversi_nilai')->where('id', $konversiNilaiId)->update($dataKonversiNilai);
    }

    public function getKonversiNilaiById($konversiNilaiId)
    {
        return $this->db->table('konversi_nilai')->where('id', $konversiNilaiId)->get()->getRowArray();
    }

    public function deleteKonversiNilai($konversiNilaiId)
    {
        $tableName = 'konversi_nilai';

        $this->db->table($tableName)->where('id', $konversiNilaiId)->delete();
    }

    public function getKonversiNilaiByGrupId($grupId)
    {
        $table = 'konversi_nilai';
        $primaryKey = 'id';

        return $this->db->table($table)
            ->where('grup_id', $grupId)
            ->get()
            ->getResultArray();
    }

    public function getDistinctGrupIds()
    {
        $table = 'hasil_konversi_nilai';
        $primaryKey = 'id';

        return $this->db->table($table)
            ->distinct()
            ->select('grup_id, nama_mahasiswa, nim, semester, program_mbkm')
            ->groupBy('grup_id')
            ->get()
            ->getResultArray();
    }

    public function getHasilKonversiNilaiData()
    {
        return $this->from('hasil_konversi_nilai')
            ->get()
            ->getResultArray();
    }

    public function getProgramMbkmValueByGrupId($grupId)
    {

        $query = $this->db->table('hasil_konversi_nilai')
            ->select('program_mbkm')
            ->where('grup_id', $grupId)
            ->get();


        return $query->getRow('program_mbkm');
    }

    public function getDosenPembimbingByGrupId($grupId)
    {

        $query = $this->db->table('hasil_konversi_nilai')
            ->select('dosen_pembimbing_lapangan')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getRow('dosen_pembimbing_lapangan');
    }

    public function getNipDosenPembimbingByGrupId($grupId)
    {

        $query = $this->db->table('hasil_konversi_nilai')
            ->select('nip_dosen_pembimbing_lapangan')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getRow('nip_dosen_pembimbing_lapangan');
    }

    public function getNimByGrupId($grupId)
    {
        $query = $this->db->table('hasil_konversi_nilai')
            ->select('nim')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getRow('nim');
    }

    public function getNamaLengkapByGrupId($grupId)
    {
        $query = $this->db->table('hasil_konversi_nilai')
            ->select('nama_mahasiswa')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getRow('nama_mahasiswa');
    }

    public function getSemesterByGrupId($grupId)
    {
        $query = $this->db->table('hasil_konversi_nilai')
            ->select('semester')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getRow('semester');
    }

    public function getProgramStudiByGrupId($grupId)
    {
        $query = $this->db->table('hasil_konversi_nilai')
            ->select('program_studi')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getRow('program_studi');
    }

    public function getLokasiMbkmByGrupId($grupId)
    {
        $query = $this->db->table('hasil_konversi_nilai')
            ->select('lokasi_program')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getRow('lokasi_program');
    }

    public function getUserDataByUsername($username)
    {
        $table = 'users';
        $primaryKey = 'id';
        $allowedFields = ['username', 'password', 'nim', 'profile_picture'];

        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->allowedFields = $allowedFields;

        return $this->where('username', $username)->first();
    }

    // Fungsi untuk memperbarui data pengguna
    public function updateUserData($userId, $userData)
    {
        $table = 'users';
        $primaryKey = 'id';
        $allowedFields = ['username', 'password', 'nim', 'profile_picture'];

        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->allowedFields = $allowedFields;

        $this->set($userData);
        $this->where($primaryKey, $userId);
        $this->update();
    }
}
