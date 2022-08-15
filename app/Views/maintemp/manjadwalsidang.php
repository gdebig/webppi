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

                <div class="col">
                    <div class="row">
                        <a href="<?php echo base_url();?>/mantugasakhir" class="btn btn-primary">Kembali ke daftar tugas
                            akhir</a>
                    </div>
                </div>

                <?php if(isset($data_js)&&($data_js=="kosong")){
                    ?>

                <div class="alert alert-danger">Data jadwal sidang belum ada. <a
                        href="<?= base_url();?>/mantugasakhir/tambahjadwal/<?= $ta_id;?>">Klik
                        di sini untuk menambah jadwal sidang</a></div>
                <?php }else{ ?>

                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ruang Sidang</th>
                            <th>Tanggal Sidang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $i=1; 
                                    foreach ($data_js as $ta) : 
                                    ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><?= $ta['sidang_ruang'];?></td>
                            <td><?= $ta['sidang_tanggal'];?></td>
                            <td style="text-align: center">
                                <a href="<?php echo base_url();?>/mantugasakhir/hapusjadwal/<?=$ta['sidang_id'];?>/<?= $ta_id;?>"
                                    onclick="return confirm('Apakah anda yakin akan menghapus jadwal sidang?')"
                                    class="btn btn-danger"> <i class="fas fa-trash"></i>
                                    Hapus</a>
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