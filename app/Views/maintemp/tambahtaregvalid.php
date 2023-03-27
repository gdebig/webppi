<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Form Tambah Praktik Keinsinyuran</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/regtugasakhir/tambahtarproses" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="tar_usuljudul" class="element">Judul Praktik Keinsinyuran <span class="required">
                            *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="tar_usuljudul" name="tar_usuljudul" class="form-control" type="text" placeholder="Judul Praktik Keinsinyuran..." value="<?= set_value('tar_usuljudul'); ?>" />
                    </div>
                    <br />
                    <label for="tar_semester" class="element">Semester <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="tar_semester" id="tar_semester" class="form-control">
                            <option value="Ganjil" <?= set_value('tar_semester') == 'Ganjil' ? "selected" : ""; ?>>Ganjil
                            </option>
                            <option value="Genap" <?= set_value('tar_semester') == 'Genap' ? "selected" : ""; ?>>Genap
                            </option>
                        </select>
                    </div>
                    <br />
                    <label for="tar_tahun" class="element">Tahun Praktik Keinsinyuran <span class="required">
                            *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="tar_tahun" id="tar_tahun" class="form-control">
                            <?php
                            $lastyear = date("Y") + 10;
                            $now = set_value('tar_tahun');
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
                    <label for="startdate" class="element">Tanggal Mulai <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right data-datepicker" id="startdate" name="startdate" placeholder="Tanggal Mulai..." />
                    </div>
                    <br />
                    <label for="enddate" class="element">Tanggal Berakhir <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right data-datepicker" id="enddate" name="enddate" placeholder="Tanggal Berakhir..." />
                    </div>
                    <br />
                    <label for="instansi" class="element">Nama Instansi <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="instansi" name="instansi" class="form-control" type="text" placeholder="Nama Instansi..." value="<?= set_value('instansi'); ?>" />
                    </div>
                    <br />
                    <label for="divisi" class="element">Nama Divisi <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="divisi" name="divisi" class="form-control" type="text" placeholder="Nama Divisi..." value="<?= set_value('divisi'); ?>" />
                    </div>
                    <br />
                    <label for="tar_buku" class="element">File Buku Praktik Keinsinyuran</label>
                    <div class="element">
                        <input id="tar_buku" name="tar_buku" type="file" class="form-control" placeholder="File Buku TA..." />
                    </div>
                    <br />
                    <label for="tar_log" class="element">Log Praktik Keinsinyuran</label>
                    <div class="element">
                        <input id="tar_log" name="tar_log" type="file" class="form-control" placeholder="File Log TA..." />
                    </div>
                    <br />
                    <label for="tar_linkvideo" class="element">Link video presentasi (format: https://...)</label>
                    <div class="element">
                        <input id="tar_linkvideo" name="tar_linkvideo" type="text" class="form-control" placeholder="Link video..." value="<?= set_value('tar_linkvideo'); ?>" />
                    </div>
                    <br /><br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Praktik Keinsinyuran</button>
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