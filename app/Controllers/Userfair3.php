<?php

namespace App\Controllers;

use App\Models\CapesKualifikasiModel;

class Userfair3 extends BaseController
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
        $model = new CapesKualifikasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kerja = $model->where('user_id', $id)->orderby('ProjValue','DESC')->findall();
        if (!empty($kerja)){
            $data['data_kerja'] = $kerja;
        }else{
            $data['data_kerja'] = 'kosong';
        }

        $data['title_page'] = "III. KUALIFIKASI PROFESIONAL (W2,W3,W4,P6,P7,P8,P9,P10,P11)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Kualifikasi Profesional</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok3', $data);
    }
}