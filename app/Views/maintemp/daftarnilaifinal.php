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
                    <?php if (session()->getFlashdata('errmsg')) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('errmsg') ?></div>
                    <?php endif; ?>
                </div>

                <?php if (isset($data_nilai) && ($data_nilai == "kosong")) {

                ?>

                    <div class="alert alert-danger">Belum ada Nilai RPL</div>
                <?php } else { ?>
                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>NPM</th>
                                <th>Tahun</th>
                                <th>Semester</th>
                                <th>Kode Etik dan Etika Profesi Insinyur</th>
                                <th>Profesionalisme</th>
                                <th>Keselamatan, Kesehatan, Keamanan Kerja dan Lingkungan Hidup</th>
                                <th>Studi Kasus</th>
                                <th>Seminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_nilai as $nilai) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $nilai['FullName']; ?></td>
                                    <td><?= $nilai['NPM']; ?></td>
                                    <td><?= $nilai['tahun']; ?></td>
                                    <td><?= $nilai['semester']; ?></td>
                                    <td><?= $nilai['kodeetik'] . ' (' . nilai_huruf_rpl($nilai['kodeetik']) . ') '; ?></td>
                                    <td><?= $nilai['profesi'] . ' (' . nilai_huruf_rpl($nilai['profesi']) . ') '; ?></td>
                                    <td><?= $nilai['k3lh'] . ' (' . nilai_huruf_rpl($nilai['k3lh']) . ') '; ?></td>
                                    <td><?= $nilai['studikasus'] . ' (' . nilai_huruf_rpl($nilai['studikasus']) . ') '; ?></td>
                                    <td><?= $nilai['seminar'] . ' (' . nilai_huruf_rpl($nilai['seminar']) . ') '; ?></td>
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