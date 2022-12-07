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
        if ((!$logged_in)&&((!$issadmin)||(!$isadmin)||(!$ispenilai))){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);
        
        $model = new ProfileModel();
        $mhsprofile = $model->where('user_id', $mhs_id)->first();
        if ($mhsprofile){
            $data = [
                'FullName' => $mhsprofile['FullName'],
            ];
        }else{
            $data['kosong'] = 'kosong';
        }
        $data['dosen_id'] = $dosen_id;
        $data['mhs_id'] = $mhs_id;
        $data['title_page'] = "Penilaian MK RPL";
        $data['data_bread'] = "Nilai RPL";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/nilairpl', $data);
    }

    public function kodeetik($mhs_id, $dosen_id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&((!$issadmin)||(!$isadmin)||(!$ispenilai))){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $model = new EtikRefModel();
        $etik = $model->where('user_id', $mhs_id)->orderby('Name','ASC')->findall();
        $data['jumlah_etik'] = $model->where('user_id', $mhs_id)->countAllResults();
        if (!empty($etik)){
            $data['data_etik'] = $etik;
        }else{
            $data['data_etik'] = 'kosong';
        }

        $model1 = new PendapatModel();
        $pendapat = $model1->where('user_id', $mhs_id)->orderby('Num', 'DESC')->findall();
        if (!empty($pendapat)){
            $data['data_pendapat'] = $pendapat;
        }else{
            $data['data_pendapat'] = 'kosong';
        }

        $model2 = new CapesOrgModel();
        $org = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.2.')->orderby('StartPeriodYear','DESC')->findall();
        $data['jumlah_org'] = $model2->where('user_id', $mhs_id)->like('kompetensi', 'W.1.2.')->countAllResults();
        $data['org_pii'] = $model2->where('Type', 'PII')->findall();
        if (!empty($org)){
            $data['data_org'] = $org;
        }else{
            $data['data_org'] = 'kosong';
        }

        $model3 = new PenghargaanModel();
        $penghargaan = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.2.')->orderby('Year','DESC')->orderby('Month','DESC')->findall();
        $data['jumlah_harga'] = $model3->where('user_id', $mhs_id)->like('kompetensi', 'W.1.2.')->countAllResults();
        if (!empty($penghargaan)){
            $data['data_harga'] = $penghargaan;
        }else{
            $data['data_harga'] = 'kosong';
        }

        $model4 = new CapesSertModel();
        $latih = $model4->where('user_id', $mhs_id)->where('Jenis', 'sertifikat')->like('kompetensi', 'W.1.2.')->findall();
        if (!empty($latih)){
            $data['data_latih'] = $latih;
        }else{
            $data['data_latih'] = 'kosong';
        }

        $data['mhs_id'] = $mhs_id;
        $data['dosen_id'] = $dosen_id;
        $data['title_page'] = "Kode Etik dan Etika Profesi Insinyur";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/nilairpl/docs/".$mhs_id.'/'.$dosen_id.'">Nilai RPL</a></li><li class="breadcrumb-item active">Kode Etik</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/kodeetik', $data);
    }

    public function profesi($mhs_id, $dosen_id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&((!$issadmin)||(!$isadmin)||(!$ispenilai))){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $model = new CapesKualifikasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kerja = $model->where('user_id', $mhs_id)->like('kompetensi', 'W.2.2.')->orderby('ProjValue','DESC')->findall();
        if (!empty($kerja)){
            $data['data_kerja'] = $kerja;
        }else{
            $data['data_kerja'] = 'kosong';
        }

        $model1 = new CapesPendModel();
        
        $pend = $model1->where('user_id', $mhs_id)->orderby('GradYear','DESC')->findall();
        if (!empty($pend)){
            $data['data_pend'] = $pend;
        }else{
            $data['data_pend'] = 'kosong';
        }

        $data['mhs_id'] = $mhs_id;
        $data['dosen_id'] = $dosen_id;
        $data['title_page'] = "Profesionalisme";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/nilairpl/docs/".$mhs_id.'/'.$dosen_id.'">Nilai RPL</a></li><li class="breadcrumb-item active">Profesionalisme</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/profesi', $data);
    }
}