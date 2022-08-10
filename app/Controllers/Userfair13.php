<?php

namespace App\Controllers;

use App\Models\CapesOrgModel;
use App\Libraries\Slug;

class Userfair13 extends BaseController
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
        $model = new CapesOrgModel();
        $org = $model->where('user_id', $user_id)->orderby('StartPeriodYear','DESC')->findall();
        if (!empty($org)){
            $data['data_org'] = $org;
        }else{
            $data['data_org'] = 'kosong';
        }
        $data['title_page'] = "I.3. Organisasi Profesi & Organisasi Lainnya Yang Dimasuki (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Organisasi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok13', $data);
    }

    public function tambahorganisasi(){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        helper(['tanggal']);
        $data['title_page'] = "I.3. Organisasi Profesi & Organisasi Lainnya Yang Dimasuki (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Organisasi</li>';
        $data['logged_in'] = $session->get('logged_in');;
        return view('maintemp/tambahorguserfair', $data);
    }

    public function tambahorgproses(){
        $session = session();
        $model = new CapesOrgModel();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $user_id = $session->get('user_id');
        helper(['tanggal']);

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/userfair13/docs');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Organisasi harus diisi.',
                    ],
                ],
                'Type' => [
                    'label'  => 'Type',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jenis Organisasi harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Organisasi harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Organisasi harus diisi.',
                    ],
                ],
                'StartPeriodBulan' => [
                    'label'  => 'StartPeriodBulan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan Mulai harus diisi.',
                    ],
                ],
                'StartPeriodYear' => [
                    'label'  => 'StartPeriodYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Mulai harus diisi.',
                    ],
                ],
                'EndPeriodBulan' => [
                    'label'  => 'EndPeriodBulan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan Berakhir harus diisi.',
                    ],
                ],
                'EndPeriodYear' => [
                    'label'  => 'EndPeriodYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Berakhir harus diisi.',
                    ],
                ],
                'Period' => [
                    'label'  => 'Period',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Sudah Berapa Lama Menjadi Anggota harus diisi.',
                    ],
                ],
                'Position' => [
                    'label'  => 'Position',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jabatan Dalam Organisasi harus diisi.',
                    ],
                ],
                'OrgLevel' => [
                    'label'  => 'OrgLevel',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tingkat Organisasi harus diisi.',
                    ],
                ],
                'OrgScp' => [
                    'label'  => 'OrgScp',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Lingkup Kegiatan Organisasi harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Uraian Aktifitas Dalam Organisasi harus diisi.',
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
                $Type = $this->request->getVar('Type');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $StartPeriodBulan = $this->request->getVar('StartPeriodBulan');
                $StartPeriodYear = $this->request->getVar('StartPeriodYear');
                $EndPeriodBulan = $this->request->getVar('EndPeriodBulan');
                $EndPeriodYear = $this->request->getVar('EndPeriodYear');
                $Period = $this->request->getVar('Period');
                $Position = $this->request->getVar('Position');
                $OrgLevel = $this->request->getVar('OrgLevel');
                $OrgScp = $this->request->getVar('OrgScp');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                
                $namaorganisasi = $slug->slugify($Name);
                $posisi = $slug->slugify($Position);
                $ext = $File->getClientExtension();
                if (!empty($ext)){
                    $filename = $user_id.'_organisasi_'.$namaorganisasi.'_'.$posisi.'.'.$ext;
                    $File->move('uploads/docs/',$filename,true);
                }else{
                    $filename="";
                }
    
                $data = array(
                    'user_id' => $user_id,
                    'Name' => $Name,
                    'Type' => $Type,
                    'City' => $City,
                    'Country' => $Country,
                    'Period' => $Period,
                    'StartPeriodBulan' => $StartPeriodBulan,
                    'StartPeriodYear' => $StartPeriodYear,
                    'EndPeriodBulan' => $EndPeriodBulan,
                    'EndPeriodYear' => $EndPeriodYear,
                    'Position' => $Position,
                    'OrgLevel' => $OrgLevel,
                    'OrgScp' => $OrgScp,
                    'Desc' => $Desc,
                    'File' => $filename,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
    
                $model->save($data);
                $session->setFlashdata('msg', 'Data Organisasi berhasil ditambah.');
    
                return redirect()->to('/userfair13/docs');
            }else{
                $session = session();
                $data['title_page'] = "I.3. Organisasi Profesi & Organisasi Lainnya Yang Dimasuki (W1)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Organisasi</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahorguserfairvalid', $data);
            }
        }
    }

    public function hapusorg($id){
        $session = session();
        $model = new CapesOrgModel();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        helper(['tanggal']);

        $org = $model->find($id);
        $path = './uploads/docs/'.$org['File'];
        if (is_file($path)){
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data Organisasi berhasil dihapus.');

        return redirect()->to('/userfair13/docs');   
    }

    public function ubahorg($id){
        $session = session();
        $model = new CapesOrgModel();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        helper(['tanggal']);

        $org = $model->where('Num', $id)->first();
        if ($org){
            $data = [
                'Num' => $org['Num'],
                'user_id' => $org['user_id'],
                'Name' => $org['Name'],
                'Type' => $org['Type'],
                'City' => $org['City'],
                'Country' => $org['Country'],
                'Period' => $org['Period'],
                'StartPeriodBulan' => $org['StartPeriodBulan'],
                'StartPeriodYear' => $org['StartPeriodYear'],
                'EndPeriodBulan' =>  $org['EndPeriodBulan'],
                'EndPeriodYear' => $org['EndPeriodYear'],
                'Position' => $org['Position'],
                'OrgLevel' => $org['OrgLevel'],
                'OrgScp' => $org['OrgScp'],
                'Desc' => $org['Desc'],
                'File' => $org['File']
            ];
        }
        $data['title_page'] = "I.3. Organisasi Profesi & Organisasi Lainnya Yang Dimasuki (W1)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Organisasi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahorguserfair', $data);
    }

    public function ubahorgproses(){
        $session = session();
        $slug = new Slug();
        $model = new CapesOrgModel();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        helper(['tanggal']);
        $Num = $this->request->getVar('Num');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/userfair13/docs');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Organisasi harus diisi.',
                    ],
                ],
                'Type' => [
                    'label'  => 'Type',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jenis Organisasi harus diisi.',
                    ],
                ],
                'City' => [
                    'label'  => 'City',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota Organisasi harus diisi.',
                    ],
                ],
                'Country' => [
                    'label'  => 'Country',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara Organisasi harus diisi.',
                    ],
                ],
                'StartPeriodBulan' => [
                    'label'  => 'StartPeriodBulan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan Mulai harus diisi.',
                    ],
                ],
                'StartPeriodYear' => [
                    'label'  => 'StartPeriodYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Mulai harus diisi.',
                    ],
                ],
                'EndPeriodBulan' => [
                    'label'  => 'EndPeriodBulan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan Berakhir harus diisi.',
                    ],
                ],
                'EndPeriodYear' => [
                    'label'  => 'EndPeriodYear',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun Berakhir harus diisi.',
                    ],
                ],
                'Period' => [
                    'label'  => 'Period',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Sudah Berapa Lama Menjadi Anggota harus diisi.',
                    ],
                ],
                'Position' => [
                    'label'  => 'Position',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Jabatan Dalam Organisasi harus diisi.',
                    ],
                ],
                'OrgLevel' => [
                    'label'  => 'OrgLevel',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tingkat Organisasi harus diisi.',
                    ],
                ],
                'OrgScp' => [
                    'label'  => 'OrgScp',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Lingkup Kegiatan Organisasi harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Uraian Aktifitas Dalam Organisasi harus diisi.',
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
                $Type = $this->request->getVar('Type');
                $City = $this->request->getVar('City');
                $Country = $this->request->getVar('Country');
                $StartPeriodBulan = $this->request->getVar('StartPeriodBulan');
                $StartPeriodYear = $this->request->getVar('StartPeriodYear');
                $EndPeriodBulan = $this->request->getVar('EndPeriodBulan');
                $EndPeriodYear = $this->request->getVar('EndPeriodYear');
                $Period = $this->request->getVar('Period');
                $Position = $this->request->getVar('Position');
                $OrgLevel = $this->request->getVar('OrgLevel');
                $OrgScp = $this->request->getVar('OrgScp');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');

                $namaorganisasi = $slug->slugify($Name);
                $posisi = $slug->slugify($Position);
                $ext = $File->getClientExtension();
                if ((empty($filename))&&(!empty($ext))){
                    $filenamenew = $user_id.'_organisasi_'.$namaorganisasi.'_'.$posisi.'.'.$ext;
                    $File->move('uploads/docs/',$filenamenew,true);
                } elseif ((!empty($filename))&&(!empty($ext))){
                    $oldext = substr($filename,-4);
                    if ($oldext == $ext){
                        $File->move('uploads/docs/',$filename,true);
                        $filenamenew = $filename;
                    }else{
                        $filenamenew = $user_id.'_organisasi_'.$namaorganisasi.'_'.$posisi.'.'.$ext;
                        $File->move('uploads/docs/',$filenamenew,true);
                    }
                }else{
                    $filenamenew=$filename;
                }
    
                $data = array(
                    'Name' => $Name,
                    'Type' => $Type,
                    'City' => $City,
                    'Country' => $Country,
                    'Period' => $Period,
                    'StartPeriodBulan' => $StartPeriodBulan,
                    'StartPeriodYear' => $StartPeriodYear,
                    'EndPeriodBulan' => $EndPeriodBulan,
                    'EndPeriodYear' => $EndPeriodYear,
                    'Position' => $Position,
                    'OrgLevel' => $OrgLevel,
                    'OrgScp' => $OrgScp,
                    'Desc' => $Desc,
                    'File' => $filenamenew,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data Organisasi berhasil diubah.');
    
                return redirect()->to('/userfair13/docs');
            }else{
                $session = session();
                $model = new CapesOrgModel();
                $org = $model->where('Num', $Num)->first();
                if ($org){
                    $data = [
                        'Num' => $org['Num'],
                        'user_id' => $org['user_id'],
                        'Name' => $org['Name'],
                        'Type' => $org['Type'],
                        'City' => $org['City'],
                        'Country' => $org['Country'],
                        'Period' => $org['Period'],
                        'StartPeriodBulan' => $org['StartPeriodBulan'],
                        'StartPeriodYear' => $org['StartPeriodYear'],
                        'EndPeriodBulan' =>  $org['EndPeriodBulan'],
                        'EndPeriodYear' => $org['EndPeriodYear'],
                        'Position' => $org['Position'],
                        'OrgLevel' => $org['OrgLevel'],
                        'OrgScp' => $org['OrgScp'],
                        'Desc' => $kerja['Desc'],
                        'File' => $kerja['File']
                    ];
                }
                $data['title_page'] = "I.3. Organisasi Profesi & Organisasi Lainnya Yang Dimasuki (W1)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Organisasi</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahorguserfair', $data);
            }
        }        
    }
}