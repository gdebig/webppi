<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Tambah Pengertian, Pendapat dan Pengalaman Sendiri</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url();?>/userfair22/tambahdapatproses" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Pendapat" class="element">Tuliskan dengan kata-kata sendiri apa pengertian dan pendapat
                        Anda tentang Kode Etik Insinyur serta pengalaman Anda tentang Etika Profesi <span
                            class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <textarea id="Desc" name="Desc" class="form-control"
                            placeholder="Pengertian, Pendapat dan Pengalaman Sendiri..."></textarea>
                    </div>
                    <br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <br />
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Pengertian, Pendapat dan Pengalaman Sendiri</button>
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