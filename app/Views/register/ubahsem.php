<?= $this->extend('register/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Makalah/Tulisan Yang Disajikan Dalam Seminar/Lokakarya Keinsinyuran</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/register/ubahsemproses" method="post" enctype="multipart/form-data">
                <input type="hidden" id="Num" name="Num" value="<?= $Num; ?>">
                <input type="hidden" id="filename" name="filename" value="<?= $File; ?>">
                <div class="form-group">
                    <label for="PaperName" class="element">Judul Makalah/Tulisan
                        <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="PaperName" name="PaperName" type="text" placeholder="Judul Makalah/Tulisan..." value="<?= $PaperName; ?>" />
                    </div><br />
                    <label for="Name" class="element">Nama Seminar/Lokakarya <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input class="form-control" id="Name" name="Name" type="text" placeholder="Nama Seminar/Lokakarya..." value="<?= $Name; ?>" />
                    </div>
                    <br />
                    <label for="Organizer" class="element">Penyelenggara <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input class="form-control" id="Organizer" name="Organizer" type="text" placeholder="Penyelenggara..." value="<?= $Organizer; ?>" />
                    </div>
                    <br />
                    <label for="LocCity" class="element">Kota <span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <input class="form-control" id="LocCity" name="LocCity" type="text" placeholder="Kota..." value="<?= $LocCity; ?>" />
                    </div>
                    <br />
                    <label for="LocCountry" class="element">Negara<span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <input class="form-control" id="LocCountry" name="LocCountry" type="text" placeholder="Negara..." value="<?= $LocCountry; ?>" />
                    </div>
                    <br />
                    <label for="Month" class="element">Bulan <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="Month" id="Month" class="form-control">
                            <option value="Januari" <?php echo $Month == 'Januari' ? 'selected' : ''; ?>>
                                Januari
                            </option>
                            <option value="Februari" <?php echo $Month == 'Februari' ? 'selected' : ''; ?>>
                                Februari
                            </option>
                            <option value="Maret" <?php echo $Month == 'Maret' ? 'selected' : ''; ?>>Maret
                            </option>
                            <option value="April" <?php echo $Month == 'April' ? 'selected' : ''; ?>>April
                            </option>
                            <option value="Mei" <?php echo $Month == 'Mei' ? 'selected' : ''; ?>>
                                Mei</option>
                            <option value="Juni" <?php echo $Month == 'Juni' ? 'selected' : ''; ?>>Juni
                            </option>
                            <option value="Juli" <?php echo $Month == 'Juli' ? 'selected' : ''; ?>>Juli
                            </option>
                            <option value="Agustus" <?php echo $Month == 'Agustus' ? 'selected' : ''; ?>>
                                Agustus
                            </option>
                            <option value="September" <?php echo $Month == 'September' ? 'selected' : ''; ?>>
                                September
                            </option>
                            <option value="Oktober" <?php echo $Month == 'Oktober' ? 'selected' : ''; ?>>
                                Oktober
                            </option>
                            <option value="November" <?php echo $Month == 'November' ? 'selected' : ''; ?>>
                                November
                            </option>
                            <option value="Desember" <?php echo $Month == 'Desember' ? 'selected' : ''; ?>>
                                Desember
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
                    <label for="Level" class="element">Seminar/Lokakarya Tingkat</label>
                    <div class="element">
                        <select id="Level" name="Level" class="form-control">
                            <option value="Lok" <?php echo $Level == 'Lok' ? 'selected' : ''; ?>>Pada Seminar
                                Lokal</option>
                            <option value="Nas" <?php echo $Level == 'Nas' ? 'selected' : ''; ?>>Pada Seminar
                                Nasional</option>
                            <option value="Int" <?php echo $Level == 'Int' ? 'selected' : ''; ?>>Pada Seminar
                                Internasional</option>
                        </select>
                    </div>
                    <br />
                    <label for="DiffBenefit" class="element">Tingkat Kesulitan dan Manfaat</label>
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
                    <label for="Desc" class="element">Uraian Singkat Materi Makalah/Tulisan<span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <textarea class="form-control" id="Desc" name="Desc" placeholder="Deskripsi" placeholder="Uraian Singkat..."><?= $Desc; ?></textarea>
                    </div>
                    <br />
                    <label for="File" class="element">Bukti Seminar</label>
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