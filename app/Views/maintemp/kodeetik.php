<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">

                <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                <?php endif; ?>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <!--UserFair21-->
                <?php if (isset($data_etik) && ($data_etik != "kosong")) {
                ?>
                    <h3>II.1. Referensi Kode Etik dan Etika Profesi (#) (W1)</h3>
                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Check</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th>Email</th>
                                <th>Hubungan</th>
                                <th>Nilai Q</th>
                                <th>Nilai R</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_etik as $etik) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><input type="checkbox" name="etik_id[]" id="etik_id[]" value="<?= $etik['Num']; ?>" /></td>
                                    <td><?= $etik['Name']; ?></td>
                                    <td><?= $etik['Addr'] . "<br />" . $etik['City'] . ', ' . $etik['Prov'] . ', ' . $etik['Country']; ?>
                                    </td>
                                    <td><?= $etik['Pnum']; ?></td>
                                    <td><?= $etik['Email']; ?></td>
                                    <td><?= $etik['Relation']; ?></td>
                                    <td>
                                        <select name="nilaietik_q[]" id="nilaietik_q[]">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nilaietik_r[]" id="nilaietik_r[]">
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
                    <table>
                        <tr>
                            <th>Jumlah Referensi</th>
                            <th width="30px">&nbsp;</th>
                            <th>Nilai P</th>
                        </tr>
                        <tr>
                            <td><?= $jumlah_etik; ?></td>
                            <td>&nbsp;</td>
                            <td>
                                <select name="nilaietik_p" id="nilaietik_p">
                                    <option value="4" <?= $jumlah_etik >= 4 ? 'selected' : ''; ?>>4</option>
                                    <option value="3" <?= $jumlah_etik == 3 ? 'selected' : ''; ?>>3</option>
                                    <option value="2" <?= $jumlah_etik == 2 ? 'selected' : ''; ?>>2</option>
                                    <option value="1" <?= $jumlah_etik == 1 ? 'selected' : ''; ?>>1</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                <?php } ?>
                <br />
                <!-- UserFair22 -->
                <?php if (isset($data_pendapat) && ($data_pendapat != "kosong")) {
                ?>
                    <h3>II.2. Pengertian, Pendapat dan Pengalaman Sendiri (W1)</h3>
                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Check</th>
                                <th>Pendapat</th>
                                <th>Nilai P</th>
                                <th>Nilai Q</th>
                                <th>Nilai R</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_pendapat as $dapat) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><input type="checkbox" name="dapat_id[]" id="dapat_id[]" value="<?= $dapat['Num']; ?>" /></td>
                                    <td><?= $dapat['Desc']; ?></td>
                                    <td>
                                        <select name="nilaidapat_p[]" id="nilaidapat_p[]">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nilaidapat_q[]" id="nilaidapat_q[]">
                                            <option value="4">4</option>
                                            <option value="3">3</option>
                                            <option value="2">2</option>
                                            <option value="1">1</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="nilaidapat_r[]" id="nilaidapat_r[]">
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
                            foreach ($data_org as $org) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><input type="checkbox" name="org_id[]" id="org_id[]" value="<?= $org['Num']; ?>" /></td>
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
                                        if ($org['Position'] == "Bias") {
                                            $posscore = 2;
                                        } elseif ($org['Position'] == "Peng") {
                                            $posscore = 3;
                                        } elseif ($org['Position'] == "Pimp") {
                                            $posscore = 4;
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
                                        if ($org['OrgLevel'] == "Lok") {
                                            $orgscore = 1;
                                        } elseif ($org['OrgLevel'] == "Nas") {
                                            $orgscore = 2;
                                        } elseif ($org['OrgLevel'] == "Reg") {
                                            $orgscore = 3;
                                        } elseif ($org['OrgLevel'] == "Int") {
                                            $orgscore = 4;
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
                                <select name="nilaiorg_p[]" id="nilaiorg_p[]">
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
                            foreach ($data_harga as $penghargaan) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><input type="checkbox" name="penghargaan_id[]" id="penghargaan_id[]" value="<?= $penghargaan['Num']; ?>" /></td>
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
                                        if ($penghargaan['Level'] == 'Mud') {
                                            $levelscore = 2;
                                        } elseif ($penghargaan['Level'] == 'Mad') {
                                            $levelscore = 3;
                                        } elseif ($penghargaan['Level'] == 'Uta') {
                                            $levelscore = 4;
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
                                        if ($penghargaan['InstituteType'] == 'Lok') {
                                            $typescore = 1;
                                        } elseif ($penghargaan['InstituteType'] == 'Nas') {
                                            $typescore = 2;
                                        } elseif ($penghargaan['InstituteType'] == 'Reg') {
                                            $typescore = 3;
                                        } elseif ($penghargaan['InstituteType'] == 'Int') {
                                            $typescore = 4;
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
                            endforeach
                            ?>
                        </tbody>
                    </table>
                <?php } ?>
                <!--UserFair16-->
                <?php if (isset($data_latih) && ($data_latih != "kosong")) {
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
                            foreach ($data_latih as $latih) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><input type="checkbox" name="latih_id[]" id="latih_id[]" value="<?= $latih['Num']; ?>" /></td>
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
                                        if ($latih['Level'] == 'Dasar') {
                                            $levscore = 2;
                                        } elseif ($latih['Level'] == 'Lanjut') {
                                            $levscore = 3;
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