<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Karya Tulis di Bidang Keinsinyuran yang Dipublikasikan</h3>
        </div>
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
                        <a href="<?php echo base_url(); ?>/mancapes" class="btn btn-primary">Kembali ke daftar Calon
                            Peserta</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if (isset($data_kartul) && ($data_kartul == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data Karya Tulis belum ada. <a href="<?= base_url(); ?>/register/tambahkartul">Klik
                            di sini untuk menambah data Karya Tulis.</a></div>
                <?php } else { ?>

                    <table id="tabledata" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bulan-Tahun</th>
                                <th>Judul Karya Tulis</th>
                                <th>Nama Media Publikasi</th>
                                <th>Lokasi</th>
                                <th>Media Publikasi Tingkat</th>
                                <th>Tingkat Kesulitan dan Manfaatnya</th>
                                <th>Uraian Singkat Materi yang Dipublikasikan</th>
                                <th>Bukti Karya Tulis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_kartul as $kartul) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $kartul['Month'] . ' - ' . $kartul['Year']; ?></td>
                                    <td><?= $kartul['Name']; ?></td>
                                    <td><?= $kartul['Media']; ?></td>
                                    <td><?= $kartul['LocCity'] . ", " . $kartul['LocCountry'] ?></td>
                                    <td><?php
                                        switch ($kartul['Mediatype']) {
                                            case "Lok":
                                                echo "Dimuat di Media Lokal";
                                                break;
                                            case "Nas":
                                                echo "Dimuat di Media Nasional";
                                                break;
                                            case "Int":
                                                echo "Dimuat di Media Internasional";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php
                                        switch ($kartul['Diffbenefit']) {
                                            case "ren":
                                                echo "Rendah";
                                                break;
                                            case "sed":
                                                echo "Sedang";
                                                break;
                                            case "tin":
                                                echo "Tinggi";
                                                break;
                                            case "stin":
                                                echo "Sangat Tinggi";
                                                break;
                                        }
                                        ?></td>
                                    <td><?= $kartul['Desc']; ?></td>
                                    <td><a href="<?= base_url(); ?>/uploads/docs/<?= $kartul['File']; ?>" target="_blank"><?= $kartul['File']; ?></a></td>
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