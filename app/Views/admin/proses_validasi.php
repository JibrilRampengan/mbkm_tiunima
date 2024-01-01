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
    <title>Validasi Data Input</title>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css'); ?>">
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
        <a href="<?php echo base_url('admin/dashboard_admin'); ?>" class="brand">
            <img src="<?php echo base_url('assets/img/informatika.svg'); ?>" alt="Logo Teknik Informatika UNIMA" class="logo-img">
            <span class="text">Teknik Informatika</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="<?php echo base_url('admin/dashboard_admin'); ?>">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="<?php echo base_url('admin/validasi_data_input'); ?>">
                    <i class='bx bx-check'></i>
                    <span class="text">validasi data Input</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('admin/validasi_konversi_nilai'); ?>">
                    <i class='bx bx-list-check'></i>
                    <span class="text">Validasi Data Konversi Nilai</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('admin/rekapitulasi_hasil_konversi_nilai'); ?>">
                    <i class='bx bx-bar-chart'></i>
                    <span class="text">Rekapitulasi Hasil Konversi Nilai</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('admin/rekapitulasi_berita_acara'); ?>">
                    <i class='bx bxs-news'></i>
                    <span class="text">Rekapitulasi Berita Acara</span>
                </a>
            </li>
            <br>
            <li>
                <a href="<?php echo base_url('admin/data_matakuliah_programstudi'); ?>">
                    <i class='bx bx-list-ul'></i>
                    <span class="text">Data Mata Kuliah</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('admin/data_dosen'); ?>">
                    <i class='bx bx-user'></i>
                    <span class="text">Data Dosen</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('admin/data_mahasiswa'); ?>">
                    <i class='bx bx-user-check'></i>
                    <span class="text">Data Mahasiswa</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('admin/data_admin'); ?>">
                    <i class='bx bx-user-plus'></i>
                    <span class="text">Data Admin</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="<?php echo base_url('admin/profil_pengguna'); ?>">
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
                <img src="<?= empty($admin['profile_picture']) ? base_url('assets/img/people_default.jpg') : base_url('writable/uploads/' . $admin['profile_picture']); ?>" alt="Profile Picture" width="100" height="auto">
                <ul class="profile-dropdown">
                    <li><a href="<?php echo base_url('admin/profil_pengguna'); ?>" style="color: black;"> <i class='bx bxs-user'></i> Profil</a></li>
                    <li><a href="<?php echo base_url('auth/logout'); ?>" style="color: red;"> <i class='bx bx-log-out'></i> Log Out</a></li>
                </ul>
            </div>
            <div class="informasi_pengguna">
                <p><?= $admin['username']; ?><br><?= !empty($admin['nim']) ? $admin['nim'] : 'NIM Tidak Tersedia'; ?></p>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title-dashboard">
                <div class="left-dashboard">
                    <h1>Validasi Data Input</h1>
                    <br>
                    <h2>Halo, <span class="small-text-dashboard"><?php echo $_SESSION["username"]; ?></h2>
                    <p>Anda berada di halaman<b> "Validasi Data Input" </b>Pada halaman ini anda bisa memvalidasi data matakuliah dan program mbkm mahasiswa dengan cara menyetujui data mahasiswa untuk dilakukan proses konversi nilai atau menolak data mahasiswa untuk tidak dilakukan proses konversi nilai.</p>
                </div>
            </div>

            <br>

            <div class="card-validasi-data">
                <div class="card-header-validasi-data">
                    <h1>Data Mata Kuliah dan Program MBKM</h1>
                </div>

                <?php
                $previousGroupId = null;

                foreach ($dataMatakuliah as $matakuliah) :
                    if ($matakuliah->grup_id != $previousGroupId) : ?>
                        <div class="student-info" style="display: flex; flex-direction: column; font-size: 16px;">

                            <p style="display: flex; justify-content: space-between; margin-bottom: 0px;">
                                <span style="flex: 1; text-align: left; padding-right: 10px;">Nama</span> :
                                <span style="flex: 4; margin-left : 10px;"><?= $matakuliah->nama_mahasiswa ?></span>
                            </p>

                            <p style="display: flex; justify-content: space-between; margin-bottom: 0px;">
                                <span style="flex: 1; text-align: left; padding-right: 10px;">Nim</span> :
                                <span style="flex: 4; margin-left : 10px;"><?= $matakuliah->nim ?></span>
                            </p>

                            <p style="display: flex; justify-content: space-between; margin-bottom: 0px;">
                                <span style="flex: 1; text-align: left; padding-right: 10px;">Semester</span> :
                                <span style="flex: 4; margin-left : 10px;"><?= $matakuliah->semester ?></span>
                            </p>

                            <p style="display: flex; justify-content: space-between; margin-bottom: 0px;">
                                <span style="flex: 1; text-align: left; padding-right: 10px;">Fakultas</span> :
                                <span style="flex: 4; margin-left : 10px;"><?= $matakuliah->fakultas ?></span>
                            </p>

                            <p style="display: flex; justify-content: space-between; margin-bottom: 0px;">
                                <span style="flex: 1; text-align: left; padding-right: 10px;">Program Studi</span> :
                                <span style="flex: 4; margin-left : 10px;"><?= $matakuliah->program_studi ?></span>
                            </p>

                        </div>
                <?php

                        $previousGroupId = $matakuliah->grup_id;
                    endif;
                endforeach;
                ?>

                <br>
                <br>

                <h1 style="color: blue;">Matakuliah</h1>
                <table id="tableMatakuliah" class="ui celled table nowrap unstackable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Mata Kuliah</th>
                            <th>Kode MK</th>
                            <th>SKS</th>
                            <th>Dosen</th>
                            <th>File KRS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataMatakuliah as $matakuliah) : ?>
                            <tr>
                                <td><?= $matakuliah->nama_matakuliah ?></td>
                                <td><?= $matakuliah->kode_matakuliah ?></td>
                                <td><?= $matakuliah->sks ?></td>
                                <td><?= $matakuliah->nama_dosen ?></td>
                                <td>
                                    <?php if (!empty($matakuliah->file_krs)) : ?>
                                        <?php $fileKrsPath = base_url("uploads/{$matakuliah->grup_id}/krs/{$matakuliah->file_krs}"); ?>
                                        <object data="<?= $fileKrsPath ?>" type="application/pdf" width="900" height="400">
                                            <p>PDF cannot be displayed. <a href="<?= $fileKrsPath ?>" target="_blank">Download PDF</a></p>
                                        </object>
                                    <?php else : ?>
                                        No file available
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <br>
                <br>

                <h1 style="color: blue;">Program MBKM</h1>
                <table id="tableProgramMbkm" class="ui celled table nowrap unstackable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Program MBKM</th>
                            <th>Lokasi Program</th>
                            <th>Dosen Pembimbing</th>
                            <th>NIP Dosen Pembimbing</th>
                            <th>Kegiatan</th>
                            <th>Nilai</th>
                            <th>File Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataProgramMbkm as $programMbkm) : ?>
                            <tr>
                                <td><?= $programMbkm->program_mbkm ?></td>
                                <td><?= $programMbkm->lokasi_program ?></td>
                                <td><?= $programMbkm->dosen_pembimbing ?></td>
                                <td><?= $programMbkm->nip_dosen_pembimbing ?></td>
                                <td><?= $programMbkm->kegiatan ?></td>
                                <td><?= $programMbkm->nilai ?></td>
                                <td>
                                    <?php if ($programMbkm->file_bukti) : ?>
                                        <object data="<?= base_url('uploads/' . $programMbkm->grup_id . '/bukti/' . $programMbkm->file_bukti) ?>" type="application/pdf" width="900" height="400">
                                            <p>PDF cannot be displayed. <a href="<?= base_url('uploads/' . $programMbkm->grup_id . '/bukti/' . $programMbkm->file_bukti) ?>">Download PDF</a></p>
                                        </object>
                                    <?php else : ?>
                                        No file available
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <br>
                <br>

                <button class="setujui-button" onclick="confirmApproval('/admin/setujuiData/<?= $grupId ?>')">Setujui Data</button>
                <button class="tolak-button" onclick="confirmRejection('/admin/tolakData/<?= $grupId ?>')">Tolak Data</button>

            </div>
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="<?php echo base_url('assets/js/mahasiswa.js'); ?>"></script>

    <!--Menampilkan dropdown profile-->
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

    <!-- sweet alert konfirmasi untuk menyetujui dan menolak data -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>

    <script>
        function confirmApproval(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda ingin menyetujui data ini?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Setujui!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }

        function confirmRejection(url) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda ingin menolak data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Tolak!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>

    <!-- script untuk tabel-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.semanticui.min.js"></script>

    <script>
        new DataTable('#tableMatakuliah', {
            responsive: true
        });
    </script>

    <script>
        new DataTable('#tableProgramMbkm', {
            responsive: true
        });
    </script>

</body>

</html>