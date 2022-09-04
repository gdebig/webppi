<?= $this->extend('maintemp/template');?>

<?php
use App\Models\CapesProfileModel;
use App\Models\CapesPendModel;
use App\Models\CapesKualifikasiModel;
use App\Models\CapesOrgModel;
use App\Models\CapesSertModel;
use App\Models\CapesKartulModel;
use App\Models\CapesSemModel;
?>

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
                    <?php if(session()->getFlashdata('errmsg')):?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('errmsg') ?></div>
                    <?php endif;?>
                </div>

                <?php if(isset($data_user)&&($data_user=="kosong")){
                    
                    ?>

                <div class="alert alert-danger">Data penilai belum ada. <a
                        href="<?= base_url();?>/manpenilai/tambahpenilai">Klik
                        di sini untuk menambah data penilai</a></div>
                <?php }else{ ?>

                <form action="<?php echo base_url();?>/mancapes/prosescapes" method="post"
                    enctype="multipart/form-data">

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="5%">Check</th>
                                <th>Nama Lengkap</th>
                                <th>Badan Kejuruan</th>
                                <th>Bersedia Pindah Reguler?</th>
                                <th>Profile</th>
                                <th>Pendidikan</th>
                                <th>Pengalaman Kerja</th>
                                <th>Organisasi</th>
                                <th>Pelatihan</th>
                                <th>Sertifikat</th>
                                <th>Karya Tulis</th>
                                <th>Seminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                    $i=1; 
                                    foreach ($data_user as $user) : 
                                        
                                        $profile = new CapesProfileModel();
                                        $dataprofile = $profile->where('user_id', $user['user_id'])->first();
                                        $pendidikan = new CapesPendModel();
                                        $datapend = $pendidikan->where('user_id', $user['user_id'])->first();
                                        $pengkerja = new CapesKualifikasiModel();
                                        $datapengkerja = $pengkerja->where('user_id',$user['user_id'])->first();
                                        $organ = new CapesOrgModel();
                                        $dataorgan = $organ->where('user_id', $user['user_id'])->first();
                                        $pelsert = new CapesSertModel();
                                        $datalatih = $pelsert->where('user_id', $user['user_id'])->where('Jenis', 'pelatihan')->first();
                                        $datasert = $pelsert->where('user_id',  $user['user_id'])->where('Jenis', 'sertifikat')->first();
                                        $kartul = new CapesKartulModel();
                                        $datakartul = $kartul->where('user_id',  $user['user_id'])->first();
                                        $sem = new CapesSemModel();
                                        $datasem = $sem->where('user_id', $user['user_id'])->where('Type', 'Sem')->first();

                                        $isprofile = !empty($dataprofile) ? "Ada" : "Tidak";
                                        $ispend = !empty($datapend) ? "Ada" : "Tidak";
                                        $ispengkerja = !empty($datapengkerja) ? "Ada" : "Tidak";
                                        $isorgan = !empty($dataorgan) ? "Ada" : "Tidak";
                                        $islatih = !empty($datalatih) ? "Ada" : "Tidak";
                                        $issert = !empty($datasert) ? "Ada" : "Tidak";
                                        $iskartul = !empty($datakartul) ? "Ada" : "Tidak";
                                        $issem = !empty($datasem) ? "Ada" : "Tidak";
                                    ?>
                            <tr>
                                <td><?php echo $i;$i++;?></td>
                                <td style="text-align:center">
                                    <input type="checkbox" name="user_id[]" value="<?= $user['user_id'];?>" />
                                </td>
                                <td><a
                                        href="<?= base_url();?>/mancapes/doklengkap/<?= $user['user_id'];?>"><?= empty($user['FullName']) ? $user['username']." (Belum isi Profile)" : $user['FullName'];?></a>
                                </td>
                                <td><?php
                                switch($user['Vocational']){
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
                            ?>
                                </td>
                                <td><?= $user['pindahregular'];?></td>
                                <td>
                                    <?php
                                if ($isprofile=="Ada"){
                                ?>
                                    <a
                                        href="<?= base_url();?>/mancapes/profile/<?= $user['user_id'];?>"><?= $isprofile;?></a>
                                    <?php
                                }else{
                                    echo $isprofile;
                                }
                                ?>
                                </td>
                                <td>
                                    <?php
                                if ($ispend=="Ada"){
                                ?>
                                    <a
                                        href="<?= base_url();?>/mancapes/pendidikan/<?= $user['user_id'];?>"><?= $ispend;?></a>
                                    <?php
                                }else{
                                    echo $ispend;
                                }
                                ?>
                                </td>
                                <td>
                                    <?php
                                if ($ispengkerja=="Ada"){
                                ?>
                                    <a
                                        href="<?= base_url();?>/mancapes/kerja/<?= $user['user_id'];?>"><?= $ispengkerja;?></a>
                                    <?php
                                }else{
                                    echo $ispengkerja;
                                }
                                ?>
                                </td>
                                <td>
                                    <?php
                                if ($isorgan=="Ada"){
                                ?>
                                    <a
                                        href="<?= base_url();?>/mancapes/organ/<?= $user['user_id'];?>"><?= $isorgan;?></a>
                                    <?php
                                }else{
                                    echo $isorgan;
                                }
                                ?>
                                </td>
                                <td>
                                    <?php
                                if ($islatih=="Ada"){
                                ?>
                                    <a
                                        href="<?= base_url();?>/mancapes/latih/<?= $user['user_id'];?>"><?= $islatih;?></a>
                                    <?php
                                }else{
                                    echo $islatih;
                                }
                                ?>
                                </td>
                                <td>
                                    <?php
                                if ($issert=="Ada"){
                                ?>
                                    <a href="<?= base_url();?>/mancapes/sert/<?= $user['user_id'];?>"><?= $issert;?></a>
                                    <?php
                                }else{
                                    echo $issert;
                                }
                                ?>
                                </td>
                                <td>
                                    <?php
                                if ($iskartul=="Ada"){
                                ?>
                                    <a
                                        href="<?= base_url();?>/mancapes/kartul/<?= $user['user_id'];?>"><?= $iskartul;?></a>
                                    <?php
                                }else{
                                    echo $iskartul;
                                }
                                ?>
                                </td>
                                <td>
                                    <?php
                                if ($issem=="Ada"){
                                ?>
                                    <a href="<?= base_url();?>/mancapes/sem/<?= $user['user_id'];?>"><?= $issem;?></a>
                                    <?php
                                }else{
                                    echo $issem;
                                }
                                ?>
                                </td>
                            </tr>
                            <?php 
                                    endforeach 
                                    ?>
                        </tbody>
                    </table>
                    <br /><br />
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Ubah status semua user yang dicentang.</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="statusbaru" class="element">Status Baru</label>
                                <div class="element">
                                    <select name="statusbaru" id="statusbaru" class="form-control">
                                        <option value="diterima">Diterima</option>
                                        <option value="ditolak">Ditolak</option>
                                        <option value="regular">Pindah ke Regular</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="ubahstatus" class="btn btn-primary col">Ubah
                                Status</button>
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection();?>