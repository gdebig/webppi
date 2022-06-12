<?php

namespace App\Controllers;

use App\Models\AkunModel;
use App\Models\CapesProfileModel;
use App\Models\CapesPendModel;
use App\Models\CapesKualifikasiModel;
use App\Models\CapesOrgModel;
use App\Models\CapesSertModel;
use App\Models\CapesKartulModel;
use App\Models\CapesSemModel;

use App\Libraries\Slug;

class Register extends BaseController
{
    //Fungsi yang pertama kali dijalankan saat membuka halaman registrasi CaPes
    public function index()
    {
        $session = session();
        $capeslogged = $session->get('capeslogged_in');
        if ($capeslogged){
            return redirect()->to('/register/dashboard');
        }
        $data['title_page'] = "Registrasi Calon Peserta PPI RPL";
        $data['data_bread'] = "";
        $data['capeslogged_in'] = $capeslogged;
        return view('register/main', $data);
    }

    //Fungsi untuk membuat akun CaPes
    public function buatakun(){
        $session = session();
        $capeslogged = $session->get('capeslogged_in');
        if ($capeslogged){
            return redirect()->to('/register/dashboard');
        }
        $data['title_page'] = "Buat Akun Calon Peserta PPI RPL";
        $data['data_bread'] = "Buat Akun";
        $data['capeslogged_in'] = $capeslogged;
        return view('register/buatakun', $data);
    }

