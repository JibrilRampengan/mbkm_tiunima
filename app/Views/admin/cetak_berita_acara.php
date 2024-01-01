<!DOCTYPE html>
<html>

<head>
    <title>Berita Acara</title>
    <link href="<?php echo base_url('assets/img/informatika.svg'); ?>" rel="shortcut icon">
    <style type="text/css">
        body {
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            padding: 2cm;
            font-family: Arial, sans-serif;
            font-size: 12pt;
        }

        table {
            border-collapse: collapse;
        }

        .center {
            text-align: center;
        }

        .signature {
            text-align: center;
            font-weight: bold;
        }

        .signature-right {
            text-align: center;
            width: 35%;
            float: right;
        }

        .signature-right .title {
            font-weight: bold;
        }

        .signature-right .name {
            text-decoration: underline;
        }

        .name {
            text-decoration: underline;
        }

        .line {
            border-top: 1px solid black;
        }

        .line2 {
            margin-top: -14%;
            border-top: 1px solid black;
        }

        #logo {
            margin-bottom: 5px;
            margin-left: 5px;
        }

        @media print {
            .page-break-before {
                page-break-before: always;
            }
        }

        .page-break-before.second {
            width: 21cm;
            height: 9.7cm;
            padding: 2cm;
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <table class="page-break-before" width="100%" border="0">
        <tr>
            <td width="20%">
                <img id="logo" src="<?php echo base_url('assets/img/unima.png'); ?>" width="150" height="135">
            </td>
            <td width="80%">
                <div class="center">
                    <font size="4">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</font><br>
                    <font size="4">UNIVERSITAS NEGERI MANADO</font><br>
                    <font size="4">FAKULTAS TEKNIK</font><br>
                    <font size="5"><b>PROGRAM STUDI S1 TEKNIK INFORMATIKA</b></font><br>
                    <font size="2">Alamat : Kampus UNIMA Tondano 95618, Telp. (0431) 7233580</font><br>
                    <font size="2">Website : <a href="http://ti.unima.ac.id">ti.unima.ac.id</a>, Email : <a href="mailto:teknikinformatika.unima.ac.id">teknikinformatika.unima.ac.id</a></font>
                </div>
            </td>
        </tr>
    </table>
    <div class="line"></div>
    <br>
    <table width="100%" border="0">
        <tr>
            <td colspan="2" class="center">
                <font size="4"><b>BERITA ACARA KONVERSI NILAI DAN SKS PROGRAM <br> MERDEKA BELAJAR KAMPUS MERDEKA
                        </br></b></font>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%" border="0">
        <tr>
            <td>
                <font size="2">Berdasarkan Program Studi Independen Merdeka Belajar Kampus Merdeka Prodi Teknik
                    Informatika FT UNIMA tahun 2022, maka pada hari <span id="tanggal-sekarang"></span>. Program
                    Studi Teknik Informatika menyatakan :</font>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%" border="0">
        <tr>
            <td width="20%">NIM</td>
            <td width="80%">: <?php echo $nimValue; ?></td>
        </tr>
        <tr>
            <td>Nama Lengkap</td>
            <td>: <?php echo $namaLengkapValue; ?></td>
        </tr>
        <tr>
            <td>Semester</td>
            <td>: <?php echo $semesterValue; ?></td>
        </tr>
        <tr>
            <td>Dosen Pembimbing</td>
            <td>: <?php echo $dosenPembimbingValue; ?></td>
        </tr>
    </table>
    <br>
    <table width="100%" border="0">
        <tr>
            <td>
                <font size="2">Telah mengikuti Program <?php echo $programMbkmValue; ?> Merdeka Belajar Kampus Merdeka
                    dengan konversi nilai mata
                    kuliah (terlampir).
                </font>
            </td>
        </tr>
    </table>
    <table width="100%" border="0">
        <tr>
            <td>
                <font size="2">Apabila ada Kekeliruan dalam Berita Acara ini, akan diperbaiki sebagaimana mestinya.
                </font>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table width="100%" border="0">
        <tr>
            <td class="center" width="50%">
                <div class="signature">Dosen Pembimbing,</div>
                <br><br><br><br><br>
                <div class="name"><?php echo $dosenPembimbingValue; ?></div>
                NIP. <?php echo $nipDosenPembimbingValue; ?>
            </td>
            <td class="center" width="50%">
                <div class="signature">Mahasiswa,</div>
                <br><br><br><br><br>
                <div class="name"> <?php echo $namaLengkapValue; ?></div>
                NIM. <?php echo $nimValue; ?>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%" border="0">
        <tr>
            <td class="center">
                <div>
                    <p><b>Mengetahui,</b></p>
                </div>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%" border="0">
        <tr>
            <td class="center" width="50%">
                <div class="signature">Pembantu Dekan I,</div>
                <br><br><br><br><br>
                <div class="name">Dr. Djubir R. E. Kembuan, M.Pd</div>
                NIP. 19620729 198803 1 001
            </td>
            <td class="center" width="50%">
                <div class="signature">Ketua Program Studi,</div>
                <br><br><br><br><br>
                <div class="name">Vivi Peggie Rantung, ST, MISD</div>
                NIP. 19830416 200812 2 2 002
            </td>
        </tr>
    </table>

    <table class="page-break-before second" width="100%" border="0">
        <tr>
            <td width="20%">
                <img id="logo" src="<?php echo base_url('assets/img/unima.png'); ?>" width="150" height="135">
            </td>
            <td width="80%">
                <div class="center">
                    <font size="4">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</font><br>
                    <font size="4">UNIVERSITAS NEGERI MANADO</font><br>
                    <font size="4">FAKULTAS TEKNIK</font><br>
                    <font size="5"><b>PROGRAM STUDI S1 TEKNIK INFORMATIKA</b></font><br>
                    <font size="2">Alamat : Kampus UNIMA Tondano 95618, Telp. (0431) 7233580</font><br>
                    <font size="2">Website : <a href="http://ti.unima.ac.id">ti.unima.ac.id</a>, Email : <a href="mailto:teknikinformatika.unima.ac.id">teknikinformatika.unima.ac.id</a></font>
                </div>
            </td>
        </tr>
    </table>
    <div class="line2"></div>
    <br>
    <table width="100%" border="0">
        <tr>
            <td colspan="2" class="center">
                <font size="4"><b>PERUBAHAN NILAI KONVERSI <?php echo strtoupper($programMbkmValue); ?> </b></font>
            </td>
        </tr>
    </table>
    <br>
    <table>
        <tr class="text2">
            <td>NIM</td>
            <td width="550">: <?php echo $nimValue; ?></td>
        </tr>
        <tr>
            <td>NAMA LENGKAP</td>
            <td width="525">: <?php echo $semesterValue; ?></td>
        </tr>
        <tr>
            <td>FAKULTAS / PROGRAM STUDI</td>
            <td width="525">: <?php echo $programStudiValue; ?></td>
        </tr>
        <tr>
            <td>LOKASI KKN MBKM</td>
            <td width="525">: <?php echo $lokasiMbkmValue; ?></td>
        </tr>
        <tr>
            <td>DOSEN PEMB. LAPANGAN</td>
            <td width="525">: <?php echo $dosenPembimbingValue; ?></td>
        </tr>
    </table>
    <br>
    <table width="790" style="border-collapse: collapse; border: 1px solid #000;">
        <tr>
            <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2;">No</th>
            <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2;">Kegiatan Mahasiswa</th>
            <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2;">Kode MK</th>
            <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2;">Rekognisi MK</th>
            <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2;">SKS</th>
            <th style="border: 1px solid #000; padding: 8px; background-color: #f2f2f2;">Nilai</th>
        </tr>

        <?php if (!empty($konversiNilaiData)) : ?>
            <?php $no = 1; ?>
            <?php foreach ($konversiNilaiData as $row) : ?>
                <tr>
                    <td style="border: 1px solid #000; padding: 8px;"><?php echo $no++; ?></td>
                    <td style="border: 1px solid #000; padding: 8px;"><?php echo $row['kegiatan']; ?></td>
                    <td style="border: 1px solid #000; padding: 8px;"><?php echo $row['kode_matakuliah']; ?></td>
                    <td style="border: 1px solid #000; padding: 8px;"><?php echo $row['rekognisi_mk']; ?></td>
                    <td style="border: 1px solid #000; padding: 8px;"><?php echo $row['sks']; ?></td>
                    <td style="border: 1px solid #000; padding: 8px;"><?php echo $row['nilai']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6" style="border: 1px solid #000; padding: 8px;">Tidak ada data yang tersedia.</td>
            </tr>
        <?php endif; ?>
    </table>

    <br>
    <div class="signature-right">
        <div class="title">Ketua Program Studi,</div>
        <br><br><br><br>
        <div class="name">Vivi Peggie Rantung, ST, MISD</div>
        NIP. 19830416 200812 2 2 002
    </div>

    <script>
        function getCurrentDate() {
            const today = new Date();
            const options = {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            return today.toLocaleDateString('id-ID', options);
        }

        function updateDate() {
            const currentDate = getCurrentDate();
            document.getElementById('tanggal-sekarang').textContent = currentDate;
        }

        window.addEventListener('DOMContentLoaded', updateDate);
    </script>
</body>

</html>