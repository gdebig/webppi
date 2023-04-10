<?php

namespace App\Controllers;

use App\Models\PublikasiModel;
use App\Models\ConfigModel;

class Dosenpublikasi extends BaseController
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

        $model = new PublikasiModel();
        $data['logged_in'] = $logged_in;
        $pub = $model->where('dosen_id', $user_id)->orderBy('pub_id', 'DESC')->findall();
        if (!empty($pub)) {
            $data['data_pub'] = $pub;
        } else {
            $data['data_pub'] = 'kosong';
        }
        $data['title_page'] = "Data Publikasi";
        $data['data_bread'] = "Publikasi";
        return view('maintemp/dosenpublikasi', $data);
    }

    public function tambahpublikasi()
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
        $data['title_page'] = "Tambah Data Publikasi";
        $data['data_bread'] = "Tambah Data Publikasi";
        return view('maintemp/tambahpublikasi', $data);
    }

    public function tambahpubproses()
    {

        $model = new PublikasiModel();
        $session = session();
        $issadmin = $session->get('issadmin');
        $logged_in = $session->get('logged_in');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');
        if ($button == "batal") {
            return redirect()->to('/dosenpublikasi');
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
                    'label'  => 'Judul Artikel',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Judul Artikel harus diisi",
                    ]
                ],
                'jenis ' => [
                    'label'  => 'Jenis Publikasi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Jenis Publikasi harus diisi",
                    ]
                ],
                'tanggalpublikasi' => [
                    'label'  => 'Tanggal Publikasi / Seminar',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Tanggal Publikasi / Seminar harus diisi",
                    ]
                ],
                'linkpublikasi' => [
                    'label'  => 'Link Publikasi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Link Publikasi harus diisi",
                    ]
                ]
            ]);

            if ($formvalid) {
                $user_id = $session->get('user_id');
                $semester = $this->request->getVar('semester');
                $tahun = $this->request->getVar('tahun');
                $judul = $this->request->getVar('judul');
                $jenis = $this->request->getVar('jenis');
                $tanggalpublikasi = $this->request->getVar('tanggalpublikasi');
                $linkpublikasi = $this->request->getVar('linkpublikasi');

                $datapub = array(
                    'dosen_id' => $user_id,
                    'semester' => $semester,
                    'tahun' => $tahun,
                    'judul' => $judul,
                    'jenis' => $jenis,
                    'tanggalpublikasi' => $tanggalpublikasi,
                    'linkpublikasi' => $linkpublikasi,
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($datapub);

                $session->setFlashdata('msg', 'Data publikasi berhasil ditambahkan.');

                return redirect()->to('/dosenpublikasi');
            } else {
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Tambah Data Publikasi";
                $data['data_bread'] = "Tambah Data Publikasi";
                $data['validation'] = $this->validator;
                return view('maintemp/tambahpubvalid', $data);
            }
        }
    }

    public function hapuspublikasi($id)
    {
        $model = new PublikasiModel();
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $model->delete(['pub_id' => $id, 'dosen_id' => $user_id]);

        $session->setFlashdata('msg', 'Data publikasi berhasil dihapus.');

        return redirect()->to('/dosenpublikasi');
    }

    public function ubahpublikasi($id)
    {
        $model = new PublikasiModel();
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

        $pub = $model->where('pub_id', $id)->first();
        if ($pub) {
            $data = [
                'pub_id' => $pub['pub_id'],
                'semester' => $pub['semester'],
                'tahun' => $pub['tahun'],
                'judul' => $pub['judul'],
                'jenis' => $pub['jenis'],
                'tanggalpublikasi' => $pub['tanggalpublikasi'],
                'linkpublikasi' => $pub['linkpublikasi']
            ];
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Ubah Data Publikasi";
        $data['data_bread'] = "Ubah Data Publikasi";
        return view('maintemp/ubahpublikasi', $data);
    }

    public function ubahpubproses()
    {
        $model = new PublikasiModel();
        $session = session();
        $pub_id = $this->request->getVar('pub_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/dosenpublikasi');
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
                    'label'  => 'Judul Artikel',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Judul Artikel harus diisi",
                    ]
                ],
                'jenis ' => [
                    'label'  => 'Jenis Publikasi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Jenis Publikasi harus diisi",
                    ]
                ],
                'tanggalpublikasi' => [
                    'label'  => 'Tanggal Publikasi / Seminar',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Tanggal Publikasi / Seminar harus diisi",
                    ]
                ],
                'linkpublikasi' => [
                    'label'  => 'Link Publikasi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Link Publikasi harus diisi",
                    ]
                ]
            ]);

            if ($formvalid) {
                $semester = $this->request->getVar('semester');
                $tahun = $this->request->getVar('tahun');
                $judul = $this->request->getVar('judul');
                $jenis = $this->request->getVar('jenis');
                $tanggalpublikasi = $this->request->getVar('tanggalpublikasi');
                $linkpublikasi = $this->request->getVar('linkpublikasi');

                $datapub = array(
                    'semester' => $semester,
                    'tahun' => $tahun,
                    'judul' => $judul,
                    'jenis' => $jenis,
                    'tanggalpublikasi' => $tanggalpublikasi,
                    'linkpublikasi' => $linkpublikasi,
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->update($pub_id, $datapub);

                $session->setFlashdata('msg', 'Data publikasi berhasil diubah.');

                return redirect()->to('/dosenpublikasi');
            } else {
                $pub = $model->where('pub_id', $pub_id)->first();
                if ($pub) {
                    $data = [
                        'pub_id' => $pub['pub_id'],
                        'semester' => $pub['semester'],
                        'tahun' => $pub['tahun'],
                        'judul' => $pub['judul'],
                        'jenis' => $pub['jenis'],
                        'tanggalpublikasi' => $pub['tanggalpublikasi'],
                        'linkpublikasi' => $pub['linkpublikasi']
                    ];
                }
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Ubah Data Publikasi";
                $data['data_bread'] = "Ubah Data Publikasi";
                $data['validation'] = $this->validator;
                return view('maintemp/ubahpublikasi', $data);
            }
        }
    }
}
