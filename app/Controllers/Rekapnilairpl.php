<?php

namespace App\Controllers;

use App\Models\NilairplsiakModel;

class Rekapnilairpl extends BaseController
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
        helper(['nilai']);

        $model = new NilairplsiakModel();
        $datanilai = $model->join('tbl_user', 'tbl_nilairplsiak.mhs_id = tbl_user.user_id', 'left')->join('tbl_profile', 'tbl_nilairplsiak.mhs_id = tbl_profile.user_id', 'left')->orderby('tbl_profile.FullName', 'ASC')->orderby('tbl_nilairplsiak.tahun', 'DESC')->orderby('tbl_nilairplsiak.semester', 'ASC')->findall();
        if (!empty($datanilai)) {
            $data['data_nilai'] = $datanilai;
        } else {
            $data['data_nilai'] = 'kosong';
        }

        $data['title_page'] = "Daftar Nilai RPL Final";
        $data['data_bread'] = "Daftar Nilai";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/daftarnilaifinal', $data);
    }
}
