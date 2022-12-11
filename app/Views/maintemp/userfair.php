<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div>

                    <?php if (session()->getFlashdata('msg')) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif; ?>
                    <!-- /.card -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Dokumen FAIR</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair11/docs/" class="btn btn-block btn-primary btn-sm">I.1</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair12/docs/" class="btn btn-block btn-primary btn-sm">I.2</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair13/docs/" class="btn btn-block btn-primary btn-sm">I.3</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair14/docs/" class="btn btn-block btn-primary btn-sm">I.4</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair15/docs/" class="btn btn-block btn-primary btn-sm">I.5</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair16/docs/" class="btn btn-block btn-primary btn-sm">I.6</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair21/docs/" class="btn btn-block btn-primary btn-sm">II.1</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair22/docs/" class="btn btn-block btn-primary btn-sm">II.2</a>
                                </div>
                            </div>
                            <div class="row">
                                &nbsp;
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair3/docs/" class="btn btn-block btn-primary btn-sm">III</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair4/docs/" class="btn btn-block btn-primary btn-sm">IV</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair51/docs/" class="btn btn-block btn-primary btn-sm">V.1</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair52/docs/" class="btn btn-block btn-primary btn-sm">V.2</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair53/docs/" class="btn btn-block btn-primary btn-sm">V.3</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair54/docs/" class="btn btn-block btn-primary btn-sm">V.4</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair6/docs/" class="btn btn-block btn-primary btn-sm">VI</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfair7/docs/" class="btn btn-block btn-primary btn-sm">VII</a>
                                </div>
                            </div>
                            <div class="row">
                                &nbsp;
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfairrekap/docs/" class="btn btn-block btn-primary btn-sm">Rekapitulasi</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/userfairlamp/docs/" class="btn btn-block btn-primary btn-sm">Lampiran</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<?= $this->endSection(); ?>