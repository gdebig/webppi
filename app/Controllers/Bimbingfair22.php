<?php

namespace App\Controllers;

use App\Models\PendapatModel;

class Bimbingfair22 extends BaseController
{
    public function docs($id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }

        if (!empty($id)) {
            $user_id = $id;
        } else {
            $user_id = $session->get('user_id');
        }
        helper(['tanggal']);
        $model = new PendapatModel();
        $dapat = $model->where('user_id', $user_id)->orderby('Num', 'ASC')->findall();
        if (!empty($dapat)) {
            $data['data_dapat'] = $dapat;
        } else {
            $data['data_dapat'] = 'kosong';
        }
        $data['user_id'] = $user_id;
        $data['title_page'] = "II.2. Pengertian, Pendapat dan Pengalaman Sendiri (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/bimbingfair/docs/" . $id . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Pengertian, Pendapat dan Pengalaman Sendiri</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/bimbingdok22', $data);
    }

    public function tambahdapat()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new PendapatModel();

        $user_id = $session->get('user_id');

        $data['title_page'] = "II.2. Pengertian, Pendapat dan Pengalaman Sendiri (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Pengertian</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/tambahdapatuserfair', $data);
    }

    public function tambahdapatproses()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new PendapatModel();
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair22/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field pengertian, pendapat dan pengalaman sendiri harus diisi.',
                    ],
                ]
            ]);

            if ($formvalid) {
                $Desc = $this->request->getVar('Desc');

                $data = array(
                    'user_id' => $user_id,
                    'Desc' => $Desc,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );

                $model->save($data);
                $session->setFlashdata('msg', 'Data pengertian, pendapat dan pengalaman sendiri berhasil ditambah.');

                return redirect()->to('/userfair22/docs');
            } else {

                $data['title_page'] = "II.2. Pengertian, Pendapat dan Pengalaman Sendiri (W1)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Pengertian</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahdapatuserfairvalid', $data);
            }
        }
    }

    public function hapusdapat($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new PendapatModel();

        $model->delete($id);
        $session->setFlashdata('msg', 'Data pengertian, pendapat dan pengalaman sendiri berhasil dihapus.');

        return redirect()->to('/userfair22/docs');
    }

    public function ubahdapat($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new PendapatModel();
        $dapat = $model->where('Num', $id)->first();
        if ($dapat) {
            $data = [
                'Num' => $dapat['Num'],
                'user_id' => $dapat['user_id'],
                'Desc' => $dapat['Desc']
            ];
        }

        $data['title_page'] = "II.2. Pengertian, Pendapat dan Pengalaman Sendiri (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Pengertian</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahdapatuserfair', $data);
    }

    public function ubahdapatproses()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new PendapatModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair22/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field pengertian, pendapat dan pengalaman sendiri harus diisi.',
                    ],
                ]
            ]);

            if ($formvalid) {
                $Desc = $this->request->getVar('Desc');

                $data = array(
                    'Desc' => $Desc,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data pengertian, pendapat dan pengalaman sendiri berhasil diubah.');

                return redirect()->to('/userfair22/docs');
            } else {
                $dapat = $model->where('Num', $Num)->first();
                if ($dapat) {
                    $data = [
                        'Num' => $dapat['Num'],
                        'user_id' => $dapat['user_id'],
                        'Desc' => $dapat['Desc'],
                    ];
                }

                $data['title_page'] = "II.2. Pengertian, Pendapat dan Pengalaman Sendiri (W1)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Pengertian</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahdapatuserfair', $data);
            }
        }
    }
}
