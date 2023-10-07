<?php

//tampilan fair utk penilai

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Models\ConfigModel;

class Piifair extends BaseController
{
    public function docs($id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (($issadmin) || ($isadmin) || ($ispenilai))) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'admin');
        }
        helper(['tanggal']);
        if (!empty($id)) {
            $mhs_id = $id;
        } else {
            $mhs_id = $session->get('user_id');
        }
        $model = new ProfileModel();
        $mhsprofile = $model->where('user_id', $mhs_id)->first();
        if ($mhsprofile) {
            $data = [
                'FullName' => $mhsprofile['FullName'],
            ];
        } else {
            $data['kosong'] = 'kosong';
        }
        $user_id = $session->get('user_id');

        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['mhs_id'] = $mhs_id;
        $data['title_page'] = "Dokumen FAIR PPI RPL";
        $data['data_bread'] = "Dokumen FAIR";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/piifair', $data);
    }
}
