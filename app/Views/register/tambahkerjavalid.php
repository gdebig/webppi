<?= $this->extend('register/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Pengalaman Kerja</h3>
        </div>

        <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?= $validation->listErrors()?></div>
        <?php endif;?>
        <br />
        <div class="col">
            <div class="row">
                <p>Silakan isikan pengalaman kerja disini, dapat berupa:</p>
                <ul>
                    <li>Pengalaman Dalam Perencanan & Perancangan dan/atau Pengalaman Dalam Pengelolaan Tugas-Tugas
                        Keinsinyuran,</li>
                    <li>Pengalaman Dalam Penelitian, Pengembangan dan Komersialisasi dan/atau Pengalaman Menangani Bahan
                        Material dan Komponen,</li>
                    <li>Pengalaman Dalam Konsultasi Perekayasaan dan/atau Konstruksi/Instalasi dan/atau Pengalaman Dalam
                        Pekerjaan Manufaktur atau Produksi,</li>
                    <li>Pengalaman Manajemen Usaha & Pemasaran Teknik dan/atau Pengalaman dalam Pembangunan dan
                        Pemeliharaan Aset,</li>
                    <li>dll</li>
                </ul>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url();?>/register/tambahkerjaproses" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="startdate" class="element">Tanggal Mulai Kerja <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right data-datepicker" id="startdate"
                            name="startdate" placeholder="Tanggal Mulai Kerja..."
                            value="<?php echo set_value('startdate');?>" />
                    </div><br />
                    <div class="element">
                        <input type="checkbox" id="masihkerja" name="masihkerja" value="masihkerja"
                            <?php echo set_value('masihkerja') == "masihkerja" ? 'checked' : '';?>> <label
                            for="masihkerja">Saya masih bekerja</label>
                    </div><br />
                    <label for="enddate" class="element">Tanggal Berakhir Kerja (Kosongkan kalau masih dijalani)</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right data-datepicker" id="enddate" name="enddate"
                            placeholder="Tanggal Berakhir Kerja..." value="<?php echo set_value('enddate');?>" />
                    </div><br />
                    <label for="NameInstance" class="element">Nama Instansi / Perusahaan
                        <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="NameInstance" name="NameInstance" type="text"
                            placeholder="Nama Instansi / Perusahaan..."
                            value="<?php echo set_value('NameInstance');?>" />
                    </div><br />
                    <label for="Position" class="element">Jabatan/Tugas <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="Position" name="Position" type="text"
                            placeholder="Jabatan/Tugas..." value="<?php echo set_value('Position');?>" />
                    </div>
                    <br />
                    <label for="Name" class="element">Nama Aktifitas/Kegiatan/Proyek</label>
                    <div class="element">
                        <input class="form-control" id="Name" name="Name" type="text"
                            placeholder="Nama Aktifitas/Kegiatan/Proyek..." value="<?php echo set_value('Name');?>" />
                    </div>
                    <br />
                    <label for="Giver" class="element">Pemberi Tugas</label>
                    <div class="element">
                        <input class="form-control" id="Giver" name="Giver" type="text" placeholder="Pemberi Tugas..."
                            value="<?php echo set_value('Giver');?>" />
                    </div>
                    <br />
                    <label for="LocCity" class="element">Kota <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="LocCity" name="LocCity" type="text" placeholder="Kota..."
                            value="<?php echo set_value('LocCity');?>" />
                    </div>
                    <br />
                    <label for="LocProv" class="element">Provinsi <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="LocProv" name="LocProv" type="text" placeholder="Provinsi..."
                            value="<?php echo set_value('LocProv');?>" />
                    </div>
                    <br />
                    <label for="LogCountry" class="element">Negara <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="LocCountry" name="LocCountry" type="text"
                            placeholder="Negara..." value="<?php echo set_value('LocCountry');?>" />
                    </div>
                    <br />
                    <label for="Duration" class="element">Durasi</label>
                    <div class="element">
                        <select id="Duration" name="Duration" class="form-control">
                            <option value="smp3" <?php echo set_value('Duration') == "smp3" ? "selected" : "";?>>1 - 3
                                tahun</option>
                            <option value="smp7" <?php echo set_value('Duration') == "smp7" ? "selected" : "";?>>4 - 7
                                tahun</option>
                            <option value="smp10" <?php echo set_value('Duration') == "smp10" ? "selected" : "";?>>8 -
                                10 tahun</option>
                            <option value="lbh10" <?php echo set_value('Duration') == "lbh10" ? "selected" : "";?>>>
                                dari 10 tahun</option>
                        </select>
                    </div>
                    <br />
                    <label for="Jabatan" class="element">Posisi Tugas/Jabatan <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select id="Jabatan" name="Jabatan" class="form-control">
                            <option value="anggota" <?php echo set_value('Jabatan') == "anggota" ? "selected" : "";?>>
                                Anggota / Staff / Dosen</option>
                            <option value="supervisor"
                                <?php echo set_value('Jabatan') == "supervisor" ? "selected" : "";?>>Supervisor / Site
                                Engineer / Site Manager / KaLab / Sekretaris Jurusan / Ketua Jurusan / PD</option>
                            <option value="direktur" <?php echo set_value('Jabatan') == "direktur" ? "selected" : "";?>>
                                Direktur / Ketua Tim / Dekan / PR / Rektor</option>
                            <option value="pengarah" <?php echo set_value('Jabatan') == "pengarah" ? "selected" : "";?>>
                                Pengarah / Adviser / Narasumber Ahli</option>
                        </select>
                    </div>
                    <br />
                    <label for="ProjValue" class="element">Nilai Proyek</label>
                    <div class="element">
                        <input class="form-control" id="ProjValue" name="ProjValue" type="text"
                            placeholder="Nilai Proyek..." value="<?php echo set_value('ProjValue');?>" />
                    </div>
                    <br />
                    <label for="RspnValue" class="element">Nilai Tanggung Jawab</label>
                    <div class="element">
                        <input class="form-control" id="RspnValue" name="RspnValue" type="text"
                            placeholder="Nilai Tanggung Jawab..." value="<?php echo set_value('RspnValue');?>" />
                    </div>
                    <br />
                    <label for="Hresource" class="element">SDM yang terlibat</label>
                    <div class="element">
                        <select id="Hresource" name="Hresource" class="form-control">
                            <option value="dik" <?php echo set_value('Hresource') == "dik" ? "selected" : "";?>>Sedikit
                            </option>
                            <option value="sed" <?php echo set_value('Hresource') == "sed" ? "selected" : "";?>>Sedang
                            </option>
                            <option value="bny" <?php echo set_value('Hresource') == "bny" ? "selected" : "";?>>Banyak
                            </option>
                            <option value="sbny" <?php echo set_value('Hresource') == "sbny" ? "selected" : "";?>>Sangat
                                Banyak</option>
                        </select>
                    </div>
                    <br />
                    <label for="Diff" class="element">Tingkat Kesulitan</label>
                    <div class="element">
                        <select id="Diff" name="Diff" class="form-control">
                            <option value="ren" <?php echo set_value('Diff') == "ren" ? "selected" : "";?>>Rendah
                            </option>
                            <option value="sed" <?php echo set_value('Diff') == "sed" ? "selected" : "";?>>Sedang
                            </option>
                            <option value="tin" <?php echo set_value('Diff') == "tin" ? "selected" : "";?>>Tinggi
                            </option>
                            <option value="stin" <?php echo set_value('Diff') == "stin" ? "selected" : "";?>>Sangat
                                Tinggi</option>
                        </select>
                    </div>
                    <br />
                    <label for="Scale" class="element">Skala Proyek</label>
                    <div class="element">
                        <select id="Scale" name="Scale" class="form-control">
                            <option value="ren" <?php echo set_value('Scale') == "ren" ? "selected" : "";?>>Rendah
                            </option>
                            <option value="sed" <?php echo set_value('Scale') == "sed" ? "selected" : "";?>>Sedang
                            </option>
                            <option value="tin" <?php echo set_value('Scale') == "tin" ? "selected" : "";?>>Tinggi
                            </option>
                            <option value="stin" <?php echo set_value('Scale') == "stin" ? "selected" : "";?>>Sangat
                                Tinggi</option>
                        </select>
                    </div>
                    <br />
                    <label for="Desc" class="element">Uraian Singkat Tugas dan Tanggung Jawab Profesional sesuai
                        NSPK</label>
                    <div class="element">
                        <textarea class="form-control" id="Desc" name="Desc" placeholder="Deskripsi"
                            placeholder="Uraian Singkat..."><?php echo set_value('Desc');?></textarea>
                    </div>
                    <br />
                    <label for="File" class="element">Bukti Pengalaman Kerja</label>
                    <div class="element">
                        <input class="form-control" id="File" name="File" type="file" />
                    </div>
                    <br /><br />
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Pengalaman Kerja</button>
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