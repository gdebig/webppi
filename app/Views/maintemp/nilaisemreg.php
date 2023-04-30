<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Penilaian Seminar Peserta RPL Regular</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/mansemreg/nilaisemregproses" method="post" enctype="multipart/form-data">
                <input type="hidden" id="sem_id" name="sem_id" value="<?= $sem_id ?>">
                <div class="form-group">
                    <label for="mhs" class="element">Nama Peserta RPL Regular
                    </label>
                    <div class="element">
                        <input class="form-control" id="mhs" name="mhs" type="text" placeholder="Nama Peserta..." value="<?= !empty($mhs_fullname) ? $mhs_fullname : $mhs_username . " (Belum isi profile.)"; ?>" disabled />
                    </div><br />
                    <label for="judul" class="element">Judul Seminar
                    </label>
                    <div class="element">
                        <input class="form-control" id="judul" name="judul" type="text" placeholder="Judul Seminar..." value="<?= $sem_judul; ?>" disabled />
                    </div><br />
                    <label for="bukti" class="element">Bukti Seminar
                        <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <a href="<?= base_url(); ?>/uploads/docs/<?= $sem_bukti; ?>" target="_blank">Bukti Seminar</a>
                    </div><br />
                    <label for="nilai" class="element">Nilai Seminar
                    </label>
                    <div class="element">
                        <input class="form-control" id="nilai" name="nilai" type="text" placeholder="Nilai Seminar..." />
                    </div><br />
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Beri
                                Nilai</button>
                        </div>
                        <div class="col">
                            <button type="submit" name="submit" value="batal" class="btn btn-block btn-danger col">Batal</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.content-wrapper -->
<!-- Control Sidebar -->

<?= $this->endSection(); ?>