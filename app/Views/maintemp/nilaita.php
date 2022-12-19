<?= $this->extend('maintemp/template'); ?>

<?= $this->section('content'); ?>

<div class="card card-primary" style="width: auto; margin: 30px;">
    <div class="col-sm-13" style="width: auto; margin: 30px;">
        <div class="">
            <h3>Penilaian Tugas Akhir oleh Pembimbing</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body" style="width: auto; margin: 30px;">
            <form action="<?php echo base_url(); ?>/manbimbing/nilaitaproses" method="post" enctype="multipart/form-data">
                <input type="hidden" name="mhs_id" id="mhs_id" value="<?= $mhs_id; ?>" />
                <input type="hidden" id="dosen_id" name="dosen_id" value="<?= $dosen_id ?>">
                <input type="hidden" id="ta_id" name="ta_id" value="<?= $ta_id ?>">
                <div class="form-group">
                    <label for="penulisan" class="element">Penulisan Laporan (30%) <span class="required">
                            *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input class="form-control" id="penulisan" name="penulisan" type="text" placeholder="Nilai Penulisan Laporan..." />
                    </div><br />
                    <label for="presentasi" class="element">Presentasi / Seminar Laporan (30%) <span class="required">
                            *</span>&nbsp;
                    </label>
                    <div class="element">
                        <input class="form-control" id="presentasi" name="presentasi" type="text" placeholder="Nilai Presentasi..." />
                    </div><br />
                    <label for="materi" class="element">Penguasaan Materi (40%)
                        <span class="required"> *</span>&nbsp; </label>
                    <div class="element">
                        <input class="form-control" id="materi" name="materi" type="text" placeholder="Nilai Penguasaan Materi..." />
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
                    <br />
                    <div class="row">
                        <div class="col">
                            <p>Range Penilaian:</p>
                            <table>
                                <tr>
                                    <th width="5%" style="text-align: center; border: 1px solid black">No.</th>
                                    <th width="10%" style="text-align: center; border: 1px solid black">Nilai</th>
                                    <th width="10%" style="text-align: center; border: 1px solid black">Bobot</th>
                                    <th width="75%" style="text-align: center; border: 1px solid black">Kisaan Nilai</th>
                                </tr>
                                <tr>
                                    <td style="text-align: center; border: 1px solid black">1.</td>
                                    <td style="text-align: center; border: 1px solid black">A</td>
                                    <td style="text-align: center; border: 1px solid black">4.0</td>
                                    <td style="text-align: center; border: 1px solid black">85 - 100</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; border: 1px solid black">2.</td>
                                    <td style="text-align: center; border: 1px solid black">A-</td>
                                    <td style="text-align: center; border: 1px solid black">3.7</td>
                                    <td style="text-align: center; border: 1px solid black">80 - 84</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; border: 1px solid black">3.</td>
                                    <td style="text-align: center; border: 1px solid black">B+</td>
                                    <td style="text-align: center; border: 1px solid black">3.3</td>
                                    <td style="text-align: center; border: 1px solid black">75 - 79</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; border: 1px solid black">4.</td>
                                    <td style="text-align: center; border: 1px solid black">B</td>
                                    <td style="text-align: center; border: 1px solid black">3.0</td>
                                    <td style="text-align: center; border: 1px solid black">70 - 74</td>
                                </tr>
                                <tr>
                                    <td style="text-align: center; border: 1px solid black">5.</td>
                                    <td style="text-align: center; border: 1px solid black">B-</td>
                                    <td style="text-align: center; border: 1px solid black">2.7</td>
                                    <td style="text-align: center; border: 1px solid black">65 - 69</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br />
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