<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Models\ConfigModel;

class Bimbingfair11 extends BaseController
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

        $user_id1 = $session->get('user_id');

        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id1)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $model = new ProfileModel();
        $user = $model->where('user_id', $user_id)->first();
        if ($user) {
            $data = [
                'ID' => $user['ID'],
                'user_id' => $user['user_id'],
                'FullName' => $user['FullName'],
                'BirthPlace' => $user['BirthPlace'],
                'BirthDate' => $user['Birthdate'],
                'KTA' => $user['KTA'],
                'SIP' => $user['SIP'],
                'Vocational' => $user['Vocational'],
                'HAddr' => $user['HAddr'],
                'HCity' => $user['HCity'],
                'HPostnum' => $user['HPostnum'],
                'Work' => $user['Work'],
                'Position' => $user['Position'],
                'WAddr' => $user['WAddr'],
                'WCity' => $user['WCity'],
                'Wpostnum' => $user['Wpostnum'],
                'Hnum' => $user['Hnum'],
                'Hfaks' => $user['Hfaks'],
                'Htelex' => $user['Htelex'],
                'Hemail' => $user['Hemail'],
                'Hpnum' => $user['Hpnum'],
                'Wnum' => $user['Wnum'],
                'Wfaks' => $user['Wfaks'],
                'Wtelex' => $user['Wtelex'],
                'Wemail1' => $user['Wemail1'],
                'Wemail2' => $user['Wemail2'],
                'Photo' => $user['Photo'],
                'pindahregular' => $user['pindahregular']
            ];
        } else {
            $data['kosong'] = "kosong";
        }

        $data['title_page'] = "I.1. Data Pribadi";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/bimbingfair/docs/" . $id . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Data Pribadi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/bimbingdok11', $data);
    }


    public function ubahprofilefair()
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

        $model = new ProfileModel();
        $user = $model->where('user_id', $user_id)->first();
        if ($user) {
            $data = [
                'ID' => $user['ID'],
                'user_id' => $user['user_id'],
                'FullName' => $user['FullName'],
                'BirthPlace' => $user['BirthPlace'],
                'BirthDate' => $user['Birthdate'],
                'KTA' => $user['KTA'],
                'SIP' => $user['SIP'],
                'Vocational' => $user['Vocational'],
                'HAddr' => $user['HAddr'],
                'HCity' => $user['HCity'],
                'HPostnum' => $user['HPostnum'],
                'Work' => $user['Work'],
                'Position' => $user['Position'],
                'WAddr' => $user['WAddr'],
                'WCity' => $user['WCity'],
                'Wpostnum' => $user['Wpostnum'],
                'Hnum' => $user['Hnum'],
                'Hfaks' => $user['Hfaks'],
                'Htelex' => $user['Htelex'],
                'Hemail' => $user['Hemail'],
                'Hpnum' => $user['Hpnum'],
                'Wnum' => $user['Wnum'],
                'Wfaks' => $user['Wfaks'],
                'Wtelex' => $user['Wtelex'],
                'Wemail1' => $user['Wemail1'],
                'Wemail2' => $user['Wemail2'],
                'Photo' => $user['Photo'],
                'pindahregular' => $user['pindahregular']
            ];
        }
        $data['title_page'] = "I.1. Data Pribadi";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Data Pribadi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahprofilefair', $data);
    }

    public function ubahprofilefairproses()
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

        $model = new ProfileModel();

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair11/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'fullname' => [
                    'label'  => 'fullname',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Depan harus diisi.',
                    ],
                ],
                'birthplace' => [
                    'label'  => 'birthplace',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tempat Lahir harus diisi.',
                    ],
                ],
                'birthdate' => [
                    'label'  => 'birthdate',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tanggal Lahir harus diisi.',
                    ],
                ],
                'vocational' => [
                    'label'  => 'vocational',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Badan Kejuruan harus diisi.',
                    ],
                ],
                'haddress' => [
                    'label'  => 'haddress',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Alamat Rumah harus diisi.',
                    ],
                ],
                'hcity' => [
                    'label'  => 'hcity',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Alamat Rumah harus diisi.',
                    ],
                ],
                'hpostnum' => [
                    'label'  => 'hpostnum',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kode Pos Alamat Rumah harus diisi.',
                    ],
                ],
                'hpnum' => [
                    'label'  => 'hpnum',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nomor Mobile harus diisi.',
                    ],
                ],
                'hemail' => [
                    'label'  => 'hemail',
                    'rules'  => 'valid_email',
                    'errors' => [
                        'valid_email' => 'Field Email Rumah harus diisi dengan format email yang benar.',
                    ],
                ],
                'work' => [
                    'label'  => 'work',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tempat Kerja harus diisi.',
                    ],
                ],
                'position' => [
                    'label'  => 'position',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Posisi/Jabatan harus diisi.',
                    ],
                ],
                'waddr' => [
                    'label'  => 'waddr',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Alamat Kantor harus diisi.',
                    ],
                ],
                'wcity' => [
                    'label'  => 'wcity',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Alamat Kantor harus diisi.',
                    ],
                ],
                'wpostnum' => [
                    'label'  => 'wpostnum',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kode Post Alamat Kantor harus diisi.',
                    ],
                ],
                'wnum' => [
                    'label'  => 'wnum',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Telepon Kantor harus diisi.',
                    ],
                ],
                'wemail1' => [
                    'label'  => 'wemail1',
                    'rules'  => 'required|valid_email',
                    'errors' => [
                        'required' => 'Field Email Kantor 1 harus diisi.',
                        'valid_email' => 'Field Email Kantor 1 harus diisi dengan format email yang benar.'
                    ],
                ],
                'photo' => [
                    'rules'  => 'ext_in[photo,jpg,jpeg,png]|max_size[photo, 700]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file JPG, JPEG atau PNG",
                        'max_size' => "Ukuran File Maksimal 700KB"
                    ],
                ],
                'sip' => [
                    'rules'  => 'ext_in[sip,pdf,jpg,jpeg,png]|max_size[sip, 700]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF, JPG, JPEG atau PNG",
                        'max_size' => "Ukuran File Maksimal 700KB"
                    ],
                ]
            ]);

            if ($formvalid) {
                $profile_id = $this->request->getVar('profile_id');
                $photoname = $this->request->getVar('photoname');
                $sipname = $this->request->getVar('sipname');
                $fullname = $this->request->getVar('fullname');
                $birthplace = $this->request->getVar('birthplace');
                $birthdate = $this->request->getVar('birthdate');
                $kta = $this->request->getVar('kta');
                $vocational = $this->request->getVar('vocational');
                $haddress = $this->request->getVar('haddress');
                $hcity = $this->request->getVar('hcity');
                $hpostnum = $this->request->getVar('hpostnum');
                $hnum = $this->request->getVar('hnum');
                $hpnum = $this->request->getVar('hpnum');
                $hfaks = $this->request->getVar('hfaks');
                $htelex = $this->request->getVar('htelex');
                $hemail = $this->request->getVar('hemail');
                $work = $this->request->getVar('work');
                $position = $this->request->getVar('position');
                $waddr = $this->request->getVar('waddr');
                $wcity = $this->request->getVar('wcity');
                $wpostnum = $this->request->getVar('wpostnum');
                $wnum = $this->request->getVar('wnum');
                $wfaks = $this->request->getVar('wfaks');
                $wtelex = $this->request->getVar('wtelex');
                $wemail1 = $this->request->getVar('wemail1');
                $wemail2 = $this->request->getVar('wemail2');
                $sip = $this->request->getFile('sip');
                $photo = $this->request->getFile('photo');

                $ext1 = $sip->getClientExtension();
                if ((empty($sipname)) && (!empty($ext1))) {
                    $sipnamenew = $user_id . '_sip_' . $ext1;
                    $sip->move('uploads/docs/', $sipnamenew, true);
                } elseif ((!empty($sipname)) && (!empty($ext1))) {
                    $oldext = substr($sipname, -4);
                    if ($oldext == $ext1) {
                        $sip->move('uploads/docs/', $sipname, true);
                        $sipnamenew = $sipname;
                    } else {
                        $sipnamenew = $user_id . '_sip_' . $ext1;
                        $sip->move('uploads/docs/', $sipnamenew, true);
                    }
                } else {
                    $sipnamenew = $sipname;
                }

                $ext = $photo->getClientExtension();
                if ((empty($photoname)) && (!empty($ext))) {
                    $photonamenew = $user_id . '_profilpic_' . $ext;
                    $photo->move('uploads/profilpic/', $photonamenew, true);
                } elseif ((!empty($photoname)) && (!empty($ext))) {
                    $oldext = substr($photoname, -4);
                    if ($oldext == $ext) {
                        $photo->move('uploads/profilpic/', $photoname, true);
                        $photonamenew = $photoname;
                    } else {
                        $photonamenew = $user_id . '_profilpic_' . $ext;
                        $photo->move('uploads/profilpic/', $photonamenew, true);
                    }
                } else {
                    $photonamenew = $photoname;
                }

                $dataprofile = array(
                    'FullName' => $fullname,
                    'BirthPlace' => $birthplace,
                    'Birthdate' => $birthdate,
                    'KTA' => $kta,
                    'SIP' => $sipnamenew,
                    'Vocational' => $vocational,
                    'HAddr' => $haddress,
                    'HCity' => $hcity,
                    'HPostnum' => $hpostnum,
                    'Work' => $work,
                    'Position' => $position,
                    'WAddr' => $waddr,
                    'WCity' => $wcity,
                    'Wpostnum' => $wpostnum,
                    'Hnum' => $hnum,
                    'Hfaks' => $hfaks,
                    'Htelex' => $htelex,
                    'Hemail' => $hemail,
                    'Hpnum' => $hpnum,
                    'Wnum' => $wnum,
                    'Wfaks' => $wfaks,
                    'Wtelex' => $wtelex,
                    'Wemail1' => $wemail1,
                    'Wemail2' => $wemail2,
                    'Photo' => $photonamenew,
                    'date_modified' => date('Y-m-d')
                );

                print_r($dataprofile);

                $model->update($profile_id, $dataprofile);

                return redirect()->to('/userfair11/docs');
            } else {
                $user = $model->where('user_id', $user_id)->first();
                if ($user) {
                    $data = [
                        'ID' => $user['ID'],
                        'user_id' => $user['user_id'],
                        'FullName' => $user['FullName'],
                        'BirthPlace' => $user['BirthPlace'],
                        'BirthDate' => $user['Birthdate'],
                        'KTA' => $user['KTA'],
                        'SIP' => $user['SIP'],
                        'Vocational' => $user['Vocational'],
                        'HAddr' => $user['HAddr'],
                        'HCity' => $user['HCity'],
                        'HPostnum' => $user['HPostnum'],
                        'Work' => $user['Work'],
                        'Position' => $user['Position'],
                        'WAddr' => $user['WAddr'],
                        'WCity' => $user['WCity'],
                        'Wpostnum' => $user['Wpostnum'],
                        'Hnum' => $user['Hnum'],
                        'Hfaks' => $user['Hfaks'],
                        'Htelex' => $user['Htelex'],
                        'Hemail' => $user['Hemail'],
                        'Hpnum' => $user['Hpnum'],
                        'Wnum' => $user['Wnum'],
                        'Wfaks' => $user['Wfaks'],
                        'Wtelex' => $user['Wtelex'],
                        'Wemail1' => $user['Wemail1'],
                        'Wemail2' => $user['Wemail2'],
                        'Photo' => $user['Photo']
                    ];
                }
                $data['title_page'] = "I.1. Data Pribadi";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Data Pribadi</li>';
                $data['logged_in'] = $session->get('logged_in');
                return view('maintemp/ubahprofilefair', $data);
            }
        }
    }
}
