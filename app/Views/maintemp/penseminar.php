<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <!-- /.card-header -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $FullName; ?>, Mata Kuliah Seminar</h3>
            </div>
            <div class="card-body">

                <form action="<?php echo base_url(); ?>/mannilairpl/seminarsimpan" method="post" enctype="multipart/form-data">
                    <div class="sticky">
                        <input type="hidden" id="mhs_id" name="mhs_id" value=<?= $mhs_id; ?>>
                        <input type="hidden" id="dosen_id" name="dosen_id" value=<?= $dosen_id; ?>>
                        <a href="<?= base_url(); ?>/mannilairpl/penilaianrpl/<?= $mhs_id; ?>/<?= $dosen_id; ?>">Kembali</a>
                        <button type="submit" name="submit" value="submit" class="btn btn-primary col">Simpan Data Seminar</button>
                    </div>
                    <!--UserFair51-->
                    <?php
                    if (isset($data_kartul) && ($data_kartul != "kosong")) {
                    ?>
                        <br />
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
                                $j = 0;
                                foreach ($data_kartul as $kartul) :
                                ?>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td>
                                            <?php
                                            if (in_array($kartul['Num'], $id51)) {
                                                $idx = array_search($kartul['Num'], $id51);
                                                $nilaikartulp[$j] = $nilaip51[$idx];
                                                $nilaikartulq[$j] = $nilaiq51[$idx];
                                                $nilaikartulr[$j] = $nilair51[$idx];
                                                $checked[$j] = 'checked';
                                            } else {
                                                $nilaikartulp[$j] = '';
                                                $nilaikartulq[$j] = '';
                                                $nilaikartulr[$j] = '';
                                                $checked[$j] = '';
                                            }
                                            ?>
                                            <input type="checkbox" name="kartul_index[]" id="kartul_index[]" value="<?= $j; ?>" <?= $checked[$j]; ?> />
                                            <input type="hidden" name="kartul_id[]" id="kartul_id[]" value="<?= $kartul['Num']; ?>" />
                                        </td>
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
                                                case "Reg":
                                                    echo "Dimuat di Media Regional";
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
                                            <select name="nilaikartul_p[]" id="nilaikartul_p[]">
                                                <option value="1">1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                            if ((isset($nilaikartulq[$j])) && (!empty($nilaikartul[$j]))) {
                                                $typescore = $nilaikartulq[$j];
                                            } else {
                                                if ($kartul['Mediatype'] == "Lok") {
                                                    $typescore = 1;
                                                } elseif ($kartul['Mediatype'] == "Nas") {
                                                    $typescore = 2;
                                                } elseif ($kartul['Mediatype'] == "Reg") {
                                                    $typescore = 3;
                                                } elseif ($kartul['Mediatype'] == "Int") {
                                                    $typescore = 4;
                                                } else {
                                                    $typescore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilaikartul_q[]" id="nilaikartul_q[]">
                                                <option value="4" <?= $typescore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $typescore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $typescore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $typescore == 1 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                            if ((isset($nilaikartulr[$j])) && (!empty($nilaikartulr[$j]))) {
                                                $diffscore = $nilaikartulr[$j];
                                            } else {
                                                if ($kartul['Diffbenefit'] == 'Rendah') {
                                                    $diffscore = 1;
                                                } elseif ($kartul['Diffbenefit'] == 'Sedang') {
                                                    $diffscore = 2;
                                                } elseif ($kartul['Diffbenefit'] == 'Tinggi') {
                                                    $diffscore = 3;
                                                } elseif ($kartul['Diffbenefit'] == 'Sangat Tinggi') {
                                                    $diffscore = 4;
                                                } else {
                                                    $diffscore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilaikartul_r[]" id="nilaikartul_r[]">
                                                <option value="4" <?= $diffscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $diffscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $diffscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $diffscore == 1 ? 'selected' : ''; ?>>1</option>
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
                    <!--UserFair52-->
                    <?php
                    if (isset($data_sem) && ($data_sem != "kosong")) {
                    ?>
                        <br />
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
                                $j = 0;
                                foreach ($data_sem as $sem) :
                                ?>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td>
                                            <?php
                                            if (in_array($sem['Num'], $id52)) {
                                                $idx = array_search($sem['Num'], $id52);
                                                $nilaisemp[$j] = $nilaip52[$idx];
                                                $nilaisemq[$j] = $nilaiq52[$idx];
                                                $nilaisemr[$j] = $nilair52[$idx];
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
                                                case "Inv":
                                                    echo "Invited/Keynote Speaker";
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
                                                <option value="1">1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                            if ((isset($nilaisemq[$j])) && (!empty($nilaisemq[$j]))) {
                                                $typescore = $nilaisemq[$j];
                                            } else {
                                                if ($sem['Level'] == "Lok") {
                                                    $typescore = 1;
                                                } elseif ($sem['Level'] == "Nas") {
                                                    $typescore = 2;
                                                } elseif ($sem['Level'] == "Int") {
                                                    $typescore = 3;
                                                } elseif ($sem['Level'] == "Inv") {
                                                    $typescore = 4;
                                                } else {
                                                    $typescore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilaisem_q[]" id="nilaisem_q[]">
                                                <option value="4" <?= $typescore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $typescore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $typescore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $typescore == 1 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                            if ((isset($nilaisemr[$j])) && (!empty($nilaisemr[$j]))) {
                                                $diffscore = $nilaisemr[$j];
                                            } else {
                                                if ($sem['DiffBenefit'] == 'Rendah') {
                                                    $diffscore = 1;
                                                } elseif ($sem['DiffBenefit'] == 'Sedang') {
                                                    $diffscore = 2;
                                                } elseif ($sem['DiffBenefit'] == 'Tinggi') {
                                                    $diffscore = 3;
                                                } elseif ($sem['DiffBenefit'] == 'Sangat Tinggi') {
                                                    $diffscore = 4;
                                                } else {
                                                    $diffscore = '';
                                                }
                                            }
                                            ?>
                                            <select name="nilaisem_r[]" id="nilaisem_r[]">
                                                <option value="4" <?= $diffscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $diffscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $diffscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $diffscore == 1 ? 'selected' : ''; ?>>1</option>
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
                    <?php if (isset($data_sem1) && ($data_sem1 != "kosong")) {
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
                                foreach ($data_sem1 as $sem1) :
                                ?>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td>
                                            <?php
                                            if (in_array($sem1['Num'], $id53)) {
                                                $idx = array_search($sem1['Num'], $id53);
                                                $nilaisem1p[$j] = $nilaip53[$idx];
                                                $nilaisem1q[$j] = $nilaiq53[$idx];
                                                $nilaisem1r[$j] = $nilair53[$idx];
                                                $checked[$j] = 'checked';
                                            } else {
                                                $nilaisem1p[$j] = '';
                                                $nilaisem1q[$j] = '';
                                                $nilaisem1r[$j] = '';
                                                $checked[$j] = '';
                                            }
                                            ?>
                                            <input type="checkbox" name="sem1_index[]" id="sem1_index[]" value="<?= $j; ?>" <?= $checked[$j]; ?> />
                                            <input type="hidden" name="sem1_id[]" id="sem1_id[]" value="<?= $sem1['Num']; ?>" />
                                        </td>
                                        <td><?= $sem1['Month'] . '-' . $sem1['Year']; ?></td>
                                        <td><?= $sem1['Name']; ?></td>
                                        <td><?= $sem1['Organizer']; ?></td>
                                        <td><?= $sem1['LocCity'] . ", " . $sem1['LocCountry'] ?></td>
                                        <td><?php
                                            switch ($sem1['Level']) {
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
                                            switch ($sem1['DiffBenefit']) {
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
                                        <td><?= $sem1['Desc']; ?></td>
                                        <td><a href="<?= base_url(); ?>/uploads/docs/<?= $sem1['File']; ?>" target="_blank">Lihat Bukti</a></td>
                                        <td><?= $sem1['kompetensi']; ?></td>
                                        <td>
                                            <select name="nilaisem1_p[]" id="nilaisem1_p[]">
                                                <option value="4" <?= ((isset($nilaisem1p[$j])) && ($nilaisem1p[$j] == 4)) ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= ((isset($nilaisem1p[$j])) && ($nilaisem1p[$j] == 3)) ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= ((isset($nilaisem1p[$j])) && ($nilaisem1p[$j] == 2)) ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= ((isset($nilaisem1p[$j])) && ($nilaisem1p[$j] == 1)) ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="nilaisem1_q[]" id="nilaisem1_q[]">
                                                <option value="4" <?= ((isset($nilaisem1q[$j])) && ($nilaisem1q[$j] == 4)) ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= ((isset($nilaisem1q[$j])) && ($nilaisem1q[$j] == 3)) ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= ((isset($nilaisem1q[$j])) && ($nilaisem1q[$j] == 2)) ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= ((isset($nilaisem1q[$j])) && ($nilaisem1q[$j] == 1)) ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="nilaisem1_r[]" id="nilaisem1_r[]">
                                                <option value="4" <?= ((isset($nilaisem1r[$j])) && ($nilaisem1r[$j] == 4)) ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= ((isset($nilaisem1r[$j])) && ($nilaisem1r[$j] == 3)) ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= ((isset($nilaisem1r[$j])) && ($nilaisem1r[$j] == 2)) ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= ((isset($nilaisem1r[$j])) && ($nilaisem1r[$j] == 1)) ? 'selected' : ''; ?>>1</option>
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
                                                <option value="3" <?= $jabscore == 4 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $jabscore == 4 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $jabscore == 4 ? 'selected' : ''; ?>>1</option>
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
                    <!--UserFair6-->
                    <?php if (isset($data_bahasa) && ($data_bahasa != "kosong")) {
                    ?>
                        <br />
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
                                    <th>Nilai Q</th>
                                    <th>Nilai R</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $j = 0;
                                foreach ($data_bahasa as $bahasa) :
                                ?>
                                    <tr>
                                        <td><?php echo $i;
                                            $i++; ?></td>
                                        <td>
                                            <?php
                                            if (in_array($bahasa['Num'], $id6)) {
                                                $idx = array_search($bahasa['Num'], $id6);
                                                $nilaibahasap[$j] = $nilaip6[$idx];
                                                $nilaibahasaq[$j] = $nilaiq6[$idx];
                                                $nilaibahasar[$j] = $nilair6[$idx];
                                                $checked[$j] = 'checked';
                                            } else {
                                                $nilaibahasap[$j] = '';
                                                $nilaibahasaq[$j] = '';
                                                $nilaibahasar[$j] = '';
                                                $checked[$j] = '';
                                            }
                                            ?>
                                            <input type="checkbox" name="bahasa_index[]" id="bahasa_index[]" value="<?= $j; ?>" <?= $checked[$j]; ?> />
                                            <input type="hidden" name="bahasa_id[]" id="bahasa_id[]" value="<?= $bahasa['Num']; ?>" />
                                        </td>
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
                                            <?php
                                            if ((isset($nilaibahasaq[$j])) && (!empty($nilaibahasaq[$j]))) {
                                                $typescore = $nilaibahasaq[$j];
                                            } else {
                                                if ($bahasa['LangType'] == "Da") {
                                                    $typescore = 1;
                                                } elseif ($bahasa['LangType'] == "Na") {
                                                    $typescore = 2;
                                                } elseif ($bahasa['LangType'] == "In") {
                                                    $typescore = 3;
                                                } else {
                                                    $typescore = 3;
                                                }
                                            }
                                            ?>
                                            <select name="nilaibahasa_q[]" id="nilaibahasa_q[]">
                                                <option value="4" <?= $typescore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $typescore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $typescore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $typescore == 1 ? 'selected' : ''; ?>>1</option>
                                            </select>
                                        </td>
                                        <td>
                                            <?php
                                            if ((isset($nilaibahasar[$j])) && (!empty($nilaibahasar[$j]))) {
                                                $skillscore = $nilaibahasar[$j];
                                            } else {
                                                if ($bahasa['VerbSkill'] == "Pasif") {
                                                    $skillscore = 2;
                                                } elseif ($bahasa['VerbSkill'] == "Aktif") {
                                                    $skillscore = 3;
                                                } else {
                                                    $skillscore = 1;
                                                }
                                            }
                                            ?>
                                            <select name="nilaibahasa_r[]" id="nilaibahasa_r[]">
                                                <option value="4" <?= $skillscore == 4 ? 'selected' : ''; ?>>4</option>
                                                <option value="3" <?= $skillscore == 3 ? 'selected' : ''; ?>>3</option>
                                                <option value="2" <?= $skillscore == 2 ? 'selected' : ''; ?>>2</option>
                                                <option value="1" <?= $skillscore == 1 ? 'selected' : ''; ?>>1</option>
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
                                <th>Jumlah Bahasa</th>
                                <th width="30px">&nbsp;</th>
                                <th>Nilai P</th>
                            </tr>
                            <tr>
                                <td><?= $jml_bahasa; ?></td>
                                <td>&nbsp;</td>
                                <td>
                                    <select name="nilaibahasa_p" id="nilaibahasa_p">
                                        <option value="4" <?= $jml_bahasa >= 4 ? 'selected' : ''; ?>>4</option>
                                        <option value="3" <?= $jml_bahasa == 3 ? 'selected' : ''; ?>>3</option>
                                        <option value="2" <?= $jml_bahasa <= 2 ? 'selected' : ''; ?>>2</option>
                                        <option value="1">1</option>
                                    </select>
                                </td>
                            </tr>
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