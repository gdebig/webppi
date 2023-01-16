<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">

                <div class="col">
                    <?php if (session()->getFlashdata('msg')) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif; ?>
                </div>

                <?php if (isset($data_user) && ($data_user == "kosong")) {
                ?>

                    <div class="alert alert-danger">Data peserta penilaian RPL belum ada.</div>
                <?php } else { ?>

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peserta PPI</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($data_user as $user) :
                            ?>
                                <tr>
                                    <td><?php echo $i;
                                        $i++; ?></td>
                                    <td><?= !empty($user['FullName']) ? $user['FullName'] : "(Belum isi Profile)"; ?></td>
                                    <td>
                                        <?php
                                        if ((isset($nilairplconfirm[$user['mhsrpl_id']])) && ($nilairplconfirm[$user['mhsrpl_id']] == "Ya")) {
                                            $status = "Sudah confirm";
                                        } elseif ((isset($nilairplsubmit[$user['mhsrpl_id']])) && ($nilairplsubmit[$user['mhsrpl_id']] == "Ya")) {
                                            $status = "Sudah submit";
                                        } elseif ((isset($nilairplsave[$user['mhsrpl_id']])) && ($nilairplsave[$user['mhsrpl_id']] == "Ya")) {
                                            $status = "Sudah save";
                                        } else {
                                            $status = "Belum diproses";
                                        }
                                        ?>
                                        <a href="<?= base_url(); ?>/mannilairpl/penilaianrpl/<?= $user['mhsrpl_id']; ?>/<?= $dosen_id; ?>">Lihat Nilai (<?= $status; ?>)</a>
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
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>