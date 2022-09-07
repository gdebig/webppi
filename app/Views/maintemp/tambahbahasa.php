<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Tambah Bahasa yang Dikuasai</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url();?>/userfair6/tambahbahasaproses" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Name" class="element">Nama Bahasa <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input class="form-control" id="Name" name="Name" type="text" placeholder="Nama Bahasa..." />
                    </div>
                    <br />
                    <label for="LangType" class="element">Jenis Bahasa <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="LangType" id="LangType" class="form-control">
                            <option value="Da">Bahasa Daerah</option>
                            <option value="Na">Bahasa Nasional</option>
                            <option value="In">Bahasa Asing / Internasional</option>
                        </select>
                    </div>
                    <br />
                    <label for="VerbSkill" class="element">Kemampuan Verbal Aktif/Pasif <span class="required">
                            *</span>&nbsp; </label>
                    <div class="element">
                        <select name="VerbSkill" id="VerbSkill" class="form-control">
                            <option value="Pasif">Pasif, Tertulis</option>
                            <option value="Aktif">Aktif, Tertulis/Lisan</option>
                        </select>
                    </div>
                    <br />
                    <label for="WriteType" class="element">Jenis Tulisan yang Mampu Disusun <span class="required">
                            *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="WriteType" name="WriteType" type="text"
                            placeholder="Jenis Tulisan yang Mampu Disusun..." />
                    </div>
                    <br />
                    <label for="LangMark" class="element">Nilai TOEFL atau yang Sejenisnya</label>
                    <div class="element">
                        <input class="form-control" id="WriteType" name="WriteType" type="text"
                            placeholder="Nilai TOEFL atau yang Sejenisnya..." />
                    </div>
                    <br />
                    <label for="komp6" class="element">Kompetensi (Gunakan tombol ctrl + klik kiri mouse untuk memilih
                        lebih dari satu kompetensi)<span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select multiple class="form-control" name="komp6[]" id="komp6" size="10">
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
                    <label for="File" class="element">Bukti Bahasa</label>
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
                                Bahasa</button>
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