<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <a href="<?= base_url(); ?>/bimbingfair/docs/<?= $user_id; ?>">Kembali ke daftar dokumen FAIR</a>
        </div>
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">

                <?php if (session()->getFlashdata('msg')) : ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                <?php endif; ?>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if (isset($data_sem) && ($data_sem == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data makalah belum ada.</div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Bulan-Tahun</th>
                                <th>Judul Makalah/Tulisan</th>
                                <th>Nama Seminar/Lokakarya</th>
                                <th>Penyelenggara</th>
                                <th>Lokasi</th>
                                <th>Seminar/Lokakarya Tingkat</th>
                                <th>Tingkat Kesulitan dan Manfaat</th>
                                <th>Uraian Singkat Materi Makalah/Tulisan</th>
                                <th>Bukti Seminar</th>
                                <th>Klaim Kompetensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_sem as $sem) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $sem['Month'] . '-' . $sem['Year']; ?></td>
                                    <td><?= $sem['PaperName']; ?></td>
                                    <td><?= $sem['Name']; ?></td>
                                    <td><?= $sem['Organizer']; ?></td>
                                    <td><?= $sem['LocCity'] . ", " . $sem['LocCountry'] ?></td>
                                    <td><?php
                                        switch ($sem['Level']) {
                                            case "Lok":
                                                echo "Pada Seminar Lokal";
                                                break;
                                            case "Nas":
                                                echo "Pada Seminar Nasional";
                                                break;
                                            case "Int":
                                                echo "Pada Seminar Internasional";
                                                break;
                                            case "Inv":
                                                echo "Invited/Keynote Speaker";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php
                                        switch ($sem['DiffBenefit']) {
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
                                    <td><?= $sem['Desc']; ?></td>
                                    <td><a href="<?= base_url(); ?>/uploads/docs/<?= $sem['File']; ?>" target="_blank">Lihat Bukti</a></td>
                                    <td><?= $sem['kompetensi']; ?></td>
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