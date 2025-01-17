<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Form Tambah Data HAKI</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/dosenhaki/tambahhakiproses" method="post" enctype="multipart/form-data">
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
                    <label for="judul" class="element">Judul Luaran <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="judul" name="judul" class="form-control" type="text" placeholder="Judul Luaran..." />
                    </div>
                    <br />
                    <label for="jenis" class="element">Jenis Luaran<span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select id="jenis" name="jenis" class="form-control">
                            <option value='Paten'>Paten</option>
                            <option value='Paten Sederhana'>Paten Sederhana</option>
                            <option value='Hak Cipta'>Hak Cipta</option>
                            <option value='Desain Produk Industri'>Desain Produk Industri</option>
                            <option value='Perlindungan Varietas Tanaman'>Perlindungan Varietas Tanaman</option>
                            <option value='Desain Tata Letak Sirkuit Terpadu'>Desain Tata Letak Sirkuit Terpadu</option>
                        </select>
                    </div>
                    <br />
                    <label for="nomorhaki" class="element">Nomor HAKI <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="nomorhaki" name="nomorhaki" class="form-control" type="text" placeholder="Nomor HAKI..." />
                    </div><br />
                    <br />
                    <label for="tanggalperoleh" class="element">Tanggal Perolehan <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right data-datepicker" id="tanggalperoleh" name="tanggalperoleh" placeholder="Tanggal Perolehan..." />
                        </div>
                    </div><br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah HAKI</button>
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