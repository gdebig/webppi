<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Form Ubah Data Riset dan Pengabdian Masyarakat</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/dosenriset/ubahrisetproses" method="post" enctype="multipart/form-data">
                <input type="hidden" name="riset_id" id="riset_id" value=<?= $riset_id; ?>>
                <div class="form-group">
                    <label for="semester" class="element">Semester <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select id="semester" name="semester" class="form-control">
                            <option value='Ganjil' <?= $semester == "Ganjil" ? 'selected' : ''; ?>>Ganjil</option>
                            <option value='Genap' <?= $semester == "Genap" ? 'selected' : ''; ?>>Genap</option>
                        </select>
                    </div><br />
                    <label for="tahun" class="element">Tahun <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="tahun" id="tahun" class="form-control">
                            <?php
                            $lastyear = date("Y") + 10;
                            $now = date("Y");
                            for ($tahun1 = 1901; $tahun1 <= $lastyear; $tahun1++) {
                                if ($tahun1 == $tahun) {
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
                    <label for="judul" class="element">Judul Penelitian / Pengabdian Masyarakat Semester Yang Lalu <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="judul" name="judul" class="form-control" type="text" placeholder="Judul Penelitian/Pengmas..." value="<?= $judul; ?>" />
                    </div>
                    <br />
                    <label for="tipe" class="element">Jenis <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select id="tipe" name="tipe" class="form-control">
                            <option value='Penelitian' <?= $tipe == "Penelitian" ? 'selected' : ''; ?>>Penelitian</option>
                            <option value='Pengabdian Masyarakat' <?= $tipe == "Pengabdian Masyarakat" ? 'selected' : ''; ?>>Pengabdian Masyarakat</option>
                        </select>
                    </div>
                    <br />
                    <label for="asal_dana" class="element">Sumber Dana <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select id="asal_dana" name="asal_dana" class="form-control">
                            <option value='Lokal' <?= $asal_dana == "Lokal" ? 'selected' : ''; ?>>Lokal</option>
                            <option value='Nasional' <?= $asal_dana == "Nasional" ? 'selected' : ''; ?>>Nasional</option>
                            <option value='Internasional' <?= $asal_dana == "Internasional" ? 'selected' : ''; ?>>Internasional</option>
                        </select>
                    </div><br />
                    <label for="namahibah" class="element">Nama Hibah / Sumber Pendanaan <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="namahibah" name="namahibah" class="form-control" type="text" placeholder="Nama Hibah / Sumber Pendanaan..." value="<?= $namahibah; ?>" />
                    </div><br />
                    <label for="tanggalawal" class="element">Tanggal Peroleh Hibah <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right data-datepicker" id="tanggalawal" name="tanggalawal" placeholder="Tanggal Perolehan Hibah..." value="<?= $tanggalawal; ?>" />
                        </div>
                    </div><br />
                    <label for="tanggalakhir" class="element">Tanggal Hibah Selesai <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right data-datepicker" id="tanggalakhir" name="tanggalakhir" placeholder="Tanggal Hibah Selesai..." value="<?= $tanggalakhir; ?>" />
                        </div>
                    </div><br />
                    <label for="ProjValue" class="element">Jumlah Dana yang Diperoleh (Angka dalam rupiah) <span class="required"> *</span>&nbsp;</label>
                    <div class="element">
                        <input class="form-control" id="ProjValue" name="ProjValue" type="text" placeholder="Jumlah Dana..." value="<?= $ProjValue; ?>" />
                    </div>
                    <br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Ubah Riset/Pengmas</button>
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