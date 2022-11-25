<?php

//tampilan fair utk penilai

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Models\EtikRefModel;

class Nilairpl extends BaseController
{
    public function docs($mhs_id = false, $dosen_id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&(($issadmin)||($isadmin)||($ispenilai))){
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
        if ((!$logged_in)&&(($issadmin)||($isadmin)||($ispenilai))){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $model = new EtikRefModel();
        $etik = $model->where('user_id', $mhs_id)->orderby('Name','ASC')->findall();
        if (!empty($etik)){
            $data['data_etik'] = $etik;
        }else{
            $data['data_etik'] = 'kosong';
        }

        $data['mhs_id'] = $mhs_id;
        $data['dosen_id'] = $dosen_id;
        $data['title_page'] = "Kode Etik dan Etika Profesi Insinyur";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/nilairpl/docs/".$mhs_id.'/'.$dosen_id.'">Nilai RPL</a></li><li class="breadcrumb-item active">Kode Etik</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/kodeetik', $data);
    }
}