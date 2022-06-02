<?php

namespace App\Controllers;

use App\Models\UserModel;

class Manuser extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in)&&($issadmin)){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        
        $user_id = $session->get('user_id');
        $model = new UserModel();
        $data['logged_in'] = $logged_in;
        $user = $model->findall();
        if (!empty($user)){
            $data['data_user'] = $user;
        }else{
            $data['data_user'] = 'kosong';
        }
        $data['title_page'] = "Data Anggota PPI RPL";
        $data['data_bread'] = "Anggota";
        return view('maintemp/anggota', $data);
    }

    public function tambahanggota(){
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in)&&(!$issadmin)){
            return redirect()->to('/home');
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Tambah Data Anggota";
        $data['data_bread'] = "Tambah Data Anggota";
        $data['user_id'] = $user_id;
        return view('maintemp/tambahanggota', $data);
    }

    public function tambahanggotaproses(){
        
        $model = new UserModel();
        $session = session();
        $issadmin = $session->get('issadmin');
        $logged_in = $session->get('logged_in');
        if ((!$logged_in)&&(!$issadmin)){
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');
        if ($button=="batal"){
            return redirect()->to('/manuser');
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
                'pass1' => [
                    'label'  => 'pass1',
                    'rules'  => 'required|min_length[6]',
                    'errors' => [
                        'required' => "Field Password harus diisi",
                        'min_length' => "Panjang password minimal 6 karakter",
                    ]
                ],
                'confpass' => [
                    'label'  => 'confpass',
                    'rules'  => 'required|min_length[6]|matches[pass1]',
                    'errors' => [
                        'required' => "Field Password harus diisi",
                        'min_length' => "Panjang password minimal 6 karakter",
                        'matches' => "Konfirmasi Password tidak sama",
                    ]
                ],
                'thnajaran' => [
                    'label'  => 'thnajaran',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Tahun Ajaran harus diisi",
                    ]
                ],
            ]);

            if ($formvalid){

                $username = $this->request->getVar('username');
                $pass1 = $this->request->getVar('pass1');
                $aktif = $this->request->getVar('aktif');                
                $nodaftar = $this->request->getVar('nodaftar');
                $npm = $this->request->getVar('npm');
                $nip = $this->request->getVar('nip');
                $status = $this->request->getVar('status');
                $thnajaran = $this->request->getVar('thnajaran');
                $semester = $this->request->getVar('semester');
                $superadmin = $this->request->getVar('superadmin') == "yes" ? "y" : "n";
                $admin = $this->request->getVar('admin') == "yes" ? "y" : "n";
                $penilai = $this->request->getVar('penilai') == "yes" ? "y" : "n";
                $peserta = $this->request->getVar('peserta') == "yes" ? "y" : "n";
                $tipe_user = $superadmin.$admin.$penilai.$peserta;

                $datauser = array(
                    'username' => $username,
                    'password' => password_hash($pass1, PASSWORD_DEFAULT),
                    'nodaftar' => $nodaftar,
                    'NPM' => $npm,
                    'NIP' => $nip,
                    'status' => $status,
                    'thnajaran' => $thnajaran,
                    'semester' => 'Ganjil',
                    'tipe_user' => $tipe_user,
                    'confirmcapes' => 'Ya',
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($datauser);

                $session->setFlashdata('msg', 'Data user berhasil ditambahkan.');
    
                return redirect()->to('/manuser');
                
            }else{
                $user_id = $session->get('user_id');
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Tambah Data Anggota";
                $data['data_bread'] = "Tambah Data Anggota";
                $data['validation'] = $this->validator;
                $data['user_id'] = $user_id;
                return view('maintemp/tambahanggota', $data);
            }
        }
    }
}