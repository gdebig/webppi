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

                <?php if (isset($data_ta) && ($data_ta == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data praktek keinsinyuran belum ada.</div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peserta RPL</th>
                                <th>NPM</th>
                                <th>Judul TA</th>
                                <th>Term</th>
                                <th>Periode</th>
                                <th>Instansi</th>
                                <th>Divisi</th>
                                <th>Buku TA</th>
                                <th>Log</th>
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
                                    <td><?= $ta['FullName']; ?></td>
                                    <td><?= $ta['NPM']; ?></td>
                                    <td><?= $ta['ta_usuljudul']; ?></td>
                                    <td><?= $ta['ta_tahun'] . ' - ' . $ta['ta_semester']; ?></td>
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
                                    <td style="text-align: center">
                                        <?php
                                        if (!empty($ta['ta_buku'])) {
                                        ?>
                                            <a href="<?php echo base_url(); ?>/mantugasakhir/setjadwal/<?= $ta['ta_id']; ?>/<?= $ta['user_id']; ?>" class="btn btn-warning"> <i class="fas fa-calendar-alt"></i> Atur Jadwal
                                                Sidang</a><br /><a href="<?php echo base_url(); ?>/mantugasakhir/setpenguji/<?= $ta['ta_id']; ?>/<?= $ta['user_id']; ?>" class="btn btn-secondary"> <i class="fas fa-user-tie"></i> Atur Penguji
                                                TA</a><br /><a href="<?php echo base_url(); ?>/mantugasakhir/lihatnilai/<?= $ta['ta_id']; ?>/<?= $ta['user_id']; ?>" class="btn btn-primary"> <i class="fas fa-clipboard-check"></i> Lihat
                                                Nilai</a><br /><a href="<?php echo base_url(); ?>/mantugasakhir/admta/<?= $ta['ta_id']; ?>/<?= $ta['user_id']; ?>" class="btn btn-info"> <i class="fas fa-file-signature"></i> Lihat Administrasi
                                                TA</a>
                                        <?php
                                        } else {
                                            echo "Tidak ada aksi. Softcopy buku belum diunggah oleh peserta.";
                                        }
                                        ?>
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