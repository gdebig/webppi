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
use App\Libraries\Slug;
use App\Models\ConfigModel;

class Piifairrekap extends BaseController
{
    public function docs($id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'admin');
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

        $model = new UserModel();
        $user = $model->where('user_id', $user_id)->first();
        if ($user) {
            $data = [
                'user_id' => $user['user_id'],
                'confirmfair' => $user['confirmfair']
            ];
        } else {
            $data['kosong'] = "kosong";
        }

        $model1 = new ProfileModel();
        $profile = $model1->where('user_id', $user_id)->first();
        if ($profile) {
            $data = [
                'FullName' => $profile['FullName'],
                'Vocational' => $profile['Vocational']
            ];
        } else {
            $data['kosong'] = "kosong";
        }

        $orgmodel = new CapesOrgModel();
        $org = $orgmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $pengmodel = new PenghargaanModel();
        $peng = $pengmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $sertmodel = new CapesSertModel();
        $sert = $sertmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $kualimodel = new CapesKualifikasiModel();
        $kualifikasi = $kualimodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $ajarmodel = new MengajarModel();
        $ajar = $ajarmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $kartulmodel = new CapesKartulModel();
        $kartul = $kartulmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $semmodel = new CapesSemModel();
        $sem = $semmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $inovmodel = new InovasiModel();
        $inov = $inovmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $bhsmodel = new BahasaModel();
        $bhs = $bhsmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();

        $data['nilai_w1'] = $org['nilai_w1'] + $peng['nilai_w1'] + $sert['nilai_w1'] + $kualifikasi['nilai_w1'] + $ajar['nilai_w1'] + $kartul['nilai_w1'] + $sem['nilai_w1'] + $inov['nilai_w1'] + $bhs['nilai_w1'];
        $data['nilai_w2'] = $org['nilai_w2'] + $peng['nilai_w2'] + $sert['nilai_w2'] + $kualifikasi['nilai_w2'] + $ajar['nilai_w2'] + $kartul['nilai_w2'] + $sem['nilai_w2'] + $inov['nilai_w2'] + $bhs['nilai_w2'];
        $data['nilai_w3'] = $org['nilai_w3'] + $peng['nilai_w3'] + $sert['nilai_w3'] + $kualifikasi['nilai_w3'] + $ajar['nilai_w3'] + $kartul['nilai_w3'] + $sem['nilai_w3'] + $inov['nilai_w3'] + $bhs['nilai_w3'];
        $data['nilai_w4'] = $org['nilai_w4'] + $peng['nilai_w4'] + $sert['nilai_w4'] + $kualifikasi['nilai_w4'] + $ajar['nilai_w4'] + $kartul['nilai_w4'] + $sem['nilai_w4'] + $inov['nilai_w4'] + $bhs['nilai_w4'];
        $data['nilai_pil'] = $org['nilai_pil'] + $peng['nilai_pil'] + $sert['nilai_pil'] + $kualifikasi['nilai_pil'] + $ajar['nilai_pil'] + $kartul['nilai_pil'] + $sem['nilai_pil'] + $inov['nilai_pil'] + $bhs['nilai_pil'];
        $data['total'] = $data['nilai_w1'] + $data['nilai_w2'] + $data['nilai_w3'] + $data['nilai_w4'] + $data['nilai_pil'];

        if ($data['total'] >= 6000) {
            $data['estimasi'] = "Anda memenuhi syarat untuk IPU";
        } elseif ($data['total'] >= 3000) {
            $data['estimasi'] = "Anda memenuhi syarat untuk IPM";
        } elseif ($data['total'] >= 600) {
            $data['estimasi'] = "Anda memenuhi syarat untuk IPP";
        } else {
            $data['estimasi'] = "Anda belum memenuhi syarat";
        }

        $data['user_id'] = $user_id;
        $data['title_page'] = "Rekapitulasi";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/piifair/docs/" . $id . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Rekapitulasi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/piirekap', $data);
    }
}
