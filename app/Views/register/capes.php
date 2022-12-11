<?= $this->extend('register/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Login Calon Peserta</h3>
        </div>
        <!-- /.card-header -->

        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <form action="<?php echo base_url(); ?>/register/auth" method="post">
            <div class="card-body" style="width: auto; margin: 30px;">
                <div class="form-group">
                    <label for="username" class="element">Username <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input id="username" name="username" class="form-control" placeholder="Username..." type="text" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="element">Password <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input id="password" name="password" class="form-control" placeholder="Password..." type="password" />
                    </div>
                </div>
                <div>
                    <div>
                        <tr>
                            <td>
                                <button type="submit" name="submit" value="submit" class="btn btn-block btn-default ">Login</button>
                            </td>
                        </tr>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.content-wrapper -->
    </div>
</div>

<?= $this->endSection(); ?>