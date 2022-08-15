<?php

namespace App\Controllers;

use App\Models\AkunModel;
use App\Models\JadwalSidangModel;

class jadwalta extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $user_id = $session->get('user_id');
        $model = new JadwalSidangModel();
        $jadwalsidang = $model->where('user_id', $user_id)->first();
        if ($jadwalsidang){
            $data['data_js'] = $jadwalsidang;
        }else{
            $data['data_js'] = "kosong";
        }
        $data['title_page'] = "Dashboard PPI RPL";
        $data['data_bread'] = "dashboard";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/userjadwalsidang', $data);
    }
}