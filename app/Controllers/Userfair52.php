<?php

namespace App\Controllers;

use App\Models\CapesSemModel;
use App\Libraries\Slug;

class Userfair52 extends BaseController
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
        $model = new CapesSemModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $sem = $model->where('user_id', $user_id)->where('Type', 'Sem')->orderby('Year', 'DESC')->findall();
        if (!empty($sem)){
            $data['data_sem'] = $sem;
        }else{
            $data['data_sem'] = 'kosong';
        }

        $data['title_page'] = "V.2. Makalah/Tulisan Yang Disajikan Dalam Seminar/Lokakarya Keinsinyuran (W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Makalah</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok52', $data);
    }

    public function tambahseminar(){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }

        $data['title_page'] = "V.2. Makalah/Tulisan Yang Disajikan Dalam Seminar/Lokakarya Keinsinyuran (W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Makalah</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/tambahseminar', $data);
    }

    public function tambahsemproses(){
        $session = session();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new CapesSemModel();
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/userfair52/docs');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'PaperName' => [
                    'label'  => 'PaperName',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Makalah/Tulisan harus diisi.',
                    ],
                ],
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Seminar/Lokakarya harus diisi.',
                    ],
                ],
                'Organizer' => [
                    'label'  => 'Organizer',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Penyelenggara harus diisi.',
                    ],
                ],
                'LocCity' => [
                    'label'  => 'LocCity',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota harus diisi.',
                    ],
                ],
                'LocCountry' => [
                    'label'  => 'LocCountry',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara harus diisi.',
                    ],
                ],
                'Month' => [
                    'label'  => 'Month',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan harus diisi.',
                    ],
                ],
                'Year' => [
                    'label'  => 'Year',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun harus diisi.',
                    ],
                ],
                'Level' => [
                    'label'  => 'Level',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Seminar/Lokakarya Tingkat harus diisi.',
                    ],
                ],
                'DiffBenefit' => [
                    'label'  => 'DiffBenefit',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tingkat Kesulitan dan Manfaat harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
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
                $PaperName = $this->request->getVar('PaperName');
                $Name = $this->request->getVar('Name');
                $Organizer = $this->request->getVar('Organizer');
                $LocCity = $this->request->getVar('LocCity');
                $LocCountry = $this->request->getVar('LocCountry');
                $Month = $this->request->getVar('Month');
                $Year = $this->request->getVar('Year');
                $Level = $this->request->getVar('Level');
                $DiffBenefit = $this->request->getVar('DiffBenefit');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');
                
                $namaseminar = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if (!empty($ext)){
                    $random = bin2hex(random_bytes(4));
                    $filename = $user_id.'_seminar_'.$namaseminar.'_'.$random.'.'.$ext;
                    $File->move('uploads/docs/',$filename,true);
                }else{
                    $filename="";
                }
    
                $data = array(
                    'user_id' => $user_id,
                    'Type' => 'Sem',
                    'PaperName' => $PaperName,
                    'Name' => $Name,
                    'Organizer' => $Organizer,
                    'LocCity' => $LocCity,
                    'LocCountry' => $LocCountry,
                    'Year' => $Year,
                    'Month' => $Month,
                    'Level' => $Level,
                    'DiffBenefit' => $DiffBenefit,
                    'Desc' => $Desc,
                    'File' => $filename,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );
    
                $model->save($data);
                $session->setFlashdata('msg', 'Data Seminar berhasil ditambah.');
    
                return redirect()->to('/userfair52/docs');
            }else{

                $data['title_page'] = "V.2. Makalah/Tulisan Yang Disajikan Dalam Seminar/Lokakarya Keinsinyuran (W4)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Makalah</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahsemvalid', $data);
            }
        }
    }

    public function hapussem($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new CapesSemModel();

        $sem = $model->find($id);
        $path = './uploads/docs/'.$sem['File'];
        if (is_file($path)){
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data Seminar berhasil dihapus.');

        return redirect()->to('/userfair52/docs');   
    }

    public function ubahsem($id){
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new CapesSemModel();
        $sem = $model->where('Num', $id)->first();
        if ($sem){
            $data = [
                'Num' => $sem['Num'],
                'user_id' => $sem['user_id'],
                'PaperName' => $sem['PaperName'],
                'Name' => $sem['Name'],
                'Organizer' => $sem['Organizer'],
                'LocCity' => $sem['LocCity'],
                'LocCountry' => $sem['LocCountry'],
                'Year' => $sem['Year'],
                'Month' => $sem['Month'],
                'Level' => $sem['Level'],
                'DiffBenefit' => $sem['DiffBenefit'],
                'Desc' => $sem['Desc'],
                'File' => $sem['File']
            ];
        }

        $data['title_page'] = "V.2. Makalah/Tulisan Yang Disajikan Dalam Seminar/Lokakarya Keinsinyuran (W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Makalah</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahsem', $data);
    }

    public function ubahsemproses(){
        $session = session();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in)&&(!$ispeserta)){
            return redirect()->to('/home');
        }else{
            $session->set('role', 'peserta');
        }
        $model = new CapesSemModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/userfair52/docs');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'PaperName' => [
                    'label'  => 'PaperName',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Judul Makalah/Tulisan harus diisi.',
                    ],
                ],
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Seminar/Lokakarya harus diisi.',
                    ],
                ],
                'Organizer' => [
                    'label'  => 'Organizer',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Penyelenggara harus diisi.',
                    ],
                ],
                'LocCity' => [
                    'label'  => 'LocCity',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kota harus diisi.',
                    ],
                ],
                'LocCountry' => [
                    'label'  => 'LocCountry',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Negara harus diisi.',
                    ],
                ],
                'Month' => [
                    'label'  => 'Month',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Bulan harus diisi.',
                    ],
                ],
                'Year' => [
                    'label'  => 'Year',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tahun harus diisi.',
                    ],
                ],
                'Level' => [
                    'label'  => 'Level',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Seminar/Lokakarya Tingkat harus diisi.',
                    ],
                ],
                'DiffBenefit' => [
                    'label'  => 'DiffBenefit',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tingkat Kesulitan dan Manfaat harus diisi.',
                    ],
                ],
                'Desc' => [
                    'label'  => 'Desc',
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
                $PaperName = $this->request->getVar('PaperName');
                $Name = $this->request->getVar('Name');
                $Organizer = $this->request->getVar('Organizer');
                $LocCity = $this->request->getVar('LocCity');
                $LocCountry = $this->request->getVar('LocCountry');
                $Month = $this->request->getVar('Month');
                $Year = $this->request->getVar('Year');
                $Level = $this->request->getVar('Level');
                $DiffBenefit = $this->request->getVar('DiffBenefit');
                $Desc = $this->request->getVar('Desc');
                $File = $this->request->getFile('File');

                $namaseminar = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if ((empty($filename))&&(!empty($ext))){
                    $random = bin2hex(random_bytes(4));
                    $filenamenew = $user_id.'_seminar_'.$namaseminar.'_'.$random.'.'.$ext;
                    $File->move('uploads/docs/',$filenamenew,true);
                } elseif ((!empty($filename))&&(!empty($ext))){
                    $oldext = substr($filename,-4);
                    if ($oldext == $ext){
                        $File->move('uploads/docs/',$filename,true);
                        $filenamenew = $filename;
                    }else{
                        $random = bin2hex(random_bytes(4));
                        $filenamenew = $user_id.'_seminar_'.$namaseminar.'_'.$random.'.'.$ext;
                        $File->move('uploads/docs/',$filenamenew,true);
                    }
                }else{
                    $filenamenew=$filename;
                }
    
                $data = array(
                    'Type' => 'Sem',
                    'PaperName' => $PaperName,
                    'Name' => $Name,
                    'Organizer' => $Organizer,
                    'LocCity' => $LocCity,
                    'LocCountry' => $LocCountry,
                    'Year' => $Year,
                    'Month' => $Month,
                    'Level' => $Level,
                    'DiffBenefit' => $DiffBenefit,
                    'Desc' => $Desc,
                    'File' => $filenamenew,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data Seminar berhasil diubah.');
    
                return redirect()->to('/userfair52/docs');
            }else{
                $sem = $model->where('Num', $Num)->first();
                if ($sem){
                    $data = [
                        'Num' => $sem['Num'],
                        'user_id' => $sem['user_id'],
                        'PaperName' => $sem['PaperName'],
                        'Name' => $sem['Name'],
                        'Organizer' => $sem['Organizer'],
                        'LocCity' => $sem['LocCity'],
                        'LocCountry' => $sem['LocCountry'],
                        'Year' => $sem['Year'],
                        'Month' => $sem['Month'],
                        'Level' => $sem['Level'],
                        'DiffBenefit' => $sem['DiffBenefit'],
                        'Desc' => $sem['Desc'],
                        'File' => $sem['File']
                    ];
                }

                $data['title_page'] = "V.2. Makalah/Tulisan Yang Disajikan Dalam Seminar/Lokakarya Keinsinyuran (W4)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="'.base_url()."/userfair".'">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Makalah</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahsem', $data);
            }
        }        
    }
}