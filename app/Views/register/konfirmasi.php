<?= $this->extend('register/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Konfirmasi</h3>
        </div>

        <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?= $validation->listErrors()?></div>
        <?php endif;?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url();?>/register/konfirmproses" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-group mb-0">
                        <span class="alert-danger">Mohon perhatian, klik tombol Simpan dan Keluar kalau data yang
                            dimasukkan
                            sudah benar. Setelah
                            klik tombol Simpan dan Keluar, data tidak bisa lagi diubah.</span><br /><br />
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="terms2" class="custom-control-input" id="terms2" value="Ya">
                            <label class="custom-control-label" for="terms2">Semua informasi yang saya isi sudah
                                benar.</label>
                        </div><br /><br />
                    </div>
                    <div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary col"
                                    onclick="return confirm('Setelah klik tombol konfirmasi, anda tidak dapat mengubah dokumen pendaftaran. Anda sudah Yakin?')">Simpan
                                    dan
                                    Kunci Dokumen</button>
                            </div>
                            <div class="col">
                                <button type="submit" name="submit" value="batal"
                                    class="btn btn-block btn-danger col">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection();?>