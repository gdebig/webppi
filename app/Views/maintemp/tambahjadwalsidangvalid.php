<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Tambah Jadwal Sidang</h3>
        </div>
        <!-- /.card-header -->

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/mantugasakhir/tambahjsproses" method="post" enctype="multipart/form-data">
                <input type="hidden" id="user_id" name="user_id" value="<?= $user_id; ?>">
                <input type="hidden" id="ta_id" name="ta_id" value="<?= $ta_id; ?>">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Jadwal Sidang</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="sidang_ruang" class="element">Ruang Sidang <span class="required">
                                    *</span>&nbsp;
                            </label>
                            <div class="element">
                                <input id="sidang_ruang" name="sidang_ruang" type="text" class="form-control" placeholder="Ruang Sidang..." value="<?= set_value('sidang_ruang'); ?>" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sidang_tanggal" class="element">Tanggal Sidang <span class="required">
                                    *</span>&nbsp;
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control float-right data-datepicker1" id="sidang_tanggal" name="sidang_tanggal" placeholder="Tanggal Sidang..." value="<?= set_value('sidang_tanggal'); ?>" />
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
                        <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                            Jadwal Sidang</button>
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