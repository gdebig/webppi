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
                        <a href="<?php echo base_url(); ?>/dosenpkm/tambahpkm" class="btn btn-primary">Tambah
                            Data PKM</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if (isset($data_pkm) && ($data_pkm == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data PKM belum ada. <a href="<?= base_url(); ?>/dosenpkm/tambahpkm">Klik di sini untuk menambah data PKM</a></div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Term</th>
                                <th>Judul PKM</th>
                                <th>Sumber Dana</th>
                                <th>Waktu Pelaksanaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_pkm as $pkm) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $pkm['tahun'] . ' - ' . $pkm['semester']; ?></td>
                                    <td><?= $pkm['judul']; ?></td>
                                    <td><?= $pkm['sumberdana']; ?></td>
                                    <td><?= format_indo($pkm['waktupelaksanaan']); ?></td>
                                    <td style="text-align: center"><a href="<?php echo base_url(); ?>/dosenpkm/ubahpkm/<?= $pkm['pkm_id']; ?>" class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a>
                                        <a href="<?php echo base_url(); ?>/dosenpkm/hapuspkm/<?= $pkm['pkm_id']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data pkm?')" class="btn btn-danger"> <i class="fas fa-trash"></i> Hapus</a>
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