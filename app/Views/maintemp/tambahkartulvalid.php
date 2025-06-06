<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Tambah Karya Tulis di Bidang Keinsinyuran yang Dipublikasikan</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/userfair51/tambahkartulproses" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Name" class="element">Judul Karya Tulis
                        <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="Name" name="Name" type="text" placeholder="Judul Karya Tulis..." value="<?= set_value('Name'); ?>" />
                    </div><br />
                    <label for="Media" class="element">Nama Media Publikasi <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input class="form-control" id="Media" name="Media" type="text" placeholder="Nama Media Publikasi..." value="<?= set_value('Media'); ?>" />
                    </div>
                    <br />
                    <label for=" LocCity" class="element">Kota Media <span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <input class="form-control" id="LocCity" name="LocCity" type="text" placeholder="Kota Media..." value="<?= set_value('LocCity'); ?>" />
                    </div>
                    <br />
                    <label for=" LocCountry" class="element">Negara Media <span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <input class="form-control" id="LocCountry" name="LocCountry" type="text" placeholder="Negara Media..." value="<?= set_value('LocCountry'); ?>" />
                    </div>
                    <br />
                    <label for=" Month" class="element">Bulan <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="Month" id="Month" class="form-control">
                            <option value="Januari" <?php echo set_value('Month') == 'Januari' ? 'selected' : ''; ?>>
                                Januari
                            </option>
                            <option value="Februari" <?php echo set_value('Month') == 'Februari' ? 'selected' : ''; ?>>
                                Februari
                            </option>
                            <option value="Maret" <?php echo set_value('Month') == 'Maret' ? 'selected' : ''; ?>>Maret
                            </option>
                            <option value="April" <?php echo set_value('Month') == 'April' ? 'selected' : ''; ?>>April
                            </option>
                            <option value="Mei" <?php echo set_value('Month') == 'Mei' ? 'selected' : ''; ?>>
                                Mei</option>
                            <option value="Juni" <?php echo set_value('Month') == 'Juni' ? 'selected' : ''; ?>>Juni
                            </option>
                            <option value="Juli" <?php echo set_value('Month') == 'Juli' ? 'selected' : ''; ?>>Juli
                            </option>
                            <option value="Agustus" <?php echo set_value('Month') == 'Agustus' ? 'selected' : ''; ?>>
                                Agustus
                            </option>
                            <option value="September" <?php echo set_value('Month') == 'September' ? 'selected' : ''; ?>>
                                September
                            </option>
                            <option value="Oktober" <?php echo set_value('Month') == 'Oktober' ? 'selected' : ''; ?>>
                                Oktober
                            </option>
                            <option value="November" <?php echo set_value('Month') == 'November' ? 'selected' : ''; ?>>
                                November
                            </option>
                            <option value="Desember" <?php echo set_value('Month') == 'Desember' ? 'selected' : ''; ?>>
                                Desember
                            </option>
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
                                if ($tahun1 == set_value('Year')) {
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
                            <option value="Lok" <?php echo set_value('Mediatype') == 'Lok' ? 'selected' : ''; ?>>Dimuat
                                di Media Lokal</option>
                            <option value="Nas" <?php echo set_value('Mediatype') == 'Nas' ? 'selected' : ''; ?>>Dimuat
                                di Media Nasional</option>
                            <option value="Reg" <?php echo set_value('Mediatype') == 'Reg' ? 'selected' : ''; ?>>Dimuat
                                di Media Regional</option>
                            <option value="Int" <?php echo set_value('Mediatype') == 'Int' ? 'selected' : ''; ?>>Dimuat
                                di Media Internasional</option>
                        </select>
                    </div>
                    <br />
                    <label for="Diffbenefit" class="element">Tingkat Kesulitan dan Manfaat</label>
                    <div class="element">
                        <select id="Diffbenefit" name="Diffbenefit" class="form-control">
                            <option value="ren" <?php echo set_value('Diffbenefit') == 'ren' ? 'selected' : ''; ?>>Rendah
                            </option>
                            <option value="sed" <?php echo set_value('Diffbenefit') == 'sed' ? 'selected' : ''; ?>>Sedang
                            </option>
                            <option value="tin" <?php echo set_value('Diffbenefit') == 'tin' ? 'selected' : ''; ?>>Tinggi
                            </option>
                            <option value="stin" <?php echo set_value('Diffbenefit') == 'stin' ? 'selected' : ''; ?>>
                                Sangat
                                Tinggi</option>
                        </select>
                    </div>
                    <br />
                    <label for="Desc" class="element">Uraian Singkat Materi yang Dipublikasikan<span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <textarea class="form-control" id="Desc" name="Desc" placeholder="Deskripsi" placeholder="Uraian Singkat..."><?= set_value('Desc'); ?></textarea>
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
                                        if (!empty(set_value("komp51"))) {
                                            $kompselected = array_search($komp['komp_code'], set_value("komp51")) !== false ? 'selected' : '';
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