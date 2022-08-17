<?= $this->extend('maintemp/template');?>

<?php
use App\Models\BimbingModel;
?>

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

                <?php if(isset($data_user)&&($data_user=="kosong")){
                    ?>

                <div class="alert alert-danger">Data penilai belum ada. <a
                        href="<?= base_url();?>/manpenilai/tambahpenilai">Klik
                        di sini untuk menambah data penilai</a></div>
                <?php }else{ ?>

                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Peserta PPI</th>
                            <th>Term</th>
                            <th>Dokumen FAIR</th>
                            <th>Judul Proyek Akhir</th>
                            <th>Buku Proyek Akhir</th>
                            <th>Log Proyek Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $i=1; 
                                    foreach ($data_user as $user) : 
                                    ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><?= $user['FullName'];?></td>
                            <td><?= $user['ta_tahun'].' - '.$user['ta_semester'];?></td>
                            <td><a href="<?= base_url();?>/bimbingfair/<?= $user['mhs_id'];?>">Lihat Detail</a></td>
                            <td><?= $user['ta_usuljudul'];?></td>
                            <td><?php
                            if (!empty($user['ta_buku'])){
                                echo "<a href='".base_url()."/uploads/docs/".$user['ta_buku']."' target='_blank'>Buku TA</a>";
                            }else{
                                echo "Belum ada buku";
                            }
                            ?></td>
                            <td><?php
                            if (!empty($user['ta_log'])){
                                echo "<a href='".base_url()."/uploads/docs/".$user['ta_log']."' target='_blank'>Buku TA</a>";
                            }else{
                                echo "Belum ada buku";
                            }
                            ?></td>
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