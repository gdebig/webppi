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
                    <?php if (session()->getFlashdata('err')) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('err') ?></div>
                    <?php endif; ?>
                </div>

                <?php if (isset($data_user) && ($data_user == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data peserta ujian reguler belum ada.</div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Role</th>
                                <th>Nama Peserta PPI</th>
                                <th>Term</th>
                                <th>Buku Proyek Akhir</th>
                                <th>Log Proyek Akhir</th>
                                <th>Penilaian PK</th>
                                <th>Administrasi PK</th>
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
                                    <td><?= $user['tipedosen']; ?></td>
                                    <td><?= $user['FullName']; ?></td>
                                    <td><?= $user['tar_tahun'] . ' - ' . $user['tar_semester']; ?></td>
                                    <td><?php
                                        if (!empty($user['tar_buku'])) {
                                            echo "<a href='" . base_url() . "/uploads/docs/" . $user['tar_buku'] . "' target='_blank'>Buku TA</a>";
                                        } else {
                                            echo "Belum ada buku";
                                        }
                                        ?></td>
                                    <td><?php
                                        if (!empty($user['tar_log'])) {
                                            echo "<a href='" . base_url() . "/uploads/docs/" . $user['tar_log'] . "' target='_blank'>Log TA</a>";
                                        } else {
                                            echo "Belum ada buku";
                                        }
                                        ?></td>
                                    <td><?php
                                        if (!empty($user['tar_buku'])) {
                                        ?>
                                            <a href="<?= base_url(); ?>/manujipkreg/lihatnilai/<?= $user['mhs_id']; ?>/<?= $user['dosen_id']; ?>/<?= $user['tar_id']; ?>">Lihat Nilai PK</a>
                                        <?php
                                        } else {
                                            echo "Belum ada buku";
                                        }
                                        ?>
                                    </td>
                                    <td><?php
                                        if (!empty($user['tar_buku'])) {
                                        ?>
                                            <a href="<?= base_url(); ?>/manujipkreg/lihatadm/<?= $user['mhs_id']; ?>/<?= $user['dosen_id']; ?>/<?= $user['tar_id']; ?>" target="_blank">Lihat Administrasi</a>
                                        <?php
                                        } else {
                                            echo "Belum ada buku";
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