<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Tambah Karya Tulis di Bidang Keinsinyuran yang Dipublikasikan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/userfair51/tambahkartulproses" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Name" class="element">Judul Karya Tulis
                        <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="Name" name="Name" type="text" placeholder="Judul Karya Tulis..." />
                    </div><br />
                    <label for="Media" class="element">Nama Media Publikasi <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input class="form-control" id="Media" name="Media" type="text" placeholder="Nama Media Publikasi..." />
                    </div>
                    <br />
                    <label for="LocCity" class="element">Kota Media <span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <input class="form-control" id="LocCity" name="LocCity" type="text" placeholder="Kota Media..." />
                    </div>
                    <br />
                    <label for="LocCountry" class="element">Negara Media <span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <input class="form-control" id="LocCountry" name="LocCountry" type="text" placeholder="Negara Media..." />
                    </div>
                    <br />
                    <label for="Month" class="element">Bulan <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="Month" id="Month" class="form-control">
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
                    <label for="Year" class="element">Tahun <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="Year" id="Year" class="form-control">
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
                    <label for="Mediatype" class="element">Media Publikasi Tingkat</label>
                    <div class="element">
                        <select id="Mediatype" name="Mediatype" class="form-control">
                            <option value="Lok">Dimuat di Media Lokal</option>
                            <option value="Nas">Dimuat di Media Nasional</option>
                            <option value="Reg">Dimuat di Media Regional</option>
                            <option value="Int">Dimuat di Media Internasional</option>
                        </select>
                    </div>
                    <br />
                    <label for="Diffbenefit" class="element">Tingkat Kesulitan dan Manfaat</label>
                    <div class="element">
                        <select id="Diffbenefit" name="Diffbenefit" class="form-control">
                            <option value="ren">Rendah</option>
                            <option value="sed">Sedang</option>
                            <option value="tin">Tinggi</option>
                            <option value="stin">Sangat Tinggi</option>
                        </select>
                    </div>
                    <br />
                    <label for="Desc" class="element">Uraian Singkat Materi yang Dipublikasikan<span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <textarea class="form-control" id="Desc" name="Desc" placeholder="Deskripsi" placeholder="Uraian Singkat..."></textarea>
                    </div>
                    <br />
                    <label for="komp51" class="element">Kompetensi (Gunakan tombol ctrl + klik kiri mouse untuk memilih
                        lebih dari satu kompetensi)<span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select multiple class="form-control" name="komp51[]" id="komp51" size="10">
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
                                        echo "<option value='" . $komp['komp_code'] . "' title='" . $komp['komp_desc'] . "'>" . $komp['komp_code'] . " " . $komp['komp_desc'] . "</option>";
                                    }
                                }
                                $i++;
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <br />
                    <label for="File" class="element">Bukti Karya Tulis</label>
                    <div class="element">
                        <input class="form-control" id="File" name="File" type="file" />
                    </div>
                    <br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Karya Tulis</button>
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