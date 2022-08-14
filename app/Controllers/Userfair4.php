<?php

namespace App\Controllers;

use App\Models\MengajarModel;
use App\Libraries\Slug;

class Userfair4 extends BaseController
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
        $model = new MengajarModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kerja = $model->where('user_id', $user_id)->orderby('StartPeriod','DESC')->findall();
        if (!empty($kerja)){
            $data['data_kerja'] = $kerja;
        }else{
            $data['data_kerja'] = 'kosong';
        }

        $data['title_page'] = "IV. Pengalaman Mengajar Pelajaran Keinsinyuran dan/atau Manajemen dan/atau Pengalaman Mengembangkan Pendidikan/Pelatihan Keinsinyuran dan/atau Manajemen (W2,W3,W4,P5)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Pengalaman Mengajar</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok4', $data);
    }

    public function tambahajar(){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }

        $data['title_page'] = "IV. Pengalaman Mengajar Pelajaran Keinsinyuran dan/atau Manajemen dan/atau Pengalaman Mengembangkan Pendidikan/Pelatihan Keinsinyuran dan/atau Manajemen (W2,W3,W4,P5)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Pengalaman Mengajar</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/tambahajar', $data);
    }

    public function tambahajarproses(){
        $slug = new Slug();
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new MengajarModel();
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/userfair4/docs');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'StartPeriod' => [
                    'label'  => 'Tahun Mulai',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Mulai harus diisi.',
                    ],
                ],
                'EndPeriod' => [
                    'label'  => 'Tahun Selesai',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Selesai harus diisi.',
                    ],
                ],
                'Institution' => [
                    'label'  => 'Nama Perguruan Tinggi / Lembaga',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Perguruan Tinggi / Lembaga harus diisi.',
                    ],
                ],
                'Name' => [
                    'label'  => 'Nama Mata Ajaran',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Mata Ajaran harus diisi.',
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
                'Period' => [
                    'label' => 'Perioda',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Perioad harus diisi.',
                    ],
                ],
                'Position' => [
                    'label' => 'Jabatan pada Perguruan Tinggi / Lembaga',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field jabatan harus diisi.',
                    ],
                ],
                'Skshour' => [
                    'label' => 'Jumlah Jam atau S.K.S',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field jumlah jam harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label' => 'Uraian Singkat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field uraian singkat harus diisi.',
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
                $StartPeriod = $this->request->getVar('StartPeriod');
                $EndPeriod = $this->request->getVar('EndPeriod');
                $Institution = $this->request->getVar('Institution');
                $Name = $this->request->getVar('Name');
                $LocCity = $this->request->getVar('LocCity');
                $LocProv = $this->request->getVar('LocProv');
                $LocCountry = $this->request->getVar('LocCountry');
                $Period = $this->request->getVar('Period');
                $Position = $this->request->getVar('Position');
                $Skshour = $this->request->getVar('Skshour');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                
                $ext = $File->getClientExtension();
                if (!empty($ext)){
                    $namainstansi = $slug->slugify($Institution);
                    $namamk = $slug->slugify($Name);
                    $filename = $user_id.'_pengajar_'.$namainstansi.'_'.$namamk.'.'.$ext;
                    $File->move('uploads/docs/',$filename,true);
                }else{
                    $filename="";
                }
    
                $data = array(
                    'user_id' => $user_id,
                    'Institution' => $Institution,
                    'Name' => $Name,
                    'LocCity' => $LocCity,
                    'LocProv' => $LocProv,
                    'LocCountry' => $LocCountry,
                    'Period' => $Period,
                    'StartPeriod' => $StartPeriod,
                    'EndPeriod' => $EndPeriod,
                    'Position' => $Position,
                    'Skshour' => $Skshour,
                    'Desc' => $Desc,
                    'File' => $filename,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
    
                $model->save($data);
                $session->setFlashdata('msg', 'Data pengalaman mengajar berhasil ditambah.');
    
                return redirect()->to('/userfair4/docs');
            }else{

                $data['title_page'] = "IV. Pengalaman Mengajar Pelajaran Keinsinyuran dan/atau Manajemen dan/atau Pengalaman Mengembangkan Pendidikan/Pelatihan Keinsinyuran dan/atau Manajemen (W2,W3,W4,P5)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Pengalaman Mengajar</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahajarvalid', $data);
            }
        }
    }

    public function hapusajar($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new MengajarModel();

        $pengkerja = $model->find($id);
        $path = './uploads/docs/'.$pengkerja['File'];
        if (is_file($path)){
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data kualifikasi profesional berhasil dihapus.');

        return redirect()->to('/userfair4/docs');   
    }

    public function ubahajar($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new MengajarModel();
        $kerja = $model->where('Num', $id)->first();
        if ($kerja){
            $data = [
                'Num' => $kerja['Num'],
                'user_id' => $kerja['user_id'],
                'Institution' => $kerja['Institution'],
                'Name' => $kerja['Name'],
                'LocCity' => $kerja['LocCity'],
                'LocProv' => $kerja['LocProv'],
                'LocCountry' => $kerja['LocCountry'],
                'Period' => $kerja['Period'],
                'StartPeriod' => $kerja['StartPeriod'],
                'EndPeriod' => $kerja['EndPeriod'],
                'Position' => $kerja['Position'],
                'Skshour' => $kerja['Skshour'],
                'Desc' => $kerja['Desc'],
                'File' => $kerja['File']
            ];
        }

        $data['title_page'] = "IV. Pengalaman Mengajar Pelajaran Keinsinyuran dan/atau Manajemen dan/atau Pengalaman Mengembangkan Pendidikan/Pelatihan Keinsinyuran dan/atau Manajemen (W2,W3,W4,P5)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Pengalaman Mengajar</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahajar', $data);
    }

    public function ubahajarproses(){
        $session = session();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new MengajarModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/userfair4/docs');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'StartPeriod' => [
                    'label'  => 'Tahun Mulai',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Mulai harus diisi.',
                    ],
                ],
                'EndPeriod' => [
                    'label'  => 'Tahun Selesai',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Selesai harus diisi.',
                    ],
                ],
                'Institution' => [
                    'label'  => 'Nama Perguruan Tinggi / Lembaga',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Perguruan Tinggi / Lembaga harus diisi.',
                    ],
                ],
                'Name' => [
                    'label'  => 'Nama Mata Ajaran',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Mata Ajaran harus diisi.',
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
                'Period' => [
                    'label' => 'Perioda',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field Perioad harus diisi.',
                    ],
                ],
                'Position' => [
                    'label' => 'Jabatan pada Perguruan Tinggi / Lembaga',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field jabatan harus diisi.',
                    ],
                ],
                'Skshour' => [
                    'label' => 'Jumlah Jam atau S.K.S',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field jumlah jam harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label' => 'Uraian Singkat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Field uraian singkat harus diisi.',
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
                $StartPeriod = $this->request->getVar('StartPeriod');
                $EndPeriod = $this->request->getVar('EndPeriod');
                $Institution = $this->request->getVar('Institution');
                $Name = $this->request->getVar('Name');
                $LocCity = $this->request->getVar('LocCity');
                $LocProv = $this->request->getVar('LocProv');
                $LocCountry = $this->request->getVar('LocCountry');
                $Period = $this->request->getVar('Period');
                $Position = $this->request->getVar('Position');
                $Skshour = $this->request->getVar('Skshour');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');

                $namainstansi = $slug->slugify($Institution);
                $namamk = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if ((empty($filename))&&(!empty($ext))){   
                    $filenamenew = $user_id.'_pengajar_'.$namainstansi.'_'.$namamk.'.'.$ext;
                    $File->move('uploads/docs/',$filenamenew,true);
                } elseif ((!empty($filename))&&(!empty($ext))){
                    $oldext = substr($filename,-4);
                    if ($oldext == $ext){
                        $File->move('uploads/docs/',$filename,true);
                        $filenamenew = $filename;
                    }else{
                        $filenamenew = $user_id.'_pengajar_'.$namainstansi.'_'.$namamk.'.'.$ext;
                        $File->move('uploads/docs/',$filenamenew,true);
                    }
                }else{
                    $filenamenew=$filename;
                }
    
                $data = array(
                    'Institution' => $Institution,
                    'Name' => $Name,
                    'LocCity' => $LocCity,
                    'LocProv' => $LocProv,
                    'LocCountry' => $LocCountry,
                    'Period' => $Period,
                    'StartPeriod' => $StartPeriod,
                    'EndPeriod' => $EndPeriod,
                    'Position' => $Position,
                    'Skshour' => $Skshour,
                    'Desc' => $Desc,
                    'File' => $filenamenew,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data kualifikasi profesional berhasil diubah.');
    
                return redirect()->to('/userfair4/docs');
            }else{
                $session = session();
                $model = new MengajarModel();
                $kerja = $model->where('Num', $Num)->first();
                if ($kerja){
                    $data = [
                        'Num' => $kerja['Num'],
                        'user_id' => $kerja['user_id'],
                        'Institution' => $kerja['Institution'],
                        'Name' => $kerja['Name'],
                        'LocCity' => $kerja['LocCity'],
                        'LocProv' => $kerja['LocProv'],
                        'LocCountry' => $kerja['LocCountry'],
                        'Period' => $kerja['Period'],
                        'StartPeriod' => $kerja['StartPeriod'],
                        'EndPeriod' => $kerja['EndPeriod'],
                        'Position' => $kerja['Position'],
                        'Skshour' => $kerja['Skshour'],
                        'Desc' => $kerja['Desc'],
                        'File' => $kerja['File']
                    ];
                }

                $data['title_page'] = "IV. Pengalaman Mengajar Pelajaran Keinsinyuran dan/atau Manajemen dan/atau Pengalaman Mengembangkan Pendidikan/Pelatihan Keinsinyuran dan/atau Manajemen (W2,W3,W4,P5)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Pengalaman Mengajar</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahkerja', $data);
            }
        }        
    }
}