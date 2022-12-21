<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PengujiRplModel;
use App\Models\NilaitaModel;
use App\Models\TugasAkhirModel;
use App\Models\ProfileModel;
use App\Models\ConfigModel;

class Mannilairpl extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $user_id = $session->get('user_id');
        $model = new PengujiRplModel();
        $data['logged_in'] = $logged_in;
        $user = $model->where('dosenrpl_id', $user_id)->join('tbl_profile', 'tbl_pengujirpl.mhsrpl_id = tbl_profile.user_id', 'left')->orderby('tbl_pengujirpl.ujirpl_id', 'DESC')->findall();
        if (!empty($user)) {
            $data['data_user'] = $user;
        } else {
            $data['data_user'] = 'kosong';
        }
        $data['dosen_id'] = $session->get('user_id');
        $data['title_page'] = "Data Peserta Penilaian RPL";
        $data['data_bread'] = "Penilaian RPL";
        return view('maintemp/ujinilairpl', $data);
    }

    public function penilaianrpl($mhs_id = false, $dosen_id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $model = new ProfileModel();
        $mhsprofile = $model->where('user_id', $mhs_id)->first();
        if ($mhsprofile) {
            $data = [
                'FullName' => $mhsprofile['FullName'],
            ];
        } else {
            $data['kosong'] = 'kosong';
        }
        $data['dosen_id'] = $dosen_id;
        $data['mhs_id'] = $mhs_id;
        $data['title_page'] = "Penilaian MK RPL";
        $data['data_bread'] = "Nilai RPL";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/penilaianrpl', $data);
    }
}
