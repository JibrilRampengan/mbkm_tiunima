<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css'>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.semanticui.min.css">
    <title>Konversi Nilai</title>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/mahasiswa.css'); ?>">
    <link href="<?php echo base_url('assets/img/informatika.svg'); ?>" rel="shortcut icon">

    <!-- Mengatur Z-Index untuk Sidebar -->
    <style>
        #sidebar {
            z-index: 1;
        }
    </style>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="<?php echo base_url('mahasiswa/dashboard_mahasiswa'); ?>" class="brand">
            <img src="<?php echo base_url('assets/img/informatika.svg'); ?>" alt="Logo Teknik Informatika UNIMA" class="logo-img">
            <span class="text">Teknik Informatika</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="<?php echo base_url('mahasiswa/dashboard_mahasiswa'); ?>">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('mahasiswa/input_matakuliah'); ?>">
                    <i class='bx bx-book'></i>
                    <span class="text">Input Mata Kuliah</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('mahasiswa/input_programmbkm'); ?>">
                    <i class='bx bx-edit'></i>
                    <span class="text">Input Program MBKM</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('mahasiswa/status'); ?>">
                    <i class='bx bx-check-circle'></i>
                    <span class="text">Status Data Input</span>
                </a>
            </li>
            <li class="active">
                <a href="<?php echo base_url('mahasiswa/konversi_nilai'); ?>">
                    <i class='bx bx-file'></i>
                    <span class="text">Konversi Nilai Matakuliah</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('mahasiswa/hasil_konversi_nilai'); ?>">
                    <i class='bx bx-bar-chart'></i>
                    <span class="text">Hasil Konversi Nilai</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('mahasiswa/berita_acara'); ?>">
                    <i class='bx bxs-news'></i>
                    <span class="text">Berita Acara</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="<?php echo base_url('mahasiswa/profil_pengguna'); ?>">
                    <i class='bx bxs-user'></i>
                    <span class="text">Profile</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('auth/logout'); ?>" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>

    <!-- CONTENT -->
    <section id="content-halaman">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <div class="tanggal">
                <p><?php echo date('l, d F Y', strtotime('today')); ?></p>
            </div>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <div class="profile-menu">
                <img src="<?= empty($mahasiswa['profile_picture']) ? base_url('assets/img/people_default.jpg') : base_url('writable/uploads/' . $mahasiswa['profile_picture']); ?>" alt="Profile Picture" width="100" height="auto">
                <ul class="profile-dropdown">
                    <li><a href="<?php echo base_url('mahasiswa/profil_pengguna'); ?>" style="color: black;"> <i class='bx bxs-user'></i> Profil</a></li>
                    <li><a href="<?php echo base_url('auth/logout'); ?>" style="color: red;"> <i class='bx bx-log-out'></i> Log Out</a></li>
                </ul>
            </div>
            <div class="informasi_pengguna">
                <p><?= $mahasiswa['username']; ?><br><?= !empty($mahasiswa['nim']) ? $mahasiswa['nim'] : 'NIM Tidak Tersedia'; ?></p>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title-dashboard">
                <div class="left-dashboard">
                    <h1>Konversi Nilai</h1>
                    <br>
                    <h2>Halo, <span class="small-text-dashboard"><?php echo $_SESSION["username"]; ?></h2>
                    <p>Anda berada di halaman<b> "Konversi Nilai" </b>Di sini, Anda dapat mengatur data program MBKM untuk dikonversikan nilainya ke mata kuliah yang Anda kontrak dalam kartu rencana studi.</p>
                </div>
            </div>

            <br>


            <div class="card-input-matakuliah">

                <!-- Tabel untuk menampilkan data yang disetujui -->
                <table id="tableDataDisetujui" class="ui celled table nowrap unstackable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Semester</th>
                            <th>Program MBKM</th>
                            <th>Fakultas</th>
                            <th>Program Studi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($combinedData as $data) : ?>
                            <tr>
                                <td><?= $data['nama_mahasiswa'] ?></td>
                                <td><?= $data['nim'] ?></td>
                                <td><?= $data['semester'] ?></td>
                                <td><?= $data['program_mbkm'] ?></td>
                                <td><?= $data['fakultas'] ?></td>
                                <td><?= $data['program_studi'] ?></td>
                                <td>
                                    <button class="btn-add" onclick=" openForm(this); openModal();">Tambah Data <br> Konversi Nilai</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>


                <!-- MODAL -->
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>
                        <!-- Formulir untuk mengisi konversi nilai -->
                        <h1>Formulir Konversi Nilai</h1>
                        <form action="/mahasiswa/saveKonversiNilai" method="post" class="konversiNilaiForm" style="display: none;">
                            <div class="form-group">
                                <label for="nama_mahasiswa">Nama Mahasiswa :</label>
                                <input type="text" class="form-control" name="nama_mahasiswa" required>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="program_mbkm">Program MBKM :</label>
                                <input type="text" class="form-control" name="program_mbkm" required>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="nim">NIM :</label>
                                <input type="text" class="form-control" name="nim" required>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="semester">Semester :</label>
                                <input type="number" class="form-control" name="semester" required min="1" max="10">
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="fakultas">Fakultas :</label>
                                <input type="text" class="form-control" name="fakultas" required>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="program_studi">Program Studi :</label>
                                <input type="text" class="form-control" name="program_studi" required>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="dosen_pembimbing_lapangan[]">Dosen Pembimbing Lapangan:</label>
                                <select class="form-control" name="dosen_pembimbing_lapangan[]" required>
                                    <option value="">Pilih Dosen</option>
                                    <?php foreach ($dosenPembimbingOptions as $dosenPembimbing) : ?>
                                        <option value="<?= $dosenPembimbing['dosen_pembimbing'] ?>"><?= $dosenPembimbing['dosen_pembimbing'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="nip_dosen_pembimbing_lapangan[]">NIP Dosen Pembimbing Lapangan:</label>
                                <select class="form-control" name="nip_dosen_pembimbing_lapangan[]" required>
                                    <option value="">Pilih NIP Dosen </option>
                                    <?php foreach ($nipDosenPembimbingOptions as $nipDosenPembimbing) : ?>
                                        <option value="<?= $nipDosenPembimbing['nip_dosen_pembimbing'] ?>"><?= $nipDosenPembimbing['nip_dosen_pembimbing'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="lokasi_program[]">Lokasi Program:</label>
                                <select class="form-control" name="lokasi_program[]" required>
                                    <option value="">Pilih Lokasi</option>
                                    <?php foreach ($lokasiProgramOptions as $lokasiProgram) : ?>
                                        <option value="<?= $lokasiProgram['lokasi_program'] ?>"><?= $lokasiProgram['lokasi_program'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <br>

                            <!-- Untuk menginput data yang dinamis -->
                            <div class="dynamic-inputs">
                                <div class="form-group">
                                    <label for="kegiatan[]">Kegiatan :</label>
                                    <select class="form-control" name="kegiatan[]" required>
                                        <option value="">Pilih Kegiatan</option>
                                        <?php foreach ($kegiatan as $kegiatanItem) : ?>
                                            <option value="<?= $kegiatanItem['kegiatan'] ?>"><?= $kegiatanItem['kegiatan'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="rekognisi_mk[]">Rekognisi MK :</label>
                                    <select class="form-control" name="rekognisi_mk[]" required>
                                        <option value="">Pilih Nama Matakuliah</option>
                                        <?php foreach ($namaMatakuliahOptions as $option) : ?>
                                            <option value="<?= $option['nama_matakuliah'] ?>"><?= $option['nama_matakuliah'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="kode_matakuliah[]">Kode Matakuliah:</label>
                                    <select class="form-control" name="kode_matakuliah[]" required>
                                        <option value="">Pilih Kode Matakuliah</option>
                                        <?php foreach ($kodeMatakuliahOptions as $option) : ?>
                                            <option value="<?= $option['kode_matakuliah'] ?>"><?= $option['kode_matakuliah'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="sks[]">SKS:</label>
                                    <select class="form-control" name="sks[]" required>
                                        <option value="">Pilih SKS</option>
                                        <?php foreach ($sksOptions as $option) : ?>
                                            <option value="<?= $option['sks'] ?>"><?= $option['sks'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="nilai[]">Nilai:</label>
                                    <select class="form-control" name="nilai[]" required>
                                        <option value="">Pilih Nilai</option>
                                        <?php foreach ($nilaiOptions as $option) : ?>
                                            <option value="<?= $option['nilai'] ?>"><?= $option['nilai'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <br>

                            </div>
                            <br>
                            <button type="button" class="btn-add" onclick="addInputFields()">Tambah Input</button>
                            <br>
                            <button type="submit" class="btn-submit">Simpan Konversi Nilai</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabel untuk menampilkan data konversi nilai -->
            <div class="card-input-matakuliah">
                <div class="card-header-input-matakuliah">
                    <p>Daftar Data Konversi Nilai</p>
                </div>

                <table id="tableDataKonversiNilai" class="ui celled table nowrap unstackable" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Nim</th>
                            <th>Fakultas</th>
                            <th>Program_studi</th>
                            <th>Semester</th>
                            <th>Program MBKM</th>
                            <th>Kegiatan</th>
                            <th>Rekognisi MK</th>
                            <th>Kode Matakuliah</th>
                            <th>SKS</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $counter = 1; ?>
                        <?php foreach ($konversiNilaiData as $data) : ?>
                            <tr>
                                <td><?= $counter++; ?></td>
                                <td><?= $data['nama_mahasiswa'] ?></td>
                                <td><?= $data['nim'] ?></td>
                                <td><?= $data['fakultas'] ?></td>
                                <td><?= $data['program_studi'] ?></td>
                                <td><?= $data['semester'] ?></td>
                                <td><?= $data['program_mbkm'] ?></td>
                                <td><?= $data['kegiatan'] ?></td>
                                <td><?= $data['rekognisi_mk'] ?></td>
                                <td><?= $data['kode_matakuliah'] ?></td>
                                <td><?= $data['sks'] ?></td>
                                <td><?= $data['nilai'] ?></td>
                                <td>
                                    <button class="ui small button primary" onclick="confirmEdit('<?= base_url('mahasiswa/edit_konversi_nilai/' . $data['id']) ?>')">Edit Data</button>
                                    <button class="ui small button negative" onclick="confirmDelete('<?= base_url('mahasiswa/delete_konversi_nilai/' . $data['id']) ?>')">Delete Data</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>


        </main>
    </section>


    <script src="<?php echo base_url('assets/js/mahasiswa.js'); ?>"></script>

    <!-- Mengatur tampilan dropdown profil-->
    <script>
        const profileMenu = document.querySelector(".profile-menu");
        const profileDropdown = document.querySelector(".profile-dropdown");

        profileMenu.addEventListener("click", () => {
            profileDropdown.classList.toggle("show");
        });

        window.addEventListener("click", (event) => {
            if (!profileMenu.contains(event.target)) {
                profileDropdown.classList.remove("show");
            }
        });
    </script>

    <!-- script untuk tabel-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.semanticui.min.js"></script>

    <script>
        new DataTable('#tableDataDisetujui', {
            responsive: true
        });
    </script>

    <script>
        new DataTable('#tableDataKonversiNilai', {
            responsive: true
        });
    </script>


    <!-- Untuk Menampilkan formulir konversi nilai -->
    <script>
        function openForm(button) {
            var row = button.closest('tr');
            var namaMahasiswa = row.cells[0].innerText;
            var programMbkm = row.cells[3].innerText;
            var nim = row.cells[1].innerText;
            var semester = row.cells[2].innerText;
            var fakultas = row.cells[4].innerText;
            var programStudi = row.cells[5].innerText;

            document.querySelector('input[name="nama_mahasiswa"]').value = namaMahasiswa;
            document.querySelector('input[name="program_mbkm"]').value = programMbkm;
            document.querySelector('input[name="nim"]').value = nim;
            document.querySelector('input[name="semester"]').value = semester;
            document.querySelector('input[name="fakultas"]').value = fakultas;
            document.querySelector('input[name="program_studi"]').value = programStudi;


            document.querySelector('.konversiNilaiForm').style.display = 'block';
        }
    </script>


    <!-- Untuk Menampilkan Modal -->
    <script>
        const modal = document.getElementById('myModal');

        function openModal() {
            modal.style.display = 'block';
        }

        function closeModal() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                closeModal();
            }
        };
    </script>

    <!-- Untuk Menginput data yang dinamis -->
    <script>
        function addInputFields() {
            const dynamicInputs = document.querySelector('.dynamic-inputs');
            const newEntry = document.createElement('div');
            newEntry.innerHTML = `
                        <div class="form-group">
                            <label for="kegiatan[]">Kegiatan :</label>
                            <select class="form-control" name="kegiatan[]" required>
                                <option value="">Pilih Kegiatan</option>
                                <?php foreach ($kegiatan as $kegiatanItem) : ?>
                                    <option value="<?= $kegiatanItem['kegiatan'] ?>"><?= $kegiatanItem['kegiatan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="rekognisi_mk[]">Rekognisi MK :</label>
                            <select class="form-control" name="rekognisi_mk[]" required>
                                <option value="">Pilih Nama Matakuliah</option>
                                <?php foreach ($namaMatakuliahOptions as $option) : ?>
                                    <option value="<?= $option['nama_matakuliah'] ?>"><?= $option['nama_matakuliah'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kode_matakuliah[]">Kode Matakuliah:</label>
                            <select class="form-control" name="kode_matakuliah[]" required>
                                <option value="">Pilih Kode Matakuliah</option>
                                <?php foreach ($kodeMatakuliahOptions as $option) : ?>
                                    <option value="<?= $option['kode_matakuliah'] ?>"><?= $option['kode_matakuliah'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="sks[]">SKS:</label>
                            <select class="form-control" name="sks[]" required>
                                <option value="">Pilih SKS</option>
                                <?php foreach ($sksOptions as $option) : ?>
                                    <option value="<?= $option['sks'] ?>"><?= $option['sks'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nilai[]">Nilai:</label>
                            <select class="form-control" name="nilai[]" required>
                                <option value="">Pilih Nilai</option>
                                <?php foreach ($nilaiOptions as $option) : ?>
                                    <option value="<?= $option['nilai'] ?>"><?= $option['nilai'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        `;

            dynamicInputs.appendChild(newEntry);
        }
    </script>


    <!-- Sweetalert untuk konfirmasi edit dan hapus data -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <script>
        function confirmEdit(url) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin mengedit konversi nilai?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Edit!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

        function confirmDelete(url) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus konversi nilai?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>

</body>

</html>