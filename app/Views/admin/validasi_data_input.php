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
                    <p>Daftar Data Input</p>
                </div>

                <?php if (session()->getFlashdata('error')) : ?>
                    <p style="color: red;"><?= session()->getFlashdata('error') ?></p>
                <?php endif; ?>

                <table id="example" class="ui celled table nowrap unstackable" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Semester</th>
                            <th>Program MBKM</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (is_array($grupIds) && count($grupIds) > 0) : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($grupIds as $grup) : ?>
                                <?php
                                // Panggil fungsi getStatusForGrupId dari model untuk mendapatkan status
                                $status = $adminModel->getStatusForGrupId($grup);

                                // Ambil data mahasiswa dari tabel matakuliah_mahasiswa
                                $dataMatakuliah = $adminModel->getMatakuliahByGrupId($grup);
                                ?>

                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td>
                                        <?php
                                        // Tampilkan nama mahasiswa dari data matakuliah
                                        if (!empty($dataMatakuliah)) {
                                            echo htmlspecialchars($dataMatakuliah[0]->nama_mahasiswa);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        // Tampilkan NIM dari data matakuliah
                                        if (!empty($dataMatakuliah)) {
                                            echo htmlspecialchars($dataMatakuliah[0]->nim);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        // Tampilkan semester dari data matakuliah
                                        if (!empty($dataMatakuliah)) {
                                            echo htmlspecialchars($dataMatakuliah[0]->semester);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        // Tampilkan program_mbkm dari data program_mbkm
                                        $dataProgramMbkm = $adminModel->getProgramMbkmByGrupId($grup);
                                        if (!empty($dataProgramMbkm)) {
                                            echo htmlspecialchars($dataProgramMbkm[0]->program_mbkm);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?= form_open('/admin/prosesValidasi') ?>
                                        <input type="hidden" name="grup_id" value="<?= $grup ?>">

                                        <?php
                                        // Tampilkan teks sesuai dengan status
                                        if ($status === 'disetujui') {
                                            echo '✓ Disetujui';
                                        } elseif ($status === 'ditolak') {
                                            echo 'X Ditolak';
                                        } else {
                                            echo '<button type="submit">Proses Data</button>';
                                        }
                                        ?>

                                        <?= form_close() ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6">Tidak ada Grup ID tersedia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

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

</body>

</html>