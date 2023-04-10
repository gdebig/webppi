<?php

namespace App\Controllers;

use App\Models\CapesOrgModel;
use App\Models\KompModel;
use App\Libraries\Slug;
use App\Models\ConfigModel;

class Bimbingfair13 extends BaseController
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
        $model = new CapesOrgModel();
        $org = $model->where('user_id', $user_id)->orderby('StartPeriodYear', 'DESC')->findall();
        if (!empty($org)) {
            $data['data_org'] = $org;
        } else {
            $data['data_org'] = 'kosong';
        }
        $data['user_id'] = $user_id;
        $data['title_page'] = "I.3. Organisasi Profesi & Organisasi Lainnya Yang Dimasuki (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/bimbingfair/docs/" . $id . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Organisasi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/bimbingdok13', $data);
    }

    public function tambahorganisasi()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'W.1%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "I.3. Organisasi Profesi & Organisasi Lainnya Yang Dimasuki (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Organisasi</li>';
        $data['logged_in'] = $session->get('logged_in');;
        return view('maintemp/tambahorguserfair', $data);
    }

    public function tambahorgproses()
    {
        $session = session();
        $model = new CapesOrgModel();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        $user_id = $session->get('user_id');
        helper(['tanggal']);

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair13/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Organisasi harus diisi.',
                    ],
                ],
                'Type' => [
                    'label'  => 'Type',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jenis Organisasi harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Organisasi harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Organisasi harus diisi.',
                    ],
                ],
                'StartPeriodBulan' => [
                    'label'  => 'StartPeriodBulan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan Mulai harus diisi.',
                    ],
                ],
                'StartPeriodYear' => [
                    'label'  => 'StartPeriodYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Mulai harus diisi.',
                    ],
                ],
                'EndPeriodBulan' => [
                    'label'  => 'EndPeriodBulan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan Berakhir harus diisi.',
                    ],
                ],
                'EndPeriodYear' => [
                    'label'  => 'EndPeriodYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Berakhir harus diisi.',
                    ],
                ],
                'Period' => [
                    'label'  => 'Period',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Sudah Berapa Lama Menjadi Anggota harus diisi.',
                    ],
                ],
                'Position' => [
                    'label'  => 'Position',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jabatan Dalam Organisasi harus diisi.',
                    ],
                ],
                'OrgLevel' => [
                    'label'  => 'OrgLevel',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tingkat Organisasi harus diisi.',
                    ],
                ],
                'OrgScp' => [
                    'label'  => 'OrgScp',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Lingkup Kegiatan Organisasi harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Uraian Aktifitas Dalam Organisasi harus diisi.',
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
                $Type = $this->request->getVar('Type');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $StartPeriodBulan = $this->request->getVar('StartPeriodBulan');
                $StartPeriodYear = $this->request->getVar('StartPeriodYear');
                $EndPeriodBulan = $this->request->getVar('EndPeriodBulan');
                $EndPeriodYear = $this->request->getVar('EndPeriodYear');
                $nilai_period = $this->request->getVar('Period');
                $nilai_position = $this->request->getVar('Position');
                $OrgLevel = $this->request->getVar('OrgLevel');
                $OrgScp = $this->request->getVar('OrgScp');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp13');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $i++;
                    if ($Type == "PII") {
                        $nilai_p = $nilai_p + 4;
                    } else {
                        switch ($nilai_period) {
                            case "sd5":
                                $nilai_p = $nilai_p + 1;
                                break;
                            case "smp10":
                                $nilai_p = $nilai_p + 2;
                                break;
                            case "smp15";
                                $nilai_p = $nilai_p + 3;
                                break;
                            case "lbih15";
                                $nilai_p = $nilai_p + 4;
                                break;
                        }
                    }
                    switch ($nilai_position) {
                        case "Bias":
                            $nilai_q = $nilai_q + 2;
                            break;
                        case "Peng":
                            $nilai_q = $nilai_q + 3;
                            break;
                        case "Pimp":
                            $nilai_q = $nilai_q + 4;
                            break;
                    }
                    switch ($OrgLevel) {
                        case "Loc":
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
                $nilai_w1 = $nilai_p * $nilai_r;

                $namaorganisasi = $slug->slugify($Name);
                $nilai_posisi = $slug->slugify($nilai_position);
                $ext = $File->getClientExtension();
                if (!empty($ext)) {
                    $filename = $user_id . '_organisasi_' . $namaorganisasi . '_' . $nilai_posisi . '.' . $ext;
                    $File->move('uploads/docs/', $filename, true);
                } else {
                    $filename = "";
                }

                $data = array(
                    'user_id' => $user_id,
                    'Name' => $Name,
                    'Type' => $Type,
                    'City' => $City,
                    'Country' => $Country,
                    'Period' => $nilai_period,
                    'StartPeriodBulan' => $StartPeriodBulan,
                    'StartPeriodYear' => $StartPeriodYear,
                    'EndPeriodBulan' => $EndPeriodBulan,
                    'EndPeriodYear' => $EndPeriodYear,
                    'Position' => $nilai_position,
                    'OrgLevel' => $OrgLevel,
                    'OrgScp' => $OrgScp,
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
                $session->setFlashdata('msg', 'Data Organisasi berhasil ditambah.');

                return redirect()->to('/userfair13/docs');
            } else {
                $session = session();

                $data['datakomp'] = $this->request->getVar('komp13');

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.1%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "I.3. Organisasi Profesi & Organisasi Lainnya Yang Dimasuki (W1)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Organisasi</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahorguserfairvalid', $data);
            }
        }
    }

    public function hapusorg($id)
    {
        $session = session();
        $model = new CapesOrgModel();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $org = $model->find($id);
        $nilai_path = './uploads/docs/' . $org['File'];
        if (is_file($nilai_path)) {
            unlink($nilai_path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data Organisasi berhasil dihapus.');

        return redirect()->to('/userfair13/docs');
    }

    public function ubahorg($id)
    {
        $session = session();
        $model = new CapesOrgModel();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);

        $org = $model->where('Num', $id)->first();
        if ($org) {
            $data = [
                'Num' => $org['Num'],
                'user_id' => $org['user_id'],
                'Name' => $org['Name'],
                'Type' => $org['Type'],
                'City' => $org['City'],
                'Country' => $org['Country'],
                'Period' => $org['Period'],
                'StartPeriodBulan' => $org['StartPeriodBulan'],
                'StartPeriodYear' => $org['StartPeriodYear'],
                'EndPeriodBulan' =>  $org['EndPeriodBulan'],
                'EndPeriodYear' => $org['EndPeriodYear'],
                'Position' => $org['Position'],
                'OrgLevel' => $org['OrgLevel'],
                'OrgScp' => $org['OrgScp'],
                'Desc' => $org['Desc'],
                'File' => $org['File'],
                'datakomp' => explode(", ", $org['kompetensi'])
            ];
        }

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'W.1%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "I.3. Organisasi Profesi & Organisasi Lainnya Yang Dimasuki (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Organisasi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahorguserfair', $data);
    }

    public function ubahorgproses()
    {
        $session = session();

        $slug = new Slug();
        $model = new CapesOrgModel();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && (!$ispenilai)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'penilai');
        }
        helper(['tanggal']);
        $Num = $this->request->getVar('Num');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair13/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Organisasi harus diisi.',
                    ],
                ],
                'Type' => [
                    'label'  => 'Type',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jenis Organisasi harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Organisasi harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Organisasi harus diisi.',
                    ],
                ],
                'StartPeriodBulan' => [
                    'label'  => 'StartPeriodBulan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan Mulai harus diisi.',
                    ],
                ],
                'StartPeriodYear' => [
                    'label'  => 'StartPeriodYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Mulai harus diisi.',
                    ],
                ],
                'EndPeriodBulan' => [
                    'label'  => 'EndPeriodBulan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan Berakhir harus diisi.',
                    ],
                ],
                'EndPeriodYear' => [
                    'label'  => 'EndPeriodYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Berakhir harus diisi.',
                    ],
                ],
                'Period' => [
                    'label'  => 'Period',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Sudah Berapa Lama Menjadi Anggota harus diisi.',
                    ],
                ],
                'Position' => [
                    'label'  => 'Position',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jabatan Dalam Organisasi harus diisi.',
                    ],
                ],
                'OrgLevel' => [
                    'label'  => 'OrgLevel',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tingkat Organisasi harus diisi.',
                    ],
                ],
                'OrgScp' => [
                    'label'  => 'OrgScp',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Lingkup Kegiatan Organisasi harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Uraian Aktifitas Dalam Organisasi harus diisi.',
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
                $Type = $this->request->getVar('Type');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $StartPeriodBulan = $this->request->getVar('StartPeriodBulan');
                $StartPeriodYear = $this->request->getVar('StartPeriodYear');
                $EndPeriodBulan = $this->request->getVar('EndPeriodBulan');
                $EndPeriodYear = $this->request->getVar('EndPeriodYear');
                $nilai_period = $this->request->getVar('Period');
                $nilai_position = $this->request->getVar('Position');
                $OrgLevel = $this->request->getVar('OrgLevel');
                $OrgScp = $this->request->getVar('OrgScp');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp13');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $i++;
                    if ($Type == "PII") {
                        $nilai_p = $nilai_p + 4;
                    } else {
                        switch ($nilai_period) {
                            case "sd5":
                                $nilai_p = $nilai_p + 1;
                                break;
                            case "smp10":
                                $nilai_p = $nilai_p + 2;
                                break;
                            case "smp15";
                                $nilai_p = $nilai_p + 3;
                                break;
                            case "lbih15";
                                $nilai_p = $nilai_p + 4;
                                break;
                        }
                    }
                    switch ($nilai_position) {
                        case "Bias":
                            $nilai_q = $nilai_q + 2;
                            break;
                        case "Peng":
                            $nilai_q = $nilai_q + 3;
                            break;
                        case "Pimp":
                            $nilai_q = $nilai_q + 4;
                            break;
                    }
                    switch ($OrgLevel) {
                        case "Loc":
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
                $nilai_w1 = $nilai_p * $nilai_r;

                $namaorganisasi = $slug->slugify($Name);
                $nilai_posisi = $slug->slugify($nilai_position);
                $ext = $File->getClientExtension();
                if ((empty($filename)) && (!empty($ext))) {
                    $filenamenew = $user_id . '_organisasi_' . $namaorganisasi . '_' . $nilai_posisi . '.' . $ext;
                    $File->move('uploads/docs/', $filenamenew, true);
                } elseif ((!empty($filename)) && (!empty($ext))) {
                    $oldext = substr($filename, -4);
                    if ($oldext == $ext) {
                        $File->move('uploads/docs/', $filename, true);
                        $filenamenew = $filename;
                    } else {
                        $filenamenew = $user_id . '_organisasi_' . $namaorganisasi . '_' . $nilai_posisi . '.' . $ext;
                        $File->move('uploads/docs/', $filenamenew, true);
                    }
                } else {
                    $filenamenew = $filename;
                }

                $data = array(
                    'Name' => $Name,
                    'Type' => $Type,
                    'City' => $City,
                    'Country' => $Country,
                    'Period' => $nilai_period,
                    'StartPeriodBulan' => $StartPeriodBulan,
                    'StartPeriodYear' => $StartPeriodYear,
                    'EndPeriodBulan' => $EndPeriodBulan,
                    'EndPeriodYear' => $EndPeriodYear,
                    'Position' => $nilai_position,
                    'OrgLevel' => $OrgLevel,
                    'OrgScp' => $OrgScp,
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
                $session->setFlashdata('msg', 'Data Organisasi berhasil diubah.');

                return redirect()->to('/userfair13/docs');
            } else {
                $session = session();
                $model = new CapesOrgModel();
                $org = $model->where('Num', $Num)->first();
                if ($org) {
                    $data = [
                        'Num' => $org['Num'],
                        'user_id' => $org['user_id'],
                        'Name' => $org['Name'],
                        'Type' => $org['Type'],
                        'City' => $org['City'],
                        'Country' => $org['Country'],
                        'Period' => $org['Period'],
                        'StartPeriodBulan' => $org['StartPeriodBulan'],
                        'StartPeriodYear' => $org['StartPeriodYear'],
                        'EndPeriodBulan' =>  $org['EndPeriodBulan'],
                        'EndPeriodYear' => $org['EndPeriodYear'],
                        'Position' => $org['Position'],
                        'OrgLevel' => $org['OrgLevel'],
                        'OrgScp' => $org['OrgScp'],
                        'Desc' => $org['Desc'],
                        'File' => $org['File'],
                        'datakomp' => explode(", ", $org['kompetensi'])
                    ];
                }

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.1%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "I.3. Organisasi Profesi & Organisasi Lainnya Yang Dimasuki (W1)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Organisasi</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahorguserfair', $data);
            }
        }
    }
}
