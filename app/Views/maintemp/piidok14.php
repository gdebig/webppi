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

                <?php if (isset($data_harga) && ($data_harga == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data penghargaan belum ada.</div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Nama Tanda Penghargaan</th>
                                <th>Nama Lembaga yang Memberikan</th>
                                <th>Lokasi</th>
                                <th>Negara</th>
                                <th>Penghargaan yang diterima tingkat</th>
                                <th>Penghargaan diberikan oleh lembaga</th>
                                <th>Uraian Singkat Tanda Penghargaan</th>
                                <th>Klaim Kompetensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_harga as $penghargaan) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?php
                                        switch ($penghargaan['Month']) {
                                            case '1':
                                                $bulan = "Jan";
                                                break;
                                            case '2':
                                                $bulan = "Feb";
                                                break;
                                            case '3':
                                                $bulan = "Mar";
                                                break;
                                            case '4':
                                                $bulan = "Apr";
                                                break;
                                            case '5':
                                                $bulan = "Mei";
                                                break;
                                            case '6':
                                                $bulan = "Jun";
                                                break;
                                            case '7':
                                                $bulan = "Jul";
                                                break;
                                            case '8':
                                                $bulan = "Agus";
                                                break;
                                            case '9':
                                                $bulan = "Sep";
                                                break;
                                            case '10':
                                                $bulan = "Okt";
                                                break;
                                            case '11':
                                                $bulan = "Nov";
                                                break;
                                            case '12':
                                                $bulan = "Des";
                                                break;
                                        }
                                        echo $bulan . ' - ' . $penghargaan['Year'];
                                        ?></td>
                                    <td><?= $penghargaan['Name']; ?></td>
                                    <td><?= $penghargaan['Institute']; ?></td>
                                    <td><?= $penghargaan['City'] . ', ' . $penghargaan['Prov']; ?></td>
                                    <td><?= $penghargaan['Country']; ?></td>
                                    <td>
                                        <?php
                                        switch ($penghargaan['Level']) {
                                            case 'Mud':
                                                echo "Tingkatan Muda/Pemula";
                                                break;
                                            case 'Mad':
                                                echo "Tingkatan Madya";
                                                break;
                                            case 'Uta':
                                                echo "Tingkatan Utama";
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        switch ($penghargaan['InstituteType']) {
                                            case 'Lok':
                                                echo "Penghargaan Lokal";
                                                break;
                                            case 'Nas':
                                                echo "Penghargaan Nasional";
                                                break;
                                            case 'Reg':
                                                echo "Penghargaan Regional";
                                                break;
                                            case 'Int':
                                                echo "Penghargaan Internasional";
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td><?= $penghargaan['Desc']; ?></td>
                                    <td><?= $penghargaan['kompetensi']; ?></td>
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