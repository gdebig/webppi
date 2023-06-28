<?php

namespace App\Controllers;

use App\Models\ProfileModel;
use App\Models\AkunModel;
use App\Models\UserModel;
use App\Models\ConfigModel;

class Myprofile extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        if (!$logged_in) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $user_id = $session->get('user_id');
        $role = $session->get('role');
        $model = new ProfileModel();
        $user = $model->where('tbl_profile.user_id', $user_id)->join('tbl_user', 'tbl_profile.user_id = tbl_user.user_id', 'left')->first();
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
                'pindahregular' => $user['pindahregular'],
                'NIP' => $user['NIP'],
                'NPM' => $user['NPM'],
                'signed' => $user['signed']
            ];
        } else {
            $data['kosong'] = "kosong";
        }

        //Peserta Reguler
        $tipepeserta = $session->get('tipepeserta');
        if ($tipepeserta == "Reguler") {
            $data['menureg'] = 'menureg';
        }

        //Koordinator TA Reguler
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['role'] = $role;
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Profile Saya";
        $data['data_bread'] = "Profile Saya";
        return view('maintemp/profile', $data);
    }

    public function buatprofile()
    {
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $role = $session->get('role');
        if (!$logged_in) {
            return redirect()->to('/home');
        }

        //Peserta Reguler
        $tipepeserta = $session->get('tipepeserta');
        if ($tipepeserta == "Reguler") {
            $data['menureg'] = 'menureg';
        }

        //Koordinator TA Reguler
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['user_id'] = $user_id;
        $data['role'] = $role;
        $data['title_page'] = "Buat Profile Saya";
        $data['data_bread'] = "Buat Profile Saya";
        $data['logged_in'] = $logged_in;
        return view('maintemp/buatprofile', $data);
    }

    public function buatprofileproses()
    {
        $session = session();
        $model = new ProfileModel();
        $model1 = new UserModel();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $role = $session->get('role');
        if (!$logged_in) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/myprofile');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'user_id' => [
                    'rules' => 'is_unique[tbl_profile.user_id]',
                    'errors' => [
                        'is_unique' => 'User sudah memiliki profile. Silahkan kembali ke Beranda.',
                    ],
                ],
                'fullname' => [
                    'label'  => 'fullname',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Lengkap harus diisi.',
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
                    'rules'  => 'uploaded[photo]|ext_in[photo,jpg,jpeg,png]|max_size[photo, 700]',
                    'errors' => [
                        'uploaded' => 'Field Foto tidak boleh kosong',
                        'ext_in' => "Hanya menerima file JPG, JPEG atau PNG",
                        'max_size' => "Ukuran File Maksimal 700KB"
                    ],
                ],
                'sip' => [
                    'rules'  => 'ext_in[photo,jpg,jpeg,png]|max_size[photo, 700]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file JPG, JPEG atau PNG",
                        'max_size' => "Ukuran File Maksimal 700KB"
                    ],
                ]
            ]);

            if ($formvalid) {
                $user_id = $this->request->getVar('user_id');
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
                $pindahregular = $this->request->getVar('pindahregular');

                $ext = $photo->getClientExtension();
                $photoname = $user_id . '_profilpic.' . $ext;
                $photo->move('uploads/profilpic/', $photoname, true);

                $ext1 = $sip->getClientExtension();
                if (!empty($ext1)) {
                    $sipname = $user_id . '_sip.' . $ext1;
                    $sip->move('uploads/docs/', $sipname, true);
                } else {
                    $sipname = '';
                }

                $dataprofile = array(
                    'user_id' => $user_id,
                    'FullName' => $fullname,
                    'BirthPlace' => $birthplace,
                    'Birthdate' => $birthdate,
                    'KTA' => $kta,
                    'SIP' => $sip,
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
                    'Photo' => $photoname,
                    'pindahregular' => $pindahregular,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );

                $model->save($dataprofile);

                if ($role == 'peserta') {
                    $NPM = $this->request->getVar('NPM');
                    $datauser = array(
                        'NPM' => $NPM,
                        'date_modified' => date('Y-m-d')
                    );
                } else {
                    $NIP = $this->request->getVar('NIP');
                    $filettd = $this->request->getFile('filettd');

                    if (@is_array(getimagesize($filettd))) {
                        $ext2 = $filettd->getClientExtension();
                        if (!empty($ext2)) {
                            $ttdname = $user_id . '_ttd.' . $ext2;
                            $filettd->move('uploads/ttd/', $ttdname, true);
                        } else {
                            $ttdname = '';
                        }
                    } else {
                        $ttdname = '';
                    }

                    $datauser = array(
                        'NIP' => $NIP,
                        'signed' => $ttdname,
                        'date_modified' => date('Y-m-d')
                    );
                }

                $model1->update($user_id, $datauser);

                return redirect()->to('/myprofile');
            } else {
                $session = session();
                $data['user_id'] = $user_id;
                $data['title_page'] = "Buat Profile Saya";
                $data['data_bread'] = "Buat Profile Saya";
                $data['logged_in'] = $session->get('logged_in');
                $data['role'] = $session->get('role');
                $data['validation'] = $this->validator;
                return view('maintemp/buatprofilevalid', $data);
            }
        }
    }

    public function ubah($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        if (!$logged_in) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $model = new ProfileModel();
        $user = $model->where('tbl_profile.user_id', $id)->join('tbl_user', 'tbl_profile.user_id = tbl_user.user_id', 'left')->first();
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
                'pindahregular' => $user['pindahregular'],
                'NIP' => $user['NIP'],
                'NPM' => $user['NPM'],
                'signed' => $user['signed']
            ];
        }

        //Peserta Reguler
        $tipepeserta = $session->get('tipepeserta');
        if ($tipepeserta == "Reguler") {
            $data['menureg'] = 'menureg';
        }

        //Koordinator TA Reguler
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['role'] = $session->get('role');
        $data['title_page'] = "Ubah Profile Peserta PPI RPL";
        $data['data_bread'] = "Ubah Profile";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahprofile', $data);
    }

    public function ubahproses()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        if (!$logged_in) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $user_id = $session->get('user_id');
        $role = $session->get('role');

        $model = new ProfileModel();
        $model1 = new UserModel();

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/myprofile');
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
                        'ext_in' => "Field Photo Hanya menerima file JPG, JPEG atau PNG",
                        'max_size' => "Ukuran File Maksimal 700KB"
                    ],
                ],
                'sip' => [
                    'rules'  => 'ext_in[sip,pdf,jpg,jpeg,png]|max_size[sip, 700]',
                    'errors' => [
                        'ext_in' => "Field SIP Hanya menerima file PDF, JPG, JPEG atau PNG",
                        'max_size' => "Ukuran File Maksimal 700KB"
                    ],
                ],
                'filettd' => [
                    'rules'  => 'ext_in[filettd,jpg,jpeg,png]|max_size[sip, 700]',
                    'errors' => [
                        'ext_in' => "Field TTD Digital Hanya menerima file JPG, JPEG atau PNG",
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

                $model->update($profile_id, $dataprofile);

                if ($role == 'peserta') {
                    $NPM = $this->request->getVar('NPM');
                    echo $NPM;
                    $datauser = array(
                        'NPM' => $NPM,
                        'date_modified' => date('Y-m-d')
                    );
                } else {
                    $NIP = $this->request->getVar('NIP');
                    $oldsigned = $this->request->getVar('oldsigned');
                    $filettd = $this->request->getFile('filettd');

                    if (@is_array(getimagesize($filettd))) {
                        $ext2 = $filettd->getClientExtension();
                        if (!empty($ext2)) {
                            $path = base_url() . '/uploads/ttd/' . $oldsigned;
                            if (is_file($path)) {
                                unlink($path);
                            }
                            $ttdname = $user_id . '_ttd.' . $ext2;
                            $filettd->move('uploads/ttd/', $ttdname, true);
                        } else {
                            $ttdname = $oldsigned;
                        }
                    } else {
                        $ttdname = $oldsigned;
                    }

                    $datauser = array(
                        'NIP' => $NIP,
                        'signed' => $ttdname,
                        'date_modified' => date('Y-m-d')
                    );
                }

                $model1->update($user_id, $datauser);

                return redirect()->to('/myprofile');
            } else {
                $user = $model->where('tbl_profile.user_id', $user_id)->join('tbl_user', 'tbl_profile.user_id = tbl_user.user_id')->first();
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
                        'NIP' => $user['NIP'],
                        'NPM' => $user['NPM'],
                        'signed' => $user['signed']
                    ];
                }
                $data['role'] = $session->get('role');
                $data['title_page'] = "Ubah Profile Peserta PPI RPL";
                $data['data_bread'] = "Ubah Profile";
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahprofile', $data);
            }
        }
    }

    public function ubahpass()
    {
        $session = session();
        $id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        if (!$logged_in) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $model = new ProfileModel();
        $user = $model->where('user_id', $id)->first();
        if ($user) {
            $data = [
                'ID' => $user['ID'],
                'user_id' => $user['user_id'],
                'FullName' => $user['FullName']
            ];
        }
        $model1 = new AkunModel();
        $user1 = $model1->where('user_id', $id)->first();
        if ($user1) {
            $data = [
                'username' => $user1['username']
            ];
        }

        //Peserta Reguler
        $tipepeserta = $session->get('tipepeserta');
        if ($tipepeserta == "Reguler") {
            $data['menureg'] = 'menureg';
        }

        //Koordinator TA Reguler
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['title_page'] = "Ubah Password";
        $data['data_bread'] = "Ubah Password";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahpass', $data);
    }

    public function ubahpassproses()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        if (!$logged_in) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/');
        } else {
            helper(['form']);
            $rules = [
                'oldpass'     => 'required',
                'newpass'     => 'required|min_length[6]',
                'confirmpass' => 'required|min_length[6]|matches[newpass]'
            ];

            if ($this->validate($rules)) {
                $session = session();
                $model = new AkunModel();
                $user_id = $session->get('user_id');
                $oldpass = $this->request->getVar('oldpass');
                $data = $model->where('user_id', $user_id)->first();
                if ($data) {
                    $pass = $data['password'];
                    $verify_pass = password_verify($oldpass, $pass);
                    if ($verify_pass) {
                        $newpass = $this->request->getVar('newpass');
                        $datauser = array(
                            'password' => password_hash($newpass, PASSWORD_DEFAULT),
                            'date_modified' => date('Y-m-d H:i:s')
                        );
                        $model->update($user_id, $datauser);
                        $session->setFlashdata('msg1', 'Password berhasil diubah.');
                        return redirect()->to('/myprofile/ubahpass');
                    } else {
                        $session->setFlashdata('msg', 'Password lama salah');
                        return redirect()->to('/myprofile/ubahpass');
                    }
                } else {
                    $session->setFlashdata('msg', 'Username tidak ditemukan');
                    return redirect()->to('/myprofile/ubahpass');
                }
            } else {
                $model = new ProfileModel();
                $user = $model->where('user_id', $user_id)->first();
                if ($user) {
                    $data = [
                        'ID' => $user['ID'],
                        'user_id' => $user['user_id'],
                        'FullName' => $user['FullName']
                    ];
                }
                $model1 = new AkunModel();
                $user1 = $model1->where('user_id', $user_id)->first();
                if ($user1) {
                    $data = [
                        'username' => $user1['username']
                    ];
                }
                $data['logged_in'] = $session->get('logged_in');
                $data['title_page'] = "Ubah Password";
                $data['data_bread'] = "Ubah Password";
                $data['validation'] = $this->validator;
                return view('maintemp/ubahpass', $data);
            }
        }
    }
}
