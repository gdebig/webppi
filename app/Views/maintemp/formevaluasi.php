<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "https://www.w3.org/TR/html4/strict.dtd">
<html lang="id">

<head>
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
    <title><?= $title; ?></title>
    <style type="text/css">
        body,
        td,
        div,
        p,
        a,
        input {
            font-family: times
        }

        body,
        td {
            font-size: 13px
        }

        a:link,
        a:active {
            color: #1155CC;
            text-decoration: none
        }

        a:hover {
            text-decoration: underline;
            cursor: pointer
        }

        a:visited {
            color: #6611CC
        }

        img {
            border: 0px
        }

        pre {
            white-space: pre;
            white-space: -moz-pre-wrap;
            white-space: -o-pre-wrap;
            white-space: pre-wrap;
            word-wrap: break-word;
            max-width: 800px;
            overflow: auto;
        }

        .logo {
            left: -7px;
            position: relative;
        }

        .back-button {
            display: inline-block;
            margin: 9px;
            padding: 5px 9px;
            background: #f00;
            border-radius: 3px;
            text-decoration: none;
            color: #fff;
            font-size: larger;
            border: 1px solid #fff
        }

        .back-button:hover {
            text-decoration: none;
            background: #ff5c5c;
            color: #fff
        }

        .back-button:visited,
        .back-button:link,
        .back-button:active {
            color: #fff
        }

        .warning {
            color: #fff;
            font-size: 17px;
            font-family: 'Arial'
        }

        @media print {
            .back-button {
                display: none
            }

            .warning {
                display: none
            }

            .noprint {
                display: none
            }

            .kop {
                visibility: hidden
            }

            input {
                border: none;
                width: auto !important;
                overflow: visible
            }
        }

        table {
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }

        .border1 {
            border: 1px solid;
        }

        th {
            background-color: #96D4D4;
        }
    </style>

<body>

    <div class="warning" style="
    background: rgba(0, 0, 0, 0.5);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
