<?php

namespace App\Controllers;

use App\Models\BahasaModel;
use App\Models\KompModel;
use App\Libraries\Slug;

class Userfair6 extends BaseController
{
    public function docs($id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&(!$ispeserta)||(!$ispenilai)){
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
        $model = new BahasaModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $bahasa = $model->where('user_id', $user_id)->orderby('Num', 'DESC')->findall();
        if (!empty($bahasa)){
            $data['data_bahasa'] = $bahasa;
        }else{
            $data['data_bahasa'] = 'kosong';
        }

        $data['title_page'] = "VI. Bahasa yang Dikuasai (W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Bahasa</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok6', $data);
    }

    public function tambahbahasa(){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'W.4%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "VI. Bahasa yang Dikuasai (W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Bahasa</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/tambahbahasa', $data);
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