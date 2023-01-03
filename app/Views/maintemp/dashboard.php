<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div>

                    <?php if (session()->getFlashdata('msg')) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif; ?>
                    <!-- /.card -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Umum</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p><?= $informasi; ?></p>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($data_umum) && ($data_umum == "kosong")) {
                            ?>
                                <div class="alert alert-danger">Belum ada pengumuman</div>
                            <?php
                            } else {
                            ?>

                                <table id="tabledata" class="displayumum table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Pengumuman</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data_umum as $umum) :
                                        ?>
                                            <tr>
                                                <td>
                                                    <p><b><u><?= $umum['umum_name']; ?></u></b></p>
                                                    <p>Target Pengumuman:
                                                    <ul>
                                                        <?= $umum['umum_tujuan'][0] == 'y' ? "<li>Calon Peserta</li>" : ''; ?>
                                                        <?= $umum['umum_tujuan'][1] == 'y' ? "<li>Peserta</li>" : ''; ?>
                                                        <?= $umum['umum_tujuan'][2] == 'y' ? "<li>Penilai</li>" : ''; ?>
                                                    </ul>
                                                    </p>
                                                    <p><?= $umum['umum_desc'] ?></p>
                                                    <?= !empty($umum['umum_file']) ? "<a href='" . base_url() . "/uploads/umum/" . $umum['umum_file'] . "' target='_blank'>Lihat File</a>" : ''; ?>
                                                </td>
                                            </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card">
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<?= $this->endSection(); ?>