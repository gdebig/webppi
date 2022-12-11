<?php

namespace App\Controllers;

use App\Models\TugasAkhirModel;
use App\Models\BimbingModel;
use App\Models\NilaitaModel;

class Tugasakhir extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $user_id = $session->get('user_id');
        $model = new TugasAkhirModel();
        $data['logged_in'] = $logged_in;
        $ta = $model->where('tbl_tugasakhir.user_id', $user_id)->join('tbl_profile', 'tbl_tugasakhir.ta_penguji = tbl_profile.user_id', 'left')->orderBy('tbl_tugasakhir.ta_id', 'DESC')->findall();
        if (!empty($ta)) {
            $data['data_ta'] = $ta;
        } else {
            $data['data_ta'] = 'kosong';
        }
        $model1 = new BimbingModel();
        $bimbing = $model1->where('tbl_bimbing.mhs_id', $user_id)->join('tbl_profile', 'tbl_profile.user_id = tbl_bimbing.dosen_id', 'left')->first();
        if ($bimbing) {
            $data['dosen_bimbing'] = $bimbing['FullName'];
        } else {
            $data['dosen_bimbing'] = "Belum ada pembimbing";
        }
        $data['title_page'] = "Praktek Keinsinyuran PPI";
        $data['data_bread'] = "Praktek Keinsinyuran";
        return view('maintemp/tugasakhir', $data);
    }

    public function tambahta()
    {
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Upload Buku Revisi Praktek Keinsinyuran";
        $data['data_bread'] = "Upload Buku Revisi Praktek Keinsinyuran";
        $data['user_id'] = $user_id;
        return view('maintemp/tambahta', $data);
    }

    public function tambahtaproses()
    {

        $model = new TugasAkhirModel();
        $session = session();
        $user_id = $session->get('user_id');
        $ispeserta = $session->get('ispeserta');
        $logged_in = $session->get('logged_in');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');
        if ($button == "batal") {
            return redirect()->to('/tugasakhir');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'ta_usuljudul' => [
                    'label'  => 'Judul Praktek Keinsinyuran',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Praktek Keinsinyuran harus diisi',
                    ],
                ],
                'startdate' => [
                    'label' => 'Tanggal Mulai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field tanggal mulai harus diisi',
                    ],
                ],
                'enddate' => [
                    'label' => 'Tanggal Berakhir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field tanggal berakhir harus diisi',
                    ],
                ],
                'instansi' => [
                    'label' => 'Instansi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field instansi harus diisi',
                    ],
                ],
                'divisi' => [
                    'label' => 'divisi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field divisi harus diisi',
                    ],
                ],
                'ta_buku' => [
                    'rules'  => 'ext_in[ta_buku,pdf]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF."
                    ],
                ],
                'ta_log' => [
                    'rules'  => 'ext_in[ta_log,pdf]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF."
                    ],
                ]
            ]);

            if ($formvalid) {

                $ta_usuljudul = $this->request->getVar('ta_usuljudul');
                $ta_semester = $this->request->getVar('ta_semester');
                $ta_tahun = $this->request->getVar('ta_tahun');
                $startdate = $this->request->getVar('startdate');
                $enddate = $this->request->getVar('enddate');
                $instansi = $this->request->getVar('instansi');
                $divisi = $this->request->getVar('divisi');
                $ta_buku = $this->request->getFile('ta_buku');
                $ta_log = $this->request->getFile('ta_log');

                $ext = $ta_buku->getClientExtension();
                if (!empty($ext)) {
                    $bukuname = $user_id . "_bukuta." . $ext;
                    $ta_buku->move('uploads/docs/', $bukuname, true);
                } else {
                    $bukuname = "";
                }

                $ext1 = $ta_log->getClientExtension();
                if (!empty($ext1)) {
                    $logname = $user_id . "_logta." . $ext1;
                    $ta_log->move('uploads/docs/', $logname, true);
                } else {
                    $logname = "";
                }

                $datata = array(
                    'user_id' => $user_id,
                    'ta_usuljudul' => $ta_usuljudul,
                    'ta_semester' => $ta_semester,
                    'ta_tahun' => $ta_tahun,
                    'startdate' => $startdate,
                    'enddate' => $enddate,
                    'instansi' => $instansi,
                    'divisi' => $divisi,
                    'ta_buku' => $bukuname,
                    'ta_log' => $logname,
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($datata);

                $session->setFlashdata('msg', 'Data praktek keinsinyuran berhasil ditambahkan.');

                return redirect()->to('/tugasakhir');
            } else {
                $user_id = $session->get('user_id');
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Upload Buku Revisi Praktek Keinsinyuran";
                $data['data_bread'] = "Upload Buku Revisi Praktek Keinsinyuran";
                $data['validation'] = $this->validator;
                $data['user_id'] = $user_id;
                return view('maintemp/tambahtavalid', $data);
            }
        }
    }

    public function hapusta($id)
    {
        $model = new TugasAkhirModel();
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        }

        $ta = $model->find($id);
        $path = './uploads/docs/' . $ta['ta_buku'];
        if (is_file($path)) {
            unlink($path);
        }
        $path = './uploads/docs/' . $ta['ta_log'];
        if (is_file($path)) {
            unlink($path);
        }

        $model->delete($id);
        $session->setFlashdata('msg', 'Data praktek keinsinyuran berhasil dihapus.');
        return redirect()->to('/tugasakhir');
    }

    public function ubahta($id)
    {
        $model = new TugasAkhirModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        }
        $ta = $model->where('ta_id', $id)->first();
        if ($ta) {
            $data = [
                'ta_id' => $ta['ta_id'],
                'user_id' => $ta['user_id'],
                'ta_usuljudul' => $ta['ta_usuljudul'],
                'ta_semester' => $ta['ta_semester'],
                'ta_tahun' => $ta['ta_tahun'],
                'startdate' => $ta['startdate'],
                'enddate' => $ta['enddate'],
                'instansi' => $ta['instansi'],
                'divisi' => $ta['divisi'],
                'ta_buku' => $ta['ta_buku'],
                'ta_log' => $ta['ta_log']
            ];
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Ubah Data Praktek Keinsinyuran";
        $data['data_bread'] = "Ubah Data Praktek Keinsinyuran";
        return view('maintemp/ubahta', $data);
    }

    public function ubahtaproses()
    {
        $model = new TugasAkhirModel();
        $session = session();
        $user_id = $this->request->getVar('user_id');
        $ta_id = $this->request->getVar('ta_id');
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/tugasakhir');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'ta_usuljudul' => [
                    'label'  => 'Judul Praktek Keinsinyuran',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Praktek Keinsinyuran harus diisi',
                    ],
                ],
                'startdate' => [
                    'label' => 'Tanggal Mulai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field tanggal mulai harus diisi',
                    ],
                ],
                'enddate' => [
                    'label' => 'Tanggal Berakhir',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field tanggal berakhir harus diisi',
                    ],
                ],
                'instansi' => [
                    'label' => 'Instansi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field instansi harus diisi',
                    ],
                ],
                'divisi' => [
                    'label' => 'divisi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field divisi harus diisi',
                    ],
                ],
                'ta_buku' => [
                    'rules'  => 'ext_in[ta_buku,pdf]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF."
                    ],
                ],
                'ta_log' => [
                    'rules'  => 'ext_in[ta_log,pdf]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF."
                    ],
                ]
            ]);

            if ($formvalid) {
                $user_id = $this->request->getVar('user_id');
                $namabuku = $this->request->getVar('namabuku');
                $namalog = $this->request->getVar('namalog');
                $ta_usuljudul = $this->request->getVar('ta_usuljudul');
                $ta_semester = $this->request->getVar('ta_semester');
                $ta_tahun = $this->request->getVar('ta_tahun');
                $startdate = $this->request->getVar('startdate');
                $enddate = $this->request->getVar('enddate');
                $instansi = $this->request->getVar('instansi');
                $divisi = $this->request->getVar('divisi');
                $ta_buku = $this->request->getFile('ta_buku');
                $ta_log = $this->request->getFile('ta_log');

                $ext = $ta_buku->getClientExtension();
                if (!empty($ext)) {
                    $bukuname = $user_id . "_bukuta." . $ext;
                    $ta_buku->move('uploads/docs/', $bukuname, true);
                } else {
                    $bukuname = $namabuku;
                }

                $ext1 = $ta_log->getClientExtension();
                if (!empty($ext1)) {
                    $logname = $user_id . "_logta." . $ext1;
                    $ta_log->move('uploads/docs/', $logname, true);
                } else {
                    $logname = $namalog;
                }

                $datata = array(
                    'user_id' => $user_id,
                    'ta_usuljudul' => $ta_usuljudul,
                    'ta_semester' => $ta_semester,
                    'ta_tahun' => $ta_tahun,
                    'startdate' => $startdate,
                    'enddate' => $enddate,
                    'instansi' => $instansi,
                    'divisi' => $divisi,
                    'ta_buku' => $bukuname,
                    'ta_log' => $logname,
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->update($ta_id, $datata);

                $session->setFlashdata('msg', 'Data praktek keinsinyuran berhasil diubah.');

                return redirect()->to('/tugasakhir');
            } else {
                $ta = $model->where('ta_id', $ta_id)->first();
                if ($ta) {
                    $data = [
                        'ta_id' => $ta['ta_id'],
                        'user_id' => $ta['user_id'],
                        'ta_usuljudul' => $ta['ta_usuljudul'],
                        'ta_semester' => $ta['ta_semester'],
                        'ta_tahun' => $ta['ta_tahun'],
                        'startdate' => $ta['startdate'],
                        'enddate' => $ta['enddate'],
                        'instansi' => $ta['instansi'],
                        'divisi' => $ta['divisi'],
                        'ta_buku' => $ta['ta_buku'],
                        'ta_log' => $ta['ta_log']
                    ];
                }
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Ubah Data Praktek Keinsinyuran";
                $data['data_bread'] = "Ubah Data Praktek Keinsinyuran";
                $data['user_id'] = $user_id;
                $data['validation'] = $this->validator;
                return view('maintemp/ubahta', $data);
            }
        }
    }

    public function bukurevisi($ta_id)
    {
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Upload Buku Revisi Praktek Keinsinyuran";
        $data['data_bread'] = "Upload Buku Revisi Praktek Keinsinyuran";
        $data['user_id'] = $user_id;
        $data['ta_id'] = $ta_id;
        return view('maintemp/bukurevisi', $data);
    }

    public function bukurevisiproses()
    {
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        }
        $model = new TugasAkhirModel();
        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/tugasakhir');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'ta_bukurevisi' => [
                    'rules'  => 'ext_in[ta_bukurevisi,pdf]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF"
                    ],
                ]
            ]);

            if ($formvalid) {
                $ta_id = $this->request->getVar('ta_id');
                $ta_bukurevisi = $this->request->getFile('ta_bukurevisi');

                $ta = $model->find($ta_id);
                $path = './uploads/docs/' . $ta['ta_bukurevisi'];
                if (is_file($path)) {
                    unlink($path);
                }

                $ext = $ta_bukurevisi->getClientExtension();
                if (!empty($ext)) {
                    $bukuname = $user_id . "_bukurevisita." . $ext;
                    $ta_bukurevisi->move('uploads/docs/', $bukuname, true);
                } else {
                    $bukuname = "";
                }

                $datata = array(
                    'ta_bukurevisi' => $bukuname,
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->update($ta_id, $datata);

                $session->setFlashdata('msg', 'Buku revisi praktek keinsinyuran berhasil diupload.');

                return redirect()->to('/tugasakhir');
            } else {
                $ta_id = $this->request->getVar('ta_id');
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Upload Buku Revisi Praktek Keinsinyuran";
                $data['data_bread'] = "Upload Buku Revisi Praktek Keinsinyuran";
                $data['user_id'] = $user_id;
                $data['ta_id'] = $ta_id;
                $data['validation'] = $this->validator;
                return view('maintemp/bukurevisi', $data);
            }
        }
    }

    public function nilai($ta_id)
    {
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        }

        $model = new NilaitaModel();

        $datanilai = $model->join('tbl_profile', 'tbl_nilaita.dosen_id = tbl_profile.user_id', 'left')->orderby('nilaita_id', 'DESC')->where('ta_id', $ta_id)->findall();

        if ($datanilai) {
            $data['datanilai'] = $datanilai;
        } else {
            $data['datanilai'] = 'kosong';
        }

        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Nilai Praktek Keinsinyuran";
        $data['data_bread'] = "Nilai Praktek Keinsinyuran";
        $data['user_id'] = $user_id;
        $data['ta_id'] = $ta_id;
        return view('maintemp/nilaipk', $data);
    }
}
