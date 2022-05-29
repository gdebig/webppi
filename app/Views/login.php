<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Program PPI FT UI</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box" style="width:40%">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <p class="h1">Login <b>Program PPI FT UI</b></p>
            </div>

            <div class="cols-md-6 bg-indigo text-center" style="font-size: 1.5em;">
                <p class="login-box-msg">Jika anda adalah CALON PESERTA Program Studi PPI RPL, <b><u><a
                                href="<?php echo base_url();?>/register" class="card-link" style="color: white;">klik
                                link disini.</a></u></b>
                </p>
            </div>
            <br />

            <div class="cols-md-6 bg-warning text-center" style="font-size: 1.5em;padding-top: 20px;">
                <a href="#">
                    <p class="login-box-msg"><i class="fa fa-user"></i> Klik disini untuk menggunakan akun SSO UI.
                    </p>
                </a>
            </div>
            <br />

            <div class="card-body">
                <p class="login-box-msg" style="font-size:1.2em;">Gunakan Form Berikut untuk yang belum memiliki akun
                    SSO
                    UI dan atau sudah
                    diterima
                    sebagai PESERTA PPI FT UI</p>

                <?php if(session()->getFlashdata('msg')):?>
                <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                <?php endif;?>

                <form action="<?= base_url();?>/home/auth" method="post">
                    <div class="input-group mb-3">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">&nbsp;
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                        </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="cols-md-6 bg-info text-center">
            <br />
            <p class="login-box-msg" style="color: white;font-size:1.25em;"><a href="#"
                    style="color: white;font-size:1.25em;"><b><u>Panduan dapat dilihat di
                            link ini.</a></u></b>
            </p>
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url();?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>/assets/dist/js/adminlte.min.js"></script>
</body>

</html>