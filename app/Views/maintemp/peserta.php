<?= $this->extend('maintemp/template');?>

<?php
use App\Models\ProfileModel;
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
                </div>

                <?php 
                if(isset($data_user)&&($data_user=="kosong")){                    
                ?>

                <div class="alert alert-danger">Data peserta belum ada.</div>
                <?php }else{ ?>

                <form action="<?php echo base_url();?>/manpeserta/prosesdosbing" method="post"
                    enctype="multipart/form-data">

                    <table id="tabledata" class="display table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="5%">Check</th>
                                <th>Nama Lengkap</th>
                                <th>Badan Kejuruan</th>
                                <th>Status</th>
                                <th>Dosen Pembimbing</th>
                                <th>Data FAIP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1; 
                            foreach ($data_user as $user) :
                            ?>
                            <tr>
                                <td><?php echo $i;$i++;?></td>
                                <td style="text-align:center">
                                    <input type="checkbox" name="user_id[]" value="<?= $user['user_id'];?>"
                                        class="form-check-input" />
                                </td>
                                <td><a
                                        href="<?= base_url();?>/manpeserta/doklengkap/<?= $user['user_id'];?>"><?= $user['FullName'];?></a>
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
                                <td><?= ucfirst($user['status']);?></td>
                                <td><?php
                                if (!empty($user['dosen_id'])){
                                    $model = new ProfileModel();
                                    $dosen = $model->where('user_id', $user['dosen_id'])->first();
                                    echo $dosen['FullName'];
                                }else{
                                    echo "Belum ada pembimbing";
                                }
                                ?></td>
                                <td><a href="<?= base_url();?>/manpeserta/dokfaip/<?= $user['user_id'];?>">Detail</a>
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
                            <h3 class="card-title">Atur dosen pembimbing</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="dosbing" class="element">Nama Dosen Pembimbing</label>
                                <div class="element">
                                    <select name="dosbing" id="dosbing" class="form-control">
                                        <?php
                                        foreach ($data_dosbing as $dosbing) :
                                        ?>
                                        <option value="<?= $dosbing['user_id'];?>"><?= $dosbing['FullName'];?></option>
                                        <?php
                                        endforeach
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="set" class="btn btn-primary col">Atur
                                Pembimbing</button>
                        </div>
                        <div class="col">
                            <button type="submit" name="submit" value="ganti"
                                class="btn btn-block btn-warning col">Ganti Pembimbing</button>
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