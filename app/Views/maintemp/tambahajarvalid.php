<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Tambah Pengalaman Mengajar</h3>
        </div>

        <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?= $validation->listErrors()?></div>
        <?php endif;?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url();?>/userfair4/tambahajarproses" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="StartPeriod" class="element">Tahun Mulai <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="StartPeriod" id="StartPeriod" class="form-control">
                            <?php
                                    $lastyear = date("Y")+10;
                                    for ($tahun1 = 1901;$tahun1<=$lastyear;$tahun1++){
                                        if ($tahun1 == set_value('StartPeriod')){
                                            $selected = "selected";
                                        }else{
                                            $selected ="";
                                        }
                                        echo "<option value='".$tahun1."' ".$selected.">".$tahun1."</option>";
                                    }
                                ?>
                        </select>
                    </div><br />
                    <label for="EndPeriod" class="element">Tahun Selesai <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="EndPeriod" id="EndPeriod" class="form-control">
                            <?php
                                    $lastyear = date("Y")+10;
                                    for ($tahun1 = 1901;$tahun1<=$lastyear;$tahun1++){
                                        if ($tahun1 == set_value('EndPeriod')){
                                            $selected = "selected";
                                        }else{
                                            $selected ="";
                                        }
                                        echo "<option value='".$tahun1."' ".$selected.">".$tahun1."</option>";
                                    }
                                ?>
                        </select>
                    </div><br />
                    <label for="Institution" class="element">Nama Perguruan Tinggi/Lembaga
                        <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="Institution" name="Institution" type="text"
                            placeholder="Nama Perguruan Tinggi/Lembaga..." value="<?= set_value('Institution');?>" />
                    </div><br />
                    <label for="Name" class="element">Nama Mata Ajaran <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="Name" name="Name" type="text" placeholder="Nama Mata Ajaran..."
                            value="<?= set_value('Name');?>" />
                    </div>
                    <br />
                    <label for="LocCity" class="element">Kota <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="LocCity" name="LocCity" type="text" placeholder="Kota..."
                            value="<?= set_value('LocCity');?>" />
                    </div>
                    <br />
                    <label for="LocProv" class="element">Provinsi <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="LocProv" name="LocProv" type="text" placeholder="Provinsi..."
                            value="<?= set_value('LocProv');?>" />
                    </div>
                    <br />
                    <label for="LocCountry" class="element">Negara <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="LocCountry" name="LocCountry" type="text"
                            placeholder="Negara..." value="<?= set_value('LocCountry');?>" />
                    </div>
                    <br />
                    <label for="Period" class="element">Perioda</label>
                    <div class="element">
                        <select id="Period" name="Period" class="form-control">
                            <option value="smp9" <?= set_value('Period') == 'smp9' ? 'selected' : '';?>>1 - 9 tahun
                            </option>
                            <option value="smp14" <?= set_value('Period') == 'smp14' ? 'selected' : '';?>>10 - 14 tahun
                            </option>
                            <option value="smp19" <?= set_value('Period') == 'smp19' ? 'selected' : '';?>>15 - 19 tahun
                            </option>
                            <option value="lbih20" <?= set_value('Period') == 'lbih20' ? 'selected' : '';?>>> dari 20
                                tahun</option>
                        </select>
                    </div>
                    <br />
                    <label for="Position" class="element">Jabatan pada Perguruan Tinggi / Lembaga</label>
                    <div class="element">
                        <select id="Position" name="Position" class="form-control">
                            <option value="Stf" <?= set_value('Position') == 'Stf' ? 'selected' : '';?>>Staf Pengajar
                            </option>
                            <option value="Pim" <?= set_value('Position') == 'Pim' ? 'selected' : '';?>>Pimpinan
                            </option>
                        </select>
                    </div>
                    <br />
                    <label for="Skshour" class="element">Jumlah Jam atau S.K.S</label>
                    <div class="element">
                        <select id="Skshour" name="Skshour" class="form-control">
                            <option value="sks1" <?= set_value('Skshour') == 'sks1' ? 'selected' : '';?>>1 SKS / 15 Jam
                            </option>
                            <option value="sks2" <?= set_value('Skshour') == 'sks2' ? 'selected' : '';?>>2 - 3 SKS / 30
                                - 45 Jam</option>
                            <option value="sks4" <?= set_value('Skshour') == 'sks4' ? 'selected' : '';?>>4 SKS / 60 Jam
                            </option>
                        </select>
                    </div>
                    <br />
                    <label for="Desc" class="element">Uraian Singkat Yang Diajarkan / Dikembangkan <span
                            class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <textarea class="form-control" id="Desc" name="Desc" placeholder="Deskripsi"
                            placeholder="Uraian Singkat..."><?= set_value('Desc');?></textarea>
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
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Pengalaman Mengajar</button>
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