<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/mahasiswa.css'); ?>">
    <link href="<?php echo base_url('assets/img/informatika.svg'); ?>" rel="shortcut icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css'>
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <title>Dashboard</title>

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
            <li class="active">
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
                    <h1>Dashboard</h1>
                    <h2>Selamat Datang , <span class="small-text-dashboard"><?php echo $_SESSION["username"]; ?></h2>
                    <p>Anda berada di website<b> "Konversi Nilai Program MBKM" </b>Teknik Informatika, Universitas Negeri Manado. Di sini, Anda dapat mengisi data tambahan yang diperlukan untuk verifikasi program MBKM dan melakukan proses konversi nilai program MBKM anda.</p>
                </div>
            </div>
            <ul class="box-info">
                <li>
                    <i class='bx bx-user'></i>
                    <span class="text">
                        <h3><?= $mahasiswa['jumlah_konversi'] ?></h3>
                        <p>Jumlah mahasiswa yang mengajukan konversi nilai</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-file'></i>
                    <span class="text">
                        <h3><?= $mahasiswa['jumlah_disetujui']; ?></h3>
                        <p>Jumlah pengajuan mahasiswa yang disetujui</p>
                    </span>
                </li>
                <li>
                    <i class='bx bxs-check-circle'></i>
                    <span class="text">
                        <h3><?= $mahasiswa['jumlah_selesai']; ?></h3>
                        <p>Jumlah Konversi Nilai yang telah selesai</p>
                    </span>
                </li>
            </ul>


            <div class="container-proses">
                <h1 class="langkah">Langkah-langkah Konversi Nilai</h1>
                <div class="card">
                    <div class="title">
                        Step
                    </div>
                    <div class="circle">1</div>
                    <div class="content">
                        <h3>Input Data</h3>
                        <p>Setelah login ke akun, pergilah ke halaman <b>Input Matakuliah</b>, lalu isi formulir sesuai dengan matakuliah yang tercantum di Kartu Rencana Studi (KRS) Anda. Setelah selesai, lanjutkan ke halaman <b>Input Program MBKM</b> dan isi formulir sesuai dengan program MBKM yang Anda ikuti.</p>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="title">
                        Step
                    </div>
                    <div class="circle">2</div>
                    <div class="content">
                        <h3>Verifikasi Data</h3>
                        <p>Setelah Anda mengisi formulir untuk matakuliah dan program MBKM, data Anda akan diverifikasi oleh admin. Admin akan memeriksa dan menyetujui apakah data tersebut dapat diproses untuk konversi nilai atau tidak. Anda juga dapat memantau status data input pada halaman <b>Status Data</b>.</p>
                        <div class="icon">
                            <i class="fas fa-check"></i>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="title">
                        Step
                    </div>
                    <div class="circle">3</div>
                    <div class="content">
                        <h3>Konversi Nilai</h3>
                        <p>Setelah mendapatkan persetujuan dari admin, langkah berikutnya adalah mengisi formulir konversi nilai melalui halaman <b>Konversi Nilai</b>. Tetapi, jika permohonan persetujuan admin tidak disetujui, pastikan untuk memeriksa kembali input data matakuliah dan program MBKM yang telah diajukan.</p>
                        <div class="icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="title">
                        Step
                    </div>
                    <div class="circle">4</div>
                    <div class="content">
                        <h3>Verifikasi Data Konversi Nilai</h3>
                        <p>Setelah Anda mengisi formulir konversi nilai, admin akan melakukan verifikasi dan pemrosesan data. Hasil dari proses tersebut dapat Anda lihat di halaman <b>Hasil Konversi Nilai</b> dan Anda akan mendapat sebuah berita acara yang dapat digunakan untuk proses tahap selanjutnya.</p>
                        <div class="icon">
                            <i class="fas fa-check-double"></i>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="title">
                        Step
                    </div>
                    <div class="circle">5</div>
                    <div class="content">
                        <h3>Cetak Berita Acara</h3>
                        <p>Setelah admin menyelesaikan proses <b>konversi nilai</b>, kamu dapat mencetak berita acara. Berita acara dapat ditemukan di halaman <b>Berita Acara</b>. Setelah mencetak berita acara, jangan lupa untuk menandatanganinya dan memasukkannya secara langsung ke program studi.</p>
                        <div class="icon">
                            <i class="fas fa-print"></i>
                        </div>
                    </div>
                </div>
            </div>

        </main>
    </section>


    <script src="<?php echo base_url('assets/js/mahasiswa.js'); ?>"></script>

    <!--Sweet Alert untuk pesan login berhasil-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <script>
        <?php
        if (isset($_SESSION["login_success_message"])) {
            echo "document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil!',
                        text: '" . $_SESSION["login_success_message"] . "'
                    });
                });";
            unset($_SESSION["login_success_message"]);
        }
        ?>
    </script>

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