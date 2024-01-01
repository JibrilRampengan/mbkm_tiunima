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
    <title>Data Admin</title>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css'); ?>">
    <link href="<?php echo base_url('assets/img/informatika.svg'); ?>" rel="shortcut icon">

    <style>
        #sidebar {
            z-index: 1;
        }

        #modalTambahDosen {
            max-width: 600px;
        }

        #modalTambahDosen .header {
            background-color: #2185d0;
            color: #fff;
        }

        #modalTambahDosen .content {
            padding: 20px;
        }

        #modalTambahDosen button.ui.button {
            background-color: #21ba45;
            color: #fff;
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
            <li class="active">
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
                    <h1>Data Akun Admin</h1>
                    <br>
                    <h2>Halo, <span class="small-text-dashboard"><?php echo $_SESSION["username"]; ?></h2>
                    <p>Anda berada di halaman<b> " Data Akun Admin " </b>Pada halaman ini, Anda dapat melihat informasi akun admin, menambahkan admin baru dan menghapus akun admin.</p>
                </div>
            </div>

            <br>

            <div class="card-validasi-data">
                <div class="card-header-validasi-data">
                    <p>Daftar Akun Admin</p>
                    <button id="btnTambahAdmin" type="button">Tambah Admin</button>
                </div>

                <?php if (session()->has('success')) : ?>
                    <p style="color: green;"><?= session('success') ?></p>
                <?php endif; ?>

                <?php if (session()->has('error')) : ?>
                    <p style="color: red;"><?= session('error') ?></p>
                <?php endif; ?>

                <?php if ($validation) : ?>
                    <p style="color: red;"><?= $validation->listErrors() ?></p>
                <?php endif; ?>

                <!-- Modal -->
                <div id="modalTambahAdmin" class="ui modal">
                    <i class="close icon"></i>
                    <div class="header">
                        Tambah Admin
                    </div>
                    <div class="content">
                        <form action="/admin/data_admin" method="post" class="ui form">
                            <div class="field">
                                <label for="new_username">Username Admin:</label>
                                <input type="text" name="new_username" required>
                            </div>

                            <div class="field">
                                <label for="new_password">Password Baru:</label>
                                <input type="password" name="new_password" required>
                            </div>

                            <div class="field">
                                <label for="nim">NIM:</label>
                                <input type="text" name="nim" required>
                            </div>

                            <div class="field">
                                <label for="tipe_pengguna">Tipe Pengguna:</label>
                                <input type="text" name="tipe_pengguna" value="admin" readonly>
                            </div>

                            <button type="submit" class="ui button primary">Tambah Admin</button>
                        </form>
                    </div>
                </div>

                <br>

                <?php if ($adminData) : ?>
                    <table id="example" class="ui celled table nowrap unstackable" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>NIM</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($adminData as $index => $admin) : ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $admin['username'] ?></td>
                                    <td><?= $admin['password'] ?></td>
                                    <td><?= $admin['nim'] ?></td>
                                    <td>
                                        <button onclick="confirmDeleteAdmin('<?= $admin['id'] ?>')" class="ui red button">Hapus</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>Tidak ada data admin.</p>
                <?php endif; ?>


            </div>

        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="<?php echo base_url('assets/js/mahasiswa.js'); ?>"></script>

    <!-- script untuk tabel-->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.2/semantic.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.semanticui.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.semanticui.min.js"></script>


    <!-- Script untuk modal -->
    <script>
        $('#modalTambahAdmin').modal({
            closable: false,
        });

        $('#btnTambahAdmin').on('click', function() {
            $('#modalTambahAdmin').modal('show');
        });

        new DataTable('#example', {
            responsive: true
        });
    </script>

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


    <!-- Sweet alert untuk konfirimasi penghapus akun admin -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmDeleteAdmin(adminId) {
            Swal.fire({
                title: 'Konfirmasi Hapus Admin',
                text: 'Apakah Anda yakin ingin menghapus admin ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = document.createElement('form');
                    form.setAttribute('action', '/admin/delete_admin');
                    form.setAttribute('method', 'post');

                    var inputAdminId = document.createElement('input');
                    inputAdminId.setAttribute('type', 'hidden');
                    inputAdminId.setAttribute('name', 'admin_id');
                    inputAdminId.setAttribute('value', adminId);

                    form.appendChild(inputAdminId);
                    document.body.appendChild(form);

                    form.submit();
                }
            });
        }
    </script>
</body>

</html>