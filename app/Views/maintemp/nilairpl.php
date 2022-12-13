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
                            <h3 class="card-title">Mata Kuliah RPL <?= $FullName; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/nilairpl/kodeetik/<?= $mhs_id; ?>/<?= $dosen_id; ?>" class="btn btn-block btn-success btn-sm">Kode Etik dan Etika Profesi
                                        Insinyur</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/nilairpl/profesi/<?= $mhs_id; ?>/<?= $dosen_id; ?>" class="btn btn-block btn-success btn-sm">Profesionalisme</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/nilairpl/k3lh/<?= $mhs_id; ?>/<?= $dosen_id; ?>" class="btn btn-block btn-success btn-sm">Keselamatan,Kesehatan,Keamanan
                                        kerja&Lingk</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/nilairpl/studikasus/<?= $mhs_id; ?>/<?= $dosen_id; ?>" class="btn btn-block btn-success btn-sm">Studi Kasus</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/nilairpl/seminar/<?= $mhs_id; ?>/<?= $dosen_id; ?>" class="btn btn-block btn-success btn-sm">Seminar</a>
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