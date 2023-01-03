<?php

namespace App\Controllers;

use App\Models\PenghargaanModel;
use App\Models\KompModel;
use App\Libraries\Slug;

class Userfair14 extends BaseController
{
    public function docs($id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }

        if (!empty($id)) {
            $user_id = $id;
        } else {
            $user_id = $session->get('user_id');
        }
        helper(['tanggal']);
        $model = new PenghargaanModel();
        $penghargaan = $model->where('user_id', $user_id)->orderby('Year', 'DESC')->orderby('Month', 'DESC')->findall();
        if (!empty($penghargaan)) {
            $data['data_harga'] = $penghargaan;
        } else {
            $data['data_harga'] = 'kosong';
        }

        $data['title_page'] = "I.4. Tanda Penghargaan Yang Diterima (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Penghargaan</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok14', $data);
    }

    public function tambahpenghargaan()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        helper(['tanggal']);

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'W.1%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "I.4. Tanda Penghargaan Yang Diterima (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Penghargaan</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/tambahpenghargaanuserfair', $data);
    }

    public function tambahpenghargaanproses()
    {
        $session = session();
        $model = new PenghargaanModel();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }

        if (!empty($id)) {
            $user_id = $id;
        } else {
            $user_id = $session->get('user_id');
        }
        helper(['tanggal']);

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair14/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Year' => [
                    'label'  => 'Year',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Year harus diisi.',
                    ],
                ],
                'Month' => [
                    'label'  => 'Month',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Month harus diisi.',
                    ],
                ],
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Tanda Penghargaan harus diisi.',
                    ],
                ],
                'Institute' => [
                    'label'  => 'Insitute',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Lembaga yang Memberikan harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Lokasi Kota harus diisi.',
                    ],
                ],
                'Prov' => [
                    'label'  => 'Prov',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Lokasi Provinsi harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Lokasi Negara harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Uraian Singkat Tanda Penghargaan harus diisi.',
                    ],
                ],
                'komp' => [
                    'label'  => 'Kompetensi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kompetensi harus diisi.',
                    ],
                ]
            ]);

            if ($formvalid) {
                $Year = $this->request->getVar('Year');
                $Month = $this->request->getVar('Month');
                $Name = $this->request->getVar('Name');
                $Institute = $this->request->getVar('Institute');
                $City = $this->request->getVar('City');
                $Prov = $this->request->getVar('Prov');
                $Country = $this->request->getVar('Country');
                $Level = $this->request->getVar('Level');
                $InstituteType = $this->request->getVar('InstituteType');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp14');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $i++;
                    $nilai_p = $nilai_p + 1;
                    switch ($Level) {
                        case "Mud":
                            $nilai_q = $nilai_q + 2;
                            break;
                        case "Mad":
                            $nilai_q = $nilai_q + 3;
                            break;
                        case "Uta":
                            $nilai_q = $nilai_q + 4;
                            break;
                    }
                    switch ($InstituteType) {
                        case "Lok":
                            $nilai_r = $nilai_r + 1;
                            break;
                        case "Nas":
                            $nilai_r = $nilai_r + 2;
                            break;
                        case "Reg":
                            $nilai_r = $nilai_r + 3;
                            break;
                        case "Int":
                            $nilai_r = $nilai_r + 4;
                            break;
                    }
                    if ($i != $totarray) {
                        $stringkp = $stringkp . $kp . ', ';
                    } else {
                        $stringkp = $stringkp . $kp;
                    }
                endforeach;
                $nilai_w1 = $nilai_q * $nilai_r;

                $namapenghargaan = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if (!empty($ext)) {
                    $filename = $user_id . '_penghargaan_' . $namapenghargaan . '.' . $ext;
                    $File->move('uploads/docs/', $filename, true);
                } else {
                    $filename = "";
                }

                $data = array(
                    'user_id' => $user_id,
                    'Year' => $Year,
                    'Month' => $Month,
                    'Name' => $Name,
                    'Institute' => $Institute,
                    'City' => $City,
                    'Prov' => $Prov,
                    'Country' => $Country,
                    'Level' => $Level,
                    'InstituteType' => $InstituteType,
                    'Desc' => $Desc,
                    'File' => $filename,
                    'kompetensi' => $stringkp,
                    'nilai_p' => $nilai_p,
                    'nilai_q' => $nilai_q,
                    'nilai_r' => $nilai_r,
                    'nilai_w1' => $nilai_w1,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );

                $model->save($data);
                $session->setFlashdata('msg', 'Data Penghargaan berhasil ditambah.');

                return redirect()->to('/userfair14/docs');
            } else {

                $data['datakomp'] = $this->request->getVar('komp14');

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.1%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "I.4. Tanda Penghargaan Yang Diterima (W1)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Penghargaan</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahpenghargaanuserfairvalid', $data);
            }
        }
    }

    public function hapuspenghargaan($id)
    {
        $session = session();
        $model = new PenghargaanModel();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        helper(['tanggal']);

        $penghargaan = $model->find($id);
        $path = './uploads/docs/' . $penghargaan['File'];
        if (is_file($path)) {
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data Penghargaan berhasil dihapus.');

        return redirect()->to('/userfair14/docs');
    }

    public function ubahpenghargaan($id)
    {
        $session = session();
        $model = new PenghargaanModel();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        helper(['tanggal']);

        $penghargaan = $model->where('Num', $id)->first();
        if ($penghargaan) {
            $data = [
                'Num' => $penghargaan['Num'],
                'user_id' => $penghargaan['user_id'],
                'Year' => $penghargaan['Year'],
                'Month' => $penghargaan['Month'],
                'Name' => $penghargaan['Name'],
                'Institute' => $penghargaan['Institute'],
                'City' => $penghargaan['City'],
                'Prov' => $penghargaan['Prov'],
                'Country' => $penghargaan['Country'],
                'Level' => $penghargaan['Level'],
                'InstituteType' => $penghargaan['InstituteType'],
                'Desc' => $penghargaan['Desc'],
                'File' => $penghargaan['File'],
                'datakomp' => explode(", ", $penghargaan['kompetensi'])
            ];
        }

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'W.1%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "I.4. Tanda Penghargaan Yang Diterima (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Penghargaan</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahpenghargaanuserfair', $data);
    }

    public function ubahpenghargaanproses()
    {
        $session = session();
        $user_id = $session->get('user_id');
        $slug = new Slug();
        $model = new PenghargaanModel();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        helper(['tanggal']);
        $Num = $this->request->getVar('Num');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair14/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Year' => [
                    'label'  => 'Year',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Year harus diisi.',
                    ],
                ],
                'Month' => [
                    'label'  => 'Month',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Month harus diisi.',
                    ],
                ],
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Tanda Penghargaan harus diisi.',
                    ],
                ],
                'Institute' => [
                    'label'  => 'Insitute',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Lembaga yang Memberikan harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Lokasi Kota harus diisi.',
                    ],
                ],
                'Prov' => [
                    'label'  => 'Prov',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Lokasi Provinsi harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Lokasi Negara harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Uraian Singkat Tanda Penghargaan harus diisi.',
                    ],
                ]
            ]);

            if ($formvalid) {
                $filename = $this->request->getVar('filename');
                $Year = $this->request->getVar('Year');
                $Month = $this->request->getVar('Month');
                $Name = $this->request->getVar('Name');
                $Institute = $this->request->getVar('Institute');
                $City = $this->request->getVar('City');
                $Prov = $this->request->getVar('Prov');
                $Country = $this->request->getVar('Country');
                $Level = $this->request->getVar('Level');
                $InstituteType = $this->request->getVar('InstituteType');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp14');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $i++;
                    $nilai_p = $nilai_p + 1;
                    switch ($Level) {
                        case "Mud":
                            $nilai_q = $nilai_q + 2;
                            break;
                        case "Mad":
                            $nilai_q = $nilai_q + 3;
                            break;
                        case "Uta":
                            $nilai_q = $nilai_q + 4;
                            break;
                    }
                    switch ($InstituteType) {
                        case "Lok":
                            $nilai_r = $nilai_r + 1;
                            break;
                        case "Nas":
                            $nilai_r = $nilai_r + 2;
                            break;
                        case "Reg":
                            $nilai_r = $nilai_r + 3;
                            break;
                        case "Int":
                            $nilai_r = $nilai_r + 4;
                            break;
                    }
                    if ($i != $totarray) {
                        $stringkp = $stringkp . $kp . ', ';
                    } else {
                        $stringkp = $stringkp . $kp;
                    }
                endforeach;
                $nilai_w1 = $nilai_q * $nilai_r;

                $namapenghargaan = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if ((empty($filename)) && (!empty($ext))) {
                    $filenamenew = $user_id . '_penghargaan_' . $namapenghargaan . '.' . $ext;
                    $File->move('uploads/docs/', $filenamenew, true);
                } elseif ((!empty($filename)) && (!empty($ext))) {
                    $oldext = substr($filename, -4);
                    if ($oldext == $ext) {
                        $File->move('uploads/docs/', $filename, true);
                        $filenamenew = $filename;
                    } else {
                        $filenamenew = $user_id . '_penghargaan_' . $namapenghargaan . '.' . $ext;
                        $File->move('uploads/docs/', $filenamenew, true);
                    }
                } else {
                    $filenamenew = $filename;
                }

                $data = array(
                    'Year' => $Year,
                    'Month' => $Month,
                    'Name' => $Name,
                    'Institute' => $Institute,
                    'City' => $City,
                    'Prov' => $Prov,
                    'Country' => $Country,
                    'Level' => $Level,
                    'InstituteType' => $InstituteType,
                    'Desc' => $Desc,
                    'File' => $filenamenew,
                    'kompetensi' => $stringkp,
                    'nilai_p' => $nilai_p,
                    'nilai_q' => $nilai_q,
                    'nilai_r' => $nilai_r,
                    'nilai_w1' => $nilai_w1,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data penghargaan berhasil diubah.');

                return redirect()->to('/userfair14/docs');
            } else {
                $session = session();
                $model = new PenghargaanModel();
                $penghargaan = $model->where('Num', $Num)->first();
                if ($penghargaan) {
                    $data = [
                        'Num' => $penghargaan['Num'],
                        'user_id' => $penghargaan['user_id'],
                        'Year' => $penghargaan['Year'],
                        'Month' => $penghargaan['Month'],
                        'Name' => $penghargaan['Name'],
                        'Institute' => $penghargaan['Institute'],
                        'City' => $penghargaan['City'],
                        'Prov' => $penghargaan['Prov'],
                        'Country' => $penghargaan['Country'],
                        'Level' => $penghargaan['Level'],
                        'InstituteType' => $penghargaan['InstituteType'],
                        'Desc' => $penghargaan['Desc'],
                        'File' => $penghargaan['File'],
                        'datakomp' => explode(", ", $penghargaan['kompetensi'])
                    ];
                }

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.1%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "I.4. Tanda Penghargaan Yang Diterima (W1)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Penghargaan</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahpenghargaanuserfair', $data);
            }
        }
    }
}
