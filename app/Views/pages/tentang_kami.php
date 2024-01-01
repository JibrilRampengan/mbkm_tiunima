<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/informasi.css'); ?>">
    <title>Tentang Kami</title>
    <link href="<?php echo base_url('assets/img/informatika.svg'); ?>" rel="shortcut icon">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/tentang_programstudi.css'); ?>">
</head>

<body>
    <div id="navbar">
        <nav class="navbar">
            <div class="navbar-logo">
                <img src="<?php echo base_url('assets/img/Logo.png'); ?>" alt="Logo">
            </div>
            <ul class="navbar-menu">
                <li><a href="<?php echo base_url('/'); ?>">Beranda</a></li>
                <li><a href="<?php echo base_url('/pages/informasi_mbkm'); ?>">Informasi Seputar MBKM</a></li>
                <li><a href="<?php echo base_url('/pages/tentang_kami'); ?>">Tentang Kami</a></li>
            </ul>
            <div class="navbar-buttons">
                <a href="login.php" class="login-button">Login</a>
            </div>
        </nav>

        <section id="navigation-container">
            <div id="navigation-content-container">
                <h1>Tentang Kami</h1>
                <p>Selamat Datang di pusat informasi Teknik Informatika Universitas Negeri Manado.
                </p>
                <a href="#about"><button>Telusuri</button></a>
            </div>
            <div id="navigation-bg-container">
                <svg width="1016" height="526" viewBox="0 0 1016 526" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <image xlink:href="<?php echo base_url('assets/img/information.svg'); ?>" width="1016" height="550" />
                </svg>
            </div>
        </section>

        <section id="about" class="section">
            <div class="holder">
                <h2><span class="underline">Tentang Kami</span></h2>
                <div class="description">
                    <p>Teknik Informatika adalah bidang yang berfokus pada pengembangan dan penerapan teknologi informasi untuk memecahkan masalah di dunia nyata. Tim kami terdiri dari para profesional yang berpengetahuan luas dan berpengalaman di berbagai aspek Teknik Informatika. Kami memiliki keahlian dalam pengembangan perangkat lunak, analisis data, keamanan informasi, jaringan komputer, dan banyak lagi. Kami menggunakan berbagai bahasa pemrograman, algoritma, dan metodologi pengembangan untuk menciptakan solusi inovatif dan efisien.</p>
                </div>
                <div class="description">
                    <h3>Visi</h3>
                    <hr class="divider">
                    <p>Pada Tahun 2022 menjadi Program Studi penghasil tenaga ahli Teknik Informatika yang berkarakter, inovatif, dan unggul kompetitif.</p>
                </div>
                <div class="description">
                    <h3>Misi</h3>
                    <hr class="divider">
                    <ul>
                        <li>Melaksanakan dan mengembangkan pendidikan yang berkualitas untuk menghasilkan lulusan ahli Teknik Informatika yang berkarakter, inovatif, dan unggul kompetitif</li>
                        <li>Melaksanakan dan mengembangkan penelitian di bidang Teknik Informatika yang berkarakter, inovatif, dan unggul kompetitif.</li>
                        <li>Melaksanakan dan mengembangkan kegiatan pengabdian kepada masyarakat di bidang Teknik Informatika yang berkarakter, inovatif, dan unggul kompetitif</li>
                    </ul>
                </div>
            </div>
        </section>

        <section id="profil-lulusan" class="section">
            <div class="container">
                <h2><span class="underline">Profil Lulusan</span></h2>
                <p>Berikut ini, profil lulusan yang bisa didapatkan</p>
                <div class="profiles">
                    <div class="profile">
                        <h3>Cloud Computing Developer</h3>
                        <p>Cloud Computing Developer adalah seorang profesional yang memiliki keahlian dalam mengembangkan aplikasi, layanan, dan infrastruktur berbasis cloud.</p>
                    </div>
                    <div class="profile">
                        <h3>Program Analyst</h3>
                        <p>Program Analyst adalah seorang profesional yang bertanggung jawab untuk menganalisis, merancang, mengembangkan, dan mengelola program komputer dan sistem informasi dalam suatu organisasi.</p>
                    </div>
                    <div class="profile">
                        <h3>Object Programmer</h3>
                        <p>Seorang Object-Oriented Programmer adalah seorang profesional dalam bidang pemrograman yang menguasai paradigma pemrograman berorientasi objek. </p>
                    </div>
                    <div class="profile">
                        <h3>Database Programmer</h3>
                        <p>Database Programmer adalah seorang profesional dalam bidang pemrograman yang khusus mengkhususkan diri dalam pengembangan, pemeliharaan, dan optimalisasi basis data. </p>
                    </div>
                    <div class="profile">
                        <h3>Web Developer</h3>
                        <p>Web Developer adalah seorang profesional dalam bidang pengembangan aplikasi web. Mereka memiliki keterampilan dan pengetahuan untuk merancang, mengembangkan, dan memelihara situs web dan aplikasi web.</p>
                    </div>
                    <div class="profile">
                        <h3>Software Engineer</h3>
                        <p>Software Engineer adalah seorang profesional yang terlibat dalam pengembangan perangkat lunak dan sistem komputer.</p>
                    </div>
                    <div class="profile">
                        <h3>Network Administrator</h3>
                        <p>Network Administrator adalah seorang profesional yang bertanggung jawab untuk merancang, mengkonfigurasi, mengelola, dan memelihara jaringan komputer dalam suatu organisasi.</p>
                    </div>
                    <div class="profile">
                        <h3>Network Designer</h3>
                        <p>Network Designer adalah seorang profesional yang bertanggung jawab untuk merancang dan merencanakan infrastruktur jaringan yang kompleks dalam suatu organisasi.</p>
                    </div>
                    <div class="profile">
                        <h3>Cyber Security Analyst</h3>
                        <p>Cyber Security Analyst adalah seorang profesional yang bertanggung jawab untuk melindungi sistem komputer, jaringan, dan data organisasi dari ancaman keamanan digital.</p>
                    </div>
                </div>
            </div>
        </section>



        <section class="team-section">
            <h2 class="section-title">Tim Kami</h2>
            <p class="section-description">Berikut ini, nama nama anggota tim kami.</p>
            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Vivi Peggie Rantung ST, MISD</h3>
                    <p class="member-position">Ketua Program Studi</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Glady C. Rorimpandey, ST, MISD</h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Cindy R.C. Munaiseche. ST, M.eng</h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Olivia Kembuan S.com, M.eng </h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Dr. Irene R.H. Tangkowarow. ST, MISD</h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Drs. Djafar Wonggo. MT</h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Quido C. Kainde, ST, MISD </h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Ferdiand I. Sangkop ST, MISD</h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Sondy C. Kumajas ST, MT</h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Kristofel Santa, S.ST, M.MT</h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Dr. Audy A. Kenap ST,M.eng</h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Made Krisnanda, ST,MT</h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Efraim R.S. Moningkey ST,MT</h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Glen D.P. Maramis, M.compSc</h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Stralen Pratasi. S.Kom, MT</h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Medi H. Tinambunan, M.Kom</h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Alfiansyah Hasibuan, S.Kom, M.Kom</h3>
                    <p class="member-position">Dosen</p>
                </div>
            </div>

            <div class="team-card">
                <img src="<?php echo base_url('assets/img/people.jpg'); ?>" alt="Anggota Tim">
                <div class="card-overlay">
                    <h3 class="member-name">Christedy Ibrahim Tangkuman</h3>
                    <p class="member-position">Staff</p>
                </div>
            </div>
        </section>

        <footer class="footer">
            <div class="container">
                <div class="footer-content">
                    <div class="logo">
                        <img src="<?php echo base_url('assets/img/Informatika.svg'); ?>" alt="Logo Teknik Informatika">
                        <h4 class="footer-subheading">Teknik Informatika UNIMA</h4>
                    </div>
                    <div class="footer-column">
                        <h4 class="footer-heading">Program</h4>
                        <ul class="footer-menu">
                            <li><a href="https://kampusmerdeka.kemdikbud.go.id/program" target="_blank">Program Unggulan</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4 class="footer-heading">Navigasi</h4>
                        <ul class="footer-menu">
                            <li><a href="index.html">Beranda</a></li>
                            <li><a href="informasi_mbkm.php">Informasi Seputar MBKM</a></li>
                            <li><a href="index.html">Proses Konversi Nilai</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4 class="footer-heading">Hubungi Kami</h4>
                        <ul class="footer-social">
                            <li><a href="https://www.facebook.com/profile.php?id=100046755076902"><img src="<?php echo base_url('assets/img/facebook.svg'); ?>" alt="Facebook"></a></li>
                            <li><a href="https://www.instagram.com/informatikaftunima/"><img src="<?php echo base_url('assets/img/instagram.svg'); ?>" alt="Instagram"></a></li>
                            <li><a href="https://www.youtube.com/@informatikaftunima6429/featured"><img src="<?php echo base_url('assets/img/youtube.svg'); ?>" alt="YouTube"></a></li>
                        </ul>
                        <h4 class="footer-heading">Gmail</h4>
                        <ul class="footer-menu">
                            <li><a href="https://mail.google.com/">teknikinformatika@unima.ac.id</a></li>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>&copy; 2023 Hak Cipta. Jibril Rampengan, Teknik Informatika UNIMA</p>
                </div>
            </div>
        </footer>

</body>

</html>