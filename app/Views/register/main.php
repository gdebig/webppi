<?= $this->extend('register/template');?>

<?= $this->section('content');?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="color-palette-set">

                    <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif;?>

                    <div class="bg-primary color-palette text-center">
                        <span><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Informasi</span>
                    </div>
                    <div class="bg-primary disabled color-palette text-left"><span class="m-3">
                            <ul>
                                <li>Apakah ini adalah kunjungan pertama anda? Jika iya, klik <a
                                        href="<?php echo base_url();?>/register/buatakun" class="alert-warning">link
                                        ini.</a><br />
                                    Link ini digunakan untuk membuat akun baru bagi Calon Peserta Program PPI FT UI.
                                    Saat melakukan konfirmasi pengisian dokumen, akan diminta NOMOR PENDAFTARAN yang
                                    didapat dari <a href="https://penerimaan.ui.ac.id" target="_blank"
                                        class="alert-warning">penerimaan.ui.ac.id</a>.
                                </li>
                                <li>Apakah ini adalah kunjungan yang kedua dan seterusnya? Jika iya, klik <a
                                        href="<?php echo base_url();?>/register/capes" class="alert-warning">link
                                        ini.</a><br />
                                    Link ini digunakan bagi anda calon peserta yang ingin mengubah dokumen yang sudah
                                    diisi sebelumnya. Dokumen hanya dapat diubah sebelum melakukan konfirmasi pengiriman
                                    melalui website ini.
                                </li>
                            </ul>
                        </span></div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<?= $this->endSection();?>