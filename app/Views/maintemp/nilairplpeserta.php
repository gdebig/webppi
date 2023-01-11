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
                                                    <th>Rata-rata (Nilai Huruf) Penilai 1</th>
                                                    <th>Rata-rata (Nilai Huruf) Penilai 2</th>
                                                    <th>Rata-rata (Nilai Huruf) Total</th>
                                                    <th>Selisih</th>
                                                </tr>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Kode Etik dan Etika Profesi Insinyur</td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlkodeetikbimbing)) {
                                                            $rataratabimbing1 = $nilaikodeetikbimbing / $jmlkodeetikbimbing;
                                                            $nilaihurufbimbing1 = nilai_huruf_rpl($rataratabimbing1);
                                                        } else {
                                                            $rataratabimbing1 = 0;
                                                            $nilaihurufbimbing1 = nilai_huruf_rpl($rataratabimbing1);
                                                        }

                                                        echo (!empty($rataratabimbing1) ? $rataratabimbing1 . ' (' . $nilaihurufbimbing1 . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlkodeetikpenilai)) {
                                                            $rataratanilai1 = $nilaikodeetikpenilai / $jmlkodeetikpenilai;
                                                            $nilaihurufnilai1 = nilai_huruf_rpl($rataratanilai1);
                                                        } else {
                                                            $rataratanilai1 = 0;
                                                            $nilaihurufnilai1 = nilai_huruf_rpl($rataratanilai1);
                                                        }

                                                        echo (!empty($rataratanilai1) ? $rataratanilai1 . ' (' . $nilaihurufnilai1 . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($rataratabimbing1) && (!empty($rataratanilai1))) {
                                                            $rataratatot1 = ($rataratabimbing1 + $rataratanilai1) / 2;
                                                            $nilaihurufrataratatot1 = nilai_huruf_rpl($rataratatot1);
                                                        } else {
                                                            $rataratatot1 = 0;
                                                            $nilaihurufrataratatot1 = nilai_huruf_rpl($rataratatot1);
                                                        }

                                                        echo (!empty($rataratatot1) ? $rataratatot1 . ' (' . $nilaihurufrataratatot1 . ')' : '0');
                                                        ?>
                                                        <input type="hidden" name="kodeetik" id="kodeetik" value="<?= $rataratatot1; ?>" />
                                                    </td>
                                                    <?php
                                                    $kurang1 = $rataratabimbing1 - $rataratanilai1;
                                                    if (abs($kurang1) >= 2) {
                                                        $bgcolor = 'bgcolor = "red"';
                                                    } else {
                                                        $bgcolor = '';
                                                    }
                                                    ?>
                                                    <td <?= $bgcolor; ?>><?= $kurang1; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td>Profesionalisme</td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlprofesibimbing)) {
                                                            $rataratabimbing2 = $nilaiprofesibimbing / $jmlprofesibimbing;
                                                            $nilaihurufbimbing2 = nilai_huruf_rpl($rataratabimbing2);
                                                        } else {
                                                            $rataratabimbing2 = 0;
                                                            $nilaihurufbimbing2 = nilai_huruf_rpl($rataratabimbing2);
                                                        }

                                                        echo (!empty($rataratabimbing2) ? $rataratabimbing2 . ' (' . $nilaihurufbimbing2 . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlprofesipenilai)) {
                                                            $rataratanilai2 = $nilaiprofesipenilai / $jmlprofesipenilai;
                                                            $nilaihurufnilai2 = nilai_huruf_rpl($rataratanilai2);
                                                        } else {
                                                            $rataratanilai2 = 0;
                                                            $nilaihurufnilai2 = nilai_huruf_rpl($rataratanilai2);
                                                        }

                                                        echo (!empty($rataratanilai2) ? $rataratanilai2 . ' (' . $nilaihurufnilai2 . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($rataratabimbing2) && (!empty($rataratanilai2))) {
                                                            $rataratatot2 = ($rataratabimbing2 + $rataratanilai2) / 2;
                                                            $nilaihurufrataratatot2 = nilai_huruf_rpl($rataratatot2);
                                                        } else {
                                                            $rataratatot2 = 0;
                                                            $nilaihurufrataratatot2 = nilai_huruf_rpl($rataratatot2);
                                                        }

                                                        echo (!empty($rataratatot2) ? $rataratatot2 . ' (' . $nilaihurufrataratatot2 . ')' : '0');
                                                        ?>
                                                        <input type="hidden" name="profesi" id="profesi" value="<?= $rataratatot2; ?>" />
                                                    </td>
                                                    <?php
                                                    $kurang2 = $rataratabimbing2 - $rataratanilai2;
                                                    if (abs($kurang2) >= 2) {
                                                        $bgcolor = 'bgcolor = "red"';
                                                    } else {
                                                        $bgcolor = '';
                                                    }
                                                    ?>
                                                    <td <?= $bgcolor; ?>><?= $kurang2; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>3.</td>
                                                    <td>Keselamatan, Kesehatan, Keamanan Kerja dan Lingkungan Hidup</td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlk3lhbimbing)) {
                                                            $rataratabimbing3 = $nilaik3lhbimbing / $jmlk3lhbimbing;
                                                            $nilaihurufbimbing3 = nilai_huruf_rpl($rataratabimbing3);
                                                        } else {
                                                            $rataratabimbing3 = 0;
                                                            $nilaihurufbimbing3 = nilai_huruf_rpl($rataratabimbing3);
                                                        }

                                                        echo (!empty($rataratabimbing3) ? $rataratabimbing3 . ' (' . $nilaihurufbimbing3 . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlk3lhpenilai)) {
                                                            $rataratanilai3 = $nilaik3lhpenilai / $jmlk3lhpenilai;
                                                            $nilaihurufnilai3 = nilai_huruf_rpl($rataratanilai3);
                                                        } else {
                                                            $rataratanilai3 = 0;
                                                            $nilaihurufnilai3 = nilai_huruf_rpl($rataratanilai3);
                                                        }

                                                        echo (!empty($rataratanilai3) ? $rataratanilai3 . ' (' . $nilaihurufnilai3 . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($rataratabimbing3) && (!empty($rataratanilai3))) {
                                                            $rataratatot3 = ($rataratabimbing3 + $rataratanilai3) / 2;
                                                            $nilaihurufrataratatot3 = nilai_huruf_rpl($rataratatot3);
                                                        } else {
                                                            $rataratatot3 = 0;
                                                            $nilaihurufrataratatot3 = nilai_huruf_rpl($rataratatot3);
                                                        }

                                                        echo (!empty($rataratatot3) ? $rataratatot3 . ' (' . $nilaihurufrataratatot3 . ')' : '0');
                                                        ?>
                                                        <input type="hidden" name="k3lh" id="k3lh" value="<?= $rataratatot3; ?>" />
                                                    </td>
                                                    <?php
                                                    $kurang3 = $rataratabimbing3 - $rataratanilai3;
                                                    if (abs($kurang3) >= 2) {
                                                        $bgcolor = 'bgcolor = "red"';
                                                    } else {
                                                        $bgcolor = '';
                                                    }
                                                    ?>
                                                    <td <?= $bgcolor; ?>><?= $kurang3; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>4.</td>
                                                    <td>Studi Kasus</td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlstudikasusbimbing)) {
                                                            $rataratabimbing4 = $nilaistudikasusbimbing / $jmlstudikasusbimbing;
                                                            $nilaihurufbimbing4 = nilai_huruf_rpl($rataratabimbing4);
                                                        } else {
                                                            $rataratabimbing4 = 0;
                                                            $nilaihurufbimbing4 = nilai_huruf_rpl($rataratabimbing4);
                                                        }

                                                        echo (!empty($rataratabimbing4) ? $rataratabimbing4 . ' (' . $nilaihurufbimbing4 . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlstudikasuspenilai)) {
                                                            $rataratanilai4 = $nilaistudikasuspenilai / $jmlstudikasuspenilai;
                                                            $nilaihurufnilai4 = nilai_huruf_rpl($rataratanilai4);
                                                        } else {
                                                            $rataratanilai4 = 0;
                                                            $nilaihurufnilai4 = nilai_huruf_rpl($rataratanilai4);
                                                        }

                                                        echo (!empty($rataratanilai4) ? $rataratanilai4 . ' (' . $nilaihurufnilai4 . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($rataratabimbing4) && (!empty($rataratanilai4))) {
                                                            $rataratatot4 = ($rataratabimbing4 + $rataratanilai4) / 2;
                                                            $nilaihurufrataratatot4 = nilai_huruf_rpl($rataratatot4);
                                                        } else {
                                                            $rataratatot4 = 0;
                                                            $nilaihurufrataratatot4 = nilai_huruf_rpl($rataratatot4);
                                                        }

                                                        echo (!empty($rataratatot4) ? $rataratatot4 . ' (' . $nilaihurufrataratatot4 . ')' : '0');
                                                        ?>
                                                        <input type="hidden" name="studikasus" id="studikasus" value="<?= $rataratatot4; ?>" />
                                                    </td>
                                                    <?php
                                                    $kurang4 = $rataratabimbing4 - $rataratanilai4;
                                                    if (abs($kurang4) >= 2) {
                                                        $bgcolor = 'bgcolor = "red"';
                                                    } else {
                                                        $bgcolor = '';
                                                    }
                                                    ?>
                                                    <td <?= $bgcolor; ?>><?= $kurang4; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>5.</td>
                                                    <td>Seminar</td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlseminarbimbing)) {
                                                            $rataratabimbing5 = $nilaiseminarbimbing / $jmlseminarbimbing;
                                                            $nilaihurufbimbing5 = nilai_huruf_rpl($rataratabimbing5);
                                                        } else {
                                                            $rataratabimbing5 = 0;
                                                            $nilaihurufbimbing5 = nilai_huruf_rpl($rataratabimbing5);
                                                        }

                                                        echo (!empty($rataratabimbing5) ? $rataratabimbing5 . ' (' . $nilaihurufbimbing5 . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlseminarpenilai)) {
                                                            $rataratanilai5 = $nilaiseminarpenilai / $jmlseminarpenilai;
                                                            $nilaihurufnilai5 = nilai_huruf_rpl($rataratanilai5);
                                                        } else {
                                                            $rataratanilai5 = 0;
                                                            $nilaihurufnilai5 = nilai_huruf_rpl($rataratanilai5);
                                                        }

                                                        echo (!empty($rataratanilai5) ? $rataratanilai5 . ' (' . $nilaihurufnilai5 . ')' : '0');
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($rataratabimbing5) && (!empty($rataratanilai5))) {
                                                            $rataratatot5 = ($rataratabimbing5 + $rataratanilai5) / 2;
                                                            $nilaihurufrataratatot5 = nilai_huruf_rpl($rataratatot5);
                                                        } else {
                                                            $rataratatot5 = 0;
                                                            $nilaihurufrataratatot5 = nilai_huruf_rpl($rataratatot5);
                                                        }

                                                        echo (!empty($rataratatot5) ? $rataratatot5 . ' (' . $nilaihurufrataratatot5 . ')' : '0');
                                                        ?>
                                                        <input type="hidden" name="seminar" id="seminar" value="<?= $rataratatot5; ?>" />
                                                    </td>
                                                    <?php
                                                    $kurang5 = $rataratabimbing5 - $rataratanilai5;
                                                    if (abs($kurang5) >= 2) {
                                                        $bgcolor = 'bgcolor = "red"';
                                                    } else {
                                                        $bgcolor = '';
                                                    }
                                                    ?>
                                                    <td <?= $bgcolor; ?>><?= $kurang5; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary col">Konfirmasi Nilai RPL</button>
                                        <a href="<?= base_url(); ?>/manpeserta">Kembali</a>
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