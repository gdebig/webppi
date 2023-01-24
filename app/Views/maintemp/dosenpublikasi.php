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
                        <a href="<?php echo base_url(); ?>/Dosenpublikasi/tambahpublikasi" class="btn btn-primary">Tambah
                            Data Publikasi</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if (isset($data_pub) && ($data_pub == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data Publikasi belum ada. <a href="<?= base_url(); ?>/Dosenpublikasi/tambahpublikasi">Klik di sini untuk menambah data Publikasi</a></div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Term</th>
                                <th>Judul Artikel</th>
                                <th>Jenis Publikasi</th>
                                <th>Tanggal Publikasi / Seminar</th>
                                <th>Link Publikasi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_pub as $pub) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $pub['tahun'] . ' - ' . $pub['semester']; ?></td>
                                    <td><?= $pub['judul']; ?></td>
                                    <td><?= $pub['jenis']; ?></td>
                                    <td><?= format_indo($pub['tanggalpublikasi']); ?></td>
                                    <td><a href="<?= $pub['linkpublikasi']; ?>" target="_blank"><?= $pub['linkpublikasi']; ?></a></td>
                                    <td style="text-align: center"><a href="<?php echo base_url(); ?>/Dosenpublikasi/ubahpublikasi/<?= $pub['pub_id']; ?>" class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a>
                                        <a href="<?php echo base_url(); ?>/Dosenpublikasi/hapuspublikasi/<?= $pub['pub_id']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data publikasi?')" class="btn btn-danger"> <i class="fas fa-trash"></i> Hapus</a>
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