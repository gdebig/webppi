<?= $this->extend('register/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Organisasi</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/register/ubahorgproses" method="post" enctype="multipart/form-data">
                <input type="hidden" id="Num" name="Num" value=<?= $Num; ?>>
                <input type="hidden" id='filename' name='filename' value=<?= $File; ?>>
                <div class="form-group">
                    <label for="Name" class="element">Nama Organisasi <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input id="Name" name="Name" class="form-control" type="text" placeholder="Nama Organisasi..." value="<?= $Name ?>" />
                    </div>
                    <br>
                    <label for="Type" class="element">
                        <span class="required">Jenis Organisasi *</span>&nbsp; </label>
                    <div class="element">
                        <select name="Type" id="Type" class="form-control">
                            <option value="PII" <?php echo $Type == "PII" ? "selected" : "" ?>>Organisasi PII</option>
                            <option value="Ins" <?php echo $Type == "Ins" ? "selected" : "" ?>>Organisasi Keinsinyuran
                                Non PII</option>
                            <option value="Non" <?php echo $Type == "Non" ? "selected" : "" ?>>Organisasi Non
                                Keinsinyuran</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="City" class="element">Kota Organisasi <span class="required"> *</span>&nbsp;
                        </label>
                        <div class="element">
                            <input id="City" name="City" class="form-control" type="text" placeholder="Kota Organisasi..." value="<?php echo $City; ?>" />
                        </div>
                        <br />
                        <label for="Country" class="element">Negara Organisasi <span class="required"> *</span>&nbsp;
                        </label>
                        <div class="element">
                            <input id="Country" name="Country" class="form-control" type="text" placeholder="Negara Organisasi..." value="<?php echo $Country; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="StartPeriodBulan" class="element">Bulan Mulai <span class="required"> *</span>&nbsp;
                        </label>
                        <div class="element">
                            <select name="StartPeriodBulan" id="StartPeriodBulan" class="form-control">
                                <option value="Januari" <?php echo $StartPeriodBulan == "Januari" ? "selected" : "" ?>>
                                    Januari</option>
                                <option value="Februari" <?php echo $StartPeriodBulan == "Februari" ? "selected" : "" ?>>
                                    Februari</option>
                                <option value="Maret" <?php echo $StartPeriodBulan == "Maret" ? "selected" : "" ?>>Maret
                                </option>
                                <option value="April" <?php echo $StartPeriodBulan == "April" ? "selected" : "" ?>>April
                                </option>
                                <option value="Mei" <?php echo $StartPeriodBulan == "Mei" ? "selected" : "" ?>>Mei
                                </option>
                                <option value="Juni" <?php echo $StartPeriodBulan == "Juni" ? "selected" : "" ?>>Juni
                                </option>
                                <option value="Juli" <?php echo $StartPeriodBulan == "Juli" ? "selected" : "" ?>>Juli
                                </option>
                                <option value="Agustus" <?php echo $StartPeriodBulan == "Agustus" ? "selected" : "" ?>>
                                    Agustus</option>
                                <option value="September" <?php echo $StartPeriodBulan == "September" ? "selected" : "" ?>>September</option>
                                <option value="Oktober" <?php echo $StartPeriodBulan == "Oktober" ? "selected" : "" ?>>
                                    Oktober</option>
                                <option value="November" <?php echo $StartPeriodBulan == "November" ? "selected" : "" ?>>
                                    November</option>
                                <option value="Desember" <?php echo $StartPeriodBulan == "Desember" ? "selected" : "" ?>>
                                    Desember</option>
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
                                    if ($tahun1 == $StartPeriodYear) {
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
                                <option value="Januari" <?php echo $EndPeriodBulan == "Januari" ? "selected" : "" ?>>
                                    Januari</option>
                                <option value="Februari" <?php echo $EndPeriodBulan == "Februari" ? "selected" : "" ?>>
                                    Februari</option>
                                <option value="Maret" <?php echo $EndPeriodBulan == "Maret" ? "selected" : "" ?>>Maret
                                </option>
                                <option value="April" <?php echo $EndPeriodBulan == "April" ? "selected" : "" ?>>April
                                </option>
                                <option value="Mei" <?php echo $EndPeriodBulan == "Mei" ? "selected" : "" ?>>Mei</option>
                                <option value="Juni" <?php echo $EndPeriodBulan == "Juni" ? "selected" : "" ?>>Juni
                                </option>
                                <option value="Juli" <?php echo $EndPeriodBulan == "Juli" ? "selected" : "" ?>>Juli
                                </option>
                                <option value="Agustus" <?php echo $EndPeriodBulan == "Agustus" ? "selected" : "" ?>>
                                    Agustus</option>
                                <option value="September" <?php echo $EndPeriodBulan == "September" ? "selected" : "" ?>>
                                    September</option>
                                <option value="Oktober" <?php echo $EndPeriodBulan == "Oktober" ? "selected" : "" ?>>
                                    Oktober</option>
                                <option value="November" <?php echo $EndPeriodBulan == "November" ? "selected" : "" ?>>
                                    November</option>
                                <option value="Desember" <?php echo $EndPeriodBulan == "Desember" ? "selected" : "" ?>>
                                    Desember</option>
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
                                    if ($tahun1 == $EndPeriodYear) {
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
                            <option value="sd5" <?php echo $Period == "sd5" ? "selected" : ""; ?>>1-5 Tahun</option>
                            <option value="smp10" <?php echo $Period == "smp10" ? "selected" : ""; ?>>6-10 Tahun</option>
                            <option value="smp15" <?php echo $Period == "smp15" ? "selected" : ""; ?>>11-15 Tahun
                            </option>
                            <option value="lbih15" <?php echo $Period == "lbih15" ? "selected" : ""; ?>>Lebih dari 15
                                Tahun</option>
                        </select>
                    </div>
                    <br>
                    <label for="Position" class="element">
                        Jabatan Dalam Organisasi <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="Position" id="Position" class="form-control">
                            <option value="Bias" <?php echo $Position == "Bias" ? "selected" : ""; ?>>Anggota Biasa
                            </option>
                            <option value="Peng" <?php echo $Position == "Peng" ? "selected" : ""; ?>>Anggota Pengurus
                            </option>
                            <option value="Pimp" <?php echo $Position == "Pimp" ? "selected" : ""; ?>>Pimpinan</option>
                        </select>
                    </div>
                    <br>
                    <label for="OrgLevel" class="element">
                        Tingkat Organisasi <span class="required"> *</span>&nbsp;</label>
                    <div class="element">
                        <select name="OrgLevel" id="OrgLevel" class="form-control">
                            <option value="Loc" <?php echo $OrgLevel == "Loc" ? "selected" : ""; ?>>Organisasi Lokal
                                (bukan Nasional)</option>
                            <option value="Nas" <?php echo $OrgLevel == "Nas" ? "selected" : ""; ?>>Organisasi Nasional
                            </option>
                            <option value="Reg" <?php echo $OrgLevel == "Reg" ? "selected" : ""; ?>>Organisasi Regional
                            </option>
                            <option value="Int" <?php echo $OrgLevel == "Int" ? "selected" : ""; ?>>Organisasi
                                Internasional</option>
                        </select>
                    </div>
                    <br>
                    <label for="OrgScp" class="element">
                        Lingkup Kegiatan Organisasi<span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="OrgScp" id="OrgScp" class="form-control">
                            <option value="Aso" <?php echo $OrgScp == "Aso" ? "selected" : ""; ?>>Asosiasi
                                Profesfa-inverse</option>
                            <option value="Pem" <?php echo $OrgScp == "Pem" ? "selected" : ""; ?>>Lembaga Pemerintah
                            </option>
                            <option value="Pen" <?php echo $OrgScp == "Pen" ? "selected" : ""; ?>>Lembaga Pendidikan
                            </option>
                            <option value="Neg" <?php echo $OrgScp == "Neg" ? "selected" : ""; ?>>Badan Usaha Milik
                                Negara</option>
                            <option value="Swa" <?php echo $OrgScp == "Swa" ? "selected" : ""; ?>>Badan Usaha Swasta
                            </option>
                            <option value="Mas" <?php echo $OrgScp == "Mas" ? "selected" : ""; ?>>Organisasi
                                Kemasyarakatan</option>
                            <option value="Lai <?php echo $OrgScp == "Lai" ? "selected" : ""; ?>">Lain-lain</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="Desc" class="element">Uraian Aktifitas Dalam Organisasi<span class="required">
                                *</span>&nbsp;</label>
                        <div class="element">
                            <textarea id="Desc" name="Desc" class="form-control" placeholder="Uraian Aktifitas Dalam Organisasi..."><?php echo $Desc; ?></textarea>
                        </div>
                    </div>
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
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Ubah
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