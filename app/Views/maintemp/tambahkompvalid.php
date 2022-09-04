<?= $this->extend('maintemp/template');?>

<?= $this->section('content');?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Form Tambah Kompetensi</h3>
        </div>

        <?php if(isset($validation)):?>
        <div class="alert alert-danger"><?= $validation->listErrors()?></div>
        <?php endif;?>

        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url();?>/mankomp/tambahkompproses" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="code" class="element">Kode <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="code" name="code" class="form-control" type="text" placeholder="Kode..."
                            value="<?= set_value('code');?>" />
                    </div>
                    <br />
                    <label for="desc" class="element">Deskripsi <span class="required"> *</span>&nbsp;
                    </label>
                    <textarea class="form-control" id="desc" name="desc"
                        placeholder="Deskripsi..."><?= set_value('desc');?></textarea>
                    <br />
                    <label for="cat" class="element">Kategori <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input id="cat" name="cat" class="form-control" type="text" placeholder="Kategori..."
                            value="<?= set_value('cat');?>" />
                    </div><br />
                    <label for="parent" class="element">Parent Group <span class="required"> *</span>&nbsp;
                    </label>
                    <div class="element">
                        <select id="parent" name="parent" class="form-control">
                            <option value='n' <?= set_value('parent')=='n' ? 'selected' : '';?>>Tidak</option>
                            <option value='y' <?= set_value('parent')=='y' ? 'selected' : '';?>>Ya</option>
                        </select>
                    </div><br /><br />
                    <div class="form-group">
                        <label>Field bertanda * harus diisi.</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary col">Tambah
                                Kompetensi</button>
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