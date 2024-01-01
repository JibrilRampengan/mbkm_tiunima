<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/login.css') ?>">
    <link rel="shortcut icon" href="<?= base_url('assets/img/informatika.svg') ?>">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Formulir Login -->
                <form action="<?= site_url('auth/login') ?>" class="sign-in-form" method="post">
                    <img src="<?= base_url('assets/img/Teknik Informatika.png') ?>" alt="Teknik Informatika Logo" class="logo" />
                    <h2 class="title">Masuk</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nomor Induk Mahasiswa" name="nim" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" />
                    </div>
                    <button type="submit" value="Login" name="login" class="btn solid">Masuk</button>
                </form>

                <!-- Formulir Register -->
                <form action="<?= site_url('auth/register') ?>" class="sign-up-form" method="post">
                    <img src="<?= base_url('assets/img/teknik informatika.png') ?>" alt="Teknik Informatika Logo" class="logoo" />
                    <h2 class="title">Daftar</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nama Pengguna" name="username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nomor Induk Mahasiswa" name="nim" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" />
                    </div>
                    <button type="submit" class="btn" name="signup">Daftar</button>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <!-- Panel Kiri -->
            <div class="panel left-panel">
                <div class="content">
                    <h3>Halo, Mahasiswa!</h3>
                    <p>
                        Silakan daftarkan diri Anda untuk memulai menggunakan layanan kami. Jika Anda sudah memiliki akun, silahkan masuk.
                    </p>
                    <button class="btn transparent" id="sign-up-btn" onclick="window.location.href='#'">Daftar</button>
                </div>
                <img src="<?= base_url('assets/img/login.svg') ?>" class="image" alt="" />
            </div>

            <!-- Panel Kanan -->
            <div class="panel right-panel">
                <div class="content">
                    <h3>Sudah mempunyai akun?</h3>
                    <p>
                        Untuk tetap terhubung dengan kami, silakan masuk dengan akun yang sudah Anda daftarkan.
                    </p>
                    <button class="btn transparent" id="sign-in-btn" onclick="window.location.href='#'">Masuk</button>
                </div>
                <img src="<?= base_url('assets/img/register.svg') ?>" class="image" alt="" />
            </div>
        </div>
    </div>


    <!-- Sweet alert informasi -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
    <script>
        <?php if (session()->has('login_error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= session('login_error') ?>'
            });
        <?php endif; ?>
        <?php if (session()->has('signup_error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= session('signup_error') ?>'
            });
        <?php elseif (session()->has('signup_success')) : ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Pendaftaran berhasil. Silakan login untuk melanjutkan.'
            });
        <?php endif; ?>
    </script>
</body>

</html>