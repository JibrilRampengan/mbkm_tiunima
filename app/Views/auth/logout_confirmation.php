<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Out</title>
    <link href="<?php echo base_url('assets/img/informatika.svg'); ?>" rel="shortcut icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <!-- SweetAlert konfirmasi sebelum memutuskan untuk log out -->
    <script>
        Swal.fire({
            title: 'Konfirmasi Logout',
            text: 'Apakah Anda yakin ingin logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, logout!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengkonfirmasi, redirect ke fungsi logout
                window.location.href = '<?php echo site_url('auth/do_logout'); ?>';
            } else {
                // Jika pengguna membatalkan, redirect ke halaman login
                window.location.href = '<?php echo site_url('auth'); ?>';
            }
        });
    </script>

</body>

</html>