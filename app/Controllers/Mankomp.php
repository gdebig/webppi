<?php

namespace App\Controllers;

use App\Models\KompModel;

class Mankomp extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in)&&(!$issadmin)){
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        
        $komp_id = $session->get('komp_id');
        $model = new KompModel();
        $data['logged_in'] = $logged_in;
        $komp = $model->orderBy('komp_id', 'ASC')->findall();
        if (!empty($komp)){
            $data['data_komp'] = $komp;
        }else{
            $data['data_komp'] = 'kosong';
        }
        $data['title_page'] = "Data komp PPI";
        $data['data_bread'] = "komp";
        return view('maintemp/kompetensi', $data);
    }

    public function tambahkomp(){
        $session = session();
        $komp_id = $session->get('komp_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in)&&(!$issadmin)){
            return redirect()->to('/home');
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Tambah Data komp";
        $data['data_bread'] = "Tambah Data komp";
        $data['komp_id'] = $komp_id;
        return view('maintemp/tambahkomp', $data);
    }

    public function tambahkompproses(){
        
        $model = new KompModel();
        $session = session();
        $issadmin = $session->get('issadmin');
        $logged_in = $session->get('logged_in');
        if ((!$logged_in)&&(!$issadmin)){
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');
        if ($button=="batal"){
            return redirect()->to('/mankomp');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'code' => [
                    'label'  => 'code',
                    'rules'  => 'required|is_unique[tbl_kompetensi.komp_code]',
                    'errors' => [
                        'required' => 'Field Kode harus diisi',
                        'is_unique' => 'Kode yang digunakan sudah ada.',
                    ],
                ],
                'desc' => [
                    'label'  => 'desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Deskripsi harus diisi",
                    ]
                ],
                'cat' => [
                    'label'  => 'cat',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Kategori harus diisi",
                    ]
                ]
            ]);

            if ($formvalid){

                $code = $this->request->getVar('code');
                $desc = $this->request->getVar('desc');
                $cat = $this->request->getVar('cat');
                $parent = $this->request->getVar('parent');

                $datakomp = array(
                    'komp_code' => $code,
                    'komp_desc' => $desc,
                    'komp_cat' => $cat,
                    'komp_parent' => $parent,
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($datakomp);

                $session->setFlashdata('msg', 'Data komp berhasil ditambahkan.');
    
                return redirect()->to('/mankomp');
                
            }else{
                $komp_id = $session->get('komp_id');
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Tambah Data komp";
                $data['data_bread'] = "Tambah Data komp";
                $data['validation'] = $this->validator;
                $data['komp_id'] = $komp_id;
                return view('maintemp/tambahkompvalid', $data);
            }
        }
    }

    public function hapuskomp($id){
        $model = new KompModel();
        $session = session();
        $komp_id = $session->get('komp_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in)&&(!$issadmin)){
            return redirect()->to('/home');
        }
        $model->delete($id);
        return redirect()->to('/mankomp');
    }

    public function ubahkomp($id){
        $model = new KompModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in)&&(!$issadmin)){
            return redirect()->to('/home');
        }
        $komp = $model->where('komp_id', $id)->first();
        if ($komp){
            $data = [
                'komp_id' => $komp['komp_id'],
                'komp_code' => $komp['komp_code'],
                'komp_parent' => $komp['komp_parent'],
                'komp_desc' => $komp['komp_desc'],
                'komp_cat' => $komp['komp_cat']
            ];
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Ubah Data Kompetensi";
        $data['data_bread'] = "Ubah Data Kompetensi";
        return view('maintemp/ubahkomp', $data);
    }

    public function ubahkompproses(){
        $model = new KompModel();
        $session = session();
        $komp_id = $this->request->getVar('komp_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in)&&(!$issadmin)){
            return redirect()->to('/home');
        }

        $button=$this->request->getVar('submit');
        
        if ($button=="batal"){
            return redirect()->to('/mankomp');
        }else{
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'code' => [
                    'label'  => 'code',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kode harus diisi',
                        'is_unique' => 'Kode yang digunakan sudah ada.',
                    ],
                ],
                'desc' => [
                    'label'  => 'desc',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Deskripsi harus diisi",
                    ],
                ],
                'cat' => [
                    'label'  => 'cat',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Kategori harus diisi",
                    ],
                ],
            ]);

            if ($formvalid){

                $komp_id = $this->request->getVar('komp_id');
                $code = $this->request->getVar('code');
                $desc = $this->request->getVar('desc');
                $cat = $this->request->getVar('cat');
                $parent = $this->request->getVar('parent');

                $datakomp = array(
                    'komp_code' => $code,
                    'komp_desc' => $desc,
                    'komp_cat' => $cat,
                    'komp_parent' => $parent,
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->update($komp_id,$datakomp);

                $session->setFlashdata('msg', 'Data user berhasil diubah.');
    
                return redirect()->to('/mankomp');
            }else{
                $komp = $model->where('komp_id', $komp_id)->first();
                if ($komp){
                    $data = [
                        'komp_id' => $komp['komp_id'],
                        'komp_code' => $komp['komp_code'],
                        'komp_desc' => $komp['komp_desc'],
                        'komp_cat' => $komp['komp_cat'],
                        'komp_parent' => $komp['komp_parent']
                    ];
                }
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Ubah Data Kompetensi";
                $data['data_bread'] = "Ubah Data Kompetensi";
                $data['komp_id'] = $komp_id;
                $data['validation'] = $this->validator;
                return view('maintemp/ubahkomp', $data);
            }
        }
    }
}