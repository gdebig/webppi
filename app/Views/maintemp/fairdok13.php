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
                        <a href="<?php echo base_url();?>/userfair13/tambahorganisasi" class="btn btn-primary">Tambah
                            Data Organisasi</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if(isset($data_org)&&($data_org=="kosong")){
                    ?>

                <div class="alert alert-danger">Data organisasi belum ada. <a
                        href="<?= base_url();?>/userfair13/tambahorganisasi">Klik
                        di sini untuk menambah data organisasi</a></div>
                <?php }else{ ?>

                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Organisasi</th>
                            <th>Jenis Organisasi</th>
                            <th>Kota</th>
                            <th>Negara</th>
                            <th>Perioda</th>
                            <th>Sudah Berapa Lama Menjadi Anggota</th>
                            <th>Jabatan Dalam Organisasi</th>
                            <th>Tingkatan Organisasi</th>
                            <th>Lingkup Kegiatan Organisasi</th>
                            <th>Aktifitas Dalam Organisasi</th>
                            <th>Bukti Menjadi Pengurus</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $i=1; 
                                   foreach ($data_org as $org) : 
                                    ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><?= $org['Name'];?></td>
                            <td><?php
                                switch ($org['Type']){
                                    case "PII":
                                        echo "Organisasi PII";
                                        break;
                                    case "Ins":
                                        echo "Organisasi Keinsinyuran Non PII";
                                        break;
                                    case "Non":
                                        echo "Organisasi Non Keinsinyuran";
                                        break;
                                }
                            ?></td>
                            <td><?= $org['City'];?></td>
                            <td><?= $org['Country'];?></td>
                            <td><?= $org['StartPeriodBulan']." ".$org['StartPeriodYear']." hingga ".$org['EndPeriodBulan']." ".$org['EndPeriodYear'];?>
                            </td>
                            <td><?php
                                switch ($org['Period']){
                                    case "sd5":
                                        echo "1 - 5 tahun";
                                        break;
                                    case "smp10":
                                        echo "6 - 10 tahun";
                                        break;
                                    case "smp15":
                                        echo "11 - 15 tahun";
                                        break;
                                    case "lbih15":
                                        echo "Lebih dari 15 tahun";
                                        break;
                                }
                            ?></td>
                            <td><?php
                                switch ($org['Position']){
                                    case "Bias":
                                        echo "Anggota Biasa";
                                        break;
                                    case "Peng":
                                        echo "Anggota Pengurus";
                                        break;
                                    case "Pimp":
                                        echo "Pimpinan";
                                        break;
                                }
                            ?></td>
                            <td><?php
                                switch ($org['OrgLevel']){
                                    case "Lok":
                                        echo "Organisasi Lokal (Bukan Nasional)";
                                        break;
                                    case "Nas":
                                        echo "Organisasi Nasional";
                                        break;
                                    case "Reg":
                                        echo "Organisasi Regional";
                                        break;
                                    case "Int":
                                        echo "Organisasi Internasional";
                                        break;
                                }
                            ?></td>
                            <td><?php
                                switch ($org['OrgScp']){
                                    case "Aso":
                                        echo "Asosiasi Profesi";
                                        break;
                                    case "Pem":
                                        echo "Lembaga Pemerintahan";
                                        break;
                                    case "Pen":
                                        echo "Lembaga Pendidikan";
                                        break;
                                    case "Neg":
                                        echo "Badan Usaha Milik Negara";
                                        break;
                                    case "Swa":
                                        echo "Badan Usaha Milik Swasta";
                                        break;
                                    case "Mas":
                                        echo "Organisasi Kemasyarakatan";
                                        break;
                                    case "Lai":
                                        echo "Lain-lain";
                                        break;
                                }
                            ?></td>
                            <td><?= $org['Desc'];?></td>
                            <td><a href="<?=base_url();?>/uploads/docs/<?=$org['File'];?>"
                                    target="_blank"><?= $org['File'];?></a></td>
                            <td style="text-align: center"><a
                                    href="<?php echo base_url();?>/userfair13/ubahorg/<?=$org['Num'];?>"
                                    class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a>
                                <a href="<?php echo base_url();?>/userfair13/hapusorg/<?=$org['Num'];?>"
                                    onclick="return confirm('Apakah anda yakin akan menghapus data organisasi?')"
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