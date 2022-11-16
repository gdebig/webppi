<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BimbingModel;
use App\Models\NilaitaModel;
use App\Models\CustomModel;

class Manbimbing extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&(($issadmin)||($isadmin)||($ispenilai))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        
        $user_id = $session->get('user_id');
        $model = new BimbingModel();
        $data['logged_in'] = $logged_in;
        $user = $model->where('tbl_bimbing.dosen_id', $user_id)->join('tbl_profile', 'tbl_bimbing.mhs_id = tbl_profile.user_id', 'left')->join('tbl_tugasakhir', 'tbl_bimbing.mhs_id = tbl_tugasakhir.user_id', 'left')->orderby('tbl_tugasakhir.ta_tahun', 'DESC')->orderby('tbl_profile.FullName', 'ASC')->findall();
        //$user = $model->getDataBimbing($user_id);
        if (!empty($user)){
            $data['data_user'] = $user;
        }else{
            $data['data_user'] = 'kosong';
        }
        $data['title_page'] = "Data Mahasiswa Bimbingan PPI RPL";
        $data['data_bread'] = "Bimbingan";
        return view('maintemp/bimbing', $data);
    }
    
    public function berinilai($mhs_id, $dosen_id, $ta_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&(($issadmin)||($isadmin)||($ispenilai))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        
        $data['logged_in'] = $logged_in;
        $data['mhs_id'] = $mhs_id;
        $data['dosen_id'] = $dosen_id;
        $data['ta_id'] = $ta_id;
        $data['title_page'] = "Nilai Tugas Akhir Mahasiswa Bimbingan PPI RPL";
        $data['data_bread'] = "Nilai TA";
        return view('maintemp/nilaita', $data);
    }

    public function nilaitaproses(){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&(($issadmin)||($isadmin)||($ispenilai))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        
        $user_id = $session->get('user_id');
        $mhs_id = $this->request->getVar('mhs_id');
        $dosen_id = $this->request->getVar('dosen_id');
        $ta_id = $this->request->getVar('ta_id');

        $submit = $this->request->getVar('submit');
        if ($submit == "batal"){
            return redirect()->to('/manbimbing');
        }else{
            $model = new NilaitaModel();
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'penulisan' => [
                    'label'  => 'Penulisan Laporan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Penulisan Laporan harus diisi.',
                    ],
                ],
                'presentasi' => [
                    'label'  => 'Nilai Presentasi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nilai Presentasi harus diisi.',
                    ],
                ],
                'materi' => [
                    'label'  => 'Penguasaan Materi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Penguasaan Materi harus diisi.',
                    ],
                ],
                'signed' => [
                    'label'  => 'Tanda Tangan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tanda Tangan harus diisi.',
                    ],
                ]
            ]);
        }
        if ($formvalid){
            $penulisan = $this->request->getVar('penulisan');
            $presentasi = $this->request->getVar('presentasi');
            $materi = $this->request->getVar('materi');            

            $file_string = $this->request->getVar('signed');
            $image = explode(";base64,", $file_string);
            $image_type = explode("image/", $image[0]);
            $image_type_png = $image_type[1];
            $image_base64 = base64_decode($image[1]);
            $folderPath = ROOTPATH . 'public/uploads/ttd/';
            $signedname = uniqid() . '.' . $image_type_png;
            $file = $folderPath . $signedname;
            file_put_contents($file, $image_base64);

            $data = array(
                'ta_id' => $ta_id,
                'dosen_id' => $dosen_id,
                'mhs_id' => $mhs_id,
                'tipedosen' => 'Pembimbing',
                'penulisan' => $penulisan,
                'presentasi' => $presentasi,
                'materi' => $materi,
                'signed' => $signedname,
                'date_created' => date('Y-m-d'),
                'date_modified' => date('Y-m-d')
            );
    
            $model->save($data);
    
             return redirect()->to('/manbimbing');
        }else{        
            $data['logged_in'] = $logged_in;
            $data['mhs_id'] = $mhs_id;
            $data['dosen_id'] = $dosen_id;
            $data['ta_id'] = $ta_id;
            $data['title_page'] = "Nilai Tugas Akhir Mahasiswa Bimbingan PPI RPL";
            $data['data_bread'] = "Nilai TA";
            $data['validation'] = $this->validator;
            return view('maintemp/nilaitavalid', $data);
        }
    }
}