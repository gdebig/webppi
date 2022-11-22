<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <a href="<?= base_url();?>/bimbingfair/docs/<?= $user_id;?>">Kembali ke daftar dokumen FAIR</a>
        </div>
        <!-- /.card-header -->
        <div class="card">
            <div class="card-body">
                <h4 style="text-align: center;">LEMBAR DOKUMENTASI SEMUA LAMPIRAN</h4>
                <br /><br />
                <table width="100%">
                    <th>
                    <td width="5%" style="text-align: center">No</td>
                    <td width="15%">Lembar Kerja</td>
                    <td width="30%">Nama/Judul</td>
                    <td width="50%">Dokumen Pendukung (Max. 700KB, image atau PDF)</td>
                    </th>
                    <tr>
                        <td width="5%" style="text-align: center">1</td>
                        <td width="15%">Lembar Kerja</td>
                        <td width="30%">Nama/Judul</td>
                        <td width="50%">Dokumen Pendukung (Max. 700KB, image atau PDF)</td>
                    </tr>
                    <tr>
                        <td width="5%" style="text-align: center">2</td>
                        <td width="15%">Lembar Kerja</td>
                        <td width="30%">Nama/Judul</td>
                        <td width="50%">Dokumen Pendukung (Max. 700KB, image atau PDF)</td>
                    </tr>
                    <tr>
                        <td width="5%" style="text-align: center">3</td>
                        <td width="15%">Lembar Kerja</td>
                        <td width="30%">Nama/Judul</td>
                        <td width="50%">Dokumen Pendukung (Max. 700KB, image atau PDF)</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection();?>