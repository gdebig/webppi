<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Tambah Penghargaan</h3>
        </div>

        <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?= $validation->listErrors()?></div>
        <?php endif;?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url();?>/userfair14/tambahpenghargaanproses" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Year" class="element">Tahun Penghargaan <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="Year" id="Year" class="form-control">
                            <?php
                                $lastyear = date("Y")+10;
                                $now = date("Y");
                                for ($tahun1 = 1901;$tahun1<=$lastyear;$tahun1++){
                                    if ($tahun1 == set_value('Year')){
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
                    <label for="Month" class="element">Bulan Mulai <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="Month" id="Month" class="form-control">
                            <option value="1" <?= set_value('Month') == '1' ? 'selected' : ''?>>Januari</option>
                            <option value="2" <?= set_value('Month') == '2' ? 'selected' : ''?>>Februari</option>
                            <option value="3" <?= set_value('Month') == '3' ? 'selected' : ''?>>Maret</option>
                            <option value="4" <?= set_value('Month') == '4' ? 'selected' : ''?>>April</option>
                            <option value="5" <?= set_value('Month') == '5' ? 'selected' : ''?>>Mei</option>
                            <option value="6" <?= set_value('Month') == '6' ? 'selected' : ''?>>Juni</option>
                            <option value="7" <?= set_value('Month') == '7' ? 'selected' : ''?>>Juli</option>
                            <option value="8" <?= set_value('Month') == '8' ? 'selected' : ''?>>Agustus</option>
                            <option value="9" <?= set_value('Month') == '9' ? 'selected' : ''?>>September</option>
                            <option value="10" <?= set_value('Month') == '10' ? 'selected' : ''?>>Oktober</option>
                            <option value="11" <?= set_value('Month') == '11' ? 'selected' : ''?>>November</option>
                            <option value="12" <?= set_value('Month') == '12' ? 'selected' : ''?>>Desember</option>
                        </select>
                    </div>
                    <br />
                    <label for="Name" class="element">Nama Tanda Penghargaan <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Name" name="Name" class="form-control" type="text"
                            placeholder="Nama Tanda Penghargaan..." value="<?= set_value('Name');?>" />
                    </div>
                    <br>
                    <label for="Institute" class="element">Nama Lembaga yang Memberikan <span class="required">
                            *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Institute" name="Institute" class="form-control" type="text"
                            placeholder="Nama Lembaga yang Memberikan..." value="<?= set_value('Institute');?>" />
                    </div>
                    <br>
                    <label for="City" class="element">Lokasi Kota <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="City" name="City" class="form-control" type="text" placeholder="Lokasi Kota..."
                            value="<?= set_value('City');?>" />
                    </div>
                    <br>
                    <label for="Prov" class="element">Lokasi Provinsi <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Prov" name="Prov" class="form-control" type="text" placeholder="Lokasi Provinsi..."
                            value="<?= set_value('Prov');?>" />
                    </div>
                    <br>
                    <label for="Country" class="element">Lokasi Negara <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Country" name="Country" class="form-control" type="text"
                            placeholder="Lokasi Negara..." value="<?= set_value('Country');?>" />
                    </div>
                    <br>
                    <label for="Level" class="element">
                        <span class="required">Penghargaan yang diterima tingkat *</span>&nbsp; </label>
                    <div class="element">
                        <select name="Level" id="Level" class="form-control">
                            <option value="Mud" <?= set_value('Level') == "Mud" ? 'selected' : ''?>>Tingkatan
                                Muda/Pemula</option>
                            <option value="Mad" <?= set_value('Level') == "Mad" ? 'selected' : ''?>>Tingkatan Madya
                            </option>
                            <option value="Uta" <?= set_value('Level') == "Uta" ? 'selected' : ''?>>Tingkatan Utama
                            </option>
                        </select>
                    </div>
                    <br>
                    <label for="InstituteType" class="element">
                        Penghargaan diberikan oleh lembaga <span class="required"> *</span>&nbsp;</label>
                    <div class="element">
                        <select name="InstituteType" id="InstituteType" class="form-control">
                            <option value="Lok" <?= set_value('InstituteType') == "Lok" ? 'selected' : ''?>>Penghargaan
                                Lokal</option>
                            <option value="Nas" <?= set_value('InstituteType') == "Nas" ? 'selected' : ''?>>Penghargaan
                                Nasional</option>
                            <option value="Reg" <?= set_value('InstituteType') == "Reg" ? 'selected' : ''?>>Penghargaan
                                Regional</option>
                            <option value="Int" <?= set_value('InstituteType') == "Int" ? 'selected' : ''?>>Penghargaan
                                Internasional</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="Desc" class="element">Uraian Singkat Tanda Penghargaan<span class="required">
                                *</span>&nbsp;</label>
                        <div class="element">
                            <textarea id="Desc" name="Desc" class="form-control"
                                placeholder="Uraian Singkat Tanda Penghargaan..."><?= set_value('Desc');?></textarea>
                        </div>
                    </div>
                    <label for="File" class="element">Bukti Tanda Penghargaan</label>
                    <div class="element">
                        <input class="form-control" id="File" name="File" type="file" />
                    </div>
                    <br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Tanda Penghargaan</button>
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