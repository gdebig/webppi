<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <a href="<?= base_url(); ?>/mantugasakhir">Kembali ke daftar Praktik Keinsinyuran PPI RPL.</a>
        </div>
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">

                <div class="col">
                    <?php if (session()->getFlashdata('msg')) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif; ?>
                </div>

                <?php
                if (isset($nilai_ta) && ($nilai_ta == "kosong")) {
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
                            $i = 1;
                            $nilaitotal = 0;
                            foreach ($nilai_ta as $nilai) :
                                if ($nilai['dosen_id'] == $user_id) {
                                    $berinilai = 'tidak';
                                } else {
                                    $berinilai = 'ya';
                                }
                                $mhs_id = $nilai['mhs_id'];
                                $dosen_id = $nilai['dosen_id'];
                                $ta_id = $nilai['ta_id'];
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= $nilai['FullName']; ?></td>
                                    <td><?= $nilai['tipedosen']; ?></td>
                                    <td>
                                        <?php
                                        $nilai = (0.3 * $nilai['penulisan']) + (0.3 * $nilai['presentasi']) + (0.4 * $nilai['materi']);
                                        $nilaitotal = $nilaitotal + $nilai;
                                        $huruf = nilai_huruf($nilai);
                                        echo $nilai . ' (' . $huruf . ')';
                                        ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url(); ?>/manbimbing/lihatformevaluasi/<?= $mhs_id; ?>/<?= $dosen_id; ?>/<?= $ta_id; ?>" target='_blank'>Lihat Form</a>
                                    </td>
                                </tr>
                            <?php
                            endforeach
                            ?>
                        </tbody>
                    </table>
                    <br /><br />
                    <table>
                        <tr>
                            <td width="20%">Nilai Rata-rata</td>
                            <td width="5%" style="text-align: center">:</td>
                            <td>
                                <?php
                                $ratarata = $nilaitotal / ($i - 1);
                                echo $ratarata;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">Nilai Huruf</td>
                            <td width="5%" style="text-align: center">:</td>
                            <td>
                                <?php
                                echo nilai_huruf($ratarata);
                                ?>
                            </td>
                        </tr>
                    </table>
                    <br />
                    <p>Keterangan:</p>
                    <p>Konversi Huruf A = 85 - 100, A- = 80 - 85, B+ = 75 - 80, B = 70 - 75, B- = 65 - 70, C+= 60 - 65, C = 55 - 60</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>