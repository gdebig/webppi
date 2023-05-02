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
                        <a href="<?php echo base_url(); ?>/regtugasakhir/tambahta" class="btn btn-primary">Tambah
                            Praktik Keinsinyuran</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>
                <?php if (isset($data_ta) && ($data_ta == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data Praktek Keinsinyuran belum ada. <a href="<?= base_url(); ?>/regtugasakhir/tambahta">Klik
                            di sini untuk menambah data Praktek Keinsinyuran</a></div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul TA</th>
                                <th>Term</th>
                                <th>Periode</th>
                                <th>Instansi</th>
                                <th>Divisi</th>
                                <th>Buku TA</th>
                                <th>Log</th>
                                <th>Video</th>
                                <th>Nilai</th>
                                <th>Buku Revisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_ta as $ta) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $ta['tar_usuljudul']; ?></td>
                                    <td><?= $ta['tar_tahun'] . ' - ' . $ta['tar_semester']; ?></td>
                                    <td><?php
                                        if (!empty($ta['startdate'])) {
                                            echo format_indo($ta['startdate']) . ' - ' . format_indo($ta['enddate']);
                                        } else {
                                            echo "Belum ada periode";
                                        }
                                        ?></td>
                                    <td><?= $ta['instansi']; ?></td>
                                    <td><?= $ta['divisi']; ?></td>
                                    <td><?php
                                        if (!empty($ta['tar_buku'])) {
                                            echo "<a href='" . base_url() . "/uploads/docs/" . $ta['tar_buku'] . "' target='_blank'>Buku TA</a>";
                                        } else {
                                            echo "Belum ada buku";
                                        }
                                        ?></td>
                                    <td><?php
                                        if (!empty($ta['tar_log'])) {
                                            echo "<a href='" . base_url() . "/uploads/docs/" . $ta['tar_log'] . "' target='_blank'>LOG</a>";
                                        } else {
                                            echo "Belum ada LOG";
                                        }
                                        ?></td>
                                    <td>
                                        <?php
                                        if (!empty($ta['tar_linkvideo'])) {
                                            echo "<a href='" . $ta['tar_linkvideo'] . "' target='_blank'>Video</a>";
                                        } else {
                                            echo "Belum ada video";
                                        }
                                        ?>
                                    </td>
                                    <td><a href="<?php echo base_url(); ?>/regtugasakhir/nilai/<?= $ta['tar_id']; ?>">Lihat Nilai</a>
                                    </td>
                                    <td><?php
                                        if (!empty($ta['tar_bukurevisi'])) {
                                            echo "<a href='" . base_url() . "/uploads/docs/" . $ta['tar_bukurevisi'] . "' target='_blank'>Buku Revisi</a>";
                                        } else {
                                            echo "Belum ada buku revisi";
                                        }
                                        ?></td>
                                    <td style="text-align: center"><a href="<?php echo base_url(); ?>/jadwalta" class="btn btn-primary"> <i class="fas fa-calendar-check"></i> Jadwal Sidang</a><a href="<?php echo base_url(); ?>/regtugasakhir/bukurevisireg/<?= $ta['tar_id']; ?>" class="btn btn-secondary"> <i class="fas fa-upload"></i> Upload Buku
                                            Revisi</a><a href="<?php echo base_url(); ?>/regtugasakhir/ubahtar/<?= $ta['tar_id']; ?>" class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a>
                                        <a href="<?php echo base_url(); ?>/regtugasakhir/hapustar/<?= $ta['tar_id']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data Praktek Keinsinyuran?')" class="btn btn-danger"> <i class="fas fa-trash"></i>
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