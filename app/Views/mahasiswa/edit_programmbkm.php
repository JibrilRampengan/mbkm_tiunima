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
    <title>Edit Program MBKM</title>

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
                    <h1>Edit Data Progam MBKM</h1>
                    <br>
                    <h2>Halo, <span class="small-text-dashboard"><?php echo $_SESSION["username"]; ?></h2>
                    <p>Anda berada di halaman<b> "Edit Data Program MBKM" </b>didalam halaman ini anda bisa mengedit atau mengubah data input program MBKM yang telah anda input </p>
                </div>
            </div>

            <br>

            <div class="card-input-matakuliah">
                <div class="card-header-input-matakuliah">
                    <p>Edit Program MBKM</p>
                </div>

                <?php if (session()->has('success')) : ?>
                    <p><?= session('success') ?></p>
                <?php endif; ?>

                <?php echo form_open_multipart('/edit_programmbkm/' . $programMbkm['id'], ['class' => 'edit_inputmatakuliah']); ?>

                <label for="nama">Nama Mahasiswa:</label>
                <input type="text" name="nama" value="<?= $programMbkm['nama_mahasiswa'] ?>" required>

                <label for="nim">NIM:</label>
                <input type="text" name="nim" value="<?= $programMbkm['nim'] ?>" required>

                <label for="semester">Semester:</label>
                <input type="text" name="semester" value="<?= $programMbkm['semester'] ?>" required>

                <label for="fakultas">Fakultas:</label>
                <input type="text" name="fakultas" value="<?= $programMbkm['fakultas'] ?>" required>

                <label for="program_studi">Program Studi:</label>
                <input type="text" name="program_studi" value="<?= $programMbkm['program_studi'] ?>" required>

                <label for="lokasi_program">Lokasi Program:</label>
                <input type="text" name="lokasi_program" value="<?= $programMbkm['lokasi_program'] ?>" required>

                <label for="dosen_pembimbing">Dosen Pembimbing:</label>
                <input type="text" name="dosen_pembimbing" value="<?= $programMbkm['dosen_pembimbing'] ?>" required>

                <label for="nip_dosen_pembimbing">NIP Dosen Pembimbing:</label>
                <input type="text" name="nip_dosen_pembimbing" value="<?= $programMbkm['nip_dosen_pembimbing'] ?>" required>

                <label for="program_mbkm">Program MBKM:</label>
                <input type="text" name="program_mbkm" value="<?= $programMbkm['program_mbkm'] ?>" required>

                <label for="kegiatan">Kegiatan:</label>
                <input type="text" name="kegiatan" value="<?= $programMbkm['kegiatan'] ?>" required>

                <label for="nilai">Nilai:</label>
                <input type="text" name="nilai" value="<?= $programMbkm['nilai'] ?>" required>

                <label for="file_bukti">File Bukti:</label>
                <input type="file" name="file_bukti">

                <button type="submit" class="btn btn-primary">Update Program MBKM</button>


                <?php echo form_close(); ?>

                <?php if (isset($validation)) : ?>
                    <p><?= $validation->listErrors() ?></p>
                <?php endif; ?>

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


</body>

</html>