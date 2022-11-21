<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\KompModel;
use App\Models\CapesOrgModel;
use App\Models\PenghargaanModel;
use App\Models\CapesSertModel;
use App\Models\CapesKualifikasiModel;
use App\Models\MengajarModel;
use App\Models\CapesKartulModel;
use App\Models\CapesSemModel;
use App\Models\InovasiModel;
use App\Models\BahasaModel;
use App\Models\ProfileModel;
use App\Libraries\Slug;

class Userfairrekap extends BaseController
{
    public function docs($id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }

        if (!empty($id)){
            $user_id = $id;
        }else{
            $user_id = $session->get('user_id');
        }
        helper(['tanggal']);

        $model = new UserModel();
        $user = $model->where('user_id', $user_id)->first();
        if ($user){
            $data = [
                'user_id' => $user['user_id'],
                'confirmfair' => $user['confirmfair']
            ];
        }else{
            $data['kosong'] = "kosong";
        }

        $model1 = new ProfileModel();
        $profile = $model1->where('user_id', $user_id)->first();
        if ($profile){
            $data = [
                'FullName' => $profile['FullName'],
                'Vocational' => $profile['Vocational']
            ];
        }else{
            $data['kosong'] = "kosong";
        }

        $orgmodel = new CapesOrgModel();
        $org = $orgmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $pengmodel = new PenghargaanModel();
        $peng = $pengmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $sertmodel = new CapesSertModel();
        $sert = $sertmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $kualimodel = new CapesKualifikasiModel();
        $kualifikasi = $kualimodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $ajarmodel = new MengajarModel();
        $ajar = $ajarmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $kartulmodel = new CapesKartulModel();
        $kartul = $kartulmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $semmodel = new CapesSemModel();
        $sem = $semmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $inovmodel = new InovasiModel();
        $inov = $inovmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();
        $bhsmodel = new BahasaModel();
        $bhs = $bhsmodel->selectSum('nilai_w1')->selectSum('nilai_w2')->selectSum('nilai_w3')->selectSum('nilai_w4')->selectSum('nilai_pil')->where('user_id', $user_id)->first();

        $data['nilai_w1'] = $org['nilai_w1'] + $peng['nilai_w1'] + $sert['nilai_w1'] + $kualifikasi['nilai_w1'] + $ajar['nilai_w1'] + $kartul['nilai_w1'] + $sem['nilai_w1'] + $inov['nilai_w1'] + $bhs['nilai_w1'];
        $data['nilai_w2'] = $org['nilai_w2'] + $peng['nilai_w2'] + $sert['nilai_w2'] + $kualifikasi['nilai_w2'] + $ajar['nilai_w2'] + $kartul['nilai_w2'] + $sem['nilai_w2'] + $inov['nilai_w2'] + $bhs['nilai_w2'];
        $data['nilai_w3'] = $org['nilai_w3'] + $peng['nilai_w3'] + $sert['nilai_w3'] + $kualifikasi['nilai_w3'] + $ajar['nilai_w3'] + $kartul['nilai_w3'] + $sem['nilai_w3'] + $inov['nilai_w3'] + $bhs['nilai_w3'];
        $data['nilai_w4'] = $org['nilai_w4'] + $peng['nilai_w4'] + $sert['nilai_w4'] + $kualifikasi['nilai_w4'] + $ajar['nilai_w4'] + $kartul['nilai_w4'] + $sem['nilai_w4'] + $inov['nilai_w4'] + $bhs['nilai_w4'];
        $data['nilai_pil'] = $org['nilai_pil'] + $peng['nilai_pil'] + $sert['nilai_pil'] + $kualifikasi['nilai_pil'] + $ajar['nilai_pil'] + $kartul['nilai_pil'] + $sem['nilai_pil'] + $inov['nilai_pil'] + $bhs['nilai_pil'];
        $data['total'] = $data['nilai_w1'] + $data['nilai_w2'] + $data['nilai_w3'] + $data['nilai_w4'] + $data['nilai_pil'];

        if ($data['total']>=6000){
            $data['estimasi'] = "Anda memenuhi syarat untuk IPU";
        }elseif ($data['total'] >= 3000){
            $data['estimasi'] = "Anda memenuhi syarat untuk IPM";
        }elseif ($data['total'] >= 600){
            $data['estimasi'] = "Anda memenuhi syarat untuk IPP";
        }else{
            $data['estimasi'] = "Anda belum memenuhi syarat";
        }

