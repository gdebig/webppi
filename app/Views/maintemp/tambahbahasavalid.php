<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Tambah Bahasa yang Dikuasai</h3>
        </div>

        <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?= $validation->listErrors()?></div>
        <?php endif;?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url();?>/userfair6/tambahbahasaproses" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Name" class="element">Nama Bahasa <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input class="form-control" id="Name" name="Name" type="text" placeholder="Nama Bahasa..."
                            value="<?= set_value('Name');?>" />
                    </div>
                    <br />
                    <label for="LangType" class="element">Jenis Bahasa <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <select name="LangType" id="LangType" class="form-control">
                            <option value="Da" <?= set_value('LangType')=="Da" ? 'selected' : '';?>>Bahasa Daerah
                            </option>
                            <option value="Na" <?= set_value('LangType')=="Na" ? 'selected' : '';?>>Bahasa Nasional
                            </option>
                            <option value="In" <?= set_value('LangType')=="In" ? 'selected' : '';?>>Bahasa Asing /
                                Internasional</option>
                        </select>
                    </div>
                    <br />
                    <label for="VerbSkill" class="element">Kemampuan Verbal Aktif/Pasif <span class="required">
                            *</span>&nbsp; </label>
                    <div class="element">
                        <select name="VerbSkill" id="VerbSkill" class="form-control">
                            <option value="Pasif" <?= set_value('VerbSkill')=="Pasif" ? 'selected' : '';?>>Pasif,
                                Tertulis</option>
                            <option value="Aktif" <?= set_value('VerbSkill')=="Aktif" ? 'selected' : '';?>>Aktif,
                                Tertulis/Lisan</option>
                        </select>
                    </div>
                    <br />
                    <label for="WriteType" class="element">Jenis Tulisan yang Mampu Disusun <span class="required">
                            *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="WriteType" name="WriteType" type="text"
                            placeholder="Jenis Tulisan yang Mampu Disusun..." value="<?= set_value('WriteType');?>" />
                    </div>
                    <br />
                    <label for="LangMark" class="element">Nilai TOEFL atau yang Sejenisnya</label>
                    <div class="element">
                        <input class="form-control" id="LangMark" name="LangMark" type="text"
                            placeholder="Nilai TOEFL atau yang Sejenisnya..." value="<?= set_value('LangMark');?>" />
                    </div>
                    <br />
                    <label for="File" class="element">Bukti Bahasa</label>
                    <div class="element">
                        <input class="form-control" id="File" name="File" type="file" />
                    </div>
                    <br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Bahasa</button>
                        </div>
                        <div class="col">
                            <button type="submit" name="submit" value="batal"
                                class="btn btn-block btn-danger col">Batal</button>
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