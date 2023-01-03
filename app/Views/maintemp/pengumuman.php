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
                        <a href="<?php echo base_url(); ?>/manpengumuman/tambahumum" class="btn btn-primary">Tambah
                            Pengumuman</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if (isset($data_umum) && ($data_umum == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data Pengumuman belum ada. <a href="<?= base_url(); ?>/manpengumuman/tambahumum">Klik
                            di sini untuk menambah data Pengumuman</a></div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>File</th>
                                <th>Tujuan</th>
                                <th>Delete</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_umum as $umum) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $umum['umum_name']; ?></td>
                                    <td><?= $umum['umum_desc']; ?></td>
                                    <td><?= !empty($umum['umum_file']) ? "<a href='" . base_url() . "/uploads/umum/" . $umum['umum_file'] . "' target='_blank'>Lihat File</a>" : "Tidak ada File"; ?></td>
                                    <td><?= $umum['umum_tujuan']; ?></td>
                                    <td style="text-align: center"><a href="<?php echo base_url(); ?>/manpengumuman/ubahumum/<?= $umum['umum_id']; ?>" class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a><a href="<?php echo base_url(); ?>/manpengumuman/hapusumum/<?= $umum['umum_id']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data Pengumuman?')" class="btn btn-danger"> <i class="fas fa-trash"></i> Hapus</a>
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