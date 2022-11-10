<?= $this->extend('register/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Ubah Password</h3>
        </div>
        <!-- /.card-header -->

        <?php if(session()->getFlashdata('msg')):?>
        <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>

        <?php if(session()->getFlashdata('msg1')):?>
        <div class="alert alert-success"><?= session()->getFlashdata('msg1') ?></div>
        <?php endif;?>

        <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?= $validation->listErrors()?></div>
        <?php endif;?>

        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url();?>/register/ubahpassproses" method="post">
                <div class="form-group">
                    <label for="oldpass" class="element">Password Lama<span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input id="oldpass" name="oldpass" type="password" class="form-control"
                            placeholder="Password Lama..." />
                    </div>
                </div>
                <div class="form-group">
                    <label for="newpass" class="element">Password <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input id="newpass" name="newpass" type="password" class="form-control"
                            placeholder="Password..." />
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirmpass" class="element">Konfirmasi Password <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="confirmpass" name="confirmpass" type="password" class="form-control"
                            placeholder="Ketik ulang password..." />
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-default col">Ubah
                            Password</button>
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