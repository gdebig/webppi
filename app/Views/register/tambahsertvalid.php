<?= $this->extend('register/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Sertifikat Kompetensi dan Bidang Lainnya (Yang Relevan) Yang Diikuti</h3>
        </div>

        <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?= $validation->listErrors()?></div>
        <?php endif;?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url();?>/register/tambahlatihproses" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Name" class="element">Nama Sertifikat
                        <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="Name" name="Name" type="text" placeholder="Nama Sertifikat..."
                            value="<?= set_value('Name');?>" />
                    </div><br />
                    <label for="Organizer" class="element">Penyelenggara <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="Organizer" name="Organizer" type="text"
                            placeholder="Penyelenggara..." value="<?= set_value('Organizer');?>" />
                    </div>
                    <br />
                    <label for="City" class="element">Kota Lokasi Sertifikat <span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <input class="form-control" id="City" name="City" type="text"
                            placeholder="Kota Lokasi Sertifikat..." value="<?= set_value('City');?>" />
                    </div>
                    <br />
                    <label for="Country" class="element">Negara Lokasi Sertifikat <span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <input class="form-control" id="Country" name="Country" type="text"
                            placeholder="Negara Lokasi Sertifikat..." value="<?= set_value('Country');?>" />
                    </div>
                    <br />
                    <label for="StartMonth" class="element">Bulan <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="StartMonth" id="StartMonth" class="form-control">
                            <option value="Januari"
                                <?php echo set_value('StartMonth') == "Januari" ? "selected" : "";?>>Januari</option>
                            <option value="Februari"
                                <?php echo set_value('StartMonth') == "Februari" ? "selected" : "";?>>Februari</option>
                            <option value="Maret" <?php echo set_value('StartMonth') == "Maret" ? "selected" : "";?>>
                                Maret</option>
                            <option value="April" <?php echo set_value('StartMonth') == "April" ? "selected" : "";?>>
                                April</option>
                            <option value="Mei" <?php echo set_value('StartMonth') == "Mei" ? "selected" : "";?>>Mei
                            </option>
                            <option value="Juni" <?php echo set_value('StartMonth') == "Juni" ? "selected" : "";?>>Juni
                            </option>
                            <option value="Juli" <?php echo set_value('StartMonth') == "Juli" ? "selected" : "";?>>Juli
                            </option>
                            <option value="Agustus"
                                <?php echo set_value('StartMonth') == "Agustus" ? "selected" : "";?>>Agustus</option>
                            <option value="September"
                                <?php echo set_value('StartMonth') == "September" ? "selected" : "";?>>September
                            </option>
                            <option value="Oktober"
                                <?php echo set_value('StartMonth') == "Oktober" ? "selected" : "";?>>Oktober</option>
                            <option value="November"
                                <?php echo set_value('StartMonth') == "November" ? "selected" : "";?>>November</option>
                            <option value="Desember"
                                <?php echo set_value('StartMonth') == "Desember" ? "selected" : "";?>>Desember</option>
                        </select>
                    </div>
                    <br />
                    <label for="StartYear" class="element">Tahun <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="StartYear" id="StartYear" class="form-control">
                            <?php
                                    $lastyear = date("Y")+10;
                                    $now = date("Y");
                                    for ($tahun1 = 1901;$tahun1<=$lastyear;$tahun1++){
                                        if ($tahun1 == set_value('StartYear')){
                                            $selected = "selected";
                                        }else{
                                            $selected ="";
                                        }
                                        echo "<option value='".$tahun1."' ".$selected.">".$tahun1."</option>";
                                    }
                                ?>
                        </select>
                    </div>
                    <br />
                    <label for="Level" class="element">Tingkat Materi</label>
                    <div class="element">
                        <select id="Level" name="Level" class="form-control">
                            <option value="Dasar" <?php echo set_value('Level') == "Dasar" ? "selected" : "";?>>Tingkat
                                Dasar (Fundamental)</option>
                            <option value="Lanjut" <?php echo set_value('Level') == "Lanjut" ? "selected" : "";?>>
                                Tingkat Lanjut (Advanced)</option>
                        </select>
                    </div>
                    <br />
                    <label for="Length" class="element">Jumlah Jam</label>
                    <div class="element">
                        <select id="Length" name="Length" class="form-control">
                            <option value="sd36" <?php echo set_value('Length') == "sd36" ? "selected" : "";?>>Lama
                                pendidikan s/d 36 Jam</option>
                            <option value="smp100" <?php echo set_value('Length') == "smp100" ? "selected" : "";?>>Lama
                                pendidikan 36 - 100 Jam</option>
                            <option value="smp240" <?php echo set_value('Length') == "smp240" ? "selected" : "";?>>Lama
                                pendidikan 100 - 240 Jam</option>
                            <option value="lbih240" <?php echo set_value('Length') == "lbih240" ? "selected" : "";?>>
                                Lebih dari 240 Jam</option>
                        </select>
                    </div>
                    <br />
                    <label for="Description" class="element">Uraian Singkat Materi Pendidikan/Pelatihan, Tingkat
                        Pendidikan, Sertifikat</label>
                    <div class="element">
                        <textarea class="form-control" id="Description" name="Description" placeholder="Deskripsi"
                            placeholder="Uraian Singkat..."><?= set_value('Description');?></textarea>
                    </div>
                    <br />
                    <label for="File" class="element">Bukti Sertifikat</label>
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
                                Sertifikat</button>
                        </div>
                        <div class="col">
                            <button type="submit" name="submit" value="batal"
                                class="btn btn-block btn-danger col">Batal</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection();?>