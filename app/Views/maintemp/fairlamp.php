<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">
                <h4 style="text-align: center;">LEMBAR DOKUMENTASI SEMUA LAMPIRAN</h4>
                <br /><br />
                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="5%" style="text-align: center">No</th>
                            <th width="15%">Lembar Kerja</th>
                            <th width="30%">Nama/Judul</th>
                            <th width="50%">Dokumen Pendukung (Max. 700KB, image atau PDF)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if ($datapend != 'kosong') {
                            foreach ($datapend as $pend) :
                        ?>
                                <tr>
                                    <td width="5%" style="text-align: center"><?= $i; ?></td>
                                    <td width="15%">I.2</td>
                                    <td width="30%"><?= $pend['Name']; ?></td>
                                    <td width="50%"><a href="<?= base_url(); ?>/uploads/docs/<?= $pend['File']; ?>" target="_blank">Lihat File</a></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                        }

                        if ($dataorg != 'kosong') {
                            foreach ($dataorg as $org) :
                            ?>
                                <tr>
                                    <td width="5%" style="text-align: center"><?= $i; ?></td>
                                    <td width="15%">I.3</td>
                                    <td width="30%"><?= $org['Name']; ?></td>
                                    <td width="50%"><a href="<?= base_url(); ?>/uploads/docs/<?= $org['File']; ?>" target="_blank">Lihat File</a></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                        }

                        if ($datapenghargaan != 'kosong') {
                            foreach ($datapenghargaan as $penghargaan) :
                            ?>
                                <tr>
                                    <td width="5%" style="text-align: center"><?= $i; ?></td>
                                    <td width="15%">I.4</td>
                                    <td width="30%"><?= $penghargaan['Name']; ?></td>
                                    <td width="50%"><a href="<?= base_url(); ?>/uploads/docs/<?= $penghargaan['File']; ?>" target="_blank">Lihat File</a></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                        }

                        if ($datalatih != 'kosong') {
                            foreach ($datalatih as $latih) :
                            ?>
                                <tr>
                                    <td width="5%" style="text-align: center"><?= $i; ?></td>
                                    <td width="15%">I.5</td>
                                    <td width="30%"><?= $latih['Name']; ?></td>
                                    <td width="50%"><a href="<?= base_url(); ?>/uploads/docs/<?= $latih['File']; ?>" target="_blank">Lihat File</a></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                        }

                        if ($datasert != 'kosong') {
                            foreach ($datasert as $sert) :
                            ?>
                                <tr>
                                    <td width="5%" style="text-align: center"><?= $i; ?></td>
                                    <td width="15%">I.6</td>
                                    <td width="30%"><?= $sert['Name']; ?></td>
                                    <td width="50%"><a href="<?= base_url(); ?>/uploads/docs/<?= $sert['File']; ?>" target="_blank">Lihat File</a></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                        }

                        if ($datakerja != 'kosong') {
                            foreach ($datakerja as $kerja) :
                            ?>
                                <tr>
                                    <td width="5%" style="text-align: center"><?= $i; ?></td>
                                    <td width="15%">III</td>
                                    <td width="30%"><?= $kerja['Name']; ?></td>
                                    <td width="50%"><a href="<?= base_url(); ?>/uploads/docs/<?= $kerja['File']; ?>" target="_blank">Lihat File</a></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                        }

                        if ($dataajar != 'kosong') {
                            foreach ($dataajar as $ajar) :
                            ?>
                                <tr>
                                    <td width="5%" style="text-align: center"><?= $i; ?></td>
                                    <td width="15%">IV</td>
                                    <td width="30%"><?= $ajar['Name']; ?></td>
                                    <td width="50%"><a href="<?= base_url(); ?>/uploads/docs/<?= $ajar['File']; ?>" target="_blank">Lihat File</a></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                        }

                        if ($datakartul != 'kosong') {
                            foreach ($datakartul as $kartul) :
                            ?>
                                <tr>
                                    <td width="5%" style="text-align: center"><?= $i; ?></td>
                                    <td width="15%">V.1</td>
                                    <td width="30%"><?= $kartul['Name']; ?></td>
                                    <td width="50%"><a href="<?= base_url(); ?>/uploads/docs/<?= $kartul['File']; ?>" target="_blank">Lihat File</a></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                        }

                        if ($datamak != 'kosong') {
                            foreach ($datamak as $mak) :
                            ?>
                                <tr>
                                    <td width="5%" style="text-align: center"><?= $i; ?></td>
                                    <td width="15%">V.2</td>
                                    <td width="30%"><?= $mak['Name']; ?></td>
                                    <td width="50%"><a href="<?= base_url(); ?>/uploads/docs/<?= $mak['File']; ?>" target="_blank">Lihat File</a></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                        }

                        if ($datasem != 'kosong') {
                            foreach ($datasem as $sem) :
                            ?>
                                <tr>
                                    <td width="5%" style="text-align: center"><?= $i; ?></td>
                                    <td width="15%">V.3</td>
                                    <td width="30%"><?= $sem['Name']; ?></td>
                                    <td width="50%"><a href="<?= base_url(); ?>/uploads/docs/<?= $sem['File']; ?>" target="_blank">Lihat File</a></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                        }

                        if ($datainov != 'kosong') {
                            foreach ($datainov as $inov) :
                            ?>
                                <tr>
                                    <td width="5%" style="text-align: center"><?= $i; ?></td>
                                    <td width="15%">V.4</td>
                                    <td width="30%"><?= $inov['Name']; ?></td>
                                    <td width="50%"><a href="<?= base_url(); ?>/uploads/docs/<?= $inov['File']; ?>" target="_blank">Lihat File</a></td>
                                </tr>
                            <?php
                                $i++;
                            endforeach;
                        }

                        if ($databahasa != 'kosong') {
                            foreach ($databahasa as $bahasa) :
                            ?>
                                <tr>
                                    <td width="5%" style="text-align: center"><?= $i; ?></td>
                                    <td width="15%">V.4</td>
                                    <td width="30%"><?= $bahasa['Name']; ?></td>
                                    <td width="50%"><a href="<?= base_url(); ?>/uploads/docs/<?= $bahasa['File']; ?>" target="_blank">Lihat File</a></td>
                                </tr>
                        <?php
                                $i++;
                            endforeach;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>