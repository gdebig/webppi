<?php

namespace App\Controllers;

use App\Models\CapesKartulModel;
use App\Models\KompModel;
use App\Libraries\Slug;

class Bimbingfair51 extends BaseController
{
    public function docs($id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }

        if (!empty($id)) {
            $user_id = $id;
        } else {
            $user_id = $session->get('user_id');
        }
        helper(['tanggal']);
        $model = new CapesKartulModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kartul = $model->where('user_id', $user_id)->orderby('Year', 'DESC')->findall();
        if (!empty($kartul)) {
            $data['data_kartul'] = $kartul;
        } else {
            $data['data_kartul'] = 'kosong';
        }

        $data['user_id'] = $user_id;
        $data['title_page'] = "V.1. Karya Tulis di Bidang Keinsinyuran yang Dipublikasikan (W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/bimbingfair/docs/" . $id . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Karya Tulis</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/bimbingdok51', $data);
    }

    public function tambahkartul()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'W.4%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "V.1. Karya Tulis di Bidang Keinsinyuran yang Dipublikasikan (W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Karya Tulis</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/tambahkartul', $data);
    }

    public function tambahkartulproses()
    {
        $session = session();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new CapesKartulModel();
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair51/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Karya Tulis harus diisi.',
                    ],
                ],
                'Media' => [
                    'label'  => 'Media',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Media Publikasi harus diisi.',
                    ],
                ],
                'LocCity' => [
                    'label'  => 'LocCity',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Lokasi Media harus diisi.',
                    ],
                ],
                'LocCountry' => [
                    'label'  => 'LocCountry',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Lokasi Media harus diisi.',
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
                'Mediatype' => [
                    'label'  => 'Mediatype',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Media Publikasi Tingkat harus diisi.',
                    ],
                ],
                'Diffbenefit' => [
                    'label'  => 'Diffbenefit',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tingkat Kesulitan dan Manfaat harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Uraian Singkat harus diisi.',
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
                $Media = $this->request->getVar('Media');
                $LocCity = $this->request->getVar('LocCity');
                $LocCountry = $this->request->getVar('LocCountry');
                $Bulan = $this->request->getVar('Month');
                $Tahun = $this->request->getVar('Year');
                $Mediatype = $this->request->getVar('Mediatype');
                $Diffbenefit = $this->request->getVar('Diffbenefit');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp51');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $nilai_p = $nilai_p + 1;
                    switch ($Mediatype) {
                        case "Lok":
                            $nilai_q = $nilai_q + 1;
                            break;
                        case "Nas":
                            $nilai_q = $nilai_q + 2;
                            break;
                        case "Int":
                            $nilai_q = $nilai_q + 4;
                            break;
                    }
                    switch ($Diffbenefit) {
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
                $nilai_w4 = $nilai_p * $nilai_q * $nilai_r;

                $mediakartul = $slug->slugify($Media);
                $ext = $File->getClientExtension();
                if (!empty($ext)) {
                    $random = bin2hex(random_bytes(4));
                    $filename = $user_id . '_karyatulis_' . $mediakartul . '_' . $random . '.' . $ext;
                    $File->move('uploads/docs/', $filename, true);
                } else {
                    $filename = "";
                }

                $data = array(
                    'user_id' => $user_id,
                    'Name' => $Name,
                    'Media' => $Media,
                    'LocCity' => $LocCity,
                    'LocCountry' => $LocCountry,
                    'Year' => $Tahun,
                    'Month' => $Bulan,
                    'Mediatype' => $Mediatype,
                    'Diffbenefit' => $Diffbenefit,
                    'Desc' => $Desc,
                    'File' => $filename,
                    'kompetensi' => $stringkp,
                    'nilai_p' => $nilai_p,
                    'nilai_q' => $nilai_q,
                    'nilai_r' => $nilai_r,
                    'nilai_w4' => $nilai_w4,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );

                $model->save($data);
                $session->setFlashdata('msg', 'Data Karya Tulis berhasil ditambah.');

                return redirect()->to('/userfair51/docs');
            } else {
                $data['datakomp'] = $this->request->getVar('komp51');

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.4%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "V.1. Karya Tulis di Bidang Keinsinyuran yang Dipublikasikan (W4)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Karya Tulis</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahkartulvalid', $data);
            }
        }
    }

    public function hapuskartul($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new CapesKartulModel();

        $kartul = $model->find($id);
        $path = './uploads/docs/' . $kartul['File'];
        if (is_file($path)) {
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data Karya Tulis berhasil dihapus.');

        return redirect()->to('/userfair51/docs');
    }

    public function ubahkartul($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new CapesKartulModel();
        $kartul = $model->where('Num', $id)->first();
        if ($kartul) {
            $data = [
                'Num' => $kartul['Num'],
                'user_id' => $kartul['user_id'],
                'Name' => $kartul['Name'],
                'Media' => $kartul['Media'],
                'LocCity' => $kartul['LocCity'],
                'LocCountry' => $kartul['LocCountry'],
                'Year' => $kartul['Year'],
                'Month' => $kartul['Month'],
                'Mediatype' => $kartul['Mediatype'],
                'Diffbenefit' => $kartul['Diffbenefit'],
                'Desc' => $kartul['Desc'],
                'File' => $kartul['File'],
                'datakomp' => explode(", ", $kartul['kompetensi'])
            ];
        }

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'W.4%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "V.1. Karya Tulis di Bidang Keinsinyuran yang Dipublikasikan (W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Karya Tulis</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahkartul', $data);
    }

    public function ubahkartulproses()
    {
        $session = session();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new CapesKartulModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair51/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Karya Tulis harus diisi.',
                    ],
                ],
                'Media' => [
                    'label'  => 'Media',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Media Publikasi harus diisi.',
                    ],
                ],
                'LocCity' => [
                    'label'  => 'LocCity',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Lokasi Media harus diisi.',
                    ],
                ],
                'LocCountry' => [
                    'label'  => 'LocCountry',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Lokasi Media harus diisi.',
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
                'Mediatype' => [
                    'label'  => 'Mediatype',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Media Publikasi Tingkat harus diisi.',
                    ],
                ],
                'Diffbenefit' => [
                    'label'  => 'Diffbenefit',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tingkat Kesulitan dan Manfaat harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Uraian Singkat harus diisi.',
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
                $Media = $this->request->getVar('Media');
                $LocCity = $this->request->getVar('LocCity');
                $LocCountry = $this->request->getVar('LocCountry');
                $Bulan = $this->request->getVar('Month');
                $Tahun = $this->request->getVar('Year');
                $Mediatype = $this->request->getVar('Mediatype');
                $Diffbenefit = $this->request->getVar('Diffbenefit');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp51');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $nilai_p = $nilai_p + 1;
                    switch ($Mediatype) {
                        case "Lok":
                            $nilai_q = $nilai_q + 1;
                            break;
                        case "Nas":
                            $nilai_q = $nilai_q + 2;
                            break;
                        case "Int":
                            $nilai_q = $nilai_q + 4;
                            break;
                    }
                    switch ($Diffbenefit) {
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
                $nilai_w4 = $nilai_p * $nilai_q * $nilai_r;

                $mediakartul = $slug->slugify($Media);
                $ext = $File->getClientExtension();
                if ((empty($filename)) && (!empty($ext))) {
                    $random = bin2hex(random_bytes(4));
                    $filenamenew = $user_id . '_karyatulis_' . $mediakartul . '_' . $random . '.' . $ext;
                    $File->move('uploads/docs/', $filenamenew, true);
                } elseif ((!empty($filename)) && (!empty($ext))) {
                    $oldext = substr($filename, -4);
                    if ($oldext == $ext) {
                        $File->move('uploads/docs/', $filename, true);
                        $filenamenew = $filename;
                    } else {
                        $random = bin2hex(random_bytes(4));
                        $filenamenew = $user_id . '_karyatulis_' . str_replace(' ', '', $Media) . '_' . $random . '.' . $ext;
                        $File->move('uploads/docs/', $filenamenew, true);
                    }
                } else {
                    $filenamenew = $filename;
                }

                $data = array(
                    'Name' => $Name,
                    'Media' => $Media,
                    'LocCity' => $LocCity,
                    'LocCountry' => $LocCountry,
                    'Year' => $Tahun,
                    'Month' => $Bulan,
                    'Mediatype' => $Mediatype,
                    'Diffbenefit' => $Diffbenefit,
                    'Desc' => $Desc,
                    'File' => $filenamenew,
                    'kompetensi' => $stringkp,
                    'nilai_p' => $nilai_p,
                    'nilai_q' => $nilai_q,
                    'nilai_r' => $nilai_r,
                    'nilai_w4' => $nilai_w4,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data Karya Tulis berhasil diubah.');

                return redirect()->to('/userfair51/docs');
            } else {
                $kartul = $model->where('Num', $Num)->first();
                if ($kartul) {
                    $data = [
                        'Num' => $kartul['Num'],
                        'Name' => $kartul['Name'],
                        'Media' => $kartul['Media'],
                        'LocCity' => $kartul['LocCity'],
                        'LocCountry' => $kartul['LocCountry'],
                        'Year' => $kartul['Year'],
                        'Month' => $kartul['Month'],
                        'Mediatype' => $kartul['Mediatype'],
                        'Diffbenefit' => $kartul['Diffbenefit'],
                        'Desc' => $kartul['Desc'],
                        'File' => $kartul['File'],
                        'datakomp' => explode(", ", $kartul['kompetensi'])
                    ];
                }

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.4%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "V.1. Karya Tulis di Bidang Keinsinyuran yang Dipublikasikan (W4)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Karya Tulis</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahkartul', $data);
            }
        }
    }
}
