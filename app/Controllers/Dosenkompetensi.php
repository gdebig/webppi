<?php

namespace App\Controllers;

use App\Models\KompetensiModel;
use App\Models\ConfigModel;

class Dosenkompetensi extends BaseController
{
    public function index()
    {
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $modelconfig = new ConfigModel();
        $config = $modelconfig->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $model = new KompetensiModel();
        $data['logged_in'] = $logged_in;
        $kompetensi = $model->where('dosen_id', $user_id)->orderBy('kompetensi_id', 'DESC')->findall();
        if (!empty($kompetensi)) {
            $data['data_kompetensi'] = $kompetensi;
        } else {
            $data['data_kompetensi'] = 'kosong';
        }
        $data['title_page'] = "Data Kompetensi Dosen";
        $data['data_bread'] = "Kompetensi";
        return view('maintemp/dosenkompetensi', $data);
    }

    public function tambahkompetensi()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $user_id = $session->get('user_id');

        $modelconfig = new ConfigModel();
        $config = $modelconfig->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Tambah Data kompetensi";
        $data['data_bread'] = "Tambah Data kompetensi";
        return view('maintemp/tambahkompetensi', $data);
    }

    public function tambahkompetensiproses()
    {

        $model = new KompetensiModel();
        $session = session();
        $issadmin = $session->get('issadmin');
        $logged_in = $session->get('logged_in');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');
        if ($button == "batal") {
            return redirect()->to('/dosenkompetensi');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'semester' => [
                    'label'  => 'Semester',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Semester harus diisi',
                    ],
                ],
                'tahun' => [
                    'label'  => 'Tahun',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Tahun harus diisi",
                    ]
                ],
                'posisi' => [
                    'label'  => 'Posisi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Posisi harus diisi",
                    ]
                ],
                'namabadan' => [
                    'label'  => 'Nama Badan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Nama Badan harus diisi",
                    ]
                ],
                'mewakili ' => [
                    'label'  => 'Mewakili',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Mewakili harus diisi",
                    ]
                ],
                'saksiahli ' => [
                    'label'  => 'Saksi Ahli',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Saksi Ahli harus diisi",
                    ]
                ],
                'waktupelaksanaan' => [
                    'label'  => 'Waktu Pelaksanaan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Waktu Pelaksanaan harus diisi",
                    ]
                ]
            ]);

            if ($formvalid) {
                $user_id = $session->get('user_id');
                $semester = $this->request->getVar('semester');
                $tahun = $this->request->getVar('tahun');
                $posisi = $this->request->getVar('posisi');
                $namabadan = $this->request->getVar('namabadan');
                $mewakili = $this->request->getVar('mewakili');
                $saksiahli = $this->request->getVar('saksiahli');
                $waktupelaksanaan = $this->request->getVar('waktupelaksanaan');

                $datakompetensi = array(
                    'dosen_id' => $user_id,
                    'semester' => $semester,
                    'tahun' => $tahun,
                    'posisi' => $posisi,
                    'namabadan' => $namabadan,
                    'mewakili' => $mewakili,
                    'saksiahli' => $saksiahli,
                    'waktupelaksanaan' => $waktupelaksanaan,
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($datakompetensi);

                $session->setFlashdata('msg', 'Data kompetensi berhasil ditambahkan.');

                return redirect()->to('/dosenkompetensi');
            } else {
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Tambah Data kompetensi";
                $data['data_bread'] = "Tambah Data kompetensi";
                $data['validation'] = $this->validator;
                return view('maintemp/tambahkompetensivalid', $data);
            }
        }
    }

    public function hapuskompetensi($id)
    {
        $model = new KompetensiModel();
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $model->delete(['kompetensi_id' => $id, 'dosen_id' => $user_id]);

        $session->setFlashdata('msg', 'Data kompetensi berhasil dihapus.');

        return redirect()->to('/dosenkompetensi');
    }

    public function ubahkompetensi($id)
    {
        $model = new KompetensiModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $user_id = $session->get('user_id');

        $modelconfig = new ConfigModel();
        $config = $modelconfig->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $kompetensi = $model->where('kompetensi_id', $id)->first();
        if ($kompetensi) {
            $data = [
                'kompetensi_id' => $kompetensi['kompetensi_id'],
                'semester' => $kompetensi['semester'],
                'tahun' => $kompetensi['tahun'],
                'posisi' => $kompetensi['posisi'],
                'namabadan' => $kompetensi['namabadan'],
                'mewakili' => $kompetensi['mewakili'],
                'saksiahli' => $kompetensi['saksiahli'],
                'waktupelaksanaan' => $kompetensi['waktupelaksanaan']
            ];
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Ubah Data Kompetensi";
        $data['data_bread'] = "Ubah Data Kompetensi";
        return view('maintemp/ubahkompetensi', $data);
    }

    public function ubahkompetensiproses()
    {
        $model = new KompetensiModel();
        $session = session();
        $kompetensi_id = $this->request->getVar('kompetensi_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/dosenkompetensi');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'semester' => [
                    'label'  => 'Semester',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Semester harus diisi',
                    ],
                ],
                'tahun' => [
                    'label'  => 'Tahun',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Tahun harus diisi",
                    ]
                ],
                'posisi' => [
                    'label'  => 'Posisi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Posisi harus diisi",
                    ]
                ],
                'namabadan' => [
                    'label'  => 'Nama Badan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Nama Badan harus diisi",
                    ]
                ],
                'mewakili ' => [
                    'label'  => 'Mewakili',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Mewakili harus diisi",
                    ]
                ],
                'saksiahli ' => [
                    'label'  => 'Saksi Ahli',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Saksi Ahli harus diisi",
                    ]
                ],
                'waktupelaksanaan' => [
                    'label'  => 'Waktu Pelaksanaan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Waktu Pelaksanaan harus diisi",
                    ]
                ]
            ]);

            if ($formvalid) {
                $semester = $this->request->getVar('semester');
                $tahun = $this->request->getVar('tahun');
                $posisi = $this->request->getVar('posisi');
                $namabadan = $this->request->getVar('namabadan');
                $mewakili = $this->request->getVar('mewakili');
                $saksiahli = $this->request->getVar('saksiahli');
                $waktupelaksanaan = $this->request->getVar('waktupelaksanaan');

                $datakompetensi = array(
                    'semester' => $semester,
                    'tahun' => $tahun,
                    'posisi' => $posisi,
                    'namabadan' => $namabadan,
                    'mewakili' => $mewakili,
                    'saksiahli' => $saksiahli,
                    'waktupelaksanaan' => $waktupelaksanaan,
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->update($kompetensi_id, $datakompetensi);

                $session->setFlashdata('msg', 'Data kompetensi berhasil diubah.');

                return redirect()->to('/dosenkompetensi');
            } else {
                $kompetensi = $model->where('kompetensi_id', $kompetensi_id)->first();
                if ($kompetensi) {
                    $data = [
                        'kompetensi_id' => $kompetensi['kompetensi_id'],
                        'semester' => $kompetensi['semester'],
                        'tahun' => $kompetensi['tahun'],
                        'posisi' => $kompetensi['posisi'],
                        'namabadan' => $kompetensi['namabadan'],
                        'mewakili' => $kompetensi['mewakili'],
                        'saksiahli' => $kompetensi['saksiahli'],
                        'waktupelaksanaan' => $kompetensi['waktupelaksanaan']
                    ];
                }
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Ubah Data kompetensi";
                $data['data_bread'] = "Ubah Data kompetensi";
                $data['validation'] = $this->validator;
                return view('maintemp/ubahkompetensi', $data);
            }
        }
    }
}
