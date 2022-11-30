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

                <?php if(isset($datanilai)&&($datanilai=="kosong")){
                    ?>

                <div class="alert alert-danger">Belum ada penilaian</div>
                <?php }else{ ?>

                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Dosen</th>
                            <th>Status</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    $i=1; 
                                    foreach ($datanilai as $nilai) : 
                                    ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><?= $nilai['FullName'];?></td>
                            <td><?= $nilai['tipedosen'];?></td>
                            <td><?php
                            $nilai = (0.3*$nilai['penulisan'])+(0.3*$nilai['presentasi'])+(0.4*$nilai['materi']);
                            echo $nilai;
                            ?></td>
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