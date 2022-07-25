<?php

namespace App\Controllers;

use App\Models\UserModel;

class Manpenilai extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        
        $user_id = $session->get('user_id');
        $model = new UserModel();
        $data['logged_in'] = $logged_in;
        $where = "tipe_user LIKE '__y_'";
        $user = $model->join('tbl_profile', 'tbl_user.user_id = tbl_profile.user_id', 'left')->where($where)->orderby('tbl_user.user_id', 'DESC')->findall();
        if (!empty($user)){
            $data['data_user'] = $user;
        }else{
            $data['data_user'] = 'kosong';
        }
        $data['title_page'] = "Data Penilai PPI RPL";
        $data['data_bread'] = "Penilai";
        return view('maintemp/penilai', $data);
    }

    public function tambahanggota(){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in)&&($issadmin)){
            return redirect()->to('/home');
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Tambah Data Anggota";
        $data['data_bread'] = "Tambah Data Anggota";
        $data['user_id'] = $user_id;
        return view('maintemp/tambahanggota', $data);

    }
}