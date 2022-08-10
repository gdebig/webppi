<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">

                <?php if(session()->getFlashdata('msg')):?>
                <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                <?php endif;?>

                <div class="col">
                    <div class="row">
                        <a href="<?php echo base_url();?>/userfair21/tambahref" class="btn btn-primary">Tambah
                            Referensi Kode Etik</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if(isset($data_etik)&&($data_etik=="kosong")){
                    ?>

                <div class="alert alert-danger">Data referensi kode etik belum ada. <a
                        href="<?= base_url();?>/userfair21/tambahref">Klik
                        di sini untuk menambah data referensi kode etik</a></div>
                <?php }else{ ?>

                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Institusi</th>
                            <th>Alamat</th>
                            <th>No. Telepon</th>
                            <th>Email</th>
                            <th>Hubungan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $i=1; 
                                    foreach ($data_etik as $etik) : 
                                    ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><?= $etik['Name'];?></td>
                            <td><?= $etik['Institute']?></td>
                            <td><?= $etik['Addr']."<br />".$etik['City'].', '.$etik['Prov'].', '.$etik['Country'];?>
                            </td>
                            <td><?= $etik['Pnum'];?></td>
                            <td><?= $etik['Email'];?></td>
                            <td><?= $etik['Relation'];?></td>
                            <td style="text-align: center"><a
                                    href="<?php echo base_url();?>/ubahfair21/ubahetik/<?=$etik['Num'];?>"
                                    class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a>
                                <a href="<?php echo base_url();?>/ubahfair21/hapusetik/<?=$etik['Num'];?>"
                                    onclick="return confirm('Apakah anda yakin akan menghapus data referensi kode etik?')"
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