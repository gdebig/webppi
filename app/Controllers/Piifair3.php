<?php

namespace App\Controllers;

use App\Models\CapesKualifikasiModel;
use App\Models\KompModel;
use App\Libraries\Slug;
use App\Models\ConfigModel;

class Piifair3 extends BaseController
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
        $model = new CapesKualifikasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kerja = $model->where('user_id', $user_id)->orderby('ProjValue', 'DESC')->findall();
        if (!empty($kerja)) {
            $data['data_kerja'] = $kerja;
        } else {
            $data['data_kerja'] = 'kosong';
        }

        $data['user_id'] = $user_id;
        $data['title_page'] = "III. KUALIFIKASI PROFESIONAL (W2,W3,W4,P6,P7,P8,P9,P10,P11)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/piifair/docs/" . $id . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Kualifikasi Profesional</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/piidok3', $data);
    }
}
