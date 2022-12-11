<?= $this->extend('register/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Organisasi</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/register/tambahorgproses" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Name" class="element">Nama Organisasi <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input id="Name" name="Name" class="form-control" type="text" placeholder="Nama Organisasi..." />
                    </div>
                    <br>
                    <label for="Type" class="element">
                        <span class="required">Jenis Organisasi *</span>&nbsp; </label>
                    <div class="element">
                        <select name="Type" id="Type" class="form-control">
                            <option value="PII">Organisasi PII</option>
                            <option value="Ins">Organisasi Keinsinyuran Non PII</option>
                            <option value="Non">Organisasi Non Keinsinyuran</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="City" class="element">Kota Organisasi <span class="required"> *</span>&nbsp;
                        </label>
                        <div class="element">
                            <input id="City" name="City" class="form-control" type="text" placeholder="Kota Organisasi..." />
                        </div>
                        <br />
                        <label for="Country" class="element">Negara Organisasi <span class="required"> *</span>&nbsp;
                        </label>
                        <div class="element">
                            <input id="Country" name="Country" class="form-control" type="text" placeholder="Negara Organisasi..." />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="StartPeriodBulan" class="element">Bulan Mulai <span class="required"> *</span>&nbsp;
                        </label>
                        <div class="element">
                            <select name="StartPeriodBulan" id="StartPeriodBulan" class="form-control">
                                <option value="Januari">Januari</option>
                                <option value="Februari">Februari</option>
                                <option value="Maret">Maret</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                                <option value="Desember">Desember</option>
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
                                    if ($tahun1 == $now) {
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
                                <option value="Januari">Januari</option>
                                <option value="Februari">Februari</option>
                                <option value="Maret">Maret</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="Juli">Juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                                <option value="Desember">Desember</option>
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
                                    if ($tahun1 == $now) {
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
                            <option value="sd5">1-5 Tahun</option>
                            <option value="smp10">6-10 Tahun</option>
                            <option value="smp15">11-15 Tahun</option>
                            <option value="lbih15">Lebih dari 15 Tahun</option>
                        </select>
                    </div>
                    <br>
                    <label for="Position" class="element">
                        Jabatan Dalam Organisasi <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="Position" id="Position" class="form-control">
                            <option value="Bias">Anggota Biasa</option>
                            <option value="Peng">Anggota Pengurus</option>
                            <option value="Pimp">Pimpinan</option>
                        </select>
                    </div>
                    <br>
                    <label for="OrgLevel" class="element">
                        Tingkat Organisasi <span class="required"> *</span>&nbsp;</label>
                    <div class="element">
                        <select name="OrgLevel" id="OrgLevel" class="form-control">
                            <option value="Loc">Organisasi Lokal (bukan Nasional)</option>
                            <option value="Nas">Organisasi Nasional</option>
                            <option value="Reg">Organisasi Regional</option>
                            <option value="Int">Organisasi Internasional</option>
                        </select>
                    </div>
                    <br>
                    <label for="OrgScp" class="element">
                        Lingkup Kegiatan Organisasi<span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="OrgScp" id="OrgScp" class="form-control">
                            <option value="Aso">Asosiasi Profesi</option>
                            <option value="Pem">Lembaga Pemerintah</option>
                            <option value="Pen">Lembaga Pendidikan</option>
                            <option value="Neg">Badan Usaha Milik Negara</option>
                            <option value="Swa">Badan Usaha Swasta</option>
                            <option value="Mas">Organisasi Kemasyarakatan</option>
                            <option value="Lai">Lain-lain</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="Desc" class="element">Uraian Aktifitas Dalam Organisasi<span class="required">
                                *</span>&nbsp;</label>
                        <div class="element">
                            <textarea id="Desc" name="Desc" class="form-control" placeholder="Uraian Aktifitas Dalam Organisasi..."></textarea>
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