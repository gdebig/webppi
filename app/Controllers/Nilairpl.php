<?php

//tampilan fair utk penilai

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Models\EtikRefModel;
use App\Models\PendapatModel;
use App\Models\CapesPendModel;
use App\Models\CapesOrgModel;
use App\Models\KompModel;
use App\Libraries\Slug;
use App\Models\PenghargaanModel;
use App\Models\CapesSertModel;
use App\Models\CapesKualifikasiModel;
use App\Models\MengajarModel;
use App\Models\CapesKartulModel;
use App\Models\CapesSemModel;
use App\Models\InovasiModel;
use App\Models\BahasaModel;

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
        helper(['tanggal']);

        $model = new ProfileModel();
        $mhsprofile = $model->where('user_id', $mhs_id)->first();
        if ($mhsprofile) {
            $data = [
                'FullName' => $mhsprofile['FullName'],
            ];
        } else {
            $data['kosong'] = 'kosong';
        }
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

        $model = new EtikRefModel();
        $etik = $model->where('user_id', $mhs_id)->orderby('Name', 'ASC')->findall();
        $data['jumlah_etik'] = $model->where('user_id', $mhs_id)->countAllResults();
        if (!empty($etik)) {
            $data['data_etik'] = $etik;
        } else {
            $data['data_etik'] = 'kosong';
        }

        $model1 = new PendapatModel();
        $pendapat = $model1->where('user_id', $mhs_id)->orderby('Num', 'DESC')->findall();
        if (!empty($pendapat)) {
            $data['data_pendapat'] = $pendapat;
        } else {
            $data['data_pendapat'] = 'kosong';
        }

        $model2 = new CapesOrgModel();
        $org = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.2.')->orderby('StartPeriodYear', 'DESC')->findall();
        $data['jumlah_org'] = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.2.')->countAllResults();
        $data['org_pii'] = $model2->where('Type', 'PII')->findall();
        if (!empty($org)) {
            $data['data_org'] = $org;
        } else {
            $data['data_org'] = 'kosong';
        }

        $model3 = new PenghargaanModel();
        $penghargaan = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.2.')->orderby('Year', 'DESC')->orderby('Month', 'DESC')->findall();
        $data['jumlah_harga'] = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.2.')->countAllResults();
        if (!empty($penghargaan)) {
            $data['data_harga'] = $penghargaan;
        } else {
            $data['data_harga'] = 'kosong';
        }

        $model4 = new CapesSertModel();
        $latih = $model4->where('user_id', $mhs_id)->where('Jenis', 'sertifikat')->like('kompetensi', 'W.1.2.')->findall();
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

        $model = new CapesKualifikasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kerja = $model->where('user_id', $mhs_id)->like('kompetensi', 'W.2.2')->orderby('ProjValue', 'DESC')->findall();
        if (!empty($kerja)) {
            $data['data_kerja'] = $kerja;
        } else {
            $data['data_kerja'] = 'kosong';
        }

        $model1 = new CapesPendModel();

        $pend = $model1->where('user_id', $mhs_id)->orderby('GradYear', 'DESC')->findall();
        if (!empty($pend)) {
            $data['data_pend'] = $pend;
        } else {
            $data['data_pend'] = 'kosong';
        }

        $model2 = new CapesOrgModel();
        $org = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.1.')->orderby('StartPeriodYear', 'DESC')->findall();
        $data['jumlah_org'] = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.1.')->countAllResults();
        $data['org_pii'] = $model2->where('Type', 'PII')->findall();
        if (!empty($org)) {
            $data['data_org'] = $org;
        } else {
            $data['data_org'] = 'kosong';
        }

        $model3 = new PenghargaanModel();
        $penghargaan = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.1.')->orderby('Year', 'DESC')->orderby('Month', 'DESC')->findall();
        $data['jumlah_harga'] = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.1.')->countAllResults();
        if (!empty($penghargaan)) {
            $data['data_harga'] = $penghargaan;
        } else {
            $data['data_harga'] = 'kosong';
        }

        $model4 = new CapesSertModel();
        $latih = $model4->where('user_id', $mhs_id)->where('Jenis', 'pelatihan')->like('kompetensi', 'W.2.2.')->orderby('StartYear', 'DESC')->findall();
        if (!empty($latih)) {
            $data['data_latih'] = $latih;
        } else {
            $data['data_latih'] = 'kosong';
        }

        $latih1 = $model4->where('user_id', $mhs_id)->where('Jenis', 'sertifikat')->like('kompetensi', 'W.1.1.')->findall();
        if (!empty($latih)) {
            $data['data_latih1'] = $latih1;
        } else {
            $data['data_latih1'] = 'kosong';
        }

        $model5 = new EtikRefModel();
        $etik = $model5->where('user_id', $mhs_id)->orderby('Name', 'ASC')->findall();
        $data['jumlah_etik'] = $model5->where('user_id', $mhs_id)->countAllResults();
        if (!empty($etik)) {
            $data['data_etik'] = $etik;
        } else {
            $data['data_etik'] = 'kosong';
        }

        $model6 = new PendapatModel();
        $pendapat = $model6->where('user_id', $mhs_id)->orderby('Num', 'DESC')->findall();
        if (!empty($pendapat)) {
            $data['data_pendapat'] = $pendapat;
        } else {
            $data['data_pendapat'] = 'kosong';
        }

        $model7 = new MengajarModel();
        $kerja = $model7->where('user_id', $mhs_id)->like('kompetensi', 'W.2.2.')->orderby('StartPeriod', 'DESC')->findall();
        if (!empty($kerja)) {
            $data['data_kerja'] = $kerja;
        } else {
            $data['data_kerja'] = 'kosong';
        }

        $model8 = new CapesSemModel();
        $sem = $model8->where('user_id', $mhs_id)->where('Type', 'Sem')->like('kompetensi', 'W.2.2.')->orderby('Year', 'DESC')->findall();
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

        $model2 = new CapesOrgModel();
        $org = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.3.')->orderby('StartPeriodYear', 'DESC')->findall();
        $data['jumlah_org'] = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.3.')->countAllResults();
        $data['org_pii'] = $model2->where('Type', 'PII')->findall();
        if (!empty($org)) {
            $data['data_org'] = $org;
        } else {
            $data['data_org'] = 'kosong';
        }

        $model3 = new PenghargaanModel();
        $penghargaan = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.3.')->orderby('Year', 'DESC')->orderby('Month', 'DESC')->findall();
        $data['jumlah_harga'] = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.3.')->countAllResults();
        if (!empty($penghargaan)) {
            $data['data_harga'] = $penghargaan;
        } else {
            $data['data_harga'] = 'kosong';
        }

        $model4 = new CapesSertModel();
        $latih1 = $model4->where('user_id', $mhs_id)->where('Jenis', 'sertifikat')->like('kompetensi', 'W.1.3.')->findall();
        if (!empty($latih)) {
            $data['data_latih1'] = $latih1;
        } else {
            $data['data_latih1'] = 'kosong';
        }

        $model5 = new EtikRefModel();
        $etik = $model5->where('user_id', $mhs_id)->orderby('Name', 'ASC')->findall();
        $data['jumlah_etik'] = $model5->where('user_id', $mhs_id)->countAllResults();
        if (!empty($etik)) {
            $data['data_etik'] = $etik;
        } else {
            $data['data_etik'] = 'kosong';
        }

        $model6 = new PendapatModel();
        $pendapat = $model6->where('user_id', $mhs_id)->orderby('Num', 'DESC')->findall();
        if (!empty($pendapat)) {
            $data['data_pendapat'] = $pendapat;
        } else {
            $data['data_pendapat'] = 'kosong';
        }

        $data['mhs_id'] = $mhs_id;
        $data['dosen_id'] = $dosen_id;
        $data['title_page'] = "Keselamatan, Kesehatan, Keamanan Kerja dan Lingkungan";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/nilairpl/docs/" . $mhs_id . '/' . $dosen_id . '">Nilai RPL</a></li><li class="breadcrumb-item active">K3LH</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/k3lh', $data);
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

        $model = new CapesKualifikasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kerja = $model->where('user_id', $mhs_id)->like('kompetensi', 'W.2.2')->orderby('ProjValue', 'DESC')->findall();
        if (!empty($kerja)) {
            $data['data_kerja'] = $kerja;
        } else {
            $data['data_kerja'] = 'kosong';
        }

        $model4 = new CapesSertModel();
        $latih = $model4->where('user_id', $mhs_id)->where('Jenis', 'pelatihan')->like('kompetensi', 'W.2.2.')->orderby('StartYear', 'DESC')->findall();
        if (!empty($latih)) {
            $data['data_latih'] = $latih;
        } else {
            $data['data_latih'] = 'kosong';
        }

        $latih1 = $model4->where('user_id', $mhs_id)->where('Jenis', 'sertifikat')->like('kompetensi', 'W.1.1.')->findall();
        if (!empty($latih)) {
            $data['data_latih1'] = $latih1;
        } else {
            $data['data_latih1'] = 'kosong';
        }

        $model7 = new MengajarModel();
        $kerja = $model7->where('user_id', $mhs_id)->like('kompetensi', 'W.2.2.')->orderby('StartPeriod', 'DESC')->findall();
        if (!empty($kerja)) {
            $data['data_kerja'] = $kerja;
        } else {
            $data['data_kerja'] = 'kosong';
        }

        $model8 = new CapesKartulModel();
        $kartul = $model8->where('user_id', $mhs_id)->orderby('Year', 'DESC')->findall();
        if (!empty($kartul)) {
            $data['data_kartul'] = $kartul;
        } else {
            $data['data_kartul'] = 'kosong';
        }

        $model9 = new CapesSemModel();
        $sem = $model9->where('user_id', $mhs_id)->where('Type', 'Mak')->like('kompetensi', 'W.2.2.')->orderby('Year', 'DESC')->findall();
        if (!empty($sem)) {
            $data['data_sem'] = $sem;
        } else {
            $data['data_sem'] = 'kosong';
        }

        $model10 = new BahasaModel();
        $bahasa = $model10->where('user_id', $mhs_id)->orderby('Num', 'DESC')->findall();
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

        $model = new CapesKualifikasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kerja = $model->where('user_id', $mhs_id)->like('kompetensi', 'W.2.2')->orderby('ProjValue', 'DESC')->findall();
        if (!empty($kerja)) {
            $data['data_kerja'] = $kerja;
        } else {
            $data['data_kerja'] = 'kosong';
        }

        $model1 = new CapesPendModel();

        $pend = $model1->where('user_id', $mhs_id)->orderby('GradYear', 'DESC')->findall();
        if (!empty($pend)) {
            $data['data_pend'] = $pend;
        } else {
            $data['data_pend'] = 'kosong';
        }

        $model2 = new CapesOrgModel();
        $org = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.1.')->orderby('StartPeriodYear', 'DESC')->findall();
        $data['jumlah_org'] = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.1.')->countAllResults();
        $data['org_pii'] = $model2->where('Type', 'PII')->findall();
        if (!empty($org)) {
            $data['data_org'] = $org;
        } else {
            $data['data_org'] = 'kosong';
        }

        $model3 = new PenghargaanModel();
        $penghargaan = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.1.')->orderby('Year', 'DESC')->orderby('Month', 'DESC')->findall();
        $data['jumlah_harga'] = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.1.')->countAllResults();
        if (!empty($penghargaan)) {
            $data['data_harga'] = $penghargaan;
        } else {
            $data['data_harga'] = 'kosong';
        }

        $model4 = new CapesSertModel();
        $latih = $model4->where('user_id', $mhs_id)->where('Jenis', 'pelatihan')->like('kompetensi', 'W.2.2.')->orderby('StartYear', 'DESC')->findall();
        if (!empty($latih)) {
            $data['data_latih'] = $latih;
        } else {
            $data['data_latih'] = 'kosong';
        }

        $latih1 = $model4->where('user_id', $mhs_id)->where('Jenis', 'sertifikat')->like('kompetensi', 'W.1.1.')->findall();
        if (!empty($latih)) {
            $data['data_latih1'] = $latih1;
        } else {
            $data['data_latih1'] = 'kosong';
        }

        $model5 = new EtikRefModel();
        $etik = $model5->where('user_id', $mhs_id)->orderby('Name', 'ASC')->findall();
        $data['jumlah_etik'] = $model5->where('user_id', $mhs_id)->countAllResults();
        if (!empty($etik)) {
            $data['data_etik'] = $etik;
        } else {
            $data['data_etik'] = 'kosong';
        }

        $model6 = new PendapatModel();
        $pendapat = $model6->where('user_id', $mhs_id)->orderby('Num', 'DESC')->findall();
        if (!empty($pendapat)) {
            $data['data_pendapat'] = $pendapat;
        } else {
            $data['data_pendapat'] = 'kosong';
        }

        $model7 = new MengajarModel();
        $kerja = $model7->where('user_id', $mhs_id)->like('kompetensi', 'W.2.2.')->orderby('StartPeriod', 'DESC')->findall();
        if (!empty($kerja)) {
            $data['data_kerja'] = $kerja;
        } else {
            $data['data_kerja'] = 'kosong';
        }

        $model8 = new CapesSemModel();
        $sem = $model8->where('user_id', $mhs_id)->where('Type', 'Sem')->like('kompetensi', 'W.2.2.')->orderby('Year', 'DESC')->findall();
        if (!empty($sem)) {
            $data['data_sem'] = $sem;
        } else {
            $data['data_sem'] = 'kosong';
        }

        $data['mhs_id'] = $mhs_id;
        $data['dosen_id'] = $dosen_id;
        $data['title_page'] = "Studi Kasus";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/nilairpl/docs/" . $mhs_id . '/' . $dosen_id . '">Nilai RPL</a></li><li class="breadcrumb-item active">Studi kasus</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/studikasus', $data);
    }
}
