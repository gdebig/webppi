<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">
                <?php if (isset($data_kerja) && ($data_kerja != "kosong")) { ?>
                    <br />
                    <h3>III. KUALIFIKASI PROFESIONAL (W2,W3,W4,P6,P7,P8,P9,P10,P11)</h3>
                    <br />
                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Check</th>
                                <th>Periode</th>
                                <th>Nama Instansi/Perusahaan</th>
                                <th>Jabatan/tugas</th>
                                <th>Nama Aktifitas/Kegiatan/Proyek</th>
                                <th>Pemberi Tugas</th>
                                <th>Lokasi</th>
                                <th>Durasi</th>
                                <th>Posisi Tugas, Jabatan</th>
                                <th>Nilai Proyek</th>
                                <th>Nilai Tanggung Jawab</th>
                                <th>SDM yang terlibat</th>
                                <th>Tingkat Kesulitan</th>
                                <th>Skala Proyek</th>
                                <th>Uraian Singkat Tugas dan Tanggung Jawab Prof sesuai NSPK</th>
                                <th>Bukti kualifikasi profesional</th>
                                <th>Klaim Kompetensi</th>
                                <th>Nilai P</th>
                                <th>Nilai Q</th>
                                <th>Nilai R</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_kerja as $kerja) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><input type="checkbox" name="kerja_id[]" value="<?= $kerja['Num']; ?>" /></td>
                                    <td><?php
                                        if (!empty($kerja['EndDate']) && ($kerja['EndDate'] != '0000-00-00')) {
                                            echo format_indo($kerja['StartDate']) . " hingga " . format_indo($kerja['EndDate']);
                                        } else {
                                            echo format_indo($kerja['StartDate']) . " hingga sekarang.";
                                        }
                                        ?></td>
                                    <td><?= $kerja['NameInstance']; ?></td>
                                    <td><?= $kerja['Position']; ?></td>
                                    <td><?= $kerja['Name']; ?></td>
                                    <td><?= $kerja['Giver']; ?></td>
                                    <td><?= $kerja['LocCity'] . ', ' . $kerja['LocProv'] . ', ' . $kerja['LocCountry']; ?></td>
                                    <td><?php
                                        switch ($kerja['Duration']) {
                                            case 'smp3':
                                                echo "1 - 3 tahun";
                                                break;
                                            case 'smp7':
                                                echo "4 - 7 tahun";
                                                break;
                                            case 'smpe10':
                                                echo "8 - 10 tahun";
                                                break;
                                            case 'lbh10':
                                                echo "> dari 10 tahun";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php
                                        switch ($kerja['Jabatan']) {
                                            case 'anggota':
                                                echo "Anggota / Staff / Dosen";
                                                break;
                                            case 'supervisor':
                                                echo "Supervisor / Site Engineer / Site Manager / KaLab / Sekretaris Jurusan / Ketua Jurusan / PD";
                                                break;
                                            case 'direktur':
                                                echo "Direktur / Ketua Tim / Dekan / PR / Rektor";
                                                break;
                                            case 'pengarah':
                                                echo "Pengarah / Adviser / Narasumber Ahli";
                                                break;
                                        }
                                        ?></td>
                                    <td><?= $kerja['ProjValue']; ?></td>
                                    <td><?= $kerja['RspnValue']; ?></td>
                                    <td><?php
                                        switch ($kerja['Hresource']) {
                                            case 'dik':
                                                echo "Sedikit";
                                                break;
                                            case 'sed':
                                                echo "Sedang";
                                                break;
                                            case 'bny':
                                                echo "Banyak";
                                                break;
                                            case 'sbny':
                                                echo "Sangat Banyak";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php
                                        switch ($kerja['Diff']) {
                                            case 'ren':
                                                echo "Rendah";
                                                break;
                                            case 'sed':
                                                echo "Sedang";
                                                break;
                                            case 'tin':
                                                echo "Tinggi";
                                                break;
                                            case 'stin':
                                                echo "Sangat Tinggi";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php
                                        switch ($kerja['Scale']) {
                                            case 'ren':
                                                echo "Rendah";
                                                break;
                                            case 'sed':
                                                echo "Sedang";
                                                break;
                                            case 'tin':
                                                echo "Tinggi";
                                                break;
                                            case 'stin':
                                                echo "Sangat Tinggi";
                                                break;
                                        }
                                        ?></td>
                                    <td><?= $kerja['Desc']; ?></td>
                                    <td><?php
                                        if (!empty($kerja['File'])) {
                                            echo "<a href='" . base_url('uploads/docs/' . $kerja['File']) . "' target='_blank'>" . "Lihat Bukti" . "</a>";
                                        } else {
                                            echo "";
                                        }
                                        ?></td>
                                    <td><?= $kerja['kompetensi']; ?></td>
                                    <td>
                                        <?php
                                        if ($kerja['Duration'] == 'smp3') {
                                            $durscore = 1;
                                        } elseif ($kerja['Duration'] == 'smp7') {
                                            $durscore = 2;
                                        } elseif ($kerja['Duration'] == 'smp10') {
                                            $durscore = 3;
                                        } elseif ($kerja['Duration'] == 'lbih10') {
                                            $durscore = 4;
                                        } else {
                                            $durscore = 4;
                                        }
                                        ?>
                                        <select name="nilai_p" id="nilai_p">
                                            <option value="4" <?= $durscore == 4 ? 'selected' : ''; ?>>4</option>
                                            <option value="3" <?= $durscore == 3 ? 'selected' : ''; ?>>3</option>
                                            <option value="2" <?= $durscore == 2 ? 'selected' : ''; ?>>2</option>
                                            <option value="1" <?= $durscore == 1 ? 'selected' : ''; ?>>1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <?php
                                        if ($kerja['Jabatan'] == 'anggota') {
                                            $jabscore = 1;
                                        } elseif ($kerja['Jabatan'] == 'supervisor') {
                                            $jabscore = 2;
                                        } elseif ($kerja['Jabatan'] == 'direktur') {
                                            $jabscore = 3;
                                        } elseif ($kerja['Jabatan'] == 'pengarah') {
                                            $jabscore = 4;
                                        }
                                        ?>
                                        <select name="nilai_q" id="nilai_q">
                                            <option value="4" <?= $jabscore == 4 ? 'selected' : ''; ?>>4</option>
                                            <option value="3" <?= $jabscore == 4 ? 'selected' : ''; ?>>3</option>
                                            <option value="2" <?= $jabscore == 4 ? 'selected' : ''; ?>>2</option>
                                            <option value="1" <?= $jabscore == 4 ? 'selected' : ''; ?>>1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nilai_r" id="nilai_r">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php
                            endforeach
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
                <br />

                <?php if (isset($data_latih) && ($data_latih != "kosong")) {
                ?>
                    <br />
                    <h3>I.5. Pendidikan/Pelatihan Teknik/Manajemen (W2,W4,P10)</h3>
                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Check</th>
                                <th>Nama Pendidikan/Pelatihan</th>
                                <th>Penyelenggara</th>
                                <th>Lokasi</th>
                                <th>Negara</th>
                                <th>Bulan/Tahun</th>
                                <th>Tingkat Materi</th>
                                <th>Jumlah Jam</th>
                                <th>Uraian Singkat Materi Pendidikan/Pelatihan, Tingkat Pendidikan/Pelatihan</th>
                                <th>Bukti Pendidikan/Pelatihan</th>
                                <th>Kompetensi</th>
                                <th>Nilai P</th>
                                <th>Nilai Q</th>
                                <th>Nilai R</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_latih as $latih) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><input type="checkbox" name="latih_id[]" value="<?= $latih['Num']; ?>" /></td>
                                    <td><?= $latih['Name']; ?></td>
                                    <td><?= $latih['Organizer']; ?></td>
                                    <td><?= $latih['Kota']; ?></td>
                                    <td><?= $latih['Country']; ?></td>
                                    <td><?= $latih['StartMonth'] . '/' . $latih['StartYear']; ?></td>
                                    <td><?php
                                        switch ($latih['Level']) {
                                            case 'Dasar':
                                                echo "Tingkat Dasar (Fundamental)";
                                                break;
                                            case 'Lanjut':
                                                echo "Tingkat Lanjut (Advanced)";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php
                                        switch ($latih['Length']) {
                                            case 'sd36':
                                                echo "Lama pendidikan s/d 36 Jam";
                                                break;
                                            case 'smp100':
                                                echo "Lama pendidikan 36 - 100 Jam";
                                                break;
                                            case 'smp240':
                                                echo "Lama pendidikan 100 - 240 Jam";
                                                break;
                                            case 'lbih240':
                                                echo "Lebih dari 240 Jam
                                        
                                        ";
                                                break;
                                        }
                                        ?></td>
                                    <td><?= $latih['Description']; ?></td>
                                    <td><?php
                                        if (!empty($latih['File'])) {
                                            echo "<a href='" . base_url('uploads/docs/' . $latih['File']) . "' target='_blank'>" . "Lihat Bukti" . "</a>";
                                        } else {
                                            echo "";
                                        }
                                        ?></td>
                                    <td><?= $latih['kompetensi']; ?></td>
                                    <td>
                                        <?php
                                        if ($latih['Length'] == 'sd36') {
                                            $latihscore = 1;
                                        } elseif ($latih['Length'] == 'smp100') {
                                            $latihscore = 2;
                                        } elseif ($latih['Length'] == 'smp240') {
                                            $latihscore = 3;
                                        } elseif ($latih['Length'] == 'lbh240') {
                                            $latihscore = 4;
                                        }
                                        ?>
                                        <select name="nilai_p" id="nilai_p">
                                            <option value="4" <?= $latihscore == 4 ? 'selected' : ''; ?>>4</option>
                                            <option value="3" <?= $latihscore == 3 ? 'selected' : ''; ?>>3</option>
                                            <option value="2" <?= $latihscore == 2 ? 'selected' : ''; ?>>2</option>
                                            <option value="1" <?= $latihscore == 1 ? 'selected' : ''; ?>>1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nilai_q" id="nilai_q">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2" selected>2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <?php
                                        if ($latih['Level'] == 'Dasar') {
                                            $levelscore = 2;
                                        } elseif ($latih['Level'] == 'Lanjut') {
                                            $levelscore = 3;
                                        }
                                        ?>
                                        <select name="nilai_r" id="nilai_r">
                                            <option value="4" <?= $levelscore == 4 ? 'selected' : ''; ?>>4</option>
                                            <option value="3" <?= $levelscore == 3 ? 'selected' : ''; ?>>3</option>
                                            <option value="2" <?= $levelscore == 2 ? 'selected' : ''; ?>>2</option>
                                            <option value="1" <?= $levelscore == 1 ? 'selected' : ''; ?>>1</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php
                            endforeach
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
                <?php if (isset($data_latih1) && ($data_latih1 != "kosong")) {
                ?>
                    <br />
                    <h3>I.6. Sertifikat Kompetensi dan Bidang Lainnya (yang Relevan) Yang Diikuti (#) (W1,W4)</h3>
                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Check</th>
                                <th>Nama Sertifikat</th>
                                <th>Penyelenggara</th>
                                <th>Lokasi</th>
                                <th>Negara</th>
                                <th>Bulan/Tahun</th>
                                <th>Tingkat Materi</th>
                                <th>Jumlah Jam</th>
                                <th>Uraian Singkat Materi Pendidikan/Pelatihan, Tingkat Pendidikan/Pelatihan, Sertifikat
                                </th>
                                <th>Bukti Sertifikat</th>
                                <th>Klaim Kompetensi</th>
                                <th>Nilai P</th>
                                <th>Nilai Q</th>
                                <th>Nilai R</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_latih1 as $latih) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><input type="checkbox" name="latih_id[]" value="<?= $latih['Num']; ?>" /></td>
                                    <td><?= $latih['Name']; ?></td>
                                    <td><?= $latih['Organizer']; ?></td>
                                    <td><?= $latih['Kota']; ?></td>
                                    <td><?= $latih['Country']; ?></td>
                                    <td><?= $latih['StartMonth'] . '/' . $latih['StartYear']; ?></td>
                                    <td><?php
                                        switch ($latih['Level']) {
                                            case 'Dasar':
                                                echo "Tingkat Dasar (Fundamental)";
                                                break;
                                            case 'Lanjut':
                                                echo "Tingkat Lanjut (Advanced)";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php
                                        switch ($latih['Length']) {
                                            case 'sd36':
                                                echo "Lama pendidikan s/d 36 Jam";
                                                break;
                                            case 'smp100':
                                                echo "Lama pendidikan 36 - 100 Jam";
                                                break;
                                            case 'smp240':
                                                echo "Lama pendidikan 100 - 240 Jam";
                                                break;
                                            case 'lbih240':
                                                echo "Lebih dari 240 Jam
                                        
                                        ";
                                                break;
                                        }
                                        ?></td>
                                    <td><?= $latih['Description']; ?></td>
                                    <td><?php
                                        if (!empty($latih['File'])) {
                                            echo "<a href='" . base_url('uploads/docs/' . $latih['File']) . "' target='_blank'>" . "Lihat Bukti" . "</a>";
                                        } else {
                                            echo "";
                                        }
                                        ?></td>
                                    <td><?= $latih['kompetensi']; ?></td>
                                    <td>
                                        <?php
                                        if ($latih['Length'] == 'sd36') {
                                            $lengthscore = 1;
                                        } elseif ($latih['Length'] == 'smp100') {
                                            $lengthscore = 2;
                                        } elseif ($latih['Length'] == 'smp240') {
                                            $lengthscore = 3;
                                        } elseif ($latih['Length'] == 'lbih240') {
                                            $lengthscore = 4;
                                        }
                                        ?>
                                        <select name="nilai_p" id="nilai_p">
                                            <option value="4" <?= $lengthscore == 4 ? 'selected' : ''; ?>>4</option>
                                            <option value="3" <?= $lengthscore == 3 ? 'selected' : ''; ?>>3</option>
                                            <option value="2" <?= $lengthscore == 2 ? 'selected' : ''; ?>>2</option>
                                            <option value="1" <?= $lengthscore == 1 ? 'selected' : ''; ?>>1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nilai_q" id="nilai_q">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2" selected>2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <?php
                                        if ($latih['Level'] == 'Dasar') {
                                            $levscore = 2;
                                        } elseif ($latih['Level'] == 'Lanjut') {
                                            $levscore = 3;
                                        }
                                        ?>
                                        <select name="nilai_r" id="nilai_r">
                                            <option value="4" <?= $levscore == 4 ? 'selected' : ''; ?>>4</option>
                                            <option value="3" <?= $levscore == 3 ? 'selected' : ''; ?>>3</option>
                                            <option value="2" <?= $levscore == 2 ? 'selected' : ''; ?>>2</option>
                                            <option value="1" <?= $levscore == 1 ? 'selected' : ''; ?>>1</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php
                            endforeach
                            ?>
                        </tbody>
                    </table>
                <?php } ?>

                <?php if (isset($data_kerja) && ($data_kerja != "kosong")) {
                ?>
                    <h3>IV. Pengalaman Mengajar Pelajaran Keinsinyuran dan/atau Manajemen dan/atau Pengalaman Mengembangkan Pendidikan/Pelatihan Keinsinyuran dan/atau Manajemen (W2,W3,W4,P5)</h3>
                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Check</th>
                                <th>Perioda</th>
                                <th>Nama Perguruan Tinggi/Lembaga</th>
                                <th>Nama mata ajaran</th>
                                <th>Lokasi</th>
                                <th>Perioda</th>
                                <th>Jabatan pada Perguruan Tinggi/Lembaga</th>
                                <th>Jumlah JAM atau S.K.S</th>
                                <th>Uraian Singkat yang Diajarkan/Dikembangkan</th>
                                <th>Bukti Pengalaman Mengajar</th>
                                <th>Klaim Kompetensi</th>
                                <th>Nilai P</th>
                                <th>Nilai Q</th>
                                <th>Nilai R</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_kerja as $kerja) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><input type="checkbox" name="ajar_id[]" value="<?= $kerja['Num']; ?>" /></td>
                                    <td><?= $kerja['StartPeriod'] . ' - ' . $kerja['EndPeriod']; ?></td>
                                    <td><?= $kerja['Institution']; ?></td>
                                    <td><?= $kerja['Name']; ?></td>
                                    <td><?= $kerja['LocCity'] . ', ' . $kerja['LocProv'] . ', ' . $kerja['LocCountry']; ?></td>
                                    <td><?php
                                        switch ($kerja['Period']) {
                                            case 'smp9':
                                                echo "1 - 9 tahun";
                                                break;
                                            case 'smp14':
                                                echo "10 - 14 tahun";
                                                break;
                                            case 'smpe19':
                                                echo "15 - 19 tahun";
                                                break;
                                            case 'lbih20':
                                                echo "> dari 20 tahun";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php
                                        switch ($kerja['Position']) {
                                            case 'Stf':
                                                echo "Staf Pengajar";
                                                break;
                                            case 'Pim':
                                                echo "Pimpinan";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php
                                        switch ($kerja['Skshour']) {
                                            case 'sks1':
                                                echo "1 SKS / 15 Jam";
                                                break;
                                            case 'sks2':
                                                echo "2 - 3 SKS / 30 - 45 Jam";
                                                break;
                                            case 'sks4':
                                                echo "4 SKS / 60 Jam";
                                                break;
                                        }
                                        ?></td>
                                    <td><?= $kerja['Desc']; ?></td>
                                    <td><?php
                                        if (!empty($kerja['File'])) {
                                            echo "<a href='" . base_url('uploads/docs/' . $kerja['File']) . "' target='_blank'>" . "Lihat Bukti" . "</a>";
                                        } else {
                                            echo "";
                                        }
                                        ?></td>
                                    <td><?= $kerja['kompetensi']; ?></td>
                                    <td>
                                        <select name="nilai_p" id="nilai_p">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nilai_q" id="nilai_q">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nilai_r" id="nilai_r">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php
                            endforeach
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
                <br />
                <?php if (isset($data_kartul) && ($data_kartul != "kosong")) {
                ?>
                    <h3>V.1. Karya Tulis di Bidang Keinsinyuran yang Dipublikasikan (W4)</h3>
                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Check</th>
                                <th>Bulan-Tahun</th>
                                <th>Judul Karya Tulis</th>
                                <th>Nama Media Publikasi</th>
                                <th>Lokasi</th>
                                <th>Media Publikasi Tingkat</th>
                                <th>Tingkat Kesulitan dan Manfaatnya</th>
                                <th>Uraian Singkat Materi yang Dipublikasikan</th>
                                <th>Bukti Karya Tulis</th>
                                <th>Klaim Kompetensi</th>
                                <th>Nilai P</th>
                                <th>Nilai Q</th>
                                <th>Nilai R</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_kartul as $kartul) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><input type="checkbox" name="kartul_id[]" value="<?= $kartul['Num']; ?>" /></td>
                                    <td><?= $kartul['Month'] . ' - ' . $kartul['Year']; ?></td>
                                    <td><?= $kartul['Name']; ?></td>
                                    <td><?= $kartul['Media']; ?></td>
                                    <td><?= $kartul['LocCity'] . ", " . $kartul['LocCountry'] ?></td>
                                    <td><?php
                                        switch ($kartul['Mediatype']) {
                                            case "Lok":
                                                echo "Dimuat di Media Lokal";
                                                break;
                                            case "Nas":
                                                echo "Dimuat di Media Nasional";
                                                break;
                                            case "Int":
                                                echo "Dimuat di Media Internasional";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php
                                        switch ($kartul['Diffbenefit']) {
                                            case "ren":
                                                echo "Rendah";
                                                break;
                                            case "sed":
                                                echo "Sedang";
                                                break;
                                            case "tin":
                                                echo "Tinggi";
                                                break;
                                            case "stin":
                                                echo "Sangat Tinggi";
                                                break;
                                        }
                                        ?></td>
                                    <td><?= $kartul['Desc']; ?></td>
                                    <td><a href="<?= base_url(); ?>/uploads/docs/<?= $kartul['File']; ?>" target="_blank">Lihat Bukti</a></td>
                                    <td><?= $kartul['kompetensi']; ?></td>
                                    <td>
                                        <select name="nilai_p" id="nilai_p">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nilai_q" id="nilai_q">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nilai_r" id="nilai_r">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php
                            endforeach
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
                <br /><?php if (isset($data_sem) && ($data_sem != "kosong")) {
                        ?>
                    <h3>V.2. Makalah/Tulisan Yang Disajikan Dalam Seminar/Lokakarya Keinsinyuran (W4)</h3>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Check</th>
                                <th>Bulan-Tahun</th>
                                <th>Judul Makalah/Tulisan</th>
                                <th>Nama Seminar/Lokakarya</th>
                                <th>Penyelenggara</th>
                                <th>Lokasi</th>
                                <th>Seminar/Lokakarya Tingkat</th>
                                <th>Tingkat Kesulitan dan Manfaat</th>
                                <th>Uraian Singkat Materi Makalah/Tulisan</th>
                                <th>Bukti Seminar</th>
                                <th>Klaim Kompetensi</th>
                                <th>Nilai P</th>
                                <th>Nilai Q</th>
                                <th>Nilai R</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_sem as $sem) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><input type="checkbox" name="sem_id[]" value="<?= $sem['Num']; ?>" /></td>
                                    <td><?= $sem['Month'] . '-' . $sem['Year']; ?></td>
                                    <td><?= $sem['PaperName']; ?></td>
                                    <td><?= $sem['Name']; ?></td>
                                    <td><?= $sem['Organizer']; ?></td>
                                    <td><?= $sem['LocCity'] . ", " . $sem['LocCountry'] ?></td>
                                    <td><?php
                                        switch ($sem['Level']) {
                                            case "Lok":
                                                echo "Pada Seminar Lokal";
                                                break;
                                            case "Nas":
                                                echo "Pada Seminar Nasional";
                                                break;
                                            case "Int":
                                                echo "Pada Seminar Internasional";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php
                                        switch ($sem['DiffBenefit']) {
                                            case "ren":
                                                echo "Rendah";
                                                break;
                                            case "sed":
                                                echo "Sedang";
                                                break;
                                            case "tin":
                                                echo "Tinggi";
                                                break;
                                            case "stin":
                                                echo "Sangat Tinggi";
                                                break;
                                        }
                                        ?></td>
                                    <td><?= $sem['Desc']; ?></td>
                                    <td><a href="<?= base_url(); ?>/uploads/docs/<?= $sem['File']; ?>" target="_blank">Lihat Bukti</a></td>
                                    <td><?= $sem['kompetensi']; ?></td>
                                    <td>
                                        <select name="nilai_p" id="nilai_p">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nilai_q" id="nilai_q">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nilai_r" id="nilai_r">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php
                            endforeach
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
                <br /><?php if (isset($data_bahasa) && ($data_bahasa != "kosong")) {
                        ?>
                    <h3>VI. Bahasa yang Dikuasai (W4)</h3>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Check</th>
                                <th>Nama Bahasa</th>
                                <th>Jenis Bahasa</th>
                                <th>Kemampuan Verbal Aktif/Pasif</th>
                                <th>Jenis Tulisan yang Mampu Disusun</th>
                                <th>Nilai TOEFL atau yang Sejenisnya</th>
                                <th>Bukti Dokumen</th>
                                <th>Kompetensi</th>
                                <th>Nilai P</th>
                                <th>Nilai Q</th>
                                <th>Nilai R</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_bahasa as $bahasa) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><input type="checkbox" name="bahasa_id[]" value="<?= $bahasa['Num']; ?>" /></td>
                                    <td><?= $bahasa['Name']; ?></td>
                                    <td><?php
                                        switch ($bahasa['LangType']) {
                                            case 'Da':
                                                echo "Bahasa Daerah";
                                                break;
                                            case 'Na':
                                                echo "Bahasa Nasional";
                                                break;
                                            case 'In':
                                                echo "Bahasa Asing / International";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php
                                        switch ($bahasa['VerbSkill']) {
                                            case 'Pasif':
                                                echo "Pasif, tertulis";
                                                break;
                                            case 'Aktif':
                                                echo "Aktif, Tertulis/Lisan";
                                                break;
                                        }
                                        ?></td>
                                    <td><?= $bahasa['WriteType']; ?></td>
                                    <td><?= $bahasa['LangMark']; ?></td>
                                    <td><a href="<?= base_url(); ?>/uploads/docs/<?= $bahasa['File']; ?>" target="_blank">Lihat Bukti</a></td>
                                    <td><?= $bahasa['kompetensi']; ?></td>
                                    <td>
                                        <select name="nilai_p" id="nilai_p">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nilai_q" id="nilai_q">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nilai_r" id="nilai_r">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                </tr>
                            <?php
                            endforeach
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>