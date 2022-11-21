<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CapesProfileModel;
use App\Models\TugasAkhirModel;
use App\Models\BimbingModel;
use App\Models\JadwalSidangModel;
use App\Models\PengujiModel;

class Mantugasakhir extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        
        $user_id = $session->get('user_id');
        $model = new TugasAkhirModel();
        $data['logged_in'] = $logged_in;
        $tugasakhir = $model->join('tbl_profile', 'tbl_tugasakhir.user_id = tbl_profile.user_id', 'left')->join('tbl_user', 'tbl_tugasakhir.user_id = tbl_user.user_id', 'left')->orderby('tbl_tugasakhir.ta_tahun', 'DESC')->orderby('tbl_tugasakhir.ta_semester','ASC')->orderby('tbl_profile.FullName', 'ASC')->findall();
        if (!empty($tugasakhir)){
            $data['data_ta'] = $tugasakhir;
        }else{
            $data['data_ta'] = 'kosong';
        }
        $data['title_page'] = "Daftar Tugas Akhir Peserta PPI RPL";
        $data['data_bread'] = "Tugas Akhir Peserta PPI RPL";
        $data['logged_in'] = $logged_in;
        return view('maintemp/mantugasakhir', $data);
    }

    public function setjadwal($ta_id, $user_id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $model = new JadwalSidangModel();
        $jadwalsidang = $model->where('tbl_jadwalsidang.ta_id', $ta_id)->findall();
        if (!empty($jadwalsidang)){
            $data['data_js'] = $jadwalsidang;
        }else{
            $data['data_js'] = 'kosong';
        }
        $data['ta_id'] = $ta_id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Jadwal Sidang Peserta PPI RPL";
        $data['data_bread'] = "Jadwal Sidang";
        $data['logged_in'] = $logged_in;
        return view('maintemp/manjadwalsidang', $data);
    }

    public function tambahjadwal($id, $user_id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        
        $data['ta_id'] = $id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Jadwal Sidang Peserta PPI RPL";
        $data['data_bread'] = "Tambah Jadwal Sidang";
        $data['logged_in'] = $logged_in;
        return view('maintemp/tambahjadwalsidang', $data);
    }

    public function tambahjsproses(){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $user_id = $this->request->getVar('user_id');
        $ta_id = $this->request->getVar('ta_id');
        $submit = $this->request->getVar('submit');
        if ($submit=="batal"){
            return redirect()->to('/mantugasakhir/setjadwal/'.$ta_id.'/'.$user_id);
        }else{
            $model = new JadwalSidangModel();
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'sidang_ruang' => [
                    'label'  => 'sidang_ruang',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Ruang Sidang harus diisi.',
                    ],
                ],
                'sidang_tanggal' => [
                    'label'  => 'sidang_tanggal',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tanggal Sidang harus diisi.',
                    ],
                ]
            ]);
        }
        if ($formvalid){
            $sidang_ruang = $this->request->getVar('sidang_ruang');
            $sidang_tanggal = $this->request->getVar('sidang_tanggal');

            $data = array(
                'ta_id' => $ta_id,
                'user_id' => $user_id,
                'sidang_ruang' => $sidang_ruang,
                'sidang_tanggal' => $sidang_tanggal,
                'date_created' => date('Y-m-d'),
                'date_modified' => date('Y-m-d')
            );
    
            $model->save($data);
    
             return redirect()->to('/mantugasakhir/setjadwal/'.$ta_id.'/'.$user_id);
        }else{
            $data['ta_id'] = $ta_id;
            $data['user_id'] = $user_id;
            $data['title_page'] = "Jadwal Sidang Peserta PPI RPL";
            $data['data_bread'] = "Tambah Jadwal Sidang";
            $data['logged_in'] = $logged_in;
            $data['validation'] = $this->validator;
            return view('maintemp/tambahjadwalsidangvalid', $data);
        }
    }

    public function hapusjadwal($id, $ta_id, $user_id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        $model = new JadwalSidangModel();
        $model->delete($id);
        $session->setFlashdata('msg', 'Data jadwal sidang berhasil dihapus.');

        return redirect()->to('/mantugasakhir/setjadwal/'.$ta_id.'/'.$user_id);  
    }

    public function setpenguji($ta_id, $user_id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        $model = new PengujiModel();
        $penguji = $model->where('ta_id', $ta_id)->where('tbl_penguji.user_id', $user_id)->join('tbl_profile', 'tbl_penguji.penguji = tbl_profile.user_id', 'left')->orderby('uji_id', 'DESC')->findall();

        if ($penguji){
            $data['data_uji'] = $penguji;
        }else{
            $data['data_uji'] = 'kosong';
        }

        helper(['tanggal']);
        
        $data['ta_id'] = $ta_id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Daftar Penguji Proyek Akhir Peserta PPI RPL";
        $data['data_bread'] = "Penguji Proyek Akhir";
        $data['logged_in'] = $logged_in;
        return view('maintemp/manpenguji', $data);
    }

    public function tambahpenguji($id, $user_id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new UserModel();
        $where = "tipe_user LIKE '__y_'";
        $user = $model->join('tbl_profile', 'tbl_user.user_id = tbl_profile.user_id', 'left')->where($where)->orderby('tbl_profile.FullName', 'ASC')->findall();
        if (!empty($user)){
            $data['data_user'] = $user;
        }else{
            $data['data_user'] = 'kosong';
        }
        
        $data['ta_id'] = $id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Tambah Penguji Proyek Akhir Peserta PPI RPL";
        $data['data_bread'] = "Tambah Penguji";
        $data['logged_in'] = $logged_in;
        return view('maintemp/tambahpenguji', $data);
    }

    public function tambahujiproses(){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $user_id = $this->request->getVar('user_id');
        $ta_id = $this->request->getVar('ta_id');
        $submit = $this->request->getVar('submit');
        if ($submit=="batal"){
            return redirect()->to('/mantugasakhir/setpenguji/'.$ta_id.'/'.$user_id);
        }else{
            $model = new PengujiModel();
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'sidang_ruang' => [
                    'label'  => 'sidang_ruang',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Ruang Sidang harus diisi.',
                    ],
                ],
                'sidang_tanggal' => [
                    'label'  => 'sidang_tanggal',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tanggal Sidang harus diisi.',
                    ],
                ]
            ]);
        }
        if ($formvalid){
            $sidang_ruang = $this->request->getVar('sidang_ruang');
            $sidang_tanggal = $this->request->getVar('sidang_tanggal');

            $data = array(
                'ta_id' => $ta_id,
                'user_id' => $user_id,
                'sidang_ruang' => $sidang_ruang,
                'sidang_tanggal' => $sidang_tanggal,
                'date_created' => date('Y-m-d'),
                'date_modified' => date('Y-m-d')
            );
    
            $model->save($data);
    
             return redirect()->to('/mantugasakhir/setjadwal/'.$ta_id.'/'.$user_id);
        }else{
            $model = new UserModel();
            $where = "tipe_user LIKE '__y_'";
            $user = $model->join('tbl_profile', 'tbl_user.user_id = tbl_profile.user_id', 'left')->where($where)->orderby('tbl_profile.FullName', 'ASC')->findall();
            if (!empty($user)){
                $data['data_user'] = $user;
            }else{
                $data['data_user'] = 'kosong';
            }
        
            $data['ta_id'] = $user_id;
            $data['user_id'] = $user_id;
            $data['title_page'] = "Tambah Penguji Proyek Akhir Peserta PPI RPL";
            $data['data_bread'] = "Tambah Penguji";
            $data['logged_in'] = $logged_in;
            $data['validation'] = $this->validator;
            return view('maintemp/tambahpengujivalid', $data);
        }
    }

    public function hapusuji($id, $ta_id, $user_id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        $model = new PengujiModel();
        $model->delete($id);
        $session->setFlashdata('msg', 'Data penguji berhasil dihapus.');

        return redirect()->to('/mantugasakhir/setpenguji/'.$ta_id.'/'.$user_id);  
    }
}