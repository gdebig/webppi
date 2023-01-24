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
                            <h3 class="card-title">Dokumen Akreditasi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p>
                            <ul>
                                <li><a href="<?= base_url(); ?>/manakreditasi/dosenriset">Riset dan Pengmas</a></li>
                                <li><a href="<?= base_url(); ?>/manakreditasi/dosenpublikasi">Publikasi</a></li>
                                <li><a href="<?= base_url(); ?>/manakreditasi/dosenhaki">HAKI</a></li>
                                <li><a href="<?= base_url(); ?>/manakreditasi/dosenpkm">PKM</a></li>
                                <li><a href="<?= base_url(); ?>/manakreditasi/dosenkompetensi">Pengakuan Kompetensi</a></li>
                            </ul>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<?= $this->endSection(); ?>