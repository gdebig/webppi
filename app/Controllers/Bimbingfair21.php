<?php

namespace App\Controllers;

use App\Models\EtikRefModel;

class Bimbingfair21 extends BaseController
{
    public function docs($id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&(!$ispenilai)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'penilai');
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
        $data['user_id'] = $user_id;
        $data['title_page'] = "II.1. Referensi Kode Etik dan Etika Profesi (#) (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/bimbingfair/docs/".$id.'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Referensi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/bimbingdok21', $data);
    }

    public function tambahref(){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&(!$ispenilai)){
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
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&(!$ispenilai)){
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
                        'required' => 'Field City Lokasi Sertifikat harus diisi.',
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

    public function hapusetik($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&(!$ispenilai)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new EtikRefModel();

        $model->delete($id);
        $session->setFlashdata('msg', 'Data referensi kode etik berhasil dihapus.');

        return redirect()->to('/userfair21/docs');   
    }

    public function ubahetik($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&(!$ispenilai)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new EtikRefModel();
        $etik = $model->where('Num', $id)->first();
        if ($etik){
            $data = [
                'Num' => $etik['Num'],
                'user_id' => $etik['user_id'],
                'Name' => $etik['Name'],
                'Addr' => $etik['Addr'],
                'City' => $etik['City'],
                'Prov' => $etik['Prov'],
                'Country' => $etik['Country'],
                'Pnum' => $etik['Pnum'],
                'Email' => $etik['Email'],
                'Relation' => $etik['Relation']
            ];
        }
        $data['title_page'] = "II.1. Referensi Kode Etik dan Etika Profesi (#) (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Referensi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahrefuserfair', $data);
    }

    public function ubahrefproses(){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in)&&(!$ispenilai)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new EtikRefModel();
        $Num = $this->request->getVar('Num');
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
                        'required' => 'Field City Lokasi Sertifikat harus diisi.',
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
                    'Name' => $Name,
                    'Addr' => $Addr,
                    'City' => $City,
                    'Prov' => $Prov,
                    'Country' => $Country,
                    'Pnum' => $Pnum,
                    'Email' => $Email,
                    'Relation' => $Relation,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data referensi kode etik berhasil diubah.');
    
                return redirect()->to('/userfair21/docs');
            }else{
                $etik = $model->where('Num', $Num)->first();
                if ($etik){
                    $data = [
                        'Num' => $etik['Num'],
                        'user_id' => $etik['user_id'],
                        'Name' => $etik['Name'],
                        'Addr' => $etik['Addr'],
                        'City' => $etik['City'],
                        'Prov' => $etik['Prov'],
                        'Country' => $etik['Country'],
                        'Pnum' => $etik['Pnum'],
                        'Email' => $etik['Email'],
                        'Relation' => $etik['Relation']
                    ];
                }
                $data['title_page'] = "II.1. Referensi Kode Etik dan Etika Profesi (#) (W1)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Referensi</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahrefuserfair', $data);
            }
        }        
    }
}