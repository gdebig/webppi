<?php

namespace App\Controllers;

use App\Models\CapesPendModel;
use App\Models\ConfigModel;

class Piifair12 extends BaseController
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
        helper(['tanggal']);

        $user_id1 = $session->get('user_id');

        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id1)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $model = new CapesPendModel();

        $pend = $model->where('user_id', $user_id)->orderby('GradYear', 'DESC')->findall();
        if (!empty($pend)) {
            $data['data_pend'] = $pend;
        } else {
            $data['data_pend'] = 'kosong';
        }
        $data['user_id'] = $user_id;
        $data['title_page'] = "I.2. Pendidikan Formal (W2)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/piifair/docs/" . $id . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Pendidikan Formal</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/piidok12', $data);
    }
}
