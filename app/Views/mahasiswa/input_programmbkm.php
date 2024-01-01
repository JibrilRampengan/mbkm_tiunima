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
    <title>Input Program MBKM</title>

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
            <li class="active">
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
                    <h1>Input Program MBKM</h1>
                    <br>
                    <h2>Halo, <span class="small-text-dashboard"><?php echo $_SESSION["username"]; ?></h2>
                    <p>Anda berada di halaman<b> "Input Program MBKM" </b> anda dapat memasukkan informasi program MBKM di halaman ini sesuai dengan program MBKM yang anda ikuti.</p>
                </div>
            </div>

            <br>

            <div class="card-input-matakuliah">
                <div class="card-header-input-matakuliah">
                    <p>Daftar Data Program MBKM</p>
                    <button type="button" onclick="openModal()">Tambah Data Program</button>
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

                        <h1>Formulir Program MBKM</h1>
                        <form method="post" action="/mahasiswa/input_programmbkm" enctype="multipart/form-data">
                            <label for="nama">Nama:</label>
                            <input type="text" name="nama" required>
                            <br>

                            <label for="nim">NIM:</label>
                            <input type="text" name="nim" required>
                            <br>

                            <label for="semester">Semester:</label>
                            <input type="number" name="semester" required>
                            <br>

                            <label for="fakultas">Fakultas:</label>
                            <input type="text" name="fakultas" required>
                            <br>

                            <label for="program_studi">Program Studi:</label>
                            <input type="text" name="program_studi" required>
                            <br>

                            <label for="program_mbkm">Program MBKM:</label>
                            <select name="program_mbkm" id="program_mbkm" required>
                                <option value="" disabled selected>Pilih Program MBKM</option>
                                <option value="Kampus Mengajar">Kampus Mengajar</option>
                                <option value="Magang">Magang</option>
                                <option value="Studi Independent">Studi Independent</option>
                                <option value="Pertukaran Mahasiswa Merdeka">Pertukaran Mahasiswa Merdeka</option>
                                <option value="Wirausaha Merdeka">Wirausaha Merdeka</option>
                                <option value="Indonesian International Student Mobility Awards">Indonesian International Student Mobility Awards</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <br>

                            <div id="otherProgramMbkm" style="display: none;">
                                <label for="other_program_mbkm">Program MBKM lainnya:</label>
                                <input type="text" name="other_program_mbkm">
                                <br>
                            </div>

                            <label for="lokasi_program">Lokasi Program:</label>
                            <input type="text" name="lokasi_program" required>
                            <br>

                            <label for="dosen_pembimbing">Dosen Pembimbing:</label>
                            <select name="dosen_pembimbing" id="dosen_pembimbing" required>
                                <option value="">Pilih Dosen Pembimbing</option>
                                <?php foreach ($dosenOptions as $nip => $nama) : ?>
                                    <option value="<?= $nama; ?>" data-nip="<?= $nip; ?>"><?= $nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <br>

                            <label for="nip_dosen_pembimbing">NIP Dosen Pembimbing:</label>
                            <input type="text" name="nip_dosen_pembimbing" id="nip_dosen_pembimbing" readonly>
                            <br>

                            <div id="kegiatanEntries">
                                <label for="kegiatan">Kegiatan:</label>
                                <input type="text" name="kegiatan[]" required>
                                <br>

                                <label for="nilai">Nilai:</label>
                                <input type="text" name="nilai[]" required>
                                <br>
                            </div>

                            <button type="button" class="btn-add" onclick="addKegiatanEntry()">Tambah Kegiatan</button>
                            <br>

                            <label for="file_bukti">File Bukti (PDF, DOC, DOCX):</label>
                            <input type="file" name="file_bukti" accept=".pdf, .doc, .docx" required>
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
                                <th>Nama Mahasiswa</th>
                                <th>NIM</th>
                                <th>Semester</th>
                                <th>Fakultas</th>
                                <th>Program Studi</th>
                                <th>Program MBKM</th>
                                <th>Lokasi Program</th>
                                <th>Dosen Pembimbing</th>
                                <th>NIP Dosen Pembimbing</th>
                                <th>Kegiatan</th>
                                <th>Nilai</th>
                                <th>File Bukti</th>
                                <th>Status</th>
                                <th>Grup ID</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1; ?>
                            <?php foreach ($programMbkmList as $programMbkm) : ?>
                                <tr>
                                    <td><?= $counter++; ?></td>
                                    <td><?= $programMbkm['nama_mahasiswa'] ?></td>
                                    <td><?= $programMbkm['nim'] ?></td>
                                    <td><?= $programMbkm['semester'] ?></td>
                                    <td><?= $programMbkm['fakultas'] ?></td>
                                    <td><?= $programMbkm['program_studi'] ?></td>
                                    <td><?= $programMbkm['program_mbkm'] ?></td>
                                    <td><?= $programMbkm['lokasi_program'] ?></td>
                                    <td><?= $programMbkm['dosen_pembimbing'] ?></td>
                                    <td><?= $programMbkm['nip_dosen_pembimbing'] ?></td>
                                    <td><?= $programMbkm['kegiatan'] ?></td>
                                    <td><?= $programMbkm['nilai'] ?></td>
                                    <td>
                                        <?php if ($programMbkm['file_bukti']) : ?>
                                            <object data="<?= base_url('uploads/' . $programMbkm['grup_id'] . '/bukti/' . $programMbkm['file_bukti']) ?>" type="application/pdf" width="900" height="400">
                                                <p>PDF cannot be displayed. <a href="<?= base_url('uploads/' . $programMbkm['grup_id'] . '/bukti/' . $programMbkm['file_bukti']) ?>">Download PDF</a></p>
                                            </object>
                                        <?php else : ?>
                                            No file available
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $programMbkm['status'] ?></td>
                                    <td><?= $programMbkm['grup_id'] ?></td>
                                    <td>
                                        <a href="/edit_programmbkm/<?= $programMbkm['id']; ?>" class="ui button primary" onclick="confirmEdit(<?= $programMbkm['id']; ?>)">Edit</a>
                                        <a href="/delete_programmbkm/<?= $programMbkm['id']; ?>" class="ui button negative" onclick="confirmDelete(<?= $programMbkm['id']; ?>)">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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

    <!-- script untuk mengisi nip dosen pembimbing secara otomatis di formulir berdasarakan nama dosen_pembimbing yang dipilih-->
    <script>
        document.getElementById('dosen_pembimbing').addEventListener('change', function() {

            const selectedDosen = this.value;


            const selectedOption = this.options[this.selectedIndex];
            const nipDosen = selectedOption.dataset.nip;

            document.getElementById('nip_dosen_pembimbing').value = nipDosen || '';
        });
    </script>

    <!-- Script untuk menambahkan program mbkm di dalam formulir -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#program_mbkm').change(function() {
                if ($(this).val() === 'Lainnya') {
                    $('#otherProgramMbkm').show();
                } else {
                    $('#otherProgramMbkm').hide();
                }
            });
        });
    </script>

    <!-- SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmEdit(programId) {
            Swal.fire({
                title: 'Konfirmasi Edit',
                text: 'Apakah Anda yakin ingin mengedit data ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Edit!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/edit_programmbkm/" + programId;
                }
            });
        }

        function confirmDelete(programId) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteProgram(programId);
                }
            });
        }

        function deleteProgram(programId) {
            window.location.href = "/delete_programmbkm/" + programId;
        }
    </script>

    <!-- Script untuk menambahkan data kegiatan dan nilai secara dinamis di dalam formulir -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Pemanggilan fungsi addKegiatanEntry() setelah halaman terbaca sepenuhnya
            document.getElementById('program_mbkm').addEventListener('change', function() {
                const otherProgramMbkm = document.getElementById('otherProgramMbkm');
                otherProgramMbkm.style.display = this.value === 'other' ? 'block' : 'none';
            });
        });

        function addKegiatanEntry() {
            const kegiatanEntries = document.getElementById('kegiatanEntries');
            const newEntry = document.createElement('div');
            newEntry.innerHTML = `
                                <label for="kegiatan">Kegiatan:</label>
                                <input type="text" name="kegiatan[]" required>
                                <br>

                                <label for="nilai">Nilai:</label>
                                <input type="text" name="nilai[]" required>
                                <br>
                                `;
            kegiatanEntries.appendChild(newEntry);
        }
    </script>
</body>

</html>