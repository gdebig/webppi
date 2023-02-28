<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Form Tambah Seminar</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/seminarreg/tambahsemregproses" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="sem_judul" class="element">Judul Seminar <span class="required">
                            *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="sem_judul" name="sem_judul" class="form-control" type="text" placeholder="Judul Seminar..." />
                    </div>
                    <br />
                    <label for="sem_term" class="element">Semester <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="sem_term" id="sem_term" class="form-control">
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <br />
                    <label for="sem_tahun" class="element">Tahun Seminar <span class="required">
                            *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="sem_tahun" id="sem_tahun" class="form-control">
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
                    <label for="sem_bukti" class="element">Bukti Seminar (Sertifikat, materi/handout paparan, foto kegiatan atau surat keterangan ditandatangani pihak penyelenggara seminar, dan/atau bukti-bukti pendukung lainnya)</label>
                    <div class="element">
                        <input id="sem_bukti" name="sem_bukti" type="file" class="form-control" placeholder="File Bukti Seminar..." />
                    </div>
                    <br /><br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Seminar</button>
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