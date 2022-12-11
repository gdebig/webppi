<?= $this->extend('register/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Pendidikan</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <label for="Rank" class="element">
                <span class="required">Pendidikan Terakhir *</span>&nbsp; </label>
            <div class="element">
                <select name="birth_date[d]">
                    <option value="Rank">Pendidikan Terakhir</option>
                    <option value="S1">Strata 1</option>
                    <option value="S2">Strata 2</option>
                    <option value="S3">Strata 3</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="Name" class="element">Nama Universitas <span class="required"> *</span>&nbsp; </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
                <label for="Faculty" class="element">Fakultas <span class="required"> *</span>&nbsp; </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
                <label for="Major" class="element">Jurusan <span class="required"> *</span>&nbsp; </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
                <label for="City" class="element">Kota Universitas <span class="required"> *</span>&nbsp; </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
                <label for="Country" class="element">Negara Universitas <span class="required"> *</span>&nbsp; </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
                <label for="GradYear" class="element">Tahun Kelulusan <span class="required"> *</span>&nbsp; </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
                <label for="Title" class="element">Gelar <span class="required"> *</span>&nbsp; </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
                <label for="Desc" class="element">Deskripsi</label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
                <label for="Mark" class="element">Mark <span class="required"> *</span>&nbsp; </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
                <label for="Judicium" class="element">Yudisium <span class="required"> *</span>&nbsp; </label>
                <div class="element">
                    <input style="width:20em" size="100" type="text" />
                </div>
                <br />
            </div>` <br />
            <label for="Photo">Upload Foto Ijazah <span class="required"> *</span>&nbsp; </label>
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
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>