        $data['title_page'] = "Rekapitulasi";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Rekapitulasi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairrekap', $data);
    }

    public function pernyataanproses(){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }        
    
        return redirect()->to('/userfair');
    }

    public function tambahbahasaproses(){
        $session = session();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new BahasaModel();
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/userfair6/docs');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Nama Bahasa',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama bahasa harus diisi.',
                    ],
                ],
                'LangType' => [
                    'label'  => 'Jenis Bahasa',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jenis Bahasa harus diisi.',
                    ],
                ],
                'VerbSkill' => [
                    'label'  => 'Kemampuan Verbal',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kemampuan Verbal Aktif/Pasif harus diisi.',
                    ],
                ],
                'WriteType' => [
                    'label'  => 'Jenis Tulisan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field jenis tulisan yang mampu disusun harus diisi.',
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
                $LangType = $this->request->getVar('LangType');
                $VerbSkill = $this->request->getVar('VerbSkill');
                $WriteType = $this->request->getVar('WriteType');
                $LangMark = $this->request->getVar('LangMark');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp6');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i=0;
                foreach ($komp as $kp) :
                    $nilai_p = $nilai_p + 2;
                    switch ($LangType){
                        case "Da":
                            $nilai_q = $nilai_q + 1;
                            break;
                        case "Na":
                            $nilai_q = $nilai_q + 2;
                            break;
                        case "In":
                            $nilai_q = $nilai_q + 3;
                            break;
                    }
                    switch ($VerbSkill){
                        case "Pasif":
                            $nilai_r = $nilai_r + 2;
                            break;
                        case "Aktif":
                            $nilai_r = $nilai_r + 3;
                            break;
                    }
                    $i++;
                    if ($i!=$totarray){
                        $stringkp = $stringkp.$kp.', ';
                    }else{
                        $stringkp = $stringkp.$kp;
                    }
                endforeach;
                $nilai_w4 = $nilai_p * $nilai_q * $nilai_r;
                
                $namabahasa = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if (!empty($ext)){
                    $random = bin2hex(random_bytes(4));
                    $filename = $user_id.'_bahasa_'.$namabahasa.'_'.$random.'.'.$ext;
                    $File->move('uploads/docs/',$filename,true);
                }else{
                    $filename="";
                }
    
                $data = array(
                    'user_id' => $user_id,
                    'Name' => $Name,
                    'LangType' => $LangType,
                    'VerbSkill' => $VerbSkill,
                    'WriteType' => $WriteType,
                    'LangMark' => $LangMark,
                    'File' => $filename,
                    'kompetensi' => $stringkp,
                    'nilai_p' => $nilai_p,
                    'nilai_q' => $nilai_q,
                    'nilai_r' => $nilai_r,
                    'nilai_w4' => $nilai_w4,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
    
                $model->save($data);
                $session->setFlashdata('msg', 'Data bahasa berhasil ditambah.');
    
                return redirect()->to('/userfair6/docs');
            }else{
                $data['datakomp'] = $this->request->getVar('komp6');

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.4%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "VI. Bahasa yang Dikuasai (W4)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Bahasa</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahbahasavalid', $data);
            }
        }
    }

    public function hapusbahasa($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new BahasaModel();

        $bahasa = $model->find($id);
        $path = './uploads/docs/'.$bahasa['File'];
        if (is_file($path)){
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data bahasa berhasil dihapus.');

        return redirect()->to('/userfair6/docs');   
    }

    public function ubahbahasa($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new BahasaModel();
        $bahasa = $model->where('Num', $id)->first();
        if ($bahasa){
            $data = [
                'Num' => $bahasa['Num'],
                'user_id' => $bahasa['user_id'],
                'Name' => $bahasa['Name'],
                'LangType' => $bahasa['LangType'],
                'VerbSkill' => $bahasa['VerbSkill'],
                'WriteType' => $bahasa['WriteType'],
                'LangMark' => $bahasa['LangMark'],
                'File' => $bahasa['File'],
                'datakomp' => explode(", ", $bahasa['kompetensi'])
            ];
        }

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'W.4%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "VI. Bahasa yang Dikuasai (W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Bahasa</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahbahasa', $data);
    }

    public function ubahbahasaproses(){
        $session = session();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new BahasaModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/userfair6/docs');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Nama Bahasa',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama bahasa harus diisi.',
                    ],
                ],
                'LangType' => [
                    'label'  => 'Jenis Bahasa',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jenis Bahasa harus diisi.',
                    ],
                ],
                'VerbSkill' => [
                    'label'  => 'Kemampuan Verbal',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kemampuan Verbal Aktif/Pasif harus diisi.',
                    ],
                ],
                'WriteType' => [
                    'label'  => 'Jenis Tulisan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field jenis tulisan yang mampu disusun harus diisi.',
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
                $Name = $this->request->getVar('Name');
                $LangType = $this->request->getVar('LangType');
                $VerbSkill = $this->request->getVar('VerbSkill');
                $WriteType = $this->request->getVar('WriteType');
                $LangMark = $this->request->getVar('LangMark');
                $File = $this->request->getFile('File');
                $komp = $this->request->getVar('komp6');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i=0;
                foreach ($komp as $kp) :
                    $nilai_p = $nilai_p + 2;
                    switch ($LangType){
                        case "Da":
                            $nilai_q = $nilai_q + 1;
                            break;
                        case "Na":
                            $nilai_q = $nilai_q + 2;
                            break;
                        case "In":
                            $nilai_q = $nilai_q + 3;
                            break;
                    }
                    switch ($VerbSkill){
                        case "Pasif":
                            $nilai_r = $nilai_r + 2;
                            break;
                        case "Aktif":
                            $nilai_r = $nilai_r + 3;
                            break;
                    }
                    $i++;
                    if ($i!=$totarray){
                        $stringkp = $stringkp.$kp.', ';
                    }else{
                        $stringkp = $stringkp.$kp;
                    }
                endforeach;
                $nilai_w4 = $nilai_p * $nilai_q * $nilai_r;

                $namabahasa = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if ((empty($filename))&&(!empty($ext))){
                    $random = bin2hex(random_bytes(4));
                    $filenamenew = $user_id.'_bahasa_'.$namabahasa.'_'.$random.'.'.$ext;
                    $File->move('uploads/docs/',$filenamenew,true);
                } elseif ((!empty($filename))&&(!empty($ext))){
                    $oldext = substr($filename,-4);
                    if ($oldext == $ext){
                        $File->move('uploads/docs/',$filename,true);
                        $filenamenew = $filename;
                    }else{
                        $random = bin2hex(random_bytes(4));
                        $filenamenew = $user_id.'_bahasa_'.$namabahasa.'_'.$random.'.'.$ext;
                        $File->move('uploads/docs/',$filenamenew,true);
                    }
                }else{
                    $filenamenew=$filename;
                }
    
                $data = array(
                    'Name' => $Name,
                    'LangType' => $LangType,
                    'VerbSkill' => $VerbSkill,
                    'WriteType' => $WriteType,
                    'LangMark' => $LangMark,
                    'File' => $filenamenew,
                    'kompetensi' => $stringkp,
                    'nilai_p' => $nilai_p,
                    'nilai_q' => $nilai_q,
                    'nilai_r' => $nilai_r,
                    'nilai_w4' => $nilai_w4,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data bahasa berhasil diubah.');
    
                return redirect()->to('/userfair6/docs');
            }else{
                $bahasa = $model->where('Num', $Num)->first();
                if ($bahasa){
                    $data = [
                        'Num' => $bahasa['Num'],
                        'user_id' => $bahasa['user_id'],
                        'Num' => $bahasa['Num'],
                        'user_id' => $bahasa['user_id'],
                        'Name' => $bahasa['Name'],
                        'LangType' => $bahasa['LangType'],
                        'VerbSkill' => $bahasa['VerbSkill'],
                        'WriteType' => $bahasa['WriteType'],
                        'LangMark' => $bahasa['LangMark'],
                        'File' => $bahasa['File'],
                        'datakomp' => explode(", ", $bahasa['kompetensi'])
                    ];
                }
        
                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.4%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "VI. Bahasa yang Dikuasai (W4)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Bahasa</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahbahasa', $data);
            }
        }        
    }
}