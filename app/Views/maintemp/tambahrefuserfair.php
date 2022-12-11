<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Tambah Referensi Kode Etik</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/userfair21/tambahrefproses" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Name" class="element">Nama Lengkap <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Name" name="Name" class="form-control" type="text" placeholder="Nama Lengkap..." />
                    </div>
                    <br />
                    <label for="Addr" class="element">Alamat <span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <textarea id="Addr" name="Addr" class="form-control" placeholder="Alamat..."></textarea>
                    </div>
                    <br />
                    <label for="City" class="element">Lokasi Kota <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="City" name="City" class="form-control" type="text" placeholder="Lokasi Kota..." />
                    </div>
                    <br />
                    <label for="Prov" class="element">Lokasi Provinsi <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Prov" name="Prov" class="form-control" type="text" placeholder="Lokasi Provinsi..." />
                    </div>
                    <br />
                    <label for="Country" class="element">Lokasi Negara <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Country" name="Country" class="form-control" type="text" placeholder="Lokasi Negara..." />
                    </div>
                    <br />
                    <label for="Pnum" class="element">Nomor Telepon <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Pnum" name="Pnum" class="form-control" type="text" placeholder="Nomor Telepon..." />
                    </div>
                    <br />
                    <label for="Email" class="element">Email <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Email" name="Email" class="form-control" type="text" placeholder="Email..." />
                    </div>
                    <br />
                    <label for="Relation" class="element">Hubungan <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="Relation" name="Relation" class="form-control" type="text" placeholder="Hubungan..." />
                    </div>
                    <br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Referensi</button>
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