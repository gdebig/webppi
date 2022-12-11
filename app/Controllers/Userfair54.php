<?php

namespace App\Controllers;

use App\Models\InovasiModel;
use App\Models\KompModel;
use App\Libraries\Slug;

class Userfair54 extends BaseController
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
        $model = new InovasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $inov = $model->where('user_id', $user_id)->orderby('Year', 'DESC')->orderby('Month', 'DESC')->findall();
        if (!empty($inov)) {
            $data['data_inov'] = $inov;
        } else {
            $data['data_inov'] = 'kosong';
        }

        $data['title_page'] = "V.4 Karya Temuan/Inovasi/Paten dan Implementasi Teknologi Baru (P6)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Inovasi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok54', $data);
    }

    public function tambahinov()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'P.6%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "V.4 Karya Temuan/Inovasi/Paten dan Implementasi Teknologi Baru (P6)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Inovasi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/tambahinov', $data);
    }

    public function tambahinovproses()
    {
        $session = session();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new InovasiModel();
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair54/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama inovinar/Lokakarya harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Uraian Singkat harus diisi.',
                    ],
                ],
                'Month' => [
                    'label'  => 'Month',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan harus diisi.',
                    ],
                ],
                'Year' => [
                    'label'  => 'Year',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun harus diisi.',
                    ],
                ],
                'File' => [
                    'rules'  => 'ext_in[File,jpg,jpeg,png,pdf]|max_size[File, 700]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF, JPG, JPEG atau PNG",
                        'max_size' => "Ukuran File Maksimal 700KB"
                    ],
                ]
            ]);

            if ($formvalid) {
                $Name = $this->request->getVar('Name');
                $Desc = $this->request->getVar('Desc');
                $Month = $this->request->getVar('Month');
                $Year = $this->request->getVar('Year');
                $Publication = $this->request->getVar('Publication');
                $PubLevel = $this->request->getVar('PubLevel');
                $DiffBenefit = $this->request->getVar('DiffBenefit');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp54');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $nilai_p = $nilai_p + 1;
                    switch ($PubLevel) {
                        case "Lok":
                            $nilai_q = $nilai_q + 2;
                            break;
                        case "Nas":
                            $nilai_q = $nilai_q + 3;
                            break;
                        case "Int":
                            $nilai_q = $nilai_q + 4;
                            break;
                    }
                    switch ($DiffBenefit) {
                        case "ren":
                            $nilai_r = $nilai_r + 1;
                            break;
                        case "sed":
                            $nilai_r = $nilai_r + 2;
                            break;
                        case "tin":
                            $nilai_r = $nilai_r + 3;
                            break;
                        case "stin":
                            $nilai_r = $nilai_r + 4;
                            break;
                    }
                    $i++;
                    if ($i != $totarray) {
                        $stringkp = $stringkp . $kp . ', ';
                    } else {
                        $stringkp = $stringkp . $kp;
                    }
                endforeach;
                $nilai_pil = $nilai_p * $nilai_q * $nilai_r;

                $namainovasi = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if (!empty($ext)) {
                    $random = bin2hex(random_bytes(4));
                    $filename = $user_id . 'inovasi' . $namainovasi . '_' . $random . '.' . $ext;
                    $File->move('uploads/docs/', $filename, true);
                } else {
                    $filename = "";
                }

                $data = array(
                    'user_id' => $user_id,
                    'Name' => $Name,
                    'Desc' => $Desc,
                    'Year' => $Year,
                    'Month' => $Month,
                    'Publication' => $Publication,
                    'PubLevel' => $PubLevel,
                    'DiffBenefit' => $DiffBenefit,
                    'File' => $filename,
                    'kompetensi' => $stringkp,
                    'nilai_p' => $nilai_p,
                    'nilai_q' => $nilai_q,
                    'nilai_r' => $nilai_r,
                    'nilai_pil' => $nilai_pil,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );

                $model->save($data);
                $session->setFlashdata('msg', 'Data temuan/inovasi/paten berhasil ditambah.');

                return redirect()->to('/userfair54/docs');
            } else {
                $data['datakomp'] = $this->request->getVar('komp54');

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'P.6%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "V.4 Karya Temuan/Inovasi/Paten dan Implementasi Teknologi Baru (P6)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Inovasi</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahinovvalid', $data);
            }
        }
    }

    public function hapusinov($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new InovasiModel();

        $inov = $model->find($id);
        $path = './uploads/docs/' . $inov['File'];
        if (is_file($path)) {
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data temuan/inovasi/paten berhasil dihapus.');

        return redirect()->to('/userfair54/docs');
    }

    public function ubahinov($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new InovasiModel();
        $inov = $model->where('Num', $id)->first();
        if ($inov) {
            $data = [
                'Num' => $inov['Num'],
                'user_id' => $inov['user_id'],
                'Name' => $inov['Name'],
                'Year' => $inov['Year'],
                'Month' => $inov['Month'],
                'Publication' => $inov['Publication'],
                'PubLevel' => $inov['PubLevel'],
                'DiffBenefit' => $inov['DiffBenefit'],
                'Desc' => $inov['Desc'],
                'File' => $inov['File'],
                'datakomp' => explode(", ", $inov['kompetensi'])
            ];
        }

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'P.6%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "V.4 Karya Temuan/Inovasi/Paten dan Implementasi Teknologi Baru (P6)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Inovasi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahinov', $data);
    }

    public function ubahinovproses()
    {
        $session = session();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new InovasiModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair54/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama inovinar/Lokakarya harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Uraian Singkat harus diisi.',
                    ],
                ],
                'Month' => [
                    'label'  => 'Month',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan harus diisi.',
                    ],
                ],
                'Year' => [
                    'label'  => 'Year',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun harus diisi.',
                    ],
                ],
                'File' => [
                    'rules'  => 'ext_in[File,jpg,jpeg,png,pdf]|max_size[File, 700]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF, JPG, JPEG atau PNG",
                        'max_size' => "Ukuran File Maksimal 700KB"
                    ],
                ]
            ]);

            if ($formvalid) {
                $filename = $this->request->getVar('filename');
                $Name = $this->request->getVar('Name');
                $Desc = $this->request->getVar('Desc');
                $Month = $this->request->getVar('Month');
                $Year = $this->request->getVar('Year');
                $Publication = $this->request->getVar('Publication');
                $PubLevel = $this->request->getVar('PubLevel');
                $DiffBenefit = $this->request->getVar('DiffBenefit');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp54');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $nilai_p = $nilai_p + 1;
                    switch ($PubLevel) {
                        case "Lok":
                            $nilai_q = $nilai_q + 2;
                            break;
                        case "Nas":
                            $nilai_q = $nilai_q + 3;
                            break;
                        case "Int":
                            $nilai_q = $nilai_q + 4;
                            break;
                    }
                    switch ($DiffBenefit) {
                        case "ren":
                            $nilai_r = $nilai_r + 1;
                            break;
                        case "sed":
                            $nilai_r = $nilai_r + 2;
                            break;
                        case "tin":
                            $nilai_r = $nilai_r + 3;
                            break;
                        case "stin":
                            $nilai_r = $nilai_r + 4;
                            break;
                    }
                    $i++;
                    if ($i != $totarray) {
                        $stringkp = $stringkp . $kp . ', ';
                    } else {
                        $stringkp = $stringkp . $kp;
                    }
                endforeach;
                $nilai_pil = $nilai_p * $nilai_q * $nilai_r;

                $namainovasi = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if ((empty($filename)) && (!empty($ext))) {
                    $random = bin2hex(random_bytes(4));
                    $filenamenew = $user_id . '_inovasi_' . $namainovasi . '_' . $random . '.' . $ext;
                    $File->move('uploads/docs/', $filenamenew, true);
                } elseif ((!empty($filename)) && (!empty($ext))) {
                    $oldext = substr($filename, -4);
                    if ($oldext == $ext) {
                        $File->move('uploads/docs/', $filename, true);
                        $filenamenew = $filename;
                    } else {
                        $random = bin2hex(random_bytes(4));
                        $filenamenew = $user_id . '_inovasi_' . $namainovasi . '_' . $random . '.' . $ext;
                        $File->move('uploads/docs/', $filenamenew, true);
                    }
                } else {
                    $filenamenew = $filename;
                }

                $data = array(
                    'Name' => $Name,
                    'Desc' => $Desc,
                    'Year' => $Year,
                    'Month' => $Month,
                    'Publication' => $Publication,
                    'PubLevel' => $PubLevel,
                    'DiffBenefit' => $DiffBenefit,
                    'File' => $filenamenew,
                    'kompetensi' => $stringkp,
                    'nilai_p' => $nilai_p,
                    'nilai_q' => $nilai_q,
                    'nilai_r' => $nilai_r,
                    'nilai_pil' => $nilai_pil,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data temuan/inovasi/paten berhasil diubah.');

                return redirect()->to('/userfair54/docs');
            } else {
                $inov = $model->where('Num', $Num)->first();
                if ($inov) {
                    $data = [
                        'Num' => $inov['Num'],
                        'user_id' => $inov['user_id'],
                        'Name' => $inov['Name'],
                        'Year' => $inov['Year'],
                        'Month' => $inov['Month'],
                        'Publication' => $inov['Publication'],
                        'PubLevel' => $inov['PubLevel'],
                        'DiffBenefit' => $inov['DiffBenefit'],
                        'Desc' => $inov['Desc'],
                        'File' => $inov['File'],
                        'datakomp' => explode(", ", $inov['kompetensi'])
                    ];
                }

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'P.6%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "V.4 Karya Temuan/Inovasi/Paten dan Implementasi Teknologi Baru (P6)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Inovasi</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahinov', $data);
            }
        }
    }
}
