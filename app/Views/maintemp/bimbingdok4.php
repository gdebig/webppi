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

                <?php if (isset($data_kerja) && ($data_kerja == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data pengalaman mengajar belum ada.</div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Perioda</th>
                                <th>Nama Perguruan Tinggi/Lembaga</th>
                                <th>Nama mata ajaran</th>
                                <th>Lokasi</th>
                                <th>Perioda</th>
                                <th>Jabatan pada Perguruan Tinggi/Lembaga</th>
                                <th>Jumlah JAM atau S.K.S</th>
                                <th>Uraian Singkat yang Diajarkan/Dikembangkan</th>
                                <th>Bukti Pengalaman Mengajar</th>
                                <th>Klaim Kompetensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_kerja as $kerja) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $kerja['StartPeriod'] . ' - ' . $kerja['EndPeriod']; ?></td>
                                    <td><?= $kerja['Institution']; ?></td>
                                    <td><?= $kerja['Name']; ?></td>
                                    <td><?= $kerja['LocCity'] . ', ' . $kerja['LocProv'] . ', ' . $kerja['LocCountry']; ?></td>
                                    <td><?php
                                        switch ($kerja['Period']) {
                                            case 'smp9':
                                                echo "1 - 9 tahun";
                                                break;
                                            case 'smp14':
                                                echo "10 - 14 tahun";
                                                break;
                                            case 'smpe19':
                                                echo "15 - 19 tahun";
                                                break;
                                            case 'lbih20':
                                                echo "> dari 20 tahun";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php
                                        switch ($kerja['Position']) {
                                            case 'Stf':
                                                echo "Staf Pengajar";
                                                break;
                                            case 'Pim':
                                                echo "Pimpinan";
                                                break;
                                        }
                                        ?></td>
                                    <td><?php
                                        switch ($kerja['Skshour']) {
                                            case 'sks1':
                                                echo "1 SKS / 15 Jam";
                                                break;
                                            case 'sks2':
                                                echo "2 - 3 SKS / 30 - 45 Jam";
                                                break;
                                            case 'sks4':
                                                echo "4 SKS / 60 Jam";
                                                break;
                                        }
                                        ?></td>
                                    <td><?= $kerja['Desc']; ?></td>
                                    <td><?php
                                        if (!empty($kerja['File'])) {
                                            echo "<a href='" . base_url('uploads/docs/' . $kerja['File']) . "' target='_blank'>" . "Lihat Bukti" . "</a>";
                                        } else {
                                            echo "";
                                        }
                                        ?></td>
                                    <td><?= $kerja['kompetensi']; ?></td>
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