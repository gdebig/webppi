<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Ubah Data Pendidikan/Pelatihan Teknik/Manajemen</h3>
        </div>

        <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?= $validation->listErrors()?></div>
        <?php endif;?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url();?>/userfair15/ubahlatihproses" method="post"
                enctype="multipart/form-data">
                <input type="hidden" id="Num" name="Num" value=<?= $Num;?>>
                <input type="hidden" id="filename" name="filename" value=<?= $File;?>>
                <div class="form-group">
                    <label for="Name" class="element">Nama Pendidikan/Pelatihan
                        <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="Name" name="Name" type="text"
                            placeholder="Nama Pendidikan/Pelatihan..." value="<?= $Name;?>" />
                    </div><br />
                    <label for="Organizer" class="element">Penyelenggara <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="Organizer" name="Organizer" type="text"
                            placeholder="Penyelenggara..." value="<?= $Organizer;?>" />
                    </div>
                    <br />
                    <label for="City" class="element">Kota Lokasi Pelatihan <span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <input class="form-control" id="City" name="City" type="text"
                            placeholder="Kota Lokasi Pelatihan..." value="<?= $Kota;?>" />
                    </div>
                    <br />
                    <label for="Country" class="element">Negara Lokasi Pelatihan <span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <input class="form-control" id="Country" name="Country" type="text"
                            placeholder="Negara Lokasi Pelatihan..." value="<?= $Country;?>" />
                    </div>
                    <br />
                    <label for="StartMonth" class="element">Bulan <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="StartMonth" id="StartMonth" class="form-control">
                            <option value="Januari" <?php echo $StartMonth == "Januari" ? "selected" : "";?>>Januari
                            </option>
                            <option value="Februari" <?php echo $StartMonth == "Februari" ? "selected" : "";?>>Februari
                            </option>
                            <option value="Maret" <?php echo $StartMonth == "Maret" ? "selected" : "";?>>
                                Maret</option>
                            <option value="April" <?php echo $StartMonth == "April" ? "selected" : "";?>>
                                April</option>
                            <option value="Mei" <?php echo $StartMonth == "Mei" ? "selected" : "";?>>Mei
                            </option>
                            <option value="Juni" <?php echo $StartMonth == "Juni" ? "selected" : "";?>>Juni
                            </option>
                            <option value="Juli" <?php echo $StartMonth == "Juli" ? "selected" : "";?>>Juli
                            </option>
                            <option value="Agustus" <?php echo $StartMonth == "Agustus" ? "selected" : "";?>>Agustus
                            </option>
                            <option value="September" <?php echo $StartMonth == "September" ? "selected" : "";?>>
                                September
                            </option>
                            <option value="Oktober" <?php echo $StartMonth == "Oktober" ? "selected" : "";?>>Oktober
                            </option>
                            <option value="November" <?php echo $StartMonth == "November" ? "selected" : "";?>>November
                            </option>
                            <option value="Desember" <?php echo $StartMonth == "Desember" ? "selected" : "";?>>Desember
                            </option>
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
                                        if ($tahun1 == $StartYear){
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
                            <option value="Dasar" <?php echo $Level == "Dasar" ? "selected" : "";?>>Tingkat
                                Dasar (Fundamental)</option>
                            <option value="Lanjut" <?php echo $Level == "Lanjut" ? "selected" : "";?>>
                                Tingkat Lanjut (Advanced)</option>
                        </select>
                    </div>
                    <br />
                    <label for="Length" class="element">Jumlah Jam</label>
                    <div class="element">
                        <select id="Length" name="Length" class="form-control">
                            <option value="sd36" <?php echo $Length == "sd36" ? "selected" : "";?>>Lama
                                pendidikan s/d 36 Jam</option>
                            <option value="smp100" <?php echo $Length == "smp100" ? "selected" : "";?>>Lama
                                pendidikan 36 - 100 Jam</option>
                            <option value="smp240" <?php echo $Length == "smp240" ? "selected" : "";?>>Lama
                                pendidikan 100 - 240 Jam</option>
                            <option value="lbih240" <?php echo $Length == "lbih240" ? "selected" : "";?>>
                                Lebih dari 240 Jam</option>
                        </select>
                    </div>
                    <br />
                    <label for="Description" class="element">Uraian Singkat Materi Pendidikan/Pelatihan, Tingkat
                        Pendidikan, Sertifikat</label>
                    <div class="element">
                        <textarea class="form-control" id="Description" name="Description" placeholder="Deskripsi"
                            placeholder="Uraian Singkat..."><?= $Description;?></textarea>
                    </div>
                    <br />
                    <label for="komp15" class="element">Kompetensi (Gunakan tombol ctrl + klik kiri mouse untuk memilih
                        lebih dari satu kompetensi)<span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select multiple class="form-control" name="komp15[]" id="komp15" size="10">
                            <?php
                            $i=1;
                            $prev_cat = array();

                            foreach ($data_komp as $komp) :
                                $j = $i-1;
                                $prev_cat[$i] = $komp['komp_cat'];
                                if (!empty($prev_cat)&&($j!=0)){
                                    if ($prev_cat[$i]!=$prev_cat[$j]){
                                        echo "</optgroup>";
                                    }
                                }
                                if ($komp['komp_parent']=='y'){
                                    echo "<optgroup label='".$komp['komp_code']." ".$komp['komp_desc']."'>";
                                }else{
                                    if ($i==1){
                                    }else{
                                        $kompselected = array_search($komp['komp_code'], $datakomp) !== false ? 'selected' : '';
                                        echo "<option value='".$komp['komp_code']."' title='".$komp['komp_desc']."' ".$kompselected.">".$komp['komp_code']." ".$komp['komp_desc']."</option>";
                                    }
                                }
                                $i++;
                            endforeach;
                            ?>
                        </select>
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
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Ubah
                                Pelatihan</button>
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