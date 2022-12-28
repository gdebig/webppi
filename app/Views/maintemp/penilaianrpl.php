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
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/mannilairpl/kodeetik/<?= $mhs_id; ?>/<?= $dosen_id; ?>" class="btn btn-block btn-success btn-sm">Kode Etik dan Etika Profesi
                                        Insinyur</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/mannilairpl/profesi/<?= $mhs_id; ?>/<?= $dosen_id; ?>" class="btn btn-block btn-success btn-sm">Profesionalisme</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/mannilairpl/k3lh/<?= $mhs_id; ?>/<?= $dosen_id; ?>" class="btn btn-block btn-success btn-sm">Keselamatan,Kesehatan,Keamanan
                                        kerja&Lingk</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/mannilairpl/studikasus/<?= $mhs_id; ?>/<?= $dosen_id; ?>" class="btn btn-block btn-success btn-sm">Studi Kasus</a>
                                </div>
                                <div class="col">
                                    <a href="<?php echo base_url(); ?>/mannilairpl/seminar/<?= $mhs_id; ?>/<?= $dosen_id; ?>" class="btn btn-block btn-success btn-sm">Seminar</a>
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <div class="container">
                                    <form action="<?php echo base_url(); ?>/mannilairpl/submitmannilairpl" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="mhs_id" id="mhs_id" value=<?= $mhs_id; ?> />
                                        <input type="hidden" name="dosen_id" id="dosen_id" value=<?= $dosen_id; ?> />
                                        <div class="row">
                                            <table class="table table-bordered">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama MK</th>
                                                    <th>Bobot</th>
                                                    <th>Jumlah Item</th>
                                                    <th>Rata/rata (Nilai Huruf)</th>
                                                </tr>
                                                <tr>
                                                    <td>1.</td>
                                                    <td>Kode Etik dan Etika Profesi Insinyur</td>
                                                    <td><?= (!empty($nilaikodeetik) ? $nilaikodeetik : '0'); ?></td>
                                                    <td><?= (!empty($jmlkodeetik) ? $jmlkodeetik : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlkodeetik)) {
                                                            $ratarata = $nilaikodeetik / $jmlkodeetik;
                                                            $nilaihuruf = nilai_huruf_rpl($ratarata);
                                                        }

                                                        echo (!empty($ratarata) ? $ratarata . ' (' . $nilaihuruf . ')' : '0');
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>2.</td>
                                                    <td>Profesionalisme</td>
                                                    <td><?= (!empty($nilaiprofesi) ? $nilaiprofesi : '0'); ?></td>
                                                    <td><?= (!empty($jmlprofesi) ? $jmlprofesi : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlprofesi)) {
                                                            $ratarata = $nilaiprofesi / $jmlprofesi;
                                                            $nilaihuruf = nilai_huruf_rpl($ratarata);
                                                        }

                                                        echo (!empty($ratarata) ? $ratarata . ' (' . $nilaihuruf . ')' : '0');
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>3.</td>
                                                    <td>Keselamatan, Kesehatan, Keamanan Kerja dan Lingkungan Hidup</td>
                                                    <td><?= (!empty($nilaik3lh) ? $nilaik3lh : '0'); ?></td>
                                                    <td><?= (!empty($jmlk3lh) ? $jmlk3lh : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlk3lh)) {
                                                            $ratarata = $nilaik3lh / $jmlk3lh;
                                                            $nilaihuruf = nilai_huruf_rpl($ratarata);
                                                        }

                                                        echo (!empty($ratarata) ? $ratarata . ' (' . $nilaihuruf . ')' : '0');
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>4.</td>
                                                    <td>Studi Kasus</td>
                                                    <td><?= (!empty($nilaistudikasus) ? $nilaistudikasus : '0'); ?></td>
                                                    <td><?= (!empty($jmlstudikasus) ? $jmlstudikasus : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlstudikasus)) {
                                                            $ratarata = $nilaistudikasus / $jmlstudikasus;
                                                            $nilaihuruf = nilai_huruf_rpl($ratarata);
                                                        }

                                                        echo (!empty($ratarata) ? $ratarata . ' (' . $nilaihuruf . ')' : '0');
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>5.</td>
                                                    <td>Seminar</td>
                                                    <td><?= (!empty($nilaiseminar) ? $nilaiseminar : '0'); ?></td>
                                                    <td><?= (!empty($jmlseminar) ? $jmlseminar : '0'); ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($jmlseminar)) {
                                                            $ratarata = $nilaiseminar / $jmlseminar;
                                                            $nilaihuruf = nilai_huruf_rpl($ratarata);
                                                        }

                                                        echo (!empty($ratarata) ? $ratarata . ' (' . $nilaihuruf . ')' : '0');
                                                        ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <button type="submit" name="submit" value="submit" class="btn btn-primary col">Submit Nilai RPL</button>
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