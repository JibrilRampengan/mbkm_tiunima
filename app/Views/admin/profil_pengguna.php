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
    <title>Profil Pengguna</title>

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
            <li>
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
            <li class="active">
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
                    <h1>Profil Pengguna</h1>
                    <br>
                    <h2>Halo, <span class="small-text-dashboard"><?php echo $_SESSION["username"]; ?></h2>
                    <p>Anda berada di halaman<b> " Profil Pengguna " </b>Di sini, Anda dapat mengelola informasi akun Anda.</p>
                </div>
            </div>

            <br>

            <div class="card-validasi-data">
                <div class="card-header-validasi-data">
                    <p>Data Profil</p>
                </div>

                <?php if (isset($validation)) : ?>
                    <div style="color: red;">
                        <?= $validation->listErrors() ?>
                    </div>
                <?php endif; ?>

                <?php
                $profilePicturePath = empty($admin['profile_picture'])
                    ? base_url('assets/img/people_default.jpg') // Ganti dengan path gambar default Anda
                    : base_url('writable/uploads/' . $admin['profile_picture']);
                ?>

                <form class="Profil-pengguna" method="post" action="<?= base_url('admin/profilPengguna') ?>" enctype="multipart/form-data">
                    <div>
                        <img id="profile_picture_preview" src="<?= $profilePicturePath ?>" alt="Profile Picture">
                    </div>
                    <div>
                        <label for="profile_picture">Foto Profil :</label>
                        <input type="file" id="profile_picture" name="profile_picture" onchange="previewProfilePicture(event)">
                    </div>
                    <p style="font-style: italic;">* Silakan masukkan informasi profil baru jika Anda ingin melakukan perubahan.</p>
                    <div>
                        <label for="username">Nama Pengguna (Username) :</label>
                        <input type="text" id="username" name="username" value="<?= set_value('username', $admin['username']) ?>">
                    </div>
                    <p style="font-style: italic;">* Silakan masukkan informasi username baru jika Anda ingin melakukan perubahan.</p>
                    <div>
                        <label for="password">Kata Sandi (Password):</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <p style="font-style: italic;">* Silakan masukkan informasi password baru jika Anda ingin melakukan perubahan.</p>
                    <div>
                        <label for="confirm_password">Konfirmasi Kata Sandi :</label>
                        <input type="password" id="confirm_password" name="confirm_password">
                    </div>
                    <p style="font-style: italic;">* Silakan masukkan konfirmasi password baru jika Anda ingin melakukan perubahan.</p>
                    <div>
                        <label for="nim">NIM :</label>
                        <input type="text" id="nim" name="nim" value="<?= set_value('nim', $admin['nim']) ?>">
                    </div>
                    <div>
                        <button type="submit">Update Profile</button>
                    </div>
                </form>

            </div>

        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

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


    <!-- Script untuk review foto profil baru sebelum digunakan -->
    <script>
        function previewProfilePicture(event) {
            var input = event.target;
            var preview = document.getElementById('profile_picture_preview');

            var reader = new FileReader();
            reader.onload = function() {
                if (input.files && input.files[0]) {
                    preview.src = reader.result;
                }
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.src = "<?php echo base_url('assets/img/people_default.jpg'); ?>";
            }
        }
    </script>
</body>

</html>