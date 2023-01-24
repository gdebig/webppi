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

                <?php if (isset($data_riset) && ($data_riset == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data Riset dan Pengabdian Masyarakat belum ada.</div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dosen</th>
                                <th>Term</th>
                                <th>Judul Penelitian / Pengabdian Masyarakat Semester yang lalu</th>
                                <th>Tipe</th>
                                <th>Asal Dana</th>
                                <th>Nama Hibah / Sumber Pendanaan</th>
                                <th>Tanggal Perolehan Hibah dan Berlaku Sampai Kapan</th>
                                <th>Jumlah Dana yang Diperoleh</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_riset as $riset) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $riset['FullName']; ?></td>
                                    <td><?= $riset['tahun'] . ' - ' . $riset['semester']; ?></td>
                                    <td><?= $riset['judul']; ?></td>
                                    <td><?= $riset['tipe']; ?></td>
                                    <td><?= $riset['asal_dana']; ?></td>
                                    <td><?= $riset['namahibah']; ?></td>
                                    <td><?= format_indo($riset['tanggalawal']) . ' - ' . format_indo($riset['tanggalakhir']); ?></td>
                                    <td><?= $riset['jumlahdana']; ?></td>
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