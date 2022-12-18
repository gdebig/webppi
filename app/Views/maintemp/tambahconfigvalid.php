<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Form Tambah Konfigurasi</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/manconfig/tambahconfigproses" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="config_name" class="element">Nama Konfigurasi <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="config_name" name="config_name" class="form-control" type="text" placeholder="Nama Konfigurasi..." value="<?= set_value('config_name'); ?>" />
                    </div>
                    <br />
                    <label for="value" class="element">Value <span class="required"> *</span>&nbsp;
                    </label>
                    <textarea class="form-control" id="config_value" name="config_value" placeholder="Value..."><?= set_value('config_value'); ?></textarea>
                    <br /><br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Konfigurasi</button>
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