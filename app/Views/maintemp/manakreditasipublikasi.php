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

                <?php if (isset($data_pub) && ($data_pub == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data Publikasi belum ada.</div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dosen</th>
                                <th>Term</th>
                                <th>Judul Artikel</th>
                                <th>Jenis Publikasi</th>
                                <th>Tanggal Publikasi / Seminar</th>
                                <th>Link Publikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_pub as $pub) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $pub['FullName']; ?></td>
                                    <td><?= $pub['tahun'] . ' - ' . $pub['semester']; ?></td>
                                    <td><?= $pub['judul']; ?></td>
                                    <td><?= $pub['jenis']; ?></td>
                                    <td><?= format_indo($pub['tanggalpublikasi']); ?></td>
                                    <td><a href="<?= $pub['linkpublikasi']; ?>" target="_blank"><?= $pub['linkpublikasi']; ?></a></td>
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