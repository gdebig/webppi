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
                        <a href="<?php echo base_url(); ?>/manconfig/tambahconfig" class="btn btn-primary">Tambah
                            Konfigurasi</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if (isset($data_config) && ($data_config == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data konfigurasi belum ada. <a href="<?= base_url(); ?>/manconfig/tambahconfig">Klik
                            di sini untuk menambah data konfigurasi</a></div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Konfigurasi Nama</th>
                                <th>Value</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_config as $config) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $config['config_name']; ?></td>
                                    <td><?= $config['config_value']; ?></td>
                                    <td style="text-align: center"><a href="<?php echo base_url(); ?>/manconfig/ubahconfig/<?= $config['config_id']; ?>" class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a>
                                        <a href="<?php echo base_url(); ?>/manconfig/hapusconfig/<?= $config['config_id']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus konfigurasi?')" class="btn btn-danger"> <i class="fas fa-trash"></i>
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