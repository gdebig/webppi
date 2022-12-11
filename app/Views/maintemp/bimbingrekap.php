<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <a href="<?= base_url(); ?>/bimbingfair/docs/<?= $user_id; ?>">Kembali ke daftar dokumen FAIR</a>
        </div>
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">
                <h4 style="text-align: center;">FORMULIR PERMOHONAN UJI SERTIFIKASI INSINYUR PROFESIONAL</h4>
                <br /><br />
                <table>
                    <tr>
                        <td width="25%">Nama Peserta</td>
                        <td width="5%" style="text-align: center;">:</td>
                        <td width="70%"><?= $FullName; ?></td>
                    </tr>
                    <tr>
                        <td width="25%">Badan Kejuruan</td>
                        <td width="5%" style="text-align: center;">:</td>
                        <td width="70%">
                            <?php
                            switch ($Vocational) {
                                case 'Ars':
                                    echo "Arsitektur";
                                    break;
                                case 'Ele':
                                    echo "Teknik Elektro";
                                    break;
                                case 'Wil':
                                    echo "Teknik Kewilayahan dan Perkotaan";
                                    break;
                                case 'Ind':
                                    echo "Teknik Industri";
                                    break;
                                case 'Kim':
                                    echo "Teknik Kimia";
                                    break;
                                case 'Mes':
                                    echo "Teknik Mesin";
                                    break;
                                case 'Lin':
                                    echo "Teknik Lingkungan";
                                    break;
                                case 'Sip':
                                    echo "Teknik Sipil";
                                    break;
                                case 'Mat':
                                    echo "Teknik Material";
                                    break;
                                case 'Met':
                                    echo "Teknik Metalurgi";
                                    break;
                                case 'Inf':
                                    echo "Teknik Informatika";
                                    break;
                                case 'Kap':
                                    echo "Teknik Perkapalan";
                                    break;
                                case 'Tra':
                                    echo "Transportasi";
                                    break;
                                case "Kom":
                                    echo "Teknik Komputer";
                                    break;
                                case "Bio":
                                    echo "Teknik Biomedik";
                                    break;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="25%">Rekapitulasi Nilai Kegiatan</td>
                        <td width="5%" style="text-align: center;">:</td>
                        <td width="70%"></td>
                    </tr>
                </table>
                <br /><br />
                <table width="100%" style="margin: 3px">
                    <tr style="border-bottom: 1pt solid black">
                        <td width="20%">Unit Kompetensi</td>
                        <td width="20%" style="background-color: #D6EEEE">Nilai yang Diperoleh</td>
                        <td width="20%">Batas Nilai Minimum (IPP)</td>
                        <td width="20%">Batas Nilai Minimum (IPM)</td>
                        <td width="20%">Batas Nilai Minimum (IPU)</td>
                    </tr>
                    <tr style="border-bottom: 1pt solid black">
                        <td width="20%">Wajib 1</td>
                        <td width="20%" style="background-color: #D6EEEE"><?= $nilai_w1; ?></td>
                        <td width="20%">60</td>
                        <td width="20%">300</td>
                        <td width="20%">600</td>
                    </tr>
                    <tr style="border-bottom: 1pt solid black">
                        <td width="20%">Wajib 2</td>
                        <td width="20%" style="background-color: #D6EEEE"><?= $nilai_w2; ?></td>
                        <td width="20%">180</td>
                        <td width="20%">900</td>
                        <td width="20%">1800</td>
                    </tr>
                    <tr style="border-bottom: 1pt solid black">
                        <td width="20%">Wajib 3</td>
                        <td width="20%" style="background-color: #D6EEEE"><?= $nilai_w3; ?></td>
                        <td width="20%">120</td>
                        <td width="20%">600</td>
                        <td width="20%">1200</td>
                    </tr>
                    <tr style="border-bottom: 1pt solid black">
                        <td width="20%">Wajib 4</td>
                        <td width="20%" style="background-color: #D6EEEE"><?= $nilai_w4; ?></td>
                        <td width="20%">60</td>
                        <td width="20%">300</td>
                        <td width="20%">600</td>
                    </tr>
                    <tr style="border-bottom: 1pt solid black">
                        <td width="20%">Pilihan</td>
                        <td width="20%" style="background-color: #D6EEEE"><?= $nilai_pil; ?></td>
                        <td width="20%">180</td>
                        <td width="20%">900</td>
                        <td width="20%">1800</td>
                    </tr>
                    <tr style="border-bottom: 1pt solid black">
                        <td width="20%">Jumlah</td>
                        <td width="20%" style="background-color: #D6EEEE"><?= $total; ?></td>
                        <td width="20%">600</td>
                        <td width="20%">3000</td>
                        <td width="20%">6000</td>
                    </tr>
                </table>
                <br /><br />
                <p>Nilai skor hasil dari perhitungan SIMPoNI (disebut Pre Score) hanyalah merupakan acuan indikatif
                    berdasarkan Unit Kompetensi yang diklaim Aplikan. Adapun nilai akhir skor ditentukan berdasarkan
                    penilaian Asesor Majelis Uji Kompetensi dari BK masing-masing. Aplikan yang oleh Asesor
                    terkualifikasi sebagai calon IPM atau IPU akan diundang untuk wawancara dalam Sidang MUK.</p>
                <br />
                <p>
                    <b>Estimasi :</b>
                </p>
                <p><?= $estimasi; ?></p>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>