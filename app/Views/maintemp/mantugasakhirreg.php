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
                    <?php if (session()->getFlashdata('errmsg')) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('errmsg') ?></div>
                    <?php endif; ?>
                </div>

                <?php if (isset($data_ta) && ($data_ta == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data praktek keinsinyuran belum ada.</div>
                <?php } else { ?>
                    <form action="<?php echo base_url(); ?>/mantareg/prosesconfirmtar" method="post" enctype="multipart/form-data">

                        <table id="tabledata" class="display table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="5%">Check</th>
                                    <th>Nama Peserta RPL</th>
                                    <th>NPM</th>
                                    <th>Judul TA</th>
                                    <th>Term</th>
                                    <th>Periode</th>
                                    <th>Instansi</th>
                                    <th>Divisi</th>
                                    <th>Buku TA</th>
                                    <th>Log</th>
                                    <th>Konfirmasi</th>
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
                                        <td style="text-align:center"><input type="checkbox" name="tar_id[]" value="<?= $ta['tar_id']; ?>" class="form-check-input" /></td>
                                        <td><?= empty($ta['FullName']) ? $ta['username'] . " (Belum ada Profile)" : $ta['FullName']; ?></td>
                                        <td><?= $ta['NPM']; ?></td>
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
                                        <td><?= $ta['tar_confirm']; ?></td>
                                        <td style="text-align: center">
                                            <?php
                                            if (!empty($ta['tar_buku'])) {
                                            ?>
                                                <a href="<?php echo base_url(); ?>/mantareg/setjadwal/<?= $ta['tar_id']; ?>/<?= $ta['user_id']; ?>" class="btn btn-warning"> <i class="fas fa-calendar-alt"></i> Atur Jadwal
                                                    Sidang</a><br /><a href="<?php echo base_url(); ?>/mantareg/setpembimbing/<?= $ta['tar_id']; ?>/<?= $ta['user_id']; ?>" class="btn btn-secondary"> <i class="fas fa-user-tie"></i> Atur Pembimbing
                                                    TA</a><br /><a href="<?php echo base_url(); ?>/mantareg/setpenguji/<?= $ta['tar_id']; ?>/<?= $ta['user_id']; ?>" class="btn btn-secondary"> <i class="fas fa-user-tie"></i> Atur Penguji
                                                    TA</a><br /><a href="<?php echo base_url(); ?>/mantareg/lihatnilai/<?= $ta['tar_id']; ?>/<?= $ta['user_id']; ?>" class="btn btn-primary"> <i class="fas fa-clipboard-check"></i> Lihat
                                                    Nilai</a><br />
                                                <?php
                                                if ($ta['tar_confirm'] == "Ya") {
                                                ?>
                                                    <a href="<?php echo base_url(); ?>/mantareg/admta/<?= $ta['tar_id']; ?>/<?= $ta['user_id']; ?>" class="btn btn-info"> <i class="fas fa-file-signature"></i> Lihat Administrasi
                                                        TA</a>
                                                <?php
                                                }
                                                ?>
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
                        </table><br /><br />
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Konfirmasi Pelaksanaan Praktik Keinsinyuran</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="confirmta" class="element">Telah dilaksanakan?</label>
                                    <div class="element">
                                        <select name="confirmta" id="confirmta" class="form-control">
                                            <option value="Tidak">Tidak</option>
                                            <option value="Ya">Ya</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col">
                                <button type="submit" name="submit" value="set" class="btn btn-primary col">Confirm PK</button>
                            </div>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>