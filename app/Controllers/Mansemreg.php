<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BimbingModel;
use App\Models\NilaitaModel;
use App\Models\TugasAkhirModel;
use App\Models\ProfileModel;
use App\Models\ConfigModel;
use App\Models\SeminarModel;

class Mansemreg extends BaseController
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

        $model = new SeminarModel();
        $user = $model->join('tbl_profile', 'tbl_semreg.mhs_id = tbl_profile.user_id', 'left')->join('tbl_user', 'tbl_semreg.mhs_id = tbl_user.user_id', 'left')->orderby('tbl_semreg.sem_id', 'DESC')->findall();
        if (!empty($user)) {
            $data['data_user'] = $user;
        } else {
            $data['data_user'] = 'kosong';
        }

        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Data Peserta Seminar Regular";
        $data['data_bread'] = "Seminar";
        return view('maintemp/semreg', $data);
    }

    public function berinilai($sem_id)
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
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $model = new SeminarModel();
        $sem = $model->where('sem_id', $sem_id)->join('tbl_profile', 'tbl_semreg.mhs_id = tbl_profile.user_id', 'left')->join('tbl_user', 'tbl_semreg.mhs_id = tbl_user.user_id', 'left')->orderby('tbl_semreg.sem_id', 'DESC')->first();
        if (!empty($sem)) {
            $data['sem_id'] = $sem['sem_id'];
            $data['mhs_fullname'] = $sem['FullName'];
            $data['mhs_username'] = $sem['username'];
            $data['sem_judul'] = $sem['sem_judul'];
            $data['sem_bukti'] = $sem['sem_bukti'];
        } else {
            $data['data_sem'] = 'kosong';
        }

        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Nilai Seminar PPI Regular";
        $data['data_bread'] = "Nilai Seminar";
        return view('maintemp/nilaisemreg', $data);
    }

    public function nilaisemregproses()
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
        $sem_id = $this->request->getVar('sem_id');

        $submit = $this->request->getVar('submit');
        if ($submit == "batal") {
            return redirect()->to('/mansemreg');
        } else {
            $model = new SeminarModel();
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'nilai' => [
                    'label'  => 'Nilai Seminar',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nilai Seminar harus diisi.',
                    ],
                ]
            ]);
        }
        if ($formvalid) {
            $nilai = $this->request->getVar('nilai');

            $data = array(
                'sem_nilai' => $nilai,
                'date_created' => date('Y-m-d'),
                'date_modified' => date('Y-m-d')
            );

            $model->update($sem_id, $data);

            return redirect()->to('/mansemreg');
        } else {

            $model2 = new ConfigModel();
            $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
            if ($config) {
                $data['koor_tugasakhir'] = True;
            } else {
                $data['koor_tugasakhir'] = False;
            }

            $model = new SeminarModel();
            $sem = $model->where('sem_id', $sem_id)->join('tbl_profile', 'tbl_semreg.mhs_id = tbl_profile.user_id', 'left')->join('tbl_user', 'tbl_semreg.mhs_id = tbl_user.user_id', 'left')->orderby('tbl_semreg.sem_id', 'DESC')->first();
            if (!empty($sem)) {
                $data['sem_id'] = $sem['sem_id'];
                $data['mhs_fullname'] = $sem['FullName'];
                $data['mhs_username'] = $sem['username'];
                $data['sem_judul'] = $sem['sem_judul'];
                $data['sem_bukti'] = $sem['sem_bukti'];
            } else {
                $data['data_sem'] = 'kosong';
            }
            $data['logged_in'] = $logged_in;
            $data['title_page'] = "Nilai Seminar PPI Regular";
            $data['data_bread'] = "Nilai Seminar";
            $data['validation'] = $this->validator;
            return view('maintemp/nilaisemreg', $data);
        }
    }
}
