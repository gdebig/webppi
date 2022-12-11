<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Tambah Organisasi</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/userfair13/tambahorgproses" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Name" class="element">Nama Organisasi <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input id="Name" name="Name" class="form-control" type="text" placeholder="Nama Organisasi..." value="<?= set_value('Name') ?>" />
                    </div>
                    <br>
                    <label for="Type" class="element">
                        <span class="required">Jenis Organisasi *</span>&nbsp; </label>
                    <div class="element">
                        <select name="Type" id="Type" class="form-control">
                            <option value="PII" <?php echo set_value('Type') == "PII" ? "selected" : "" ?>>Organisasi PII
                            </option>
                            <option value="Ins" <?php echo set_value('Type') == "Ins" ? "selected" : "" ?>>Organisasi
                                Keinsinyuran Non PII</option>
                            <option value="Non" <?php echo set_value('Type') == "Non" ? "selected" : "" ?>>Organisasi Non
                                Keinsinyuran</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="City" class="element">Kota Organisasi <span class="required"> *</span>&nbsp;
                        </label>
                        <div class="element">
                            <input id="City" name="City" class="form-control" type="text" placeholder="Kota Organisasi..." value="<?php echo set_value('City'); ?>" />
                        </div>
                        <br />
                        <label for="Country" class="element">Negara Organisasi <span class="required"> *</span>&nbsp;
                        </label>
                        <div class="element">
                            <input id="Country" name="Country" class="form-control" type="text" placeholder="Negara Organisasi..." value="<?php echo set_value('Country'); ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="StartPeriodBulan" class="element">Bulan Mulai <span class="required"> *</span>&nbsp;
                        </label>
                        <div class="element">
                            <select name="StartPeriodBulan" id="StartPeriodBulan" class="form-control">
                                <option value="Januari" <?php echo set_value('StartPeriodBulan') == "Januari" ? "selected" : "" ?>>Januari
                                </option>
                                <option value="Februari" <?php echo set_value('StartPeriodBulan') == "Februari" ? "selected" : "" ?>>Februari
                                </option>
                                <option value="Maret" <?php echo set_value('StartPeriodBulan') == "Maret" ? "selected" : "" ?>>Maret
                                </option>
                                <option value="April" <?php echo set_value('StartPeriodBulan') == "April" ? "selected" : "" ?>>April
                                </option>
                                <option value="Mei" <?php echo set_value('StartPeriodBulan') == "Mei" ? "selected" : "" ?>>Mei</option>
                                <option value="Juni" <?php echo set_value('StartPeriodBulan') == "Juni" ? "selected" : "" ?>>Juni</option>
                                <option value="Juli" <?php echo set_value('StartPeriodBulan') == "Juli" ? "selected" : "" ?>>Juli</option>
                                <option value="Agustus" <?php echo set_value('StartPeriodBulan') == "Agustus" ? "selected" : "" ?>>Agustus
                                </option>
                                <option value="September" <?php echo set_value('StartPeriodBulan') == "September" ? "selected" : "" ?>>
                                    September</option>
                                <option value="Oktober" <?php echo set_value('StartPeriodBulan') == "Oktober" ? "selected" : "" ?>>Oktober
                                </option>
                                <option value="November" <?php echo set_value('StartPeriodBulan') == "November" ? "selected" : "" ?>>November
                                </option>
                                <option value="Desember" <?php echo set_value('StartPeriodBulan') == "Desember" ? "selected" : "" ?>>Desember
                                </option>
                            </select>
                        </div>
                        <br />
                        <label for="StartPeriodYear" class="element">Tahun Mulai <span class="required"> *</span>&nbsp;
                        </label>
                        <div class="element">
                            <select name="StartPeriodYear" id="StartPeriodYear" class="form-control">
                                <?php
                                $lastyear = date("Y") + 10;
                                $now = date("Y");
                                for ($tahun1 = 1901; $tahun1 <= $lastyear; $tahun1++) {
                                    if ($tahun1 == set_value('StartPeriodYear')) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $tahun1 . "' " . $selected . ">" . $tahun1 . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <br />
                        <label for="EndPeriodBulan" class="element">Bulan Berakhir <span class="required">
                                *</span>&nbsp; </label>
                        <div class="element">
                            <select name="EndPeriodBulan" id="EndPeriodBulan" class="form-control">
                                <option value="Januari" <?php echo set_value('EndPeriodBulan') == "Januari" ? "selected" : "" ?>>Januari
                                </option>
                                <option value="Februari" <?php echo set_value('EndPeriodBulan') == "Februari" ? "selected" : "" ?>>Februari
                                </option>
                                <option value="Maret" <?php echo set_value('EndPeriodBulan') == "Maret" ? "selected" : "" ?>>Maret</option>
                                <option value="April" <?php echo set_value('EndPeriodBulan') == "April" ? "selected" : "" ?>>April</option>
                                <option value="Mei" <?php echo set_value('EndPeriodBulan') == "Mei" ? "selected" : "" ?>>
                                    Mei</option>
                                <option value="Juni" <?php echo set_value('EndPeriodBulan') == "Juni" ? "selected" : "" ?>>Juni</option>
                                <option value="Juli" <?php echo set_value('EndPeriodBulan') == "Juli" ? "selected" : "" ?>>Juli</option>
                                <option value="Agustus" <?php echo set_value('EndPeriodBulan') == "Agustus" ? "selected" : "" ?>>Agustus
                                </option>
                                <option value="September" <?php echo set_value('EndPeriodBulan') == "September" ? "selected" : "" ?>>September
                                </option>
                                <option value="Oktober" <?php echo set_value('EndPeriodBulan') == "Oktober" ? "selected" : "" ?>>Oktober
                                </option>
                                <option value="November" <?php echo set_value('EndPeriodBulan') == "November" ? "selected" : "" ?>>November
                                </option>
                                <option value="Desember" <?php echo set_value('EndPeriodBulan') == "Desember" ? "selected" : "" ?>>Desember
                                </option>
                            </select>
                        </div>
                        <br />
                        <label for="EndPeriodYear" class="element">Tahun Berakhir <span class="required"> *</span>&nbsp;
                        </label>
                        <div class="element">
                            <select name="EndPeriodYear" id="EndPeriodYear" class="form-control">
                                <?php
                                $lastyear = date("Y") + 10;
                                $now = date("Y");
                                for ($tahun1 = 1901; $tahun1 <= $lastyear; $tahun1++) {
                                    if ($tahun1 == set_value('EndPeriodYear')) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo "<option value='" . $tahun1 . "' " . $selected . ">" . $tahun1 . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <label for="Period" class="element">
                        Sudah Berapa Lama Menjadi Anggota? <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="Period" id="Period" class="form-control">
                            <option value="sd5" <?php echo set_value("Period") == "sd5" ? "selected" : ""; ?>>1-5 Tahun
                            </option>
                            <option value="smp10" <?php echo set_value("Period") == "smp10" ? "selected" : ""; ?>>6-10
                                Tahun</option>
                            <option value="smp15" <?php echo set_value("Period") == "smp15" ? "selected" : ""; ?>>11-15
                                Tahun</option>
                            <option value="lbih15" <?php echo set_value("Period") == "lbih15" ? "selected" : ""; ?>>Lebih
                                dari 15 Tahun</option>
                        </select>
                    </div>
                    <br>
                    <label for="Position" class="element">
                        Jabatan Dalam Organisasi <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="Position" id="Position" class="form-control">
                            <option value="Bias" <?php echo set_value("Position") == "Bias" ? "selected" : ""; ?>>Anggota
                                Biasa</option>
                            <option value="Peng" <?php echo set_value("Position") == "Peng" ? "selected" : ""; ?>>Anggota
                                Pengurus</option>
                            <option value="Pimp" <?php echo set_value("Position") == "Pimp" ? "selected" : ""; ?>>
                                Pimpinan</option>
                        </select>
                    </div>
                    <br>
                    <label for="OrgLevel" class="element">
                        Tingkat Organisasi <span class="required"> *</span>&nbsp;</label>
                    <div class="element">
                        <select name="OrgLevel" id="OrgLevel" class="form-control">
                            <option value="Loc" <?php echo set_value("OrgLevel") == "Loc" ? "selected" : ""; ?>>
                                Organisasi Lokal (bukan Nasional)</option>
                            <option value="Nas" <?php echo set_value("OrgLevel") == "Nas" ? "selected" : ""; ?>>
                                Organisasi Nasional</option>
                            <option value="Reg" <?php echo set_value("OrgLevel") == "Reg" ? "selected" : ""; ?>>
                                Organisasi Regional</option>
                            <option value="Int" <?php echo set_value("OrgLevel") == "Int" ? "selected" : ""; ?>>
                                Organisasi Internasional</option>
                        </select>
                    </div>
                    <br>
                    <label for="OrgScp" class="element">
                        Lingkup Kegiatan Organisasi<span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="OrgScp" id="OrgScp" class="form-control">
                            <option value="Aso" <?php echo set_value("OrgScp") == "Aso" ? "selected" : ""; ?>>Asosiasi
                                Profesi</option>
                            <option value="Pem" <?php echo set_value("OrgScp") == "Pem" ? "selected" : ""; ?>>Lembaga
                                Pemerintah</option>
                            <option value="Pen" <?php echo set_value("OrgScp") == "Pen" ? "selected" : ""; ?>>Lembaga
                                Pendidikan</option>
                            <option value="Neg" <?php echo set_value("OrgScp") == "Neg" ? "selected" : ""; ?>>Badan Usaha
                                Milik Negara</option>
                            <option value="Swa" <?php echo set_value("OrgScp") == "Swa" ? "selected" : ""; ?>>Badan Usaha
                                Swasta</option>
                            <option value="Mas" <?php echo set_value("OrgScp") == "Mas" ? "selected" : ""; ?>>Organisasi
                                Kemasyarakatan</option>
                            <option value="Lai <?php echo set_value("OrgScp") == "Lai" ? "selected" : ""; ?>">Lain-lain
                            </option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="Desc" class="element">Uraian Aktifitas Dalam Organisasi<span class="required">
                                *</span>&nbsp;</label>
                        <div class="element">
                            <textarea id="Desc" name="Desc" class="form-control" placeholder="Uraian Aktifitas Dalam Organisasi..."><?php echo set_value('Desc'); ?></textarea>
                        </div>
                    </div>
                    <br />
                    <label for="komp13" class="element">Klaim Kompetensi (Gunakan tombol ctrl + klik kiri mouse untuk
                        memilih
                        lebih dari satu kompetensi)<span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select multiple class="form-control" name="komp13[]" id="komp13" size="10">
                            <?php
                            $i = 1;
                            $prev_cat = array();

                            foreach ($data_komp as $komp) :
                                $j = $i - 1;
                                $prev_cat[$i] = $komp['komp_cat'];
                                if (!empty($prev_cat) && ($j != 0)) {
                                    if ($prev_cat[$i] != $prev_cat[$j]) {
                                        echo "</optgroup>";
                                    }
                                }
                                if ($komp['komp_parent'] == 'y') {
                                    echo "<optgroup label='" . $komp['komp_code'] . " " . $komp['komp_desc'] . "'>";
                                } else {
                                    if ($i == 1) {
                                    } else {
                                        if (!empty(set_value("komp13"))) {
                                            $kompselected = array_search($komp['komp_code'], set_value("komp13")) !== false ? 'selected' : '';
                                        } else {
                                            $kompselected = '';
                                        }
                                        echo "<option value='" . $komp['komp_code'] . "' title='" . $komp['komp_desc'] . "' " . $kompselected . ">" . $komp['komp_code'] . " " . $komp['komp_desc'] . "</option>";
                                    }
                                }
                                $i++;
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <br />
                    <label for="File" class="element">Bukti Keikutsertaan Organisasi</label>
                    <div class="element">
                        <input class="form-control" id="File" name="File" type="file" />
                    </div>
                    <br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Organisasi</button>
                        </div>
                        <div class="col">
                            <button type="submit" name="submit" value="batal" class="btn btn-block btn-danger col">Batal</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>