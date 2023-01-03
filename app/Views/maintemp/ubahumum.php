<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Form Tambah Pengumuman</h3>
        </div>

        <?php if (isset($validation)) : ?>
            <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
        <?php endif; ?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/manpengumuman/ubahumumproses" method="post" enctype="multipart/form-data">
                <input type="hidden" name="umum_id" id="umum_id" value="<?= $umum_id; ?>" />
                <input type="hidden" name="oldfile" id="oldfile" value="<?= $umum_file; ?>" />
                <div class="form-group">
                    <label for="umum_name" class="element">Nama Pengumuman <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="umum_name" name="umum_name" class="form-control" type="text" placeholder="Nama Pengumuman..." value="<?= $umum_name; ?>" />
                    </div>
                    <br />
                    <label for="umum_desc" class="element">Deskripsi <span class="required"> *</span>&nbsp;
                    </label>
                    <textarea class="form-control" id="umum_desc" name="umum_desc" placeholder="Deskripsi..."><?= $umum_desc; ?></textarea>
                    <br />
                    <label for="file" class="element">Lampiran File</label>
                    <div class="element">
                        <input id="file" name="file" class="form-control" type="file" placeholder="Lampiran File..." />
                    </div><br />
                    <label for="umum_tujuan" class="element">Target Pengumuman <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select id="umum_tujuan" name="umum_tujuan" class="form-control">
                            <option value='ynn' <?= $umum_tujuan == 'ynn' ? 'selected' : ''; ?>>Calon Peserta</option>
                            <option value='nyn' <?= $umum_tujuan == 'nyn' ? 'selected' : ''; ?>>Peserta</option>
                            <option value='nny' <?= $umum_tujuan == 'nny' ? 'selected' : ''; ?>>Penilai</option>
                            <option value='yyn' <?= $umum_tujuan == 'yyn' ? 'selected' : ''; ?>>Calon Peserta dan Peserta</option>
                            <option value='yyy' <?= $umum_tujuan == 'yyy' ? 'selected' : ''; ?>>Semuanya</option>
                        </select>
                    </div><br /><br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Ubah
                                Pengumuman</button>
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