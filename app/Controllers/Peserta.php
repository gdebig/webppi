<?php

namespace App\Controllers;

use App\Models\UmumModel;

class Peserta extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }

        $model = new UmumModel();
        $umum = $model->like('umum_tujuan', '_y_')->orderby('umum_id', 'DESC')->findall();
        if (!empty($umum)) {
            $data['data_umum'] = $umum;
        } else {
            $data['data_umum'] = 'kosong';
        }

        $data['informasi'] = 'Selamat datang sebagai Peserta RPL. Pada web ini, peserta RPL dapat mengisi formulir FAIP serta mengupload laporan Praktek Keinsinyuran.';

        $data['title_page'] = "Dashboard PPI RPL";
        $data['data_bread'] = "dashboard";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/dashboard', $data);
    }
}
