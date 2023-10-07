<?php

namespace App\Controllers;

use App\Models\CapesSemModel;
use App\Models\KompModel;
use App\Libraries\Slug;
use App\Models\ConfigModel;

class Piifair53 extends BaseController
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
        $model = new CapesSemModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $sem = $model->where('user_id', $user_id)->where('Type', 'Sem')->orderby('Year', 'DESC')->findall();
        if (!empty($sem)) {
            $data['data_sem'] = $sem;
        } else {
            $data['data_sem'] = 'kosong';
        }

        $data['user_id'] = $user_id;
        $data['title_page'] = "V.3 Seminar/Lokakarya Keinsinyuran Yang Diikuti (W2)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/piifair/docs/" . $id . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Seminar</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/piidok53', $data);
    }
}
