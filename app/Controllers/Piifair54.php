<?php

namespace App\Controllers;

use App\Models\InovasiModel;
use App\Models\KompModel;
use App\Libraries\Slug;
use App\Models\ConfigModel;

class Piifair54 extends BaseController
{
    public function docs($id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'admin');
        }

        if (!empty($id)) {
            $user_id = $id;
        } else {
            $user_id = $session->get('user_id');
        }

        $user_id1 = $session->get('user_id');

        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id1)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        helper(['tanggal']);
        $model = new InovasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $inov = $model->where('user_id', $user_id)->orderby('Year', 'DESC')->orderby('Month', 'DESC')->findall();
        if (!empty($inov)) {
            $data['data_inov'] = $inov;
        } else {
            $data['data_inov'] = 'kosong';
        }

        $data['user_id'] = $user_id;
        $data['title_page'] = "V.4 Karya Temuan/Inovasi/Paten dan Implementasi Teknologi Baru (P6)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/piifair/docs/" . $id . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Inovasi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/piidok54', $data);
    }
}
