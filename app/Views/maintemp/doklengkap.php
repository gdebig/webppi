<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Profile Anggota ICHI</h3>
        </div>
        <!-- data profile -->
        <?php
        if(isset($info_profile)&&($info_profile=="Data kosong")){
        ?>
        <div class="alert alert-danger">Data profile belum ada.</div>
        <?php }else{ ?>
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Data Umum</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <td width="30%">Nama Lengkap</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $FullName;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Tempat & Tanggal Lahir</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $BirthPlace.", ".format_indo($BirthDate);?></td>
                    </tr>
                    <tr>
                        <td width="30%">Badan Kejuruan</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?php
                            switch($Vocational){
                                case 'Ars':
                                    echo "Arsitektur";
                                    break;
                                case 'Ele':
                                    echo "Teknik Elektro";
                                    break;
                                case 'Wil':
                                    echo "Teknik Kewilayahan dan Perkotaan";
                                    break;
                                case 'Ind':
                                    echo "Teknik Industri";
                                    break;
                                case 'Kim':
                                    echo "Teknik Kimia";
                                    break;
                                case 'Mes':
                                    echo "Teknik Mesin";
                                    break;
                                case 'Lin':
                                    echo "Teknik Lingkungan";
                                    break;
                                case 'Sip':
                                    echo "Teknik Sipil";
                                    break;
                                case 'Mat':
                                    echo "Teknik Material";
                                    break;
                                case 'Met':
                                    echo "Teknik Metalurgi";
                                    break;
                                case 'Inf':
                                    echo "Teknik Informatika";
                                    break;
                                case 'Kap':
                                    echo "Teknik Perkapalan";
                                    break;
                                case 'Tra':
                                    echo "Transportasi";
                                    break;
                                case "Kom":
                                    echo "Teknik Komputer";
                                    break;
                                case "Bio":
                                    echo "Teknik Biomedik";
                                    break;
                            }
                        ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Alamat Rumah</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $HAddr;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Kota Alamat Rumah</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $HCity;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Kode Pos Alamat Rumah</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $HPostnum;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Telepon Rumah</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $Hnum;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Nomor Mobile</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $Hpnum;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Nomor Faks Rumah</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $Hfaks;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Nomor Telex Rumah</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $Htelex;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Email Pribadi</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $Hemail;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Photo</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?php
                        if (!empty($Photo)){
                            echo "<img src='".base_url('uploads/profilpic/'.$Photo)."' width='30%' height='30%' />";
                        }else{
                            echo "";
                        }
                         ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Bersedia Pindah Regular?</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $pindahregular;?></td>
                    </tr>
                    <tr>
                        <td width="30%">SIP</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?php 
                        if (empty($SIP)){
                            echo "Belum ada";
                        }else{
                            echo "<a href='".base_url('uploads/docs/'.$SIP)."' target='_blank'>".$SIP."</a>";
                        }
                        ?></td>
                    </tr>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Informasi organisasi</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <td width="30%">Tempat Kerja</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $Work;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Posisi/Jabatan</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $Position;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Alamat Kantor</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $WAddr;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Kota Alamat Kantor</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $WCity;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Kode Pos Alamat Kantor</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $Wpostnum;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Nomor Telepon Kantor</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $Wnum;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Faks Kantor</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $Wfaks;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Telex Kantor</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $Wtelex;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Email Kantor 1</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $Wemail1;?></td>
                    </tr>
                    <tr>
                        <td width="30%">Email Kantor 2</td>
                        <td width="5%" style="text-align:center">:</td>
                        <td width="65%"><?= $Wemail2;?></td>
                    </tr>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <?php
        }
        ?>
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-pendidikan-tab" data-toggle="pill"
                                    href="#custom-tabs-one-pendidikan" role="tab"
                                    aria-controls="custom-tabs-one-pendidikan" aria-selected="true">Pendidikan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-pengkerja-tab" data-toggle="pill"
                                    href="#custom-tabs-one-pengkerja" role="tab"
                                    aria-controls="custom-tabs-one-pengkerja" aria-selected="true">Pengalaman Kerja</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-organisasi-tab" data-toggle="pill"
                                    href="#custom-tabs-one-organisasi" role="tab"
                                    aria-controls="custom-tabs-one-organisasi" aria-selected="false">Organisasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-pelatihan-tab" data-toggle="pill"
                                    href="#custom-tabs-one-pelatihan" role="tab"
                                    aria-controls="custom-tabs-one-pelatihan" aria-selected="false">Pelatihan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-sertifikat-tab" data-toggle="pill"
                                    href="#custom-tabs-one-sertifikat" role="tab"
                                    aria-controls="custom-tabs-one-sertifikat" aria-selected="false">Sertifikat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-kartul-tab" data-toggle="pill"
                                    href="#custom-tabs-one-kartul" role="tab" aria-controls="custom-tabs-one-kartul"
                                    aria-selected="false">Karya Tulis</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-seminar-tab" data-toggle="pill"
                                    href="#custom-tabs-one-seminar" role="tab" aria-controls="custom-tabs-one-seminar"
                                    aria-selected="false">Seminar</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-pendidikan" role="tabpanel"
                                aria-labelledby="custom-tabs-one-pendidikan-tab">

                                <?php if(isset($data_pend)&&($data_pend=="kosong")){
                    ?>

                                <div class="alert alert-danger">Data pendidikan belum ada.</div>
                                <?php }else{ ?>

                                <table id="tabledata6" class="display6 table table-bordered table-hover">
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
                                            <th>Aksi</th>
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
                                            <td style="text-align: center"><a
                                                    href="<?php echo base_url();?>/register/ubahpendidikan/<?=$pend['Num'];?>"
                                                    class="btn btn-warning"> <i class="fas fa-file-signature"></i>
                                                    Ubah</a>
                                                <a href="<?php echo base_url();?>/register/hapuspendidikan/<?=$pend['Num'];?>"
                                                    onclick="return confirm('Apakah anda yakin akan menghapus data pendidikan?')"
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
                            <div class="tab-pane fade" id="custom-tabs-one-pengkerja" role="tabpanel"
                                aria-labelledby="custom-tabs-one-pengkerja-tab">

                                <?php if(isset($data_kerja)&&($data_kerja=="kosong")){
                    ?>

                                <div class="alert alert-danger">Data pengalaman kerja belum ada.</div>
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
                                            <th>Bukti Pengalaman Kerja</th>
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
                                            <td><?= $kerja['LocCity'].', '.$kerja['LocProv'].', '.$kerja['LocCountry'];?>
                                            </td>
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
                                        </tr>
                                        <?php 
                            endforeach 
                        ?>
                                    </tbody>
                                </table>
                                <?php } ?>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-organisasi" role="tabpanel"
                                aria-labelledby="custom-tabs-one-organisasi-tab">

                                <?php if(isset($data_org)&&($data_org=="kosong")){
                    ?>

                                <div class="alert alert-danger">Data organisasi belum ada.</div>
                                <?php }else{ ?>

                                <table id="tabledata1" class="display1 table table-bordered table-hover">
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
                                        </tr>
                                        <?php 
                        endforeach 
                        ?>
                                    </tbody>
                                </table>
                                <?php } ?>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-pelatihan" role="tabpanel"
                                aria-labelledby="custom-tabs-one-pelatihan-tab">

                                <?php if(isset($data_latih)&&($data_latih=="kosong")){
                    ?>

                                <div class="alert alert-danger">Data pendidikan/pelatihan teknik/manajemen belum ada.
                                </div>
                                <?php }else{ ?>

                                <table id="tabledata2" class="display2 table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pendidikan/Pelatihan</th>
                                            <th>Penyelenggara</th>
                                            <th>Lokasi</th>
                                            <th>Negara</th>
                                            <th>Bulan/Tahun</th>
                                            <th>Tingkat Materi</th>
                                            <th>Jumlah Jam</th>
                                            <th>Uraian Singkat Materi Pendidikan/Pelatihan, Tingkat Pendidikan/Pelatihan
                                            </th>
                                            <th>Bukti Pendidikan/Pelatihan</th>
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
                                        </tr>
                                        <?php 
                            endforeach 
                        ?>
                                    </tbody>
                                </table>
                                <?php } ?>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-sertifikat" role="tabpanel"
                                aria-labelledby="custom-tabs-one-sertifikat-tab">
                                <?php if(isset($data_latih)&&($data_latih=="kosong")){
                    ?>

                                <div class="alert alert-danger">Data Sertifikat Kompetensi dan Bidang Lainnya (yang
                                    Relevan) yang
                                    Diikuti belum ada.</div>
                                <?php }else{ ?>

                                <table id="tabledata3" class="display3 table table-bordered table-hover">
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
                                            <th>Uraian Singkat Materi Pendidikan/Pelatihan, Tingkat
                                                Pendidikan/Pelatihan, Sertifikat
                                            </th>
                                            <th>Bukti Sertifikat</th>
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
                                        </tr>
                                        <?php 
                            endforeach 
                        ?>
                                    </tbody>
                                </table>
                                <?php } ?>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-kartul" role="tabpanel"
                                aria-labelledby="custom-tabs-one-kartul-tab">
                                <?php if(isset($data_kartul)&&($data_kartul=="kosong")){
                    ?>

                                <div class="alert alert-danger">Data Karya Tulis belum ada.</div>
                                <?php }else{ ?>

                                <table id="tabledata4" class="display4 table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bulan-Tahun</th>
                                            <th>Judul Karya Tulis</th>
                                            <th>Nama Media Publikasi</th>
                                            <th>Lokasi</th>
                                            <th>Media Publikasi Tingkat</th>
                                            <th>Tingkat Kesulitan dan Manfaatnya</th>
                                            <th>Uraian Singkat Materi yang Dipublikasikan</th>
                                            <th>Bukti Karya Tulis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $i=1; 
                                    foreach ($data_kartul as $kartul) : 
                                    ?>
                                        <tr>
                                            <td><?php echo $i;$i++;?></td>
                                            <td><?= $kartul['Month'].' - '.$kartul['Year'];?></td>
                                            <td><?= $kartul['Name'];?></td>
                                            <td><?= $kartul['Media'];?></td>
                                            <td><?= $kartul['LocCity'].", ".$kartul['LocCountry'] ?></td>
                                            <td><?php
                                switch ($kartul['Mediatype']){
                                    case "Lok":
                                        echo "Dimuat di Media Lokal";
                                        break;
                                    case "Nas":
                                        echo "Dimuat di Media Nasional";
                                        break;
                                    case "Int":
                                        echo "Dimuat di Media Internasional";
                                        break;
                                }
                            ?></td>
                                            <td><?php
                                switch ($kartul['Diffbenefit']){
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
                                            <td><?= $kartul['Desc'];?></td>
                                            <td><a href="<?=base_url();?>/uploads/docs/<?=$kartul['File'];?>"
                                                    target="_blank"><?= $kartul['File'];?></a></td>
                                        </tr>
                                        <?php 
                                    endforeach 
                                    ?>
                                    </tbody>
                                </table>
                                <?php } ?>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-one-seminar" role="tabpanel"
                                aria-labelledby="custom-tabs-one-seminar-tab">
                                <?php if(isset($data_sem)&&($data_sem=="kosong")){
                    ?>

                                <div class="alert alert-danger">Data seminar/lokakarya belum ada.</div>
                                <?php }else{ ?>

                                <table id="tabledata5" class="display5 table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Bulan-Tahun</th>
                                            <th>Judul Makalah/Tulisan</th>
                                            <th>Nama Seminar/Lokakarya</th>
                                            <th>Penyelenggara</th>
                                            <th>Lokasi</th>
                                            <th>Seminar/Lokakarya Tingkat</th>
                                            <th>Tingkat Kesulitan dan Manfaat</th>
                                            <th>Uraian Singkat Materi Makalah/Tulisan</th>
                                            <th>Bukti Seminar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                    $i=1; 
                                    foreach ($data_sem as $sem) : 
                                    ?>
                                        <tr>
                                            <td><?php echo $i;$i++;?></td>
                                            <td><?= $sem['Month'].'-'.$sem['Year'];?></td>
                                            <td><?= $sem['PaperName'];?></td>
                                            <td><?= $sem['Name'];?></td>
                                            <td><?= $sem['Organizer'];?></td>
                                            <td><?= $sem['LocCity'].", ".$sem['LocCountry'] ?></td>
                                            <td><?php
                                switch ($sem['Level']){
                                    case "Lok":
                                        echo "Pada Seminar Lokal";
                                        break;
                                    case "Nas":
                                        echo "Pada Seminar Nasional";
                                        break;
                                    case "Int":
                                        echo "Pada Seminar Internasional";
                                        break;
                                }
                            ?></td>
                                            <td><?php
                                switch ($sem['DiffBenefit']){
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
                                            <td><?= $sem['Desc'];?></td>
                                            <td><a href="<?=base_url();?>/uploads/docs/<?=$sem['File'];?>"
                                                    target="_blank"><?= $sem['File'];?></a></td>
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
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection();?>