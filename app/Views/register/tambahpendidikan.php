<?= $this->extend('register/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Pendidikan</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/register/tambahpendproses" method="post" enctype="multipart/form-data">
                <input type="hidden" id="user_id" name="user_id" value="<?= $user_id; ?>" />
                <div class="form-group">
                    <label for="jenjang" class="element">
                        <span class="required">Jenjang Pendidikan *</span>&nbsp; </label>
                    <div class="element">
                        <select name="jenjang" id="jenjang" class="form-control">
                            <option value="D4">Diploma 4</option>
                            <option value="S1">Sarjana</option>
                            <option value="S2">Master</option>
                            <option value="S3">Doktor</option>
                        </select>
                    </div>
                    <br>
                    <label for="Name" class="element">Nama Perguruan Tinggi <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Name" name="Name" class="form-control" type="text" placeholder="Nama Perguruan Tinggi..." />
                    </div>
                    <br />
                    <label for="Faculty" class="element">Fakultas <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input id="Faculty" name="Faculty" class="form-control" type="text" placeholder="Fakultas..." />
                    </div>
                    <br />
                    <label for="Major" class="element">Jurusan <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input id="Major" name="Major" class="form-control" placeholder="Jurusan..." type="text" />
                    </div>
                    <br />
                    <label for="City" class="element">Kota Perguruan Tinggi <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="City" name="City" class="form-control" placeholder="Kota Lokasi Perguruan Tinggi..." type="text" />
                    </div>
                    <br />
                    <label for="Country" class="element">Negara Perguruan Tinggi <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Country" name="Country" class="form-control" placeholder="Negara Lokasi Perguruan Tinggi..." type="text" />
                    </div>
                    <br />
                    <label for="GradYear" class="element">Tahun Kelulusan <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="GradYear" id="GradYear" class="form-control">
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
                    <label for="Degree" class="element">Gelar <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input id="Degree" name="Degree" class="form-control" placeholder="Gelar..." type="text" />
                    </div>
                    <br />
                    <label for="Title" class="element">Judul Tugas Akhir/Skripsi/Tesis/Disertasi <span class="required">
                            *</span>&nbsp; </label>
                    <div class="element">
                        <textarea id="Title" name="Title" class="form-control" placeholder="Judul Tugas Akhir..."></textarea>
                    </div>
                    <br />
                    <label for="Desc" class="element">Uraian Singkat Tentang Materi Tugas
                        Akhir/Skripsi/Disertasi <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <textarea id="Desc" name="Desc" class="form-control" placeholder="Uraian Singkat Tugas Akhir..."></textarea>
                    </div>
                    <br />
                    <label for="Mark" class="element">Nilai Akademik Rata-rata <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Mark" name="Mark" class="form-control" placeholder="Nilai Akademik Rata-rata..." type="text" />
                    </div>
                    <br />
                    <label for="Judicium" class="element">Yudisium <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input id="Judicium" name="Judicium" class="form-control" placeholder="Yudisium..." type="text" />
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="ijazah" class="element">Unggah Scan Ijazah (Format: .jpeg, .jpg, .png dan .pdf |
                            Ukuran Maksimum: 700KB) <span class="required">*</span>&nbsp;</label>
                        <div class="element">
                            <input id="ijazah" name="ijazah" type="file" class="form-control" placeholder="Scan Ijazah..." />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Pendidikan</button>
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