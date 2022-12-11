<?= $this->extend('register/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Akun Baru</h3>
        </div>
        <!-- /.card-header -->

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/register/buatakunproses" method="post">
                <div class="form-group">
                    <label for="username" class="element">Username <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input id="username" name="username" type="text" class="form-control" placeholder="Username..." />
                    </div>
                </div>
                <div class="form-group">
                    <label for="newpass" class="element">Password <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input id="newpass" name="newpass" type="password" class="form-control" placeholder="Password..." />
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirmpass" class="element">Konfirmasi Password <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="confirmpass" name="confirmpass" type="password" class="form-control" placeholder="Ketik ulang password..." />
                    </div>
                </div>
                <div class="form-group">
                    <label for="nodaftar" class="element">Nomor Pendaftaran <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="nodaftar" name="nodaftar" type="text" class="form-control" placeholder="Nomor Pendaftaran PMB UI..." />
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary btn-default col">Buat
                            Akun</button>
                    </div>
                    <div class="col">
                        <button type="submit" name="submit" value="batal" class="btn btn-block btn-danger col">Batal</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.content-wrapper -->
    </div>
</div>

<?= $this->endSection(); ?>