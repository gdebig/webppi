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
                            <h3 class="card-title">Mata Kuliah RPL <?= $FullName; ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="container">
                                    <form action="<?php echo base_url(); ?>/manpeserta/confirmnilairpl" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="mhs_id" id="mhs_id" value=<?= $mhs_id; ?> />
                                        <div class="row">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama MK</th>
                                                    <th>Bobot Pembimbing</th>
                                                    <th>Jumlah Item Pembimbing</th>
                                                    <th>Rata/rata (Nilai Huruf) Pembimbing</th>
                                                    <th>Bobot Penilai</th>
                                                    <th>Jumlah Item Penilai</th>
                                                    <th>Rata/rata (Nilai Huruf) Penilai</th>
                                                </tr>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Kode Etik dan Etika Profesi Insinyur</td>
                                                    <td><?= (!empty($nilaikodeetikbimbing) ? $nilaikodeetikbimbing : '0'); ?></td>
                                                    <td><?= (!empty($jmlkodeetikbimbing) ? $jmlkodeetikbimbing : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlkodeetikbimbing)) {
                                                            $ratarata = $nilaikodeetikbimbing / $jmlkodeetikbimbing;
                                                            $nilaihuruf = nilai_huruf_rpl($ratarata);
                                                        }

                                                        echo (!empty($ratarata) ? $ratarata . ' (' . $nilaihuruf . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td><?= (!empty($nilaikodeetikpenilai) ? $nilaikodeetikpenilai : '0'); ?></td>
                                                    <td><?= (!empty($jmlkodeetikpenilai) ? $jmlkodeetikpenilai : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlkodeetikpenilai)) {
                                                            $ratarata1 = $nilaikodeetikpenilai / $jmlkodeetikpenilai;
                                                            $nilaihuruf1 = nilai_huruf_rpl($ratarata1);
                                                        }

                                                        echo (!empty($ratarata1) ? $ratarata1 . ' (' . $nilaihuruf1 . ')' : '0');
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td>Profesionalisme</td>
                                                    <td><?= (!empty($nilaiprofesibimbing) ? $nilaiprofesibimbing : '0'); ?></td>
                                                    <td><?= (!empty($jmlprofesibimbing) ? $jmlprofesibimbing : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlprofesibimbing)) {
                                                            $ratarata = $nilaiprofesibimbing / $jmlprofesibimbing;
                                                            $nilaihuruf = nilai_huruf_rpl($ratarata);
                                                        }

                                                        echo (!empty($ratarata) ? $ratarata . ' (' . $nilaihuruf . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td><?= (!empty($nilaiprofesipenilai) ? $nilaiprofesipenilai : '0'); ?></td>
                                                    <td><?= (!empty($jmlprofesipenilai) ? $jmlprofesipenilai : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlprofesipenilai)) {
                                                            $ratarata1 = $nilaiprofesipenilai / $jmlprofesipenilai;
                                                            $nilaihuruf1 = nilai_huruf_rpl($ratarata1);
                                                        }

                                                        echo (!empty($ratarata1) ? $ratarata1 . ' (' . $nilaihuruf1 . ')' : '0');
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3.</td>
                                                    <td>Keselamatan, Kesehatan, Keamanan Kerja dan Lingkungan Hidup</td>
                                                    <td><?= (!empty($nilaik3lhbimbing) ? $nilaik3lhbimbing : '0'); ?></td>
                                                    <td><?= (!empty($jmlk3lhbimbing) ? $jmlk3lhbimbing : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlk3lhbimbing)) {
                                                            $ratarata = $nilaik3lhbimbing / $jmlk3lhbimbing;
                                                            $nilaihuruf = nilai_huruf_rpl($ratarata);
                                                        }

                                                        echo (!empty($ratarata) ? $ratarata . ' (' . $nilaihuruf . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td><?= (!empty($nilaik3lhpenilai) ? $nilaik3lhpenilai : '0'); ?></td>
                                                    <td><?= (!empty($jmlk3lhpenilai) ? $jmlk3lhpenilai : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlk3lhpenilai)) {
                                                            $ratarata1 = $nilaik3lhpenilai / $jmlk3lhpenilai;
                                                            $nilaihuruf1 = nilai_huruf_rpl($ratarata1);
                                                        }

                                                        echo (!empty($ratarata1) ? $ratarata1 . ' (' . $nilaihuruf1 . ')' : '0');
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4.</td>
                                                    <td>Studi Kasus</td>
                                                    <td><?= (!empty($nilaistudikasusbimbing) ? $nilaistudikasusbimbing : '0'); ?></td>
                                                    <td><?= (!empty($jmlstudikasusbimbing) ? $jmlstudikasusbimbing : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlstudikasusbimbing)) {
                                                            $ratarata = $nilaistudikasusbimbing / $jmlstudikasusbimbing;
                                                            $nilaihuruf = nilai_huruf_rpl($ratarata);
                                                        }

                                                        echo (!empty($ratarata) ? $ratarata . ' (' . $nilaihuruf . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td><?= (!empty($nilaistudikasuspenilai) ? $nilaistudikasuspenilai : '0'); ?></td>
                                                    <td><?= (!empty($jmlstudikasuspenilai) ? $jmlstudikasuspenilai : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlstudikasuspenilai)) {
                                                            $ratarata1 = $nilaistudikasuspenilai / $jmlstudikasuspenilai;
                                                            $nilaihuruf1 = nilai_huruf_rpl($ratarata1);
                                                        }

                                                        echo (!empty($ratarata1) ? $ratarata1 . ' (' . $nilaihuruf1 . ')' : '0');
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5.</td>
                                                    <td>Seminar</td>
                                                    <td><?= (!empty($nilaiseminarbimbing) ? $nilaiseminarbimbing : '0'); ?></td>
                                                    <td><?= (!empty($jmlseminarbimbing) ? $jmlseminarbimbing : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlseminarbimbing)) {
                                                            $ratarata = $nilaiseminarbimbing / $jmlseminarbimbing;
                                                            $nilaihuruf = nilai_huruf_rpl($ratarata);
                                                        }

                                                        echo (!empty($ratarata) ? $ratarata . ' (' . $nilaihuruf . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td><?= (!empty($nilaiseminarpenilai) ? $nilaiseminarpenilai : '0'); ?></td>
                                                    <td><?= (!empty($jmlseminarpenilai) ? $jmlseminarpenilai : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlseminarpenilai)) {
                                                            $ratarata1 = $nilaiseminarpenilai / $jmlseminarpenilai;
                                                            $nilaihuruf1 = nilai_huruf_rpl($ratarata1);
                                                        }

                                                        echo (!empty($ratarata1) ? $ratarata1 . ' (' . $nilaihuruf1 . ')' : '0');
                                                        ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary col">Konfirmasi Nilai RPL</button>
                                    </form>
                                </div>
                            </div>
                        </div>
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