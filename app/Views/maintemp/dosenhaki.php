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
                        <a href="<?php echo base_url(); ?>/dosenhaki/tambahhaki" class="btn btn-primary">Tambah
                            Data HAKI</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if (isset($data_haki) && ($data_haki == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data HAKI belum ada. <a href="<?= base_url(); ?>/dosenhaki/tambahhaki">Klik di sini untuk menambah data HAKI</a></div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Term</th>
                                <th>Judul Luaran</th>
                                <th>Jenis Luaran</th>
                                <th>No HAKI</th>
                                <th>Tanggal Perolehan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_haki as $haki) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $haki['tahun'] . ' - ' . $haki['semester']; ?></td>
                                    <td><?= $haki['judul']; ?></td>
                                    <td><?= $haki['jenis']; ?></td>
                                    <td><?= $haki['nomorhaki']; ?></td>
                                    <td><?= format_indo($haki['tanggalperoleh']); ?></td>
                                    <td style="text-align: center"><a href="<?php echo base_url(); ?>/dosenhaki/ubahhaki/<?= $haki['haki_id']; ?>" class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a>
                                        <a href="<?php echo base_url(); ?>/dosenhaki/hapushaki/<?= $haki['haki_id']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data HAKI?')" class="btn btn-danger"> <i class="fas fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php
                            endforeach
                            ?>
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