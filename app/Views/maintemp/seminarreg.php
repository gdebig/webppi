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
                        <a href="<?php echo base_url(); ?>/seminarreg/tambahsemreg" class="btn btn-primary">Tambah
                            Seminar</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if (isset($data_sem) && ($data_sem == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data seminar belum ada. <a href="<?= base_url(); ?>/seminarreg/tambahsemreg">Klik
                            di sini untuk menambah data seminar</a></div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Seminar</th>
                                <th>Term Seminar</th>
                                <th>Bukti Seminar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_sem as $sem) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $sem['sem_judul']; ?></td>
                                    <td><?= $sem['sem_tahun'] . ' - ' . $sem['sem_term']; ?></td>
                                    <td><?php
                                        if (!empty($sem['sem_bukti'])) {
                                            echo "<a href='" . base_url() . "/uploads/docs/" . $sem['sem_bukti'] . "' target='_blank'>Lihat Bukti</a>";
                                        } else {
                                            echo "Belum ada Bukti";
                                        }
                                        ?></td>
                                    <td style="text-align: center"><a href="<?php echo base_url(); ?>/seminarreg/ubahsemreg/<?= $sem['sem_id']; ?>" class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a><a href="<?php echo base_url(); ?>/seminarreg/hapussemreg/<?= $sem['sem_id']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data seminar?')" class="btn btn-danger"> <i class="fas fa-trash"></i> Hapus</a>
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