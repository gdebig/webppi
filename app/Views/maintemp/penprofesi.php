<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <!-- /.card-header -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $FullName; ?>, Mata Kuliah Profesi</h3>
            </div>
            <div class="card-body">

                <form action="<?php echo base_url(); ?>/mannilairpl/profesisimpan" method="post" enctype="multipart/form-data">
                    <div class="sticky">
                        <input type="hidden" id="mhs_id" name="mhs_id" value=<?= $mhs_id; ?>>
                        <input type="hidden" id="dosen_id" name="dosen_id" value=<?= $dosen_id; ?>>
                        <a href="<?= base_url(); ?>/mannilairpl/penilaianrpl/<?= $mhs_id; ?>/<?= $dosen_id; ?>">Kembali</a>
                        <button type="submit" name="submit" value="submit" class="btn btn-primary col">Simpan Data Profesionalisme</button>
                    </div>
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
                    <!--UserFair12-->
                    <?php if (isset($data_pend) && ($data_pend != "kosong")) {
                    ?>
                        <br />
                        <h3>I.2. Pendidikan Formal (W2)</h3>
                        <br />
                        <table id="tabledata" class="display table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Check</th>
                                    <th>Jenjang</th>
                                    <th>Universitas</th>
                                    <th>Fakultas</th>
                                    <th>Program Studi</th>
                                    <th>Alamat</th>
                                    <th>Tahun Lulus</th>
                                    <th>Gelar</th>
                                    <th>Judul Tugas Akhir</th>
                                    <th>Uraian Tugas Akhir</th>
                                    <th>Nilai</th>
                                    <th>Scan Ijazah</th>
                                    <th>Nilai P</th>
                                    <th>Nilai Q</th>
                                    <th>Nilai R</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $j = 0;
                                foreach ($data_pend as $pend) :
                                ?>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td>
                                            <?php
                                            if (in_array($pend['Num'], $id12)) {
                                                $idx = array_search($pend['Num'], $id12);
                                                $nilaipendp[$j] = $nilaip12[$idx];
                                                $nilaipendq[$j] = $nilaiq12[$idx];
                                                $nilaipendr[$j] = $nilair12[$idx];
                                                $checked[$j] = 'checked';
                                            } else {
                                                $nilaipendp[$j] = '';
                                                $nilaipendq[$j] = '';
                                                $nilaipendr[$j] = '';
                                                $checked[$j] = '';
                                            }
                                            ?>
                                            <input type="checkbox" name="pend_index[]" id="pend_index[]" value="<?= $j; ?>" <?= $checked[$j]; ?> />
                                            <input type="hidden" name="pend_id[]" id="pend_id[]" value="<?= $pend['Num']; ?>" />
                                        </td>
                                        <td><?= $pend['Rank']; ?></td>
                                        <td><?= $pend['Name']; ?></td>
                                        <td><?= $pend['Faculty']; ?></td>
                                        <td><?= $pend['Major']; ?></td>
                                        <td><?= $pend['City'] . ", " . $pend['Country'] ?></td>
                                        <td><?= $pend['GradYear']; ?></td>
                                        <td><?= $pend['Degree']; ?></td>
                                        <td><?= $pend['Title']; ?></td>
                                        <td><?= $pend['Desc']; ?></td>
                                        <td><?= $pend['Mark']; ?></td>
                                        <td><a href="<?= base_url(); ?>/uploads/docs/<?= $pend['File']; ?>" target="_blank">Lihat Ijazah</a></td>
                                        <td>
                                            <?php
                                            if ((isset($nilaipendp[$j])) && (!empty($nilaipendp[$j]))) {
                                                $rankscore = $nilaipendp[$j];
                                            } else {
                                                $tahunini = date('Y');
                                                $lama = $tahunini - $pend['GradYear'];
                                                if ($pend['Rank'] == 'S1') {
                                                    if ($lama < 10) {
                                                        $rankscore = 1;
                                                    } elseif ($lama <= 15) {
                                                        $rankscore = 2;
                                                    } elseif ($lama <= 20) {
                                                        $rankscore = 3;
                                                    } elseif ($lama > 25) {
                                                        $rankscore = 4;
                                                    }
                                                } elseif ($pend['Rank'] == 'S2') {
                                                    if ($lama < 5) {
                                                        $rankscore = 1;
                                                    } elseif ($lama <= 15) {
                                                        $rankscore = 2;
                                                    } elseif ($lama <= 20) {
                                                        $rankscore = 3;
                                                    } elseif ($lama > 20) {
                                                        $rankscore = 4;
                                                    }
                                                } elseif ($pend['Rank'] == 'S3') {
                                                    if ($lama < 5) {
                                                        $rankscore = 2;
                                                    } elseif ($lama <= 10) {
                                                        $rankscore = 3;
                                                    } elseif ($lama > 10) {
                                                        $rankscore = 4;
                                                    }
                                                }
                                            }
                                            ?>
                                            <select name="nilaipend_p[]" id="nilaipend_p[]">
                                                <option value="4" <?= $rankscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $rankscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $rankscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $rankscore == 1 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                            if ((isset($nilaipendq[$j])) && (!empty($nilaipendq[$j]))) {
                                                $markscore = $nilaipendq[$j];
                                            } else {
                                                if ($pend['Mark'] < 3) {
                                                    $markscore = 2;
                                                } elseif ($pend['Mark'] < 3.5) {
                                                    $markscore = 3;
                                                } else {
                                                    if (($pend['Rank'] == 'S1') && ($pend['Mark'] > 3.5)) {
                                                        $markscore = 4;
                                                    } elseif (($pend['Rank'] == 'S2') && ($pend['Mark'] > 3.75)) {
                                                        $markscore = 4;
                                                    } elseif (($pend['Rank'] == 'S3') && ($pend['Mark'] > 3.76)) {
                                                        $markscore = 4;
                                                    } else {
                                                        $markscore = '';
                                                    }
                                                }
                                            }
                                            ?>
                                            <select name="nilaipend_q[]" id="nilaipend_q[]">
                                                <option value="4" <?= $markscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $markscore == 4 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $markscore == 4 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $markscore == 4 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                            if ((isset($nilaipendr[$j])) && (!empty($nilaipendr[$j]))) {
                                                $markscore1 = $nilaipendr[$j];
                                            } else {
                                                if ($pend['Mark'] < 3) {
                                                    $markscore1 = 2;
                                                } elseif ($pend['Mark'] < 3.5) {
                                                    $markscore1 = 3;
                                                } else {
                                                    if (($pend['Rank'] == 'S1') && ($pend['Mark'] > 3.5)) {
                                                        $markscore1 = 4;
                                                    } elseif (($pend['Rank'] == 'S2') && ($pend['Mark'] > 3.75)) {
                                                        $markscore1 = 4;
                                                    } elseif (($pend['Rank'] == 'S3') && ($pend['Mark'] > 3.76)) {
                                                        $markscore1 = 4;
                                                    } else {
                                                        $markscore1 = '';
                                                    }
                                                }
                                            }
                                            ?>
                                            <select name="nilaipend_r" id="nilaipend_r">
                                                <option value="4" <?= $markscore1 == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $markscore1 == 4 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $markscore1 == 4 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $markscore1 == 4 ? 'selected' : ''; ?>>1</option>
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
                                            if ((isset($nilaiorgq[$j])) && (!empty($nilaiorgq[$j]))) {
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
                                            $score = '';
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
                    <!--UserFair15-->
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
                                $j = 0;
                                foreach ($data_latih as $latih) :
                                ?>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td>
                                            <?php
                                            if (in_array($latih['Num'], $id15)) {
                                                $idx = array_search($latih['Num'], $id15);
                                                $nilailatihp[$j] = $nilaip15[$idx];
                                                $nilailatihq[$j] = $nilaiq15[$idx];
                                                $nilailatihr[$j] = $nilair15[$idx];
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
                                                    echo "Lebih dari 240 Jam";
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
                                                $latihscore = $nilailatihp[$j];
                                            } else {
                                                if ($latih['Length'] == 'sd36') {
                                                    $latihscore = 1;
                                                } elseif ($latih['Length'] == 'smp100') {
                                                    $latihscore = 2;
                                                } elseif ($latih['Length'] == 'smp240') {
                                                    $latihscore = 3;
                                                } elseif ($latih['Length'] == 'lbh240') {
                                                    $latihscore = 4;
                                                } else {
                                                    $latihscore = 1;
                                                }
                                            }
                                            ?>
                                            <select name="nilailatih_p[]" id="nilailatih_p[]">
                                                <option value="4" <?= $latihscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $latihscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $latihscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $latihscore == 1 ? 'selected' : ''; ?>>1</option>
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
                                                $levelscore = $nilailatihr[$j];
                                            } else {
                                                if ($latih['Level'] == 'Dasar') {
                                                    $levelscore = 2;
                                                } elseif ($latih['Level'] == 'Lanjut') {
                                                    $levelscore = 3;
                                                } else {
                                                    $levelscore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilailatih_r[]" id="nilailatih_r[]">
                                                <option value="4" <?= $levelscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $levelscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $levelscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $levelscore == 1 ? 'selected' : ''; ?>>1</option>
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
                                foreach ($data_latih1 as $latih1) :
                                ?>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td>
                                            <?php
                                            if (in_array($latih1['Num'], $id16)) {
                                                $idx = array_search($latih1['Num'], $id16);
                                                $nilailatih1p[$j] = $nilaip16[$idx];
                                                $nilailatih1q[$j] = $nilaiq16[$idx];
                                                $nilailatih1r[$j] = $nilair16[$idx];
                                                $checked[$j] = 'checked';
                                            } else {
                                                $nilailatih1p[$j] = '';
                                                $nilailatih1q[$j] = '';
                                                $nilailatih1r[$j] = '';
                                                $checked[$j] = '';
                                            }
                                            ?>
                                            <input type="checkbox" name="latih1_index[]" id="latih1_index[]" value="<?= $j; ?>" <?= $checked[$j]; ?> />
                                            <input type="hidden" name="latih1_id[]" id="latih1_id[]" value="<?= $latih1['Num']; ?>" />
                                        </td>
                                        <td><?= $latih1['Name']; ?></td>
                                        <td><?= $latih1['Organizer']; ?></td>
                                        <td><?= $latih1['Kota']; ?></td>
                                        <td><?= $latih1['Country']; ?></td>
                                        <td><?= $latih1['StartMonth'] . '/' . $latih1['StartYear']; ?></td>
                                        <td><?php
                                            switch ($latih1['Level']) {
                                                case 'Dasar':
                                                    echo "Tingkat Dasar (Fundamental)";
                                                    break;
                                                case 'Lanjut':
                                                    echo "Tingkat Lanjut (Advanced)";
                                                    break;
                                            }
                                            ?></td>
                                        <td><?php
                                            switch ($latih1['Length']) {
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
                                        <td><?= $latih1['Description']; ?></td>
                                        <td><?php
                                            if (!empty($latih1['File'])) {
                                                echo "<a href='" . base_url('uploads/docs/' . $latih1['File']) . "' target='_blank'>" . "Lihat Bukti" . "</a>";
                                            } else {
                                                echo "";
                                            }
                                            ?></td>
                                        <td><?= $latih1['kompetensi']; ?></td>
                                        <td>
                                            <?php
                                            if ((isset($nilailatih1p[$j])) && (!empty($nilailatih1p[$j]))) {
                                                $lengthscore = $nilailatih1p[$j];
                                            } else {
                                                if ($latih1['Length'] == 'sd36') {
                                                    $lengthscore = 1;
                                                } elseif ($latih1['Length'] == 'smp100') {
                                                    $lengthscore = 2;
                                                } elseif ($latih1['Length'] == 'smp240') {
                                                    $lengthscore = 3;
                                                } elseif ($latih1['Length'] == 'lbih240') {
                                                    $lengthscore = 4;
                                                } else {
                                                    $lengthscore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilailatih1_p[]" id="nilailatih1_p[]">
                                                <option value="4" <?= $lengthscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $lengthscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $lengthscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $lengthscore == 1 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="nilailatih1_q[]" id="nilailatih1_q[]">
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                                <option value="2" selected>2</option>
                                                <option value="1">1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                            if ((isset($nilailatih1r[$j])) && (!empty($nilailatih1r[$j]))) {
                                                $levscore = $nilailatih1r[$j];
                                            } else {
                                                if ($latih1['Level'] == 'Dasar') {
                                                    $levscore = 2;
                                                } elseif ($latih1['Level'] == 'Lanjut') {
                                                    $levscore = 3;
                                                } else {
                                                    $levscore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilailatih1_r[]" id="nilailatih1_r[]">
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
                    <!--UserFair4-->
                    <?php if (isset($data_ajar) && ($data_ajar != "kosong")) {
                    ?>
                        <br />
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
                                $j = 0;
                                foreach ($data_ajar as $ajar) :
                                ?>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td>
                                            <?php
                                            if (in_array($ajar['Num'], $id4)) {
                                                $idx = array_search($ajar['Num'], $id4);
                                                $nilaiajarp[$j] = $nilaip4[$idx];
                                                $nilaiajarq[$j] = $nilaiq4[$idx];
                                                $nilaiajarr[$j] = $nilair4[$idx];
                                                $checked[$j] = 'checked';
                                            } else {
                                                $nilaiajarp[$j] = '';
                                                $nilaiajarq[$j] = '';
                                                $nilaiajarr[$j] = '';
                                                $checked[$j] = '';
                                            }
                                            ?>
                                            <input type="checkbox" name="ajar_index[]" id="ajar_index[]" value="<?= $j; ?>" <?= $checked[$j]; ?> />
                                            <input type="hidden" name="ajar_id[]" id="ajar_id[]" value="<?= $ajar['Num']; ?>" />
                                        </td>
                                        <td><?= $ajar['StartPeriod'] . ' - ' . $ajar['EndPeriod']; ?></td>
                                        <td><?= $ajar['Institution']; ?></td>
                                        <td><?= $ajar['Name']; ?></td>
                                        <td><?= $ajar['LocCity'] . ', ' . $ajar['LocProv'] . ', ' . $ajar['LocCountry']; ?></td>
                                        <td><?php
                                            switch ($ajar['Period']) {
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
                                            switch ($ajar['Position']) {
                                                case 'Stf':
                                                    echo "Staf Pengajar";
                                                    break;
                                                case 'Pim':
                                                    echo "Pimpinan";
                                                    break;
                                            }
                                            ?></td>
                                        <td><?php
                                            switch ($ajar['Skshour']) {
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
                                        <td><?= $ajar['Desc']; ?></td>
                                        <td><?php
                                            if (!empty($ajar['File'])) {
                                                echo "<a href='" . base_url('uploads/docs/' . $ajar['File']) . "' target='_blank'>" . "Lihat Bukti" . "</a>";
                                            } else {
                                                echo "";
                                            }
                                            ?></td>
                                        <td><?= $ajar['kompetensi']; ?></td>
                                        <td>
                                            <?php
                                            if ((isset($nilaiajarp[$j])) && (!empty($nilaiajarp[$j]))) {
                                                $ajarscore = $nilaiajarp[$j];
                                            } else {
                                                if ($ajar['Period'] == 'smp9') {
                                                    $ajarscore = 1;
                                                } elseif ($ajar['Period'] == 'smp14') {
                                                    $ajarscore = 2;
                                                } elseif ($ajar['Period'] == 'smp19') {
                                                    $ajarscore = 3;
                                                } elseif ($ajar['Period'] == 'lbih20') {
                                                    $ajarscore = 4;
                                                } else {
                                                    $ajarscore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilaiajar_p[]" id="nilaiajar_p[]">
                                                <option value="4" <?= $ajarscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $ajarscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $ajarscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $ajarscore == 1 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="nilaiajar_q[]" id="nilaiajar_q[]">
                                                <option value="2" <?= ((isset($nilaiajarq[$j])) && ($nilaiajarq[$j] == 2)) ? 'selected' : ''; ?>>2</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                            if ((isset($nilaiajarr[$j])) && (!empty($nilaiajarr[$j]))) {
                                                $sksscore = $nilaiajarr[$j];
                                            } else {
                                                if ($ajar['Skshour'] == 'sks1') {
                                                    $sksscore = 1;
                                                } elseif ($ajar['Skshour'] == 'sks2') {
                                                    $sksscore = 2;
                                                } elseif ($ajar['Skshour'] == 'sks4') {
                                                    $sksscore = 3;
                                                } else {
                                                    $sksscore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilaiajar_r[]" id="nilaiajar_r[]">
                                                <option value="4" <?= $sksscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $sksscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $sksscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $sksscore == 1 ? 'selected' : ''; ?>>1</option>
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
                    <!--UserFair53-->
                    <?php if (isset($data_sem) && ($data_sem != "kosong")) {
                    ?>
                        <h3>V.3 Seminar/Lokakarya Keinsinyuran Yang Diikuti (W2) </h3>
                        <table id="tabledata" class="display table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Check</th>
                                    <th>Bulan-Tahun</th>
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
                                $j = 0;
                                foreach ($data_sem as $sem) :
                                ?>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td>
                                            <?php
                                            if (in_array($sem['Num'], $id53)) {
                                                $idx = array_search($sem['Num'], $id53);
                                                $nilaisemp[$j] = $nilaip53[$idx];
                                                $nilaisemq[$j] = $nilaiq53[$idx];
                                                $nilaisemr[$j] = $nilair53[$idx];
                                                $checked[$j] = 'checked';
                                            } else {
                                                $nilaisemp[$j] = '';
                                                $nilaisemq[$j] = '';
                                                $nilaisemr[$j] = '';
                                                $checked[$j] = '';
                                            }
                                            ?>
                                            <input type="checkbox" name="sem_index[]" id="sem_index[]" value="<?= $j; ?>" <?= $checked[$j]; ?> />
                                            <input type="hidden" name="sem_id[]" id="sem_id[]" value="<?= $sem['Num']; ?>" />
                                        </td>
                                        <td><?= $sem['Month'] . '-' . $sem['Year']; ?></td>
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
                                            <select name="nilaisem_p[]" id="nilaisem_p[]">
                                                <option value="4" <?= ((isset($nilaisemp[$j])) && ($nilaisemp[$j] == 4)) ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= ((isset($nilaisemp[$j])) && ($nilaisemp[$j] == 3)) ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= ((isset($nilaisemp[$j])) && ($nilaisemp[$j] == 2)) ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= ((isset($nilaisemp[$j])) && ($nilaisemp[$j] == 1)) ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="nilaisem_q[]" id="nilaisem_q[]">
                                                <option value="4" <?= ((isset($nilaisemq[$j])) && ($nilaisemq[$j] == 4)) ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= ((isset($nilaisemq[$j])) && ($nilaisemq[$j] == 3)) ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= ((isset($nilaisemq[$j])) && ($nilaisemq[$j] == 2)) ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= ((isset($nilaisemq[$j])) && ($nilaisemq[$j] == 1)) ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="nilaisem_r[]" id="nilaisem_r[]">
                                                <option value="4" <?= ((isset($nilaisemr[$j])) && ($nilaisemr[$j] == 4)) ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= ((isset($nilaisemr[$j])) && ($nilaisemr[$j] == 3)) ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= ((isset($nilaisemr[$j])) && ($nilaisemr[$j] == 2)) ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= ((isset($nilaisemr[$j])) && ($nilaisemr[$j] == 1)) ? 'selected' : ''; ?>>1</option>
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
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>