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
    <title>Input Matakuliah</title>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/mahasiswa.css'); ?>">
    <link href="<?php echo base_url('assets/img/informatika.svg'); ?>" rel="shortcut icon">

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
            <li class="active">
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
            <li>
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
                    <h1>Input Matakuliah</h1>
                    <br>
                    <h2>Halo, <span class="small-text-dashboard"><?php echo $_SESSION["username"]; ?></h2>
                    <p>Anda berada di halaman <b> "Input Matakuliah" </b>Silahkan menginput data matakuliah berdasarakan matakuliah yang anda kontrak pada saat pengisian kartu rencana studi (KRS).</p>
                </div>
            </div>

            <br>

            <div class="card-input-matakuliah">
                <div class="card-header-input-matakuliah">
                    <p>Daftar Data Matakuliah</p>
                    <button type="button" onclick="openModal()">Tambah Matakuliah</button>
                </div>

                <?php if (isset($validation)) : ?>
                    <div style="color: red;">
                        <?= \Config\Services::validation()->listErrors(); ?>
                    </div>
                <?php endif; ?>

                <!-- MODAL -->
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="closeModal()">&times;</span>

                        <h1>Formulir Input Matakuliah</h1>
                        <form method="post" action="/mahasiswa/input_matakuliah" enctype="multipart/form-data">
                            <label for="nama">Nama :</label>
                            <input type="text" name="nama" id="nama" required>
                            <br>

                            <label for="fakultas">Fakultas :</label>
                            <input type="text" name="fakultas" id="fakultas" required>
                            <br>

                            <label for="program_studi">Program Studi :</label>
                            <input type="text" name="program_studi" id="program_studi" required>
                            <br>

                            <label for="semester">Semester :</label>
                            <input type="number" name="semester" id="semester" required>
                            <br>

                            <div id="matakuliah-entries">
                                <div class="matakuliah-entry">
                                    <label for="nama_matakuliah">Nama Matakuliah :</label>
                                    <select name="nama_matakuliah[]" required>
                                        <option value="" disabled selected>Pilih Matakuliah</option>
                                        <?php foreach ($matakuliahOptions as $matakuliah) : ?>
                                            <option value="<?= $matakuliah['nama_matakuliah']; ?>" data-kode="<?= $matakuliah['kode_matakuliah']; ?>" data-sks="<?= $matakuliah['sks']; ?>">
                                                <?= $matakuliah['nama_matakuliah']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <br>

                                    <label for="kode_matakuliah">Kode Matakuliah :</label>
                                    <input type="text" name="kode_matakuliah[]" id="kode_matakuliah" readonly>
                                    <br>

                                    <label for="sks">SKS :</label>
                                    <input type="number" name="sks[]" id="sks" readonly>
                                    <br>

                                    <label for="nama_dosen">Nama Dosen :</label>
                                    <select name="nama_dosen[]" id="nama_dosen" required>
                                        <option value="" disabled selected>Pilih Dosen</option>
                                        <?php foreach ($dosenOptions as $nama_dosen) : ?>
                                            <option value="<?= $nama_dosen; ?>"><?= $nama_dosen; ?></option>
                                        <?php endforeach; ?>
                                        <option value="tambah_manual">Lainnya</option>
                                    </select>

                                    <input type="text" name="nama_dosen_manual[]" id="nama_dosen_manual" placeholder="Masukkan Nama Dosen" style="display: none;">

                                    <br>
                                </div>
                            </div>

                            <button type="button" class="btn-add" onclick="addMatakuliah()">Tambah Matakuliah</button>

                            <br>

                            <label for="file_krs">Berkas KRS :</label>
                            <input type="file" name="file_krs" id="file_krs" />
                            <br>

                            <button type="submit" class="btn-submit">Submit</button>
                        </form>
                    </div>
                </div>

                <!-- Tabel Data Formulir Verifikasi -->
                <div class="data-table-container">
                    <table id="example" class="ui celled table nowrap unstackable" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nim</th>
                                <th>Semester</th>
                                <th>Mata Kuliah</th>
                                <th>Kode MK</th>
                                <th>SKS</th>
                                <th>Dosen</th>
                                <th>Fakultas</th>
                                <th>Program Studi</th>
                                <th>Status</th>
                                <th>File KRS</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($allMatakuliah) && !empty($allMatakuliah)) : ?>
                                <?php $counter = 1; ?>
                                <?php foreach ($allMatakuliah as $matakuliah) : ?>
                                    <tr>
                                        <td><?= $counter++; ?></td>
                                        <td><?= $matakuliah['nama_mahasiswa']; ?></td>
                                        <td><?= $matakuliah['nim']; ?></td>
                                        <td><?= $matakuliah['semester']; ?></td>
                                        <td><?= $matakuliah['nama_matakuliah']; ?></td>
                                        <td><?= $matakuliah['kode_matakuliah']; ?></td>
                                        <td><?= $matakuliah['sks']; ?></td>
                                        <td><?= $matakuliah['nama_dosen']; ?></td>
                                        <td><?= $matakuliah['fakultas']; ?></td>
                                        <td><?= $matakuliah['program_studi']; ?></td>
                                        <td><?= $matakuliah['status']; ?></td>
                                        <td>
                                            <?php if ($matakuliah['file_krs']) : ?>
                                                <?php $fileKrsPath = base_url('uploads/' . $matakuliah['grup_id'] . '/krs/' . $matakuliah['file_krs']); ?>
                                                <object data="<?= $fileKrsPath ?>" type="application/pdf" width="900" height="400">
                                                    <p>PDF cannot be displayed. <a href="<?= $fileKrsPath ?>">Download PDF</a></p>
                                                </object>
                                            <?php else : ?>
                                                No file available
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="ui mini button primary" onclick="return confirmEdit()">Edit</button> |
                                            <button class="ui mini button negative" onclick="return confirmDelete()">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
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

    <script>
        // JavaScript Modal
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

    <!-- script untuk tabel-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.semanticui.min.js"></script>

    <script>
        new DataTable('#example', {
            responsive: true
        });
    </script>

    <!-- // Fungsi untuk mengisi kode_matakuliah dan sks berdasarkan pilihan matakuliah -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectMatakuliah = document.querySelector('select[name="nama_matakuliah[]"]');
            const kodeMatakuliahInput = document.getElementById('kode_matakuliah');
            const sksInput = document.getElementById('sks');

            selectMatakuliah.addEventListener('change', function() {
                const selectedOption = selectMatakuliah.options[selectMatakuliah.selectedIndex];
                kodeMatakuliahInput.value = selectedOption.getAttribute('data-kode');
                sksInput.value = selectedOption.getAttribute('data-sks');
            });
        });
    </script>

    <!--Sweet Alert untuk edit / delete data-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <script>
        function confirmEdit() {
            Swal.fire({
                title: 'Apakah Anda yakin untuk mengedit?',
                text: "Perubahan yang telah dilakukan tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, edit!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= base_url('/edit_matakuliah/' . $matakuliah['id']); ?>';
                }
            });
            return false;
        }

        function confirmDelete() {
            Swal.fire({
                title: 'Apakah Anda yakin untuk menghapus?',
                text: "Anda tidak akan dapat mengembalikan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '<?= base_url('/delete_matakuliah/' . $matakuliah['id']); ?>';
                }
            });
            return false;
        }
    </script>

    <!-- // Fungsi untuk menambahkan field matakuliah baru-->
    <script>
        function addMatakuliah() {
            const container = document.getElementById('matakuliah-entries');
            const newMatakuliahEntry = document.createElement('div');
            newMatakuliahEntry.classList.add('matakuliah-entry');

            newMatakuliahEntry.innerHTML = `
            <label for="nama_matakuliah">Nama Matakuliah:</label>
            <select name="nama_matakuliah[]" required onchange="updateKodeSks(this)">
                <option value="" disabled selected>Pilih Matakuliah</option>
                <?php foreach ($matakuliahOptions as $matakuliah) : ?>
                    <option value="<?= $matakuliah['nama_matakuliah']; ?>" data-kode="<?= $matakuliah['kode_matakuliah']; ?>" data-sks="<?= $matakuliah['sks']; ?>">
                        <?= $matakuliah['nama_matakuliah']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>

            <label for="kode_matakuliah">Kode Matakuliah:</label>
            <input type="text" name="kode_matakuliah[]" class="kode_matakuliah" readonly>
            <br>

            <label for="sks">SKS:</label>
            <input type="number" name="sks[]" class="sks" readonly>
            <br>

            <!-- Label dan dropdown untuk Nama Dosen -->
            <label for="nama_dosen">Nama Dosen:</label>
            <select name="nama_dosen[]" required>
                <option value="" disabled selected>Pilih Dosen</option>
                <?php foreach ($dosenOptions as $nama_dosen) : ?>
                    <option value="<?= $nama_dosen; ?>"><?= $nama_dosen; ?></option>
                <?php endforeach; ?>
                <option value="tambah_manual">Lainnya</option>
            </select>

            <!-- Input tambahan untuk mengisi nama dosen secara manual -->
            <input type="text" name="nama_dosen_manual[]" placeholder="Masukkan Nama Dosen" style="display: none;">
            <br>
        `;

            container.appendChild(newMatakuliahEntry);

            // JavaScript untuk menangani perubahan pada dropdown Nama Dosen di setiap entri baru
            newMatakuliahEntry.querySelector('select[name="nama_dosen[]"]').addEventListener('change', function() {
                var selectElement = this;
                var manualInput = selectElement.parentElement.querySelector('input[name="nama_dosen_manual[]"]');

                if (selectElement.value === 'tambah_manual') {
                    manualInput.style.display = 'block';
                    manualInput.setAttribute('required', 'required');
                } else {
                    manualInput.style.display = 'none';
                    manualInput.removeAttribute('required');
                }
            });
        }

        // Fungsi untuk memperbarui nilai kode_matakuliah dan sks saat pilihan nama_matakuliah berubah
        function updateKodeSks(selectElement) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const kodeInput = selectElement.parentElement.querySelector('.kode_matakuliah');
            const sksInput = selectElement.parentElement.querySelector('.sks');

            kodeInput.value = selectedOption.getAttribute('data-kode');
            sksInput.value = selectedOption.getAttribute('data-sks');
        }
    </script>

    <!-- JavaScript untuk menangani perubahan pada dropdown Nama Dosen -->
    <script>
        document.getElementById('nama_dosen').addEventListener('change', function() {
            var selectElement = this;
            var manualInput = document.getElementById('nama_dosen_manual');

            if (selectElement.value === 'tambah_manual') {
                manualInput.style.display = 'block';
                manualInput.setAttribute('required', 'required');
            } else {
                manualInput.style.display = 'none';
                manualInput.removeAttribute('required');
            }
        });
    </script>


</body>

</html>