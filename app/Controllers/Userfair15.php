<?php

namespace App\Controllers;

use App\Models\CapesSertModel;
use App\Models\KompModel;
use App\Libraries\Slug;

class Userfair15 extends BaseController
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
        $model = new CapesSertModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $latih = $model->where('user_id', $user_id)->where('Jenis', 'pelatihan')->orderby('StartYear','DESC')->findall();
        if (!empty($latih)){
            $data['data_latih'] = $latih;
        }else{
            $data['data_latih'] = 'kosong';
        }

        $data['title_page'] = "I.5. Pendidikan/Pelatihan Teknik/Manajemen (W2,W4,P10)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Pelatihan Teknik</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok15', $data);
    }

    public function tambahlatih(){
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
        $model = new KompModel();
        $where = "komp_cat LIKE 'W.2%' OR komp_cat LIKE 'W.4%' OR komp_cat LIKE 'P.10%'";
        $data['data_komp'] = $model->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "I.5. Pendidikan/Pelatihan Teknik/Manajemen (W2,W4,P10)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Pelatihan Teknik</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/tambahlatihuserfair', $data);
    }

    public function tambahlatihproses(){
        $session = session();
        $slug = new Slug();
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
        $model = new CapesSertModel();

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/userfair15/docs');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Pendidikan/Pelatihan harus diisi.',
                    ],
                ],
                'Organizer' => [
                    'label'  => 'Organizer',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Penyelenggara harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Lokasi Pelatihan harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Lokasi Pelatihan harus diisi.',
                    ],
                ],
                'StartMonth' => [
                    'label'  => 'StartMonth',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan harus diisi.',
                    ],
                ],
                'StartYear' => [
                    'label'  => 'StartYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun harus diisi.',
                    ],
                ],
                'Level' => [
                    'label'  => 'Level',
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
                'komp15' => [
                    'label'  => 'Kompetensi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field kompetensi harus diisi.',
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
                $Organizer = $this->request->getVar('Organizer');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $StartMonth = $this->request->getVar('StartMonth');
                $StartYear = $this->request->getVar('StartYear');
                $Level = $this->request->getVar('Level');
                $Length = $this->request->getVar('Length');
                $Description = $this->request->getVar('Description');
                $komp15 = $this->request->getVar('komp15');
                $File = $this->request->getFile('File');
                
                $namalatih = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if (!empty($ext)){
                    $filename = $user_id.'_pelatihan_'.$namalatih.'.'.$ext;
                    $File->move('uploads/docs/',$filename,true);
                }else{
                    $filename="";
                }
    
                $data = array(
                    'user_id' => $user_id,
                    'Jenis' => 'pelatihan',
                    'Name' => $Name,
                    'Organizer' => $Organizer,
                    'Kota' => $City,
                    'Country' => $Country,
                    'StartMonth' => $StartMonth,
                    'StartYear' => $StartYear,
                    'Level' => $Level,
                    'Length' => $Length,
                    'Description' => $Description,
                    'File' => $filename,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
    
                $model->save($data);
                $session->setFlashdata('msg', 'Data Pendidikan/Pelatihan berhasil ditambah.');
                print_r($komp15);
    
                //return redirect()->to('/userfair15/docs');
            }else{
                $session = session();
                
                $model = new KompModel();
                $where = "komp_cat LIKE 'W.2%' OR komp_cat LIKE 'W.4%' OR komp_cat LIKE 'P.10%'";
                $data['data_komp'] = $model->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "I.5. Pendidikan/Pelatihan Teknik/Manajemen (W2,W4,P10)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Pelatihan Teknik</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahlatihuserfairvalid', $data);
            }
        }
    }

    public function hapuslatih($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new CapesSertModel();

        $latih = $model->find($id);
        $path = './uploads/docs/'.$latih['File'];
        if (is_file($path)){
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data Pendidikan/Pelatihan berhasil dihapus.');

        return redirect()->to('/userfair15/docs');   
    }

    public function ubahlatih($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        helper(['tanggal']);
        $model = new CapesSertModel();
        $latih = $model->where('Num', $id)->first();
        if ($latih){
            $data = [
                'Num' => $latih['Num'],
                'user_id' => $latih['user_id'],
                'Name' => $latih['Name'],
                'Organizer' => $latih['Organizer'],
                'Kota' => $latih['Kota'],
                'Country' => $latih['Country'],
                'StartYear' => $latih['StartYear'],
                'StartMonth' => $latih['StartMonth'],
                'Level' => $latih['Level'],
                'Length' =>  $latih['Length'],
                'Description' => $latih['Description'],
                'File' => $latih['File']
            ];
        }

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'W.2%' OR komp_cat LIKE 'W.4%' OR komp_cat LIKE 'P.10%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "I.5. Pendidikan/Pelatihan Teknik/Manajemen (W2,W4,P10)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Pelatihan Teknik</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahlatihuserfair', $data);
    }

    public function ubahlatihproses(){
        $session = session();
        $slug = new Slug();
        $model = new CapesSertModel();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        helper(['tanggal']);
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/userfair15/docs');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Pendidikan/Pelatihan harus diisi.',
                    ],
                ],
                'Organizer' => [
                    'label'  => 'Organizer',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Penyelenggara harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Lokasi Pelatihan harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Lokasi Pelatihan harus diisi.',
                    ],
                ],
                'StartMonth' => [
                    'label'  => 'StartMonth',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan harus diisi.',
                    ],
                ],
                'StartYear' => [
                    'label'  => 'StartYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun harus diisi.',
                    ],
                ],
                'Level' => [
                    'label'  => 'Level',
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
                $filename = $this->request->getVar('filename');
                $Name = $this->request->getVar('Name');
                $Organizer = $this->request->getVar('Organizer');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $StartMonth = $this->request->getVar('StartMonth');
                $StartYear = $this->request->getVar('StartYear');
                $Level = $this->request->getVar('Level');
                $Length = $this->request->getVar('Length');
                $Description = $this->request->getVar('Description');
                $File = $this->request->getFile('File');

                $namalatih = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if ((empty($filename))&&(!empty($ext))){
                    $filenamenew = $user_id.'_pelatihan_'.$namalatih.'.'.$ext;
                    $File->move('uploads/docs/',$filenamenew,true);
                } elseif ((!empty($filename))&&(!empty($ext))){
                    $oldext = substr($filename,-4);
                    if ($oldext == $ext){
                        $File->move('uploads/docs/',$filename,true);
                        $filenamenew = $filename;
                    }else{
                        $filenamenew = $user_id.'_pelatihan_'.$namalatih.'.'.$ext;
                        $File->move('uploads/docs/',$filenamenew,true);
                    }
                }else{
                    $filenamenew=$filename;
                }
    
                $data = array(
                    'Name' => $Name,
                    'Jenis' => 'pelatihan',
                    'Name' => $Name,
                    'Organizer' => $Organizer,
                    'Kota' => $City,
                    'Country' => $Country,
                    'StartMonth' => $StartMonth,
                    'StartYear' => $StartYear,
                    'Level' => $Level,
                    'Length' => $Length,
                    'Description' => $Description,
                    'File' => $filename,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data Pendidikan/Pelatihan berhasil diubah.');
    
                return redirect()->to('/userfair15/docs');
            }else{
                $latih = $model->where('Num', $Num)->first();
                if ($latih){
                    $data = [
                        'Num' => $latih['Num'],
                        'user_id' => $latih['user_id'],
                        'Name' => $latih['Name'],
                        'Organizer' => $latih['Organizer'],
                        'Kota' => $latih['Kota'],
                        'Country' => $latih['Country'],
                        'StartYear' => $latih['StartYear'],
                        'StartMonth' => $latih['StartMonth'],
                        'Level' => $latih['Level'],
                        'Length' =>  $latih['Length'],
                        'Description' => $latih['Description'],
                        'File' => $latih['File']
                    ];
                }

                $data['title_page'] = "I.5. Pendidikan/Pelatihan Teknik/Manajemen (W2,W4,P10)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Pelatihan Teknik</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahlatihuserfair', $data);
            }
        }        
    }
}