<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Form Tambah Data PKM</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/dosenpkm/tambahpkmproses" method="post" enctype="multipart/form-data">
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
                    <label for="judul" class="element">Judul PKM <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="judul" name="judul" class="form-control" type="text" placeholder="Judul PKM..." value="<?= set_value('judul'); ?>" />
                    </div>
                    <br />
                    <label for="sumberdana" class="element">Sumber Dana<span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select id="sumberdana" name="sumberdana" class="form-control">
                            <option value='Dalam Negeri' <?= set_value('sumberdana') == 'Dalam Negeri' ? 'selected' : ''; ?>>Dalam Negeri</option>
                            <option value='Luar Negeri' <?= set_value('sumberdana') == 'Luar Negeri' ? 'selected' : ''; ?>>Luar Negeri</option>
                            <option value='PT/Mandiri' <?= set_value('sumberdana') == 'PT/Mandiri' ? 'selected' : ''; ?>>PT/Mandiri</option>
                        </select>
                    </div>
                    <br />
                    <label for="waktupelaksanaan" class="element">Waktu Pelaksanaan <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right data-datepicker" id="waktupelaksanaan" name="waktupelaksanaan" placeholder="Waktu Pelaksanaan..." value="<?= set_value('waktupelaksanaan'); ?>" />
                        </div>
                    </div><br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah PKM</button>
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