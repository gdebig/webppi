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
                            <h3 class="card-title">Dokumen FAIR <?= $FullName; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair11/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">I.1</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair12/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">I.2</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair13/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">I.3</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair14/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">I.4</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair15/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">I.5</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair16/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">I.6</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair21/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">II.1</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair22/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">II.2</a>
                                </div>
                            </div>
                            <div class="row">
                                &nbsp;
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair3/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">III</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair4/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">IV</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair51/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">V.1</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair52/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">V.2</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair53/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">V.3</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair54/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">V.4</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair6/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">VI</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifair7/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">VII</a>
                                </div>
                            </div>
                            <div class="row">
                                &nbsp;
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifairrekap/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">Rekapitulasi</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/piifairlamp/docs/<?= $mhs_id; ?>" class="btn btn-block btn-primary btn-sm">Lampiran</a>
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