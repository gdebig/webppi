<?php

namespace App\Controllers;

use App\Models\CapesSertModel;

class Userfair15 extends BaseController
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
        $model = new CapesSertModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $latih = $model->where('user_id', $id)->where('Jenis', 'pelatihan')->orderby('StartYear','DESC')->findall();
        if (!empty($latih)){
            $data['data_latih'] = $latih;
        }else{
            $data['data_latih'] = 'kosong';
        }

        $data['title_page'] = "I.5. Pendidikan/Pelatihan Teknik/Manajemen (W2,W4,P10)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Pelatihan Teknik</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok15', $data);
    }
}