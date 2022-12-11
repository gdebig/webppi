<?= $this->extend('register/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Pendidikan/Pelatihan Teknik/Manajemen</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/register/tambahlatihproses" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Name" class="element">Nama Pendidikan/Pelatihan
                        <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="Name" name="Name" type="text" placeholder="Nama Pendidikan/Pelatihan..." />
                    </div><br />
                    <label for="Organizer" class="element">Penyelenggara <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="Organizer" name="Organizer" type="text" placeholder="Penyelenggara..." />
                    </div>
                    <br />
                    <label for="City" class="element">Kota Lokasi Pelatihan <span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <input class="form-control" id="City" name="City" type="text" placeholder="Kota Lokasi Pelatihan..." />
                    </div>
                    <br />
                    <label for="Country" class="element">Negara Lokasi Pelatihan <span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <input class="form-control" id="Country" name="Country" type="text" placeholder="Negara Lokasi Pelatihan..." />
                    </div>
                    <br />
                    <label for="StartMonth" class="element">Bulan <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="StartMonth" id="StartMonth" class="form-control">
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
                    <label for="StartYear" class="element">Tahun <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="StartYear" id="StartYear" class="form-control">
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
                    <label for="Level" class="element">Tingkat Materi</label>
                    <div class="element">
                        <select id="Level" name="Level" class="form-control">
                            <option value="Dasar">Tingkat Dasar (Fundamental)</option>
                            <option value="Lanjut">Tingkat Lanjut (Advanced)</option>
                        </select>
                    </div>
                    <br />
                    <label for="Length" class="element">Jumlah Jam</label>
                    <div class="element">
                        <select id="Length" name="Length" class="form-control">
                            <option value="sd36">Lama pendidikan s/d 36 Jam</option>
                            <option value="smp100">Lama pendidikan 36 - 100 Jam</option>
                            <option value="smp240">Lama pendidikan 100 - 240 Jam</option>
                            <option value="lbih240">Lebih dari 240 Jam</option>
                        </select>
                    </div>
                    <br />
                    <label for="Description" class="element">Uraian Singkat Materi Pendidikan/Pelatihan, Tingkat
                        Pendidikan, Sertifikat</label>
                    <div class="element">
                        <textarea class="form-control" id="Description" name="Description" placeholder="Deskripsi" placeholder="Uraian Singkat..."></textarea>
                    </div>
                    <br />
                    <label for="File" class="element">Bukti Pendidikan/Pelatihan</label>
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
                                Pelatihan</button>
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