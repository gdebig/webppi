<?php

namespace App\Controllers;

use App\Models\RisetModel;

class Dosenriset extends BaseController
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

        $model = new RisetModel();
        $data['logged_in'] = $logged_in;
        $riset = $model->where('dosen_id', $user_id)->orderBy('riset_id', 'DESC')->findall();
        if (!empty($riset)) {
            $data['data_riset'] = $riset;
        } else {
            $data['data_riset'] = 'kosong';
        }
        $data['title_page'] = "Data Riset dan Pengmas";
        $data['data_bread'] = "Riset dan Pengmas";
        return view('maintemp/dosenriset', $data);
    }

    public function tambahriset()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Tambah Data Riset dan Pengabdian Masyarakat";
        $data['data_bread'] = "Tambah Data Riset dan Pengmas";
        return view('maintemp/tambahriset', $data);
    }

    public function tambahrisetproses()
    {

        $model = new RisetModel();
        $session = session();
        $issadmin = $session->get('issadmin');
        $logged_in = $session->get('logged_in');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');
        if ($button == "batal") {
            return redirect()->to('/dosenriset');
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
                    'label'  => 'Judul Penelitian / Pengabdian Masyarakat Semester Yang Lalu',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Judul Penelitian / Pengabdian Masyarakat harus diisi",
                    ]
                ],
                'tipe' => [
                    'label'  => 'Jenis',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Jenis harus diisi",
                    ]
                ],
                'asal_dana' => [
                    'label'  => 'Sumber Dana',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Sumber Dana harus diisi",
                    ]
                ],
                'namahibah' => [
                    'label'  => 'Nama Hibah / Sumber Pendanaan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Nama Hibah / Sumber Pendanaan harus diisi",
                    ]
                ],
                'tanggalawal' => [
                    'label'  => 'Tanggal Peroleh Hibah',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Tanggal Peroleh Hibah harus diisi",
                    ]
                ],
                'tanggalakhir' => [
                    'label'  => 'Tanggal Hibah Selesai',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Tanggal Hibah Selesai harus diisi",
                    ]
                ],
                'ProjValue' => [
                    'label'  => 'Jumlah Dana yang Diperoleh',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Jumlah Dana yang Diperoleh harus diisi",
                    ]
                ]
            ]);

            if ($formvalid) {
                $user_id = $session->get('user_id');
                $semester = $this->request->getVar('semester');
                $tahun = $this->request->getVar('tahun');
                $judul = $this->request->getVar('judul');
                $tipe = $this->request->getVar('tipe');
                $asal_dana = $this->request->getVar('asal_dana');
                $namahibah = $this->request->getVar('namahibah');
                $tanggalawal = $this->request->getVar('tanggalawal');
                $tanggalakhir = $this->request->getVar('tanggalakhir');
                $jumlahdana = $this->request->getVar('ProjValue');

                $datariset = array(
                    'dosen_id' => $user_id,
                    'semester' => $semester,
                    'tahun' => $tahun,
                    'judul' => $judul,
                    'tipe' => $tipe,
                    'asal_dana' => $asal_dana,
                    'namahibah' => $namahibah,
                    'tanggalawal' => $tanggalawal,
                    'tanggalakhir' => $tanggalakhir,
                    'jumlahdana' => $jumlahdana,
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($datariset);

                $session->setFlashdata('msg', 'Data riset/pengabdian masyarakat berhasil ditambahkan.');

                return redirect()->to('/dosenriset');
            } else {
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Tambah Data Riset dan Pengabdian Masyarakat";
                $data['data_bread'] = "Tambah Data Riset dan Pengmas";
                $data['validation'] = $this->validator;
                return view('maintemp/tambahrisetvalid', $data);
            }
        }
    }

    public function hapusriset($id)
    {
        $model = new RisetModel();
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $model->delete(['riset_id' => $id, 'dosen_id' => $user_id]);

        $session->setFlashdata('msg', 'Data riset/pengabdian masyarakat berhasil dihapus.');

        return redirect()->to('/dosenriset');
    }

    public function ubahriset($id)
    {
        $model = new RisetModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $riset = $model->where('riset_id', $id)->first();
        if ($riset) {
            if (!empty($riset['jumlahdana'])) {
                $Project = explode(".", $riset['jumlahdana']);
                $str = preg_replace('/[^0-9.]+/', '', $Project[1]);
            } else {
                $str = '';
            }
            $data = [
                'riset_id' => $riset['riset_id'],
                'semester' => $riset['semester'],
                'tahun' => $riset['tahun'],
                'judul' => $riset['judul'],
                'tipe' => $riset['tipe'],
                'asal_dana' => $riset['asal_dana'],
                'namahibah' => $riset['namahibah'],
                'tanggalawal' => $riset['tanggalawal'],
                'tanggalakhir' => $riset['tanggalakhir'],
                'ProjValue' => $str
            ];
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Ubah Data Riset dan Pengabdian Masyarakat";
        $data['data_bread'] = "Ubah Data Riset / Pengmas";
        return view('maintemp/ubahriset', $data);
    }

    public function ubahrisetproses()
    {
        $model = new RisetModel();
        $session = session();
        $riset_id = $this->request->getVar('riset_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/dosenriset');
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
                    'label'  => 'Judul Penelitian / Pengabdian Masyarakat Semester Yang Lalu',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Judul Penelitian / Pengabdian Masyarakat harus diisi",
                    ]
                ],
                'tipe' => [
                    'label'  => 'Jenis',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Jenis harus diisi",
                    ]
                ],
                'asal_dana' => [
                    'label'  => 'Sumber Dana',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Sumber Dana harus diisi",
                    ]
                ],
                'namahibah' => [
                    'label'  => 'Nama Hibah / Sumber Pendanaan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Nama Hibah / Sumber Pendanaan harus diisi",
                    ]
                ],
                'tanggalawal' => [
                    'label'  => 'Tanggal Peroleh Hibah',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Tanggal Peroleh Hibah harus diisi",
                    ]
                ],
                'tanggalakhir' => [
                    'label'  => 'Tanggal Hibah Selesai',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Tanggal Hibah Selesai harus diisi",
                    ]
                ],
                'ProjValue' => [
                    'label'  => 'Jumlah Dana yang Diperoleh',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Jumlah Dana yang Diperoleh harus diisi",
                    ]
                ],
            ]);

            if ($formvalid) {

                $riset_id = $this->request->getVar('riset_id');
                $semester = $this->request->getVar('semester');
                $tahun = $this->request->getVar('tahun');
                $judul = $this->request->getVar('judul');
                $tipe = $this->request->getVar('tipe');
                $asal_dana = $this->request->getVar('asal_dana');
                $namahibah = $this->request->getVar('namahibah');
                $tanggalawal = $this->request->getVar('tanggalawal');
                $tanggalakhir = $this->request->getVar('tanggalakhir');
                $jumlahdana = $this->request->getVar('ProjValue');

                $datariset = array(
                    'semester' => $semester,
                    'tahun' => $tahun,
                    'judul' => $judul,
                    'tipe' => $tipe,
                    'asal_dana' => $asal_dana,
                    'namahibah' => $namahibah,
                    'tanggalawal' => $tanggalawal,
                    'tanggalakhir' => $tanggalakhir,
                    'jumlahdana' => $jumlahdana,
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->update($riset_id, $datariset);

                $session->setFlashdata('msg', 'Data riset/pengabdian masyarakat berhasil diubah.');

                return redirect()->to('/manriset');
            } else {
                $riset = $model->where('riset_id', $riset_id)->first();
                if ($riset) {
                    if (!empty($riset['jumlahdana'])) {
                        $Project = explode(".", $riset['jumlahdana']);
                        $str = preg_replace('/[^0-9.]+/', '', $Project[1]);
                    } else {
                        $str = '';
                    }
                    $data = [
                        'riset_id' => $riset['riset_id'],
                        'semester' => $riset['semester'],
                        'tahun' => $riset['tahun'],
                        'judul' => $riset['judul'],
                        'tipe' => $riset['tipe'],
                        'asal_dana' => $riset['asal_dana'],
                        'namahibah' => $riset['namahibah'],
                        'tanggalawal' => $riset['tanggalawal'],
                        'tanggalakhir' => $riset['tanggalakhir'],
                        'ProjValue' => $str
                    ];
                }
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Ubah Data Riset dan Pengabdian Masyarakat";
                $data['data_bread'] = "Ubah Data Riset / Pengmas";
                $data['validation'] = $this->validator;
                return view('maintemp/ubahriset', $data);
            }
        }
    }
}
