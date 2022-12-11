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
                        <a href="<?php echo base_url(); ?>/tugasakhir" class="btn btn-primary">Kembali ke Daftar PK</a>
                    </div>
                </div>

                <?php if (isset($data_js) && ($data_js == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data jadwal sidang belum ada. <a href="<?= base_url(); ?>/tugasakhir">Klik
                            di sini untuk kembali ke Daftar PK.</a></div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ruang Sidang</th>
                                <th>Tanggal Sidang</th>
                                <th>Perbaikan Judul (setelah sidang)</th>
                                <th>Catatan (setelah sidang)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <p>1</p>
                                </td>
                                <td><?= $data_js['sidang_ruang']; ?></td>
                                <td><?= $data_js['sidang_tanggal']; ?></td>
                                <td><?= $data_js['sidang_judul']; ?></td>
                                <td><?= $data_js['cat_sidang']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>