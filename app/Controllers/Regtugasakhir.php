<?php

namespace App\Controllers;

use App\Models\TarModel;
use App\Models\BimbingModel;
use App\Models\NilaitaModel;

class Regtugasakhir extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        $tipepeserta = $session->get('tipepeserta');
        if ((!$logged_in) && (!$ispeserta) && ($tipepeserta != 'Reguler')) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $user_id = $session->get('user_id');
        $model = new TarModel();
        $data['logged_in'] = $logged_in;
        $ta = $model->where('tbl_tugasakhirreg.user_id', $user_id)->join('tbl_profile', 'tbl_tugasakhirreg.tar_penguji = tbl_profile.user_id', 'left')->orderBy('tbl_tugasakhirreg.tar_id', 'DESC')->findall();
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

        $data['menureg'] = 'menureg';
        $data['title_page'] = "Praktik Keinsinyuran PPI Reguler";
        $data['data_bread'] = "Praktik Keinsinyuran Reguler";
        return view('maintemp/tugasakhirreg', $data);
    }

    public function tambahta()
    {
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        $tipepeserta = $session->get('tipepeserta');
        if ((!$logged_in) && (!$ispeserta) && ($tipepeserta != 'Reguler')) {
            return redirect()->to('/home');
        }
        $data['menureg'] = 'menureg';
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Upload Buku Praktik Keinsinyuran";
        $data['data_bread'] = "Upload Buku Praktik Keinsinyuran";
        $data['user_id'] = $user_id;
        return view('maintemp/tambahtareg', $data);
    }

    public function tambahtarproses()
    {

        $model = new TarModel();
        $session = session();
        $user_id = $session->get('user_id');
        $ispeserta = $session->get('ispeserta');
        $logged_in = $session->get('logged_in');
        $tipepeserta = $session->get('tipepeserta');
        if ((!$logged_in) && (!$ispeserta) && ($tipepeserta != 'Reguler')) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');
        if ($button == "batal") {
            return redirect()->to('/regtugasakhir');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'tar_usuljudul' => [
                    'label'  => 'Judul Praktik Keinsinyuran',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Praktik Keinsinyuran harus diisi',
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
                'tar_buku' => [
                    'rules'  => 'ext_in[tar_buku,pdf]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF."
                    ],
                ],
                'tar_log' => [
                    'rules'  => 'ext_in[tar_log,pdf]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF."
                    ],
                ]
            ]);

            if ($formvalid) {

                $tar_usuljudul = $this->request->getVar('tar_usuljudul');
                $tar_semester = $this->request->getVar('tar_semester');
                $tar_tahun = $this->request->getVar('tar_tahun');
                $startdate = $this->request->getVar('startdate');
                $enddate = $this->request->getVar('enddate');
                $instansi = $this->request->getVar('instansi');
                $divisi = $this->request->getVar('divisi');
                $tar_buku = $this->request->getFile('tar_buku');
                $tar_log = $this->request->getFile('tar_log');
                $tar_linkvideo = $this->request->getVar('tar_linkvideo');

                $ext = $tar_buku->getClientExtension();
                if (!empty($ext)) {
                    $bukuname = $user_id . "_bukutar." . $ext;
                    $tar_buku->move('uploads/docs/', $bukuname, true);
                } else {
                    $bukuname = "";
                }

                $ext1 = $tar_log->getClientExtension();
                if (!empty($ext1)) {
                    $logname = $user_id . "_logtar." . $ext1;
                    $tar_log->move('uploads/docs/', $logname, true);
                } else {
                    $logname = "";
                }

                $datata = array(
                    'user_id' => $user_id,
                    'tar_usuljudul' => $tar_usuljudul,
                    'tar_semester' => $tar_semester,
                    'tar_tahun' => $tar_tahun,
                    'startdate' => $startdate,
                    'enddate' => $enddate,
                    'instansi' => $instansi,
                    'divisi' => $divisi,
                    'tar_buku' => $bukuname,
                    'tar_log' => $logname,
                    'tar_linkvideo' => $tar_linkvideo,
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($datata);

                $session->setFlashdata('msg', 'Data praktik keinsinyuran berhasil ditambahkan.');

                return redirect()->to('/regtugasakhir');
            } else {
                $user_id = $session->get('user_id');

                $data['menureg'] = 'menureg';
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Upload Buku Praktik Keinsinyuran";
                $data['data_bread'] = "Upload Buku Praktik Keinsinyuran";
                $data['validation'] = $this->validator;
                $data['user_id'] = $user_id;
                return view('maintemp/tambahtaregvalid', $data);
            }
        }
    }

    public function hapustar($id)
    {
        $model = new TarModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        $tipepeserta = $session->get('tipepeserta');
        if ((!$logged_in) && (!$ispeserta) && ($tipepeserta != 'Reguler')) {
            return redirect()->to('/home');
        }

        $ta = $model->find($id);
        $path = './uploads/docs/' . $ta['tar_buku'];
        if (is_file($path)) {
            unlink($path);
        }
        $path = './uploads/docs/' . $ta['tar_log'];
        if (is_file($path)) {
            unlink($path);
        }

        $model->delete($id);
        $session->setFlashdata('msg', 'Data praktik keinsinyuran berhasil dihapus.');
        return redirect()->to('/regtugasakhir');
    }

    public function ubahtar($id)
    {
        $model = new TarModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        $tipepeserta = $session->get('tipepeserta');
        if ((!$logged_in) && (!$ispeserta) && ($tipepeserta != 'Reguler')) {
            return redirect()->to('/home');
        }
        $ta = $model->where('tar_id', $id)->first();
        if ($ta) {
            $data = [
                'tar_id' => $ta['tar_id'],
                'user_id' => $ta['user_id'],
                'tar_usuljudul' => $ta['tar_usuljudul'],
                'tar_semester' => $ta['tar_semester'],
                'tar_tahun' => $ta['tar_tahun'],
                'startdate' => $ta['startdate'],
                'enddate' => $ta['enddate'],
                'instansi' => $ta['instansi'],
                'divisi' => $ta['divisi'],
                'tar_buku' => $ta['tar_buku'],
                'tar_log' => $ta['tar_log'],
                'tar_linkvideo' => $ta['tar_linkvideo']
            ];
        }

        $data['menureg'] = 'menureg';
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Ubah Data Praktik Keinsinyuran";
        $data['data_bread'] = "Ubah Data Praktik Keinsinyuran";
        return view('maintemp/ubahtar', $data);
    }

    public function ubahtarproses()
    {
        $model = new TarModel();
        $session = session();
        $user_id = $this->request->getVar('user_id');
        $tar_id = $this->request->getVar('tar_id');
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        $tipepeserta = $session->get('tipepeserta');
        if ((!$logged_in) && (!$ispeserta) && ($tipepeserta != 'Reguler')) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/regtugasakhir');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'tar_usuljudul' => [
                    'label'  => 'Judul Praktik Keinsinyuran',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Praktik Keinsinyuran harus diisi',
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
                'tar_buku' => [
                    'rules'  => 'ext_in[tar_buku,pdf]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF."
                    ],
                ],
                'tar_log' => [
                    'rules'  => 'ext_in[tar_log,pdf]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF."
                    ],
                ]
            ]);

            if ($formvalid) {
                $user_id = $this->request->getVar('user_id');
                $namabuku = $this->request->getVar('namabuku');
                $namalog = $this->request->getVar('namalog');
                $tar_usuljudul = $this->request->getVar('tar_usuljudul');
                $tar_semester = $this->request->getVar('tar_semester');
                $tar_tahun = $this->request->getVar('tar_tahun');
                $startdate = $this->request->getVar('startdate');
                $enddate = $this->request->getVar('enddate');
                $instansi = $this->request->getVar('instansi');
                $divisi = $this->request->getVar('divisi');
                $tar_buku = $this->request->getFile('tar_buku');
                $tar_log = $this->request->getFile('tar_log');
                $tar_linkvideo = $this->request->getVar('tar_linkvideo');

                $ext = $tar_buku->getClientExtension();
                if (!empty($ext)) {
                    $path = './uploads/docs/' . $namabuku;
                    if (is_file($path)) {
                        unlink($path);
                    }
                    $bukuname = $user_id . "_bukutar." . $ext;
                    $tar_buku->move('uploads/docs/', $bukuname, true);
                } else {
                    $bukuname = $namabuku;
                }

                $ext1 = $tar_log->getClientExtension();
                if (!empty($ext1)) {
                    $path = './uploads/docs/' . $namalog;
                    if (is_file($path)) {
                        unlink($path);
                    }
                    $logname = $user_id . "_logtar." . $ext1;
                    $tar_log->move('uploads/docs/', $logname, true);
                } else {
                    $logname = $namalog;
                }

                $datata = array(
                    'user_id' => $user_id,
                    'tar_usuljudul' => $tar_usuljudul,
                    'tar_semester' => $tar_semester,
                    'tar_tahun' => $tar_tahun,
                    'startdate' => $startdate,
                    'enddate' => $enddate,
                    'instansi' => $instansi,
                    'divisi' => $divisi,
                    'tar_buku' => $bukuname,
                    'tar_log' => $logname,
                    'tar_linkvideo' => $tar_linkvideo,
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->update($tar_id, $datata);

                $session->setFlashdata('msg', 'Data praktik keinsinyuran berhasil diubah.');

                return redirect()->to('/regtugasakhir');
            } else {
                $ta = $model->where('tar_id', $tar_id)->first();
                if ($ta) {
                    $data = [
                        'tar_id' => $ta['tar_id'],
                        'user_id' => $ta['user_id'],
                        'tar_usuljudul' => $ta['tar_usuljudul'],
                        'tar_semester' => $ta['tar_semester'],
                        'tar_tahun' => $ta['tar_tahun'],
                        'startdate' => $ta['startdate'],
                        'enddate' => $ta['enddate'],
                        'instansi' => $ta['instansi'],
                        'divisi' => $ta['divisi'],
                        'tar_buku' => $ta['tar_buku'],
                        'tar_log' => $ta['tar_log'],
                        'tar_linkvideo' => $ta['tar_linkvideo']
                    ];
                }
                $data['logged_in'] = $logged_in;

                $data['menureg'] = 'menureg';
                $data['title_page'] = "Ubah Data Praktik Keinsinyuran";
                $data['data_bread'] = "Ubah Data Praktik Keinsinyuran";
                $data['user_id'] = $user_id;
                $data['validation'] = $this->validator;
                return view('maintemp/ubahtar', $data);
            }
        }
    }

    public function bukurevisireg($tar_id)
    {
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        $tipepeserta = $session->get('tipepeserta');
        if ((!$logged_in) && (!$ispeserta) && ($tipepeserta != 'Reguler')) {
            return redirect()->to('/home');
        }
        $data['menureg'] = 'menureg';
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Upload Buku Revisi Praktik Keinsinyuran";
        $data['data_bread'] = "Upload Buku Revisi Praktik Keinsinyuran";
        $data['user_id'] = $user_id;
        $data['tar_id'] = $tar_id;
        return view('maintemp/bukurevisireg', $data);
    }

    public function bukurevisiregproses()
    {
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        }
        $model = new TarModel();
        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/regtugasakhir');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'tar_bukurevisi' => [
                    'rules'  => 'ext_in[tar_bukurevisi,pdf]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF"
                    ],
                ]
            ]);

            if ($formvalid) {
                $tar_id = $this->request->getVar('tar_id');
                $tar_bukurevisi = $this->request->getFile('tar_bukurevisi');

                $ta = $model->find($tar_id);
                $path = './uploads/docs/' . $ta['tar_bukurevisi'];
                if (is_file($path)) {
                    unlink($path);
                }

                $ext = $tar_bukurevisi->getClientExtension();
                if (!empty($ext)) {
                    $bukuname = $user_id . "_bukurevisita." . $ext;
                    $tar_bukurevisi->move('uploads/docs/', $bukuname, true);
                } else {
                    $bukuname = "";
                }

                $datata = array(
                    'tar_bukurevisi' => $bukuname,
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->update($tar_id, $datata);

                $session->setFlashdata('msg', 'Buku revisi praktik keinsinyuran berhasil diupload.');

                return redirect()->to('/regtugasakhir');
            } else {
                $tar_id = $this->request->getVar('tar_id');

                $data['menureg'] = 'menureg';
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Upload Buku Revisi Praktik Keinsinyuran";
                $data['data_bread'] = "Upload Buku Revisi Praktik Keinsinyuran";
                $data['user_id'] = $user_id;
                $data['tar_id'] = $tar_id;
                $data['validation'] = $this->validator;
                return view('maintemp/bukurevisi', $data);
            }
        }
    }

    public function nilai($tar_id)
    {
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        }

        $model = new NilaitaModel();

        $datanilai = $model->join('tbl_profile', 'tbl_nilaita.dosen_id = tbl_profile.user_id', 'left')->orderby('nilaitar_id', 'DESC')->where('tar_id', $tar_id)->findall();

        if ($datanilai) {
            $data['datanilai'] = $datanilai;
        } else {
            $data['datanilai'] = 'kosong';
        }

        $data['menureg'] = 'menureg';
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Nilai Praktik Keinsinyuran";
        $data['data_bread'] = "Nilai Praktik Keinsinyuran";
        $data['user_id'] = $user_id;
        $data['tar_id'] = $tar_id;
        return view('maintemp/nilaipk', $data);
    }
}
