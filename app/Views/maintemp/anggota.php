<?= $this->extend('maintemp/template');?>

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

                <div class="col">
                    <div class="row">
                        <a href="<?php echo base_url();?>/manuser/tambahanggota" class="btn btn-primary">Tambah
                            Anggota</a>
                    </div>
                </div>

                <div class="col">
                    <div class="row">
                        &nbsp;
                    </div>
                </div>

                <?php if(isset($data_user)&&($data_user=="kosong")){
                    ?>

                <div class="alert alert-danger">Data Anggota belum ada. <a
                        href="<?= base_url();?>/manuser/tambahanggota">Klik
                        di sini untuk menambah data anggota</a></div>
                <?php }else{ ?>

                <table id="tabledata" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Opsi</th>
                            <th>Username</th>
                            <th>No Daftar</th>
                            <th>NPM</th>
                            <th>NIP</th>
                            <th>Status Peserta</th>
                            <th>Status Keaktifan</th>
                            <th>Tahun Terdaftar</th>
                            <th>Tipe User</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $i=1; 
                                    foreach ($data_user as $user) : 
                                    ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td>&nbsp;</td>
                            <td><?= $user['username'];?></td>
                            <td><?= $user['nodaftar'];?></td>
                            <td><?= $user['NPM'];?></td>
                            <td><?= $user['NIP'];?></td>
                            <td><?php
                                switch ($user['status']){
                                    case 'baru':
                                        echo "Calon Peserta";
                                        break;
                                    case 'diterima':
                                        echo "Peserta";
                                        break;
                                    case "ditolak":
                                        echo "Registrasi ditolak";
                                        break;
                                    case "lulus":
                                        echo "Sudah Lulus.";
                                        break;
                                    case "keluar":
                                        echo "Sudah Keluar (DO)";
                                        break;
                                    case "staff":
                                        echo "Staff PPI FT UI";
                                        break;
                                }
                            ?></td>
                            <td><?php
                                switch ($user['active']){
                                    case 'yes':
                                        echo "Aktif";
                                        break;
                                    case 'no':
                                        echo "Tidak Aktif";
                                        break;
                                }
                            ?></td>
                            <td><?= $user['thnajaran']." / ".$user['semester'];?></td>
                            <td>
                                <ul>
                                    <?php
                            echo $user['tipe_user'][0] == "y" ? "<li>Super Admin</li>" : "";
                            echo $user['tipe_user'][1] == "y" ? "<li>Admin </li>" : "";
                            echo $user['tipe_user'][2] == "y" ? "<li>Penilai </li>" : "";
                            echo $user['tipe_user'][3] == "y" ? "<li>Peserta </li>" : "";
                            ?>
                                </uL>
                            </td>
                            <td style="text-align: center"><a
                                    href="<?php echo base_url();?>/manuser/ubahanggota/<?=$user['user_id'];?>"
                                    class="btn btn-warning"> <i class="fas fa-file-signature"></i> Ubah</a>
                                <a href="<?php echo base_url();?>/manuser/hapusanggota/<?=$user['user_id'];?>"
                                    onclick="return confirm('Apakah anda yakin akan menghapus data anggota?')"
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