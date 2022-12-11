<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Form Profile</h3>
        </div>
        <!-- /.card-header -->

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/myprofile/buatprofileproses" method="post" enctype="multipart/form-data">
                <input type="hidden" id="user_id" name="user_id" value="<?= $user_id; ?>">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Data Diri</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="fullname" class="element">Nama Lengkap <span class="required"> *</span>&nbsp;
                            </label>
                            <div class="element">
                                <input id="fullname" name="fullname" type="text" class="form-control" placeholder="Nama Lengkap..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="birthplace" class="element">Tempat Lahir <span class="required"> *</span>&nbsp;
                            </label>
                            <div class="element">
                                <input id="birthplace" name="birthplace" type="text" class="form-control" placeholder="Tempat Lahir..." />
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
                                <input type="text" class="form-control float-right data-datepicker" id="birthdate" name="birthdate" placeholder="Tanggal Lahir..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kta" class="element">Nomor Kartu Tanda Anggota (KTA) <b>(Jika ada)</b>
                            </label>
                            <div class="element">
                                <input id="kta" name="kta" type="text" class="form-control" placeholder="Nomor Kartu Tanda Anggota (KTA)..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vocational" class="element">Badan Kejuruan <span class="required">
                                    *</span>&nbsp;
                            </label>
                            <div class="element">
                                <select name="vocational" id="vocational" class="form-control">
                                    <option value="Ars">Arsitektur</option>
                                    <option value="Ele">Teknik Elektro</option>
                                    <option value="Wil">Teknik Kewilayahan dan Perkotaan</option>
                                    <option value="Ind">Teknik Industri</option>
                                    <option value="Kim">Teknik Kimia</option>
                                    <option value="Mes">Teknik Mesin</option>
                                    <option value="Lin">Teknik Lingkungan</option>
                                    <option value="Sip">Teknik Sipil</option>
                                    <option value="Mat">Teknik Material</option>
                                    <option value="Met">Teknik Metalurgi</option>
                                    <option value="Inf">Teknik Informatika</option>
                                    <option value="Kap">Teknik Perkapalan</option>
                                    <option value="Tra">Transportasi</option>
                                    <option value="Kom">Teknik Komputer</option>
                                    <option value="Bio">Teknik Biomedik</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="haddress" class="element">Alamat Rumah <span class="required">
                                    *</span>&nbsp;</label>
                            <div class="element">
                                <textarea id="haddress" name="haddress" class="form-control" placeholder="Alamat Rumah..."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hcity" class="element">Kota <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="hcity" name="hcity" type="text" class="form-control" placeholder="Kota..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hpostnum" class="element">Kode Pos <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="hpostnum" name="hpostnum" type="text" class="form-control" placeholder="Kode Pos..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hnum" class="element">Telepon Rumah</label>
                            <div class="element">
                                <input id="hnum" name="hnum" type="text" class="form-control" placeholder="Telepon Rumah..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hpnum" class="element">Nomor Mobile <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="hpnum" name="hpnum" type="text" class="form-control" placeholder="Nomor Mobile..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hfaks" class="element">Nomor Faks Rumah</label>
                            <div class="element">
                                <input id="hfaks" name="hfaks" type="text" class="form-control" placeholder="Nomor Faks Rumah..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="htelex" class="element">Nomor Telex Rumah</label>
                            <div class="element">
                                <input id="htelex" name="htelex" type="text" class="form-control" placeholder="Nomor Telex Rumah..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hemail" class="element">Email <span class="required"> *</span>&nbsp;</label>
                            <div class="element">
                                <input id="hemail" name="hemail" type="text" class="form-control" placeholder="Email..." />
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
                                <input id="work" name="work" type="text" class="form-control" placeholder="Tempat Kerja..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="position" class="element">Posisi/Jabatan <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="position" name="position" type="text" class="form-control" placeholder="Posisi/Jabatan..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="waddr" class="element">Alamat Kantor <span class="required">*</span>&nbsp;
                            </label>
                            <div class="element">
                                <textarea id="waddr" name="waddr" class="form-control" placeholder="Alamat Kantor..."></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wcity" class="element">Kota <span class="required">*</span>&nbsp;
                            </label>
                            <div class="element">
                                <input id="wcity" name="wcity" type="text" class="form-control" placeholder="Kota Alamat Kantor..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wpostnum" class="element">Kode Pos Alamat Kantor <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="wpostnum" name="wpostnum" type="text" class="form-control" placeholder="Kode Pos Alamat Kantor..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wnum" class="element">Telepon Kantor <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="wnum" name="wnum" type="text" class="form-control" placeholder="Telepon Kantor..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wfaks" class="element">Faks Kantor</label>
                            <div class="element">
                                <input id="wfaks" name="wfaks" type="text" class="form-control" placeholder="Nomor Faks Kantor..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wtelex" class="element">Telex Kantor</label>
                            <div class="element">
                                <input id="wtelex" name="wtelex" type="text" class="form-control" placeholder="Nomor Telex Kantor..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wemail1" class="element">Email Kantor 1 <span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="wemail1" name="wemail1" type="text" class="form-control" placeholder="Email Kantor 1..." />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wemail2" class="element">Email Kantor 2</label>
                            <div class="element">
                                <input id="wemail2" name="wemail2" type="text" class="form-control" placeholder="Email Kantor 2..." />
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
                            <label for="photo" class="element">Foto (Format: .jpg, .jpeg, .png | Ukuran Maksimum:
                                700KB)<span class="required">*</span>&nbsp;</label>
                            <div class="element">
                                <input id="photo" name="photo" type="file" class="form-control" placeholder="Foto..." />
                            </div>
                        </div>
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
                        <button type="submit" name="submit" value="submit" class="btn btn-primary col">Buat
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