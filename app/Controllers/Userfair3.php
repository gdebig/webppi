<?php

namespace App\Controllers;

use App\Models\CapesKualifikasiModel;
use App\Models\KompModel;
use App\Libraries\Slug;

class Userfair3 extends BaseController
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
        $model = new CapesKualifikasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kerja = $model->where('user_id', $user_id)->orderby('ProjValue', 'DESC')->findall();
        if (!empty($kerja)) {
            $data['data_kerja'] = $kerja;
        } else {
            $data['data_kerja'] = 'kosong';
        }

        $data['title_page'] = "III. KUALIFIKASI PROFESIONAL (W2,W3,W4,P6,P7,P8,P9,P10,P11)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Kualifikasi Profesional</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok3', $data);
    }

    public function tambahkerja()
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
        $where = "komp_cat LIKE 'W.2%' OR komp_cat LIKE 'W.3%' OR komp_cat LIKE 'W.4%' OR komp_cat LIKE 'P.6%' OR komp_cat LIKE 'P.7%' OR komp_cat LIKE 'P.8%' OR komp_cat LIKE 'P.9%' OR komp_cat LIKE 'P.10%' OR komp_cat LIKE 'P.11%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "III. KUALIFIKASI PROFESIONAL (W2,W3,W4,P6,P7,P8,P9,P10,P11)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Kualifikasi Profesional</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/tambahkerja', $data);
    }

    public function tambahkerjaproses()
    {
        $slug = new Slug();
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new CapesKualifikasiModel();
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair3/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'startdate' => [
                    'label'  => 'startdate',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tanggal Mulai Kerja harus diisi.',
                    ],
                ],
                'NameInstance' => [
                    'label'  => 'NameInstance',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Instansi / Perusahaan harus diisi.',
                    ],
                ],
                'Position' => [
                    'label'  => 'Position',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jabatan/Tugas harus diisi.',
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
                'File' => [
                    'rules'  => 'ext_in[File,jpg,jpeg,png,pdf]|max_size[File, 700]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF, JPG, JPEG atau PNG",
                        'max_size' => "Ukuran File Maksimal 700KB"
                    ],
                ]
            ]);

            if ($formvalid) {
                $startdate = $this->request->getVar('startdate');
                $masihkerja = $this->request->getVar('masihkerja');
                if ((isset($masihkerja)) && $masihkerja == "masihkerja") {
                    $enddate = "";
                } else {
                    $enddate = $this->request->getVar('enddate');
                }
                $NameInstance = $this->request->getVar('NameInstance');
                $Position = $this->request->getVar('Position');
                $Name = $this->request->getVar('Name');
                $Giver = $this->request->getVar('Giver');
                $LocCity = $this->request->getVar('LocCity');
                $LocProv = $this->request->getVar('LocProv');
                $LocCountry = $this->request->getVar('LocCountry');
                $Duration = $this->request->getVar('Duration');
                $Jabatan = $this->request->getVar('Jabatan');
                $ProjValue = $this->request->getVar('ProjValue');
                $RspnValue = $this->request->getVar('RspnValue');
                $Hresource = $this->request->getVar('Hresource');
                $Diff = $this->request->getVar('Diff');
                $Scale = $this->request->getVar('Scale');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp3');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $nilai_q = $nilai_q + 2;
                    if ((substr($kp, 0, 3) == 'W.2') or (substr($kp, 0, 3) == 'W.3') or (substr($kp, 0, 3) == 'W.4') or (substr($kp, 0, 1) == 'P')) {
                        switch ($Duration) {
                            case 'smp3':
                                $nilai_p = $nilai_p + 1;
                                break;
                            case 'smp7':
                                $nilai_p = $nilai_p + 2;
                                break;
                            case 'smpe10':
                                $nilai_p = $nilai_p + 3;
                                break;
                            case 'lbih10':
                                $nilai_p = $nilai_p + 4;
                                break;
                        }
                        switch ($Jabatan) {
                            case 'anggota':
                                $nilai_q = $nilai_q + 1;
                                break;
                            case 'supervisor':
                                $nilai_q = $nilai_q + 2;
                                break;
                            case 'direktur':
                                $nilai_q = $nilai_q + 3;
                                break;
                            case 'pengarah':
                                $nilai_q = $nilai_q + 4;
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
                $nilai_w2 = $nilai_p * $nilai_q;
                $nilai_w3 = $nilai_p * $nilai_q;
                $nilai_w4 = $nilai_p * $nilai_q;
                $nilai_pil = $nilai_p * $nilai_q;

                $ext = $File->getClientExtension();
                if (!empty($ext)) {
                    $namainstansi = $slug->slugify($NameInstance);
                    $posisi = $slug->slugify($Position);
                    $filename = $user_id . '_pengkerja_' . $namainstansi . '_' . $posisi . '.' . $ext;
                    echo $filename;
                    $File->move('uploads/docs/', $filename, true);
                } else {
                    $filename = "";
                }

                $data = array(
                    'user_id' => $user_id,
                    'StartDate' => $startdate,
                    'EndDate' => $enddate,
                    'NameInstance' => $NameInstance,
                    'Position' => $Position,
                    'Name' => $Name,
                    'Giver' => $Giver,
                    'LocCity' => $LocCity,
                    'LocProv' => $LocProv,
                    'LocCountry' => $LocCountry,
                    'Duration' => $Duration,
                    'Jabatan' => $Jabatan,
                    'ProjValue' => $ProjValue,
                    'RspnValue' => $RspnValue,
                    'Hresource' => $Hresource,
                    'Diff' => $Diff,
                    'Scale' => $Scale,
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
                $session->setFlashdata('msg', 'Data kualifikasi profesional berhasil ditambah.');

                return redirect()->to('/userfair3/docs');
            } else {

                $data['datakomp'] = $this->request->getVar('komp3');

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.2%' OR komp_cat LIKE 'W.3%' OR komp_cat LIKE 'W.4%' OR komp_cat LIKE 'P.6%' OR komp_cat LIKE 'P.7%' OR komp_cat LIKE 'P.8%' OR komp_cat LIKE 'P.9%' OR komp_cat LIKE 'P.10%' OR komp_cat LIKE 'P.11%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "III. KUALIFIKASI PROFESIONAL (W2,W3,W4,P6,P7,P8,P9,P10,P11)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Kualifikasi Profesional</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahkerjavalid', $data);
            }
        }
    }

    public function hapuskerja($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new CapesKualifikasiModel();

        $pengkerja = $model->find($id);
        $path = './uploads/docs/' . $pengkerja['File'];
        if (is_file($path)) {
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data kualifikasi profesional berhasil dihapus.');

        return redirect()->to('/userfair3/docs');
    }

    public function ubahkerja($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new CapesKualifikasiModel();
        $kerja = $model->where('Num', $id)->first();
        if ($kerja) {
            if ($kerja['EndDate'] == "0000-00-00") {
                $masihkerja = "checked";
                $enddate = "";
            } else {
                $masihkerja = "";
                $enddate = $kerja['EndDate'];
            }
            $Project = explode(".", $kerja['ProjValue']);
            $str = preg_replace('/[^0-9.]+/', '', $Project[1]);
            $data = [
                'Num' => $kerja['Num'],
                'user_id' => $kerja['user_id'],
                'StartDate' => $kerja['StartDate'],
                'masihkerja' => $masihkerja,
                'EndDate' => $enddate,
                'NameInstance' => $kerja['NameInstance'],
                'Position' => $kerja['Position'],
                'Name' => $kerja['Name'],
                'Giver' => $kerja['Giver'],
                'LocCity' => $kerja['LocCity'],
                'LocProv' => $kerja['LocProv'],
                'LocCountry' => $kerja['LocCountry'],
                'Duration' => $kerja['Duration'],
                'Jabatan' => $kerja['Jabatan'],
                'ProjValue' => $str,
                'RspnValue' => $kerja['RspnValue'],
                'Hresource' => $kerja['Hresource'],
                'Diff' => $kerja['Diff'],
                'Scale' => $kerja['Scale'],
                'Desc' => $kerja['Desc'],
                'File' => $kerja['File'],
                'datakomp' => explode(", ", $kerja['kompetensi'])
            ];
        }

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'W.2%' OR komp_cat LIKE 'W.3%' OR komp_cat LIKE 'W.4%' OR komp_cat LIKE 'P.6%' OR komp_cat LIKE 'P.7%' OR komp_cat LIKE 'P.8%' OR komp_cat LIKE 'P.9%' OR komp_cat LIKE 'P.10%' OR komp_cat LIKE 'P.11%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "III. KUALIFIKASI PROFESIONAL (W2,W3,W4,P6,P7,P8,P9,P10,P11)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Kualifikasi Profesional</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahkerja', $data);
    }

    public function ubahkerjaproses()
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
        $model = new CapesKualifikasiModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair3/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'startdate' => [
                    'label'  => 'startdate',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tanggal Mulai Kerja harus diisi.',
                    ],
                ],
                'NameInstance' => [
                    'label'  => 'NameInstance',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Instansi / Perusahaan harus diisi.',
                    ],
                ],
                'Position' => [
                    'label'  => 'Position',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jabatan/Tugas harus diisi.',
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
                $startdate = $this->request->getVar('startdate');
                $masihkerja = $this->request->getVar('masihkerja');
                if ((isset($masihkerja)) && $masihkerja == "masihkerja") {
                    $enddate = "";
                } else {
                    $enddate = $this->request->getVar('enddate');
                }
                $NameInstance = $this->request->getVar('NameInstance');
                $Position = $this->request->getVar('Position');
                $Name = $this->request->getVar('Name');
                $Giver = $this->request->getVar('Giver');
                $LocCity = $this->request->getVar('LocCity');
                $LocProv = $this->request->getVar('LocProv');
                $LocCountry = $this->request->getVar('LocCountry');
                $Duration = $this->request->getVar('Duration');
                $Jabatan = $this->request->getVar('Jabatan');
                $ProjValue = $this->request->getVar('ProjValue');
                $RspnValue = $this->request->getVar('RspnValue');
                $Hresource = $this->request->getVar('Hresource');
                $Diff = $this->request->getVar('Diff');
                $Scale = $this->request->getVar('Scale');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp3');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $nilai_q = $nilai_q + 2;
                    if ((substr($kp, 0, 3) == 'W.2') or (substr($kp, 0, 3) == 'W.3') or (substr($kp, 0, 3) == 'W.4') or (substr($kp, 0, 1) == 'P')) {
                        switch ($Duration) {
                            case 'smp3':
                                $nilai_p = $nilai_p + 1;
                                break;
                            case 'smp7':
                                $nilai_p = $nilai_p + 2;
                                break;
                            case 'smpe10':
                                $nilai_p = $nilai_p + 3;
                                break;
                            case 'lbih10':
                                $nilai_p = $nilai_p + 4;
                                break;
                        }
                        switch ($Jabatan) {
                            case 'anggota':
                                $nilai_q = $nilai_q + 1;
                                break;
                            case 'supervisor':
                                $nilai_q = $nilai_q + 2;
                                break;
                            case 'direktur':
                                $nilai_q = $nilai_q + 3;
                                break;
                            case 'pengarah':
                                $nilai_q = $nilai_q + 4;
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
                $nilai_w2 = $nilai_p * $nilai_q;
                $nilai_w3 = $nilai_p * $nilai_q;
                $nilai_w4 = $nilai_p * $nilai_q;
                $nilai_pil = $nilai_p * $nilai_q;

                $namainstansi = $slug->slugify($NameInstance);
                $posisi = $slug->slugify($Position);
                $ext = $File->getClientExtension();
                if ((empty($filename)) && (!empty($ext))) {
                    $filenamenew = $user_id . '_pengkerja_' . $namainstansi . '_' . $posisi . '.' . $ext;
                    $File->move('uploads/docs/', $filenamenew, true);
                } elseif ((!empty($filename)) && (!empty($ext))) {
                    $oldext = substr($filename, -4);
                    if ($oldext == $ext) {
                        $File->move('uploads/docs/', $filename, true);
                        $filenamenew = $filename;
                    } else {
                        $filenamenew = $user_id . '_pengkerja_' . $namainstansi . '_' . $posisi . '.' . $ext;
                        $File->move('uploads/docs/', $filenamenew, true);
                    }
                } else {
                    $filenamenew = $filename;
                }

                $data = array(
                    'StartDate' => $startdate,
                    'masihkerja' => $masihkerja,
                    'EndDate' => $enddate,
                    'NameInstance' => $NameInstance,
                    'Position' => $Position,
                    'Name' => $Name,
                    'Giver' => $Giver,
                    'LocCity' => $LocCity,
                    'LocProv' => $LocProv,
                    'LocCountry' => $LocCountry,
                    'Duration' => $Duration,
                    'Jabatan' => $Jabatan,
                    'ProjValue' => $ProjValue,
                    'RspnValue' => $RspnValue,
                    'Hresource' => $Hresource,
                    'Diff' => $Diff,
                    'Scale' => $Scale,
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

                return redirect()->to('/userfair3/docs');
            } else {
                $session = session();
                $model = new CapesKualifikasiModel();
                $kerja = $model->where('Num', $Num)->first();
                if ($kerja) {
                    if ($kerja['EndDate'] == "0000-00-00") {
                        $masihkerja = "checked";
                        $enddate = "";
                    } else {
                        $masihkerja = "";
                        $enddate = $kerja['EndDate'];
                    }
                    $data = [
                        'Num' => $kerja['Num'],
                        'user_id' => $kerja['user_id'],
                        'StartDate' => $kerja['StartDate'],
                        'masihkerja' => $masihkerja,
                        'EndDate' => $enddate,
                        'NameInstance' => $kerja['NameInstance'],
                        'Position' => $kerja['Position'],
                        'Name' => $kerja['Name'],
                        'Giver' => $kerja['Giver'],
                        'LocCity' => $kerja['LocCity'],
                        'LocProv' => $kerja['LocProv'],
                        'LocCountry' => $kerja['LocCountry'],
                        'Duration' => $kerja['Duration'],
                        'Jabatan' => $kerja['Jabatan'],
                        'ProjValue' => $kerja['ProjValue'],
                        'RspnValue' => $kerja['RspnValue'],
                        'Hresource' => $kerja['Hresource'],
                        'Diff' => $kerja['Diff'],
                        'Scale' => $kerja['Scale'],
                        'Desc' => $kerja['Desc'],
                        'File' => $kerja['File'],
                        'datakomp' => explode(", ", $kerja['kompetensi'])
                    ];
                }

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.2%' OR komp_cat LIKE 'W.3%' OR komp_cat LIKE 'W.4%' OR komp_cat LIKE 'P.6%' OR komp_cat LIKE 'P.7%' OR komp_cat LIKE 'P.8%' OR komp_cat LIKE 'P.9%' OR komp_cat LIKE 'P.10%' OR komp_cat LIKE 'P.11%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "III. KUALIFIKASI PROFESIONAL (W2,W3,W4,P6,P7,P8,P9,P10,P11)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Kualifikasi Profesional</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahkerja', $data);
            }
        }
    }
}
