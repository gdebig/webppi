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

                <?php if (isset($data_user) && ($data_user == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data peserta ujian belum ada.</div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peserta PPI Regular</th>
                                <th>Term</th>
                                <th>Judul</th>
                                <th>Bukti Seminar</th>
                                <th>Penilaian Seminar</th>
                                <th>Administrasi Seminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_user as $user) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= !empty($user['FullName']) ? $user['FullName'] : $user['username'] . " (Belum Isi Profile)"; ?></td>
                                    <td><?= $user['sem_tahun'] . ' - ' . $user['sem_term']; ?></td>
                                    <td><?= $user['sem_judul']; ?></td>
                                    <td><?php
                                        if (!empty($user['sem_bukti'])) {
                                            echo "<a href='" . base_url() . "/uploads/docs/" . $user['sem_bukti'] . "' target='_blank'>Bukti Seminar</a>";
                                        } else {
                                            echo "Belum ada Bukti Seminar";
                                        }
                                        ?></td>
                                    <td><?= !empty($user['sem_nilai']) ? $user['sem_nilai'] : "Belum ada nilai."; ?></td>
                                    <td style="text-align: center"><a href="<?php echo base_url(); ?>/mansemreg/berinilai/<?= $user['sem_id']; ?>" class="btn btn-warning"> <i class="fas fa-file-signature"></i> Beri Nilai</a>
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