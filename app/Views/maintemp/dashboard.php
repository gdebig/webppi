<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div>

                    <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif;?>
                    <!-- /.card -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Umum</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p>Selamat datang kepada Calon Peserta program RPL PPI FT UI. Di dalam website ini, anda
                                diharuskan melengkapi dokumen-dokumen yang diperlukan sebagai bahan evaluasi tim
                                penilai. Evaluasi dilakukan untuk menilai kelayakan dokumen yang diunggah sehingga anda
                                dapat diterima sebagai Peserta Program RPL PPI FT UI.</p>
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

<?= $this->endSection();?>