<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CapesProfileModel;
use App\Models\CapesPendModel;
use App\Models\CapesKualifikasiModel;
use App\Models\CapesOrgModel;
use App\Models\CapesSertModel;
use App\Models\CapesKartulModel;
use App\Models\CapesSemModel;
use App\Models\BimbingModel;

class Manpeserta extends BaseController
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
        $model = new UserModel();
        $data['logged_in'] = $logged_in;
        $where = "tipe_user LIKE '___y'";
        $where1 = "status IN ('diterima', 'regular')";
        $user = $model->join('tbl_profile', 'tbl_user.user_id = tbl_profile.user_id', 'left')->join('tbl_bimbing', 'tbl_user.user_id = tbl_bimbing.mhs_id', 'left')->where($where1)->where($where)->where('tbl_user.softdelete', 'no')->orderby('tbl_user.user_id', 'DESC')->findall();
        if (!empty($user)){
            $data['data_user'] = $user;
        }else{
            $data['data_user'] = 'kosong';
        }
        
        $where2 = "tipe_user LIKE '__y_'";
        $dosbing = $model->join('tbl_profile', 'tbl_user.user_id = tbl_profile.user_id', 'left')->where($where2)->where('tbl_user.softdelete', 'no')->orderby('tbl_user.user_id', 'DESC')->findall();
        if (!empty($dosbing)){
            $data['data_dosbing'] = $dosbing;
        }else{
            $data['data_dosbing'] = 'kosong';
        }

        $data['title_page'] = "Daftar Peserta PPI RPL";
        $data['data_bread'] = "Peserta";
        return view('maintemp/peserta', $data);
    }

    public function profile($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);

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
        }else{
            $data['kosong'] = "kosong";
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Profile Calon Peserta";
        $data['data_bread'] = "Profile Calon Peserta";
        return view('maintemp/capesprofile', $data);
    }

    public function doklengkap($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);

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
        }else{
            $data['kosong'] = "kosong";
        }
        
        $model = new CapesPendModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $pend = $model->where('user_id', $id)->orderby('GradYear','DESC')->findall();
        if (!empty($pend)){
            $data['data_pend'] = $pend;
        }else{
            $data['data_pend'] = 'kosong';
        }
        
        $model = new CapesKualifikasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kerja = $model->where('user_id', $id)->orderby('ProjValue','DESC')->findall();
        if (!empty($kerja)){
            $data['data_kerja'] = $kerja;
        }else{
            $data['data_kerja'] = 'kosong';
        }
        
        $model = new CapesOrgModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $org = $model->where('user_id', $id)->orderby('StartPeriodYear','DESC')->findall();
        if (!empty($org)){
            $data['data_org'] = $org;
        }else{
            $data['data_org'] = 'kosong';
        }
        
        $model = new CapesSertModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $latih = $model->where('user_id', $id)->where('Jenis', 'pelatihan')->orderby('StartYear','DESC')->findall();
        if (!empty($latih)){
            $data['data_latih'] = $latih;
        }else{
            $data['data_latih'] = 'kosong';
        }
        
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $latih = $model->where('user_id', $id)->where('Jenis', 'sertifikat')->orderby('StartYear','DESC')->findall();
        if (!empty($latih)){
            $data['data_latih'] = $latih;
        }else{
            $data['data_latih'] = 'kosong';
        }

        $model = new CapesKartulModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kartul = $model->where('user_id', $id)->orderby('Year','DESC')->findall();
        if (!empty($kartul)){
            $data['data_kartul'] = $kartul;
        }else{
            $data['data_kartul'] = 'kosong';
        }
        
        $model = new CapesSemModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $sem = $model->where('user_id', $id)->where('Type', 'Sem')->orderby('Year', 'DESC')->findall();
        if (!empty($sem)){
            $data['data_sem'] = $sem;
        }else{
            $data['data_sem'] = 'kosong';
        }

        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Profile Calon Peserta";
        $data['data_bread'] = "Profile Calon Peserta";
        return view('maintemp/doklengkap', $data);
    }

    public function pendidikan($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new CapesPendModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $pend = $model->where('user_id', $id)->orderby('GradYear','DESC')->findall();
        if (!empty($pend)){
            $data['data_pend'] = $pend;
        }else{
            $data['data_pend'] = 'kosong';
        }
        $data['title_page'] = "Data Pendidikan Calon Peserta PPI RPL";
        $data['data_bread'] = "Pendidikan";
        return view('maintemp/capespend', $data);
    }

    public function kerja($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new CapesKualifikasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kerja = $model->where('user_id', $id)->orderby('ProjValue','DESC')->findall();
        if (!empty($kerja)){
            $data['data_kerja'] = $kerja;
        }else{
            $data['data_kerja'] = 'kosong';
        }
        $data['title_page'] = "Data Pengalaman Kerja Calon Peserta PPI RPL";
        $data['data_bread'] = "Pengalaman Kerja";
        return view('maintemp/capeskerja', $data);
    }

    public function organ($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new CapesOrgModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $org = $model->where('user_id', $id)->orderby('StartPeriodYear','DESC')->findall();
        if (!empty($org)){
            $data['data_org'] = $org;
        }else{
            $data['data_org'] = 'kosong';
        }
        $data['title_page'] = "Data Organisasi Calon Peserta PPI RPL";
        $data['data_bread'] = "Organisasi";
        return view('maintemp/capesorg', $data);
    }

    public function latih($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new CapesSertModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $latih = $model->where('user_id', $id)->where('Jenis', 'pelatihan')->orderby('StartYear','DESC')->findall();
        if (!empty($latih)){
            $data['data_latih'] = $latih;
        }else{
            $data['data_latih'] = 'kosong';
        }
        $data['title_page'] = "Data Pelatihan Teknik Calon Peserta PPI RPL";
        $data['data_bread'] = "Pelatihan";
        return view('maintemp/capeslatih', $data);
    }

    public function sert($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new CapesSertModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $latih = $model->where('user_id', $id)->where('Jenis', 'sertifikat')->orderby('StartYear','DESC')->findall();
        if (!empty($latih)){
            $data['data_latih'] = $latih;
        }else{
            $data['data_latih'] = 'kosong';
        }
        $data['title_page'] = "Data Sertifikat Kompetensi Calon Peserta PPI RPL";
        $data['data_bread'] = "Sertifikat";
        return view('maintemp/capessert', $data);
    }
    
    public function kartul($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new CapesKartulModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kartul = $model->where('user_id', $id)->orderby('Year','DESC')->findall();
        if (!empty($kartul)){
            $data['data_kartul'] = $kartul;
        }else{
            $data['data_kartul'] = 'kosong';
        }
        $data['title_page'] = "Data Karya Tulis di Bidang Keinsinyuran Calon Peserta PPI RPL";
        $data['data_bread'] = "Karya Tulis";
        return view('maintemp/capeskartul', $data);
    }    

    //Fungsi untuk link Seminar
    public function sem($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in)&&(($issadmin)||($isadmin))){
            return redirect()->to('/home');
        }
        $model = new CapesSemModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $sem = $model->where('user_id', $id)->where('Type', 'Sem')->orderby('Year', 'DESC')->findall();
        if (!empty($sem)){
            $data['data_sem'] = $sem;
        }else{
            $data['data_sem'] = 'kosong';
        }
        $data['title_page'] = "Data Seminar/Lokakarya Calon Peserta PPI RPL";
        $data['data_bread'] = "Seminar";
        return view('maintemp/capessem', $data);
    }

    public function prosesdosbing(){
        $session = session();
        $model = new BimbingModel();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        if (!$logged_in){
            return redirect()->to('/home');
        }

        $button=$this->request->getVar('submit');

        if ($button == "set"){
            $user_id = $this->request->getVar('user_id');
            $dosbing = $this->request->getVar('dosbing');
            if (!empty($user_id)){
                foreach ($user_id as $userid){                   
    
                    $data = array(
                        'mhs_id' => $userid,
                        'dosen_id' => $dosbing,
                        'date_created' => date('Y-m-d'),
                        'date_modified' => date('Y-m-d')
                    );
    
                    $model->save($data);
                }

                $session->setFlashdata('msg', 'Dosen pembimbing berhasil ditetapkan.');
    
                return redirect()->to('/manpeserta');
            }else{

                $session->setFlashdata('errmsg', 'Tidak ada peserta yang dicentang.');
    
                return redirect()->to('/manpeserta');
            }
        }elseif ($button == "ganti"){
            $user_id = $this->request->getVar('user_id');
            $dosbing = $this->request->getVar('dosbing');
            if (!empty($user_id)){
                foreach ($user_id as $userid){
                    echo $userid."<br />";
                    $bimbing = $model->where('mhs_id', $userid)->first();
                    echo $bimbing['bimbing_id']."<br />";
                    $data = array(
                        'dosen_id' => $dosbing,
                        'date_modified' => date('Y-m-d')
                    );
    
                    $model->update($bimbing['bimbing_id'], $data);
                }

                $session->setFlashdata('msg', 'Dosen pembimbing berhasil diubah.');
    
                return redirect()->to('/manpeserta');
            }else{

                $session->setFlashdata('errmsg', 'Tidak ada peserta yang dicentang.');
    
                return redirect()->to('/manpeserta');
            }
        }else{
            return redirect()->to('/manpeserta');
        }
    }
}