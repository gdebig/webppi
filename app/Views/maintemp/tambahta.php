<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Form Tambah Tugas Akhir</h3>
        </div>

        <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?= $validation->listErrors()?></div>
        <?php endif;?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url();?>/tugasakhir/tambahtaproses" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="ta_usuljudul" class="element">Judul Tugas Akhir <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="ta_usuljudul" name="ta_usuljudul" class="form-control" type="text"
                            placeholder="Judul Tugas Akhir..." />
                    </div>
                    <br />
                    <label for="ta_semester" class="element">Semester <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="ta_semester" id="ta_semester" class="form-control">
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <br />
                    <label for="ta_tahun" class="element">Tahun Tugas Akhir <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="ta_tahun" id="ta_tahun" class="form-control">
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
                    <label for="startdate" class="element">Tanggal Mulai <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right data-datepicker" id="startdate"
                            name="startdate" placeholder="Tanggal Mulai..." />
                    </div>
                    <br />
                    <label for="enddate" class="element">Tanggal Berakhir <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right data-datepicker" id="enddate" name="enddate"
                            placeholder="Tanggal Berakhir..." />
                    </div>
                    <br />
                    <label for="instansi" class="element">Nama Instansi <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="instansi" name="instansi" class="form-control" type="text"
                            placeholder="Nama Instansi..." />
                    </div>
                    <br />
                    <label for="divisi" class="element">Nama Divisi <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="divisi" name="divisi" class="form-control" type="text"
                            placeholder="Nama Divisi..." />
                    </div>
                    <br />
                    <label for="ta_buku" class="element">File Buku Tugas Akhir</label>
                    <div class="element">
                        <input id="ta_buku" name="ta_buku" type="file" class="form-control"
                            placeholder="File Buku TA..." />
                    </div>
                    <br />
                    <label for="ta_log" class="element">Log Tugas Akhir</label>
                    <div class="element">
                        <input id="ta_log" name="ta_log" type="file" class="form-control"
                            placeholder="File Log TA..." />
                    </div>
                    <br /><br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Tugas Akhir</button>
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