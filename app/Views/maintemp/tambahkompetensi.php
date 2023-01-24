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
            <form action="<?php echo base_url(); ?>/dosenkompetensi/tambahkompetensiproses" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="semester" class="element">Semester <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select id="semester" name="semester" class="form-control">
                            <option value='Ganjil'>Ganjil</option>
                            <option value='Genap'>Genap</option>
                        </select>
                    </div><br />
                    <label for="tahun" class="element">Tahun <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="tahun" id="tahun" class="form-control">
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
                    <label for="posisi" class="element">Posisi <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select id="posisi" name="posisi" class="form-control">
                            <option value='Ketua'>Ketua</option>
                            <option value='Anggota'>Anggota</option>
                            <option value='Saksi Ahli'>Saksi Ahli</option>
                        </select>
                    </div><br />
                    <label for="namabadan" class="element">Nama Badan <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="namabadan" name="namabadan" class="form-control" type="text" placeholder="Nama Badan..." />
                    </div>
                    <br />
                    <label for="mewakili" class="element">Mewakili<span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select id="mewakili" name="mewakili" class="form-control">
                            <option value='Perguruan Tinggi'>Perguruan Tinggi</option>
                            <option value='Pemerintah'>Pemerintah</option>
                        </select>
                    </div>
                    <br />
                    <label for="saksiahli" class="element">Saksi Ahli<span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select id="saksiahli" name="saksiahli" class="form-control">
                            <option value='Tidak'>Tidak</option>
                            <option value='Ya'>Ya</option>
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
                            <input type="text" class="form-control float-right data-datepicker" id="waktupelaksanaan" name="waktupelaksanaan" placeholder="Waktu Pelaksanaan..." />
                        </div>
                    </div><br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah Kompetensi</button>
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