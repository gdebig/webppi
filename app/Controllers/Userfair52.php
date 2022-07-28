<?php

namespace App\Controllers;

use App\Models\CapesSemModel;

class Userfair52 extends BaseController
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
        $model = new CapesSemModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $sem = $model->where('user_id', $id)->where('Type', 'Sem')->orderby('Year', 'DESC')->findall();
        if (!empty($sem)){
            $data['data_sem'] = $sem;
        }else{
            $data['data_sem'] = 'kosong';
        }

        $data['title_page'] = "V.2. Makalah/Tulisan Yang Disajikan Dalam Seminar/Lokakarya Keinsinyuran (W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Makalah</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok52', $data);
    }
}