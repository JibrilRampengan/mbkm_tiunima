<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi MBKM</title>
    <link href="<?php echo base_url('assets/img/informatika.svg'); ?>" rel="shortcut icon">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/informasi_mbkm.css'); ?>">
    <style>
        #tab10 iframe {
            max-width: 100%;
            margin-bottom: 40px;
            margin-right: 38px;
            margin-left: 26px;
        }

        @media screen and (max-width: 768px) {
            #tab10 iframe {
                height: auto;
                max-width: 100%;
                margin-bottom: 40px;
            }
        }
    </style>
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

        <header class="hero">
            <h1>Informasi Seputar Merdeka Belajar Kampus Merdeka</h1>
            <p>Selamat datang di Halaman Informasi Seputar Merdeka Belajar - Kampus Merdeka! Program ini merupakan inisiatif Kementerian Pendidikan dan Kebudayaan Republik Indonesia yang bertujuan untuk merevolusi sistem pendidikan tinggi di Indonesia.</p>
        </header>

        <div class="tabs-container">
            <div class="tabs-menu">
                <button class="tab-btn active" data-tab="tab1">Latar Belakang</button>
                <button class="tab-btn" data-tab="tab2">Pengertian</button>
                <button class="tab-btn" data-tab="tab3">Landasan Hukum</button>
                <button class="tab-btn" data-tab="tab4">Tujuan</button>
                <button class="tab-btn" data-tab="tab5">Manfaat</button>
                <button class="tab-btn" data-tab="tab6">Fungsi</button>
                <button class="tab-btn" data-tab="tab7">Program yang ditawarkan</button>
                <button class="tab-btn" data-tab="tab8">Persyaratan ikut program</button>
                <button class="tab-btn" data-tab="tab9">Panduan konversi nilai</button>
                <button class="tab-btn" data-tab="tab10">Video Referensi</button>
            </div>
            <div class="tabs-content">
                <div id="tab1" class="tab-content active">
                    <h2>Latar Belakang</h2>
                    <p>Dalam rangka menyiapkan mahasiswa menghadapi perubahan sosial, budaya, dunia kerja dan kemajuan teknologi yang pesat, kompetensi mahasiswa harus disiapkan untuk lebih gayut dengan kebutuhan zaman. Link and match tidak saja dengan dunia industri dan dunia kerja tetapi juga dengan masa depan yang berubah dengan cepat. Perguruan Tinggi dituntut untuk dapat merancang dan melaksanakan proses pembelajaran yang inovatif agar mahasiswa dapat meraih capaian pembelajaran mencakup aspek sikap, pengetahuan, dan keterampilan secara optimal dan selalu relevan.</p>
                    <p>Kebijakan Merdeka Belajar - Kampus Merdeka diharapkan dapat menjadi jawaban atas tuntutan tersebut. Kampus Merdeka merupakan wujud pembelajaran di perguruan tinggi yang otonom dan fleksibel sehingga tercipta kultur belajar yang inovatif, tidak mengekang, dan sesuai dengan kebutuhan mahasiswa. Program utama yaitu: kemudahan pembukaan program studi baru, perubahan sistem akreditasi perguruan tinggi, kemudahan perguruan tinggi negeri menjadi PTN berbadan hukum, dan hak belajar tiga semester di luar program studi. Mahasiswa diberikan kebebasan mengambil SKS di luar program studi, tiga semester yang di maksud berupa 1 semester kesempatan mengambil mata kuliah di luar program studi dan 2 semester melaksanakan aktivitas pembelajaran di luar perguruan tinggi.</p>
                    <p>Berbagai bentuk kegiatan belajar di luar perguruan tinggi, di antaranya melakukan magang/ praktik kerja di Industri atau tempat kerja lainnya, melaksanakan proyek pengabdian kepada masyarakat di desa, mengajar di satuan pendidikan, mengikuti pertukaran mahasiswa, melakukan penelitian, melakukan kegiatan kewirausahaan, membuat studi/ proyek independen, dan mengikuti program kemanusisaan. Semua kegiatan tersebut harus dilaksanakan dengan bimbingan dari dosen. Kampus merdeka diharapkan dapat memberikan pengalaman kontekstual lapangan yang akan meningkatkan kompetensi mahasiswa secara utuh, siap kerja, atau menciptakan lapangan kerja baru. </p>
                    <p>Proses pembelajaran dalam Kampus Merdeka merupakan salah satu perwujudan pembelajaran yang berpusat pada mahasiswa (student centered learning) yang sangat esensial. Pembelajaran dalam Kampus Merdeka memberikan tantangan dan kesempatan untuk pengembangan inovasi, kreativitas, kapasitas, kepribadian, dan kebutuhan mahasiswa, serta mengembangkan kemandirian dalam mencari dan menemukan pengetahuan melalui kenyataan dan dinamika lapangan seperti persyaratan kemampuan, permasalahan riil, interaksi sosial, kolaborasi, manajemen diri, tuntutan kinerja, target dan pencapaiannya. Melalui program merdeka belajar yang dirancang dan diimplementasikan dengan baik, maka hard dan soft skills mahasiswa akan terbentuk dengan kuat. </p>
                </div>
                <div id="tab2" class="tab-content">
                    <h2>Apa itu Merdeka Belajar - Kampus Merdeka (MBKM) ?</h2>
                    <p> Program Merdeka Belajar – Kampus Merdeka (MBKM) adalah program yang dicanangkan oleh Menteri Pendidikan dan Kebudayaan yang bertujuan mendorong mahasiswa untu menguasai berbagai keilmuan untuk bekal memasuki dunia kerja. Melalui kebijakan ini, Kampus Merdeka memberikan kesempatan kepada mahasiswa memilih mata kuliah yang akan mereka ambil. Mahasiswa diberikan kesempatan untuk mengambil mata kuliah di luar program studi pada perguruan tinggi yang sama; mengambil mata kuliah pada program studi yang sama di perguruan tinggi yang berbeda; mengambil mata kuliah pada program studi yang berbeda di perguruan tinggi yang berbeda; dan/atau pembelajaran di luar perguruan tinggi.</p>
                </div>

                <div id="tab3" class="tab-content">
                    <h2>Landasan Hukum</h2>
                    <p>
                        Landasan hukum pelaksanaan program kebijakan Hak Belajar Tiga Semester di Luar Program Studi diantaranya, sebagai berikut:
                    </p>
                    <ol class="sejajar">
                        <li>Undang-Undang Nomor 20 Tahun 2003, tentang Sistem Pendidikan Nasional.</li>
                        <li>Undang-Undang Nomor 12 Tahun 2012, tentang Pendidikan Tinggi.</li>
                        <li>Undang-Undang Nomor 6 Tahun 2014, tentang Desa.</li>
                        <li>Peraturan Pemerintah Nomor 04 Tahun 2014, tentang Penyelenggaraan Pendidikan Tinggi dan Pengelolaan Perguruan Tinggi.</li>
                        <li>Peraturan Presiden Nomor 8 Tahun 2012, tentang KKNI.</li>
                        <li>Peraturan Menteri Desa, Pembangunan Daerah Tertinggal, dan Transmigrasi Nomor 11 Tahun 2019, tentang Prioritas Penggunaan Dana Desa Tahun 2020.</li>
                        <li>Peraturan Menteri Desa, Pembangunan Daerah Tertinggal, dan Transmigrasi Nomor 16 Tahun 2019, tentang Musyawarah Desa.</li>
                        <li>Peraturan Menteri Desa, Pembangunan Daerah Tertinggal, dan Transmigrasi Nomor 17 Tahun 2019, tentang Pedoman Umum Pembangunan dan Pemberdayaan Masyarakat Desa.</li>
                        <li>Peraturan Menteri Desa, Pembangunan Daerah Tertinggal, dan Transmigrasi Nomor 18 Tahun 2019, tentang Pedoman Umum Pendampingan Masyarakat Desa.</li>
                    </ol>
                </div>

                <div id="tab4" class="tab-content">
                    <h2>Apa Sih Tujuan Dari Merdeka Belajar - Kampus Merdeka (MBKM) ?</h2>
                    <p>Tujuan kebijakan Merdeka Belajar - Kampus Merdeka adalah untuk meningkatkan kompetensi lulusan, baik soft skills maupun hard skills, agar lebih siap dan relevan dengan kebutuhan zaman, menyiapkan lulusan sebagai pemimpin masa depan bangsa yang unggul dan berkepribadian. Program-program experiential learning dengan jalur yang fleksibel diharapkan akan dapat memfasilitasi mahasiswa mengembangkan potensinya sesuai dengan passion dan bakatnya.</p>
                </div>
                <div id="tab5" class="tab-content">
                    <h2>Kegunaan MBKM, Apakah Berdampak Positif atau Tidak ? </h2>
                    <p>Merdeka Belajar-Kampus Merdeka (MBKM) adalah suatu program yang memiliki manfaat positif bagi mahasiswa dari seluruh perguruan tinggi negri maupun swasta.</p>
                    <p>Dengan mengikuti MBKM ini, mahasiswa bisa melatih diri sendiri untuk memiliki kompetensi, kejujuran, maupun tanggung jawab yang berguna untuk bekal kelulusan mencari pekerjaan. Program yang ditawarkan pemerintah dengan antusias yang tinggi dari mahasiswa adalah magang.</p>
                    <p>Magang ini disediakan dengan berbagai pilihan sesuai dengan kebutuhan mahasiswa. Dengan artian pemerintah semakin memerdekakan para mahasiswa bebas memilih tempat magang yang diinginkan, bisa memilih posisi atau jabatan sesuai jurusan dan bisa juga memilih lokasi dekat rumah, luar kota bahkan luar pulau. Selain program MBKM magang, mahasiswa juga dapat mengambil mata kuliah dari lintas prodi.</p>
                    <P>Pengambilan mata kuliah dilintas prodi semenjak resminya MBKM dengan nama program Studi Independen mampu membuat ketertarikan mahasiswa yang haus akan ilmu. Tentu saja kesempatan ini tidak disia-siakan, karena dengan adanya mata kuliah diluar prodi ini dapat menambah wawasan, kreatifitas, bahkan teman baru lintas prodi.</P>
                    <P>Bukan hanya lintas prodi didalam kampus saja (internal), program yang disediakan dapat digunakan untuk eksternal antar kampus. Mahasiswa bisa mengambil mata kuliah di kampus lain sesuai dengan jurusannya maupun kampus lain bisa memasukan mahasiswanya kedalam kampus yang dihuni mahasiswa tersebut.</P>
                    <P>Keuntungan program MBKM lainnya bagi pihak kampus adalah dapat digunakan untuk meningkatkan mutu pembelajaran dari kampus tersebut, sehingga kampus tersebut dapat bersaing juga dengan kampus lainnya dalam menciptakan mahasiswa-mahasiswi yang berpengetahuan luas dan siap terjun dalam dunia kerja.</P>
                    <p>Manfaat ini juga paling besar dirasakan oleh mahasiwa-mahasiswi dalam pembelajarannya dikarenakan diadakannya beberapa seminar atau sharing session diluar jam kuliah.</p>
                    <p>Sharing session ini merupakan ajang dimana kita dapat menambah ilmu baru atau memperdalam materi yang sudah kita pelajari sebelumnya, sehingga kita lebih paham dan menguasai materi tersebut.</p>
                    <p>Program ini juga bermanfaat dalam memperluas relasi antar kampus dalam naungan pemerintah, dalam artian kita dapat menambah teman dari kampus lain pada saat magang dan kegiatan kampus semacamnya.</p>
                </div>

                <div id="tab6" class="tab-content">
                    <h2>Apa fungsi dari Program MBKM ?</h2>
                    <p>Dengan mengikuti MBKM ini, mahasiswa bisa melatih diri sendiri untuk memiliki kompetensi, kejujuran, maupun tanggung jawab yang berguna untuk bekal kelulusan mencari pekerjaan. Program yang ditawarkan pemerintah dengan antusias yang tinggi dari mahasiswa adalah magang.</p>
                </div>

                <div id="tab7" class="tab-content">
                    <h2>Berikut ini, program Merdeka Belajar - Kampus Merdeka (MBKM) yang ditawarkan :</h2>
                    <div class="card-container">
                        <div class="card">
                            <img src="<?php echo base_url('assets/img/Kampus Mengajar.svg'); ?>" alt="Kampus Mengajar">
                            <h3 class="card-title">Kampus Mengajar</h3>
                            <p class="card-description">Program Kampus Mengajar membuka ruang bagi mahasiswa untuk bisa
                                mengaplikasikan keahlian serta ilmu pengetahuan mereka dalam membantu siswa di satuan pendidikan dasar.
                            </p>
                        </div>
                        <div class="card">
                            <img src="<?php echo base_url('assets/img/Wirausaha Merdeka.svg'); ?>" alt="Wirausaha">
                            <h3 class="card-title">Wirausaha Merdeka</h3>
                            <p class="card-description">Wirausaha Merdeka merupakan salah satu upaya dari Kemendikbudristek untuk
                                mendukung penuh terciptanya wirausaha mahasiswa di Indonesia.</p>
                        </div>
                        <div class="card">
                            <img src="<?php echo base_url('assets/img/Magang.svg'); ?>" alt="Magang">
                            <h3 class="card-title">Magang</h3>
                            <p class="card-description">Magang adalah bagian dari program kampus merdeka yang bertujuan untuk
                                memberikan kesempatan kepada mahasiswa belajar dan mengembangkan diri melalui aktivitas di luar kelas
                                perkuliahan. </p>
                        </div>
                        <div class="card">
                            <img src="<?php echo base_url('assets/img/Magang.svg'); ?>" alt="Magang">
                            <h3 class="card-title">Studi Independen</h3>
                            <p class="card-description">Studi Independen Bersertifikat adalah bagian dari program Kampus Merdeka yang
                                bertujuan untuk memberikan kesempatan kepada mahasiswa untuk belajar dan mengembangkan diri melalui
                                aktivitas di luar kelas perkuliahan, namun tetap diakui sebagai bagian dari perkuliahan. </p>
                        </div>
                        <div class="card">
                            <img src="<?php echo base_url('assets/img/Pertukaran Mahasiswa.svg'); ?>" alt="PM">
                            <h3 class="card-title">Pertukaran Mahasiswa</h3>
                            <p class="card-description">Program Pertukaran Mahasiswa Merdeka tahun 2023 (PMM 3) merupakan sebuah
                                program mobilitas mahasiswa selama satu semester untuk mendapatkan pengalaman belajar di perguruan
                                tinggi di Indonesia sekaligus memperkuat persatuan dalam keberagaman.</p>
                        </div>
                    </div>
                </div>

                <div id="tab8" class="tab-content">
                    <h2>Berikut cara mendaftar akun Kampus Merdeka (MBKM):</h2>
                    <ol class="sejajar">
                        <li>Kunjungi laman Kampus Merdeka di kampusmerdeka.kemdikbud.go.id.</li>
                        <li>Buat Akun kampus merdeka</li>
                    </ol>
                </div>
                <div id="tab9" class="tab-content">
                    <h2>Konversi Nilai</h2>
                    <p>Konversi Nilai adalah penyesuaian mata kuliah yang terdapal dalam transkrip nilai asal mahasiswa terhadap mata kuliah yang terdapat pada program studi yang dituju.</p>
                </div>
                <div id="tab10" class="tab-content">
                    <h2>Video Referensi MBKM</h2>
                    <p>Berikut ini, beberapa video tentang Medeka Belajar - Kampus Merdeka (MBKM)</p>
                    <p>Sumber video : <a href="https://www.youtube.com/@kampus.merdeka">kampus merdeka</a></p>

                    <!-- Video YouTube Embed 1 -->
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/rwdg0XQECfc?si=0TSjw7s0Av5TwO7e" frameborder="0" allowfullscreen></iframe>

                    <!-- Video YouTube Embed 2 -->
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/w9ZZCPAGAyk?si=38uy0e2gXT0MomyG" frameborder="0" allowfullscreen></iframe>

                    <!-- Video YouTube Embed 3 -->
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/xuEroFf4CsE?si=slX_GWtu2KKKjfw7" frameborder="0" allowfullscreen></iframe>

                    <!-- Video YouTube Embed 4 -->
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/0pn2pxsTzgI?si=eWPKprg404Gb6Fak" frameborder="0" allowfullscreen></iframe>

                </div>
            </div>
        </div>


        <script src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tabButtons = document.querySelectorAll('.tab-btn');
                const tabContents = document.querySelectorAll('.tab-content');

                tabButtons.forEach(function(button) {
                    button.addEventListener('click', function() {

                        tabButtons.forEach(function(btn) {
                            btn.classList.remove('active');
                        });
                        tabContents.forEach(function(content) {
                            content.classList.remove('active');
                        });

                        const tabId = this.getAttribute('data-tab');
                        const tabContent = document.getElementById(tabId);

                        this.classList.add('active');
                        tabContent.classList.add('active');
                    });
                });
            });
        </script>
</body>

</html>