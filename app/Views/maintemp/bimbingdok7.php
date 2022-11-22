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
                <form action="<?php echo base_url();?>/userfair7/pernyataanproses" method="post"
                    enctype="multipart/form-data">
                    <input type="hidden" name="user_id" id="user_id" value="<?= $user_id;?>" />
                    <input type="checkbox" name="proses" value="Ya" class="form-check-input" /> Dengan ini saya
                    menyatakan bahwa seluruh keterangan yang diunggah pada tanggal , jam (menurut waktu
                    fair.eng.ui.ac.id) adalah benar. Bersama ini saya lampirkan data atau dokumen pendukung.
                    <br /><br />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection();?>