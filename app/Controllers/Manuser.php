<?php

namespace App\Controllers;

use App\Models\UserModel;

class Manuser extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in)&&($issadmin)){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        
        $user_id = $session->get('user_id');
        $model = new UserModel();
        $data['logged_in'] = $logged_in;
        $user = $model->findall();
        if (!empty($user)){
            $data['data_user'] = $user;
        }else{
            $data['data_user'] = 'kosong';
        }
        $data['title_page'] = "Data Anggota PPI RPL";
        $data['data_bread'] = "Anggota";
        return view('maintemp/anggota', $data);
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