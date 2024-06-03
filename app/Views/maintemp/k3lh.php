<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <!-- /.card-header -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $FullName; ?>, Mata Kuliah Keselamatan, Kesehatan, Keamanan Kerja dan Lingkungan Hidup (K3LH)</h3>
            </div>
            <div class="card-body">

                <form action="<?php echo base_url(); ?>/nilairpl/k3lhsimpan" method="post" enctype="multipart/form-data">
                    <div class="sticky">
                        <input type="hidden" id="mhs_id" name="mhs_id" value=<?= $mhs_id; ?>>
                        <input type="hidden" id="dosen_id" name="dosen_id" value=<?= $dosen_id; ?>>
                        <a href="<?= base_url(); ?>/nilairpl/docs/<?= $mhs_id; ?>/<?= $dosen_id; ?>">Kembali</a>
                        <button type="submit" name="submit" value="submit" class="btn btn-primary col">Simpan Data K3LH</button>
                    </div>

                    <!--UserFair13-->
                    <?php if (isset($data_org) && ($data_org != "kosong")) {
                    ?>
                        <br />
                        <h3>I.3. Organisasi Profesi & Organisasi Lainnya Yang Dimasuki (W1)</h3>
                        <table id="tabledata" class="display table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Check</th>
                                    <th>Nama Organisasi</th>
                                    <th>Jenis Organisasi</th>
                                    <th>Kota</th>
                                    <th>Negara</th>
                                    <th>Perioda</th>
                                    <th>Sudah Berapa Lama Menjadi Anggota</th>
                                    <th>Jabatan Dalam Organisasi</th>
                                    <th>Tingkatan Organisasi</th>
                                    <th>Lingkup Kegiatan Organisasi</th>
                                    <th>Aktifitas Dalam Organisasi</th>
                                    <th>Bukti Menjadi Pengurus</th>
                                    <th>Klaim Kompetensi</th>
                                    <th width="5%">Nilai Q</th>
                                    <th width="5%">Nilai R</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $j = 0;
                                foreach ($data_org as $org) :
                                ?>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td>
                                            <?php
                                            if (in_array($org['Num'], $id13)) {
                                                $idx = array_search($org['Num'], $id13);
                                                $nilaiorgp[$j] = $nilaip13[$idx];
                                                $nilaiorgq[$j] = $nilaiq13[$idx];
                                                $nilaiorgr[$j] = $nilair13[$idx];
                                                $checked[$j] = 'checked';
                                            } else {
                                                $nilaiorgp[$j] = '';
                                                $nilaiorgq[$j] = '';
                                                $nilaiorgr[$j] = '';
                                                $checked[$j] = '';
                                            }
                                            ?>
                                            <input type="checkbox" name="org_index[]" id="org_index[]" value="<?= $j; ?>" <?= $checked[$j]; ?> />
                                            <input type="hidden" name="org_id[]" id="org_id[]" value="<?= $org['Num']; ?>" />
                                        </td>
                                        <td><?= $org['Name']; ?></td>
                                        <td><?php
                                            switch ($org['Type']) {
                                                case "PII":
                                                    echo "Organisasi PII";
                                                    break;
                                                case "Ins":
                                                    echo "Organisasi Keinsinyuran Non PII";
                                                    break;
                                                case "Non":
                                                    echo "Organisasi Non Keinsinyuran";
                                                    break;
                                            }
                                            ?></td>
                                        <td><?= $org['City']; ?></td>
                                        <td><?= $org['Country']; ?></td>
                                        <td><?= $org['StartPeriodBulan'] . " " . $org['StartPeriodYear'] . " hingga " . $org['EndPeriodBulan'] . " " . $org['EndPeriodYear']; ?>
                                        </td>
                                        <td><?php
                                            switch ($org['Period']) {
                                                case "sd5":
                                                    echo "1 - 5 tahun";
                                                    break;
                                                case "smp10":
                                                    echo "6 - 10 tahun";
                                                    break;
                                                case "smp15":
                                                    echo "11 - 15 tahun";
                                                    break;
                                                case "lbih15":
                                                    echo "Lebih dari 15 tahun";
                                                    break;
                                            }
                                            ?></td>
                                        <td><?php
                                            switch ($org['Position']) {
                                                case "Bias":
                                                    echo "Anggota Biasa";
                                                    break;
                                                case "Peng":
                                                    echo "Anggota Pengurus";
                                                    break;
                                                case "Pimp":
                                                    echo "Pimpinan";
                                                    break;
                                            }
                                            ?></td>
                                        <td><?php
                                            switch ($org['OrgLevel']) {
                                                case "Lok":
                                                    echo "Organisasi Lokal (Bukan Nasional)";
                                                    break;
                                                case "Nas":
                                                    echo "Organisasi Nasional";
                                                    break;
                                                case "Reg":
                                                    echo "Organisasi Regional";
                                                    break;
                                                case "Int":
                                                    echo "Organisasi Internasional";
                                                    break;
                                            }
                                            ?></td>
                                        <td><?php
                                            switch ($org['OrgScp']) {
                                                case "Aso":
                                                    echo "Asosiasi Profesi";
                                                    break;
                                                case "Pem":
                                                    echo "Lembaga Pemerintahan";
                                                    break;
                                                case "Pen":
                                                    echo "Lembaga Pendidikan";
                                                    break;
                                                case "Neg":
                                                    echo "Badan Usaha Milik Negara";
                                                    break;
                                                case "Swa":
                                                    echo "Badan Usaha Milik Swasta";
                                                    break;
                                                case "Mas":
                                                    echo "Organisasi Kemasyarakatan";
                                                    break;
                                                case "Lai":
                                                    echo "Lain-lain";
                                                    break;
                                            }
                                            ?></td>
                                        <td><?= $org['Desc']; ?></td>
                                        <td><a href="<?= base_url(); ?>/uploads/docs/<?= $org['File']; ?>" target="_blank">Lihat Bukti</a></td>
                                        <td><?= $org['kompetensi']; ?></td>
                                        <td width="5%">
                                            <?php
                                            if ((isset($nilaiorgq[$j])) && !empty($nilaiorgq[$j])) {
                                                $posscore = $nilaiorgq[$j];
                                            } else {
                                                if ($org['Position'] == "Bias") {
                                                    $posscore = 2;
                                                } elseif ($org['Position'] == "Peng") {
                                                    $posscore = 3;
                                                } elseif ($org['Position'] == "Pimp") {
                                                    $posscore = 4;
                                                } else {
                                                    $posscore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilaiorg_q[]" id="nilaiorg_q[]">
                                                <option value="4" <?= $posscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $posscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $posscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $posscore == 1 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td width="5%">
                                            <?php
                                            if ((isset($nilaiorgr[$j])) && (!empty($nilaiorgr[$j]))) {
                                                $orgscore = $nilaiorgr[$j];
                                            } else {
                                                if ($org['OrgLevel'] == "Lok") {
                                                    $orgscore = 1;
                                                } elseif ($org['OrgLevel'] == "Nas") {
                                                    $orgscore = 2;
                                                } elseif ($org['OrgLevel'] == "Reg") {
                                                    $orgscore = 3;
                                                } elseif ($org['OrgLevel'] == "Int") {
                                                    $orgscore = 4;
                                                } else {
                                                    $orgscore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilaiorg_r[]" id="nilaiorg_r[]">
                                                <option value="4" <?= $orgscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $orgscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $orgscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $orgscore == 1 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php
                                    $j++;
                                endforeach
                                ?>
                            </tbody>
                        </table>
                        <table>
                            <tr>
                                <th>Informasi jenis dan jumlah organisasi</th>
                                <th width="30px">&nbsp;</th>
                                <th>Nilai P</th>
                            </tr>
                            <tr>
                                <td>Terdapat organisasi PII :
                                    <?= !empty($org_pii) ? "Ya, ada." : "Tidak ada"; ?><br />Jumlah organisasi:
                                    <?= $jumlah_org; ?></td>
                                <td>&nbsp;</td>
                                <td>
                                    <?php
                                    if (!empty($org_pii)) {
                                        $score = 4;
                                    } else {
                                        if ($jumlah_org < 6) {
                                            $score = 1;
                                        } elseif ($jumlah_org < 16) {
                                            $score = 2;
                                        } elseif ($jumlah_org <= 20) {
                                            $score = 3;
                                        } else {
                                            $score = 4;
                                        }
                                    }
                                    ?>
                                    <select name="nilaiorg_p" id="nilaiorg_p">
                                        <option value="4" <?= $score == 4 ? 'selected' : ''; ?>>4</option>
                                        <option value="3" <?= $score == 3 ? 'selected' : ''; ?>>3</option>
                                        <option value="2" <?= $score == 2 ? 'selected' : ''; ?>>2</option>
                                        <option value="1" <?= $score == 1 ? 'selected' : ''; ?>>1</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    <?php } ?>
                    <!--UserFair14-->
                    <?php if (isset($data_harga) && ($data_harga != "kosong")) {
                    ?>
                        <br />
                        <h3>I.4. Tanda Penghargaan Yang Diterima (W1)</h3>
                        <table id="tabledata" class="display table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Check</th>
                                    <th>Tahun</th>
                                    <th>Nama Tanda Penghargaan</th>
                                    <th>Nama Lembaga yang Memberikan</th>
                                    <th>Lokasi</th>
                                    <th>Negara</th>
                                    <th>Penghargaan yang diterima tingkat</th>
                                    <th>Penghargaan diberikan oleh lembaga</th>
                                    <th>Uraian Singkat Tanda Penghargaan</th>
                                    <th>Bukti Penghargaan</th>
                                    <th>Klaim Kompetensi</th>
                                    <th>Nilai P</th>
                                    <th>Nilai Q</th>
                                    <th>Nilai R</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $j = 0;
                                foreach ($data_harga as $penghargaan) :
                                ?>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td>
                                            <?php
                                            if (in_array($penghargaan['Num'], $id14)) {
                                                $idx = array_search($penghargaan['Num'], $id14);
                                                $nilaihargap[$j] = $nilaip14[$idx];
                                                $nilaihargaq[$j] = $nilaiq14[$idx];
                                                $nilaihargar[$j] = $nilair14[$idx];
                                                $checked[$j] = 'checked';
                                            } else {
                                                $nilaihargap[$j] = '';
                                                $nilaihargaq[$j] = '';
                                                $nilaihargar[$j] = '';
                                                $checked[$j] = '';
                                            }
                                            ?>
                                            <input type="checkbox" name="penghargaan_index[]" id="penghargaan_index[]" value="<?= $j; ?>" <?= $checked[$j]; ?> />
                                            <input type="hidden" name="penghargaan_id[]" id="penghargaan_id[]" value="<?= $penghargaan['Num']; ?>" />
                                        </td>
                                        <td><?php
                                            switch ($penghargaan['Month']) {
                                                case '1':
                                                    $bulan = "Jan";
                                                    break;
                                                case '2':
                                                    $bulan = "Feb";
                                                    break;
                                                case '3':
                                                    $bulan = "Mar";
                                                    break;
                                                case '4':
                                                    $bulan = "Apr";
                                                    break;
                                                case '5':
                                                    $bulan = "Mei";
                                                    break;
                                                case '6':
                                                    $bulan = "Jun";
                                                    break;
                                                case '7':
                                                    $bulan = "Jul";
                                                    break;
                                                case '8':
                                                    $bulan = "Agus";
                                                    break;
                                                case '9':
                                                    $bulan = "Sep";
                                                    break;
                                                case '10':
                                                    $bulan = "Okt";
                                                    break;
                                                case '11':
                                                    $bulan = "Nov";
                                                    break;
                                                case '12':
                                                    $bulan = "Des";
                                                    break;
                                            }
                                            echo $bulan . ' - ' . $penghargaan['Year'];
                                            ?></td>
                                        <td><?= $penghargaan['Name']; ?></td>
                                        <td><?= $penghargaan['Institute']; ?></td>
                                        <td><?= $penghargaan['City'] . ', ' . $penghargaan['Prov']; ?></td>
                                        <td><?= $penghargaan['Country']; ?></td>
                                        <td>
                                            <?php
                                            switch ($penghargaan['Level']) {
                                                case 'Mud':
                                                    echo "Tingkatan Muda/Pemula";
                                                    break;
                                                case 'Mad':
                                                    echo "Tingkatan Madya";
                                                    break;
                                                case 'Uta':
                                                    echo "Tingkatan Utama";
                                                    break;
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            switch ($penghargaan['InstituteType']) {
                                                case 'Lok':
                                                    echo "Penghargaan Lokal";
                                                    break;
                                                case 'Nas':
                                                    echo "Penghargaan Nasional";
                                                    break;
                                                case 'Reg':
                                                    echo "Penghargaan Regional";
                                                    break;
                                                case 'Int':
                                                    echo "Penghargaan Internasional";
                                                    break;
                                            }
                                            ?>
                                        </td>
                                        <td><?= $penghargaan['Desc']; ?></td>
                                        <td><a href="<?= base_url(); ?>/uploads/docs/<?= $penghargaan['File']; ?>" target="_blank">Lihat Bukti</a></td>
                                        <td><?= $penghargaan['kompetensi']; ?></td>
                                        <td>
                                            <select name="nilaipenghargaan_p[]" id="nilaipenghargaan_p[]">
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                                <option value="2">2</option>
                                                <option value="1" selected>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                            if ((isset($nilaihargaq[$j])) && (!empty($nilaihargaq[$j]))) {
                                                $levelscore = $nilaihargaq[$j];
                                            } else {
                                                if ($penghargaan['Level'] == 'Mud') {
                                                    $levelscore = 2;
                                                } elseif ($penghargaan['Level'] == 'Mad') {
                                                    $levelscore = 3;
                                                } elseif ($penghargaan['Level'] == 'Uta') {
                                                    $levelscore = 4;
                                                } else {
                                                    $levelscore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilaipenghargaan_q[]" id="nilaipenghargaan_q[]">
                                                <option value="4" <?= $levelscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $levelscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $levelscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $levelscore == 1 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                            if ((isset($nilaihargar[$j])) && (!empty($nilaihargar[$j]))) {
                                                $typescore = $nilaihargar[$j];
                                            } else {
                                                if ($penghargaan['InstituteType'] == 'Lok') {
                                                    $typescore = 1;
                                                } elseif ($penghargaan['InstituteType'] == 'Nas') {
                                                    $typescore = 2;
                                                } elseif ($penghargaan['InstituteType'] == 'Reg') {
                                                    $typescore = 3;
                                                } elseif ($penghargaan['InstituteType'] == 'Int') {
                                                    $typescore = 4;
                                                } else {
                                                    $typescore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilaipenghargaan_r[]" id="nilaipenghargaan_r[]">
                                                <option value="4" <?= $typescore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $typescore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $typescore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $typescore == 1 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php
                                    $j++;
                                endforeach
                                ?>
                            </tbody>
                        </table>
                    <?php } ?>
                    <!--UserFair16-->
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
                                $j = 0;
                                foreach ($data_latih1 as $latih) :
                                ?>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td>
                                            <?php
                                            if (in_array($latih['Num'], $id16)) {
                                                $idx = array_search($latih['Num'], $id16);
                                                $nilailatihp[$j] = $nilaip16[$idx];
                                                $nilailatihq[$j] = $nilaiq16[$idx];
                                                $nilailatihr[$j] = $nilair16[$idx];
                                                $checked[$j] = 'checked';
                                            } else {
                                                $nilailatihp[$j] = '';
                                                $nilailatihq[$j] = '';
                                                $nilailatihr[$j] = '';
                                                $checked[$j] = '';
                                            }
                                            ?>
                                            <input type="checkbox" name="latih_index[]" id="latih_index[]" value="<?= $j; ?>" <?= $checked[$j]; ?> />
                                            <input type="hidden" name="latih_id[]" id="latih_id[]" value="<?= $latih['Num']; ?>" />
                                        </td>
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
                                            if ((isset($nilailatihp[$j])) && (!empty($nilailatihp[$j]))) {
                                                $lengthscore = $nilailatihp[$j];
                                            } else {
                                                if ($latih['Length'] == 'sd36') {
                                                    $lengthscore = 1;
                                                } elseif ($latih['Length'] == 'smp100') {
                                                    $lengthscore = 2;
                                                } elseif ($latih['Length'] == 'smp240') {
                                                    $lengthscore = 3;
                                                } elseif ($latih['Length'] == 'lbih240') {
                                                    $lengthscore = 4;
                                                } else {
                                                    $lengthscore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilailatih_p[]" id="nilailatih_p[]">
                                                <option value="4" <?= $lengthscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $lengthscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $lengthscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $lengthscore == 1 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="nilailatih_q[]" id="nilailatih_q[]">
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                                <option value="2" selected>2</option>
                                                <option value="1">1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                            if ((isset($nilailatihr[$j])) && (!empty($nilailatihr[$j]))) {
                                                $levscore = $nilailatihr[$j];
                                            } else {
                                                if ($latih['Level'] == 'Dasar') {
                                                    $levscore = 2;
                                                } elseif ($latih['Level'] == 'Lanjut') {
                                                    $levscore = 3;
                                                } else {
                                                    $levscore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilailatih_r[]" id="nilailatih_r[]">
                                                <option value="4" <?= $levscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $levscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $levscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $levscore == 1 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php
                                    $j++;
                                endforeach
                                ?>
                            </tbody>
                        </table>
                    <?php } ?>
                    <br />
                    <!--UserFair3-->
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
                                $j = 0;
                                foreach ($data_kerja as $kerja) :
                                ?>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td>
                                            <?php
                                            if (in_array($kerja['Num'], $id3)) {
                                                $idx = array_search($kerja['Num'], $id3);
                                                $nilaikerjap[$j] = $nilaip3[$idx];
                                                $nilaikerjaq[$j] = $nilaiq3[$idx];
                                                $nilaikerjar[$j] = $nilair3[$idx];
                                                $checked[$j] = 'checked';
                                            } else {
                                                $nilaikerjap[$j] = '';
                                                $nilaikerjaq[$j] = '';
                                                $nilaikerjar[$j] = '';
                                                $checked[$j] = '';
                                            }
                                            ?>
                                            <input type="checkbox" name="kerja_index[]" id="kerja_index[]" value="<?= $j; ?>" <?= $checked[$j]; ?> />
                                            <input type="hidden" name="kerja_id[]" id="kerja_id[]" value="<?= $kerja['Num']; ?>" />
                                        </td>
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
                                            if ((isset($nilaikerjap[$j])) && (!empty($nilaikerjap[$j]))) {
                                                $durscore = $nilaikerjap[$j];
                                            } else {
                                                if ($kerja['Duration'] == 'smp3') {
                                                    $durscore = 1;
                                                } elseif ($kerja['Duration'] == 'smp7') {
                                                    $durscore = 2;
                                                } elseif ($kerja['Duration'] == 'smp10') {
                                                    $durscore = 3;
                                                } elseif ($kerja['Duration'] == 'lbih10') {
                                                    $durscore = 4;
                                                } else {
                                                    $durscore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilaikerja_p[]" id="nilaikerja_p[]">
                                                <option value="4" <?= $durscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $durscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $durscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $durscore == 1 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                            if ((isset($nilaikerjaq[$j])) && (!empty($nilaikerjaq[$j]))) {
                                                $jabscore = $nilaikerjaq[$j];
                                            } else {
                                                if ($kerja['Jabatan'] == 'anggota') {
                                                    $jabscore = 1;
                                                } elseif ($kerja['Jabatan'] == 'supervisor') {
                                                    $jabscore = 2;
                                                } elseif ($kerja['Jabatan'] == 'direktur') {
                                                    $jabscore = 3;
                                                } elseif ($kerja['Jabatan'] == 'pengarah') {
                                                    $jabscore = 4;
                                                } else {
                                                    $jabscore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilaikerja_q[]" id="nilaikerja_q[]">
                                                <option value="4" <?= $jabscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $jabscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $jabscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $jabscore == 1 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="nilaikerja_r[]" id="nilaikerja_r[]">
                                                <option value="4" <?= ((isset($nilaikerjar[$j])) && ($nilaikerjar[$j] == 4)) ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= ((isset($nilaikerjar[$j])) && ($nilaikerjar[$j] == 3)) ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= ((isset($nilaikerjar[$j])) && ($nilaikerjar[$j] == 2)) ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= ((isset($nilaikerjar[$j])) && ($nilaikerjar[$j] == 1)) ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                    </tr>
                                <?php
                                    $j++;
                                endforeach
                                ?>
                            </tbody>
                        </table>
                    <?php } ?>
                    <br />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>