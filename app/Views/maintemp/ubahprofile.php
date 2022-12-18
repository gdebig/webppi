<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Ubah Profile</h3>
        </div>
        <!-- /.card-header -->

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/myprofile/ubahproses" method="post" enctype="multipart/form-data">
                <input type="hidden" id="user_id" name="user_id" value="<?= $user_id; ?>">
                <input type="hidden" id="profile_id" name="profile_id" value="<?= $ID; ?>">
                <input type="hidden" id="photoname" name="photoname" value="<?= $Photo; ?>">
                <input type="hidden" id="sipname" name="sipname" value="<?= $SIP; ?>">
                <input type="hidden" id="oldsigned" name="oldsigned" value="<?= $signed; ?>">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Data Diri</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="fullname" class="element">Nama Lengkap <span class="required"> *</span>&nbsp;
                            </label>
                            <div class="element">
                                <input id="fullname" name="fullname" type="text" class="form-control" placeholder="Nama Lengkap..." value="<?php echo $FullName; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birthplace" class="element">Tempat Lahir <span class="required"> *</span>&nbsp;
                            </label>
                            <div class="element">
                                <input id="birthplace" name="birthplace" type="text" class="form-control" placeholder="Tempat Lahir..." value="<?php echo $BirthPlace; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birthdate" class="element">Tanggal Lahir <span class="required"> *</span>&nbsp;
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right data-datepicker" id="birthdate" name="birthdate" placeholder="Tanggal Lahir..." value="<?php echo $BirthDate; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kta" class="element">Nomor Kartu Tanda Anggota (KTA) <b>(Jika ada)</b>
                            </label>
                            <div class="element">
                                <input id="kta" name="kta" type="text" class="form-control" placeholder="Nomor Kartu Tanda Anggota (KTA)..." value="<?php echo $KTA; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vocational" class="element">Badan Kejuruan <span class="required">
                                    *</span>&nbsp;
                            </label>
                            <div class="element">
                                <select name="vocational" id="vocational" class="form-control">
                                    <option value="Ars" <?php echo $Vocational == "Ars" ? "selected" : ""; ?>>Arsitektur
                                    </option>
                                    <option value="Ele" <?php echo $Vocational == "Ele" ? "selected" : ""; ?>>Teknik
                                        Elektro
                                    </option>
                                    <option value="Ind" <?php echo $Vocational == "Ind" ? "selected" : ""; ?>>Teknik
                                        Industri
                                    </option>
                                    <option value="Kim" <?php echo $Vocational == "Kim" ? "selected" : ""; ?>>Teknik
                                        Kimia
                                    </option>
                                    <option value="Mes" <?php echo $Vocational == "Mes" ? "selected" : ""; ?>>Teknik
                                        Mesin
                                    </option>
                                    <option value="Lin" <?php echo $Vocational == "Lin" ? "selected" : ""; ?>>Teknik
                                        Lingkungan</option>
                                    <option value="Sip" <?php echo $Vocational == "Sip" ? "selected" : ""; ?>>Teknik
                                        Sipil
                                    </option>
                                    <option value="Mat" <?php echo $Vocational == "Mat" ? "selected" : ""; ?>>Teknik
                                        Material
                                    </option>
                                    <option value="Met" <?php echo $Vocational == "Met" ? "selected" : ""; ?>>Teknik
                                        Metalurgi</option>
                                    <option value="Inf" <?php echo $Vocational == "Inf" ? "selected" : ""; ?>>Teknik
                                        Informatika</option>
                                    <option value="Kap" <?php echo $Vocational == "Kap" ? "selected" : ""; ?>>Teknik
                                        Perkapalan</option>
                                    <option value="Kom" <?php echo $Vocational == "Kom" ? "selected" : ""; ?>>Teknik
                                        Komputer</option>
                                    <option value="Bio" <?php echo $Vocational == "Bio" ? "selected" : ""; ?>>Teknik
                                        Biomedik</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="haddress" class="element">Alamat Rumah <span class="required">
                                    *</span>&nbsp;</label>
                            <div class="element">
                                <textarea id="haddress" name="haddress" class="form-control" placeholder="Alamat Rumah..."><?php echo $HAddr; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hcity" class="element">Kota <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="hcity" name="hcity" type="text" class="form-control" placeholder="Kota..." value="<?php echo $HCity; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hpostnum" class="element">Kode Pos <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="hpostnum" name="hpostnum" type="text" class="form-control" placeholder="Kode Pos..." value="<?php echo $HPostnum; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hnum" class="element">Telepon Rumah</label>
                            <div class="element">
                                <input id="hnum" name="hnum" type="text" class="form-control" placeholder="Telepon Rumah..." value="<?php echo $Hnum; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hpnum" class="element">Nomor Mobile <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="hpnum" name="hpnum" type="text" class="form-control" placeholder="Nomor Mobile..." value="<?php echo $Hpnum; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hfaks" class="element">Nomor Faks Rumah</label>
                            <div class="element">
                                <input id="hfaks" name="hfaks" type="text" class="form-control" placeholder="Nomor Faks Rumah..." value="<?php echo $Hfaks; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="htelex" class="element">Nomor Telex Rumah</label>
                            <div class="element">
                                <input id="htelex" name="htelex" type="text" class="form-control" placeholder="Nomor Telex Rumah..." value="<?php echo $Htelex; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hemail" class="element">Email <span class="required"> *</span>&nbsp;</label>
                            <div class="element">
                                <input id="hemail" name="hemail" type="text" class="form-control" placeholder="Email..." value="<?php echo $Hemail; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Data Pekerjaan</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="work" class="element">Tempat Kerja <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="work" name="work" type="text" class="form-control" placeholder="Tempat Kerja..." value="<?php echo $Work; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="position" class="element">Posisi/Jabatan <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="position" name="position" type="text" class="form-control" placeholder="Posisi/Jabatan..." value="<?php echo $Position; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="waddr" class="element">Alamat Kantor <span class="required">*</span>&nbsp;
                            </label>
                            <div class="element">
                                <textarea id="waddr" name="waddr" class="form-control" placeholder="Alamat Kantor..."><?php echo $WAddr; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wcity" class="element">Kota <span class="required">*</span>&nbsp;
                            </label>
                            <div class="element">
                                <input id="wcity" name="wcity" type="text" class="form-control" placeholder="Kota Alamat Kantor..." value="<?php echo $WCity; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wpostnum" class="element">Kode Pos Alamat Kantor <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="wpostnum" name="wpostnum" type="text" class="form-control" placeholder="Kode Pos Alamat Kantor..." value="<?php echo $Wpostnum; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wnum" class="element">Telepon Kantor <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="wnum" name="wnum" type="text" class="form-control" placeholder="Telepon Kantor..." value="<?php echo $Wnum; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wfaks" class="element">Faks Kantor</label>
                            <div class="element">
                                <input id="wfaks" name="wfaks" type="text" class="form-control" placeholder="Nomor Faks Kantor..." value="<?php echo $Wfaks; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wtelex" class="element">Telex Kantor</label>
                            <div class="element">
                                <input id="wtelex" name="wtelex" type="text" class="form-control" placeholder="Nomor Telex Kantor..." value="<?php echo $Wtelex; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wemail1" class="element">Email Kantor 1 <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="wemail1" name="wemail1" type="text" class="form-control" placeholder="Email Kantor 1..." value="<?php echo $Wemail1; ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wemail2" class="element">Email Kantor 2</label>
                            <div class="element">
                                <input id="wemail2" name="wemail2" type="text" class="form-control" placeholder="Email Kantor 2..." value="<?php echo $Wemail2; ?>" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Data Lain</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="sip" class="element">Apakah anda memiliki SIP?Jika iya, unggah softcopy SIP anda
                                di sini (Format: .pdf, .jpeg, .png | Ukuran Maksimum: 700KB).</label>
                            <div class="element">
                                <input id="sip" name="sip" type="file" class="form-control" placeholder="Nomor SIP..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="photo" class="element">Foto (Format: .jpg, .jpeg, .png | Ukuran Maksimum:
                                700KB) <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="photo" name="photo" type="file" class="form-control" placeholder="Foto..." />
                            </div>
                        </div>
                        <?php
                        if ($role != 'peserta') {
                        ?>
                            <div class="form-group">
                                <label for="NIP" class="element">NIP/NUP</label>
                                <div class="element">
                                    <input id="NIP" name="NIP" type="text" class="form-control" placeholder="NIP/NUP..." value="<?php echo $NIP; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="filettd" class="element">TTD Digital</label>
                                <div class="element">
                                    <input id="filettd" name="filettd" type="file" class="form-control" placeholder="TTD Digital..." />
                                </div>
                            </div>
                        <?php
                        } elseif ($role == 'peserta') {
                        ?>
                            <div class="form-group">
                                <label for="NPM" class="element">NPM</label>
                                <div class="element">
                                    <input id="NPM" name="NPM" type="text" class="form-control" placeholder="NPM..." value="<?php echo $NPM; ?>" />
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Field bertanda * harus diisi.</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary col">Ubah
                            Profile</button>
                    </div>
                    <div class="col">
                        <button type="submit" name="submit" value="batal" class="btn btn-block btn-danger col">Batal</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.content-wrapper -->
    </div>
</div>

<?= $this->endSection(); ?>