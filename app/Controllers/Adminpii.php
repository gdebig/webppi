<?php

namespace App\Controllers;

use App\Models\UmumModel;

class Adminpii extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'admin');
        }

        $model = new UmumModel();
        $umum = $model->orderby('umum_id', 'DESC')->findall();
        if (!empty($umum)) {
            $data['data_umum'] = $umum;
        } else {
            $data['data_umum'] = 'kosong';
        }

        $data['informasi'] = 'Selamat datang Admin. Pada modul ini, tersedia menu yang diperlukan admin untuk mengelola Calon Peserta, Peserta, Majelis Penilai dan Laporan.';
        $data['title_page'] = "Dashboard PPI RPL";
        $data['data_bread'] = "dashboard";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/dashboard', $data);
    }
}
