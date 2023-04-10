<?php

namespace App\Controllers;

use App\Models\PkmModel;
use App\Models\ConfigModel;

class Dosenpkm extends BaseController
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

        $model = new PkmModel();
        $data['logged_in'] = $logged_in;
        $pkm = $model->where('dosen_id', $user_id)->orderBy('pkm_id', 'DESC')->findall();
        if (!empty($pkm)) {
            $data['data_pkm'] = $pkm;
        } else {
            $data['data_pkm'] = 'kosong';
        }
        $data['title_page'] = "Data Program Kreativitas Mahasiswa (PKM)";
        $data['data_bread'] = "PKM";
        return view('maintemp/dosenpkm', $data);
    }

    public function tambahpkm()
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
        $data['title_page'] = "Tambah Data PKM";
        $data['data_bread'] = "Tambah Data PKM";
        return view('maintemp/tambahpkm', $data);
    }

    public function tambahpkmproses()
    {

        $model = new PkmModel();
        $session = session();
        $issadmin = $session->get('issadmin');
        $logged_in = $session->get('logged_in');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');
        if ($button == "batal") {
            return redirect()->to('/dosenpkm');
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
                    'label'  => 'Judul PKM',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Judul PKM harus diisi",
                    ]
                ],
                'sumberdana ' => [
                    'label'  => 'Sumber Dana',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Sumber Dana harus diisi",
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
                $judul = $this->request->getVar('judul');
                $sumberdana = $this->request->getVar('sumberdana');
                $waktupelaksanaan = $this->request->getVar('waktupelaksanaan');

                $datapkm = array(
                    'dosen_id' => $user_id,
                    'semester' => $semester,
                    'tahun' => $tahun,
                    'judul' => $judul,
                    'sumberdana' => $sumberdana,
                    'waktupelaksanaan' => $waktupelaksanaan,
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($datapkm);

                $session->setFlashdata('msg', 'Data PKM berhasil ditambahkan.');

                return redirect()->to('/dosenpkm');
            } else {
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Tambah Data PKM";
                $data['data_bread'] = "Tambah Data PKM";
                $data['validation'] = $this->validator;
                return view('maintemp/tambahpkmvalid', $data);
            }
        }
    }

    public function hapuspkm($id)
    {
        $model = new PkmModel();
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $model->delete(['pkm_id' => $id, 'dosen_id' => $user_id]);

        $session->setFlashdata('msg', 'Data PKM berhasil dihapus.');

        return redirect()->to('/dosenpkm');
    }

    public function ubahpkm($id)
    {
        $model = new PkmModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $pkm = $model->where('pkm_id', $id)->first();
        if ($pkm) {
            $data = [
                'pkm_id' => $pkm['pkm_id'],
                'semester' => $pkm['semester'],
                'tahun' => $pkm['tahun'],
                'judul' => $pkm['judul'],
                'sumberdana' => $pkm['sumberdana'],
                'waktupelaksanaan' => $pkm['waktupelaksanaan']
            ];
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
        $data['title_page'] = "Ubah Data PKM";
        $data['data_bread'] = "Ubah Data PKM";
        return view('maintemp/ubahpkm', $data);
    }

    public function ubahpkmproses()
    {
        $model = new PkmModel();
        $session = session();
        $pkm_id = $this->request->getVar('pkm_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/dosenpkm');
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
                    'label'  => 'Judul PKM Semester Yang Lalu',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Judul PKM harus diisi",
                    ]
                ],
                'sumberdana ' => [
                    'label'  => 'Sumber Dana',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Sumber Dana harus diisi",
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
                $judul = $this->request->getVar('judul');
                $sumberdana = $this->request->getVar('sumberdana');
                $waktupelaksanaan = $this->request->getVar('waktupelaksanaan');

                $datapkm = array(
                    'semester' => $semester,
                    'tahun' => $tahun,
                    'judul' => $judul,
                    'sumberdana' => $sumberdana,
                    'waktupelaksanaan' => $waktupelaksanaan,
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->update($pkm_id, $datapkm);

                $session->setFlashdata('msg', 'Data PKM berhasil diubah.');

                return redirect()->to('/dosenpkm');
            } else {
                $pkm = $model->where('pkm_id', $pkm_id)->first();
                if ($pkm) {
                    $data = [
                        'pkm_id' => $pkm['pkm_id'],
                        'semester' => $pkm['semester'],
                        'tahun' => $pkm['tahun'],
                        'judul' => $pkm['judul'],
                        'sumberdana' => $pkm['sumberdana'],
                        'waktupelaksanaan' => $pkm['waktupelaksanaan']
                    ];
                }
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Ubah Data pkm";
                $data['data_bread'] = "Ubah Data pkm";
                $data['validation'] = $this->validator;
                return view('maintemp/ubahpkm', $data);
            }
        }
    }
}
