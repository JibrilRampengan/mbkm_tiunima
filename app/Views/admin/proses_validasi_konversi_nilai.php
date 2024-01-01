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
    <title>Validasi Data Konversi Nilai</title>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css'); ?>">
    <link href="<?php echo base_url('assets/img/informatika.svg'); ?>" rel="shortcut icon">

    <style>
        #sidebar {
            z-index: 1;
        }

        .label-container {
            display: flex;
            align-items: center;
            margin-bottom: 8px;
        }

        .label-container label {
            width: 200px;
            margin-right: 10px;
        }

        .label-container span {
            flex: 1;

        }

        .hidden-column {
            display: none !important;
        }

        .visible-column {
            display: table-cell !important;
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
            <li>
                <a href="<?php echo base_url('admin/validasi_data_input'); ?>">
                    <i class='bx bx-check'></i>
                    <span class="text">validasi data Input</span>
                </a>
            </li>
            <li class="active">
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
                    <h1>Validasi Data Konversi Nilai</h1>
                    <br>
                    <h2>Halo, <span class="small-text-dashboard"><?php echo $_SESSION["username"]; ?></h2>
                    <p>Anda berada di halaman<b> " Validasi Data Konversi Nilai " </b>Pada halaman ini anda bisa memvalidasi data dan juga anda dapat melakukan perubahn pada data konversi nilai yang di input oleh mahasiswa.</p>
                </div>
            </div>

            <br>

            <div class="card-validasi-data">
                <div class="card-header-validasi-data">
                    <p>Daftar Data Konversi Nilai</p>
                </div>

                <!-- <p>Grup ID yang dipilih: <?= $grupId ?></p> -->

                <form action="/admin/simpan_perubahan_konversi_nilai/<?= $grupId ?>" method="post">
                    <input type="hidden" name="grup_id" value="<?= $grupId ?>">

                    <?php if (!empty($dataKonversiNilai)) : ?>
                        <?php $data = $dataKonversiNilai[0]; ?>
                        <div class="label-container">
                            <label>Nama Mahasiswa</label>
                            <span> : <?= $data['nama_mahasiswa'] ?></span>
                        </div>
                        <div class="label-container">
                            <label>NIM</label>
                            <span> : <?= $data['nim'] ?></span>
                        </div>
                        <div class="label-container">
                            <label>Semester</label>
                            <span> : <?= $data['semester'] ?></span>
                        </div>
                        <div class="label-container">
                            <label>Fakultas</label>
                            <span> : <?= $data['fakultas'] ?></span>
                        </div>
                        <div class="label-container">
                            <label>Program Studi</label>
                            <span> : <?= $data['program_studi'] ?></span>
                        </div>
                        <div class="label-container">
                            <label>Lokasi Program</label>
                            <span> : <?= $data['lokasi_program'] ?></span>
                        </div>
                        <div class="label-container">
                            <label>DPL</label>
                            <span> : <?= $data['dosen_pembimbing_lapangan'] ?></span>
                        </div>
                        <div class="label-container">
                            <label>NIP DPL</label>
                            <span> : <?= $data['nip_dosen_pembimbing_lapangan'] ?></span>
                        </div>
                        <div class="label-container">
                            <label>Program MBKM</label>
                            <span> : <?= $data['program_mbkm'] ?></span>
                        </div>
                    <?php endif; ?>

                    <br>

                    <table id="tablevalidasidatakonversinilai" class="ui celled table nowrap unstackable" style="width:100%">
                        <thead>
                            <tr>
                                <th class="hidden-column">Nama Mahasiswa</th>
                                <th class="hidden-column">NIM</th>
                                <th class="hidden-column">Semester</th>
                                <th class="hidden-column">Fakultas</th>
                                <th class="hidden-column">Program Studi</th>
                                <th class="hidden-column">Lokasi Program</th>
                                <th class="hidden-column">Dosen Pembimbing Lapangan</th>
                                <th class="hidden-column">NIP Dosen Pembimbing Lapangan</th>
                                <th class="hidden-column">Program MBKM</th>
                                <th class="visible-column">Kegiatan</th>
                                <th class="visible-column">Rekognisi MK</th>
                                <th class="visible-column" style="width:50px;">Kode Matakuliah</th>
                                <th class="visible-column" style="width:50px;">SKS</th>
                                <th class="visible-column" style="width:50px;">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataKonversiNilai as $data) : ?>
                                <tr>
                                    <td class="hidden-column"><input type="text" name="nama_mahasiswa[]" value="<?= $data['nama_mahasiswa'] ?>" readonly></td>
                                    <td class="hidden-column"><input type="text" name="nim[]" value="<?= $data['nim'] ?>" readonly></td>
                                    <td class="hidden-column"><input type="text" name="semester[]" value="<?= $data['semester'] ?>" readonly></td>
                                    <td class="hidden-column"><input type="text" name="fakultas[]" value="<?= $data['fakultas'] ?>"></td>
                                    <td class="hidden-column"><input type="text" name="program_studi[]" value="<?= $data['program_studi'] ?>"></td>
                                    <td class="hidden-column"><input type="text" name="lokasi_program[]" value="<?= $data['lokasi_program'] ?>"></td>
                                    <td class="hidden-column"><input type="text" name="dosen_pembimbing_lapangan[]" value="<?= $data['dosen_pembimbing_lapangan'] ?>"></td>
                                    <td class="hidden-column"><input type="text" name="nip_dosen_pembimbing_lapangan[]" value="<?= $data['nip_dosen_pembimbing_lapangan'] ?>"></td>
                                    <td class="hidden-column"><input type="text" name="program_mbkm[]" value="<?= $data['program_mbkm'] ?>"></td>
                                    <td class="visible-column"><input type="text" name="kegiatan[]" value="<?= $data['kegiatan'] ?>" style="width: 100%; height: 30px;"></td>
                                    <td class="visible-column"><input type="text" name="rekognisi_mk[]" value="<?= $data['rekognisi_mk'] ?>" style="width: 100%; height: 30px;"></td>
                                    <td class="visible-column"><input type="text" name="kode_matakuliah[]" value="<?= $data['kode_matakuliah'] ?>" style="width: 100%; height: 30px;"></td>
                                    <td class="visible-column"><input type="text" name="sks[]" value="<?= $data['sks'] ?>" style="width: 100%; height: 30px;"></td>
                                    <td class="visible-column"><input type="text" name="nilai[]" value="<?= $data['nilai'] ?>" style="width: 100%; height: 30px;"></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <button type="submit"> Simpan Data </button>
                </form>
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
        new DataTable('#tablevalidasidatakonversinilai', {
            responsive: true
        });
    </script>

</body>

</html>