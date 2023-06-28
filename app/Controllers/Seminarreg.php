<?php

namespace App\Controllers;

use App\Models\SeminarModel;
use App\Models\NilaitaModel;

class Seminarreg extends BaseController
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
        $model = new SeminarModel();
        $data['logged_in'] = $logged_in;
        $sem = $model->where('tbl_semreg.mhs_id', $user_id)->orderBy('tbl_semreg.sem_id', 'DESC')->findall();
        if (!empty($sem)) {
            $data['data_sem'] = $sem;
        } else {
            $data['data_sem'] = 'kosong';
        }

        $data['menureg'] = 'menureg';
        $data['title_page'] = "Seminar PPI Reguler";
        $data['data_bread'] = "Seminar PPI Reguler";
        return view('maintemp/seminarreg', $data);
    }

    public function tambahsemreg()
    {
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        $tipepeserta = $session->get('tipepeserta');
        if ((!$logged_in) && (!$ispeserta) && ($tipepeserta != 'Reguler')) {
            return redirect()->to('/home');
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Tambah Seminar";
        $data['data_bread'] = "Tambah Seminar";
        $data['user_id'] = $user_id;
        $data['menureg'] = 'menureg';
        return view('maintemp/tambahsemreg', $data);
    }

    public function tambahsemregproses()
    {

        $model = new SeminarModel();
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
            return redirect()->to('/seminarreg');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'sem_judul' => [
                    'label'  => 'Judul Seminar',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Seminar harus diisi',
                    ],
                ],
                'sem_tahun' => [
                    'label' => 'Tahun Seminar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Seminar harus diisi',
                    ],
                ],
                'sem_term' => [
                    'label' => 'Semester',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Semester harus diisi',
                    ],
                ],
                'sem_bukti' => [
                    'rules'  => 'ext_in[sem_bukti,pdf]',
                    'errors' => [
                        'required' => "Field bukti seminar tidak boleh kosong",
                        'ext_in' => "Field bukti seminar hanya menerima file PDF."
                    ],
                ]
            ]);

            if ($formvalid) {

                $sem_judul = $this->request->getVar('sem_judul');
                $sem_tahun = $this->request->getVar('sem_tahun');
                $sem_term = $this->request->getVar('sem_term');
                $sem_bukti = $this->request->getFile('sem_bukti');

                $ext = $sem_bukti->getClientExtension();
                if (!empty($ext)) {
                    $buktiname = $user_id . "_buktiseminarreg." . $ext;
                    $sem_bukti->move('uploads/docs/', $buktiname, true);
                } else {
                    $buktiname = "";
                }

                $datata = array(
                    'mhs_id' => $user_id,
                    'sem_judul' => $sem_judul,
                    'sem_tahun' => $sem_tahun,
                    'sem_term' => $sem_term,
                    'sem_bukti' => $buktiname,
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($datata);

                $session->setFlashdata('msg', 'Data Seminar berhasil ditambahkan.');

                return redirect()->to('/seminarreg');
            } else {
                $user_id = $session->get('user_id');
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Tambah Seminar";
                $data['data_bread'] = "Tambah Seminar";
                $data['validation'] = $this->validator;
                $data['user_id'] = $user_id;
                $data['menureg'] = 'menureg';
                return view('maintemp/tambahsemregvalid', $data);
            }
        }
    }

    public function hapussemreg($id)
    {
        $model = new SeminarModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        $tipepeserta = $session->get('tipepeserta');
        if ((!$logged_in) && (!$ispeserta) && ($tipepeserta != 'Reguler')) {
            return redirect()->to('/home');
        }


        $sem = $model->find($id);
        $path = './uploads/docs/' . $sem['sem_bukti'];
        if (is_file($path)) {
            unlink($path);
        }

        $model->delete($id);
        $session->setFlashdata('msg', 'Data Seminar berhasil dihapus.');
        return redirect()->to('/seminarreg');
    }

    public function ubahsemreg($id)
    {
        $model = new SeminarModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        $tipepeserta = $session->get('tipepeserta');
        if ((!$logged_in) && (!$ispeserta) && ($tipepeserta != 'Reguler')) {
            return redirect()->to('/home');
        }
        $sem = $model->where('sem_id', $id)->first();
        if ($sem) {
            $data = [
                'sem_id' => $sem['sem_id'],
                'mhs_id' => $sem['mhs_id'],
                'sem_judul' => $sem['sem_judul'],
                'sem_tahun' => $sem['sem_tahun'],
                'sem_term' => $sem['sem_term'],
                'sem_bukti' => $sem['sem_bukti']
            ];
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Ubah Data Seminar";
        $data['data_bread'] = "Ubah Data Seminar";
        $data['menureg'] = 'menureg';
        return view('maintemp/ubahsemreg', $data);
    }

    public function ubahsemregproses()
    {
        $model = new SeminarModel();
        $session = session();
        $user_id = $session->get('user_id');
        $sem_id = $this->request->getVar('sem_id');
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        $tipepeserta = $session->get('tipepeserta');
        if ((!$logged_in) && (!$ispeserta) && ($tipepeserta != 'Reguler')) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/seminarreg');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'sem_judul' => [
                    'label'  => 'Judul Seminar',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Seminar harus diisi',
                    ],
                ],
                'sem_tahun' => [
                    'label' => 'Tahun Seminar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Seminar harus diisi',
                    ],
                ],
                'sem_term' => [
                    'label' => 'Semester',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Semester harus diisi',
                    ],
                ],
                'sem_bukti' => [
                    'rules'  => 'ext_in[sem_bukti,pdf]',
                    'errors' => [
                        'required' => "Field bukti seminar tidak boleh kosong",
                        'ext_in' => "Field bukti seminar hanya menerima file PDF."
                    ],
                ]
            ]);

            if ($formvalid) {
                //$user_id = $this->request->getVar('user_id');
                $sem_judul = $this->request->getVar('sem_judul');
                $sem_tahun = $this->request->getVar('sem_tahun');
                $sem_term = $this->request->getVar('sem_term');
                $oldsem_bukti = $this->request->getVar('oldsem_bukti');
                $sem_bukti = $this->request->getFile('sem_bukti');

                $ext = $sem_bukti->getClientExtension();
                if (!empty($ext)) {

                    $path = './uploads/docs/' . $oldsem_bukti;
                    if (is_file($path)) {
                        unlink($path);
                    }

                    $buktiname = $user_id . "_buktiseminarreg." . $ext;
                    $sem_bukti->move('uploads/docs/', $buktiname, true);
                    $newbuktiname = $buktiname;
                } else {
                    $newbuktiname = $oldsem_bukti;
                }

                $datata = array(
                    'sem_judul' => $sem_judul,
                    'sem_tahun' => $sem_tahun,
                    'sem_term' => $sem_term,
                    'sem_bukti' => $newbuktiname,
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->update($sem_id, $datata);

                $session->setFlashdata('msg', 'Data Seminar berhasil diubah.');

                return redirect()->to('/seminarreg');
            } else {
                $sem = $model->where('sem_id', $sem_id)->first();
                if ($sem) {
                    $data = [
                        'sem_id' => $sem['sem_id'],
                        'mhs_id' => $sem['mhs_id'],
                        'sem_judul' => $sem['sem_judul'],
                        'sem_tahun' => $sem['sem_tahun'],
                        'sem_term' => $sem['sem_term'],
                        'sem_bukti' => $sem['sem_bukti']
                    ];
                }
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Ubah Data Seminar";
                $data['data_bread'] = "Ubah Data Seminar";
                $data['user_id'] = $user_id;
                $data['validation'] = $this->validator;
                $data['menureg'] = 'menureg';
                return view('maintemp/ubahsemreg', $data);
            }
        }
    }
}
