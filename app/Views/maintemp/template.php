<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title_page?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/dist/css/adminlte.min.css">
    <!-- Date Range Picker CSS -->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/plugins/daterangepicker/daterangepicker.css">

    <!-- DataTables -->
    <link rel="stylesheet"
        href="<?php echo base_url();?>/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url();?>/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url();?>/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<?php
$session = session();
?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <?php
                if ($session->get('role')=="superadmin"){
                ?>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url();?>/superadmin" class="nav-link">Beranda</a>
                </li>
                <?php
                } elseif ($session->get('role')=="admin"){
                ?>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url();?>/admin" class="nav-link">Beranda</a>
                </li>
                <?php
                } elseif ($session->get('role')=="penilai"){
                ?>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url();?>/penilai" class="nav-link">Beranda</a>
                </li>
                <?php
                } elseif ($session->get('role')=="peserta"){
                ?>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url();?>/peserta" class="nav-link">Beranda</a>
                </li>
                <?php
                }
                ?>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url();?>/home/ubahrole" class="nav-link">Ubah Peran</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url();?>/home/petunjuk" class="nav-link">Petunjuk Penggunaan</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <?php
                if ($session->get('role')=="superadmin"){
            ?>
            <a href="<?php echo base_url();?>/superadmin" class="brand-link">
                <span class="brand-text font-weight-light">fair.eng.ui.ac.id<br />Dashboard Super Admin</span>
            </a>
            <?php
                } elseif ($session->get('role')=="admin"){
            ?>
            <a href="<?php echo base_url();?>/admin" class="brand-link">
                <span class="brand-text font-weight-light">fair.eng.ui.ac.id<br />Dashboard Admin</span>
            </a>
            <?php
                } elseif ($session->get('role')=="penilai"){
            ?>
            <a href="<?php echo base_url();?>/penilai" class="brand-link">
                <span class="brand-text font-weight-light">fair.eng.ui.ac.id<br />Dashboard Penilai</span>
            </a>
            <?php
                } elseif ($session->get('role')=="peserta"){
            ?>
            <a href="<?php echo base_url();?>/peserta" class="brand-link">
                <span class="brand-text font-weight-light">fair.eng.ui.ac.id<br />Dashboard Peserta</span>
            </a>
            <?php
                }
            ?>
            <?php
                if ($logged_in){
            ?>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>/myprofile" class="nav-link">
                                        <i class="far fa-user nav-icon"></i>
                                        <p>Profile Saya</p>
                                    </a>
                                </li>
                                <?php
                                if ($session->get('role')=="superadmin"){
                                    echo $this->include('maintemp/menusuperadmin');
                                } elseif ($session->get('role')=="admin"){
                                    echo $this->include('maintemp/menuadmin');
                                } elseif ($session->get('role')=="penilai"){
                                    echo $this->include('maintemp/menupenilai');
                                } elseif ($session->get('role')=="peserta"){
                                    echo $this->include('maintemp/menupeserta');
                                }
                                ?>
                                <li class="nav-item">
                                    <a href="<?php echo base_url();?>/home/logout" class="nav-link">
                                        <i class="fas fa-sign-out-alt nav-icon"></i>
                                        <p>Keluar</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
            <?php
                }
            ?>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $title_page?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <?php
                                if ($session->get('role')=="superadmin"){
                                ?>
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>/superadmin">Beranda</a>
                                </li>
                                <?php
                                } elseif ($session->get('role')=="admin"){
                                ?>
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>/admin">Beranda</a></li>
                                <?php
                                } elseif ($session->get('role')=="penilai"){
                                ?>
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>/penilai">Beranda</a></li>
                                <?php
                                } elseif ($session->get('role')=="peserta"){
                                ?>
                                <li class="breadcrumb-item"><a href="<?php echo base_url();?>/peserta">Beranda</a></li>
                                <?php
                                }
                                ?>
                                <li class="breadcrumb-item active"><?= $data_bread?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <?= $this->renderSection('content');?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2022 <a href="https://eng.ui.ac.id">PPI FT UI</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?php echo base_url();?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE -->
    <script src="<?php echo base_url();?>/assets/dist/js/adminlte.js"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="<?php echo base_url();?>/assets/plugins/chart.js/Chart.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!--<script src="dist/js/demo.js"></script>-->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!--<script src="dist/js/pages/dashboard3.js"></script>-->
    <!--Date picker-->

    <script src="<?php echo base_url();?>/assets/plugins/daterangepicker/daterangepicker.js"></script>
    <script>
    $(function() {
        $('.data-datepicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            changeMonth: true,
            minYear: 1901,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
    </script>
    <!-- DataTables  & Plugins -->
    <script src="<?php echo base_url();?>/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js">
    </script>
    <script src="<?php echo base_url();?>/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
    </script>
    <script src="<?php echo base_url();?>/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo base_url();?>/assets/plugins/jszip/jszip.min.js"></script>
    <script src="<?php echo base_url();?>/assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>/assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?php echo base_url();?>/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
    $(function() {
        $('table.display').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#tabledata_wrapper .col-md-6:eq(0)');
    });
    </script>
    <script>
    $(function() {
        $('table.display1').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#tabledata1_wrapper .col-md-6:eq(0)');
    });
    </script>
    <script>
    $(function() {
        $('table.display2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#tabledata2_wrapper .col-md-6:eq(0)');
    });
    </script>
    <script>
    $(function() {
        $('table.display3').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#tabledata3_wrapper .col-md-6:eq(0)');
    });
    </script>
    <script>
    $(function() {
        $('table.display4').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#tabledata4_wrapper .col-md-6:eq(0)');
    });
    </script>
    <script>
    $(function() {
        $('table.display5').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#tabledata5_wrapper .col-md-6:eq(0)');
    });
    </script>
    <script>
    $(function() {
        $('table.display6').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "buttons": ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#tabledata6_wrapper .col-md-6:eq(0)');
    });
    </script>
</body>

</html>