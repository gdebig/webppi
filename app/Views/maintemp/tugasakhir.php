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
                        <a href="<?php echo base_url(); ?>/tugasakhir/tambahta" class="btn btn-primary">Tambah
                            Praktik Keinsinyuran</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        <p>Dosen pembimbing: <?= $dosen_bimbing; ?></p>
                    </div>
                </div>
                <?php if (isset($data_ta) && ($data_ta == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data Praktek Keinsinyuran belum ada. <a href="<?= base_url(); ?>/tugasakhir/tambahta">Klik
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
                                <th>Penguji</th>
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
                                    <td><?= $ta['ta_usuljudul']; ?></td>
                                    <td><?= $ta['ta_tahun'] . ' - ' . $ta['ta_semester']; ?></td>
                                    <td><?php
                                        if ((!empty($ta['startdate'])) && (!empty($ta['enddate']))) {
                                            //echo format_indo($ta['startdate']) . ' - ' . format_indo($ta['enddate']);
                                            if (($ta['startdate'] == '0000-00-00') && ($ta['enddate'] == '0000-00-00')) {
                                                echo "Format data tanggal belum benar";
                                            } else {
                                                echo format_indo($ta['startdate']) . ' - ' . format_indo($ta['enddate']);
                                            }
                                        } else {
                                            echo "Belum ada periode";
                                        }
                                        ?></td>
                                    <td><?= $ta['instansi']; ?></td>
                                    <td><?= $ta['divisi']; ?></td>
                                    <td><?php
                                        if (!empty($ta['ta_buku'])) {
                                            echo "<a href='" . base_url() . "/uploads/docs/" . $ta['ta_buku'] . "' target='_blank'>Buku TA</a>";
                                        } else {
                                            echo "Belum ada buku";
                                        }
                                        ?></td>
                                    <td><?php
                                        if (!empty($ta['ta_log'])) {
                                            echo "<a href='" . base_url() . "/uploads/docs/" . $ta['ta_log'] . "' target='_blank'>LOG</a>";
                                        } else {
                                            echo "Belum ada LOG";
                                        }
                                        ?></td>
                                    <td>
                                        <?php
                                        if (!empty($ta['FullName'])) {
                                            echo $ta['FullName'];
                                        } else {
                                            echo "Belum ada penguji";
                                        }
                                        ?>
                                    </td>
                                    <td><a href="<?php echo base_url(); ?>/tugasakhir/nilai/<?= $ta['ta_id']; ?>">Lihat Nilai</a>
                                    </td>
                                    <td><?php
                                        if (!empty($ta['ta_bukurevisi'])) {
                                            echo "<a href='" . base_url() . "/uploads/docs/" . $ta['ta_bukurevisi'] . "' target='_blank'>Buku Revisi</a>";
                                        } else {
                                            echo "Belum ada buku revisi";
                                        }
                                        ?></td>
                                    <td style="text-align: center"><a href="<?php echo base_url(); ?>/jadwalta" class="btn btn-primary"> <i class="fas fa-calendar-check"></i> Jadwal Sidang</a><a href="<?php echo base_url(); ?>/tugasakhir/bukurevisi/<?= $ta['ta_id']; ?>" class="btn btn-secondary"> <i class="fas fa-upload"></i> Upload Buku
                                            Revisi</a><a href="<?php echo base_url(); ?>/tugasakhir/ubahta/<?= $ta['ta_id']; ?>" class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a>
                                        <a href="<?php echo base_url(); ?>/tugasakhir/hapusta/<?= $ta['ta_id']; ?>" onclick="return confirm('Apakah anda yakin akan menghapus data Praktek Keinsinyuran?')" class="btn btn-danger"> <i class="fas fa-trash"></i>
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