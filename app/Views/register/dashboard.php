<?= $this->extend('register/template'); ?>

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
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Kelengkapan Dokumen</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p>Berikut adalah daftar dokumen yang harus anda lengkapi. Jika sudah dilengkapi, dokumen
                                akan ditandai dengan lambang centang.</p>
                            <p>
                            <ul>
                                <li><?php
                                    echo $isprofile == "Ada" ? '<span class="bg-success">Profile <i class="fas fa-check"></i></span>' : '<span class="bg-danger">Profile <i class="fas fa-times"></i></span';
                                    ?></li>
                                <li><?php
                                    echo $ispengkerja == "Ada" ? '<span class="bg-success">Pengalaman Kerja <i class="fas fa-check"></i></span>' : '<span class="bg-danger">Pengalaman Kerja <i class="fas fa-times"></i></span';
                                    ?></li>
                                <li><?php
                                    echo $isorgan == "Ada" ? '<span class="bg-success">Organisasi <i class="fas fa-check"></i></span>' : '<span class="bg-danger">Organisasi <i class="fas fa-times"></i></span';
                                    ?></li>
                                <li><?php
                                    echo $islatih == "Ada" ? '<span class="bg-success">Pendidikan/Pelatihan Teknik/Manajemen <i class="fas fa-check"></i></span>' : '<span class="bg-danger">Pendidikan/Pelatihan Teknik/Manajemen <i class="fas fa-times"></i></span';
                                    ?></li>
                                <li><?php
                                    echo $issert == "Ada" ? '<span class="bg-success">Sertifikat Kompetensi dan Bidang Lainnya (Yang Relevan) Yang Diikuti <i class="fas fa-check"></i></span>' : '<span class="bg-danger">Sertifikat Kompetensi dan Bidang Lainnya (Yang Relevan) Yang Diikuti <i class="fas fa-times"></i></span';
                                    ?></li>
                                <li><?php
                                    echo $iskartul == "Ada" ? '<span class="bg-success">Karya Tulis di Bidang Keinsinyuran yang Dipublikasikan <i class="fas fa-check"></i></span>' : '<span class="bg-danger">Karya Tulis di Bidang Keinsinyuran yang Dipublikasikan <i class="fas fa-times"></i></span';
                                    ?></li>
                                <li><?php
                                    echo $issem == "Ada" ? '<span class="bg-success">Makalah/Tulisan yang Disajikan Dalam Seminar/Lokakarya Keinsinyuran <i class="fas fa-check"></i></span>' : '<span class="bg-danger">Makalah/Tulisan yang Disajikan Dalam Seminar/Lokakarya Keinsinyuran <i class="fas fa-times"></i></span';
                                    ?></li>
                            </ul>
                            </p>
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