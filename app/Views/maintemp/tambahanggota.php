<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Form Tambah Anggota</h3>
        </div>

        <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?= $validation->listErrors()?></div>
        <?php endif;?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url();?>/manuser/tambahanggotaproses" method="post"
                enctype="multipart/form-data">
                <input type="hidden" id="user_id" name="user_id" value="<?= $user_id;?>" />
                <div class="form-group">
                    <label for="username" class="element">Username <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="username" name="username" class="form-control" type="text"
                            placeholder="Username..." />
                    </div>
                    <br />
                    <label for="pass1" class="element">Password <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="pass1" name="pass1" class="form-control" type="password" placeholder="Password..." />
                    </div>
                    <br />
                    <label for="confpass" class="element">Konfirmasi Password <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="confpass" name="confpass" class="form-control" type="password"
                            placeholder="Konfirmasi Password..." />
                    </div>
                    <br />
                    <label for="aktif" class="element">
                        <span class="required">Anggota Aktif *</span>&nbsp; </label>
                    <div class="element">
                        <select name="aktif" id="aktif" class="form-control">
                            <option value="yes">Ya</option>
                            <option value="no">Tidak</option>
                        </select>
                    </div>
                    <br>
                    <label for="nodaftar" class="element">Nomor Pendaftaran (Diisi Jika Calon Peserta)</label>
                    <div class="element">
                        <input id="nodaftar" name="nodaftar" class="form-control" type="text"
                            placeholder="Nomor Pendaftaran..." />
                    </div>
                    <br />
                    <label for="npm" class="element">NPM (Diisi Jika Peserta)</label>
                    <div class="element">
                        <input id="npm" name="npm" class="form-control" type="text" placeholder="NPM..." />
                    </div>
                    <br />
                    <label for="nip" class="element">NIP (Diisi Jika Staff/Penilai)</label>
                    <div class="element">
                        <input id="nip" name="nip" class="form-control" placeholder="NIP..." type="text" />
                    </div>
                    <br />
                    <label for="status" class="element">Status <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="status" id="status" class="form-control">
                            <option value="baru">Baru Mendaftar</option>
                            <option value="diterima">Sudah Diterima</option>
                            <option value="ditolak">Ditolak</option>
                            <option value="lulus">Lulus</option>
                            <option value="keluar">Keluar / DO</option>
                            <option value="diterima">Sudah Diterima</option>
                            <option value="staff">Staff / Penilai</option>
                        </select>
                    </div>
                    <br />
                    <label for="thnajaran" class="element">Tahun Ajaran Masuk <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="thnajaran" id="thnajaran" class="form-control">
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
                    <label for="semester" class="element">Semester <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="semester" id="semester" class="form-control">
                            <option value="Ganjil">Ganjil</option>
                            <option value="Genap">Genap</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Anggota</button>
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