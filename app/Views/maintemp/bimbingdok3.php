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

                <?php if(isset($data_kerja)&&($data_kerja=="kosong")){
    ?>

                <div class="alert alert-danger">Data kualifikasi profesional belum ada.</div>
                <?php }else{ ?>

                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Periode</th>
                            <th>Nama Instansi/Perusahaan</th>
                            <th>Jabatan/tugas</th>
                            <th>Nama Aktifitas/Kegiatan/Proyek</th>
                            <th>Pemberi Tugas</th>
                            <th>Lokasi</th>
                            <th>Durasi</th>
                            <th>Posisi Tugas, Jabatan</th>
                            <th>Nilai Proyek</th>
                            <th>Nilai Tanggung Jawab</th>
                            <th>SDM yang terlibat</th>
                            <th>Tingkat Kesulitan</th>
                            <th>Skala Proyek</th>
                            <th>Uraian Singkat Tugas dan Tanggung Jawab Prof sesuai NSPK</th>
                            <th>Bukti kualifikasi profesional</th>
                            <th>Klaim Kompetensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $i=1; 
                   foreach ($data_kerja as $kerja) : 
                    ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><?php
                if (!empty($kerja['EndDate'])&&($kerja['EndDate']!='0000-00-00')){
                    echo format_indo($kerja['StartDate'])." hingga ".format_indo($kerja['EndDate']);
                }else{
                    echo format_indo($kerja['StartDate'])." hingga sekarang.";
                }
            ?></td>
                            <td><?= $kerja['NameInstance'];?></td>
                            <td><?= $kerja['Position'];?></td>
                            <td><?= $kerja['Name'];?></td>
                            <td><?= $kerja['Giver']; ?></td>
                            <td><?= $kerja['LocCity'].', '.$kerja['LocProv'].', '.$kerja['LocCountry'];?></td>
                            <td><?php
                switch ($kerja['Duration']){
                    case 'smp3':
                        echo "1 - 3 tahun";
                        break;
                    case 'smp7':
                        echo "4 - 7 tahun";
                        break;
                    case 'smp10':
                        echo "8 - 10 tahun";
                        break;
                    case 'lbh10':
                        echo "> dari 10 tahun";
                        break;
                }
            ?></td>
                            <td><?php
                switch ($kerja['Jabatan']){
                    case 'anggota':
                        echo "Anggota / Staff / Dosen";
                        break;
                    case 'supervisor':
                        echo "Supervisor / Site Engineer / Site Manager / KaLab / Sekretaris Jurusan / Ketua Jurusan / PD";
                        break;
                    case 'direktur':
                        echo "Direktur / Ketua Tim / Dekan / PR / Rektor";
                        break;
                    case 'pengarah':
                        echo "Pengarah / Adviser / Narasumber Ahli";
                        break;
                }
            ?></td>
                            <td><?= $kerja['ProjValue'];?></td>
                            <td><?= $kerja['RspnValue'];?></td>
                            <td><?php
                switch ($kerja['Hresource']){
                    case 'dik':
                        echo "Sedikit";
                        break;
                    case 'sed':
                        echo "Sedang";
                        break;
                    case 'bny':
                        echo "Banyak";
                        break;
                    case 'sbny':
                        echo "Sangat Banyak";
                        break;
                }
            ?></td>
                            <td><?php
                switch ($kerja['Diff']){
                    case 'ren':
                        echo "Rendah";
                        break;
                    case 'sed':
                        echo "Sedang";
                        break;
                    case 'tin':
                        echo "Tinggi";
                        break;
                    case 'stin':
                        echo "Sangat Tinggi";
                        break;
                }
            ?></td>
                            <td><?php
                switch ($kerja['Scale']){
                    case 'ren':
                        echo "Rendah";
                        break;
                    case 'sed':
                        echo "Sedang";
                        break;
                    case 'tin':
                        echo "Tinggi";
                        break;
                    case 'stin':
                        echo "Sangat Tinggi";
                        break;
                }
            ?></td>
                            <td><?= $kerja['Desc'];?></td>
                            <td><?php
            if (!empty($kerja['File'])){
                echo "<a href='".base_url('uploads/docs/'.$kerja['File'])."' target='_blank'>".$kerja['File']."</a>";
            }else{
                echo "";
            }
            ?></td>
                            <td><?= $kerja['kompetensi'];?></td>
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