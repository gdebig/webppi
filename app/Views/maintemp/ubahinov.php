<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Ubah Karya Temuan/Inovasi/Paten dan Implementasi Teknologi Baru</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/userfair54/ubahinovproses" method="post" enctype="multipart/form-data">
                <input type="hidden" id="Num" name="Num" value="<?= $Num; ?>" />
                <input type="hidden" id="filename" name="filename" value="<?= $File; ?>" />
                <div class="form-group">
                    <label for="Name" class="element">Judul / Nama Karya Temuan/Inovasi/Paten dan Implementasi Teknologi
                        Baru <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input class="form-control" id="Name" name="Name" type="text" placeholder="Judul / Nama Karya Temuan/Inovasi/Paten dan Implementasi Teknologi Baru..." value="<?= $Name; ?>" />
                    </div>
                    <br />
                    <label for="Desc" class="element">Uraian Singkat <span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <textarea class="form-control" id="Desc" name="Desc" placeholder="Deskripsi" placeholder="Uraian Singkat..."><?= $Desc; ?></textarea>
                    </div>
                    <br />
                    <label for="Month" class="element">Bulan <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="Month" id="Month" class="form-control">
                            <option value="1" <?= $Month == '1' ? 'selected' : ''; ?>>Januari</option>
                            <option value="2" <?= $Month == '2' ? 'selected' : ''; ?>>Februari</option>
                            <option value="3" <?= $Month == '3' ? 'selected' : ''; ?>>Maret</option>
                            <option value="4" <?= $Month == '4' ? 'selected' : ''; ?>>April</option>
                            <option value="5" <?= $Month == '5' ? 'selected' : ''; ?>>Mei</option>
                            <option value="6" <?= $Month == '6' ? 'selected' : ''; ?>>Juni</option>
                            <option value="7" <?= $Month == '7' ? 'selected' : ''; ?>>Juli</option>
                            <option value="8" <?= $Month == '8' ? 'selected' : ''; ?>>Agustus</option>
                            <option value="9" <?= $Month == '9' ? 'selected' : ''; ?>>September</option>
                            <option value="10" <?= $Month == '10' ? 'selected' : ''; ?>>Oktober</option>
                            <option value="11" <?= $Month == '11' ? 'selected' : ''; ?>>November
                            </option>
                            <option value="12" <?= $Month == '12' ? 'selected' : ''; ?>>Desember
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
                                if ($tahun1 == $Year) {
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
                    <label for="Publication" class="element">Media Publikasi Karya (Kalau Ada)</label>
                    <div class="element">
                        <input class="form-control" id="Publication" name="Publication" type="text" placeholder="Media Publikasi Karya..." value="<?= $Publication; ?>" />
                    </div>
                    <br />
                    <label for="PubLevel" class="element">Media Publikasi Tingkat</label>
                    <div class="element">
                        <select id="PubLevel" name="PubLevel" class="form-control">
                            <option value="Lok" <?= $PubLevel == 'Lok' ? 'selected' : ''; ?>>
                                Dipublikasikan di Media Lokal</option>
                            <option value="Nas" <?= $PubLevel == 'Nas' ? 'selected' : ''; ?>>
                                Dipublikasikan di Media Nasional</option>
                            <option value="Int" <?= $PubLevel == 'Int' ? 'selected' : ''; ?>>
                                Dipublikasikan di Media Internasional</option>
                        </select>
                    </div>
                    <br />
                    <label for="DiffBenefit" class="element">Tingkat Kesulitan dan Manfaatnya Karya Temuan/Inovasi/Paten
                        dan Implementasi Teknologi Baru</label>
                    <div class="element">
                        <select id="DiffBenefit" name="DiffBenefit" class="form-control">
                            <option value="ren" <?php echo $DiffBenefit == 'ren' ? 'selected' : ''; ?>>Rendah
                            </option>
                            <option value="sed" <?php echo $DiffBenefit == 'sed' ? 'selected' : ''; ?>>Sedang
                            </option>
                            <option value="tin" <?php echo $DiffBenefit == 'tin' ? 'selected' : ''; ?>>Tinggi
                            </option>
                            <option value="stin" <?php echo $DiffBenefit == 'stin' ? 'selected' : ''; ?>>
                                Sangat
                                Tinggi</option>
                        </select>
                    </div>
                    <br />
                    <label for="komp54" class="element">Kompetensi (Gunakan tombol ctrl + klik kiri mouse untuk memilih
                        lebih dari satu kompetensi)<span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select multiple class="form-control" name="komp54[]" id="komp54" size="10">
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
                                        $kompselected = array_search($komp['komp_code'], $datakomp) !== false ? 'selected' : '';
                                        echo "<option value='" . $komp['komp_code'] . "' title='" . $komp['komp_desc'] . "' " . $kompselected . ">" . $komp['komp_code'] . " " . $komp['komp_desc'] . "</option>";
                                    }
                                }
                                $i++;
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <br />
                    <label for="File" class="element">Bukti Temuan/Inovasi/Paten</label>
                    <div class="element">
                        <input class="form-control" id="File" name="File" type="file" />
                    </div>
                    <br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Ubah
                                Temuan/Inovasi/Paten</button>
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