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
                        <a href="<?php echo base_url();?>/userfair6/tambahbahasa" class="btn btn-primary">Tambah
                            Bahasa</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if(isset($data_bahasa)&&($data_bahasa=="kosong")){
                    ?>

                <div class="alert alert-danger">Data bahasa belum ada. <a
                        href="<?= base_url();?>/userfair6/tambahbahasa">Klik
                        di sini untuk menambah data bahasa</a></div>
                <?php }else{ ?>

                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Bahasa</th>
                            <th>Jenis Bahasa</th>
                            <th>Kemampuan Verbal Aktif/Pasif</th>
                            <th>Jenis Tulisan yang Mampu Disusun</th>
                            <th>Nilai TOEFL atau yang Sejenisnya</th>
                            <th>Bukti Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $i=1; 
                                    foreach ($data_bahasa as $bahasa) : 
                                    ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><?= $bahasa['Name'];?></td>
                            <td><?php
                            switch ($bahasa['LangType']){
                                case 'Da':
                                    echo "Bahasa Daerah";
                                    break;
                                case 'Na':
                                    echo "Bahasa Nasional";
                                    break;
                                case 'In':
                                    echo "Bahasa Asing / International";
                                    break;
                            }
                            ?></td>
                            <td><?php
                            switch ($bahasa['VerbSkill']){
                                case 'Pasif':
                                    echo "Pasif, tertulis";
                                    break;
                                case 'Aktif':
                                    echo "Aktif, Tertulis/Lisan";
                                    break;
                            }
                            ?></td>
                            <td><?= $bahasa['WriteType'];?></td>
                            <td><?= $bahasa['LangMark'];?></td>
                            <td><a href="<?=base_url();?>/uploads/docs/<?=$bahasa['File'];?>"
                                    target="_blank"><?= $bahasa['File'];?></a></td>
                            <td style="text-align: center"><a
                                    href="<?php echo base_url();?>/userfair6/ubahbahasa/<?=$bahasa['Num'];?>"
                                    class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a>
                                <a href="<?php echo base_url();?>/userfair6/hapusbahasa/<?=$bahasa['Num'];?>"
                                    onclick="return confirm('Apakah anda yakin akan menghapus data bahasa?')"
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