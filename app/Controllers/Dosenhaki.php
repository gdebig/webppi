<?php

namespace App\Controllers;

use App\Models\HakiModel;
use App\Models\ConfigModel;

class Dosenhaki extends BaseController
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

        $model = new HakiModel();
        $data['logged_in'] = $logged_in;
        $haki = $model->where('dosen_id', $user_id)->orderBy('haki_id', 'DESC')->findall();
        if (!empty($haki)) {
            $data['data_haki'] = $haki;
        } else {
            $data['data_haki'] = 'kosong';
        }
        $data['title_page'] = "Data HAKI";
        $data['data_bread'] = "HAKI";
        return view('maintemp/dosenhaki', $data);
    }

    public function tambahhaki()
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
        $data['title_page'] = "Tambah Data HAKI";
        $data['data_bread'] = "Tambah Data HAKI";
        return view('maintemp/tambahhaki', $data);
    }

    public function tambahhakiproses()
    {

        $model = new HakiModel();
        $session = session();
        $issadmin = $session->get('issadmin');
        $logged_in = $session->get('logged_in');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');
        if ($button == "batal") {
            return redirect()->to('/dosenhaki');
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
                'judul' => [
                    'label'  => 'Judul Luaran Semester Yang Lalu',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Judul Luaran Semester Yang Lalu harus diisi",
                    ]
                ],
                'jenis ' => [
                    'label'  => 'Jenis Luaran',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Jenis Luaran harus diisi",
                    ]
                ],
                'nomorhaki' => [
                    'label'  => 'Nomor HAKI',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Nomor HAKI harus diisi",
                    ]
                ],
                'tanggalperoleh' => [
                    'label'  => 'Tanggal Perolehan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Tanggal Perolehan harus diisi",
                    ]
                ]
            ]);

            if ($formvalid) {
                $user_id = $session->get('user_id');
                $semester = $this->request->getVar('semester');
                $tahun = $this->request->getVar('tahun');
                $judul = $this->request->getVar('judul');
                $jenis = $this->request->getVar('jenis');
                $nomorhaki = $this->request->getVar('nomorhaki');
                $tanggalperoleh = $this->request->getVar('tanggalperoleh');

                $datahaki = array(
                    'dosen_id' => $user_id,
                    'semester' => $semester,
                    'tahun' => $tahun,
                    'judul' => $judul,
                    'jenis' => $jenis,
                    'nomorhaki' => $nomorhaki,
                    'tanggalperoleh' => $tanggalperoleh,
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($datahaki);

                $session->setFlashdata('msg', 'Data HAKI berhasil ditambahkan.');

                return redirect()->to('/dosenhaki');
            } else {
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Tambah Data HAKI";
                $data['data_bread'] = "Tambah Data HAKI";
                $data['validation'] = $this->validator;
                return view('maintemp/tambahhakivalid', $data);
            }
        }
    }

    public function hapusHAKI($id)
    {
        $model = new HakiModel();
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $model->delete(['haki_id' => $id, 'dosen_id' => $user_id]);

        $session->setFlashdata('msg', 'Data HAKI berhasil dihapus.');

        return redirect()->to('/dosenhaki');
    }

    public function ubahHAKI($id)
    {
        $model = new HakiModel();
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

        $haki = $model->where('haki_id', $id)->first();
        if ($haki) {
            $data = [
                'haki_id' => $haki['haki_id'],
                'semester' => $haki['semester'],
                'tahun' => $haki['tahun'],
                'judul' => $haki['judul'],
                'jenis' => $haki['jenis'],
                'nomorhaki' => $haki['nomorhaki'],
                'tanggalperoleh' => $haki['tanggalperoleh']
            ];
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Ubah Data HAKI";
        $data['data_bread'] = "Ubah Data HAKI";
        return view('maintemp/ubahhaki', $data);
    }

    public function ubahhakiproses()
    {
        $model = new HakiModel();
        $session = session();
        $haki_id = $this->request->getVar('haki_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/dosenhaki');
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
                'judul' => [
                    'label'  => 'Judul Luaran Semester Yang Lalu',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Judul Luaran harus diisi",
                    ]
                ],
                'jenis ' => [
                    'label'  => 'Jenis Luaran',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Jenis Luaran harus diisi",
                    ]
                ],
                'nomorhaki' => [
                    'label'  => 'Nomor HAKI',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Nomor HAKI harus diisi",
                    ]
                ],
                'tanggalperoleh' => [
                    'label'  => 'Tanggal Perolehan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Tanggal Perolehan harus diisi",
                    ]
                ]
            ]);

            if ($formvalid) {
                $semester = $this->request->getVar('semester');
                $tahun = $this->request->getVar('tahun');
                $judul = $this->request->getVar('judul');
                $jenis = $this->request->getVar('jenis');
                $nomorhaki = $this->request->getVar('nomorhaki');
                $tanggalperoleh = $this->request->getVar('tanggalperoleh');

                $datahaki = array(
                    'semester' => $semester,
                    'tahun' => $tahun,
                    'judul' => $judul,
                    'jenis' => $jenis,
                    'nomorhaki' => $nomorhaki,
                    'tanggalperoleh' => $tanggalperoleh,
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->update($haki_id, $datahaki);

                $session->setFlashdata('msg', 'Data HAKI berhasil diubah.');

                return redirect()->to('/dosenhaki');
            } else {
                $haki = $model->where('haki_id', $haki_id)->first();
                if ($haki) {
                    $data = [
                        'haki_id' => $haki['haki_id'],
                        'semester' => $haki['semester'],
                        'tahun' => $haki['tahun'],
                        'judul' => $haki['judul'],
                        'jenis' => $haki['jenis'],
                        'nomorhaki' => $haki['nomorhaki'],
                        'tanggalperoleh' => $haki['tanggalperoleh']
                    ];
                }
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Ubah Data HAKI";
                $data['data_bread'] = "Ubah Data HAKI";
                $data['validation'] = $this->validator;
                return view('maintemp/ubahhaki', $data);
            }
        }
    }
}
