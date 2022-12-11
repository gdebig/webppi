<?php

//tampilan fair utk penilai

namespace App\Controllers;

use App\Models\ProfileModel;

class Bimbingfair extends BaseController
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
            $session->set('role', 'penilai');
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
        $data['mhs_id'] = $mhs_id;
        $data['title_page'] = "Dokumen FAIR PPI RPL";
        $data['data_bread'] = "Dokumen FAIR";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/bimbingfair', $data);
    }
}
