<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Tambah Penguji</h3>
        </div>
        <!-- /.card-header -->

        <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?= $validation->listErrors()?></div>
        <?php endif;?>

        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url();?>/mantugasakhir/tambahujiproses" method="post"
                enctype="multipart/form-data">
                <input type="hidden" id="user_id" name="user_id" value="<?= $user_id;?>">
                <input type="hidden" id="ta_id" name="ta_id" value="<?= $ta_id;?>">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Penguji</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="penguji" class="element">Nama Penguji <span class="required">
                                    *</span>&nbsp;
                            </label>
                            <div class="element">
                                <select id="penguji" name="penguji" class="form-control">
                                    <?php
                                    foreach ($data_user as $penguji):
                                    ?>
                                    <option value="<?= $penguji['user_id'];?>"><?= $penguji['FullName'];?></option>
                                    <?php 
                                    endforeach 
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Field bertanda * harus diisi.</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                            Penguji</button>
                    </div>
                    <div class="col">
                        <button type="submit" name="submit" value="batal"
                            class="btn btn-block btn-danger col">Batal</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.content-wrapper -->
    </div>
</div>

<?= $this->endSection();?>