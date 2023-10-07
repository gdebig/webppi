<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <a href="<?= base_url(); ?>/piifair/docs/<?= $user_id; ?>">Kembali ke daftar dokumen FAIR</a>
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

                <?php if (isset($data_pend) && ($data_pend == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data pendidikan belum ada.</div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenjang</th>
                                <th>Universitas</th>
                                <th>Fakultas</th>
                                <th>Program Studi</th>
                                <th>Alamat</th>
                                <th>Tahun Lulus</th>
                                <th>Gelar</th>
                                <th>Judul Tugas Akhir</th>
                                <th>Uraian Tugas Akhir</th>
                                <th>Nilai</th>
                                <th>Scan Ijazah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_pend as $pend) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $pend['Rank']; ?></td>
                                    <td><?= $pend['Name']; ?></td>
                                    <td><?= $pend['Faculty']; ?></td>
                                    <td><?= $pend['Major']; ?></td>
                                    <td><?= $pend['City'] . ", " . $pend['Country'] ?></td>
                                    <td><?= $pend['GradYear']; ?></td>
                                    <td><?= $pend['Degree']; ?></td>
                                    <td><?= $pend['Title']; ?></td>
                                    <td><?= $pend['Desc']; ?></td>
                                    <td><?= $pend['Mark']; ?></td>
                                    <td><a href="<?= base_url(); ?>/uploads/docs/<?= $pend['File']; ?>" target="_blank">Lihat Ijazah</a></td>
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