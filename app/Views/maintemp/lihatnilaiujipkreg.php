<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <a href="<?= base_url(); ?>/manujipkreg">Kembali ke daftar ujian PK.</a>
        </div>
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">

                <div class="col">
                    <?php if (session()->getFlashdata('msg')) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif; ?>
                </div>

                <?php if (isset($nilai_ta) && ($nilai_ta == "kosong")) {
                    $berinilai = "ya";
                ?>

                    <div class="alert alert-danger">Belum ada penilaian.</div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dosen</th>
                                <th>Tipe</th>
                                <th>Nilai</th>
                                <th>Form Evaluasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($nilai_ta as $nilai) :
                                if ($nilai['dosen_id'] == $user_id) {
                                    $berinilai = 'tidak';
                                    break;
                                } else {
                                    $berinilai = 'ya';
                                }
                            endforeach;
                            $i = 1;
                            foreach ($nilai_ta as $nilai) :
                                $mhs_id = $nilai['mhs_id'];
                                $dosen_id = $nilai['dosen_id'];
                                $tar_id = $nilai['tar_id'];
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $nilai['FullName']; ?></td>
                                    <td><?= $nilai['tipedosen']; ?></td>
                                    <td>
                                        <?php
                                        $nilai = (0.3 * $nilai['penulisan']) + (0.3 * $nilai['presentasi']) + (0.4 * $nilai['materi']);
                                        $huruf = nilai_huruf($nilai);
                                        if (($nilai == 0) && ($dosen_id == $user_id)) {
                                        ?>
                                            <a href="<?= base_url(); ?>/manujipkreg/berinilai/<?= $mhs_id; ?>/<?= $dosen_id; ?>/<?= $tar_id; ?>" class="btn btn-block btn-primary">Beri Nilai</a>
                                        <?php
                                        } else {
                                            echo $nilai . ' (' . $huruf . ')';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url(); ?>/manujipkreg/lihatformevaluasi/<?= $mhs_id; ?>/<?= $dosen_id; ?>/<?= $tar_id; ?>" target='_blank'>Lihat Form</a>
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
        <?php
        if ($berinilai == 'ya') {
        ?>
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url(); ?>/manujipk/berinilai/<?= $mhs_id; ?>/<?= $dosen_id; ?>/<?= $tar_id; ?>" class="btn btn-block btn-primary">Beri Nilai</a>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>