<?php

namespace App\Controllers;

use App\Models\AkunModel;

class Penilai extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&(!$ispenilai)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'penilai');
        }
        $data['title_page'] = "Dashboard PPI RPL";
        $data['data_bread'] = "dashboard";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/dashboard', $data);
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
                $tipe_user = $data['tipe_user'];
                if($verify_pass){
                    $issadmin = $tipe_user[0]=='y' ? TRUE : FALSE;
                    $isadmin = $tipe_user[1]=='y' ? TRUE : FALSE;
                    $ispenilai = $tipe_user[2]=='y' ? TRUE : FALSE;
                    $ispeserta = $tipe_user[3]=='y' ? TRUE : FALSE;

                    $ses_data = [
                        'user_id'           => $data['user_id'],
                        'username'          => $data['username'],
                        'nodaftar'          => $data['nodaftar'],
                        'status'            => $data['status'],
                        'tipe_user'         => $data['tipe_user'],
                        'confirmcapes'      => $data['confirmcapes'],
                        'issadmin'          => $issadmin,
                        'isadmin'           => $isadmin,
                        'ispenilai'         => $ispenilai,
                        'ispeserta'         => $ispeserta,
                        'logged_in'         => TRUE
                    ];
                    $session->set($ses_data);
                    if ($issadmin){
                        $session->set('role', 'superadmin');
                        return redirect()->t0('/superadmin');                        
                    }elseif($isadmin){
                        $session->set('role', 'admin');
                        return redirect()->to('/admin');
                    }elseif($ispenilai){
                        $session->set('role', 'penilai');
                        return redirect()->to('/penilai');
                    }elseif($ispeserta){
                        $session->set('role', 'peserta');
                        return redirect()->to('/peserta');
                    }else{
                        $session->destroy();
                        return redirect()->to('/home');
                    }
                }else{
                    $session->setFlashdata('msg', 'Salah password');
                    return redirect()->to('/home');
                }
            }else{
                $session->setFlashdata('msg', 'Username tidak ditemukan');
                return redirect()->to('/home');
            }
        }else{
            $data['validation'] = $this->validator;
            return view('/home', $data);
        }
    }
 
    //fungsi logout
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/home');
    }

    public function dashboard(){
        $session = session();
        $logged_in = $session->get('logged_in');
        if (!$logged_in){
            return redirect()->to('/home');
        }

        $data['title_page'] = "Dashboard PPI RPL";
        $data['data_bread'] = "dashboard";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/dashboard', $data);
    }
}