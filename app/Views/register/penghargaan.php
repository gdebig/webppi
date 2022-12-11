<?= $this->extend('register/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Penghargaan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <div class="form-group">
                <label for="Name" class="element">Nama Penghargaan <span class="required"> *</span>&nbsp; </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
                <label for="City" class="element">Bulan <span class="required"> *</span>&nbsp; </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
                <label for="Country" class="element">Tahun <span class="required"> *</span>&nbsp; </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
                <label for="Institute" class="element">Lembaga Penyelenggara <span class="required"> *</span>&nbsp;
                </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
                <label for="City" class="element">Kota Diselenggarakan <span class="required"> *</span>&nbsp; </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
                <label for="Country" class="element">Negara Diselenggarakan <span class="required"> *</span>&nbsp;
                </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
            </div>
            <br>
            <label for="Level" class="element">
                <span class="required">Jenis Penghargaan *</span>&nbsp; </label>
            <div class="element">
                <select name="">
                    <option value="Level">Pilih Jenis</option>
                    <option value="Mud">Tingkatan Muda/Pemula</option>
                    <option value="Mad">Tingkatan Madya</option>
                    <option value="Uta">Tingkatan Utama</option>
                </select>
            </div>
            <br>
            <label for="OrgScp" class="element">
                <span class="required">Tingkat Penghargaan *</span>&nbsp; </label>
            <div class="element">
                <select name="">
                    <option value="OrgScp">Pilih Tingkatan</option>
                    <option value="Loc">Penghargaan Lokal</option>
                    <option value="Nas">Penghargaan Nasional</option>
                    <option value="Reg">Penghargaan Regional</option>
                    <option value="Int">Penghargaan Internasional</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="Desc" class="element">Deskripsi</label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
            </div>
            <label for="Photo">Upload Bukti Penghargaan</label>
            <div class="element"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-body">
                            <div id="actions" class="row">
                                <div class="btn-group w-100">
                                    <span class="btn btn-success col fileinput-button dz-clickable">
                                        <i class="fas fa-plus"></i>
                                        <span>Add files</span>
                                    </span>
                                    <button type="submit" class="btn btn-primary col start">
                                        <i class="fas fa-upload"></i>
                                        <span>Start upload</span>
                                    </button>
                                    <button type="reset" class="btn btn-warning col cancel">
                                        <i class="fas fa-times-circle"></i>
                                        <span>Cancel upload</span>
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <div class=" d-flex align-items-center">
                                        <div class="fileupload-process w-100">
                                            <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                                <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table table-striped files" id="previews"></div>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-block btn-default ">Simpan</button>
                        </td>
                    </tr>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>