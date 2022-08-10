<?php

namespace App\Controllers;

use App\Models\EtikRefModel;

class Userfair21 extends BaseController
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
        $model = new EtikRefModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $etik = $model->where('user_id', $user_id)->orderby('Name','ASC')->findall();
        if (!empty($etik)){
            $data['data_etik'] = $etik;
        }else{
            $data['data_etik'] = 'kosong';
        }

        $data['title_page'] = "II.1. Referensi Kode Etik dan Etika Profesi (#) (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Referensi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok21', $data);
    }

    public function tambahref(){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new EtikRefModel();

        $user_id = $session->get('user_id');
        $data['title_page'] = "II.1. Referensi Kode Etik dan Etika Profesi (#) (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Referensi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/tambahrefuserfair', $data);
    }

    public function tambahrefproses(){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new EtikRefModel();
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/userfair21/docs');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Lengkap harus diisi.',
                    ],
                ],
                'Addr' => [
                    'label'  => 'Alamat',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Alamat harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Lokasi Sertifikat harus diisi.',
                    ],
                ],
                'Prov' => [
                    'label'  => 'Prov',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Provinsi Lokasi Sertifikat harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Lokasi Sertifikat harus diisi.',
                    ],
                ],
                'Pnum' => [
                    'label'  => 'Pnum',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nomor Telepon harus diisi.',
                    ],
                ],
                'Email' => [
                    'label'  => 'Email',
                    'rules'  => 'required|valid_email',
                    'errors' => [
                        'required' => 'Field Email harus diisi.',
                        'valid_email' => 'Field Email harus diisi dengan format email yang sesuai'
                    ],
                ],
                'Relation' => [
                    'label'  => 'Relation',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Hubungan harus diisi.',
                    ],
                ]
            ]);

            if ($formvalid){
                $Name = $this->request->getVar('Name');
                $Addr = $this->request->getVar('Addr');
                $City = $this->request->getVar('City');
                $Prov = $this->request->getVar('Prov');
                $Country = $this->request->getVar('Country');
                $Pnum = $this->request->getVar('Pnum');
                $Email = $this->request->getVar('Email');
                $Relation = $this->request->getVar('Relation');
    
                $data = array(
                    'user_id' => $user_id,
                    'Name' => $Name,
                    'Addr' => $Addr,
                    'City' => $City,
                    'Prov' => $Prov,
                    'Country' => $Country,
                    'Pnum' => $Pnum,
                    'Email' => $Email,
                    'Relation' => $Relation,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
    
                $model->save($data);
                $session->setFlashdata('msg', 'Data Referensi Kode Etik berhasil ditambah.');
    
                return redirect()->to('/userfair21/docs');
            }else{
                $session = session();
                $data['title_page'] = "II.1. Referensi Kode Etik dan Etika Profesi (#) (W1)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Referensi</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahrefuserfairvalid', $data);
            }
        }
    }

    public function hapussert($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new EtikRefModel();

        $latih = $model->find($id);
        $path = './uploads/docs/'.$latih['File'];
        if (is_file($path)){
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data Sertifikat Kompetensi berhasil dihapus.');

        return redirect()->to('/userfair16/docs');   
    }

    public function ubahsert($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new EtikRefModel();
        $latih = $model->where('Num', $id)->first();
        if ($latih){
            $data = [
                'Num' => $latih['Num'],
                'user_id' => $latih['user_id'],
                'Name' => $latih['Name'],
                'Addr' => $latih['Addr'],
                'Kota' => $latih['Kota'],
                'Country' => $latih['Country'],
                'Email' => $latih['Email'],
                'Pnum' => $latih['Pnum'],
                'Relation' => $latih['Relation'],
                'Length' =>  $latih['Length'],
                'Description' => $latih['Description'],
                'File' => $latih['File']
            ];
        }

        $data['title_page'] = "I.6. Sertifikat Kompetensi dan Bidang Lainnya (yang Relevan) Yang Diikuti (#) (W1,W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Sertifikat Kompetensi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahsertuserfair', $data);
    }

    public function ubahsertproses(){
        $session = session();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new EtikRefModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/userfair16/docs');
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
                'Addr' => [
                    'label'  => 'Addr',
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
                'Pnum' => [
                    'label'  => 'Pnum',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan harus diisi.',
                    ],
                ],
                'Email' => [
                    'labe|l'  => 'Email',
                    'rules'  => 'required|',
                    'errors' => [
                        'required' => 'Field Tahun harus diisi.',
                    ],
                ],
                'Relation' => [
                    'label'  => 'Relation',
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
                $Addr = $this->request->getVar('Addr');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $Pnum = $this->request->getVar('Pnum');
                $Email = $this->request->getVar('Email');
                $Relation = $this->request->getVar('Relation');
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
                    'Addr' => $Addr,
                    'Kota' => $City,
                    'Country' => $Country,
                    'Pnum' => $Pnum,
                    'Email' => $Email,
                    'Relation' => $Relation,
                   'Length' => $Length,
                    'Description' => $Description,
                    'File' => $filename,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data Sertifikat Kompetensi berhasil diubah.');
    
                return redirect()->to('/userfair16/docs');
            }else{
                $latih = $model->where('Num', $Num)->first();
                if ($latih){
                    $data = [
                        'Num' => $latih['Num'],
                        'user_id' => $latih['user_id'],
                        'Name' => $latih['Name'],
                        'Addr' => $latih['Addr'],
                        'Kota' => $latih['Kota'],
                        'Country' => $latih['Country'],
                        'Email' => $latih['Email'],
                        'Pnum' => $latih['Pnum'],
                        'Relation' => $latih['Relation'],
                        'Length' =>  $latih['Length'],
                        'Description' => $latih['Description'],
                        'File' => $latih['File']
                    ];
                }

                $data['title_page'] = "I.6. Sertifikat Kompetensi dan Bidang Lainnya (yang Relevan) Yang Diikuti (#) (W1,W4)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Sertifikat Kompetensi</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahsertuserfair', $data);
            }
        }        
    }
}