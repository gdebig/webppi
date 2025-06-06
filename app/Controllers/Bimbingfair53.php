<?php

namespace App\Controllers;

use App\Models\CapesSemModel;
use App\Models\KompModel;
use App\Libraries\Slug;
use App\Models\ConfigModel;

class Bimbingfair53 extends BaseController
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

        $user_id1 = $session->get('user_id');

        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id1)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        helper(['tanggal']);
        $model = new CapesSemModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $sem = $model->where('user_id', $user_id)->where('Type', 'Sem')->orderby('Year', 'DESC')->findall();
        if (!empty($sem)) {
            $data['data_sem'] = $sem;
        } else {
            $data['data_sem'] = 'kosong';
        }

        $data['user_id'] = $user_id;
        $data['title_page'] = "V.3 Seminar/Lokakarya Keinsinyuran Yang Diikuti (W2)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/bimbingfair/docs/" . $id . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Seminar</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/bimbingdok53', $data);
    }

    public function tambahseminar()
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
        $where = "komp_cat LIKE 'W.2%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "V.3 Seminar/Lokakarya Keinsinyuran Yang Diikuti (W2)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Seminar</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/tambahseminar', $data);
    }

    public function tambahsemproses()
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
        $model = new CapesSemModel();
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair53/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Seminar/Lokakarya harus diisi.',
                    ],
                ],
                'Organizer' => [
                    'label'  => 'Organizer',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Penyelenggara harus diisi.',
                    ],
                ],
                'LocCity' => [
                    'label'  => 'LocCity',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota harus diisi.',
                    ],
                ],
                'LocCountry' => [
                    'label'  => 'LocCountry',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara harus diisi.',
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
                'Level' => [
                    'label'  => 'Level',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Seminar/Lokakarya Tingkat harus diisi.',
                    ],
                ],
                'DiffBenefit' => [
                    'label'  => 'DiffBenefit',
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
                $Organizer = $this->request->getVar('Organizer');
                $LocCity = $this->request->getVar('LocCity');
                $LocCountry = $this->request->getVar('LocCountry');
                $Month = $this->request->getVar('Month');
                $Year = $this->request->getVar('Year');
                $Level = $this->request->getVar('Level');
                $DiffBenefit = $this->request->getVar('DiffBenefit');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp53');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $nilai_p = $nilai_p + 1;
                    switch ($Level) {
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
                $nilai_w2 = $nilai_p * $nilai_q * $nilai_r;

                $namaseminar = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if (!empty($ext)) {
                    $random = bin2hex(random_bytes(4));
                    $filename = $user_id . '_seminar_' . $namaseminar . '_' . $random . '.' . $ext;
                    $File->move('uploads/docs/', $filename, true);
                } else {
                    $filename = "";
                }

                $data = array(
                    'user_id' => $user_id,
                    'Type' => 'Sem',
                    'Name' => $Name,
                    'Organizer' => $Organizer,
                    'LocCity' => $LocCity,
                    'LocCountry' => $LocCountry,
                    'Year' => $Year,
                    'Month' => $Month,
                    'Level' => $Level,
                    'DiffBenefit' => $DiffBenefit,
                    'Desc' => $Desc,
                    'File' => $filename,
                    'kompetensi' => $stringkp,
                    'nilai_p' => $nilai_p,
                    'nilai_q' => $nilai_q,
                    'nilai_r' => $nilai_r,
                    'nilai_w2' => $nilai_w2,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );

                $model->save($data);
                $session->setFlashdata('msg', 'Data Seminar berhasil ditambah.');

                return redirect()->to('/userfair53/docs');
            } else {
                $data['datakomp'] = $this->request->getVar('komp53');

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.2%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "V.3 Seminar/Lokakarya Keinsinyuran Yang Diikuti (W2)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Seminar</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahsemvalid', $data);
            }
        }
    }

    public function hapusmak($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new CapesSemModel();

        $sem = $model->find($id);
        $path = './uploads/docs/' . $sem['File'];
        if (is_file($path)) {
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data seminar berhasil dihapus.');

        return redirect()->to('/userfair53/docs');
    }

    public function ubahsem($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new CapesSemModel();
        $sem = $model->where('Num', $id)->first();
        if ($sem) {
            $data = [
                'Num' => $sem['Num'],
                'user_id' => $sem['user_id'],
                'Name' => $sem['Name'],
                'Organizer' => $sem['Organizer'],
                'LocCity' => $sem['LocCity'],
                'LocCountry' => $sem['LocCountry'],
                'Year' => $sem['Year'],
                'Month' => $sem['Month'],
                'Level' => $sem['Level'],
                'DiffBenefit' => $sem['DiffBenefit'],
                'Desc' => $sem['Desc'],
                'File' => $sem['File'],
                'datakomp' => explode(", ", $sem['kompetensi'])
            ];
        }

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'W.2%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "V.3 Seminar/Lokakarya Keinsinyuran Yang Diikuti (W2)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Seminar</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahsem', $data);
    }

    public function ubahsemproses()
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
        $model = new CapesSemModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair53/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Seminar/Lokakarya harus diisi.',
                    ],
                ],
                'Organizer' => [
                    'label'  => 'Organizer',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Penyelenggara harus diisi.',
                    ],
                ],
                'LocCity' => [
                    'label'  => 'LocCity',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota harus diisi.',
                    ],
                ],
                'LocCountry' => [
                    'label'  => 'LocCountry',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara harus diisi.',
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
                'Level' => [
                    'label'  => 'Level',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Seminar/Lokakarya Tingkat harus diisi.',
                    ],
                ],
                'DiffBenefit' => [
                    'label'  => 'DiffBenefit',
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
                $Organizer = $this->request->getVar('Organizer');
                $LocCity = $this->request->getVar('LocCity');
                $LocCountry = $this->request->getVar('LocCountry');
                $Month = $this->request->getVar('Month');
                $Year = $this->request->getVar('Year');
                $Level = $this->request->getVar('Level');
                $DiffBenefit = $this->request->getVar('DiffBenefit');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp53');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $nilai_p = $nilai_p + 1;
                    switch ($Level) {
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
                $nilai_w2 = $nilai_p * $nilai_q * $nilai_r;

                $namaseminar = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if ((empty($filename)) && (!empty($ext))) {
                    $random = bin2hex(random_bytes(4));
                    $filenamenew = $user_id . '_seminar_' . $namaseminar . '_' . $random . '.' . $ext;
                    $File->move('uploads/docs/', $filenamenew, true);
                } elseif ((!empty($filename)) && (!empty($ext))) {
                    $oldext = substr($filename, -4);
                    if ($oldext == $ext) {
                        $File->move('uploads/docs/', $filename, true);
                        $filenamenew = $filename;
                    } else {
                        $random = bin2hex(random_bytes(4));
                        $filenamenew = $user_id . '_seminar_' . $namaseminar . '_' . $random . '.' . $ext;
                        $File->move('uploads/docs/', $filenamenew, true);
                    }
                } else {
                    $filenamenew = $filename;
                }

                $data = array(
                    'Type' => 'Sem',
                    'Name' => $Name,
                    'Organizer' => $Organizer,
                    'LocCity' => $LocCity,
                    'LocCountry' => $LocCountry,
                    'Year' => $Year,
                    'Month' => $Month,
                    'Level' => $Level,
                    'DiffBenefit' => $DiffBenefit,
                    'Desc' => $Desc,
                    'File' => $filenamenew,
                    'kompetensi' => $stringkp,
                    'nilai_p' => $nilai_p,
                    'nilai_q' => $nilai_q,
                    'nilai_r' => $nilai_r,
                    'nilai_w2' => $nilai_w2,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data makalah berhasil diubah.');

                return redirect()->to('/userfair53/docs');
            } else {
                $sem = $model->where('Num', $Num)->first();
                if ($sem) {
                    $data = [
                        'Num' => $sem['Num'],
                        'user_id' => $sem['user_id'],
                        'Name' => $sem['Name'],
                        'Organizer' => $sem['Organizer'],
                        'LocCity' => $sem['LocCity'],
                        'LocCountry' => $sem['LocCountry'],
                        'Year' => $sem['Year'],
                        'Month' => $sem['Month'],
                        'Level' => $sem['Level'],
                        'DiffBenefit' => $sem['DiffBenefit'],
                        'Desc' => $sem['Desc'],
                        'File' => $sem['File'],
                        'datakomp' => explode(", ", $sem['kompetensi'])
                    ];
                }

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.2%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "V.3 Seminar/Lokakarya Keinsinyuran Yang Diikuti (W2)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Seminar</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahsem', $data);
            }
        }
    }
}
