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

                <h3>II.1. Referensi Kode Etik dan Etika Profesi (#) (W1)</h3>
                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Check</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No. Telepon</th>
                            <th>Email</th>
                            <th>Hubungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1; 
                        foreach ($data_etik as $etik) : 
                        ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><input type="checkbox" name="etik_id[]" value="<?= $etik['Num'];?>" /></td>
                            <td><?= $etik['Name'];?></td>
                            <td><?= $etik['Addr']."<br />".$etik['City'].', '.$etik['Prov'].', '.$etik['Country'];?>
                            </td>
                            <td><?= $etik['Pnum'];?></td>
                            <td><?= $etik['Email'];?></td>
                            <td><?= $etik['Relation'];?></td>
                        </tr>
                        <?php 
                        endforeach 
                        ?>
                    </tbody>
                </table>
                <?php } ?>
                <br />
                <?php if(isset($data_pendapat)&&($data_pendapat=="kosong")){
                    ?>

                <div class="alert alert-danger">Data kode etik belum ada.</div>
                <?php }else{ ?>

                <h3>II.2. Pengertian, Pendapat dan Pengalaman Sendiri (W1)</h3>
                <table id="tabledata" class="display table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Check</th>
                            <th>Pendapat</th>
                            <th>Nilai P</th>
                            <th>Nilai Q</th>
                            <th>Nilai R</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i=1; 
                        foreach ($data_pendapat as $dapat) : 
                        ?>
                        <tr>
                            <td><?php echo $i;$i++;?></td>
                            <td><input type="checkbox" name="dapat_id[]" value="<?= $dapat['Num'];?>" /></td>
                            <td><?= $dapat['Desc'];?></td>
                            <td>
                                <select name="nilai_p" id="nilai_p" class="form-control">
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                </select>
                            </td>
                            <td>
                                <select name="nilai_q" id="nilai_q" class="form-control">
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
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
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection();?>