">
        <table width="100%">
            <tbody>
                <tr>
                    <td width="100">
                        <a class="back-button" href="javascript:if(history.length>1){history.back();}else{window.close();}">« Back</a>
                    </td>
                    <td width="200px">
                        <div><label style="cursor: pointer;"><input onclick="togl()" type="checkbox" id="showKop" value="showKop" checked="checked">Show kop when printing.</label></div>
                    </td>
                    <td width="*">
                        <div style="text-align:center">Press CTRL+P to print or save as PDF. Don't forget to <b>hide
                                headers and footers</b> in your browser's printing settings.</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="kop">
        <div style="float:left"><img style="height:80px" src="<?= base_url(); ?>/uploads/pics/logo_kop.png">
        </div>
        <div style="text-align:right;float:right;font-family:Arial Narrow;font-size:smaller">EKP02
        </div>
        <div style="clear:both"></div>
    </div>
    <br>
    <h2 style='text-align:center;margin-top:-10px;'>FORM EVALUASI PRAKTEK KEINSINYURAN</h2>
    <hr><br>
    <p>Mahasiswa Program Studi Pendidikan Profesi Keinsinyuran Fakultas Teknik Universitas Indonesia di bawah ini:</p>
    <table>
        <tr>
            <td valign="top" width="20%">Nama Mahasiswa</td>
            <td valign="top" width="3%">&nbsp; :</td>
            <td valign="top" width="77%"><?= $namamahasiswa; ?></td>
        </tr>
        <tr>
            <td valign="top" width="20%">No. Pokok Mahasiswa</td>
            <td valign="top" width="3%">&nbsp; :</td>
            <td valign="top" width="77%"><?= $npm; ?></td>
        </tr>
    </table>
    <p>Telah menjalankan dan menyelesaikan kegiatan Praktek Keinsinyuran pada:</p>
    <div style='border-style: groove;'>
        <table>
            <tr>
                <td valign="top" width="20%">Instansi / Perusahaan</td>
                <td valign="top" width="3%">&nbsp; :</td>
                <td valign="top" width="77%"><?= $instansi; ?></td>
            </tr>
            <tr>
                <td valign="top" width="20%">Dept. / Divisi / Seksi</td>
                <td valign="top" width="3%">&nbsp; :</td>
                <td valign="top" width="77%"><?= $divisi; ?></td>
            </tr>
            <tr>
                <td valign="top" width="20%">Periode (Tgl - Bln - Thn)</td>
                <td valign="top" width="3%">&nbsp; :</td>
                <td valign="top" width="77%"><?= $periode; ?></td>
            </tr>
            <tr>
                <td valign="top" width="20%">Pembimbing</td>
                <td valign="top" width="3%">&nbsp; :</td>
                <td valign="top" width="77%"><?= $namapembimbing; ?></td>
            </tr>
            <tr>
                <td valign="top" width="20%">Judul Laporan</td>
                <td valign="top" width="3%">&nbsp; :</td>
                <td valign="top" width="77%"><?= $lapjudul; ?></td>
            </tr>
        </table>
    </div>
    <br />
    <p>Dengan hasil/nilai, berdasarkan evaluasi menyeluruh, sebagai berikut:</p>

    <table class="border1" width="100%">
        <tr class="border1">
            <th width="5%" style="text-align: center;" class="border1">No</th>
            <th width="35%" style="text-align: center;" class="border1">Materi Penilaian</th>
            <th width="60%" style="text-align: center;" class="border1">Nilai Rata-rata</th>
        </tr>
        <tr class="border1">
            <td colspan="3" class="border1">
                <p>
                    <i>Diisi oleh Penguji</i>
                </p>
            </td>
        </tr>
        <tr class="border1">
            <td valign="top" width="5%" style="text-align: center" class="border1">1.</td>
            <td valign="top" width="35%" class="border1">Penulisan Laporan (30%)</td>
            <td valign="top" width="60%" style="text-align: center" class="border1"><?= $penulisan; ?></td>
        </tr>
        <tr class="border1">
            <td valign="top" width="5%" style="text-align: center" class="border1">2.</td>
            <td valign="top" width="35%" class="border1">Presentasi / Seminar Laporan (30%)</td>
            <td valign="top" width="60%" style="text-align: center" class="border1"><?= $presentasi; ?></td>
        </tr>
        <tr class="border1">
            <td valign="top" width="5%" style="text-align: center" class="border1">1.</td>
            <td valign="top" width="35%" class="border1" class="border1">Penguasaan Materi (40%)</td>
            <td valign="top" width="60%" style="text-align: center" class="border1" class="border1"><?= $materi; ?></td>
        </tr>
        <tr class="border1">
            <td valign="top" colspan="2" class="border1">Nilai Rata-rata</td>
            <td valign="top" style="text-align: center" class="border1"><?= $rerata; ?></td>
        </tr>
        <tr class="border1">
            <td valign="top" colspan="2" class="border1">Nilai Huruf</td>
            <td valign="top" style="text-align: center" class="border1"><?= $nilaihuruf; ?></td>
        </tr>
    </table>
    <br><br>
    <table width="100%">
        <tr>
            <td width="50%">
            </td>
            <td width="50%" style="text-align: center">
                Depok, <?= $tglsekarang; ?>
            </td>
        </tr>
        <tr>
            <td style="text-align: center" width="50%">
                Mengetahui,<br>
                Penanggung Jawab / Prodi PPI<br />
                <?php
                if (!empty($signkaprodi)) {
                ?>
                    <img height="80px" src="<?= base_url(); ?>/uploads/ttd/<?= $signkaprodi; ?>"><br />
                <?php
                } else {
                    echo "<br /><br /><br /><br />";
                }
                ?>
                <u><?= !empty($namakaprodi) ? $namakaprodi : '( )'; ?></u><br>
                NIP: <?= !empty($nipkaprodi) ? $nipkaprodi : '( )'; ?>
            </td>
            <td style="text-align: center" width="50%">
                <br>
                <?= $tipedosen; ?><br>
                <img height="80px" src="<?= base_url(); ?>/uploads/ttd/<?= $signed; ?>"><br>
                <u><?= $namattd; ?></u><br>
                NIP: <?= $nipttd; ?>
            </td>
        </tr>
    </table>
    <br><br>
    <p>Keterangan:</p>
    <p>Konversi Huruf A = 85 - 100, A- = 80 - 85, B+ = 75 - 80, B = 70 - 75, B- = 65 - 70, C+= 60 - 65, C = 55 - 60</p>
    <script type="text/javascript">
        // <![CDATA[
        document.body.onload = function() {
            togl();
            document.body.offsetHeight;
            window.print()
        };

        function togl() {
            if (document.getElementById('showKop').checked) {
                document.querySelector('head').innerHTML +=
                    '<style type="text/css" media="print">.kop{visibility:visible !important}</style>';
            } else {
                document.querySelector('head').innerHTML +=
                    '<style type="text/css" media="print">.kop{visibility:hidden !important}</style>';
            }
        }
        // ]]>
    </script>
</body>

</html>