    public function buatakunproses(){
        
        $model = new AkunModel();
        $session = session();
        $capeslogged = $session->get('capeslogged_in');
        if ($capeslogged){
            return redirect()->to('/register/dashboard');
        }

        $button = $this->request->getVar('submit');
        if ($button=="batal"){
            return redirect()->to('/register');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'username' => [
                    'label'  => 'username',
                    'rules'  => 'required|is_unique[tbl_user.username]',
                    'errors' => [
                        'required' => 'Field Username harus diisi',
                        'is_unique' => 'Username yang digunakan sudah ada.',
                    ],
                ],
                'newpass' => [
                    'label'  => 'newpass',
                    'rules'  => 'required|min_length[6]',
                    'errors' => [
                        'required' => "Field Password harus diisi",
                        'min_length' => "Panjang password minimal 6 karakter",
                    ]
                ],
                'confirmpass' => [
                    'label'  => 'confirmpass',
                    'rules'  => 'required|min_length[6]|matches[newpass]',
                    'errors' => [
                        'required' => "Field Password harus diisi",
                        'min_length' => "Panjang password minimal 6 karakter",
                        'matches' => "Konfirmasi Password tidak sama",
                    ]
                ],
                'nodaftar' => [
                    'label'  => 'nodaftar',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nomor Pendaftaran harus diisi',
                    ]
                ],
            ]);

            if ($formvalid){

                $username = $this->request->getVar('username');
                $newpass = $this->request->getVar('newpass');
                $nodaftar = $this->request->getVar('nodaftar');
                $year = date("Y");

                $datauser = array(
                    'username' => $username,
                    'password' => password_hash($newpass, PASSWORD_DEFAULT),
                    'nodaftar' => $nodaftar,
                    'status' => 'baru',
                    'thnajaran' => $year,
                    'semester' => 'Ganjil',
                    'tipe_user' => 'nnny',
                    'confirmcapes' => 'Tidak',
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($datauser);

                $session->setFlashdata('msg', 'Data user berhasil ditambahkan. Gunakan akun yang sudah didaftar untuk login di <a href="'.base_url().'/register/capes">link berikut</a>.');
    
                return redirect()->to('/register');
                
            }else{
                $data['capeslogged_in'] = $capeslogged;
                $data['data_bread'] = "Buat Akun";
                $data['title_page'] = "Buat Akun Calon Peserta PPI RPL";
                $data['validation'] = $this->validator;
                return view('register/buatakun', $data);
            }
        }
    }

    //Fungsi untuk melakukan login bagi CaPes
    public function capes(){
        $session = session();
        $capeslogged = $session->get('capeslogged_in');
        if ($capeslogged){
            return redirect()->to('/register/dashboard');
        }
        $data['capeslogged_in'] = $capeslogged;
        $data['title_page'] = "Login Calon Peserta PPI RPL";
        $data['data_bread'] = "Login Calon Peserta";
        return view('register/capes', $data);
    }
 
    //Fungsi autentikasi hasil login CaPes
    public function auth()
    {

        helper(['form']);
        $rules = [
            'username'     => 'required',
            'password'     => 'required'
        ];
        
        if($this->validate($rules)){
            $session = session();
            $model = new AkunModel();
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $data = $model->where('username', $username)->first();
            if($data){
                $pass = $data['password'];
                $verify_pass = password_verify($password, $pass);
                if($verify_pass){
                    $ses_data = [
                        'user_id'           => $data['user_id'],
                        'username'          => $data['username'],
                        'nodaftar'          => $data['nodaftar'],
                        'status'            => $data['status'],
                        'tipe_user'         => $data['tipe_user'],
                        'confirmcapes'      => $data['confirmcapes'],
                        'capeslogged_in'    => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/register/dashboard');
                }else{
                    $session->setFlashdata('msg', 'Salah password');
                    return redirect()->to('/register/capes');
                }
            }else{
                $session->setFlashdata('msg', 'Username tidak ditemukan');
                return redirect()->to('/register/capes');
            }
        }else{
            $data['validation'] = $this->validator;
            return view('register/capes', $data);
        }
    }

    //halaman dashboard CaPes
    public function dashboard(){
        $session = session();

        $capeslogged = $session->get('capeslogged_in');
        if (empty($capeslogged)){
            return redirect()->to('/register');
        }

        $user_id = $session->get('user_id');
        $profile = new CapesProfileModel();
        $dataprofile = $profile->where('user_id', $user_id)->first();
        $pengkerja = new CapesKualifikasiModel();
        $datapengkerja = $pengkerja->where('user_id', $user_id)->first();
        $organ = new CapesOrgModel();
        $dataorgan = $organ->where('user_id', $user_id)->first();
        $pelsert = new CapesSertModel();
        $datalatih = $pelsert->where('user_id', $user_id)->where('Jenis', 'pelatihan')->first();
        $datasert = $pelsert->where('user_id', $user_id)->where('Jenis', 'sertifikat')->first();
        $kartul = new CapesKartulModel();
        $datakartul = $kartul->where('user_id', $user_id)->first();
        $sem = new CapesSemModel();
        $datasem = $sem->where('user_id', $user_id)->where('Type', 'Sem')->first();

        $data['isprofile'] = !empty($dataprofile) ? "Ada" : "Tidak";
        $data['ispengkerja'] = !empty($datapengkerja) ? "Ada" : "Tidak";
        $data['isorgan'] = !empty($dataorgan) ? "Ada" : "Tidak";
        $data['islatih'] = !empty($datalatih) ? "Ada" : "Tidak";
        $data['issert'] = !empty($datasert) ? "Ada" : "Tidak";
        $data['iskartul'] = !empty($datakartul) ? "Ada" : "Tidak";
        $data['issem'] = !empty($datasem) ? "Ada" : "Tidak";

        $data['title_page'] = "Dashboard Calon Peserta PPI RPL";
        $data['data_bread'] = "dashboard";
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        return view('register/dashboard', $data);
    }
 
    //fungsi logout
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/register');
    }

    //Fungsi tentang profile CaPes
    public function profile(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        helper(['tanggal']);
        
        $user_id = $session->get('user_id');
        $model = new CapesProfileModel();
        $user = $model->where('user_id', $user_id)->first();
        if ($user){
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
        }else{
            $data['kosong'] = "kosong";
        }
        $data['capeslogged_in'] = $capeslogged_in;
        $data['title_page'] = "Profile Calon Peserta PPI RPL";
        $data['data_bread'] = "Profile";
        return view('register/profile', $data);
    }

    public function buatprofile(){
        $session = session();
        $user_id = $session->get('user_id');
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/profile');
        }
        $data['user_id'] = $user_id;
        $data['title_page'] = "Buat Profile Calon Peserta PPI RPL";
        $data['data_bread'] = "Buat Profile";
        $data['capeslogged_in'] = $capeslogged_in;
        return view('register/buatprofile', $data);
    }

    public function buatprofileproses(){
        $session = session();
        $model = new CapesProfileModel();
        $user_id = $session->get('user_id');
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/profile');
        }

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/profile');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'user_id' =>[
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
                    'rules'  => 'ext_in[sip,pdf,jpg,jpeg,png]|max_size[sip, 700]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF, JPG, JPEG atau PNG",
                        'max_size' => "Ukuran File Maksimal 700KB"
                    ],
                ]
            ]);

            if ($formvalid){
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

                $ext1 = $sip->getClientExtension();
                if (!empty($ext1)){
                    $sipname = $user_id.'_sip.'.$ext1;
                    $sip->move('uploads/docs/',$sipname,true);
                }else{
                    $sipname="";
                }

                $ext = $photo->getClientExtension();
                $photoname = $user_id.'_profilpic.'.$ext;
                $photo->move('uploads/profilpic/',$photoname,true);
    
                $dataprofile = array(
                    'user_id' => $user_id,
                    'FullName' => $fullname,
                    'BirthPlace' => $birthplace,
                    'Birthdate' => $birthdate,
                    'KTA' => $kta,
                    'SIP' => $sipname,
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

                print_r($dataprofile);
    
                $model->save($dataprofile);
    
                return redirect()->to('/register/profile');
            }else{
                $session = session();
                $data['user_id'] = $user_id;
                $data['title_page'] = "Buat Profile Calon Peserta PPI RPL";
                $data['data_bread'] = "Buat Profile";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/buatprofilevalid', $data);
            }
        }
    }

    public function ubahprofile($id){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/profile');
        }
        $model = new CapesProfileModel();
        $user = $model->where('user_id', $id)->first();
        if ($user){
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
        $data['title_page'] = "Ubah Profile Calon Peserta PPI RPL";
        $data['data_bread'] = "Ubah Profile";
        $data['capeslogged_in'] = $capeslogged_in;
        return view('register/ubahprofile', $data);
    }

    public function ubahprofileproses(){
        $session = session();
        $model = new CapesProfileModel();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/profile');
        }
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/profile');
        }else{
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

            if ($formvalid){
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
                $pindahregular = $this->request->getVar('pindahregular');

                $ext1 = $sip->getClientExtension();
                if ((empty($sipname))&&(!empty($ext1))){
                    $sipnamenew = $user_id.'_sip_'.$ext1;
                    $sip->move('uploads/docs/',$sipnamenew,true);
                } elseif ((!empty($sipname))&&(!empty($ext1))){
                    $oldext = substr($sipname, -4);
                    if ($oldext==$ext1){
                        $sip->move('uploads/docs/',$sipname,true);
                        $sipnamenew = $sipname;
                    }else{
                        $sipnamenew = $user_id.'_sip_'.$ext1;
                        $sip->move('uploads/docs/',$sipnamenew,true);
                    }
                }else{
                    $sipnamenew=$sipname;
                }

                $ext = $photo->getClientExtension();
                if ((empty($photoname))&&(!empty($ext))){
                    $photonamenew = $user_id.'_profilpic_'.$ext;
                    $photo->move('uploads/profilpic/',$photonamenew,true);
                } elseif ((!empty($photoname))&&(!empty($ext))){
                    $oldext = substr($photoname, -4);
                    if ($oldext==$ext){
                        $photo->move('uploads/profilpic/',$photoname,true);
                        $photonamenew = $photoname;
                    }else{
                        $photonamenew = $user_id.'_profilpic_'.$ext;
                        $photo->move('uploads/profilpic/',$photonamenew,true);
                    }
                }else{
                    $photonamenew=$photoname;
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
                    'pindahregular' => $pindahregular,
                    'date_modified' => date('Y-m-d')
                );

                print_r($dataprofile);
    
                $model->update($profile_id, $dataprofile);
    
                 return redirect()->to('/register/profile');
            }else{
                $user = $model->where('user_id', $user_id)->first();
                if ($user){
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
                $data['title_page'] = "Ubah Profile Calon Peserta PPI RPL";
                $data['data_bread'] = "Ubah Profile";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/ubahprofile', $data);
            }
        }
    }

    //Fungsi tentang pendidikan CaPes
    public function pendidikan(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        $model = new CapesPendModel();
        $data['capeslogged_in'] = $capeslogged_in;
        $user_id = $session->get('user_id');
        $pend = $model->where('user_id', $user_id)->findall();
        if (!empty($pend)){
            $data['data_pend'] = $pend;
        }else{
            $data['data_pend'] = 'kosong';
        }
        $data['title_page'] = "Data Pendidikan Calon Peserta PPI RPL";
        $data['data_bread'] = "Pendidikan";
        return view('register/pendidikan', $data);
    }

    public function tambahpendidikan(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pendidikan');
        }
        $data['capeslogged_in'] = $capeslogged_in;
        $user_id = $session->get('user_id');
        $data['title_page'] = "Tambah Data Pendidikan Calon Peserta PPI RPL";
        $data['data_bread'] = "Tambah Data Pendidikan";
        $data['user_id'] = $user_id;
        return view('register/tambahpendidikan', $data);
    }

    public function tambahpendproses(){
        $session = session();
        $model = new CapesPendModel();
        $user_id = $session->get('user_id');
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pendidikan');
        }

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/pendidikan');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'jenjang' => [
                    'label'  => 'jenjang',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jenjang Pendidikan harus diisi.',
                    ],
                ],
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Perguruan Tinggi harus diisi.',
                    ],
                ],
                'Faculty' => [
                    'label'  => 'Faculty',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Fakultas harus diisi.',
                    ],
                ],
                'Major' => [
                    'label'  => 'Major',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jurusan harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Perguruan Tinggi harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Perguruan Tinggi harus diisi.',
                    ],
                ],
                'GradYear' => [
                    'label'  => 'GradYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Kelulusan harus diisi.',
                    ],
                ],
                'Degree' => [
                    'label'  => 'Degree',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Gelar harus diisi.',
                    ],
                ],
                'Title' => [
                    'label'  => 'Title',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Tugas Akhir harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Uraian Singkat Tugas Akhir harus diisi.',
                    ],
                ],
                'Mark' => [
                    'label'  => 'Mark',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nilai Akademik Rata-rata harus diisi.',
                    ],
                ],
                'Judicium' => [
                    'label'  => 'Judicium',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Yudisium harus diisi.',
                    ],
                ],
                'ijazah' => [
                    'rules'  => 'uploaded[ijazah]|ext_in[ijazah,jpg,jpeg,png,pdf]|max_size[ijazah, 700]',
                    'errors' => [
                        'uploaded' => 'Field Unggah Scan Ijazah tidak boleh kosong',
                        'ext_in' => "Hanya menerima file PDF, JPG, JPEG atau PNG",
                        'max_size' => "Ukuran File Maksimal 700KB"
                    ],
                ]
            ]);

            if ($formvalid){
                $jenjang = $this->request->getVar('jenjang');
                $Name = $this->request->getVar('Name');
                $Faculty = $this->request->getVar('Faculty');
                $Major = $this->request->getVar('Major');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $GradYear = $this->request->getVar('GradYear');
                $Degree = $this->request->getVar('Degree');
                $Title = $this->request->getVar('Title');
                $Desc = $this->request->getVar('Desc');
                $Mark = $this->request->getVar('Mark');
                $Judicium = $this->request->getVar('Judicium');
                $ijazah = $this->request->getFile('ijazah');

                $ext = $ijazah->getClientExtension();
                $filename = $user_id.'_ijazah_'.$jenjang.'.'.$ext;
                $ijazah->move('uploads/docs/',$filename,true);
    
                $data = array(
                    'user_id' => $user_id,
                    'Rank' => $jenjang,
                    'Name' => $Name,
                    'Faculty' => $Faculty,
                    'Major' => $Major,
                    'City' => $City,
                    'Country' => $Country,
                    'GradYear' => $GradYear,
                    'Degree' => $Degree,
                    'Title' => $Title,
                    'Desc' => $Desc,
                    'Mark' => $Mark,
                    'Judicium' => $Judicium,
                    'File' => $filename,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
    
                $model->save($data);
                $session->setFlashdata('msg', 'Data Pendidikan berhasil ditambah.');
    
                return redirect()->to('/register/pendidikan');
            }else{
                $session = session();
                $data['title_page'] = "Tambah Data Pendidikan Calon Peserta PPI RPL";
                $data['data_bread'] = "Tambah Data Pendidikan";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/tambahpendvalid', $data);
            }
        }        
    }

    public function hapuspendidikan($id){
        $session = session();
        $model = new CapesPendModel();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pendidikan');
        }

        $ijazah = $model->find($id);
        $path = './uploads/docs/'.$ijazah['File'];
        if (is_file($path)){
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data pendidikan berhasil dihapus.');

        return redirect()->to('/register/pendidikan');        
    }

    public function ubahpendidikan($id){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pendidikan');
        }
        $model = new CapesPendModel();
        $pend = $model->where('Num', $id)->first();
        if ($pend){
            $data = [
                'Num' => $pend['Num'],
                'user_id' => $pend['user_id'],
                'Rank' => $pend['Rank'],
                'Name' => $pend['Name'],
                'Faculty' => $pend['Faculty'],
                'Major' => $pend['Major'],
                'City' => $pend['City'],
                'Country' => $pend['Country'],
                'GradYear' => $pend['GradYear'],
                'Degree' => $pend['Degree'],
                'Title' => $pend['Title'],
                'Desc' => $pend['Desc'],
                'Mark' => $pend['Mark'],
                'Judicium' => $pend['Judicium'],
                'File' => $pend['File']
            ];
        }
        $data['title_page'] = "Ubah Data Pendidikan Calon Peserta PPI RPL";
        $data['data_bread'] = "Ubah Data Pendidikan";
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        return view('register/ubahpendidikan', $data);
    }

    public function ubahpendproses(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pendidikan');
        }
        $model = new CapesPendModel();
        $pend_id = $this->request->getVar('pend_id');
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/pendidikan');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'jenjang' => [
                    'label'  => 'jenjang',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jenjang Pendidikan harus diisi.',
                    ],
                ],
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Perguruan Tinggi harus diisi.',
                    ],
                ],
                'Faculty' => [
                    'label'  => 'Faculty',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Fakultas harus diisi.',
                    ],
                ],
                'Major' => [
                    'label'  => 'Major',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jurusan harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Perguruan Tinggi harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Perguruan Tinggi harus diisi.',
                    ],
                ],
                'GradYear' => [
                    'label'  => 'GradYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Kelulusan harus diisi.',
                    ],
                ],
                'Degree' => [
                    'label'  => 'Degree',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Gelar harus diisi.',
                    ],
                ],
                'Title' => [
                    'label'  => 'Title',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Tugas Akhir harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Uraian Singkat Tugas Akhir harus diisi.',
                    ],
                ],
                'Mark' => [
                    'label'  => 'Mark',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nilai Akademik Rata-rata harus diisi.',
                    ],
                ],
                'Judicium' => [
                    'label'  => 'Judicium',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Yudisium harus diisi.',
                    ],
                ],
                'ijazah' => [
                    'rules'  => 'ext_in[ijazah,jpg,jpeg,png,pdf]|max_size[ijazah, 700]',
                    'errors' => [
                        'uploaded' => 'Field Unggah Scan Ijazah tidak boleh kosong',
                        'ext_in' => "Hanya menerima file PDF, JPG, JPEG atau PNG",
                        'max_size' => "Ukuran File Maksimal 700KB"
                    ],
                ]
            ]);

            if ($formvalid){
                $filename = $this->request->getVar('filename');
                $jenjang = $this->request->getVar('jenjang');
                $Name = $this->request->getVar('Name');
                $Faculty = $this->request->getVar('Faculty');
                $Major = $this->request->getVar('Major');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $GradYear = $this->request->getVar('GradYear');
                $Degree = $this->request->getVar('Degree');
                $Title = $this->request->getVar('Title');
                $Desc = $this->request->getVar('Desc');
                $Mark = $this->request->getVar('Mark');
                $Judicium = $this->request->getVar('Judicium');
                $ijazah = $this->request->getFile('ijazah');

                $ext = $File->getClientExtension();
                if ((empty($filename))&&(!empty($ext))){
                    $filenamenew = $user_id.'_ijazah_'.$jenjang.'.'.$ext;
                    $ijazah->move('uploads/docs/',$filenamenew,true);
                } elseif ((!empty($filename))&&(!empty($ext))){
                    $oldext = substr($filename, -4);
                    if ($oldext == $ext){
                        $ijazah->move('uploads/docs/',$filename,true);
                        $filenamenew = $filename;
                    }else{
                        $filenamenew = $user_id.'_ijazah_'.$jenjang.'.'.$ext;
                        $ijazah->move('uploads/docs/',$filenamenew,true);
                    }
                }else{
                    $filenamenew=$filename;
                }
    
                $data = array(
                    'Rank' => $jenjang,
                    'Name' => $Name,
                    'Faculty' => $Faculty,
                    'Major' => $Major,
                    'City' => $City,
                    'Country' => $Country,
                    'GradYear' => $GradYear,
                    'Degree' => $Degree,
                    'Title' => $Title,
                    'Desc' => $Desc,
                    'Mark' => $Mark,
                    'Judicium' => $Judicium,
                    'File' => $filenamenew,
                    'date_modified' => date('Y-m-d')
                );
    
                $model->update($pend_id, $data);
                $session->setFlashdata('msg', 'Data Pendidikan berhasil diubah.');
    
                return redirect()->to('/register/pendidikan');
            }else{
                $session = session();
                $model = new CapesPendModel();
                $pend = $model->where('Num', $pend_id)->first();
                if ($pend){
                    $data = [
                        'Num' => $pend['Num'],
                        'user_id' => $pend['user_id'],
                        'Rank' => $pend['Rank'],
                        'Name' => $pend['Name'],
                        'Faculty' => $pend['Faculty'],
                        'Major' => $pend['Major'],
                        'City' => $pend['City'],
                        'Country' => $pend['Country'],
                        'GradYear' => $pend['GradYear'],
                        'Degree' => $pend['Degree'],
                        'Title' => $pend['Title'],
                        'Desc' => $pend['Desc'],
                        'Mark' => $pend['Mark'],
                        'Judicium' => $pend['Judicium'],
                        'File' => $pend['File']
                    ];
                }
                $data['title_page'] = "Ubah Data Pendidikan Calon Peserta PPI RPL";
                $data['data_bread'] = "Ubah Data Pendidikan";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/ubahpendidikan', $data);
            }
        }        
    }

    public function pengkerja(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        helper(['tanggal']);
        $model = new CapesKualifikasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $user_id = $session->get('user_id');
        $kerja = $model->where('user_id', $user_id)->findall();
        if (!empty($kerja)){
            $data['data_kerja'] = $kerja;
        }else{
            $data['data_kerja'] = 'kosong';
        }
        $data['title_page'] = "Data Pengalaman Kerja Calon Peserta PPI RPL";
        $data['data_bread'] = "Pengalaman Kerja";
        return view('register/pengkerja', $data);
    }

    public function tambahkerja(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pengkerja');
        }
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $user_id = $session->get('user_id');
        $data['title_page'] = "Tambah Data Pengalaman Kerja Calon Peserta PPI RPL";
        $data['data_bread'] = "Tambah Data Pengalaman Kerja";
        return view('register/tambahkerja', $data);
    }

    public function tambahkerjaproses(){
        $slug = new Slug();
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pengkerja');
        }
        $model = new CapesKualifikasiModel();
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/pengkerja');
        }else{
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

            if ($formvalid){
                $startdate = $this->request->getVar('startdate');
                $masihkerja = $this->request->getVar('masihkerja');
                if ((isset($masihkerja))&&$masihkerja=="masihkerja"){
                    $enddate="";
                }else{
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
                
                $ext = $File->getClientExtension();
                if (!empty($ext)){
                    $namainstansi = $slug->slugify($NameInstance);
                    $posisi = $slug->slugify($Position);
                    $filename = $user_id.'_pengkerja_'.$namainstansi.'_'.$posisi.'.'.$ext;
                    echo $filename;
                    $File->move('uploads/docs/',$filename,true);
                }else{
                    $filename="";
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
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
    
                $model->save($data);
                $session->setFlashdata('msg', 'Data Pengalaman Kerja berhasil ditambah.');
    
                return redirect()->to('/register/pengkerja');
            }else{
                $session = session();
                $data['title_page'] = "Tambah Data Pengalaman Kerja Calon Peserta PPI RPL";
                $data['data_bread'] = "Tambah Data Pengalaman Kerja";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/tambahkerjavalid', $data);
            }
        }
    }

    public function hapuspengkerja($id){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pengkerja');
        }
        $model = new CapesKualifikasiModel();

        $pengkerja = $model->find($id);
        $path = './uploads/docs/'.$pengkerja['File'];
        if (is_file($path)){
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data Pengalaman kerja berhasil dihapus.');

        return redirect()->to('/register/pengkerja');   
    }

    public function ubahpengkerja($id){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pengkerja');
        }
        $model = new CapesKualifikasiModel();
        $kerja = $model->where('Num', $id)->first();
        if ($kerja){
            if ($kerja['EndDate']=="0000-00-00"){
                $masihkerja = "checked";
                $enddate = "";
            }else{
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
                'File' => $kerja['File']
            ];
        }
        $data['title_page'] = "Ubah Data Pengalaman Kerja Calon Peserta PPI RPL";
        $data['data_bread'] = "Ubah Data Pengalaman Kerja";
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        return view('register/ubahpengkerja', $data);
    }

    public function ubahpengkerjaproses(){
        $session = session();
        $slug = new Slug();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pengkerja');
        }
        $model = new CapesKualifikasiModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/pengkerja');
        }else{
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

            if ($formvalid){
                $filename = $this->request->getVar('filename');
                $startdate = $this->request->getVar('startdate');
                $masihkerja = $this->request->getVar('masihkerja');
                if ((isset($masihkerja))&&$masihkerja=="masihkerja"){
                    $enddate="";
                }else{
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

                $namainstansi = $slug->slugify($NameInstance);
                $posisi = $slug->slugify($Position);
                $ext = $File->getClientExtension();
                if ((empty($filename))&&(!empty($ext))){
                    $filenamenew = $user_id.'_pengkerja_'.$namainstansi.'_'.$posisi.'.'.$ext;
                    $File->move('uploads/docs/',$filenamenew,true);
                } elseif ((!empty($filename))&&(!empty($ext))){
                    $oldext = substr($filename,-4);
                    if ($oldext == $ext){
                        $File->move('uploads/docs/',$filename,true);
                        $filenamenew = $filename;
                    }else{
                        $filenamenew = $user_id.'_pengkerja_'.$namainstansi.'_'.$posisi.'.'.$ext;
                        $File->move('uploads/docs/',$filenamenew,true);
                    }
                }else{
                    $filenamenew=$filename;
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
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data Pengalaman Kerja berhasil diubah.');
    
                return redirect()->to('/register/pengkerja');
            }else{
                $session = session();
                $model = new CapesKualifikasiModel();
                $kerja = $model->where('Num', $Num)->first();
                if ($kerja){
                    if ($kerja['EndDate']=="0000-00-00"){
                        $masihkerja = "checked";
                        $enddate = "";
                    }else{
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
                        'File' => $kerja['File']
                    ];
                }
                $data['title_page'] = "Ubah Data Pengalaman Kerja Calon Peserta PPI RPL";
                $data['data_bread'] = "Ubah Data Pengalaman Kerja";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/ubahpengkerja', $data);
            }
        }        
    }

    //Fungsi untuk link organisasi
    public function organisasi(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        $model = new CapesOrgModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $user_id = $session->get('user_id');
        $org = $model->where('user_id', $user_id)->findall();
        if (!empty($org)){
            $data['data_org'] = $org;
        }else{
            $data['data_org'] = 'kosong';
        }
        $data['title_page'] = "Data Organisasi Calon Peserta PPI RPL";
        $data['data_bread'] = "Organisasi";
        return view('register/organisasi', $data);
    }

    public function tambahorganisasi(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/organisasi');
        }
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $user_id = $session->get('user_id');
        $data['title_page'] = "Tambah Data Organisasi Calon Peserta PPI RPL";
        $data['data_bread'] = "Tambah Data Organisasi";
        return view('register/tambahorganisasi', $data);
    }

    public function tambahorgproses(){
        $session = session();
        $slug = new Slug();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/organisasi');
        }
        $model = new CapesOrgModel();
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/organisasi');
        }else{
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

            if ($formvalid){
                $Name = $this->request->getVar('Name');
                $Type = $this->request->getVar('Type');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $StartPeriodBulan = $this->request->getVar('StartPeriodBulan');
                $StartPeriodYear = $this->request->getVar('StartPeriodYear');
                $EndPeriodBulan = $this->request->getVar('EndPeriodBulan');
                $EndPeriodYear = $this->request->getVar('EndPeriodYear');
                $Period = $this->request->getVar('Period');
                $Position = $this->request->getVar('Position');
                $OrgLevel = $this->request->getVar('OrgLevel');
                $OrgScp = $this->request->getVar('OrgScp');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                
                $namaorganisasi = $slug->slugify($Name);
                $posisi = $slug->slugify($Position);
                $ext = $File->getClientExtension();
                if (!empty($ext)){
                    $filename = $user_id.'_organisasi_'.$namaorganisasi.'_'.$posisi.'.'.$ext;
                    $File->move('uploads/docs/',$filename,true);
                }else{
                    $filename="";
                }
    
                $data = array(
                    'user_id' => $user_id,
                    'Name' => $Name,
                    'Type' => $Type,
                    'City' => $City,
                    'Country' => $Country,
                    'Period' => $Period,
                    'StartPeriodBulan' => $StartPeriodBulan,
                    'StartPeriodYear' => $StartPeriodYear,
                    'EndPeriodBulan' => $EndPeriodBulan,
                    'EndPeriodYear' => $EndPeriodYear,
                    'Position' => $Position,
                    'OrgLevel' => $OrgLevel,
                    'OrgScp' => $OrgScp,
                    'Desc' => $Desc,
                    'File' => $filename,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
    
                $model->save($data);
                $session->setFlashdata('msg', 'Data Organisasi berhasil ditambah.');
    
                return redirect()->to('/register/organisasi');
            }else{
                $session = session();
                $data['title_page'] = "Tambah Data Organisasi Calon Peserta PPI RPL";
                $data['data_bread'] = "Tambah Data Organisasi";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/tambahorgvalid', $data);
            }
        }
    }

    public function hapusorg($id){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/organisasi');
        }
        $model = new CapesOrgModel();

        $org = $model->find($id);
        $path = './uploads/docs/'.$org['File'];
        if (is_file($path)){
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data Organisasi berhasil dihapus.');

        return redirect()->to('/register/organisasi');   
    }

    public function ubahorg($id){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/organisasi');
        }
        $model = new CapesOrgModel();
        $org = $model->where('Num', $id)->first();
        if ($org){
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
                'File' => $org['File']
            ];
        }
        $data['title_page'] = "Ubah Data Organisasi Calon Peserta PPI RPL";
        $data['data_bread'] = "Ubah Data Organisasi";
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        return view('register/ubahorg', $data);
    }

    public function ubahorgproses(){
        $session = session();
        $slug = new Slug();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/organisasi');
        }
        $model = new CapesOrgModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/organisasi');
        }else{
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

            if ($formvalid){
                $filename = $this->request->getVar('File');
                $Name = $this->request->getVar('Name');
                $Type = $this->request->getVar('Type');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $StartPeriodBulan = $this->request->getVar('StartPeriodBulan');
                $StartPeriodYear = $this->request->getVar('StartPeriodYear');
                $EndPeriodBulan = $this->request->getVar('EndPeriodBulan');
                $EndPeriodYear = $this->request->getVar('EndPeriodYear');
                $Period = $this->request->getVar('Period');
                $Position = $this->request->getVar('Position');
                $OrgLevel = $this->request->getVar('OrgLevel');
                $OrgScp = $this->request->getVar('OrgScp');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');

                $namaorganisasi = $slug->slugify($Name);
                $posisi = $slug->slugify($Position);
                $ext = $File->getClientExtension();
                if ((empty($filename))&&(!empty($ext))){
                    $filenamenew = $user_id.'_organisasi_'.$namaorganisasi.'_'.$posisi.'.'.$ext;
                    $File->move('uploads/docs/',$filenamenew,true);
                } elseif ((!empty($filename))&&(!empty($ext))){
                    $oldext = substr($filename,-4);
                    if ($oldext == $ext){
                        $File->move('uploads/docs/',$filename,true);
                        $filenamenew = $filename;
                    }else{
                        $filenamenew = $user_id.'_organisasi_'.$namaorganisasi.'_'.$posisi.'.'.$ext;
                        $File->move('uploads/docs/',$filenamenew,true);
                    }
                }else{
                    $filenamenew=$filename;
                }
    
                $data = array(
                    'Name' => $Name,
                    'Type' => $Type,
                    'City' => $City,
                    'Country' => $Country,
                    'Period' => $Period,
                    'StartPeriodBulan' => $StartPeriodBulan,
                    'StartPeriodYear' => $StartPeriodYear,
                    'EndPeriodBulan' => $EndPeriodBulan,
                    'EndPeriodYear' => $EndPeriodYear,
                    'Position' => $Position,
                    'OrgLevel' => $OrgLevel,
                    'OrgScp' => $OrgScp,
                    'Desc' => $Desc,
                    'File' => $filenamenew,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data Organisasi berhasil diubah.');
    
                return redirect()->to('/register/organisasi');
            }else{
                $session = session();
                $model = new CapesOrgModel();
                $org = $model->where('Num', $Num)->first();
                if ($org){
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
                        'Desc' => $kerja['Desc'],
                        'File' => $kerja['File']
                    ];
                }
                $data['title_page'] = "Ubah Data Organisasi Calon Peserta PPI RPL";
                $data['data_bread'] = "Ubah Data Organisasi Kerja";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/ubahorg', $data);
            }
        }        
    }
    
    //Fungsi untuk halaman pelatihan
    public function pelatihan(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        $model = new CapesSertModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $user_id = $session->get('user_id');
        $latih = $model->where('user_id', $user_id)->where('Jenis', 'pelatihan')->findall();
        if (!empty($latih)){
            $data['data_latih'] = $latih;
        }else{
            $data['data_latih'] = 'kosong';
        }
        $data['title_page'] = "Data Pelatihan Teknik Calon Peserta PPI RPL";
        $data['data_bread'] = "Pelatihan";
        return view('register/pelatihan', $data);
    }

    public function tambahlatih(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pelatihan');
        }
        $model = new CapesSertmodel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $user_id = $session->get('user_id');
        $data['title_page'] = "Tambah Data Pelatihan Teknik Calon Peserta PPI RPL";
        $data['data_bread'] = "Tambah Data Pelatihan Teknik";
        return view('register/tambahlatih', $data);
    }

    public function tambahlatihproses(){
        $session = session();
        $slug = new Slug();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pelatihan');
        }
        $model = new CapesSertModel();
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/pelatihan');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Pendidikan/Pelatihan harus diisi.',
                    ],
                ],
                'Organizer' => [
                    'label'  => 'Organizer',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Penyelenggara harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Lokasi Pelatihan harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Lokasi Pelatihan harus diisi.',
                    ],
                ],
                'StartMonth' => [
                    'label'  => 'StartMonth',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan harus diisi.',
                    ],
                ],
                'StartYear' => [
                    'label'  => 'StartYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun harus diisi.',
                    ],
                ],
                'Level' => [
                    'label'  => 'Level',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tingkat Materi harus diisi.',
                    ],
                ],
                'Length' => [
                    'label'  => 'Length',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jumlah Jam harus diisi.',
                    ],
                ],
                'Description' => [
                    'label'  => 'Description',
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

            if ($formvalid){
                $Name = $this->request->getVar('Name');
                $Organizer = $this->request->getVar('Organizer');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $StartMonth = $this->request->getVar('StartMonth');
                $StartYear = $this->request->getVar('StartYear');
                $Level = $this->request->getVar('Level');
                $Length = $this->request->getVar('Length');
                $Description = $this->request->getVar('Description');
                $File = $this->request->getFile('File');
                
                $namalatih = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if (!empty($ext)){
                    $filename = $user_id.'_pelatihan_'.$namalatih.'.'.$ext;
                    $File->move('uploads/docs/',$filename,true);
                }else{
                    $filename="";
                }
    
                $data = array(
                    'user_id' => $user_id,
                    'Jenis' => 'pelatihan',
                    'Name' => $Name,
                    'Organizer' => $Organizer,
                    'Kota' => $City,
                    'Country' => $Country,
                    'StartMonth' => $StartMonth,
                    'StartYear' => $StartYear,
                    'Level' => $Level,
                    'Length' => $Length,
                    'Description' => $Description,
                    'File' => $filename,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
    
                $model->save($data);
                $session->setFlashdata('msg', 'Data Pendidikan/Pelatihan berhasil ditambah.');
    
                return redirect()->to('/register/pelatihan');
            }else{
                $session = session();
                $data['title_page'] = "Tambah Data Pendidikan/Pelatihan Calon Peserta PPI RPL";
                $data['data_bread'] = "Tambah Data Pendidikan/Pelatihan";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/tambahlatihvalid', $data);
            }
        }
    }

    public function hapuslatih($id){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pelatihan');
        }
        $model = new CapesSertModel();

        $latih = $model->find($id);
        $path = './uploads/docs/'.$latih['File'];
        if (is_file($path)){
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data Pendidikan/Pelatihan berhasil dihapus.');

        return redirect()->to('/register/pelatihan');   
    }

    public function ubahlatih($id){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pelatihan');
        }
        $model = new CapesSertModel();
        $latih = $model->where('Num', $id)->first();
        if ($latih){
            $data = [
                'Num' => $latih['Num'],
                'user_id' => $latih['user_id'],
                'Name' => $latih['Name'],
                'Organizer' => $latih['Organizer'],
                'Kota' => $latih['Kota'],
                'Country' => $latih['Country'],
                'StartYear' => $latih['StartYear'],
                'StartMonth' => $latih['StartMonth'],
                'Level' => $latih['Level'],
                'Length' =>  $latih['Length'],
                'Description' => $latih['Description'],
                'File' => $latih['File']
            ];
        }
        $data['title_page'] = "Ubah Data Pendidikan/Pelatihan Calon Peserta PPI RPL";
        $data['data_bread'] = "Ubah Data Pendidikan/Pelatihan";
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        return view('register/ubahlatih', $data);
    }

    public function ubahlatihproses(){
        $session = session();
        $slug = new Slug();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/pelatihan');
        }
        $model = new CapesSertModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/pelatihan');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Pendidikan/Pelatihan harus diisi.',
                    ],
                ],
                'Organizer' => [
                    'label'  => 'Organizer',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Penyelenggara harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Lokasi Pelatihan harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Lokasi Pelatihan harus diisi.',
                    ],
                ],
                'StartMonth' => [
                    'label'  => 'StartMonth',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan harus diisi.',
                    ],
                ],
                'StartYear' => [
                    'label'  => 'StartYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun harus diisi.',
                    ],
                ],
                'Level' => [
                    'label'  => 'Level',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tingkat Materi harus diisi.',
                    ],
                ],
                'Length' => [
                    'label'  => 'Length',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jumlah Jam harus diisi.',
                    ],
                ],
                'Description' => [
                    'label'  => 'Description',
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

            if ($formvalid){
                $filename = $this->request->getVar('File');
                $Name = $this->request->getVar('Name');
                $Organizer = $this->request->getVar('Organizer');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $StartMonth = $this->request->getVar('StartMonth');
                $StartYear = $this->request->getVar('StartYear');
                $Level = $this->request->getVar('Level');
                $Length = $this->request->getVar('Length');
                $Description = $this->request->getVar('Description');
                $File = $this->request->getFile('File');

                $namalatih = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if ((empty($filename))&&(!empty($ext))){
                    $filenamenew = $user_id.'_pelatihan_'.$namalatih.'.'.$ext;
                    $File->move('uploads/docs/',$filenamenew,true);
                } elseif ((!empty($filename))&&(!empty($ext))){
                    $oldext = substr($filename,-4);
                    if ($oldext == $ext){
                        $File->move('uploads/docs/',$filename,true);
                        $filenamenew = $filename;
                    }else{
                        $filenamenew = $user_id.'_pelatihan_'.$namalatih.'.'.$ext;
                        $File->move('uploads/docs/',$filenamenew,true);
                    }
                }else{
                    $filenamenew=$filename;
                }
    
                $data = array(
                    'Name' => $Name,
                    'Jenis' => 'pelatihan',
                    'Name' => $Name,
                    'Organizer' => $Organizer,
                    'Kota' => $City,
                    'Country' => $Country,
                    'StartMonth' => $StartMonth,
                    'StartYear' => $StartYear,
                    'Level' => $Level,
                    'Length' => $Length,
                    'Description' => $Description,
                    'File' => $filename,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data Pendidikan/Pelatihan berhasil diubah.');
    
                return redirect()->to('/register/pelatihan');
            }else{
                $latih = $model->where('Num', $Num)->first();
                if ($latih){
                    $data = [
                        'Num' => $latih['Num'],
                        'user_id' => $latih['user_id'],
                        'Name' => $latih['Name'],
                        'Organizer' => $latih['Organizer'],
                        'Kota' => $latih['Kota'],
                        'Country' => $latih['Country'],
                        'StartYear' => $latih['StartYear'],
                        'StartMonth' => $latih['StartMonth'],
                        'Level' => $latih['Level'],
                        'Length' =>  $latih['Length'],
                        'Description' => $latih['Description'],
                        'File' => $latih['File']
                    ];
                }
                $data['title_page'] = "Ubah Data Pendidikan/Pelatihan Calon Peserta PPI RPL";
                $data['data_bread'] = "Ubah Data Pendidikan/Pelatihan Kerja";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/ubahlatih', $data);
            }
        }        
    }
    
    //Fungsi untuk halaman Sertifikat
    public function sertifikat(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        $model = new CapesSertModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $user_id = $session->get('user_id');
        $latih = $model->where('user_id', $user_id)->where('Jenis', 'sertifikat')->findall();
        if (!empty($latih)){
            $data['data_latih'] = $latih;
        }else{
            $data['data_latih'] = 'kosong';
        }
        $data['title_page'] = "Data Sertifikat Kompotenesi Calon Peserta PPI RPL";
        $data['data_bread'] = "Sertifikat";
        return view('register/sertifikat', $data);
    }

    public function tambahsert(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/sertifikat');
        }
        $model = new CapesSertmodel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $user_id = $session->get('user_id');
        $data['title_page'] = "Tambah Data Sertifikat Kompetensi Calon Peserta PPI RPL";
        $data['data_bread'] = "Tambah Data Sertifikat Kompetensi";
        return view('register/tambahsert', $data);
    }

    public function tambahsertproses(){
        $session = session();
        $slug = new Slug();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/sertifikat');
        }
        $model = new CapesSertModel();
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/sertifikat');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Sertifikat harus diisi.',
                    ],
                ],
                'Organizer' => [
                    'label'  => 'Organizer',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Penyelenggara harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Lokasi Sertifikat harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Lokasi Sertifikat harus diisi.',
                    ],
                ],
                'StartMonth' => [
                    'label'  => 'StartMonth',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan harus diisi.',
                    ],
                ],
                'StartYear' => [
                    'label'  => 'StartYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun harus diisi.',
                    ],
                ],
                'Level' => [
                    'label'  => 'Level',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tingkat Materi harus diisi.',
                    ],
                ],
                'Length' => [
                    'label'  => 'Length',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jumlah Jam harus diisi.',
                    ],
                ],
                'Description' => [
                    'label'  => 'Description',
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

            if ($formvalid){
                $Name = $this->request->getVar('Name');
                $Organizer = $this->request->getVar('Organizer');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $StartMonth = $this->request->getVar('StartMonth');
                $StartYear = $this->request->getVar('StartYear');
                $Level = $this->request->getVar('Level');
                $Length = $this->request->getVar('Length');
                $Description = $this->request->getVar('Description');
                $File = $this->request->getFile('File');
                
                $namasert = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if (!empty($ext)){
                    $filename = $user_id.'_sertifikat_'.$namasert.'.'.$ext;
                    $File->move('uploads/docs/',$filename,true);
                }else{
                    $filename="";
                }
    
                $data = array(
                    'user_id' => $user_id,
                    'Jenis' => 'sertifikat',
                    'Name' => $Name,
                    'Organizer' => $Organizer,
                    'Kota' => $City,
                    'Country' => $Country,
                    'StartMonth' => $StartMonth,
                    'StartYear' => $StartYear,
                    'Level' => $Level,
                    'Length' => $Length,
                    'Description' => $Description,
                    'File' => $filename,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
    
                $model->save($data);
                $session->setFlashdata('msg', 'Data Sertifikat Kompetensi berhasil ditambah.');
    
                return redirect()->to('/register/sertifikat');
            }else{
                $session = session();
                $data['title_page'] = "Tambah Data Sertifikat Kompetensi Calon Peserta PPI RPL";
                $data['data_bread'] = "Tambah Data Sertifikat Kompetensi";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/tambahsertvalid', $data);
            }
        }
    }

    public function hapussert($id){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/sertifikat');
        }
        $model = new CapesSertModel();

        $latih = $model->find($id);
        $path = './uploads/docs/'.$latih['File'];
        if (is_file($path)){
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data Sertifikat Kompetensi berhasil dihapus.');

        return redirect()->to('/register/sertifikat');   
    }

    public function ubahsert($id){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/sertifikat');
        }
        $model = new CapesSertModel();
        $latih = $model->where('Num', $id)->first();
        if ($latih){
            $data = [
                'Num' => $latih['Num'],
                'user_id' => $latih['user_id'],
                'Name' => $latih['Name'],
                'Organizer' => $latih['Organizer'],
                'Kota' => $latih['Kota'],
                'Country' => $latih['Country'],
                'StartYear' => $latih['StartYear'],
                'StartMonth' => $latih['StartMonth'],
                'Level' => $latih['Level'],
                'Length' =>  $latih['Length'],
                'Description' => $latih['Description'],
                'File' => $latih['File']
            ];
        }
        $data['title_page'] = "Ubah Data Sertifikat Kompetensi Calon Peserta PPI RPL";
        $data['data_bread'] = "Ubah Data Sertifikat Kompetensi";
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        return view('register/ubahsert', $data);
    }

    public function ubahsertproses(){
        $session = session();
        $slug = new Slug();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/sertifikat');
        }
        $model = new CapesSertModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/sertifikat');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Sertifikat Kompetensi harus diisi.',
                    ],
                ],
                'Organizer' => [
                    'label'  => 'Organizer',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Penyelenggara harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Lokasi Sertifikat harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Lokasi Sertifikat harus diisi.',
                    ],
                ],
                'StartMonth' => [
                    'label'  => 'StartMonth',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan harus diisi.',
                    ],
                ],
                'StartYear' => [
                    'label'  => 'StartYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun harus diisi.',
                    ],
                ],
                'Level' => [
                    'label'  => 'Level',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tingkat Materi harus diisi.',
                    ],
                ],
                'Length' => [
                    'label'  => 'Length',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jumlah Jam harus diisi.',
                    ],
                ],
                'Description' => [
                    'label'  => 'Description',
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

            if ($formvalid){
                $filename = $this->request->getVar('File');
                $Name = $this->request->getVar('Name');
                $Organizer = $this->request->getVar('Organizer');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $StartMonth = $this->request->getVar('StartMonth');
                $StartYear = $this->request->getVar('StartYear');
                $Level = $this->request->getVar('Level');
                $Length = $this->request->getVar('Length');
                $Description = $this->request->getVar('Description');
                $File = $this->request->getFile('File');

                $namasert = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if ((empty($filename))&&(!empty($ext))){
                    $filenamenew = $user_id.'_sertifikat_'.$namasert.'.'.$ext;
                    $File->move('uploads/docs/',$filenamenew,true);
                } elseif ((!empty($filename))&&(!empty($ext))){
                    $oldext = substr($filename,-4);
                    if ($oldext == $ext){
                        $File->move('uploads/docs/',$filename,true);
                        $filenamenew = $filename;
                    }else{
                        $filenamenew = $user_id.'_sertifikat_'.$namasert.'.'.$ext;
                        $File->move('uploads/docs/',$filenamenew,true);
                    }
                }else{
                    $filenamenew=$filename;
                }
    
                $data = array(
                    'Name' => $Name,
                    'Jenis' => 'sertifikat',
                    'Name' => $Name,
                    'Organizer' => $Organizer,
                    'Kota' => $City,
                    'Country' => $Country,
                    'StartMonth' => $StartMonth,
                    'StartYear' => $StartYear,
                    'Level' => $Level,
                    'Length' => $Length,
                    'Description' => $Description,
                    'File' => $filename,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data Sertifikat Kompetensi berhasil diubah.');
    
                return redirect()->to('/register/sertifikat');
            }else{
                $latih = $model->where('Num', $Num)->first();
                if ($latih){
                    $data = [
                        'Num' => $latih['Num'],
                        'user_id' => $latih['user_id'],
                        'Name' => $latih['Name'],
                        'Organizer' => $latih['Organizer'],
                        'Kota' => $latih['Kota'],
                        'Country' => $latih['Country'],
                        'StartYear' => $latih['StartYear'],
                        'StartMonth' => $latih['StartMonth'],
                        'Level' => $latih['Level'],
                        'Length' =>  $latih['Length'],
                        'Description' => $latih['Description'],
                        'File' => $latih['File']
                    ];
                }
                $data['title_page'] = "Ubah Data Sertifikat Kompetensi Calon Peserta PPI RPL";
                $data['data_bread'] = "Ubah Data Sertifikat Kompetensi";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/ubahsert', $data);
            }
        }        
    }

    //Fungsi untuk halaman Karya Tulis
    public function kartul(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        $model = new CapesKartulModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $user_id = $session->get('user_id');
        $kartul = $model->where('user_id', $user_id)->findall();
        if (!empty($kartul)){
            $data['data_kartul'] = $kartul;
        }else{
            $data['data_kartul'] = 'kosong';
        }
        $data['title_page'] = "Data Karya Tulis di Bidang Keinsinyuran Calon Peserta PPI RPL";
        $data['data_bread'] = "Karya Tulis";
        return view('register/kartul', $data);
    }

    public function tambahkartul(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/kartul');
        }
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $user_id = $session->get('user_id');
        $data['title_page'] = "Tambah Data Karya Tulis Calon Peserta PPI RPL";
        $data['data_bread'] = "Tambah Data Karya Tulis";
        return view('register/tambahkartul', $data);
    }

    public function tambahkartulproses(){
        $session = session();
        $slug = new Slug();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/kartul');
        }
        $model = new CapesKartulModel();
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/kartul');
        }else{
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

            if ($formvalid){
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
                
                $mediakartul = $slug->slugify($Media);
                $ext = $File->getClientExtension();
                if (!empty($ext)){
                    $random = bin2hex(random_bytes(4));
                    $filename = $user_id.'_karyatulis_'.$mediakartul.'_'.$random.'.'.$ext;
                    $File->move('uploads/docs/',$filename,true);
                }else{
                    $filename="";
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
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
    
                $model->save($data);
                $session->setFlashdata('msg', 'Data Karya Tulis berhasil ditambah.');
    
                return redirect()->to('/register/kartul');
            }else{
                $session = session();
                $data['title_page'] = "Tambah Data Karya Tulis Calon Peserta PPI RPL";
                $data['data_bread'] = "Tambah Data Karya Tulis";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/tambahkartulvalid', $data);
            }
        }
    }

    public function hapuskartul($id){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/kartul');
        }
        $model = new CapesKartulModel();

        $kartul = $model->find($id);
        $path = './uploads/docs/'.$kartul['File'];
        if (is_file($path)){
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data Karya Tulis berhasil dihapus.');

        return redirect()->to('/register/kartul');   
    }

    public function ubahkartul($id){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/kartul');
        }
        $model = new CapesKartulModel();
        $kartul = $model->where('Num', $id)->first();
        if ($kartul){
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
                'File' => $kartul['File']
            ];
        }
        $data['title_page'] = "Ubah Data Karya Tulis Calon Peserta PPI RPL";
        $data['data_bread'] = "Ubah Data Karya Tulis";
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        return view('register/ubahkartul', $data);
    }

    public function ubahkartulproses(){
        $session = session();
        $slug = new Slug();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/kartul');
        }
        $model = new CapesKartulModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/kartul');
        }else{
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

            if ($formvalid){
                $filename = $this->request->getVar('File');
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

                $mediakartul = $slug->slugify($Media);
                $ext = $File->getClientExtension();
                if ((empty($filename))&&(!empty($ext))){
                    $random = bin2hex(random_bytes(4));
                    $filenamenew = $user_id.'_karyatulis_'.$mediakartul.'_'.$random.'.'.$ext;
                    $File->move('uploads/docs/',$filenamenew,true);
                } elseif ((!empty($filename))&&(!empty($ext))){
                    $oldext = substr($filename,-4);
                    if ($oldext == $ext){
                        $File->move('uploads/docs/',$filename,true);
                        $filenamenew = $filename;
                    }else{
                        $random = bin2hex(random_bytes(4));
                        $filenamenew = $user_id.'_karyatulis_'.str_replace(' ','',$Media).'_'.$random.'.'.$ext;
                        $File->move('uploads/docs/',$filenamenew,true);
                    }
                }else{
                    $filenamenew=$filename;
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
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data Karya Tulis berhasil diubah.');
    
                return redirect()->to('/register/kartul');
            }else{
                $kartul = $model->where('Num', $Num)->first();
                if ($kartul){
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
                        'File' => $kartul['File']
                    ];
                }
                $data['title_page'] = "Ubah Data Karya Tulis Calon Peserta PPI RPL";
                $data['data_bread'] = "Ubah Data Karya Tulis";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/ubahkartul', $data);
            }
        }        
    }

    //Fungsi untuk link Seminar
    public function seminar(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        $model = new CapesSemModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $user_id = $session->get('user_id');
        $sem = $model->where('user_id', $user_id)->where('Type', 'Sem')->findall();
        if (!empty($sem)){
            $data['data_sem'] = $sem;
        }else{
            $data['data_sem'] = 'kosong';
        }
        $data['title_page'] = "Data Seminar/Lokakarya Calon Peserta PPI RPL";
        $data['data_bread'] = "Seminar";
        return view('register/seminar', $data);
    }

    public function tambahseminar(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/seminar');
        }
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $user_id = $session->get('user_id');
        $data['title_page'] = "Tambah Data Seminar/Lokakarya Calon Peserta PPI RPL";
        $data['data_bread'] = "Tambah Data Seminar";
        return view('register/tambahseminar', $data);
    }

    public function tambahsemproses(){
        $session = session();
        $slug = new Slug();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/seminar');
        }
        $model = new CapesSemModel();
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/seminar');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'PaperName' => [
                    'label'  => 'PaperName',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Makalah/Tulisan harus diisi.',
                    ],
                ],
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

            if ($formvalid){
                $PaperName = $this->request->getVar('PaperName');
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
                
                $namaseminar = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if (!empty($ext)){
                    $random = bin2hex(random_bytes(4));
                    $filename = $user_id.'_seminar_'.$namaseminar.'_'.$random.'.'.$ext;
                    $File->move('uploads/docs/',$filename,true);
                }else{
                    $filename="";
                }
    
                $data = array(
                    'user_id' => $user_id,
                    'Type' => 'Sem',
                    'PaperName' => $PaperName,
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
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
    
                $model->save($data);
                $session->setFlashdata('msg', 'Data Seminar berhasil ditambah.');
    
                return redirect()->to('/register/seminar');
            }else{
                $session = session();
                $data['title_page'] = "Tambah Data Seminar/Lokakarya Calon Peserta PPI RPL";
                $data['data_bread'] = "Tambah Data Seminar";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/tambahsemvalid', $data);
            }
        }
    }

    public function hapussem($id){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/seminar');
        }
        $model = new CapesSemModel();

        $sem = $model->find($id);
        $path = './uploads/docs/'.$sem['File'];
        if (is_file($path)){
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data Seminar berhasil dihapus.');

        return redirect()->to('/register/seminar');   
    }

    public function ubahsem($id){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/seminar');
        }
        $model = new CapesSemModel();
        $sem = $model->where('Num', $id)->first();
        if ($sem){
            $data = [
                'Num' => $sem['Num'],
                'user_id' => $sem['user_id'],
                'PaperName' => $sem['PaperName'],
                'Name' => $sem['Name'],
                'Organizer' => $sem['Organizer'],
                'LocCity' => $sem['LocCity'],
                'LocCountry' => $sem['LocCountry'],
                'Year' => $sem['Year'],
                'Month' => $sem['Month'],
                'Level' => $sem['Level'],
                'DiffBenefit' => $sem['DiffBenefit'],
                'Desc' => $sem['Desc'],
                'File' => $sem['File']
            ];
        }
        $data['title_page'] = "Ubah Data Seminar Calon Peserta PPI RPL";
        $data['data_bread'] = "Ubah Data Seminar";
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        return view('register/ubahsem', $data);
    }

    public function ubahsemproses(){
        $session = session();
        $slug = new Slug();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        if ($confirmcapes=="Ya"){
            $session->setFlashdata('msg', 'Pengiriman data sudah dikonfirmasi. Data tidak lagi dapat diubah.');
            return redirect()->to('/register/seminar');
        }
        $model = new CapesSemModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/register/seminar');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'PaperName' => [
                    'label'  => 'PaperName',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Makalah/Tulisan harus diisi.',
                    ],
                ],
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

            if ($formvalid){
                $filename = $this->request->getVar('File');
                $PaperName = $this->request->getVar('PaperName');
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

                $namaseminar = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if ((empty($filename))&&(!empty($ext))){
                    $random = bin2hex(random_bytes(4));
                    $filenamenew = $user_id.'_seminar_'.$namaseminar.'_'.$random.'.'.$ext;
                    $File->move('uploads/docs/',$filenamenew,true);
                } elseif ((!empty($filename))&&(!empty($ext))){
                    $oldext = substr($filename,-4);
                    if ($oldext == $ext){
                        $File->move('uploads/docs/',$filename,true);
                        $filenamenew = $filename;
                    }else{
                        $random = bin2hex(random_bytes(4));
                        $filenamenew = $user_id.'_seminar_'.$namaseminar.'_'.$random.'.'.$ext;
                        $File->move('uploads/docs/',$filenamenew,true);
                    }
                }else{
                    $filenamenew=$filename;
                }
    
                $data = array(
                    'Type' => 'Sem',
                    'PaperName' => $PaperName,
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
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data Seminar berhasil diubah.');
    
                return redirect()->to('/register/seminar');
            }else{
                $sem = $model->where('Num', $Num)->first();
                if ($sem){
                    $data = [
                        'Num' => $sem['Num'],
                        'user_id' => $sem['user_id'],
                        'PaperName' => $sem['PaperName'],
                        'Name' => $sem['Name'],
                        'Organizer' => $sem['Organizer'],
                        'LocCity' => $sem['LocCity'],
                        'LocCountry' => $sem['LocCountry'],
                        'Year' => $sem['Year'],
                        'Month' => $sem['Month'],
                        'Level' => $sem['Level'],
                        'DiffBenefit' => $sem['DiffBenefit'],
                        'Desc' => $sem['Desc'],
                        'File' => $sem['File']
                    ];
                }
                $data['title_page'] = "Ubah Data Seminar Calon Peserta PPI RPL";
                $data['data_bread'] = "Ubah Data Seminar";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/ubahsem', $data);
            }
        }        
    }

    //Mengatur link konfirmasi
    public function konfirmasi(){
        $session = session();
        $capeslogged_in = $session->get('capeslogged_in');
        $confirmcapes = $session->get('confirmcapes');
        if (!$capeslogged_in){
            return redirect()->to('/register');
        }
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $data['title_page'] = "Konfirmasi Unggah Data Calon Peserta PPI RPL";
        $data['data_bread'] = "Konfirmasi";
        return view('register/konfirmasi', $data);
    }

    public function konfirmproses(){
        $session = session();
        $model = new AkunModel();
        $button = $this->request->getVar('submit');
        $user_id = $session->get('user_id');
        if ($button == "batal"){
            return redirect()->to('/register');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'terms2' => [
                    'label'  => 'terms2',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Anda belum memberi centang pada opsi konfirmasi.',
                    ],
                ]
            ]);

            if ($formvalid){
                $terms2 = $this->request->getVar('terms2');
    
                $data = array(
                    'confirmcapes' => $terms2,
                    'date_modified' => date('Y-m-d')
                );
                $model->update($user_id, $data);
                $session->set('confirmcapes', 'Ya');
                $session->setFlashdata('msg', 'Data Sudah Disimpan Untuk Dinilai dan Tidak Bisa Lagi Dirubah.');
    
                return redirect()->to('/register');
            }else{
                $data['title_page'] = "Konfirmasi Unggah Data Calon Peserta PPI RPL";
                $data['data_bread'] = "Konfirmasi";
                $data['capeslogged_in'] = $session->get('capeslogged_in');
                $data['validation'] = $this->validator;
                return view('register/konfirmasi', $data);
            }
        }
    }

    public function petunjuk(){
        $session = session();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $data['title_page'] = "Petunjuk Penggunaan Aplikasi";
        $data['data_bread'] = "Petunjuk";
        return view('register/petunjuk', $data);
    }
}