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
                            Praktek Keinsinyuran</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        <a href="<?php echo base_url(); ?>/mantareg/tambahpembimbing/<?= $tar_id; ?>/<?= $user_id; ?>" class="btn btn-primary">Atur Pembimbing</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if (isset($data_uji) && ($data_uji == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data pembimbing proyek akhir belum ada. <a href="<?= base_url(); ?>/mantareg/tambahpembimbing/<?= $tar_id; ?>/<?= $user_id; ?>">Klik
                            di sini untuk mengatur data pembimbing</a></div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pembimbing</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_uji as $ta) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= !empty($ta['FullName']) ? $ta['FullName'] : "Belum ada pembimbing."; ?></td>
                                    <td style="text-align: center">
                                        <a href="<?php echo base_url(); ?>/mantareg/hapusbimbing/<?= $ta['tar_id']; ?>/<?= $tar_id; ?>/<?= $ta['user_id']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data pembimbing?')" class="btn btn-danger"> <i class="fas fa-trash"></i>
                                            Hapus</a>
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