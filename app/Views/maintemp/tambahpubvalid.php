<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Form Tambah Data Publikasi</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/dosenpublikasi/tambahpubproses" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="semester" class="element">Semester <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select id="semester" name="semester" class="form-control">
                            <option value='Ganjil' <?= set_value('semester') == 'Ganjil' ? 'selected' : ''; ?>>Ganjil</option>
                            <option value='Genap' <?= set_value('semester') == 'Genap' ? 'selected' : ''; ?>>Genap</option>
                        </select>
                    </div><br />
                    <label for="tahun" class="element">Tahun <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="tahun" id="tahun" class="form-control">
                            <?php
                            $lastyear = date("Y") + 10;
                            $now = date("Y");
                            for ($tahun1 = 1901; $tahun1 <= $lastyear; $tahun1++) {
                                if ($tahun1 == set_value('tahun')) {
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
                    <label for="judul" class="element">Judul Artikel <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="judul" name="judul" class="form-control" type="text" placeholder="Judul Artikel..." value="<?= set_value('judul'); ?>" />
                    </div>
                    <br />
                    <label for="jenis" class="element">Jenis Publikasi<span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select id="jenis" name="jenis" class="form-control">
                            <option value='Jurnal Nasional Tidak Terakreditasi' <?= set_value('jenis') == "Jurnal Nasional Tidak Terakreditasi" ? 'selected' : ''; ?>>Jurnal Nasional Tidak Terakreditasi</option>
                            <option value='Jurnal Nasional Terakreditasi/Majalah Profesi Nasional' <?= set_value('jenis') == "Jurnal Nasional Terakreditasi/Majalah Profesi Nasional" ? 'selected' : ''; ?>>Jurnal Nasional Terakreditasi/Majalah Profesi Nasional</option>
                            <option value='Jurnal Internasional' <?= set_value('jenis') == "Jurnal Internasional" ? 'selected' : ''; ?>>Jurnal Internasional</option>
                            <option value='Jurnal Internasional Bereputasi/Majalah Profesi Internasional' <?= set_value('jenis') == "Jurnal Internasional Bereputasi/Majalah Profesi Internasional" ? 'selected' : ''; ?>>Jurnal Internasional Bereputasi/Majalah Profesi Internasional</option>
                            <option value='Seminar Wilayah/Lokal/PT' <?= set_value('jenis') == "Seminar Wilayah/Lokal/PT" ? 'selected' : ''; ?>>Seminar Wilayah/Lokal/PT</option>
                            <option value='Seminar/Pertemuan Himpunan Profesi Nasional' <?= set_value('jenis') == "Seminar/Pertemuan Himpunan Profesi Nasional" ? 'selected' : ''; ?>>Seminar/Pertemuan Himpunan Profesi Nasional</option>
                            <option value='Seminar/pertemuan Himpunan Profesi Internasional' <?= set_value('jenis') == "Seminar/pertemuan Himpunan Profesi Internasional" ? 'selected' : ''; ?>>Seminar/pertemuan Himpunan Profesi Internasional</option>
                            <option value='Tulisan di Media Massa Wilayah' <?= set_value('jenis') == "Tulisan di Media Massa Wilayah" ? 'selected' : ''; ?>>Tulisan di Media Massa Wilayah</option>
                            <option value='Tulisan di Media Massa Nasional' <?= set_value('jenis') == "Tulisan di Media Massa Nasional" ? 'selected' : ''; ?>>Tulisan di Media Massa Nasional</option>
                            <option value='Tulisan di Media Massa Internasional' <?= set_value('jenis') == "Tulisan di Media Massa Internasional" ? 'selected' : ''; ?>>Tulisan di Media Massa Internasional</option>
                        </select>
                    </div>
                    <br />
                    <label for="tanggalpublikasi" class="element">Tanggal Publikasi / Seminar <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right data-datepicker" id="tanggalpublikasi" name="tanggalpublikasi" placeholder="Tanggal Publikasi / Seminar..." value="<?= set_value('tanggalpublikasi'); ?>" />
                        </div>
                    </div><br />
                    <label for="linkpublikasi" class="element">Link Publikasi (termasuk https/http) <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="linkpublikasi" name="linkpublikasi" class="form-control" type="text" placeholder="Link Publikasi..." value="<?= set_value('linkpublikasi'); ?>" />
                    </div><br />
                    <br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah Publikasi</button>
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