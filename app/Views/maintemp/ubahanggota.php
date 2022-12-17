<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Form Ubah Data Anggota</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/manuser/ubahanggotaproses" method="post" enctype="multipart/form-data">
                <input type="hidden" id="user_id" name="user_id" value="<?= $user_id; ?>" />
                <input type="hidden" id="signed" name="signed" value="<?= $signed; ?>>" />
                <div class="form-group">
                    <label for="username" class="element">Username <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="username" name="username" class="form-control" type="text" placeholder="Username..." value="<?= $username; ?>" disabled />
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
                        <input id="confpass" name="confpass" class="form-control" type="password" placeholder="Konfirmasi Password..." />
                    </div>
                    <br />
                    <label for="aktif" class="element">
                        <span class="required">Anggota Aktif *</span>&nbsp; </label>
                    <div class="element">
                        <select name="aktif" id="aktif" class="form-control">
                            <option value="yes" <?php echo $active == "yes" ? "selected" : ""; ?>>Ya</option>
                            <option value="no" <?php echo $active == "no" ? "selected" : ""; ?>>Tidak</option>
                        </select>
                    </div>
                    <br>
                    <label for="nodaftar" class="element">Nomor Pendaftaran (Diisi Jika Calon Peserta)</label>
                    <div class="element">
                        <input id="nodaftar" name="nodaftar" class="form-control" type="text" placeholder="Nomor Pendaftaran..." value="<?= $nodaftar; ?>" />
                    </div>
                    <br />
                    <label for="npm" class="element">NPM (Diisi Jika Peserta)</label>
                    <div class="element">
                        <input id="npm" name="npm" class="form-control" type="text" placeholder="NPM..." value="<?= $NPM; ?>" />
                    </div>
                    <br />
                    <label for="nip" class="element">NIP (Diisi Jika Staff/Penilai)</label>
                    <div class="element">
                        <input id="nip" name="nip" class="form-control" placeholder="NIP..." type="text" value="<?= $NIP; ?>" />
                    </div>
                    <br />
                    <label for="status" class="element">Status <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="status" id="status" class="form-control">
                            <option value="baru" <?php echo $status == "baru" ? "selected" : ""; ?>>Baru Mendaftar
                            </option>
                            <option value="diterima" <?php echo $status == "diterima" ? "selected" : ""; ?>>Sudah
                                Diterima</option>
                            <option value="ditolak" <?php echo $status == "ditolak" ? "selected" : ""; ?>>Ditolak
                            </option>
                            <option value="lulus" <?php echo $status == "lulus" ? "selected" : ""; ?>>Lulus</option>
                            <option value="keluar" <?php echo $status == "keluar" ? "selected" : ""; ?>>Keluar / DO
                            </option>
                            <option value="diterima" <?php echo $status == "diterima" ? "selected" : ""; ?>>Sudah
                                Diterima</option>
                            <option value="staff" <?php echo $status == "staff" ? "selected" : ""; ?>>Staff / Penilai
                            </option>
                        </select>
                    </div>
                    <br />
                    <label for="thnajaran" class="element">Tahun Ajaran Masuk <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="thnajaran" id="thnajaran" class="form-control">
                            <?php
                            $lastyear = date("Y") + 10;
                            for ($tahun1 = 1901; $tahun1 <= $lastyear; $tahun1++) {
                                if ($tahun1 == $thnajaran) {
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
                    <label for="semester" class="element">Semester <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select name="semester" id="semester" class="form-control">
                            <option value="Ganjil" <?php echo $semester == "Ganjil" ? "selected" : ""; ?>>Ganjil</option>
                            <option value="Genap" <?php echo $semester == "Genap" ? "selected" : ""; ?>>Genap</option>
                        </select>
                    </div>
                    <br />
                    <label for="tipeuser" class="element">Tipe User</label>
                    <div class="element">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="superadmin" name="superadmin" value="yes" <?php echo $tipe_user[0] == "y" ? "checked" : ""; ?>>
                            <label for="superadmin" class="custom-control-label">Super Admin</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="admin" name="admin" value="yes" <?php echo $tipe_user[1] == "y" ? "checked" : ""; ?>>
                            <label for="admin" class="custom-control-label">Admin</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="penilai" name="penilai" value="yes" <?php echo $tipe_user[2] == "y" ? "checked" : ""; ?>>
                            <label for="penilai" class="custom-control-label">Penilai</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="peserta" name="peserta" value="yes" <?php echo $tipe_user[3] == "y" ? "checked" : ""; ?>>
                            <label for="peserta" class="custom-control-label">Peserta</label>
                        </div>
                    </div>
                    <br />
                    <label for="filesigned" class="element">Scan tanda tangan</label>
                    <div class="element">
                        <input id="filesigned" name="filesigned" type="file" class="form-control" placeholder="Scan tanda tangan..." />
                    </div>
                    <br />
                    <label for="confirmcapes" class="element">Konfirmasi Calon Peserta PPI RPL</label>
                    <div class="element">
                        <select name="confirmcapes" id="confirmcapes" class="form-control">
                            <option value="Ya" <?php echo $confirmcapes == "Ya" ? "selected" : ""; ?>>Ya</option>
                            <option value="Tidak" <?php echo $confirmcapes == "Tidak" ? "selected" : ""; ?>>Tidak
                            </option>
                        </select>
                    </div>
                    <br />
                    <label for="confirmfair" class="element">Konfirmasi Dokumen Fair</label>
                    <div class="element">
                        <select name="confirmfair" id="confirmfair" class="form-control">
                            <option value="Ya" <?php echo $confirmfair == "Ya" ? "selected" : ""; ?>>Ya</option>
                            <option value="Tidak" <?php echo $confirmfair == "Tidak" ? "selected" : ""; ?>>Tidak</option>
                        </select>
                    </div><br /><br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Ubah
                                Anggota</button>
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