<?php

namespace App\Controllers;

use App\Models\AkunModel;
use App\Models\ConfigModel;
use App\Models\UmumModel;

class Penilai extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        $user_id = $session->get('user_id');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }

        $model = new UmumModel();
        $umum = $model->like('umum_tujuan', '__y')->orderby('umum_id', 'DESC')->findall();
        if (!empty($umum)) {
            $data['data_umum'] = $umum;
        } else {
            $data['data_umum'] = 'kosong';
        }

        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['informasi'] = 'Selamat datang sebagai role Penilai. Pada modul ini, tersedia menu yang diperlukan penilai untuk melakukan penilaian Peserta RPL.';
        $data['title_page'] = "Dashboard PPI RPL";
        $data['data_bread'] = "dashboard";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/dashboard', $data);
    }

    public function dashboard()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        $user_id = $session->get('user_id');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }

        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['title_page'] = "Dashboard PPI RPL";
        $data['data_bread'] = "dashboard";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/dashboard', $data);
    }

    public function dokumen()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        $user_id = $session->get('user_id');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }

        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['title_page'] = "Dokumen Akreditasi Penilai";
        $data['data_bread'] = "Dokumen Akreditasi";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/akreditasi', $data);
    }
}
