<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Ubah Pengalaman Mengajar</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/userfair4/ubahajarproses" method="post" enctype="multipart/form-data">
                <input type="hidden" name="Num" id="Num" value="<?= $Num; ?>" />
                <input type="hidden" id="filename" name="filename" value="<?= $File ?>">
                <div class="form-group">
                    <label for="StartPeriod" class="element">Tahun Mulai <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="StartPeriod" id="StartPeriod" class="form-control">
                            <?php
                            $lastyear = date("Y") + 10;
                            for ($tahun1 = 1901; $tahun1 <= $lastyear; $tahun1++) {
                                if ($tahun1 == $StartPeriod) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                                echo "<option value='" . $tahun1 . "' " . $selected . ">" . $tahun1 . "</option>";
                            }
                            ?>
                        </select>
                    </div><br />
                    <label for="EndPeriod" class="element">Tahun Selesai <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="EndPeriod" id="EndPeriod" class="form-control">
                            <?php
                            $lastyear = date("Y") + 10;
                            for ($tahun1 = 1901; $tahun1 <= $lastyear; $tahun1++) {
                                if ($tahun1 == $EndPeriod) {
                                    $selected = "selected";
                                } else {
                                    $selected = "";
                                }
                                echo "<option value='" . $tahun1 . "' " . $selected . ">" . $tahun1 . "</option>";
                            }
                            ?>
                        </select>
                    </div><br />
                    <label for="Institution" class="element">Nama Perguruan Tinggi/Lembaga
                        <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="Institution" name="Institution" type="text" placeholder="Nama Perguruan Tinggi/Lembaga..." value="<?= $Institution; ?>" />
                    </div><br />
                    <label for="Name" class="element">Nama Mata Ajaran <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="Name" name="Name" type="text" placeholder="Nama Mata Ajaran..." value="<?= $Name; ?>" />
                    </div>
                    <br />
                    <label for="LocCity" class="element">Kota <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="LocCity" name="LocCity" type="text" placeholder="Kota..." value="<?= $LocCity; ?>" />
                    </div>
                    <br />
                    <label for="LocProv" class="element">Provinsi <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="LocProv" name="LocProv" type="text" placeholder="Provinsi..." value="<?= $LocProv; ?>" />
                    </div>
                    <br />
                    <label for="LocCountry" class="element">Negara <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="LocCountry" name="LocCountry" type="text" placeholder="Negara..." value="<?= $LocCountry; ?>" />
                    </div>
                    <br />
                    <label for="Period" class="element">Perioda</label>
                    <div class="element">
                        <select id="Period" name="Period" class="form-control">
                            <option value="smp9" <?= $Period == 'smp9' ? 'selected' : ''; ?>>1 - 9 tahun
                            </option>
                            <option value="smp14" <?= $Period == 'smp14' ? 'selected' : ''; ?>>10 - 14 tahun
                            </option>
                            <option value="smp19" <?= $Period == 'smp19' ? 'selected' : ''; ?>>15 - 19 tahun
                            </option>
                            <option value="lbih20" <?= $Period == 'lbih20' ? 'selected' : ''; ?>>> dari 20
                                tahun</option>
                        </select>
                    </div>
                    <br />
                    <label for="Position" class="element">Jabatan pada Perguruan Tinggi / Lembaga</label>
                    <div class="element">
                        <select id="Position" name="Position" class="form-control">
                            <option value="Stf" <?= $Position == 'Stf' ? 'selected' : ''; ?>>Staf Pengajar
                            </option>
                            <option value="Pim" <?= $Position == 'Pim' ? 'selected' : ''; ?>>Pimpinan
                            </option>
                        </select>
                    </div>
                    <br />
                    <label for="Skshour" class="element">Jumlah Jam atau S.K.S</label>
                    <div class="element">
                        <select id="Skshour" name="Skshour" class="form-control">
                            <option value="sks1" <?= $Skshour == 'sks1' ? 'selected' : ''; ?>>1 SKS / 15 Jam
                            </option>
                            <option value="sks2" <?= $Skshour == 'sks2' ? 'selected' : ''; ?>>2 - 3 SKS / 30
                                - 45 Jam</option>
                            <option value="sks4" <?= $Skshour == 'sks4' ? 'selected' : ''; ?>>4 SKS / 60 Jam
                            </option>
                        </select>
                    </div>
                    <br />
                    <label for="Desc" class="element">Uraian Singkat Yang Diajarkan / Dikembangkan <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <textarea class="form-control" id="Desc" name="Desc" placeholder="Deskripsi" placeholder="Uraian Singkat..."><?= $Desc; ?></textarea>
                    </div>
                    <br />
                    <label for="komp4" class="element">Kompetensi (Gunakan tombol ctrl + klik kiri mouse untuk memilih
                        lebih dari satu kompetensi)<span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select multiple class="form-control" name="komp4[]" id="komp4" size="10">
                            <?php
                            $i = 1;
                            $prev_cat = array();

                            foreach ($data_komp as $komp) :
                                $j = $i - 1;
                                $prev_cat[$i] = $komp['komp_cat'];
                                if (!empty($prev_cat) && ($j != 0)) {
                                    if ($prev_cat[$i] != $prev_cat[$j]) {
                                        echo "</optgroup>";
                                    }
                                }
                                if ($komp['komp_parent'] == 'y') {
                                    echo "<optgroup label='" . $komp['komp_code'] . " " . $komp['komp_desc'] . "'>";
                                } else {
                                    if ($i == 1) {
                                    } else {
                                        $kompselected = array_search($komp['komp_code'], $datakomp) !== false ? 'selected' : '';
                                        echo "<option value='" . $komp['komp_code'] . "' title='" . $komp['komp_desc'] . "' " . $kompselected . ">" . $komp['komp_code'] . " " . $komp['komp_desc'] . "</option>";
                                    }
                                }
                                $i++;
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <br />
                    <label for="File" class="element">Bukti Pengalaman Mengajar</label>
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
                                Pengalaman Mengajar</button>
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