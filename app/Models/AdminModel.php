<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'users';


    // Untuk mendapatkan nim
    public function getNIMByUsername($username)
    {
        $result = $this->db->table('users')->select('nim')->where('username', $username)->get()->getRowArray();

        return $result ? $result['nim'] : null;
    }

    // Untuk mendapatkan profil pengguna 
    public function getProfilePictureByUsername($username)
    {
        $result = $this->db->table('users')->select('profile_picture')->where('username', $username)->get()->getRowArray();

        return $result ? $result['profile_picture'] : null;
    }

    // Mengambil daftar grup_id unik dari tabel matakuliah_mahasiswa dan tabel program_mbkm
    public function getUniqueGrupIds()
    {
        $resultMatakuliah = $this->db->table('matakuliah_mahasiswa')
            ->distinct()
            ->select('grup_id')
            ->get()
            ->getResult();

        $grupIdsMatakuliah = [];
        foreach ($resultMatakuliah as $row) {
            $grupIdsMatakuliah[] = $row->grup_id;
        }

        $resultProgramMbkm = $this->db->table('program_mbkm')
            ->distinct()
            ->select('grup_id')
            ->get()
            ->getResult();

        $grupIdsProgramMbkm = [];
        foreach ($resultProgramMbkm as $row) {
            $grupIdsProgramMbkm[] = $row->grup_id;
        }

        // Menggabungkan dan menghapus duplikat dari kedua array
        $mergedGrupIds = array_merge($grupIdsMatakuliah, $grupIdsProgramMbkm);
        $uniqueGrupIds = array_unique($mergedGrupIds);

        return $uniqueGrupIds;
    }

    // untuk mendapatkan data matakuliah dan program_mbkm berdasarkan grup_id
    public function getMatakuliahByGrupId($grupId)
    {
        // Mengambil data matakuliah berdasarkan grup_id dari tabel matakuliah_mahasiswa
        $resultMatakuliah = $this->db->table('matakuliah_mahasiswa')
            ->where('grup_id', $grupId)
            ->get()
            ->getResult();

        return $resultMatakuliah;
    }

    public function getProgramMbkmByGrupId($grupId)
    {
        // Mengambil data program_mbkm berdasarkan grup_id dari tabel program_mbkm
        $resultProgramMbkm = $this->db->table('program_mbkm')
            ->where('grup_id', $grupId)
            ->get()
            ->getResult();

        return $resultProgramMbkm;
    }

    // Implementasi logika untuk menyetujui data matakuliah
    public function setujuiDataMatakuliah($grupId)
    {
        $this->db->table('matakuliah_mahasiswa')
            ->where('grup_id', $grupId)
            ->update(['status' => 'disetujui']);
    }

    // untuk menyetujui data program_mbkm 
    public function setujuiDataProgramMbkm($grupId)
    {

        $this->db->table('program_mbkm')
            ->where('grup_id', $grupId)
            ->update(['status' => 'disetujui']);
    }

    // Implementasi logika untuk menolak data matakuliah
    public function tolakDataMatakuliah($grupId)
    {
        $this->db->table('matakuliah_mahasiswa')
            ->where('grup_id', $grupId)
            ->update(['status' => 'ditolak']);
    }

    // Implementasi logika untuk menolak data program_mbkm
    public function tolakDataProgramMbkm($grupId)
    {
        $this->db->table('program_mbkm')
            ->where('grup_id', $grupId)
            ->update(['status' => 'ditolak']);
    }

    // logika untuk mendapatkan status data matakuliah_mahasiswa dan program_mbkm
    public function getStatusForGrupId($grupId)
    {
        $resultMatakuliah = $this->db->table('matakuliah_mahasiswa')
            ->select('status')
            ->where('grup_id', $grupId)
            ->get()
            ->getRow();

        $resultProgramMbkm = $this->db->table('program_mbkm')
            ->select('status')
            ->where('grup_id', $grupId)
            ->get()
            ->getRow();

        $status = ($resultMatakuliah) ? $resultMatakuliah->status : ($resultProgramMbkm ? $resultProgramMbkm->status : null);

        return $status;
    }

    // Untuk menampilkan data konversi nilai yagn di iniput oleh mahasiswa
    public function getUniqueGrupIdsKonversiNilai()
    {
        $query = $this->db->table('konversi_nilai')
            ->select('grup_id')
            ->distinct()
            ->get();

        return $query->getResultArray();
    }

    public function getKonversiNilaiByGrupId($grupId)
    {
        $query = $this->db->table('konversi_nilai')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getResultArray();
    }

    // Menyimpan data perubahan konversi nilai didalam tabel hasil konversi nilai
    public function simpanHasilKonversiNilai($grupId, $updatedData)
    {
        echo "grup_id pada simpanHasilKonversiNilai: " . $grupId;

        if (!empty($grupId)) {
            foreach ($updatedData as $index => &$data) {
                $data['grup_id'] = $grupId;
            }

            $this->db->table('hasil_konversi_nilai')->insertBatch($updatedData);
        } else {
        }
    }

    // Untuk mendapatkan status data konversi nilai
    public function getGrupIdStatus($grupId)
    {
        $result = $this->db->table('konversi_nilai')
            ->select('status')
            ->where('grup_id', $grupId)
            ->get()
            ->getRowArray();

        return !empty($result) ? $result['status'] : null;
    }

    // Untuk mengubah status data konversi nilai menjadi diproses
    public function setGrupIdStatusDiproses($grupId)
    {
        $this->db->table('konversi_nilai')
            ->where('grup_id', $grupId)
            ->update(['status' => 'diproses']);
    }

    // Untuk mengubah status data konversi nilai menjadi selesai
    public function setGrupIdStatusSelesai($grupId)
    {
        $this->db->table('konversi_nilai')
            ->where('grup_id', $grupId)
            ->update(['status' => 'selesai']);
    }

    // Untuk mendapatkan data hasil konversi nilai
    public function getUniqueGrupDataHasilKonversiNilai()
    {
        $tableName = 'hasil_konversi_nilai';

        $builder = $this->db->table($tableName);
        $builder->select('grup_id, nama_mahasiswa, nim, semester, program_mbkm');
        $builder->distinct();
        $result = $builder->get()->getResultArray();

        return $result;
    }

    // Untuk mendapat data hasil konversi nilai berdasarkan grup_id
    public function getHasilKonversiNilaiByGrupId($grupId)
    {
        $tableName = 'hasil_konversi_nilai';

        $builder = $this->db->table($tableName);
        $builder->where('grup_id', $grupId);
        $result = $builder->get()->getResultArray();

        return $result;
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

    // Untuk mendapatkan data program mbkm dari tabel hasil konversi nilai
    public function getProgramMbkmValueByGrupId($grupId)
    {
        $query = $this->db->table('hasil_konversi_nilai')
            ->select('program_mbkm')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getRow('program_mbkm');
    }

    // Untuk mendapatkan data dosen pembimbing lapangan dari tabel hasil konversi nilai
    public function getDosenPembimbingByGrupId($grupId)
    {
        $query = $this->db->table('hasil_konversi_nilai')
            ->select('dosen_pembimbing_lapangan')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getRow('dosen_pembimbing_lapangan');
    }

    // Untuk mendapatkan data nip dosen pembimbing lapangan dari tabel hasil konversi nilai
    public function getNipDosenPembimbingByGrupId($grupId)
    {
        $query = $this->db->table('hasil_konversi_nilai')
            ->select('nip_dosen_pembimbing_lapangan')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getRow('nip_dosen_pembimbing_lapangan');
    }

    // Untuk mendapatkan data nim dosen pembimbing lapangan dari tabel hasil konversi nilai
    public function getNimByGrupId($grupId)
    {
        $query = $this->db->table('hasil_konversi_nilai')
            ->select('nim')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getRow('nim');
    }

    // Untuk mendapatkan data nama mahasiswa dari tabel hasil konversi nilai
    public function getNamaLengkapByGrupId($grupId)
    {
        $query = $this->db->table('hasil_konversi_nilai')
            ->select('nama_mahasiswa')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getRow('nama_mahasiswa');
    }

    // Untuk mendapatkan data semester dari tabel hasil konversi nilai
    public function getSemesterByGrupId($grupId)
    {
        $query = $this->db->table('hasil_konversi_nilai')
            ->select('semester')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getRow('semester');
    }

    // Untuk mendapatkan data nama program studi dari tabel hasil konversi nilai
    public function getProgramStudiByGrupId($grupId)
    {
        $query = $this->db->table('hasil_konversi_nilai')
            ->select('program_studi')
            ->where('grup_id', $grupId)
            ->get();

        return $query->getRow('program_studi');
    }

    // Untuk mendapatkan data nama lokasi program dari tabel hasil konversi nilai
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

    // Untuk menampilkan seluruh data matakuliah program studi
    public function getAllMatakuliahProgramStudi()
    {
        $this->table = 'matakuliah_programstudi';
        $this->primaryKey = 'id';
        $this->allowedFields = ['nama_matakuliah', 'kode_matakuliah', 'sks'];

        return $this->findAll();
    }

    public function getMatakuliahProgramStudiById($id)
    {
        $table = 'matakuliah_programstudi';
        $primaryKey = 'id';

        return $this->db->table($table)
            ->select('*')
            ->where($primaryKey, $id)
            ->get()
            ->getRow();
    }

    // Untuk menyimpan data matakuliah program studi yang baru kedalam database

    public function insertMatakuliahProgramStudi($data)
    {
        $table = 'matakuliah_programstudi';
        $primaryKey = 'id';
        $allowedFields = ['nama_matakuliah', 'kode_matakuliah', 'sks'];

        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->allowedFields = $allowedFields;

        return $this->insert($data);
    }

    // Untuk menghapus data matakuliah program mbkm dari database
    public function deleteMatakuliahProgramStudi($id)
    {
        $table = 'matakuliah_programstudi';
        $primaryKey = 'id';

        return $this->db->table($table)->where($primaryKey, $id)->delete();
    }

    // Untuk Mendapatkan seluruh nama dosen program studi dari database
    public function getAllDosen()
    {
        $table = 'dosen_tiunima';
        $primaryKey = 'id';
        $allowedFields = ['nama_dosen', 'nip_dosen'];

        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->allowedFields = $allowedFields;

        return $this->findAll();
    }

    public function getDosenById($id)
    {
        return $this->db->table('dosen_tiunima')->where('id', $id)->get()->getRowArray();
    }

    // Untuk menyimpan nama dosen program studi baru kedalam database
    public function insertDosen($data)
    {
        $table = 'dosen_tiunima';
        $primaryKey = 'id_dosen';
        $allowedFields = ['nama_dosen', 'nip_dosen'];

        $this->db->table($table)->insert($data);
        return $this->db->insertID();
    }

    // Untuk menghapus data dosen dari database
    public function deleteDosen($id)
    {
        return $this->db->table('dosen_tiunima')->where('id', $id)->delete();
    }

    // Untuk mendapatkan seluruh informasi data akun mahasiswa
    public function getAllMahasiswa()
    {
        return $this->where('tipe_pengguna', 'mahasiswa')->findAll();
    }

    // Untuk menyimpan perubahan kata sandi akun mahasiswa jika mereka lupa kata sandi
    public function updateMahasiswaPassword($username, $newPassword)
    {
        $this->set('password', password_hash($newPassword, PASSWORD_DEFAULT))
            ->where('username', $username)
            ->update();
    }

    // Untuk mendapatkan seluruh informasi data akun admin
    public function getAllAdmin()
    {
        return $this->where('tipe_pengguna', 'admin')->findAll();
    }

    // Untuk menambahkan admin baru kedalam database
    public function insertAdmin($data)
    {
        $table = 'users';
        $primaryKey = 'id';
        $allowedFields = ['username', 'password', 'nim', 'tipe_pengguna'];

        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->allowedFields = $allowedFields;

        return $this->insert($data);
    }

    // Untuk menghapus admin dari database
    public function deleteAdmin($adminId)
    {
        return $this->delete($adminId);
    }

    // Untuk mendapatkan data program mbkm dari tabel hasil konversi nilai untuk ditampilkan dalam diagram batang
    public function getGrupIdByUsername($username)
    {
        $result = $this->db->table('hasil_konversi_nilai')
            ->select('grup_id')
            ->where('nama_mahasiswa', $username)
            ->get()
            ->getRowArray();

        return $result['grup_id'] ?? null;
    }

    public function getAllHasilKonversiNilai()
    {
        return $this->db->table('hasil_konversi_nilai')->get()->getResultArray();
    }


    public function getProgramMBKMData()
    {
        $query = $this->db->table('hasil_konversi_nilai')
            ->groupBy(['nim', 'program_mbkm'])
            ->select('program_mbkm, COUNT(DISTINCT nim) as student_count')
            ->get();

        $result = [];
        foreach ($query->getResult() as $row) {
            $result[$row->program_mbkm] = $row->student_count;
        }

        return $result;
    }

    // Untuk menampilkan nama nama admin
    public function getAdminList()
    {
        $query = $this->db->table('users')
            ->where('tipe_pengguna', 'admin')
            ->get();

        return $query->getResultArray();
    }

    // Untuk mendapatkan jumlah mahasiswa yang mengajukkan konversi nilai
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

    // Untuk mendapatkan jumlah pengajuan yang disetujui
    public function countPengajuanDisetujui($nim)
    {
        return $this->db->table('matakuliah_mahasiswa')
            ->distinct()
            ->select('nim')
            ->where('nim', $nim)
            ->where('status', 'disetujui')
            ->countAllResults();
    }

    // Untuk mendapatkan jumlah hasil konversi nilai yang telah selesai diproses
    public function countKonversiSelesai($nim)
    {
        return $this->db->table('hasil_konversi_nilai')
            ->distinct()
            ->select('nim')
            ->where('nim', $nim)
            ->countAllResults();
    }
}
