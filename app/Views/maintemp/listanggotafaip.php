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
                    <?php if (session()->getFlashdata('err')) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('err') ?></div>
                    <?php endif; ?>
                </div>

                <div class="col">
                    <div class="row">
                        <a href="<?php echo base_url(); ?>/apifaip/tambahanggota" class="btn btn-primary">Tambah
                            Anggota</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if (isset($data_user) && ($data_user == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data Anggota belum ada. <a href="<?= base_url(); ?>/apifaip/tambahanggota">Klik
                            di sini untuk menambah data anggota</a></div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>NPM</th>
                                <th>Tahun Terdaftar</th>
                                <th>Tipe User</th>
                                <th>Tipe Peserta</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_user as $user) :
                                if (empty($user['FullName']) || empty($user['NPM'])) {
                                    continue;
                                }
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $user['FullName']; ?></td>
                                    <td><?= $user['NPM']; ?></td>
                                    <td><?= $user['thnajaran'] . " / " . $user['semester']; ?></td>
                                    <td>
                                        <ul>
                                            <?php
                                            echo $user['tipe_user'][0] == "y" ? "<li>Super Admin</li>" : "";
                                            echo $user['tipe_user'][1] == "y" ? "<li>Admin </li>" : "";
                                            echo $user['tipe_user'][2] == "y" ? "<li>Penilai </li>" : "";
                                            echo $user['tipe_user'][3] == "y" ? "<li>Peserta </li>" : "";
                                            ?>
                                        </uL>
                                    </td>
                                    <td><?= $user['tipe_peserta']; ?></td>
                                    <td style="text-align: center"><a href="<?php echo base_url(); ?>/apifaip/sendfaip/<?= $user['user_id']; ?>" class="btn btn-warning"> <i class="fas fa-file-signature"></i> Kirim FAIP</a>
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