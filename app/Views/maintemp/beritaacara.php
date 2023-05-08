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
            border: 1px groove #000;
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
    <h4 style='text-align:center;margin-top:-10px;'>BERITA ACARA SIDANG PRAKTIK KEINSINYURAN</h4>
    <h3 style='text-align:center;margin-top:-10px;'>PROGRAM STUDI PENDIDIKAN PROFESI INSINYUR (PS-PPI)</h3>
    <hr><br>
    <p>Dengan ini menyatakan bahwa pada:</p>
    <table>
        <tr>
            <td valign="top" width="20%">Tanggal</td>
            <td valign="top" width="3%">:</td>
            <td valign="top" width="77%"><?= $tanggal_sidang; ?></td>
        </tr>
        <tr>
            <td valign="top" width="20%">Jam</td>
            <td valign="top" width="3%">:</td>
            <td valign="top" width="77%"><?= $jam_sidang . " WIB"; ?></td>
        </tr>
        <tr>
            <td valign="top" width="20%">Tempat</td>
            <td valign="top" width="3%">:</td>
            <td valign="top" width="77%"><?= $tempat_sidang; ?></td>
        </tr>
    </table>
    <p>telah berlangsung <b>Sidang Praktik Keinsinyuran Program Studi Pendidikan Profesi Insinyur</b> Fakultas Teknik Universitas Indonesia Semester <?= $semaktif; ?> <?= $tahunaktif; ?>, dengan peserta:</p>
    <table>
        <tr>
            <td valign="top" width="20%">Nama Mahasiswa</td>
            <td valign="top" width="3%">&nbsp; :</td>
            <td valign="top" width="77%"><?= $namamahasiswa; ?></td>
        </tr>
        <tr>
            <td valign="top" width="20%">No. Mahasiswa</td>
            <td valign="top" width="3%">&nbsp; :</td>
            <td valign="top" width="77%"><?= $npm; ?></td>
        </tr>
        <tr>
            <td valign="top" width="20%">Program Profesi</td>
            <td valign="top" width="3%">&nbsp; :</td>
            <td valign="top" width="77%">Pendidikan Profesi Insinyur</td>
        </tr>
        <tr>
            <td valign="top" width="20%">Judul Laporan</td>
            <td valign="top" width="3%">&nbsp; :</td>
            <td valign="top" width="77%"><?= $lapjudul; ?></td>
        </tr>
    </table><br />
    <table class="border1" width="100%">
        <tr class="border1">
            <th width="30%" style="text-align: center;" class="border1">Penilai</th>
            <th width="5%" style="text-align: center;" class="border1">Nilai</th>
            <th width="5%" style="text-align: center;" class="border1">Nilai Huruf</th>
            <th width="60%" style="text-align: center;" class="border1">Tanda tangan</th>
        </tr>
        <?php
        $nilaitotal = 0;
        $i = 0;
        foreach ($nilaita as $ta) {
        ?>
            <tr class="border1">
                <td valign="top" width="30%" style="text-align: left; vertical-align: middle;" class="border1"><?= $ta['FullName']; ?></td>
                <td valign="top" width="5%" class="border1" style="text-align: center; vertical-align: middle;"><?php
                                                                                                                $nilai = (0.3 * $ta['penulisan']) + (0.3 * $ta['presentasi']) + (0.4 * $ta['materi']);
                                                                                                                echo $nilai;
                                                                                                                ?></td>
                <td valign="top" width="5%" class="border1" style="text-align: center; vertical-align: middle;"><?php
                                                                                                                echo nilai_huruf($nilai);
                                                                                                                ?></td>
                <td valign="top" width="60%" style="text-align: center; vertical-align: middle" class="border1"><img height="60px" src="<?= base_url(); ?>/uploads/ttd/<?= $ta['signed']; ?>"></td>
            </tr>
        <?php
            $i++;
            $nilaitotal = $nilaitotal + $nilai;
        }
        ?>
    </table>
    <table>
        <tr>
            <td width="30%">Nilai Rata-rata</td>
            <td width="5%">:</td>
            <td width="75%"><?php
                            $rerata = $nilaitotal / $i;
                            echo $rerata
                            ?></td>
        </tr>
        <tr>
            <td width="30%">Nilai Huruf</td>
            <td width="5%">:</td>
            <td width="75%"><?php echo nilai_huruf($rerata); ?></td>
        </tr>
    </table>
    <p><b>Catatan:</b></p>
    <ul>
        <li>Disparitas nilai pembimbing dan penguji <= 10</li>
        <li>Total bobot nilai pembimbing 50%</li>
        <li>Total bobot nilai penguji 50%</li>
    </ul>
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
            </td>
            <td style="text-align: center" width="50%">
                Mengetahui,<br>
                Penanggung Jawab / Prodi PPI<br />
                <?php
                if (!empty($signkaprodi)) {
                ?>
                    <img height="75px" src="<?= base_url(); ?>/uploads/ttd/<?= $signkaprodi; ?>"><br />
                <?php
                } else {
                    echo "<br /><br /><br /><br />";
                }
                ?>
                <u><?= !empty($namakaprodi) ? $namakaprodi : '( )'; ?></u><br>
                NIP: <?= !empty($nipkaprodi) ? $nipkaprodi : '( )'; ?>
            </td>
        </tr>
    </table>
    <br><br>
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