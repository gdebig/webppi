<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <a href="<?= base_url();?>/bimbingfair/docs/<?= $user_id;?>">Kembali ke daftar dokumen FAIR</a>
        </div>
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">

                <?php if(session()->getFlashdata('msg')):?>
                <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                <?php endif;?>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if(isset($data_inov)&&($data_inov=="kosong")){
                    ?>

                <div class="alert alert-danger">Data temuan/inovasi/paten belum ada.</div>
                <?php }else{ ?>

                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bulan-Tahun</th>
                            <th>Judul/Nama Karya Temuan/Inovasi/Paten dan Implementasi Teknologi Baru</th>
                            <th>Uraian Singkat</th>
                            <th>Media Publikasi (Kalau Ada)</th>
                            <th>Media Publikasi Tingkat</th>
                            <th>Tingkat Kesulitan dan Manfaatnya Karya Temuan/Inovasi/Paten dan Implementasi Teknologi
                                Baru</th>
                            <th>Bukti Dokumen</th>
                            <th>Klaim Kompetensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $i=1; 
                                    foreach ($data_inov as $inov) : 
                                    ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><?php
                            switch ($inov['Month']){
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
                            echo $bulan.'-'.$inov['Year'];?></td>
                            <td><?= $inov['Name'];?></td>
                            <td><?= $inov['Desc'];?></td>
                            <td><?= $inov['Publication']; ?></td>
                            <td><?php
                                switch ($inov['PubLevel']){
                                    case "Lok":
                                        echo "Dipublikasikan di Media Lokal";
                                        break;
                                    case "Nas":
                                        echo "Dipublikasikan di Media Nasional";
                                        break;
                                    case "Int":
                                        echo "Dipublikasikan di Media Internasional";
                                        break;
                                }
                            ?></td>
                            <td><?php
                                switch ($inov['DiffBenefit']){
                                    case "ren":
                                        echo "Rendah";
                                        break;
                                    case "sed":
                                        echo "Sedang";
                                        break;
                                    case "tin":
                                        echo "Tinggi";
                                        break;
                                    case "stin":
                                        echo "Sangat Tinggi";
                                        break;
                                }
                            ?></td>
                            <td><a href="<?=base_url();?>/uploads/docs/<?=$inov['File'];?>"
                                    target="_blank"><?= $inov['File'];?></a></td>
                            <td><?= $inov['kompetensi'];?></td>
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