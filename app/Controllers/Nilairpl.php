<?php

//tampilan fair utk penilai

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Models\EtikRefModel;
use App\Models\PendapatModel;
use App\Models\CapesPendModel;
use App\Models\CapesOrgModel;
use App\Models\PenghargaanModel;
use App\Models\CapesSertModel;
use App\Models\CapesKualifikasiModel;
use App\Models\MengajarModel;
use App\Models\CapesKartulModel;
use App\Models\CapesSemModel;
use App\Models\BahasaModel;
use App\Models\NilairplModel;

class Nilairpl extends BaseController
{
    public function docs($mhs_id = false, $dosen_id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal', 'nilai']);

        $model = new ProfileModel();
        $mhsprofile = $model->where('user_id', $mhs_id)->first();
        if ($mhsprofile) {
            $data['FullName'] = $mhsprofile['FullName'];
        } else {
            $data['FullName'] = 'kosong';
        }

        $model2 = new NilairplModel();

        //Nilai Kode Etik
        $kodeetik = $model2->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namamk', 'kodeetik')->where('nilairpl_save', 'Ya')->findall();
        $jmlkodeetik = $model2->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namamk', 'kodeetik')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($kodeetik)) {
            $nilaikodeetik = 0;
            foreach ($kodeetik as $nilaike) :
                $nilai = $nilaike['nilaiq'] * $nilaike['nilair'];
                $nilaikodeetik = $nilaikodeetik + $nilai;
            endforeach;
        } else {
            $nilaikodeetik = 0;
        }
        $data['nilaikodeetik'] = $nilaikodeetik;
        $data['jmlkodeetik'] = $jmlkodeetik;

