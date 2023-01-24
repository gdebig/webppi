<?php

namespace App\Controllers;

use App\Models\HakiModel;
use App\Models\KompetensiModel;
use App\Models\PkmModel;
use App\Models\PublikasiModel;
use App\Models\RisetModel;

class Manakreditasi extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Manajemen Akreditasi";
        $data['data_bread'] = "Akreditasi";
        return view('maintemp/manakreditasi', $data);
    }

    public function dosenriset()
    {
        $session = session();
        $komp_id = $session->get('komp_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $model = new RisetModel();
        $data = $model->join('tbl_profile', 'tbl_risetpengmas.dosen_id=tbl_profile.user_id', 'left')->orderBy('dosen_id', 'DESC')->findall();
        if (!empty($data)) {
            $data['data_riset'] = $data;
        } else {
            $data['data_riset'] = 'kosong';
        }

        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Data Akreditasi Riset dan Pengabdian Masyarakat";
        $data['data_bread'] = "Riset dan Pengmas";
        return view('maintemp/manakreditasiriset', $data);
    }

    public function dosenpublikasi()
    {
        $session = session();
        $komp_id = $session->get('komp_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $model = new PublikasiModel();
        $data = $model->join('tbl_profile', 'tbl_publikasi.dosen_id=tbl_profile.user_id', 'left')->orderBy('dosen_id', 'DESC')->findall();
        if (!empty($data)) {
            $data['data_pub'] = $data;
        } else {
            $data['data_pub'] = 'kosong';
        }

        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Data Akreditasi Publikasi";
        $data['data_bread'] = "Publikasi";
        return view('maintemp/manakreditasipublikasi', $data);
    }

    public function dosenhaki()
    {
        $session = session();
        $komp_id = $session->get('komp_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $model = new HakiModel();
        $data = $model->join('tbl_profile', 'tbl_haki.dosen_id=tbl_profile.user_id', 'left')->orderBy('dosen_id', 'DESC')->findall();
        if (!empty($data)) {
            $data['data_haki'] = $data;
        } else {
            $data['data_haki'] = 'kosong';
        }

        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Data Akreditasi HAKI";
        $data['data_bread'] = "HAKI";
        return view('maintemp/manakreditasihaki', $data);
    }

    public function dosenpkm()
    {
        $session = session();
        $komp_id = $session->get('komp_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $model = new PkmModel();
        $data = $model->join('tbl_profile', 'tbl_pkm.dosen_id=tbl_profile.user_id', 'left')->orderBy('dosen_id', 'DESC')->findall();
        if (!empty($data)) {
            $data['data_pkm'] = $data;
        } else {
            $data['data_pkm'] = 'kosong';
        }

        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Data Akreditasi PKM";
        $data['data_bread'] = "PKM";
        return view('maintemp/manakreditasipkm', $data);
    }

    public function dosenkompetensi()
    {
        $session = session();
        $komp_id = $session->get('komp_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $model = new KompetensiModel();
        $data = $model->join('tbl_profile', 'tbl_kompetensidosen.dosen_id=tbl_profile.user_id', 'left')->orderBy('dosen_id', 'DESC')->findall();
        if (!empty($data)) {
            $data['data_kompetensi'] = $data;
        } else {
            $data['data_kompetensi'] = 'kosong';
        }

        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Data Akreditasi Kompetensi Dosen";
        $data['data_bread'] = "Kompetensi";
        return view('maintemp/manakreditasikompetensi', $data);
    }
}
