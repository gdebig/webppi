<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BimbingModel;

class Manbimbing extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&(($issadmin)||($isadmin)||($ispenilai))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        
        $user_id = $session->get('user_id');
        $model = new BimbingModel();
        $data['logged_in'] = $logged_in;
        $user = $model->where('tbl_bimbing.dosen_id', $user_id)->join('tbl_profile', 'tbl_profile.user_id = tbl_bimbing.mhs_id', 'left')->join('tbl_tugasakhir', 'tbl_tugasakhir.user_id = tbl_bimbing.mhs_id', 'left')->orderby('tbl_tugasakhir.ta_tahun', 'DESC')->orderby('tbl_profile.FullName', 'ASC')->findall();
        if (!empty($user)){
            $data['data_user'] = $user;
        }else{
            $data['data_user'] = 'kosong';
        }
        $data['title_page'] = "Data Mahasiswa Bimbingan PPI RPL";
        $data['data_bread'] = "Bimbingan";
        return view('maintemp/bimbing', $data);
    }
}