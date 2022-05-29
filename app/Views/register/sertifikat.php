<?= $this->extend('register/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Sertifikat Kompetensi dan Bidang Lainnya (yang Relevan) yang Diikuti</h3>
        </div>
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">

                <?php if(session()->getFlashdata('msg')):?>
                <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                <?php endif;?>

                <div class="col">
                    <div class="row">
                        <a href="<?php echo base_url();?>/register/tambahsert" class="btn btn-primary">Tambah
                            Data Sertifikat</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if(isset($data_latih)&&($data_latih=="kosong")){
                    ?>

                <div class="alert alert-danger">Data Sertifikat Kompetensi dan Bidang Lainnya (yang Relevan) yang
                    Diikuti belum ada. <a href="<?= base_url();?>/register/tambahsert">Klik
                        di sini untuk menambah data Sertifikat Kompetensi dan Bidang Lainnya (yang Relevan) yang
                        Diikuti.</a></div>
                <?php }else{ ?>

                <table id="tabledata" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sertifikat</th>
                            <th>Penyelenggara</th>
                            <th>Lokasi</th>
                            <th>Negara</th>
                            <th>Bulan/Tahun</th>
                            <th>Tingkat Materi</th>
                            <th>Jumlah Jam</th>
                            <th>Uraian Singkat Materi Pendidikan/Pelatihan, Tingkat Pendidikan/Pelatihan, Sertifikat
                            </th>
                            <th>Bukti Sertifikat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $i=1; 
                                   foreach ($data_latih as $latih) : 
                                    ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><?= $latih['Name'];?></td>
                            <td><?= $latih['Organizer'];?></td>
                            <td><?= $latih['Kota'];?></td>
                            <td><?= $latih['Country']; ?></td>
                            <td><?= $latih['StartMonth'].'/'.$latih['StartYear'];?></td>
                            <td><?php
                                switch ($latih['Level']){
                                    case 'Dasar':
                                        echo "Tingkat Dasar (Fundamental)";
                                        break;
                                    case 'Lanjut':
                                        echo "Tingkat Lanjut (Advanced)";
                                        break;
                                }
                            ?></td>
                            <td><?php
                                switch ($latih['Length']){
                                    case 'sd36':
                                        echo "Lama pendidikan s/d 36 Jam";
                                        break;
                                    case 'smp100':
                                        echo "Lama pendidikan 36 - 100 Jam";
                                        break;
                                    case 'smp240':
                                        echo "Lama pendidikan 100 - 240 Jam";
                                        break;
                                    case 'lbih240':
                                        echo "Lebih dari 240 Jam
                                        
                                        ";
                                        break;
                                }
                            ?></td>
                            <td><?= $latih['Description'];?></td>
                            <td><?php
                            if (!empty($latih['File'])){
                                echo "<a href='".base_url('uploads/docs/'.$latih['File'])."' target='_blank'>".$latih['File']."</a>";
                            }else{
                                echo "";
                            }
                            ?></td>
                            <td style="text-align: center"><a
                                    href="<?php echo base_url();?>/register/ubahsert/<?=$latih['Num'];?>"
                                    class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a>
                                <a href="<?php echo base_url();?>/register/hapussert/<?=$latih['Num'];?>"
                                    onclick="return confirm('Apakah anda yakin akan menghapus data Sertifikat?')"
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