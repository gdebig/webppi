<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Form Upload Buku Revisi Praktek Keinsinyuran</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/tugasakhir/bukurevisiproses" method="post" enctype="multipart/form-data">
                <input type="hidden" name="ta_id" id="ta_id" value="<?= $ta_id; ?>" />
                <div class="form-group">
                    <label for="ta_bukurevisi" class="element">File Buku Revisi Praktek Keinsinyuran</label>
                    <div class="element">
                        <input id="ta_bukurevisi" name="ta_bukurevisi" type="file" class="form-control" placeholder="File Buku Revisi Praktek Keinsinyuran..." />
                    </div>
                    <br />
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Upload Revisi
                                Praktek Keinsinyuran</button>
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