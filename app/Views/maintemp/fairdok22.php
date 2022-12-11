<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">

                <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                <?php endif; ?>

                <div class="col">
                    <div class="row">
                        <a href="<?php echo base_url(); ?>/userfair22/tambahdapat" class="btn btn-primary">Tambah
                            Pendapat</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if (isset($data_dapat) && ($data_dapat == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data pengertian, pendapat dan pengalaman sendiri belum ada. <a href="<?= base_url(); ?>/userfair22/tambahdapat">Klik
                            di sini untuk menambah data pendapat</a></div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pendapat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_dapat as $dapat) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $dapat['Desc']; ?></td>
                                    <td style="text-align: center"><a href="<?php echo base_url(); ?>/userfair22/ubahdapat/<?= $dapat['Num']; ?>" class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a>
                                        <a href="<?php echo base_url(); ?>/userfair22/hapusdapat/<?= $dapat['Num']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data pengertian, pendapat dan pengalaman sendiri?')" class="btn btn-danger"> <i class="fas fa-trash"></i>
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