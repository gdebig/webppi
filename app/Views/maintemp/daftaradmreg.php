<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">

                <div class="col">
                    <?php if (session()->getFlashdata('msg')) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif; ?>
                </div>

                <div class="col">
                    <div class="row">
                        <a href="<?php echo base_url(); ?>/mantareg" class="btn btn-primary">Kembali ke Daftar
                            Praktek Keinsinyuran Reguler.</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dokumen</th>
                            <th>Link</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Berita Acara Sidang Praktek Keinsinyuran</td>
                            <td><a href="<?= base_url(); ?>/mantareg/beritaacara/<?= $mhs_id; ?>/<?= $tar_id; ?>" target='_blank'>Lihat Berita Acara</a></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Form Evaluasi Pembimbing</td>
                            <td>
                                <?php
                                if ($bimbing_id == "kosong") {
                                    echo "Pembimbing belum memberi nilai";
                                } else {
                                ?>
                                    <a href="<?= base_url(); ?>/mantareg/lihatformevaluasi/<?= $mhs_id; ?>/<?= $bimbing_id; ?>/<?= $tar_id; ?>" target='_blank'>Lihat Form</a>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Form Evaluasi Penguji</td>
                            <td>
                                <?php
                                if ($uji_id == "kosong") {
                                    echo "Penguji belum memberi nilai";
                                } else {
                                ?>
                                    <a href="<?= base_url(); ?>/mantareg/lihatformevaluasi/<?= $mhs_id; ?>/<?= $uji_id; ?>/<?= $tar_id; ?>" target='_blank'>Lihat Form</a>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Daftar Hadir</td>
                            <td><a href="<?= base_url(); ?>/mantareg/daftarhadir/<?= $mhs_id; ?>/<?= $tar_id; ?>" target='_blank'>Lihat Daftar Hadir</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>