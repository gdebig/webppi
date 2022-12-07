<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">
                <?php if(isset($data_kerja)&&($data_kerja!="kosong")){?>
                <br />
                <h3>III. KUALIFIKASI PROFESIONAL (W2,W3,W4,P6,P7,P8,P9,P10,P11)</h3>
                <br />
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
                            <th>Nilai P</th>
                            <th>Nilai Q</th>
                            <th>Nilai R</th>
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
                    case 'smpe10':
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
                            <td>
                                <?php
                                    if($kerja['Duration'] == 'smp3'){
                                        $durscore = 1;
                                    }elseif($kerja['Duration'] == 'smp7'){
                                        $durscore = 2;
                                    }elseif($kerja['Duration'] == 'smp10'){
                                        $durscore = 3;
                                    }elseif($kerja['Duration'] == 'lbih10'){
                                        $durscore = 4;
                                    }
                                ?>
                                <select name="nilai_p" id="nilai_p" class="form-control">
                                    <option value="4" <?= $durscore==4 ? 'selected' : '';?>>4</option>
                                    <option value="3" <?= $durscore==3 ? 'selected' : '';?>>3</option>
                                    <option value="2" <?= $durscore==2 ? 'selected' : '';?>>2</option>
                                    <option value="1" <?= $durscore==1 ? 'selected' : '';?>>1</option>
                                </select>
                            </td>
                            <td>
                                <?php
                                    if ($kerja['Jabatan'] == 'anggota'){
                                        $jabscore = 1;
                                    } elseif ($kerja['Jabatan'] == 'supervisor'){
                                        $jabscore = 2;
                                    } elseif ($kerja['Jabatan'] == 'direktur'){
                                        $jabscore = 3;
                                    } elseif ($kerja['Jabatan'] == 'pengarah'){
                                        $jabscore = 4;
                                    }
                                ?>
                                <select name="nilai_q" id="nilai_q" class="form-control">
                                    <option value="4" <?= $jabscore==4 ? 'selected' : '';?>>4</option>
                                    <option value="3" <?= $jabscore==4 ? 'selected' : '';?>>3</option>
                                    <option value="2" <?= $jabscore==4 ? 'selected' : '';?>>2</option>
                                    <option value="1" <?= $jabscore==4 ? 'selected' : '';?>>1</option>
                                </select>
                            </td>
                            <td>
                                <select name="nilai_r" id="nilai_r" class="form-control">
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                </select>
                            </td>
                        </tr>
                        <?php 
            endforeach 
        ?>
                    </tbody>
                </table>
                <?php } ?>
                <br />
                <?php if(isset($data_pend)&&($data_pend!="kosong")){
                    ?>

                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenjang</th>
                            <th>Universitas</th>
                            <th>Fakultas</th>
                            <th>Program Studi</th>
                            <th>Alamat</th>
                            <th>Tahun Lulus</th>
                            <th>Gelar</th>
                            <th>Judul Tugas Akhir</th>
                            <th>Uraian Tugas Akhir</th>
                            <th>Nilai</th>
                            <th>Scan Ijazah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $i=1; 
                                    foreach ($data_pend as $pend) : 
                                    ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><?= $pend['Rank'];?></td>
                            <td><?= $pend['Name'];?></td>
                            <td><?= $pend['Faculty'];?></td>
                            <td><?= $pend['Major'];?></td>
                            <td><?= $pend['City'].", ".$pend['Country'] ?></td>
                            <td><?= $pend['GradYear'];?></td>
                            <td><?= $pend['Degree'];?></td>
                            <td><?= $pend['Title'];?></td>
                            <td><?= $pend['Desc'];?></td>
                            <td><?= $pend['Mark'];?></td>
                            <td><a href="<?=base_url();?>/uploads/docs/<?=$pend['File'];?>"
                                    target="_blank"><?= $pend['File'];?></a></td>
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