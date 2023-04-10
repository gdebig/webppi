<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KompModel;
use App\Models\CapesOrgModel;
use App\Models\PenghargaanModel;
use App\Models\CapesSertModel;
use App\Models\CapesKualifikasiModel;
use App\Models\MengajarModel;
use App\Models\CapesKartulModel;
use App\Models\CapesSemModel;
use App\Models\InovasiModel;
use App\Models\BahasaModel;
use App\Models\ProfileModel;
use App\Models\CapesPendModel;
use App\Libraries\Slug;
use App\Models\ConfigModel;

class Bimbingfairlamp extends BaseController
{
    public function docs($id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }

        if (!empty($id)) {
            $user_id = $id;
        } else {
            $user_id = $session->get('user_id');
        }

        $user_id1 = $session->get('user_id');

        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id1)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        helper(['tanggal']);

        $model1 = new CapesPendModel();
        $datapend = $model1->where('user_id', $user_id)->orderby('GradYear', 'DESC')->findall();
        if (!empty($datapend)) {
            $data['datapend'] = $datapend;
        } else {
            $data['datapend'] = 'kosong';
        }

        $model2 = new CapesOrgModel();
        $dataorg = $model2->where('user_id', $user_id)->orderby('StartPeriodYear', 'DESC')->findall();
        if (!empty($dataorg)) {
            $data['dataorg'] = $dataorg;
        } else {
            $data['dataorg'] = 'kosong';
        }

        $model3 = new PenghargaanModel();
        $datapenghargaan = $model3->where('user_id', $user_id)->orderby('Year', 'DESC')->orderby('Month', 'DESC')->findall();
        if (!empty($datapenghargaan)) {
            $data['datapenghargaan'] = $datapenghargaan;
        } else {
            $data['datapenghargaan'] = 'kosong';
        }

        $model4 = new CapesSertModel();
        $datalatih = $model4->where('user_id', $user_id)->where('Jenis', 'pelatihan')->orderby('StartYear', 'DESC')->findall();
        if (!empty($datalatih)) {
            $data['datalatih'] = $datalatih;
        } else {
            $data['datalatih'] = 'kosong';
        }

        $datasert = $model4->where('user_id', $user_id)->where('Jenis', 'sertifikat')->orderby('StartYear', 'DESC')->findall();
        if (!empty($datasert)) {
            $data['datasert'] = $datasert;
        } else {
            $data['datasert'] = 'kosong';
        }

        $model5 = new CapesKualifikasiModel();
        $kerja = $model5->where('user_id', $user_id)->orderby('ProjValue', 'DESC')->findall();
        if (!empty($kerja)) {
            $data['datakerja'] = $kerja;
        } else {
            $data['datakerja'] = 'kosong';
        }

        $model6 = new MengajarModel();
        $ajar = $model6->where('user_id', $user_id)->orderby('StartPeriod', 'DESC')->findall();
        if (!empty($ajar)) {
            $data['dataajar'] = $ajar;
        } else {
            $data['dataajar'] = 'kosong';
        }

        $model7 = new CapesKartulModel();
        $kartul = $model7->where('user_id', $user_id)->orderby('Year', 'DESC')->findall();
        if (!empty($kartul)) {
            $data['datakartul'] = $kartul;
        } else {
            $data['datakartul'] = 'kosong';
        }

        $model8 = new CapesSemModel();
        $mak = $model8->where('user_id', $user_id)->where('Type', 'Mak')->orderby('Year', 'DESC')->findall();
        if (!empty($mak)) {
            $data['datamak'] = $mak;
        } else {
            $data['datamak'] = 'kosong';
        }

        $sem = $model8->where('user_id', $user_id)->where('Type', 'Sem')->orderby('Year', 'DESC')->findall();
        if (!empty($sem)) {
            $data['datasem'] = $sem;
        } else {
            $data['datasem'] = 'kosong';
        }

        $model9 = new InovasiModel();
        $inov = $model9->where('user_id', $user_id)->orderby('Year', 'DESC')->orderby('Month', 'DESC')->findall();
        if (!empty($inov)) {
            $data['datainov'] = $inov;
        } else {
            $data['datainov'] = 'kosong';
        }

        $model10 = new BahasaModel();
        $bahasa = $model10->where('user_id', $user_id)->orderby('Num', 'DESC')->findall();
        if (!empty($bahasa)) {
            $data['databahasa'] = $bahasa;
        } else {
            $data['databahasa'] = 'kosong';
        }

        $data['user_id'] = $id;
        $data['title_page'] = "Lampiran";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/bimbingfair/docs/" . $id . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Lampiran</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/bimbinglamp', $data);
    }
}