        //Nilai Profesionalisme
        $profesi = $model2->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namamk', 'profesi')->where('nilairpl_save', 'Ya')->findall();
        $jmlprofesi = $model2->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namamk', 'profesi')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($profesi)) {
            $nilaiprofesi = 0;
            foreach ($profesi as $nilaipro) :
                $nilai = $nilaipro['nilaiq'] * $nilaipro['nilair'];
                $nilaiprofesi = $nilaiprofesi + $nilai;
            endforeach;
        } else {
            $nilaiprofesi = 0;
        }
        $data['nilaiprofesi'] = $nilaiprofesi;
        $data['jmlprofesi'] = $jmlprofesi;

        //Nilai k3lh
        $k3lh = $model2->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namamk', 'k3lh')->where('nilairpl_save', 'Ya')->findall();
        $jmlk3lh = $model2->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namamk', 'k3lh')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($k3lh)) {
            $nilaik3lh = 0;
            foreach ($k3lh as $nilaik3) :
                $nilai = $nilaik3['nilaiq'] * $nilaik3['nilair'];
                $nilaik3lh = $nilaik3lh + $nilai;
            endforeach;
        } else {
            $nilaik3lh = 0;
        }
        $data['nilaik3lh'] = $nilaik3lh;
        $data['jmlk3lh'] = $jmlk3lh;

        //Nilai Studi Kasus
        $studikasus = $model2->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namamk', 'studikasus')->where('nilairpl_save', 'Ya')->findall();
        $jmlstudikasus = $model2->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namamk', 'studikasus')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($studikasus)) {
            $nilaistudikasus = 0;
            foreach ($studikasus as $nilaisk) :
                $nilai = $nilaisk['nilaiq'] * $nilaisk['nilair'];
                $nilaistudikasus = $nilaistudikasus + $nilai;
            endforeach;
        } else {
            $nilaistudikasus = 0;
        }
        $data['nilaistudikasus'] = $nilaistudikasus;
        $data['jmlstudikasus'] = $jmlstudikasus;

        //Nilai Seminar
        $seminar = $model2->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namamk', 'seminar')->where('nilairpl_save', 'Ya')->findall();
        $jmlseminar = $model2->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namamk', 'seminar')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($seminar)) {
            $nilaiseminar = 0;
            foreach ($seminar as $nilaisem) :
                $nilai = $nilaisem['nilaiq'] * $nilaisem['nilair'];
                $nilaiseminar = $nilaiseminar + $nilai;
            endforeach;
        } else {
            $nilaiseminar = 0;
        }
        $data['nilaiseminar'] = $nilaiseminar;
        $data['jmlseminar'] = $jmlseminar;

        $data['dosen_id'] = $dosen_id;
        $data['mhs_id'] = $mhs_id;
        $data['title_page'] = "Penilaian MK RPL";
        $data['data_bread'] = "Nilai RPL";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/nilairpl', $data);
    }

    public function kodeetik($mhs_id, $dosen_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $modelprof = new ProfileModel();
        $mhsprofile = $modelprof->where('user_id', $mhs_id)->first();
        if ($mhsprofile) {
            $data['FullName'] = $mhsprofile['FullName'];
        } else {
            $data['FullName'] = 'kosong';
        }

        $modelnilai = new NilairplModel();

        //Userfair21
        $model = new EtikRefModel();
        $etik = $model->where('user_id', $mhs_id)->orderby('Name', 'ASC')->findall();
        $data['jumlah_etik'] = $model->where('user_id', $mhs_id)->countAllResults();
        $dataid21 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '21')->where('namamk', 'kodeetik')->findall();
        if (!empty($dataid21)) {
            foreach ($dataid21 as $dataid) :
                $id21[] = $dataid['id_tbl'];
                $nilaip21[] = $dataid['nilaip'];
                $nilaiq21[] = $dataid['nilaiq'];
                $nilair21[] = $dataid['nilair'];
            endforeach;
        } else {
            $id21[] = '';
            $nilaip21[] = '';
            $nilaiq21[] = '';
            $nilair21[] = '';
        }
        $data['id21'] = $id21;
        $data['nilaip21'] = $nilaip21;
        $data['nilaiq21'] = $nilaiq21;
        $data['nilair21'] = $nilair21;

        if (!empty($etik)) {
            $data['data_etik'] = $etik;
        } else {
            $data['data_etik'] = 'kosong';
        }

        //Userfair22
        $model1 = new PendapatModel();
        $pendapat = $model1->where('user_id', $mhs_id)->orderby('Num', 'DESC')->findall();
        $dataid22 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '22')->where('namamk', 'kodeetik')->findall();
        if (!empty($dataid22)) {
            foreach ($dataid22 as $dataid) :
                $id22[] = $dataid['id_tbl'];
                $nilaip22[] = $dataid['nilaip'];
                $nilaiq22[] = $dataid['nilaiq'];
                $nilair22[] = $dataid['nilair'];
            endforeach;
        } else {
            $id22[] = '';
            $nilaip22[] = '';
            $nilaiq22[] = '';
            $nilair22[] = '';
        }
        $data['id22'] = $id22;
        $data['nilaip22'] = $nilaip22;
        $data['nilaiq22'] = $nilaiq22;
        $data['nilair22'] = $nilair22;

        if (!empty($pendapat)) {
            $data['data_pendapat'] = $pendapat;
        } else {
            $data['data_pendapat'] = 'kosong';
        }

        //Userfair13
        $model2 = new CapesOrgModel();
        $org = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.2.')->orderby('StartPeriodYear', 'DESC')->findall();
        $data['jumlah_org'] = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.2.')->countAllResults();
        $data['org_pii'] = $model2->where('Type', 'PII')->findall();
        $dataid13 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '13')->where('namamk', 'kodeetik')->findall();
        if (!empty($dataid13)) {
            foreach ($dataid13 as $dataid) :
                $id13[] = $dataid['id_tbl'];
                $nilaip13[] = $dataid['nilaip'];
                $nilaiq13[] = $dataid['nilaiq'];
                $nilair13[] = $dataid['nilair'];
            endforeach;
        } else {
            $id13[] = '';
            $nilaip13[] = '';
            $nilaiq13[] = '';
            $nilair13[] = '';
        }
        $data['id13'] = $id13;
        $data['nilaip13'] = $nilaip13;
        $data['nilaiq13'] = $nilaiq13;
        $data['nilair13'] = $nilair13;

        if (!empty($org)) {
            $data['data_org'] = $org;
        } else {
            $data['data_org'] = 'kosong';
        }

        //Userfair14
        $model3 = new PenghargaanModel();
        $penghargaan = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.2.')->orderby('Year', 'DESC')->orderby('Month', 'DESC')->findall();
        $data['jumlah_harga'] = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.2.')->countAllResults();
        $dataid14 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '14')->where('namamk', 'kodeetik')->findall();
        if (!empty($dataid14)) {
            foreach ($dataid14 as $dataid) :
                $id14[] = $dataid['id_tbl'];
                $nilaip14[] = $dataid['nilaip'];
                $nilaiq14[] = $dataid['nilaiq'];
                $nilair14[] = $dataid['nilair'];
            endforeach;
        } else {
            $id14[] = '';
            $nilaip14[] = '';
            $nilaiq14[] = '';
            $nilair14[] = '';
        }
        $data['id14'] = $id14;
        $data['nilaip14'] = $nilaip14;
        $data['nilaiq14'] = $nilaiq14;
        $data['nilair14'] = $nilair14;

        if (!empty($penghargaan)) {
            $data['data_harga'] = $penghargaan;
        } else {
            $data['data_harga'] = 'kosong';
        }

        //Userfair16
        $model4 = new CapesSertModel();
        $latih = $model4->where('user_id', $mhs_id)->where('Jenis', 'sertifikat')->like('kompetensi', 'W.1.2.')->findall();
        $dataid16 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '16')->where('namamk', 'kodeetik')->findall();
        if (!empty($dataid16)) {
            foreach ($dataid16 as $dataid) :
                $id16[] = $dataid['id_tbl'];
                $nilaip16[] = $dataid['nilaip'];
                $nilaiq16[] = $dataid['nilaiq'];
                $nilair16[] = $dataid['nilair'];
            endforeach;
        } else {
            $id16[] = '';
            $nilaip16[] = '';
            $nilaiq16[] = '';
            $nilair16[] = '';
        }
        $data['id16'] = $id16;
        $data['nilaip16'] = $nilaip16;
        $data['nilaiq16'] = $nilaiq16;
        $data['nilair16'] = $nilair16;

        if (!empty($latih)) {
            $data['data_latih'] = $latih;
        } else {
            $data['data_latih'] = 'kosong';
        }

        $data['mhs_id'] = $mhs_id;
        $data['dosen_id'] = $dosen_id;
        $data['title_page'] = "Kode Etik dan Etika Profesi Insinyur";
        $data['data_bread'] = 'Kode Etik';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/nilairpl/docs/" . $mhs_id . '/' . $dosen_id . '">Nilai RPL</a></li><li class="breadcrumb-item active">Kode Etik</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/kodeetik', $data);
    }

    public function kodeetiksimpan()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $mhs_id = $this->request->getVar('mhs_id');
        $dosen_id = $this->request->getVar('dosen_id');

        $model = new NilairplModel();

        //Hapus data yang ada
        $model->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('namamk', 'kodeetik');
        $model->delete();

        //Simpan UserFair21
        $etik_index = $this->request->getVar('etik_index');
        if (!empty($etik_index)) {
            $etik_id = $this->request->getVar('etik_id');
            $nilaietik_p = $this->request->getVar('nilaietik_p');
            $nilaietik_q = $this->request->getVar('nilaietik_q');
            $nilaietik_r = $this->request->getVar('nilaietik_r');
            foreach ($etik_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $etik_id[$index],
                    'namatbl' => '21',
                    'namamk' => 'kodeetik',
                    'nilaip' => $nilaietik_p,
                    'nilaiq' => $nilaietik_q[$index],
                    'nilair' => $nilaietik_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair22
        $dapat_index = $this->request->getVar('dapat_index');
        if (!empty($dapat_index)) {
            $dapat_id = $this->request->getVar('dapat_id');
            $nilaidapat_p = $this->request->getVar('nilaidapat_p');
            $nilaidapat_q = $this->request->getVar('nilaidapat_q');
            $nilaidapat_r = $this->request->getVar('nilaidapat_r');
            foreach ($dapat_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $dapat_id[$index],
                    'namatbl' => '22',
                    'namamk' => 'kodeetik',
                    'nilaip' => $nilaidapat_p[$index],
                    'nilaiq' => $nilaidapat_q[$index],
                    'nilair' => $nilaidapat_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair13
        $org_index = $this->request->getVar('org_index');
        if (!empty($org_index)) {
            $org_id = $this->request->getVar('org_id');
            $nilaiorg_p = $this->request->getVar('nilaiorg_p');
            $nilaiorg_q = $this->request->getVar('nilaiorg_q');
            $nilaiorg_r = $this->request->getVar('nilaiorg_r');
            foreach ($org_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $org_id[$index],
                    'namatbl' => '13',
                    'namamk' => 'kodeetik',
                    'nilaip' => $nilaiorg_p,
                    'nilaiq' => $nilaiorg_q[$index],
                    'nilair' => $nilaiorg_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair14
        $penghargaan_index = $this->request->getVar('penghargaan_index');
        if (!empty($penghargaan_index)) {
            $penghargaan_id = $this->request->getVar('penghargaan_id');
            $nilaipenghargaan_p = $this->request->getVar('nilaipenghargaan_p');
            $nilaipenghargaan_q = $this->request->getVar('nilaipenghargaan_q');
            $nilaipenghargaan_r = $this->request->getVar('nilaipenghargaan_r');
            foreach ($penghargaan_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $penghargaan_id[$index],
                    'namatbl' => '14',
                    'namamk' => 'kodeetik',
                    'nilaip' => $nilaipenghargaan_p[$index],
                    'nilaiq' => $nilaipenghargaan_q[$index],
                    'nilair' => $nilaipenghargaan_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair16
        $latih_index = $this->request->getVar('latih_index');
        if (!empty($latih_index)) {
            $latih_id = $this->request->getVar('latih_id');
            $nilailatih_p = $this->request->getVar('nilailatih_p');
            $nilailatih_q = $this->request->getVar('nilailatih_q');
            $nilailatih_r = $this->request->getVar('nilailatih_r');
            foreach ($latih_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $latih_id[$index],
                    'namatbl' => '16',
                    'namamk' => 'kodeetik',
                    'nilaip' => $nilailatih_p[$index],
                    'nilaiq' => $nilailatih_q[$index],
                    'nilair' => $nilailatih_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        $session->setFlashdata('msg', 'Data MK Kode Etik berhasil disimpan.');
        return redirect()->to('nilairpl/docs/' . $mhs_id . '/' . $dosen_id);
    }

    public function profesi($mhs_id, $dosen_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $modelprof = new ProfileModel();
        $mhsprofile = $modelprof->where('user_id', $mhs_id)->first();
        if ($mhsprofile) {
            $data['FullName'] = $mhsprofile['FullName'];
        } else {
            $data['FullName'] = 'kosong';
        }

        $modelnilai = new NilairplModel();

        //UserFair3
        $model = new CapesKualifikasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $where = "user_id = '$mhs_id' AND (kompetensi LIKE '%W.1.1.%' OR kompetensi LIKE '%W.2.2.%')";
        $kerja = $model->where($where)->orderby('nilai_q', 'DESC')->orderby('ProjValue', 'DESC')->findall();
        //$kerja = $model->where('user_id', $mhs_id)->like('kompetensi', 'W.2.2.')->orderby('ProjValue', 'DESC')->findall();
        $dataid3 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '3')->where('namamk', 'profesi')->findall();
        if (!empty($dataid3)) {
            foreach ($dataid3 as $dataid) :
                $id3[] = $dataid['id_tbl'];
                $nilaip3[] = $dataid['nilaip'];
                $nilaiq3[] = $dataid['nilaiq'];
                $nilair3[] = $dataid['nilair'];
            endforeach;
        } else {
            $id3[] = '';
            $nilaip3[] = '';
            $nilaiq3[] = '';
            $nilair3[] = '';
        }
        $data['id3'] = $id3;
        $data['nilaip3'] = $nilaip3;
        $data['nilaiq3'] = $nilaiq3;
        $data['nilair3'] = $nilair3;

        if (!empty($kerja)) {
            $data['data_kerja'] = $kerja;
        } else {
            $data['data_kerja'] = 'kosong';
        }

        //UserFair12
        $model1 = new CapesPendModel();
        //$pend = $model1->where('user_id', $mhs_id)->like('kompetensi', 'W.2.2.')->orderby('GradYear', 'DESC')->findall();
        $pend = $model1->where($where)->orderby('GradYear', 'DESC')->findall();
        $dataid12 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '12')->where('namamk', 'profesi')->findall();
        if (!empty($dataid12)) {
            foreach ($dataid12 as $dataid) :
                $id12[] = $dataid['id_tbl'];
                $nilaip12[] = $dataid['nilaip'];
                $nilaiq12[] = $dataid['nilaiq'];
                $nilair12[] = $dataid['nilair'];
            endforeach;
        } else {
            $id12[] = '';
            $nilaip12[] = '';
            $nilaiq12[] = '';
            $nilair12[] = '';
        }
        $data['id12'] = $id12;
        $data['nilaip12'] = $nilaip12;
        $data['nilaiq12'] = $nilaiq12;
        $data['nilair12'] = $nilair12;

        if (!empty($pend)) {
            $data['data_pend'] = $pend;
        } else {
            $data['data_pend'] = 'kosong';
        }

        //UserFair13
        $model2 = new CapesOrgModel();
        //$org = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.1.')->orderby('StartPeriodYear', 'DESC')->findall();
        $org = $model2->where($where)->orderby('StartPeriodYear', 'DESC')->findall();
        //$data['jumlah_org'] = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.1.')->countAllResults();
        $data['jumlah_org'] = $model2->where($where)->countAllResults();
        $data['org_pii'] = $model2->where('Type', 'PII')->findall();
        $dataid13 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '13')->where('namamk', 'profesi')->findall();
        if (!empty($dataid13)) {
            foreach ($dataid13 as $dataid) :
                $id13[] = $dataid['id_tbl'];
                $nilaip13[] = $dataid['nilaip'];
                $nilaiq13[] = $dataid['nilaiq'];
                $nilair13[] = $dataid['nilair'];
            endforeach;
        } else {
            $id13[] = '';
            $nilaip13[] = '';
            $nilaiq13[] = '';
            $nilair13[] = '';
        }
        $data['id13'] = $id13;
        $data['nilaip13'] = $nilaip13;
        $data['nilaiq13'] = $nilaiq13;
        $data['nilair13'] = $nilair13;

        if (!empty($org)) {
            $data['data_org'] = $org;
        } else {
            $data['data_org'] = 'kosong';
        }

        //UserFair14
        $model3 = new PenghargaanModel();
        //$penghargaan = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.1.')->orderby('Year', 'DESC')->orderby('Month', 'DESC')->findall();
        $penghargaan = $model3->where($where)->orderby('Year', 'DESC')->orderby('Month', 'DESC')->findall();
        $data['jumlah_harga'] = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.1.')->countAllResults();
        $dataid14 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '14')->where('namamk', 'profesi')->findall();
        if (!empty($dataid14)) {
            foreach ($dataid14 as $dataid) :
                $id14[] = $dataid['id_tbl'];
                $nilaip14[] = $dataid['nilaip'];
                $nilaiq14[] = $dataid['nilaiq'];
                $nilair14[] = $dataid['nilair'];
            endforeach;
        } else {
            $id14[] = '';
            $nilaip14[] = '';
            $nilaiq14[] = '';
            $nilair14[] = '';
        }
        $data['id14'] = $id14;
        $data['nilaip14'] = $nilaip14;
        $data['nilaiq14'] = $nilaiq14;
        $data['nilair14'] = $nilair14;

        if (!empty($penghargaan)) {
            $data['data_harga'] = $penghargaan;
        } else {
            $data['data_harga'] = 'kosong';
        }

        //UserFair15
        $model4 = new CapesSertModel();
        //$latih = $model4->where('user_id', $mhs_id)->where('Jenis', 'pelatihan')->like('kompetensi', 'W.2.2.')->orderby('StartYear', 'DESC')->findall();
        $latih = $model4->where($where)->orderby('StartYear', 'DESC')->findall();
        $dataid15 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '15')->where('namamk', 'profesi')->findall();
        if (!empty($dataid15)) {
            foreach ($dataid15 as $dataid) :
                $id15[] = $dataid['id_tbl'];
                $nilaip15[] = $dataid['nilaip'];
                $nilaiq15[] = $dataid['nilaiq'];
                $nilair15[] = $dataid['nilair'];
            endforeach;
        } else {
            $id15[] = '';
            $nilaip15[] = '';
            $nilaiq15[] = '';
            $nilair15[] = '';
        }
        $data['id15'] = $id15;
        $data['nilaip15'] = $nilaip15;
        $data['nilaiq15'] = $nilaiq15;
        $data['nilair15'] = $nilair15;

        if (!empty($latih)) {
            $data['data_latih'] = $latih;
        } else {
            $data['data_latih'] = 'kosong';
        }

        //UserFair16
        //$latih1 = $model4->where('user_id', $mhs_id)->where('Jenis', 'sertifikat')->like('kompetensi', 'W.1.1.')->findall();
        $latih1 = $model4->where('Jenis', 'sertifikat')->where($where)->like('kompetensi', 'W.1.1.')->findall();
        $dataid16 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '16')->where('namamk', 'profesi')->findall();
        if (!empty($dataid16)) {
            foreach ($dataid16 as $dataid) :
                $id16[] = $dataid['id_tbl'];
                $nilaip16[] = $dataid['nilaip'];
                $nilaiq16[] = $dataid['nilaiq'];
                $nilair16[] = $dataid['nilair'];
            endforeach;
        } else {
            $id16[] = '';
            $nilaip16[] = '';
            $nilaiq16[] = '';
            $nilair16[] = '';
        }
        $data['id16'] = $id16;
        $data['nilaip16'] = $nilaip16;
        $data['nilaiq16'] = $nilaiq16;
        $data['nilair16'] = $nilair16;

        if (!empty($latih)) {
            $data['data_latih1'] = $latih1;
        } else {
            $data['data_latih1'] = 'kosong';
        }

        //UserFair4
        $model7 = new MengajarModel();
        //$ajar = $model7->where('user_id', $mhs_id)->like('kompetensi', 'W.2.2.')->orderby('StartPeriod', 'DESC')->findall();
        $ajar = $model7->where($where)->orderby('StartPeriod', 'DESC')->findall();
        $dataid4 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '4')->where('namamk', 'profesi')->findall();
        if (!empty($dataid4)) {
            foreach ($dataid4 as $dataid) :
                $id4[] = $dataid['id_tbl'];
                $nilaip4[] = $dataid['nilaip'];
                $nilaiq4[] = $dataid['nilaiq'];
                $nilair4[] = $dataid['nilair'];
            endforeach;
        } else {
            $id4[] = '';
            $nilaip4[] = '';
            $nilaiq4[] = '';
            $nilair4[] = '';
        }
        $data['id4'] = $id4;
        $data['nilaip4'] = $nilaip4;
        $data['nilaiq4'] = $nilaiq4;
        $data['nilair4'] = $nilair4;

        if (!empty($ajar)) {
            $data['data_ajar'] = $ajar;
        } else {
            $data['data_ajar'] = 'kosong';
        }

        //UserFair53
        $model8 = new CapesSemModel();
        //$sem = $model8->where('user_id', $mhs_id)->where('Type', 'Sem')->like('kompetensi', 'W.2.2.')->orderby('Year', 'DESC')->findall();
        $sem = $model8->where('Type', 'Sem')->where($where)->orderby('Year', 'DESC')->findall();
        $dataid53 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '53')->where('namamk', 'profesi')->findall();
        if (!empty($dataid53)) {
            foreach ($dataid53 as $dataid) :
                $id53[] = $dataid['id_tbl'];
                $nilaip53[] = $dataid['nilaip'];
                $nilaiq53[] = $dataid['nilaiq'];
                $nilair53[] = $dataid['nilair'];
            endforeach;
        } else {
            $id53[] = '';
            $nilaip53[] = '';
            $nilaiq53[] = '';
            $nilair53[] = '';
        }
        $data['id53'] = $id53;
        $data['nilaip53'] = $nilaip53;
        $data['nilaiq53'] = $nilaiq53;
        $data['nilair53'] = $nilair53;

        if (!empty($sem)) {
            $data['data_sem'] = $sem;
        } else {
            $data['data_sem'] = 'kosong';
        }

        $data['mhs_id'] = $mhs_id;
        $data['dosen_id'] = $dosen_id;
        $data['title_page'] = "Profesionalisme";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/nilairpl/docs/" . $mhs_id . '/' . $dosen_id . '">Nilai RPL</a></li><li class="breadcrumb-item active">Profesionalisme</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/profesi', $data);
    }

    public function profesisimpan()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $mhs_id = $this->request->getVar('mhs_id');
        $dosen_id = $this->request->getVar('dosen_id');

        $model = new NilairplModel();

        //Hapus data yang ada
        $model->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('namamk', 'profesi');
        $model->delete();

        //Simpan UserFair3
        $kerja_index = $this->request->getVar('kerja_index');
        if (!empty($kerja_index)) {
            $kerja_id = $this->request->getVar('kerja_id');
            $nilaikerja_p = $this->request->getVar('nilaikerja_p');
            $nilaikerja_q = $this->request->getVar('nilaikerja_q');
            $nilaikerja_r = $this->request->getVar('nilaikerja_r');
            foreach ($kerja_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $kerja_id[$index],
                    'namatbl' => '3',
                    'namamk' => 'profesi',
                    'nilaip' => $nilaikerja_p[$index],
                    'nilaiq' => $nilaikerja_q[$index],
                    'nilair' => $nilaikerja_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair12
        $pend_index = $this->request->getVar('pend_index');
        if (!empty($pend_index)) {
            $pend_id = $this->request->getVar('pend_id');
            $nilaipend_p = $this->request->getVar('nilaipend_p');
            $nilaipend_q = $this->request->getVar('nilaipend_q');
            $nilaipend_r = $this->request->getVar('nilaipend_r');
            foreach ($pend_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $pend_id[$index],
                    'namatbl' => '12',
                    'namamk' => 'profesi',
                    'nilaip' => $nilaipend_p[$index],
                    'nilaiq' => $nilaipend_q[$index],
                    'nilair' => $nilaipend_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair13
        $org_index = $this->request->getVar('org_index');
        if (!empty($org_index)) {
            $org_id = $this->request->getVar('org_id');
            $nilaiorg_p = $this->request->getVar('nilaiorg_p');
            $nilaiorg_q = $this->request->getVar('nilaiorg_q');
            $nilaiorg_r = $this->request->getVar('nilaiorg_r');
            foreach ($org_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $org_id[$index],
                    'namatbl' => '13',
                    'namamk' => 'profesi',
                    'nilaip' => $nilaiorg_p,
                    'nilaiq' => $nilaiorg_q[$index],
                    'nilair' => $nilaiorg_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair14
        $penghargaan_index = $this->request->getVar('penghargaan_index');
        if (!empty($penghargaan_index)) {
            $penghargaan_id = $this->request->getVar('penghargaan_id');
            $nilaipenghargaan_p = $this->request->getVar('nilaipenghargaan_p');
            $nilaipenghargaan_q = $this->request->getVar('nilaipenghargaan_q');
            $nilaipenghargaan_r = $this->request->getVar('nilaipenghargaan_r');
            foreach ($penghargaan_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $penghargaan_id[$index],
                    'namatbl' => '14',
                    'namamk' => 'profesi',
                    'nilaip' => $nilaipenghargaan_p[$index],
                    'nilaiq' => $nilaipenghargaan_q[$index],
                    'nilair' => $nilaipenghargaan_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair15
        $latih_index = $this->request->getVar('latih_index');
        if (!empty($latih_index)) {
            $latih_id = $this->request->getVar('latih_id');
            $nilailatih_p = $this->request->getVar('nilailatih_p');
            $nilailatih_q = $this->request->getVar('nilailatih_q');
            $nilailatih_r = $this->request->getVar('nilailatih_r');
            foreach ($latih_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $latih_id[$index],
                    'namatbl' => '15',
                    'namamk' => 'profesi',
                    'nilaip' => $nilailatih_p[$index],
                    'nilaiq' => $nilailatih_q[$index],
                    'nilair' => $nilailatih_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair16
        $latih1_index = $this->request->getVar('latih1_index');
        if (!empty($latih1_index)) {
            $latih1_id = $this->request->getVar('latih1_id');
            $nilailatih1_p = $this->request->getVar('nilailatih1_p');
            $nilailatih1_q = $this->request->getVar('nilailatih1_q');
            $nilailatih1_r = $this->request->getVar('nilailatih1_r');
            foreach ($latih1_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $latih1_id[$index],
                    'namatbl' => '16',
                    'namamk' => 'profesi',
                    'nilaip' => $nilailatih1_p[$index],
                    'nilaiq' => $nilailatih1_q[$index],
                    'nilair' => $nilailatih1_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair4
        $ajar_index = $this->request->getVar('ajar_index');
        if (!empty($ajar_index)) {
            $ajar_id = $this->request->getVar('ajar_id');
            $nilaiajar_p = $this->request->getVar('nilaiajar_p');
            $nilaiajar_q = $this->request->getVar('nilaiajar_q');
            $nilaiajar_r = $this->request->getVar('nilaiajar_r');
            foreach ($ajar_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $ajar_id[$index],
                    'namatbl' => '4',
                    'namamk' => 'profesi',
                    'nilaip' => $nilaiajar_p[$index],
                    'nilaiq' => $nilaiajar_q[$index],
                    'nilair' => $nilaiajar_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair53
        $sem_index = $this->request->getVar('sem_index');
        if (!empty($sem_index)) {
            $sem_id = $this->request->getVar('sem_id');
            $nilaisem_p = $this->request->getVar('nilaisem_p');
            $nilaisem_q = $this->request->getVar('nilaisem_q');
            $nilaisem_r = $this->request->getVar('nilaisem_r');
            foreach ($sem_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $sem_id[$index],
                    'namatbl' => '53',
                    'namamk' => 'profesi',
                    'nilaip' => $nilaisem_p[$index],
                    'nilaiq' => $nilaisem_q[$index],
                    'nilair' => $nilaisem_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        $session->setFlashdata('msg', 'Data MK Profesionalisme berhasil disimpan.');
        return redirect()->to('nilairpl/docs/' . $mhs_id . '/' . $dosen_id);
    }

    public function k3lh($mhs_id, $dosen_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $modelprof = new ProfileModel();
        $mhsprofile = $modelprof->where('user_id', $mhs_id)->first();
        if ($mhsprofile) {
            $data['FullName'] = $mhsprofile['FullName'];
        } else {
            $data['FullName'] = 'kosong';
        }

        $modelnilai = new NilairplModel();

        //UserFair13
        $model2 = new CapesOrgModel();
        $where = "user_id = '$mhs_id' AND (kompetensi LIKE '%W.1.3.%' OR kompetensi LIKE '%W.1.4.%' OR kompetensi LIKE '%P.8.3.6%' OR kompetensi LIKE '%P.10.2.1%' OR kompetensi LIKE '%P.11.3.%' OR kompetensi LIKE '%W.2.%' OR kompetensi LIKE '%W.3.1.5%' OR kompetensi LIKE '%W.4.5.%' OR kompetensi LIKE '%P.9.1.%' OR kompetensi LIKE '%P.9.4.%' OR kompetensi LIKE '%P.11.1.2%')";
        //$org = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.3.')->orderby('StartPeriodYear', 'DESC')->findall();
        //$data['jumlah_org'] = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.3.')->countAllResults();
        $org = $model2->where($where)->orderby('StartPeriodYear', 'DESC')->findall();
        $data['jumlah_org'] = $model2->where($where)->countAllResults();
        $data['org_pii'] = $model2->where('Type', 'PII')->findall();
        $dataid13 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '13')->where('namamk', 'k3lh')->findall();
        if (!empty($dataid13)) {
            foreach ($dataid13 as $dataid) :
                $id13[] = $dataid['id_tbl'];
                $nilaip13[] = $dataid['nilaip'];
                $nilaiq13[] = $dataid['nilaiq'];
                $nilair13[] = $dataid['nilair'];
            endforeach;
        } else {
            $id13[] = '';
            $nilaip13[] = '';
            $nilaiq13[] = '';
            $nilair13[] = '';
        }
        $data['id13'] = $id13;
        $data['nilaip13'] = $nilaip13;
        $data['nilaiq13'] = $nilaiq13;
        $data['nilair13'] = $nilair13;

        if (!empty($org)) {
            $data['data_org'] = $org;
        } else {
            $data['data_org'] = 'kosong';
        }

        //UserFair14
        $model3 = new PenghargaanModel();
        //$penghargaan = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.3.')->orderby('Year', 'DESC')->orderby('Month', 'DESC')->findall();
        //$data['jumlah_harga'] = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.3.')->countAllResults();
        $penghargaan = $model3->where($where)->orderby('Year', 'DESC')->orderby('Month', 'DESC')->findall();
        $data['jumlah_harga'] = $model3->where($where)->countAllResults();
        $dataid14 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '14')->where('namamk', 'k3lh')->findall();
        if (!empty($dataid14)) {
            foreach ($dataid14 as $dataid) :
                $id14[] = $dataid['id_tbl'];
                $nilaip14[] = $dataid['nilaip'];
                $nilaiq14[] = $dataid['nilaiq'];
                $nilair14[] = $dataid['nilair'];
            endforeach;
        } else {
            $id14[] = '';
            $nilaip14[] = '';
            $nilaiq14[] = '';
            $nilair14[] = '';
        }
        $data['id14'] = $id14;
        $data['nilaip14'] = $nilaip14;
        $data['nilaiq14'] = $nilaiq14;
        $data['nilair14'] = $nilair14;

        if (!empty($penghargaan)) {
            $data['data_harga'] = $penghargaan;
        } else {
            $data['data_harga'] = 'kosong';
        }

        //UserFair16
        $model4 = new CapesSertModel();
        //$latih1 = $model4->where('user_id', $mhs_id)->where('Jenis', 'sertifikat')->like('kompetensi', 'W.1.3.')->findall();
        $latih1 = $model4->where('Jenis', 'sertifikat')->where($where)->findall();
        $dataid16 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '16')->where('namamk', 'k3lh')->findall();
        if (!empty($dataid16)) {
            foreach ($dataid16 as $dataid) :
                $id16[] = $dataid['id_tbl'];
                $nilaip16[] = $dataid['nilaip'];
                $nilaiq16[] = $dataid['nilaiq'];
                $nilair16[] = $dataid['nilair'];
            endforeach;
        } else {
            $id16[] = '';
            $nilaip16[] = '';
            $nilaiq16[] = '';
            $nilair16[] = '';
        }
        $data['id16'] = $id16;
        $data['nilaip16'] = $nilaip16;
        $data['nilaiq16'] = $nilaiq16;
        $data['nilair16'] = $nilair16;

        if (!empty($latih1)) {
            $data['data_latih1'] = $latih1;
        } else {
            $data['data_latih1'] = 'kosong';
        }

        $data['mhs_id'] = $mhs_id;
        $data['dosen_id'] = $dosen_id;
        $data['title_page'] = "Keselamatan, Kesehatan, Keamanan Kerja dan Lingkungan";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/nilairpl/docs/" . $mhs_id . '/' . $dosen_id . '">Nilai RPL</a></li><li class="breadcrumb-item active">K3LH</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/k3lh', $data);
    }

    public function k3lhsimpan()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $mhs_id = $this->request->getVar('mhs_id');
        $dosen_id = $this->request->getVar('dosen_id');

        $model = new NilairplModel();

        //Hapus data yang ada
        $model->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('namamk', 'k3lh');
        $model->delete();

        //Simpan UserFair13
        $org_index = $this->request->getVar('org_index');
        if (!empty($org_index)) {
            $org_id = $this->request->getVar('org_id');
            $nilaiorg_p = $this->request->getVar('nilaiorg_p');
            $nilaiorg_q = $this->request->getVar('nilaiorg_q');
            $nilaiorg_r = $this->request->getVar('nilaiorg_r');
            foreach ($org_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $org_id[$index],
                    'namatbl' => '13',
                    'namamk' => 'k3lh',
                    'nilaip' => $nilaiorg_p,
                    'nilaiq' => $nilaiorg_q[$index],
                    'nilair' => $nilaiorg_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair14
        $penghargaan_index = $this->request->getVar('penghargaan_index');
        if (!empty($penghargaan_index)) {
            $penghargaan_id = $this->request->getVar('penghargaan_id');
            $nilaipenghargaan_p = $this->request->getVar('nilaipenghargaan_p');
            $nilaipenghargaan_q = $this->request->getVar('nilaipenghargaan_q');
            $nilaipenghargaan_r = $this->request->getVar('nilaipenghargaan_r');
            foreach ($penghargaan_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $penghargaan_id[$index],
                    'namatbl' => '14',
                    'namamk' => 'k3lh',
                    'nilaip' => $nilaipenghargaan_p[$index],
                    'nilaiq' => $nilaipenghargaan_q[$index],
                    'nilair' => $nilaipenghargaan_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair16
        $latih_index = $this->request->getVar('latih_index');
        if (!empty($latih_index)) {
            $latih_id = $this->request->getVar('latih_id');
            $nilailatih_p = $this->request->getVar('nilailatih_p');
            $nilailatih_q = $this->request->getVar('nilailatih_q');
            $nilailatih_r = $this->request->getVar('nilailatih_r');
            foreach ($latih_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $latih_id[$index],
                    'namatbl' => '16',
                    'namamk' => 'k3lh',
                    'nilaip' => $nilailatih_p[$index],
                    'nilaiq' => $nilailatih_q[$index],
                    'nilair' => $nilailatih_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        $session->setFlashdata('msg', 'Data MK Keselamatan, Kesehatan, Keamanan Kerja dan Lingkungan berhasil disimpan.');
        return redirect()->to('nilairpl/docs/' . $mhs_id . '/' . $dosen_id);
    }

    public function seminar($mhs_id, $dosen_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $modelprof = new ProfileModel();
        $mhsprofile = $modelprof->where('user_id', $mhs_id)->first();
        if ($mhsprofile) {
            $data['FullName'] = $mhsprofile['FullName'];
        } else {
            $data['FullName'] = 'kosong';
        }

        $modelnilai = new NilairplModel();

        //USerFair51
        $model = new CapesKartulModel();
        $where = "user_id = '$mhs_id' AND (kompetensi LIKE '%W.4.4.%' OR kompetensi LIKE '%W.4.5.%')";
        $kartul = $model->where($where)->orderby('Year', 'DESC')->findall();
        //$kartul = $model->where('user_id', $mhs_id)->like('kompetensi', 'W.4.4.')->orderby('Year', 'DESC')->findall();
        $dataid51 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '51')->where('namamk', 'seminar')->findall();
        if (!empty($dataid51)) {
            foreach ($dataid51 as $dataid) :
                $id51[] = $dataid['id_tbl'];
                $nilaip51[] = $dataid['nilaip'];
                $nilaiq51[] = $dataid['nilaiq'];
                $nilair51[] = $dataid['nilair'];
            endforeach;
        } else {
            $id51[] = '';
            $nilaip51[] = '';
            $nilaiq51[] = '';
            $nilair51[] = '';
        }
        $data['id51'] = $id51;
        $data['nilaip51'] = $nilaip51;
        $data['nilaiq51'] = $nilaiq51;
        $data['nilair51'] = $nilair51;

        if (!empty($kartul)) {
            $data['data_kartul'] = $kartul;
        } else {
            $data['data_kartul'] = 'kosong';
        }

        //UserFair52
        $model1 = new CapesSemModel();
        //$sem = $model1->where('user_id', $mhs_id)->where('Type', 'Mak')->like('kompetensi', 'W.4.4.')->orderby('Year', 'DESC')->findall();
        $sem = $model1->where('Type', 'Mak')->where($where)->orderby('Year', 'DESC')->findall();
        $dataid52 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '52')->where('namamk', 'seminar')->findall();
        if (!empty($dataid52)) {
            foreach ($dataid52 as $dataid) :
                $id52[] = $dataid['id_tbl'];
                $nilaip52[] = $dataid['nilaip'];
                $nilaiq52[] = $dataid['nilaiq'];
                $nilair52[] = $dataid['nilair'];
            endforeach;
        } else {
            $id52[] = '';
            $nilaip52[] = '';
            $nilaiq52[] = '';
            $nilair52[] = '';
        }
        $data['id52'] = $id52;
        $data['nilaip52'] = $nilaip52;
        $data['nilaiq52'] = $nilaiq52;
        $data['nilair52'] = $nilair52;

        if (!empty($sem)) {
            $data['data_sem'] = $sem;
        } else {
            $data['data_sem'] = 'kosong';
        }

        //UserFair4
        $model2 = new MengajarModel();
        //$ajar = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.4.4.')->orderby('StartPeriod', 'DESC')->findall();
        $ajar = $model2->where($where)->orderby('StartPeriod', 'DESC')->findall();
        $dataid4 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '4')->where('namamk', 'seminar')->findall();
        if (!empty($dataid4)) {
            foreach ($dataid4 as $dataid) :
                $id4[] = $dataid['id_tbl'];
                $nilaip4[] = $dataid['nilaip'];
                $nilaiq4[] = $dataid['nilaiq'];
                $nilair4[] = $dataid['nilair'];
            endforeach;
        } else {
            $id4[] = '';
            $nilaip4[] = '';
            $nilaiq4[] = '';
            $nilair4[] = '';
        }
        $data['id4'] = $id4;
        $data['nilaip4'] = $nilaip4;
        $data['nilaiq4'] = $nilaiq4;
        $data['nilair4'] = $nilair4;

        if (!empty($ajar)) {
            $data['data_ajar'] = $ajar;
        } else {
            $data['data_ajar'] = 'kosong';
        }

        //UserFair3
        $model3 = new CapesKualifikasiModel();
        //$kerja = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.4.4.')->orderby('ProjValue', 'DESC')->findall();
        $kerja = $model3->where($where)->orderby('ProjValue', 'DESC')->findall();
        $dataid3 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '3')->where('namamk', 'seminar')->findall();
        if (!empty($dataid3)) {
            foreach ($dataid3 as $dataid) :
                $id3[] = $dataid['id_tbl'];
                $nilaip3[] = $dataid['nilaip'];
                $nilaiq3[] = $dataid['nilaiq'];
                $nilair3[] = $dataid['nilair'];
            endforeach;
        } else {
            $id3[] = '';
            $nilaip3[] = '';
            $nilaiq3[] = '';
            $nilair3[] = '';
        }
        $data['id3'] = $id3;
        $data['nilaip3'] = $nilaip3;
        $data['nilaiq3'] = $nilaiq3;
        $data['nilair3'] = $nilair3;

        if (!empty($kerja)) {
            $data['data_kerja'] = $kerja;
        } else {
            $data['data_kerja'] = 'kosong';
        }

        //UserFair15
        $model4 = new CapesSertModel();
        //$latih = $model4->where('user_id', $mhs_id)->where('Jenis', 'pelatihan')->like('kompetensi', 'W.4.4.')->orderby('StartYear', 'DESC')->findall();
        $latih = $model4->where('Jenis', 'pelatihan')->where($where)->orderby('StartYear', 'DESC')->findall();
        $dataid15 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '15')->where('namamk', 'seminar')->findall();
        if (!empty($dataid15)) {
            foreach ($dataid15 as $dataid) :
                $id15[] = $dataid['id_tbl'];
                $nilaip15[] = $dataid['nilaip'];
                $nilaiq15[] = $dataid['nilaiq'];
                $nilair15[] = $dataid['nilair'];
            endforeach;
        } else {
            $id15[] = '';
            $nilaip15[] = '';
            $nilaiq15[] = '';
            $nilair15[] = '';
        }
        $data['id15'] = $id15;
        $data['nilaip15'] = $nilaip15;
        $data['nilaiq15'] = $nilaiq15;
        $data['nilair15'] = $nilair15;

        if (!empty($latih)) {
            $data['data_latih'] = $latih;
        } else {
            $data['data_latih'] = 'kosong';
        }

        //UserFair16
        //$latih1 = $model4->where('user_id', $mhs_id)->where('Jenis', 'sertifikat')->like('kompetensi', 'W.4.4.')->findall();
        $latih1 = $model4->where('Jenis', 'sertifikat')->where($where)->findall();
        $dataid16 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '16')->where('namamk', 'seminar')->findall();
        if (!empty($dataid16)) {
            foreach ($dataid16 as $dataid) :
                $id16[] = $dataid['id_tbl'];
                $nilaip16[] = $dataid['nilaip'];
                $nilaiq16[] = $dataid['nilaiq'];
                $nilair16[] = $dataid['nilair'];
            endforeach;
        } else {
            $id16[] = '';
            $nilaip16[] = '';
            $nilaiq16[] = '';
            $nilair16[] = '';
        }
        $data['id16'] = $id16;
        $data['nilaip16'] = $nilaip16;
        $data['nilaiq16'] = $nilaiq16;
        $data['nilair16'] = $nilair16;

        if (!empty($latih1)) {
            $data['data_latih1'] = $latih1;
        } else {
            $data['data_latih1'] = 'kosong';
        }

        //UserFair6
        $model5 = new BahasaModel();
        //$bahasa = $model5->where('user_id', $mhs_id)->like('kompetensi', 'W.4.4.')->orderby('Num', 'DESC')->findall();
        $bahasa = $model5->where($where)->orderby('Num', 'DESC')->findall();
        // $data['jml_bahasa'] = $model5->where('user_id', $mhs_id)->like('kompetensi', 'W.4.4.')->countAllResults();
        $data['jml_bahasa'] = $model5->where($where)->countAllResults();
        $dataid6 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '6')->where('namamk', 'seminar')->findall();
        if (!empty($dataid6)) {
            foreach ($dataid6 as $dataid) :
                $id6[] = $dataid['id_tbl'];
                $nilaip6[] = $dataid['nilaip'];
                $nilaiq6[] = $dataid['nilaiq'];
                $nilair6[] = $dataid['nilair'];
            endforeach;
        } else {
            $id6[] = '';
            $nilaip6[] = '';
            $nilaiq6[] = '';
            $nilair6[] = '';
        }
        $data['id6'] = $id6;
        $data['nilaip6'] = $nilaip6;
        $data['nilaiq6'] = $nilaiq6;
        $data['nilair6'] = $nilair6;

        if (!empty($bahasa)) {
            $data['data_bahasa'] = $bahasa;
        } else {
            $data['data_bahasa'] = 'kosong';
        }

        $data['mhs_id'] = $mhs_id;
        $data['dosen_id'] = $dosen_id;
        $data['title_page'] = "Seminar";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/nilairpl/docs/" . $mhs_id . '/' . $dosen_id . '">Nilai RPL</a></li><li class="breadcrumb-item active">Seminar</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/seminar', $data);
    }

    public function seminarsimpan()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $mhs_id = $this->request->getVar('mhs_id');
        $dosen_id = $this->request->getVar('dosen_id');

        $model = new NilairplModel();

        //Hapus data yang ada
        $model->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('namamk', 'seminar');
        $model->delete();

        //Simpan UserFair51
        $kartul_index = $this->request->getVar('kartul_index');
        if (!empty($kartul_index)) {
            $kartul_id = $this->request->getVar('kartul_id');
            $nilaikartul_p = $this->request->getVar('nilaikartul_p');
            $nilaikartul_q = $this->request->getVar('nilaikartul_q');
            $nilaikartul_r = $this->request->getVar('nilaikartul_r');
            foreach ($kartul_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $kartul_id[$index],
                    'namatbl' => '51',
                    'namamk' => 'seminar',
                    'nilaip' => $nilaikartul_p[$index],
                    'nilaiq' => $nilaikartul_q[$index],
                    'nilair' => $nilaikartul_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair52
        $sem_index = $this->request->getVar('sem_index');
        if (!empty($sem_index)) {
            $sem_id = $this->request->getVar('sem_id');
            $nilaisem_p = $this->request->getVar('nilaisem_p');
            $nilaisem_q = $this->request->getVar('nilaisem_q');
            $nilaisem_r = $this->request->getVar('nilaisem_r');
            foreach ($sem_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $sem_id[$index],
                    'namatbl' => '52',
                    'namamk' => 'seminar',
                    'nilaip' => $nilaisem_p[$index],
                    'nilaiq' => $nilaisem_q[$index],
                    'nilair' => $nilaisem_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair4
        $ajar_index = $this->request->getVar('ajar_index');
        if (!empty($ajar_index)) {
            $ajar_id = $this->request->getVar('ajar_id');
            $nilaiajar_p = $this->request->getVar('nilaiajar_p');
            $nilaiajar_q = $this->request->getVar('nilaiajar_q');
            $nilaiajar_r = $this->request->getVar('nilaiajar_r');
            foreach ($ajar_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $ajar_id[$index],
                    'namatbl' => '4',
                    'namamk' => 'seminar',
                    'nilaip' => $nilaiajar_p[$index],
                    'nilaiq' => $nilaiajar_q[$index],
                    'nilair' => $nilaiajar_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair3
        $kerja_index = $this->request->getVar('kerja_index');
        if (!empty($kerja_index)) {
            $kerja_id = $this->request->getVar('kerja_id');
            $nilaikerja_p = $this->request->getVar('nilaikerja_p');
            $nilaikerja_q = $this->request->getVar('nilaikerja_q');
            $nilaikerja_r = $this->request->getVar('nilaikerja_r');
            foreach ($kerja_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $kerja_id[$index],
                    'namatbl' => '3',
                    'namamk' => 'seminar',
                    'nilaip' => $nilaikerja_p[$index],
                    'nilaiq' => $nilaikerja_q[$index],
                    'nilair' => $nilaikerja_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair15
        $latih_index = $this->request->getVar('latih_index');
        if (!empty($latih_index)) {
            $latih_id = $this->request->getVar('latih_id');
            $nilailatih_p = $this->request->getVar('nilailatih_p');
            $nilailatih_q = $this->request->getVar('nilailatih_q');
            $nilailatih_r = $this->request->getVar('nilailatih_r');
            foreach ($latih_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $latih_id[$index],
                    'namatbl' => '15',
                    'namamk' => 'seminar',
                    'nilaip' => $nilailatih_p[$index],
                    'nilaiq' => $nilailatih_q[$index],
                    'nilair' => $nilailatih_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair16
        $latih1_index = $this->request->getVar('latih1_index');
        if (!empty($latih1_index)) {
            $latih1_id = $this->request->getVar('latih1_id');
            $nilailatih1_p = $this->request->getVar('nilailatih1_p');
            $nilailatih1_q = $this->request->getVar('nilailatih1_q');
            $nilailatih1_r = $this->request->getVar('nilailatih1_r');
            foreach ($latih1_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $latih1_id[$index],
                    'namatbl' => '16',
                    'namamk' => 'seminar',
                    'nilaip' => $nilailatih1_p[$index],
                    'nilaiq' => $nilailatih1_q[$index],
                    'nilair' => $nilailatih1_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair6
        $bahasa_index = $this->request->getVar('bahasa_index');
        if (!empty($bahasa_index)) {
            $bahasa_id = $this->request->getVar('bahasa_id');
            $nilaibahasa_p = $this->request->getVar('nilaibahasa_p');
            $nilaibahasa_q = $this->request->getVar('nilaibahasa_q');
            $nilaibahasa_r = $this->request->getVar('nilaibahasa_r');
            foreach ($bahasa_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $bahasa_id[$index],
                    'namatbl' => '6',
                    'namamk' => 'seminar',
                    'nilaip' => $nilaibahasa_p,
                    'nilaiq' => $nilaibahasa_q[$index],
                    'nilair' => $nilaibahasa_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        $session->setFlashdata('msg', 'Data MK Seminar berhasil disimpan.');
        return redirect()->to('nilairpl/docs/' . $mhs_id . '/' . $dosen_id);
    }

    public function studikasus($mhs_id, $dosen_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $modelprof = new ProfileModel();
        $mhsprofile = $modelprof->where('user_id', $mhs_id)->first();
        if ($mhsprofile) {
            $data['FullName'] = $mhsprofile['FullName'];
        } else {
            $data['FullName'] = 'kosong';
        }

        $modelnilai = new NilairplModel();

        //UserFair3
        $model = new CapesKualifikasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $where = "user_id='$mhs_id' AND (kompetensi LIKE '%W.2.1.%' OR kompetensi LIKE '%W.2.3.%' OR kompetensi LIKE '%W.2.4.%' OR kompetensi LIKE '%W.2.5.%' OR kompetensi LIKE '%W.2.6.%' OR kompetensi LIKE '%W.3.1.%' OR kompetensi LIKE '%W.3.2.%' OR kompetensi LIKE '%W.3.3.%' OR kompetensi LIKE '%W.3.4.%' OR kompetensi LIKE '%W.3.5.%' OR kompetensi LIKE '%W.3.6.%' OR kompetensi LIKE '%W.4.1.%' OR kompetensi LIKE '%W.4.2.%' OR kompetensi LIKE '%W.4.3.%')";
        //$kerja = $model->where('user_id', $mhs_id)->like('kompetensi', 'W.2.1.')->orderby('ProjValue', 'DESC')->findall();
        $kerja = $model->where($where)->orderby('ProjValue', 'DESC')->findall();
        $dataid3 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '3')->where('namamk', 'studikasus')->findall();
        if (!empty($dataid3)) {
            foreach ($dataid3 as $dataid) :
                $id3[] = $dataid['id_tbl'];
                $nilaip3[] = $dataid['nilaip'];
                $nilaiq3[] = $dataid['nilaiq'];
                $nilair3[] = $dataid['nilair'];
            endforeach;
        } else {
            $id3[] = '';
            $nilaip3[] = '';
            $nilaiq3[] = '';
            $nilair3[] = '';
        }
        $data['id3'] = $id3;
        $data['nilaip3'] = $nilaip3;
        $data['nilaiq3'] = $nilaiq3;
        $data['nilair3'] = $nilair3;

        if (!empty($kerja)) {
            $data['data_kerja'] = $kerja;
        } else {
            $data['data_kerja'] = 'kosong';
        }

        //UserFair4
        $model2 = new MengajarModel();
        //$ajar = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.2.1.')->orderby('StartPeriod', 'DESC')->findall();
        $ajar = $model2->where($where)->orderby('StartPeriod', 'DESC')->findall();
        $dataid4 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '4')->where('namamk', 'studikasus')->findall();
        if (!empty($dataid4)) {
            foreach ($dataid4 as $dataid) :
                $id4[] = $dataid['id_tbl'];
                $nilaip4[] = $dataid['nilaip'];
                $nilaiq4[] = $dataid['nilaiq'];
                $nilair4[] = $dataid['nilair'];
            endforeach;
        } else {
            $id4[] = '';
            $nilaip4[] = '';
            $nilaiq4[] = '';
            $nilair4[] = '';
        }
        $data['id4'] = $id4;
        $data['nilaip4'] = $nilaip4;
        $data['nilaiq4'] = $nilaiq4;
        $data['nilair4'] = $nilair4;

        if (!empty($ajar)) {
            $data['data_ajar'] = $ajar;
        } else {
            $data['data_ajar'] = 'kosong';
        }

        //USerFair51
        $model3 = new CapesKartulModel();
        //$kartul = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.4.')->orderby('Year', 'DESC')->findall();
        $kartul = $model3->where($where)->orderby('Year', 'DESC')->findall();
        $dataid51 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '51')->where('namamk', 'studikasus')->findall();
        if (!empty($dataid51)) {
            foreach ($dataid51 as $dataid) :
                $id51[] = $dataid['id_tbl'];
                $nilaip51[] = $dataid['nilaip'];
                $nilaiq51[] = $dataid['nilaiq'];
                $nilair51[] = $dataid['nilair'];
            endforeach;
        } else {
            $id51[] = '';
            $nilaip51[] = '';
            $nilaiq51[] = '';
            $nilair51[] = '';
        }
        $data['id51'] = $id51;
        $data['nilaip51'] = $nilaip51;
        $data['nilaiq51'] = $nilaiq51;
        $data['nilair51'] = $nilair51;

        if (!empty($kartul)) {
            $data['data_kartul'] = $kartul;
        } else {
            $data['data_kartul'] = 'kosong';
        }

        //UserFair52
        $model4 = new CapesSemModel();
        //$sem = $model4->where('user_id', $mhs_id)->where('Type', 'Mak')->like('kompetensi', 'W.4.')->orderby('Year', 'DESC')->findall();
        $sem = $model4->where('Type', 'Mak')->where($where)->orderby('Year', 'DESC')->findall();
        $dataid52 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '52')->where('namamk', 'studikasus')->findall();
        if (!empty($dataid52)) {
            foreach ($dataid52 as $dataid) :
                $id52[] = $dataid['id_tbl'];
                $nilaip52[] = $dataid['nilaip'];
                $nilaiq52[] = $dataid['nilaiq'];
                $nilair52[] = $dataid['nilair'];
            endforeach;
        } else {
            $id52[] = '';
            $nilaip52[] = '';
            $nilaiq52[] = '';
            $nilair52[] = '';
        }
        $data['id52'] = $id52;
        $data['nilaip52'] = $nilaip52;
        $data['nilaiq52'] = $nilaiq52;
        $data['nilair52'] = $nilair52;

        if (!empty($sem)) {
            $data['data_sem'] = $sem;
        } else {
            $data['data_sem'] = 'kosong';
        }

        //UserFair53
        //$sem1 = $model4->where('user_id', $mhs_id)->where('Type', 'Sem')->like('kompetensi', 'W.2.1.')->orderby('Year', 'DESC')->findall();
        $sem1 = $model4->where('Type', 'Sem')->where($where)->orderby('Year', 'DESC')->findall();
        $dataid53 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '53')->where('namamk', 'studikasus')->findall();
        if (!empty($dataid53)) {
            foreach ($dataid53 as $dataid) :
                $id53[] = $dataid['id_tbl'];
                $nilaip53[] = $dataid['nilaip'];
                $nilaiq53[] = $dataid['nilaiq'];
                $nilair53[] = $dataid['nilair'];
            endforeach;
        } else {
            $id53[] = '';
            $nilaip53[] = '';
            $nilaiq53[] = '';
            $nilair53[] = '';
        }
        $data['id53'] = $id53;
        $data['nilaip53'] = $nilaip53;
        $data['nilaiq53'] = $nilaiq53;
        $data['nilair53'] = $nilair53;

        if (!empty($sem1)) {
            $data['data_sem1'] = $sem1;
        } else {
            $data['data_sem1'] = 'kosong';
        }

        //UserFair12
        $model5 = new CapesPendModel();
        //$pend = $model5->where('user_id', $mhs_id)->like('kompetensi', 'W.2.1.')->orderby('GradYear', 'DESC')->findall();
        $pend = $model5->where($where)->orderby('GradYear', 'DESC')->findall();
        $dataid12 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '12')->where('namamk', 'studikasus')->findall();
        if (!empty($dataid12)) {
            foreach ($dataid12 as $dataid) :
                $id12[] = $dataid['id_tbl'];
                $nilaip12[] = $dataid['nilaip'];
                $nilaiq12[] = $dataid['nilaiq'];
                $nilair12[] = $dataid['nilair'];
            endforeach;
        } else {
            $id12[] = '';
            $nilaip12[] = '';
            $nilaiq12[] = '';
            $nilair12[] = '';
        }
        $data['id12'] = $id12;
        $data['nilaip12'] = $nilaip12;
        $data['nilaiq12'] = $nilaiq12;
        $data['nilair12'] = $nilair12;

        if (!empty($pend)) {
            $data['data_pend'] = $pend;
        } else {
            $data['data_pend'] = 'kosong';
        }

        //UserFair15
        $model6 = new CapesSertModel();
        //$latih = $model6->where('user_id', $mhs_id)->where('Jenis', 'pelatihan')->like('kompetensi', 'W.2.1.')->orderby('StartYear', 'DESC')->findall();
        $latih = $model6->where('Jenis', 'pelatihan')->where($where)->orderby('StartYear', 'DESC')->findall();
        $dataid15 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '15')->where('namamk', 'studikasus')->findall();
        if (!empty($dataid15)) {
            foreach ($dataid15 as $dataid) :
                $id15[] = $dataid['id_tbl'];
                $nilaip15[] = $dataid['nilaip'];
                $nilaiq15[] = $dataid['nilaiq'];
                $nilair15[] = $dataid['nilair'];
            endforeach;
        } else {
            $id15[] = '';
            $nilaip15[] = '';
            $nilaiq15[] = '';
            $nilair15[] = '';
        }
        $data['id15'] = $id15;
        $data['nilaip15'] = $nilaip15;
        $data['nilaiq15'] = $nilaiq15;
        $data['nilair15'] = $nilair15;

        if (!empty($latih)) {
            $data['data_latih'] = $latih;
        } else {
            $data['data_latih'] = 'kosong';
        }

        //UserFair16
        //$latih1 = $model6->where('user_id', $mhs_id)->where('Jenis', 'sertifikat')->like('kompetensi', 'W.4.')->findall();
        $latih1 = $model6->where('Jenis', 'sertifikat')->where($where)->findall();
        $dataid16 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '16')->where('namamk', 'studikasus')->findall();
        if (!empty($dataid16)) {
            foreach ($dataid16 as $dataid) :
                $id16[] = $dataid['id_tbl'];
                $nilaip16[] = $dataid['nilaip'];
                $nilaiq16[] = $dataid['nilaiq'];
                $nilair16[] = $dataid['nilair'];
            endforeach;
        } else {
            $id16[] = '';
            $nilaip16[] = '';
            $nilaiq16[] = '';
            $nilair16[] = '';
        }
        $data['id16'] = $id16;
        $data['nilaip16'] = $nilaip16;
        $data['nilaiq16'] = $nilaiq16;
        $data['nilair16'] = $nilair16;

        if (!empty($latih)) {
            $data['data_latih1'] = $latih1;
        } else {
            $data['data_latih1'] = 'kosong';
        }

        //UserFair6
        $model7 = new BahasaModel();
        //$bahasa = $model7->where('user_id', $mhs_id)->like('kompetensi', 'W.4.')->orderby('Num', 'DESC')->findall();
        $bahasa = $model7->where($where)->orderby('Num', 'DESC')->findall();
        //$data['jml_bahasa'] = $model5->where('user_id', $mhs_id)->like('kompetensi', 'W.4.4.')->countAllResults();
        $data['jml_bahasa'] = $model5->where($where)->countAllResults();
        $dataid6 = $modelnilai->select('id_tbl, nilaip, nilaiq, nilair')->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tipedosen', 'Pembimbing')->where('namatbl', '6')->where('namamk', 'studikasus')->findall();
        if (!empty($dataid6)) {
            foreach ($dataid6 as $dataid) :
                $id6[] = $dataid['id_tbl'];
                $nilaip6[] = $dataid['nilaip'];
                $nilaiq6[] = $dataid['nilaiq'];
                $nilair6[] = $dataid['nilair'];
            endforeach;
        } else {
            $id6[] = '';
            $nilaip6[] = '';
            $nilaiq6[] = '';
            $nilair6[] = '';
        }
        $data['id6'] = $id6;
        $data['nilaip6'] = $nilaip6;
        $data['nilaiq6'] = $nilaiq6;
        $data['nilair6'] = $nilair6;

        if (!empty($bahasa)) {
            $data['data_bahasa'] = $bahasa;
        } else {
            $data['data_bahasa'] = 'kosong';
        }

        $data['mhs_id'] = $mhs_id;
        $data['dosen_id'] = $dosen_id;
        $data['title_page'] = "Studi Kasus";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/nilairpl/docs/" . $mhs_id . '/' . $dosen_id . '">Nilai RPL</a></li><li class="breadcrumb-item active">Studi kasus</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/studikasus', $data);
    }

    public function studikasussimpan()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $mhs_id = $this->request->getVar('mhs_id');
        $dosen_id = $this->request->getVar('dosen_id');

        $model = new NilairplModel();

        //Hapus data yang ada
        $model->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('namamk', 'studikasus');
        $model->delete();

        //Simpan UserFair3
        $kerja_index = $this->request->getVar('kerja_index');
        if (!empty($kerja_index)) {
            $kerja_id = $this->request->getVar('kerja_id');
            $nilaikerja_p = $this->request->getVar('nilaikerja_p');
            $nilaikerja_q = $this->request->getVar('nilaikerja_q');
            $nilaikerja_r = $this->request->getVar('nilaikerja_r');
            foreach ($kerja_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $kerja_id[$index],
                    'namatbl' => '3',
                    'namamk' => 'studikasus',
                    'nilaip' => $nilaikerja_p[$index],
                    'nilaiq' => $nilaikerja_q[$index],
                    'nilair' => $nilaikerja_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair4
        $ajar_index = $this->request->getVar('ajar_index');
        if (!empty($ajar_index)) {
            $ajar_id = $this->request->getVar('ajar_id');
            $nilaiajar_p = $this->request->getVar('nilaiajar_p');
            $nilaiajar_q = $this->request->getVar('nilaiajar_q');
            $nilaiajar_r = $this->request->getVar('nilaiajar_r');
            foreach ($ajar_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $ajar_id[$index],
                    'namatbl' => '4',
                    'namamk' => 'studikasus',
                    'nilaip' => $nilaiajar_p[$index],
                    'nilaiq' => $nilaiajar_q[$index],
                    'nilair' => $nilaiajar_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair51
        $kartul_index = $this->request->getVar('kartul_index');
        if (!empty($kartul_index)) {
            $kartul_id = $this->request->getVar('kartul_id');
            $nilaikartul_p = $this->request->getVar('nilaikartul_p');
            $nilaikartul_q = $this->request->getVar('nilaikartul_q');
            $nilaikartul_r = $this->request->getVar('nilaikartul_r');
            foreach ($kartul_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $kartul_id[$index],
                    'namatbl' => '51',
                    'namamk' => 'studikasus',
                    'nilaip' => $nilaikartul_p[$index],
                    'nilaiq' => $nilaikartul_q[$index],
                    'nilair' => $nilaikartul_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair52
        $sem_index = $this->request->getVar('sem_index');
        if (!empty($sem_index)) {
            $sem_id = $this->request->getVar('sem_id');
            $nilaisem_p = $this->request->getVar('nilaisem_p');
            $nilaisem_q = $this->request->getVar('nilaisem_q');
            $nilaisem_r = $this->request->getVar('nilaisem_r');
            foreach ($sem_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $sem_id[$index],
                    'namatbl' => '52',
                    'namamk' => 'studikasus',
                    'nilaip' => $nilaisem_p[$index],
                    'nilaiq' => $nilaisem_q[$index],
                    'nilair' => $nilaisem_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair53
        $sem1_index = $this->request->getVar('sem1_index');
        if (!empty($sem1_index)) {
            $sem1_id = $this->request->getVar('sem1_id');
            $nilaisem1_p = $this->request->getVar('nilaisem1_p');
            $nilaisem1_q = $this->request->getVar('nilaisem1_q');
            $nilaisem1_r = $this->request->getVar('nilaisem1_r');
            foreach ($sem1_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $sem1_id[$index],
                    'namatbl' => '53',
                    'namamk' => 'studikasus',
                    'nilaip' => $nilaisem1_p[$index],
                    'nilaiq' => $nilaisem1_q[$index],
                    'nilair' => $nilaisem1_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair12
        $pend_index = $this->request->getVar('pend_index');
        if (!empty($pend_index)) {
            $pend_id = $this->request->getVar('pend_id');
            $nilaipend_p = $this->request->getVar('nilaipend_p');
            $nilaipend_q = $this->request->getVar('nilaipend_q');
            $nilaipend_r = $this->request->getVar('nilaipend_r');
            foreach ($pend_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $pend_id[$index],
                    'namatbl' => '12',
                    'namamk' => 'studikasus',
                    'nilaip' => $nilaipend_p[$index],
                    'nilaiq' => $nilaipend_q[$index],
                    'nilair' => $nilaipend_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair15
        $latih_index = $this->request->getVar('latih_index');
        if (!empty($latih_index)) {
            $latih_id = $this->request->getVar('latih_id');
            $nilailatih_p = $this->request->getVar('nilailatih_p');
            $nilailatih_q = $this->request->getVar('nilailatih_q');
            $nilailatih_r = $this->request->getVar('nilailatih_r');
            foreach ($latih_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $latih_id[$index],
                    'namatbl' => '15',
                    'namamk' => 'studikasus',
                    'nilaip' => $nilailatih_p[$index],
                    'nilaiq' => $nilailatih_q[$index],
                    'nilair' => $nilailatih_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair16
        $latih1_index = $this->request->getVar('latih1_index');
        if (!empty($latih1_index)) {
            $latih1_id = $this->request->getVar('latih1_id');
            $nilailatih1_p = $this->request->getVar('nilailatih1_p');
            $nilailatih1_q = $this->request->getVar('nilailatih1_q');
            $nilailatih1_r = $this->request->getVar('nilailatih1_r');
            foreach ($latih1_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $latih1_id[$index],
                    'namatbl' => '16',
                    'namamk' => 'studikasus',
                    'nilaip' => $nilailatih1_p[$index],
                    'nilaiq' => $nilailatih1_q[$index],
                    'nilair' => $nilailatih1_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        //Simpan UserFair6
        $bahasa_index = $this->request->getVar('bahasa_index');
        if (!empty($bahasa_index)) {
            $bahasa_id = $this->request->getVar('bahasa_id');
            $nilaibahasa_p = $this->request->getVar('nilaibahasa_p');
            $nilaibahasa_q = $this->request->getVar('nilaibahasa_q');
            $nilaibahasa_r = $this->request->getVar('nilaibahasa_r');
            foreach ($bahasa_index as $index) :
                $data = array(
                    'mhs_id' => $mhs_id,
                    'dosen_id' => $dosen_id,
                    'tipedosen' => 'Pembimbing',
                    'id_tbl' => $bahasa_id[$index],
                    'namatbl' => '6',
                    'namamk' => 'studikasus',
                    'nilaip' => $nilaibahasa_p,
                    'nilaiq' => $nilaibahasa_q[$index],
                    'nilair' => $nilaibahasa_r[$index],
                    'nilairpl_save' => 'Ya',
                    'nilairpl_submit' => 'Tidak',
                    'nilairpl_confirm' => 'Tidak',
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
                $model->save($data);
            endforeach;
        }

        $session->setFlashdata('msg', 'Data MK Studi Kasus berhasil disimpan.');
        return redirect()->to('nilairpl/docs/' . $mhs_id . '/' . $dosen_id);
    }

    public function submitnilairpl()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $mhs_id = $this->request->getVar('mhs_id');
        $dosen_id = $this->request->getVar('dosen_id');
        $nilaikodeetik = $this->request->getVar('nilaikodeetik');
        $nilaiprofesi = $this->request->getVar('nilaiprofesi');
        $nilaik3lh = $this->request->getVar('nilaik3lh');
        $nilaistudikasus = $this->request->getVar('nilaistudikasus');
        $nilaiseminar = $this->request->getVar('nilaiseminar');

        $model = new NilairplModel();

        if (($nilaikodeetik >= 50) && ($nilaiprofesi >= 50) && ($nilaik3lh >= 50) && ($nilaistudikasus >= 100) && ($nilaiseminar >= 50)) {

            $model->set('nilairpl_submit', 'Ya');
            $model->where('mhs_id', $mhs_id);
            $model->where('dosen_id', $dosen_id);
            $model->where('tipedosen', 'Pembimbing');
            $model->update();

            $session->setFlashdata('msg', 'Data Nilai berhasil di submit.');
            return redirect()->to('nilairpl/docs/' . $mhs_id . '/' . $dosen_id);
        } else {

            $model->set('nilairpl_submit', 'Tidak');
            $model->where('mhs_id', $mhs_id);
            $model->where('dosen_id', $dosen_id);
            $model->where('tipedosen', 'Pembimbing');
            $model->update();

            $session->setFlashdata('err', 'Ada data bobot yang masih kurang. Mohon diperiksa kembali.');
            return redirect()->to('nilairpl/docs/' . $mhs_id . '/' . $dosen_id);
        }
    }
}
