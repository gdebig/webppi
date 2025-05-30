<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Penilaian Tugas Akhir Peserta Reguler</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/manujipkreg/nilaiujipkproses" method="post" enctype="multipart/form-data">
                <input type="hidden" name="mhs_id" id="mhs_id" value="<?= $mhs_id; ?>" />
                <input type="hidden" id="dosen_id" name="dosen_id" value="<?= $dosen_id ?>">
                <input type="hidden" id="tar_id" name="tar_id" value="<?= $tar_id ?>">
                <div class="form-group">
                    <label for="penulisan" class="element">Penulisan Laporan (30%) <span class="required">
                            *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input class="form-control" id="penulisan" name="penulisan" type="text" placeholder="Nilai Penulisan Laporan..." value="<?= set_value('penulisan'); ?>" />
                    </div><br />
                    <label for="presentasi" class="element">Presentasi / Seminar Laporan (30%) <span class="required">
                            *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input class="form-control" id="presentasi" name="presentasi" type="text" placeholder="Nilai Presentasi..." value="<?= set_value('presentasi'); ?>" />
                    </div><br />
                    <label for="materi" class="element">Penguasaan Materi (40%)
                        <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="materi" name="materi" type="text" placeholder="Nilai Penguasaan Materi..." value="<?= set_value('materi'); ?>" />
                    </div><br />
                    <label class="element" for="signature">Tanda Tangan: <span class="required">
                            *</span>&nbsp;</label>
                    <div class="element">
                        <div id="sig"></div>
                        <br><br>
                        <button id="clear" class="btn btn-danger">Bersihkan Tanda Tangan</button>
                        <textarea id="signature" name="signed" style="display: none"></textarea>
                    </div>
                    <br />
                    <p><b>Atau</b></p>
                    <input type="checkbox" id='checksigned' name='checksigned' value='dbsigned'> Gunakan TTD dari Database
                    <br /><br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
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