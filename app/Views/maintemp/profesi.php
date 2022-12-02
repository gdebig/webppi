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
                        &nbsp;
                    </div>
                </div>

                <?php if(isset($data_etik)&&($data_etik=="kosong")){
                    ?>

                <div class="alert alert-danger">Data kode etik belum ada.</div>
                <?php }else{ ?>

                <h3>I.2. Pendidikan Formal (W2)</h3>
                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Check</th>
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
                            <td><input type="checkbox" name="pend_id[]" value="<?= $pend['Num'];?>" /></td>
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
                        </tr>
                        <?php 
                                    endforeach 
                                    ?>
                    </tbody>
                </table>
                <?php } ?>
                <br />
                <h3>I.3. Organisasi Profesi & Organisasi Lainnya Yang Dimasuki (W1)</h3>
                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Check</th>
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
                            <th>Klaim Kompetensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $i=1; 
                                   foreach ($data_org as $org) : 
                                    ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><input type="checkbox" name="pend_id[]" value="<?= $pend['Num'];?>" /></td>
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
                            <td><?= $org['kompetensi'];?></td>
                        </tr>
                        <?php 
                        endforeach 
                        ?>
                    </tbody>
                </table>
                <br />
                <h3>I.4. Tanda Penghargaan Yang Diterima (W1)</h3>
                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Check</th>
                            <th>Tahun</th>
                            <th>Nama Tanda Penghargaan</th>
                            <th>Nama Lembaga yang Memberikan</th>
                            <th>Lokasi</th>
                            <th>Negara</th>
                            <th>Penghargaan yang diterima tingkat</th>
                            <th>Penghargaan diberikan oleh lembaga</th>
                            <th>Uraian Singkat Tanda Penghargaan</th>
                            <th>Klaim Kompetensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $i=1; 
                                   foreach ($data_harga as $penghargaan) : 
                                    ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><input type="checkbox" name="pend_id[]" value="<?= $pend['Num'];?>" /></td>
                            <td><?php
                            switch ($penghargaan['Month']){
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
                            echo $bulan.' - '.$penghargaan['Year'];
                            ?></td>
                            <td><?= $penghargaan['Name'];?></td>
                            <td><?= $penghargaan['Institute'];?></td>
                            <td><?= $penghargaan['City'].', '.$penghargaan['Prov'];?></td>
                            <td><?= $penghargaan['Country'];?></td>
                            <td>
                                <?php
                                switch ($penghargaan['Level']){
                                    case 'Mud':
                                        echo "Tingkatan Muda/Pemula";
                                        break;
                                    case 'Mad':
                                        echo "Tingkatan Madya";
                                        break;
                                    case 'Uta':
                                        echo "Tingkatan Utama";
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                switch ($penghargaan['InstituteType']){
                                    case 'Lok':
                                        echo "Penghargaan Lokal";
                                        break;
                                    case 'Nas':
                                        echo "Penghargaan Nasional";
                                        break;
                                    case 'Reg':
                                        echo "Penghargaan Regional";
                                        break;
                                    case 'Int':
                                        echo "Penghargaan Internasional";
                                        break;
                                }
                                ?>
                            </td>
                            <td><?= $penghargaan['Desc'];?></td>
                            <td><?= $penghargaan['kompetensi'];?></td>
                        </tr>
                        <?php 
                        endforeach 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection();?>