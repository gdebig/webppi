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

                <?php if (isset($data_kompetensi) && ($data_kompetensi == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data Kompetensi belum ada.</div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dosen</th>
                                <th>Term</th>
                                <th>Posisi</th>
                                <th>Nama Badan/Panitia</th>
                                <th>Mewakili</th>
                                <th>Menjadi Saksi Ahli</th>
                                <th>Waktu Pelaksanaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_kompetensi as $kompetensi) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $kompetensi['FullName']; ?></td>
                                    <td><?= $kompetensi['tahun'] . ' - ' . $kompetensi['semester']; ?></td>
                                    <td><?= $kompetensi['posisi']; ?></td>
                                    <td><?= $kompetensi['namabadan']; ?></td>
                                    <td><?= $kompetensi['mewakili']; ?></td>
                                    <td><?= $kompetensi['saksiahli']; ?></td>
                                    <td><?= format_indo($kompetensi['waktupelaksanaan']); ?></td>
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