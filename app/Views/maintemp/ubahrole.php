<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<?php
$session = session();
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div>

                    <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif;?>
                    <!-- /.card -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Peran Anda</h3>
                        </div>
                        <!-- /.card-header -->
                        <ul>
                            <?php
                            if ($session->get('issadmin')){
                            ?>
                            <li><a href="<?php echo base_url();?>/superadmin">Super Admin</a></li>
                            <?php
                            }
                            if ($session->get('isadmin')){
                            ?>
                            <li><a href="<?php echo base_url();?>/admin">Admin</a></li>
                            <?php
                            }
                            if ($session->get('ispenilai')){
                            ?>
                            <li><a href="<?php echo base_url();?>/penilai">Penilai</a></li>
                            <?php
                            }
                            if ($session->get('ispeserta')){
                            ?>
                            <li><a href="<?php echo base_url();?>/peserta">Peserta</a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>

<?= $this->endSection();?>