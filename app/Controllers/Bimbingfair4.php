<?php

namespace App\Controllers;

use App\Models\MengajarModel;
use App\Models\KompModel;
use App\Libraries\Slug;
use App\Models\ConfigModel;

class Bimbingfair4 extends BaseController
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
        $model = new MengajarModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kerja = $model->where('user_id', $user_id)->orderby('StartPeriod', 'DESC')->findall();
        if (!empty($kerja)) {
            $data['data_kerja'] = $kerja;
        } else {
            $data['data_kerja'] = 'kosong';
        }

        $data['user_id'] = $user_id;
        $data['title_page'] = "IV. Pengalaman Mengajar Pelajaran Keinsinyuran dan/atau Manajemen dan/atau Pengalaman Mengembangkan Pendidikan/Pelatihan Keinsinyuran dan/atau Manajemen (W2,W3,W4,P5)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/bimbingfair/docs/" . $id . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Pengalaman Mengajar</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/bimbingdok4', $data);
    }

    public function tambahajar()
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
        $where = "komp_cat LIKE 'W.2%' OR komp_cat LIKE 'W.3%' OR komp_cat LIKE 'W.4%' OR komp_cat LIKE 'P.5%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "IV. Pengalaman Mengajar Pelajaran Keinsinyuran dan/atau Manajemen dan/atau Pengalaman Mengembangkan Pendidikan/Pelatihan Keinsinyuran dan/atau Manajemen (W2,W3,W4,P5)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Pengalaman Mengajar</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/tambahajar', $data);
    }

    public function tambahajarproses()
    {
        $slug = new Slug();
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new MengajarModel();
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair4/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'StartPeriod' => [
                    'label'  => 'Tahun Mulai',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Mulai harus diisi.',
                    ],
                ],
                'EndPeriod' => [
                    'label'  => 'Tahun Selesai',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Selesai harus diisi.',
                    ],
                ],
                'Institution' => [
                    'label'  => 'Nama Perguruan Tinggi / Lembaga',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Perguruan Tinggi / Lembaga harus diisi.',
                    ],
                ],
                'Name' => [
                    'label'  => 'Nama Mata Ajaran',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Mata Ajaran harus diisi.',
                    ],
                ],
                'LocCity' => [
                    'label'  => 'LocCity',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota harus diisi.',
                    ],
                ],
                'LocProv' => [
                    'label'  => 'LocProv',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Provinsi harus diisi.',
                    ],
                ],
                'LocCountry' => [
                    'label'  => 'LocCountry',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara harus diisi.',
                    ],
                ],
                'Period' => [
                    'label' => 'Perioda',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Perioad harus diisi.',
                    ],
                ],
                'Position' => [
                    'label' => 'Jabatan pada Perguruan Tinggi / Lembaga',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field jabatan harus diisi.',
                    ],
                ],
                'Skshour' => [
                    'label' => 'Jumlah Jam atau S.K.S',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field jumlah jam harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label' => 'Uraian Singkat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field uraian singkat harus diisi.',
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
                $StartPeriod = $this->request->getVar('StartPeriod');
                $EndPeriod = $this->request->getVar('EndPeriod');
                $Institution = $this->request->getVar('Institution');
                $Name = $this->request->getVar('Name');
                $LocCity = $this->request->getVar('LocCity');
                $LocProv = $this->request->getVar('LocProv');
                $LocCountry = $this->request->getVar('LocCountry');
                $Period = $this->request->getVar('Period');
                $Position = $this->request->getVar('Position');
                $Skshour = $this->request->getVar('Skshour');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp4');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $nilai_q = $nilai_q + 2;
                    if ((substr($kp, 0, 3) == 'W.2') or (substr($kp, 0, 3) == 'W.3') or (substr($kp, 0, 3) == 'W.4') or (substr($kp, 0, 1) == 'P')) {
                        switch ($Period) {
                            case 'smp9':
                                $nilai_p = $nilai_p + 1;
                                break;
                            case 'smp14':
                                $nilai_p = $nilai_p + 2;
                                break;
                            case 'smpe19':
                                $nilai_p = $nilai_p + 3;
                                break;
                            case 'lbih20':
                                $nilai_p = $nilai_p + 4;
                                break;
                        }
                        switch ($Skshour) {
                            case 'sks1':
                                $nilai_r = $nilai_r + 1;
                                break;
                            case 'sks2':
                                $nilai_r = $nilai_r + 2;
                                break;
                            case 'sks3':
                                $nilai_r = $nilai_r + 3;
                                break;
                        }
                    }
                    $i++;
                    if ($i != $totarray) {
                        $stringkp = $stringkp . $kp . ', ';
                    } else {
                        $stringkp = $stringkp . $kp;
                    }
                endforeach;
                $nilai_w2 = $nilai_p * $nilai_q * $nilai_r;
                $nilai_w3 = $nilai_p * $nilai_q * $nilai_r;
                $nilai_w4 = $nilai_p * $nilai_q * $nilai_r;
                $nilai_pil = $nilai_p * $nilai_q * $nilai_r;

                $ext = $File->getClientExtension();
                if (!empty($ext)) {
                    $namainstansi = $slug->slugify($Institution);
                    $namamk = $slug->slugify($Name);
                    $filename = $user_id . '_pengajar_' . $namainstansi . '_' . $namamk . '.' . $ext;
                    $File->move('uploads/docs/', $filename, true);
                } else {
                    $filename = "";
                }

                $data = array(
                    'user_id' => $user_id,
                    'Institution' => $Institution,
                    'Name' => $Name,
                    'LocCity' => $LocCity,
                    'LocProv' => $LocProv,
                    'LocCountry' => $LocCountry,
                    'Period' => $Period,
                    'StartPeriod' => $StartPeriod,
                    'EndPeriod' => $EndPeriod,
                    'Position' => $Position,
                    'Skshour' => $Skshour,
                    'Desc' => $Desc,
                    'File' => $filename,
                    'kompetensi' => $stringkp,
                    'nilai_p' => $nilai_p,
                    'nilai_q' => $nilai_q,
                    'nilai_r' => $nilai_r,
                    'nilai_w2' => $nilai_w2,
                    'nilai_w3' => $nilai_w3,
                    'nilai_w4' => $nilai_w4,
                    'nilai_pil' => $nilai_pil,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );

                $model->save($data);
                $session->setFlashdata('msg', 'Data pengalaman mengajar berhasil ditambah.');

                return redirect()->to('/userfair4/docs');
            } else {

                $data['datakomp'] = $this->request->getVar('komp4');

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.2%' OR komp_cat LIKE 'W.3%' OR komp_cat LIKE 'W.4%' OR komp_cat LIKE 'P.5%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "IV. Pengalaman Mengajar Pelajaran Keinsinyuran dan/atau Manajemen dan/atau Pengalaman Mengembangkan Pendidikan/Pelatihan Keinsinyuran dan/atau Manajemen (W2,W3,W4,P5)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Pengalaman Mengajar</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahajarvalid', $data);
            }
        }
    }

    public function hapusajar($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new MengajarModel();

        $pengkerja = $model->find($id);
        $path = './uploads/docs/' . $pengkerja['File'];
        if (is_file($path)) {
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data kualifikasi profesional berhasil dihapus.');

        return redirect()->to('/userfair4/docs');
    }

    public function ubahajar($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new MengajarModel();
        $kerja = $model->where('Num', $id)->first();
        if ($kerja) {
            $data = [
                'Num' => $kerja['Num'],
                'user_id' => $kerja['user_id'],
                'Institution' => $kerja['Institution'],
                'Name' => $kerja['Name'],
                'LocCity' => $kerja['LocCity'],
                'LocProv' => $kerja['LocProv'],
                'LocCountry' => $kerja['LocCountry'],
                'Period' => $kerja['Period'],
                'StartPeriod' => $kerja['StartPeriod'],
                'EndPeriod' => $kerja['EndPeriod'],
                'Position' => $kerja['Position'],
                'Skshour' => $kerja['Skshour'],
                'Desc' => $kerja['Desc'],
                'File' => $kerja['File'],
                'datakomp' => explode(", ", $kerja['kompetensi'])
            ];
        }

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'W.2%' OR komp_cat LIKE 'W.3%' OR komp_cat LIKE 'W.4%' OR komp_cat LIKE 'P.5%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "IV. Pengalaman Mengajar Pelajaran Keinsinyuran dan/atau Manajemen dan/atau Pengalaman Mengembangkan Pendidikan/Pelatihan Keinsinyuran dan/atau Manajemen (W2,W3,W4,P5)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Pengalaman Mengajar</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahajar', $data);
    }

    public function ubahajarproses()
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
        $model = new MengajarModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair4/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'StartPeriod' => [
                    'label'  => 'Tahun Mulai',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Mulai harus diisi.',
                    ],
                ],
                'EndPeriod' => [
                    'label'  => 'Tahun Selesai',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Selesai harus diisi.',
                    ],
                ],
                'Institution' => [
                    'label'  => 'Nama Perguruan Tinggi / Lembaga',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Perguruan Tinggi / Lembaga harus diisi.',
                    ],
                ],
                'Name' => [
                    'label'  => 'Nama Mata Ajaran',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Mata Ajaran harus diisi.',
                    ],
                ],
                'LocCity' => [
                    'label'  => 'LocCity',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota harus diisi.',
                    ],
                ],
                'LocProv' => [
                    'label'  => 'LocProv',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Provinsi harus diisi.',
                    ],
                ],
                'LocCountry' => [
                    'label'  => 'LocCountry',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara harus diisi.',
                    ],
                ],
                'Period' => [
                    'label' => 'Perioda',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Perioad harus diisi.',
                    ],
                ],
                'Position' => [
                    'label' => 'Jabatan pada Perguruan Tinggi / Lembaga',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field jabatan harus diisi.',
                    ],
                ],
                'Skshour' => [
                    'label' => 'Jumlah Jam atau S.K.S',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field jumlah jam harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label' => 'Uraian Singkat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field uraian singkat harus diisi.',
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
                $StartPeriod = $this->request->getVar('StartPeriod');
                $EndPeriod = $this->request->getVar('EndPeriod');
                $Institution = $this->request->getVar('Institution');
                $Name = $this->request->getVar('Name');
                $LocCity = $this->request->getVar('LocCity');
                $LocProv = $this->request->getVar('LocProv');
                $LocCountry = $this->request->getVar('LocCountry');
                $Period = $this->request->getVar('Period');
                $Position = $this->request->getVar('Position');
                $Skshour = $this->request->getVar('Skshour');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp4');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $nilai_q = $nilai_q + 2;
                    if ((substr($kp, 0, 3) == 'W.2') or (substr($kp, 0, 3) == 'W.3') or (substr($kp, 0, 3) == 'W.4') or (substr($kp, 0, 1) == 'P')) {
                        switch ($Period) {
                            case 'smp9':
                                $nilai_p = $nilai_p + 1;
                                break;
                            case 'smp14':
                                $nilai_p = $nilai_p + 2;
                                break;
                            case 'smpe19':
                                $nilai_p = $nilai_p + 3;
                                break;
                            case 'lbih20':
                                $nilai_p = $nilai_p + 4;
                                break;
                        }
                        switch ($Skshour) {
                            case 'sks1':
                                $nilai_r = $nilai_r + 1;
                                break;
                            case 'sks2':
                                $nilai_r = $nilai_r + 2;
                                break;
                            case 'sks4':
                                $nilai_r = $nilai_r + 3;
                                break;
                        }
                    }
                    $i++;
                    if ($i != $totarray) {
                        $stringkp = $stringkp . $kp . ', ';
                    } else {
                        $stringkp = $stringkp . $kp;
                    }
                endforeach;
                $nilai_w2 = $nilai_p * $nilai_q * $nilai_r;
                $nilai_w3 = $nilai_p * $nilai_q * $nilai_r;
                $nilai_w4 = $nilai_p * $nilai_q * $nilai_r;
                $nilai_pil = $nilai_p * $nilai_q * $nilai_r;

                $namainstansi = $slug->slugify($Institution);
                $namamk = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if ((empty($filename)) && (!empty($ext))) {
                    $filenamenew = $user_id . '_pengajar_' . $namainstansi . '_' . $namamk . '.' . $ext;
                    $File->move('uploads/docs/', $filenamenew, true);
                } elseif ((!empty($filename)) && (!empty($ext))) {
                    $oldext = substr($filename, -4);
                    if ($oldext == $ext) {
                        $File->move('uploads/docs/', $filename, true);
                        $filenamenew = $filename;
                    } else {
                        $filenamenew = $user_id . '_pengajar_' . $namainstansi . '_' . $namamk . '.' . $ext;
                        $File->move('uploads/docs/', $filenamenew, true);
                    }
                } else {
                    $filenamenew = $filename;
                }

                $data = array(
                    'Institution' => $Institution,
                    'Name' => $Name,
                    'LocCity' => $LocCity,
                    'LocProv' => $LocProv,
                    'LocCountry' => $LocCountry,
                    'Period' => $Period,
                    'StartPeriod' => $StartPeriod,
                    'EndPeriod' => $EndPeriod,
                    'Position' => $Position,
                    'Skshour' => $Skshour,
                    'Desc' => $Desc,
                    'File' => $filenamenew,
                    'kompetensi' => $stringkp,
                    'nilai_p' => $nilai_p,
                    'nilai_q' => $nilai_q,
                    'nilai_r' => $nilai_r,
                    'nilai_w2' => $nilai_w2,
                    'nilai_w3' => $nilai_w3,
                    'nilai_w4' => $nilai_w4,
                    'nilai_pil' => $nilai_pil,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data kualifikasi profesional berhasil diubah.');

                return redirect()->to('/userfair4/docs');
            } else {
                $session = session();
                $model = new MengajarModel();
                $kerja = $model->where('Num', $Num)->first();
                if ($kerja) {
                    $data = [
                        'Num' => $kerja['Num'],
                        'user_id' => $kerja['user_id'],
                        'Institution' => $kerja['Institution'],
                        'Name' => $kerja['Name'],
                        'LocCity' => $kerja['LocCity'],
                        'LocProv' => $kerja['LocProv'],
                        'LocCountry' => $kerja['LocCountry'],
                        'Period' => $kerja['Period'],
                        'StartPeriod' => $kerja['StartPeriod'],
                        'EndPeriod' => $kerja['EndPeriod'],
                        'Position' => $kerja['Position'],
                        'Skshour' => $kerja['Skshour'],
                        'Desc' => $kerja['Desc'],
                        'File' => $kerja['File'],
                        'datakomp' => explode(", ", $kerja['kompetensi'])
                    ];
                }

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.2%' OR komp_cat LIKE 'W.3%' OR komp_cat LIKE 'W.4%' OR komp_cat LIKE 'P.5%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "IV. Pengalaman Mengajar Pelajaran Keinsinyuran dan/atau Manajemen dan/atau Pengalaman Mengembangkan Pendidikan/Pelatihan Keinsinyuran dan/atau Manajemen (W2,W3,W4,P5)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Pengalaman Mengajar</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahajar', $data);
            }
        }
    }
}
