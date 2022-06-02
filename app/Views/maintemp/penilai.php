<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">

                <div class="col">
                    <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif;?>
                </div>
                <!--
                <div class="col">
                    <div class="row">
                        <a href="<?php echo base_url();?>/manpenilai/tambahpenilai" class="btn btn-primary">Tambah
                            Penilai</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>-->

                <?php if(isset($data_user)&&($data_user=="kosong")){
                    ?>

                <div class="alert alert-danger">Data penilai belum ada. <a
                        href="<?= base_url();?>/manpenilai/tambahpenilai">Klik
                        di sini untuk menambah data penilai</a></div>
                <?php }else{ ?>

                <table id="tabledata" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Jumlah Mahasiswa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $i=1; 
                                    foreach ($data_user as $user) : 
                                    ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><?= $user['username'];?></td>
                            <td>Jumlah Mahasiswa</td>
                            <td style="text-align: center"><a
                                    href="<?php echo base_url();?>/manpenilai/ubahdatapenilai/<?=$user['user_id'];?>"
                                    class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a>
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

<?= $this->endSection();?>