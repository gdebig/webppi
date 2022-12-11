<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Profile</h3>
        </div>

        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('msg') ?></div>
        <?php endif; ?>
        <!-- /.card-header -->

        <?php
        if (isset($kosong)) {
        ?>
            <div class="alert alert-danger">Data profile belum ada. <a href="<?= base_url(); ?>/myprofile/buatprofile">Klik
                    di sini untuk membuat profile</a></div>
        <?php
        } else {
        ?>
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Data Umum</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td width="30%">Nama Lengkap</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $FullName; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Tempat & Tanggal Lahir</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $BirthPlace . ", " . format_indo($BirthDate); ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Badan Kejuruan</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?php
                                            switch ($Vocational) {
                                                case 'Ars':
                                                    echo "Arsitektur";
                                                    break;
                                                case 'Ele':
                                                    echo "Teknik Elektro";
                                                    break;
                                                case 'Wil':
                                                    echo "Teknik Kewilayahan dan Perkotaan";
                                                    break;
                                                case 'Ind':
                                                    echo "Teknik Industri";
                                                    break;
                                                case 'Kim':
                                                    echo "Teknik Kimia";
                                                    break;
                                                case 'Mes':
                                                    echo "Teknik Mesin";
                                                    break;
                                                case 'Lin':
                                                    echo "Teknik Lingkungan";
                                                    break;
                                                case 'Sip':
                                                    echo "Teknik Sipil";
                                                    break;
                                                case 'Mat':
                                                    echo "Teknik Material";
                                                    break;
                                                case 'Met':
                                                    echo "Teknik Metalurgi";
                                                    break;
                                                case 'Inf':
                                                    echo "Teknik Informatika";
                                                    break;
                                                case 'Kap':
                                                    echo "Teknik Perkapalan";
                                                    break;
                                                case 'Tra':
                                                    echo "Transportasi";
                                                    break;
                                                case "Kom":
                                                    echo "Teknik Komputer";
                                                    break;
                                                case "Bio":
                                                    echo "Teknik Biomedik";
                                                    break;
                                            }
                                            ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Alamat Rumah</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $HAddr; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Kota Alamat Rumah</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $HCity; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Kode Pos Alamat Rumah</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $HPostnum; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Telepon Rumah</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $Hnum; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Nomor Mobile</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $Hpnum; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Nomor Faks Rumah</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $Hfaks; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Nomor Telex Rumah</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $Htelex; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Email Pribadi</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $Hemail; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Photo</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?php
                                            if (!empty($Photo)) {
                                                echo "<img src='" . base_url('uploads/profilpic/' . $Photo) . "' width='30%' height='30%' />";
                                            } else {
                                                echo "";
                                            }
                                            ?></td>
                        </tr>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Informasi Pekerjaan</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td width="30%">Tempat Kerja</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $Work; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Posisi/Jabatan</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $Position; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Alamat Kantor</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $WAddr; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Kota Alamat Kantor</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $WCity; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Kode Pos Alamat Kantor</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $Wpostnum; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Nomor Telepon Kantor</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $Wnum; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Faks Kantor</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $Wfaks; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Telex Kantor</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $Wtelex; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Email Kantor 1</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $Wemail1; ?></td>
                        </tr>
                        <tr>
                            <td width="30%">Email Kantor 2</td>
                            <td width="5%" style="text-align:center">:</td>
                            <td width="65%"><?= $Wemail2; ?></td>
                        </tr>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="card">
                <div class="card-body">
                    <a href="<?= base_url(); ?>/myprofile/ubah/<?= $user_id; ?>" class="btn btn-block btn-primary">Ubah
                        Profile</a>
                </div>
            </div>
        <?php
        }
        ?>
        <!-- /.content-wrapper -->
    </div>
</div>

<?= $this->endSection(); ?>