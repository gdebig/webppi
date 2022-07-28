<?php

namespace App\Controllers;

use App\Models\CapesKartulModel;

class Userfair51 extends BaseController
{
    public function docs($id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }

        if (!empty($id)){
            $user_id = $id;
        }else{
            $user_id = $session->get('user_id');
        }
        helper(['tanggal']);
        $model = new CapesKartulModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kartul = $model->where('user_id', $id)->orderby('Year','DESC')->findall();
        if (!empty($kartul)){
            $data['data_kartul'] = $kartul;
        }else{
            $data['data_kartul'] = 'kosong';
        }

        $data['title_page'] = "V.1. Karya Tulis di Bidang Keinsinyuran yang Dipublikasikan (W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Karya Tulis</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok51', $data);
    }
}