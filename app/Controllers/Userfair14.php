<?php

namespace App\Controllers;

use App\Models\CapesPendModel;

class Userfair14 extends BaseController
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
        $model = new CapesPendModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $pend = $model->where('user_id', $user_id)->orderby('GradYear','DESC')->findall();
        if (!empty($pend)){
            $data['data_pend'] = $pend;
        }else{
            $data['data_pend'] = 'kosong';
        }

        $data['title_page'] = "I.4. Tanda Penghargaan Yang Diterima (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Penghargaan</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok12', $data);
    }
}