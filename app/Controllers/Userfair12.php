<?php

namespace App\Controllers;

use App\Models\CapesPendModel;

class Userfair12 extends BaseController
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
        $model = new CapesPendModel();
        
        $pend = $model->where('user_id', $user_id)->orderby('GradYear','DESC')->findall();
        if (!empty($pend)){
            $data['data_pend'] = $pend;
        }else{
            $data['data_pend'] = 'kosong';
        }

        $data['title_page'] = "I.2. Pendidikan Formal (W2)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Pendidikan Formal</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok12', $data);
    }

    public function tambahpendidikan(){
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
        $model = new CapesPendModel();

        $data['title_page'] = "I.2. Pendidikan Formal (W2)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Pendidikan Formal</li>';
        $data['logged_in'] = $session->get('logged_in');
        $data['user_id'] = $user_id;
        return view('maintemp/tambahpendfairuser', $data);
    }

    public function tambahpendproses(){
        $session = session();
        $model = new CapesPendModel();
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

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/userfair12/docs');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'jenjang' => [
                    'label'  => 'jenjang',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jenjang Pendidikan harus diisi.',
                    ],
                ],
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Perguruan Tinggi harus diisi.',
                    ],
                ],
                'Faculty' => [
                    'label'  => 'Faculty',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Fakultas harus diisi.',
                    ],
                ],
                'Major' => [
                    'label'  => 'Major',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jurusan harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Perguruan Tinggi harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Perguruan Tinggi harus diisi.',
                    ],
                ],
                'GradYear' => [
                    'label'  => 'GradYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Kelulusan harus diisi.',
                    ],
                ],
                'Degree' => [
                    'label'  => 'Degree',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Gelar harus diisi.',
                    ],
                ],
                'Title' => [
                    'label'  => 'Title',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Tugas Akhir harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Uraian Singkat Tugas Akhir harus diisi.',
                    ],
                ],
                'Mark' => [
                    'label'  => 'Mark',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nilai Akademik Rata-rata harus diisi.',
                    ],
                ],
                'Judicium' => [
                    'label'  => 'Judicium',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Yudisium harus diisi.',
                    ],
                ],
                'ijazah' => [
                    'rules'  => 'uploaded[ijazah]|ext_in[ijazah,jpg,jpeg,png,pdf]|max_size[ijazah, 700]',
                    'errors' => [
                        'uploaded' => 'Field Unggah Scan Ijazah tidak boleh kosong',
                        'ext_in' => "Hanya menerima file PDF, JPG, JPEG atau PNG",
                        'max_size' => "Ukuran File Maksimal 700KB"
                    ],
                ]
            ]);

            if ($formvalid){
                $jenjang = $this->request->getVar('jenjang');
                $Name = $this->request->getVar('Name');
                $Faculty = $this->request->getVar('Faculty');
                $Major = $this->request->getVar('Major');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $GradYear = $this->request->getVar('GradYear');
                $Degree = $this->request->getVar('Degree');
                $Title = $this->request->getVar('Title');
                $Desc = $this->request->getVar('Desc');
                $Mark = $this->request->getVar('Mark');
                $Judicium = $this->request->getVar('Judicium');
                $ijazah = $this->request->getFile('ijazah');

                $ext = $ijazah->getClientExtension();
                $filename = $user_id.'_ijazah_'.$jenjang.'.'.$ext;
                $ijazah->move('uploads/docs/',$filename,true);
    
                $data = array(
                    'user_id' => $user_id,
                    'Rank' => $jenjang,
                    'Name' => $Name,
                    'Faculty' => $Faculty,
                    'Major' => $Major,
                    'City' => $City,
                    'Country' => $Country,
                    'GradYear' => $GradYear,
                    'Degree' => $Degree,
                    'Title' => $Title,
                    'Desc' => $Desc,
                    'Mark' => $Mark,
                    'Judicium' => $Judicium,
                    'File' => $filename,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
    
                $model->save($data);
                $session->setFlashdata('msg', 'Data Pendidikan berhasil ditambah.');
    
                return redirect()->to('/userfair12/docs');
            }else{
                $data['title_page'] = "I.2. Pendidikan Formal (W2)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Pendidikan Formal</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['user_id'] = $user_id;
                $data['validation'] = $this->validator;
                return view('maintemp/tambahpendfairuservalid', $data);
            }
        }        
    }

    public function hapuspendidikan($id){
        $session = session();
        $model = new CapesPendModel();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        helper(['tanggal']);

        $ijazah = $model->find($id);
        $path = './uploads/docs/'.$ijazah['File'];
        if (is_file($path)){
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data pendidikan berhasil dihapus.');

        return redirect()->to('/userfair12/docs');        
    }

    public function ubahpendidikan($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        helper(['tanggal']);
        $model = new CapesPendModel();
        $pend = $model->where('Num', $id)->first();
        if ($pend){
            $data = [
                'Num' => $pend['Num'],
                'user_id' => $pend['user_id'],
                'Rank' => $pend['Rank'],
                'Name' => $pend['Name'],
                'Faculty' => $pend['Faculty'],
                'Major' => $pend['Major'],
                'City' => $pend['City'],
                'Country' => $pend['Country'],
                'GradYear' => $pend['GradYear'],
                'Degree' => $pend['Degree'],
                'Title' => $pend['Title'],
                'Desc' => $pend['Desc'],
                'Mark' => $pend['Mark'],
                'Judicium' => $pend['Judicium'],
                'File' => $pend['File']
            ];
        }
        $data['title_page'] = "I.2. Pendidikan Formal (W2)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Pendidikan Formal</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahpenduserfair', $data);
    }

    public function ubahpendproses(){
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
        $model = new CapesPendModel();
        $pend_id = $this->request->getVar('pend_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/userfair12/docs');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'jenjang' => [
                    'label'  => 'jenjang',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jenjang Pendidikan harus diisi.',
                    ],
                ],
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Perguruan Tinggi harus diisi.',
                    ],
                ],
                'Faculty' => [
                    'label'  => 'Faculty',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Fakultas harus diisi.',
                    ],
                ],
                'Major' => [
                    'label'  => 'Major',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jurusan harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Perguruan Tinggi harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Perguruan Tinggi harus diisi.',
                    ],
                ],
                'GradYear' => [
                    'label'  => 'GradYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Kelulusan harus diisi.',
                    ],
                ],
                'Degree' => [
                    'label'  => 'Degree',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Gelar harus diisi.',
                    ],
                ],
                'Title' => [
                    'label'  => 'Title',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Tugas Akhir harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Uraian Singkat Tugas Akhir harus diisi.',
                    ],
                ],
                'Mark' => [
                    'label'  => 'Mark',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nilai Akademik Rata-rata harus diisi.',
                    ],
                ],
                'Judicium' => [
                    'label'  => 'Judicium',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Yudisium harus diisi.',
                    ],
                ],
                'ijazah' => [
                    'rules'  => 'ext_in[ijazah,jpg,jpeg,png,pdf]|max_size[ijazah, 700]',
                    'errors' => [
                        'uploaded' => 'Field Unggah Scan Ijazah tidak boleh kosong',
                        'ext_in' => "Hanya menerima file PDF, JPG, JPEG atau PNG",
                        'max_size' => "Ukuran File Maksimal 700KB"
                    ],
                ]
            ]);

            if ($formvalid){
                $filename = $this->request->getVar('filename');
                $jenjang = $this->request->getVar('jenjang');
                $Name = $this->request->getVar('Name');
                $Faculty = $this->request->getVar('Faculty');
                $Major = $this->request->getVar('Major');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $GradYear = $this->request->getVar('GradYear');
                $Degree = $this->request->getVar('Degree');
                $Title = $this->request->getVar('Title');
                $Desc = $this->request->getVar('Desc');
                $Mark = $this->request->getVar('Mark');
                $Judicium = $this->request->getVar('Judicium');
                $ijazah = $this->request->getFile('ijazah');

                $ext = $ijazah->getClientExtension();
                if ((empty($filename))&&(!empty($ext))){
                    $filenamenew = $user_id.'_ijazah_'.$jenjang.'.'.$ext;
                    $ijazah->move('uploads/docs/',$filenamenew,true);
                } elseif ((!empty($filename))&&(!empty($ext))){
                    $oldext = substr($filename, -4);
                    if ($oldext == $ext){
                        $ijazah->move('uploads/docs/',$filename,true);
                        $filenamenew = $filename;
                    }else{
                        $filenamenew = $user_id.'_ijazah_'.$jenjang.'.'.$ext;
                        $ijazah->move('uploads/docs/',$filenamenew,true);
                    }
                }else{
                    $filenamenew=$filename;
                }
    
                $data = array(
                    'Rank' => $jenjang,
                    'Name' => $Name,
                    'Faculty' => $Faculty,
                    'Major' => $Major,
                    'City' => $City,
                    'Country' => $Country,
                    'GradYear' => $GradYear,
                    'Degree' => $Degree,
                    'Title' => $Title,
                    'Desc' => $Desc,
                    'Mark' => $Mark,
                    'Judicium' => $Judicium,
                    'File' => $filenamenew,
                    'date_modified' => date('Y-m-d')
                );
    
                $model->update($pend_id, $data);
                $session->setFlashdata('msg', 'Data Pendidikan berhasil diubah.');
    
                return redirect()->to('/userfair12/docs');
            }else{
                $session = session();
                $model = new CapesPendModel();
                $pend = $model->where('Num', $pend_id)->first();
                if ($pend){
                    $data = [
                        'Num' => $pend['Num'],
                        'user_id' => $pend['user_id'],
                        'Rank' => $pend['Rank'],
                        'Name' => $pend['Name'],
                        'Faculty' => $pend['Faculty'],
                        'Major' => $pend['Major'],
                        'City' => $pend['City'],
                        'Country' => $pend['Country'],
                        'GradYear' => $pend['GradYear'],
                        'Degree' => $pend['Degree'],
                        'Title' => $pend['Title'],
                        'Desc' => $pend['Desc'],
                        'Mark' => $pend['Mark'],
                        'Judicium' => $pend['Judicium'],
                        'File' => $pend['File']
                    ];
                }
                $data['title_page'] = "I.2. Pendidikan Formal (W2)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Pendidikan Formal</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahpenduserfair', $data);
            }
        }        
    }

}