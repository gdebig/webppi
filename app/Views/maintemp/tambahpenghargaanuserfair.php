<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Tambah Penghargaan</h3>
        </div>
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
                                    if ($tahun1 == $now){
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
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <br />
                    <label for="Name" class="element">Nama Tanda Penghargaan <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Name" name="Name" class="form-control" type="text"
                            placeholder="Nama Tanda Penghargaan..." />
                    </div>
                    <br>
                    <label for="Institute" class="element">Nama Lembaga yang Memberikan <span class="required">
                            *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Institute" name="Institute" class="form-control" type="text"
                            placeholder="Nama Lembaga yang Memberikan..." />
                    </div>
                    <br>
                    <label for="City" class="element">Lokasi Kota <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="City" name="City" class="form-control" type="text" placeholder="Lokasi Kota..." />
                    </div>
                    <br>
                    <label for="Prov" class="element">Lokasi Provinsi <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Prov" name="Prov" class="form-control" type="text"
                            placeholder="Lokasi Provinsi..." />
                    </div>
                    <br>
                    <label for="Country" class="element">Lokasi Negara <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Country" name="Country" class="form-control" type="text"
                            placeholder="Lokasi Negara..." />
                    </div>
                    <br>
                    <label for="Level" class="element">
                        <span class="required">Penghargaan yang diterima tingkat *</span>&nbsp; </label>
                    <div class="element">
                        <select name="Level" id="Level" class="form-control">
                            <option value="Mud">Tingkatan Muda/Pemula</option>
                            <option value="Mad">Tingkatan Madya</option>
                            <option value="Uta">Tingkatan Utama</option>
                        </select>
                    </div>
                    <br>
                    <label for="InstituteType" class="element">
                        Penghargaan diberikan oleh lembaga <span class="required"> *</span>&nbsp;</label>
                    <div class="element">
                        <select name="InstituteType" id="InstituteType" class="form-control">
                            <option value="Lok">Penghargaan Lokal</option>
                            <option value="Nas">Penghargaan Nasional</option>
                            <option value="Reg">Penghargaan Regional</option>
                            <option value="Int">Penghargaan Internasional</option>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="Desc" class="element">Uraian Singkat Tanda Penghargaan<span class="required">
                                *</span>&nbsp;</label>
                        <div class="element">
                            <textarea id="Desc" name="Desc" class="form-control"
                                placeholder="Uraian Singkat Tanda Penghargaan..."></textarea>
                        </div>
                    </div>
                    <br />
                    <label for="komp14" class="element">Klaim Kompetensi (Gunakan tombol ctrl + klik kiri mouse untuk
                        memilih
                        lebih dari satu kompetensi)<span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select multiple class="form-control" name="komp14[]" id="komp14" size="10">
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
                                        echo "<option value='".$komp['komp_code']."' title='".$komp['komp_desc']."'>".$komp['komp_code']." ".$komp['komp_desc']."</option>";
                                    }
                                }
                                $i++;
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <br />
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