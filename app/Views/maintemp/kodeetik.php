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

                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. Telepon</th>
                            <th>Email</th>
                            <th>Hubungan</th>
                            <th>Nilai P</th>
                            <th>Nilai Q</th>
                            <th>Nilai R</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1; 
                        foreach ($data_etik as $etik) : 
                        ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><?= $etik['Name'];?></td>
                            <td><?= $etik['Addr']."<br />".$etik['City'].', '.$etik['Prov'].', '.$etik['Country'];?>
                            </td>
                            <td><?= $etik['Pnum'];?></td>
                            <td><?= $etik['Email'];?></td>
                            <td><?= $etik['Relation'];?></td>
                            <td style="text-align: center">
                                <select name="nilaip" id="nilaip">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                            <td style="text-align: center">
                                <select name="nilaiq" id="nilaiq">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                            <td style="text-align: center">
                                <select name="nilair" id="nilair">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
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