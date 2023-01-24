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
                        &nbsp;
                    </div>
                </div>

                <?php if (isset($data_haki) && ($data_haki == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data HAKI belum ada.</div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dosen</th>
                                <th>Term</th>
                                <th>Judul Luaran</th>
                                <th>Jenis Luaran</th>
                                <th>No HAKI</th>
                                <th>Tanggal Perolehan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_haki as $haki) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $haki['FullName']; ?></td>
                                    <td><?= $haki['tahun'] . ' - ' . $haki['semester']; ?></td>
                                    <td><?= $haki['judul']; ?></td>
                                    <td><?= $haki['jenis']; ?></td>
                                    <td><?= $haki['nomorhaki']; ?></td>
                                    <td><?= format_indo($haki['tanggalperoleh']); ?></td>
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