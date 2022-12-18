<?php

namespace App\Controllers;

use App\Models\ConfigModel;

class Manconfig extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $model = new ConfigModel();
        $data['logged_in'] = $logged_in;
        $config = $model->orderBy('config_id', 'ASC')->findall();
        if (!empty($config)) {
            $data['data_config'] = $config;
        } else {
            $data['data_config'] = 'kosong';
        }
        $data['title_page'] = "Konfigurasi WEb";
        $data['data_bread'] = "Konfigurasi";
        return view('maintemp/konfigurasi', $data);
    }

    public function tambahconfig()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Tambah Data Konfigurasi";
        $data['data_bread'] = "Tambah Data Konfigurasi";
        return view('maintemp/tambahconfig', $data);
    }

    public function tambahconfigproses()
    {

        $model = new ConfigModel();
        $session = session();
        $issadmin = $session->get('issadmin');
        $logged_in = $session->get('logged_in');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');
        if ($button == "batal") {
            return redirect()->to('/manconfig');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'config_name' => [
                    'label'  => 'config_name',
                    'rules'  => 'required|is_unique[tbl_config.config_name]',
                    'errors' => [
                        'required' => 'Field Kode harus diisi',
                        'is_unique' => 'Kode yang digunakan sudah ada.',
                    ],
                ],
                'config_value' => [
                    'label'  => 'config_value',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Value harus diisi",
                    ]
                ]
            ]);

            if ($formvalid) {

                $config_name = $this->request->getVar('config_name');
                $config_value = $this->request->getVar('config_value');

                $dataconfig = array(
                    'config_name' => $config_name,
                    'config_value' => $config_value,
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($dataconfig);

                $session->setFlashdata('msg', 'Data Konfigurasi berhasil ditambahkan.');

                return redirect()->to('/manconfig');
            } else {
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Tambah Data Konfigurasi";
                $data['data_bread'] = "Tambah Data Konfigurasi";
                $data['validation'] = $this->validator;
                return view('maintemp/tambahconfigvalid', $data);
            }
        }
    }

    public function hapusconfig($id)
    {
        $model = new ConfigModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $model->delete($id);
        return redirect()->to('/manconfig');
    }

    public function ubahconfig($id)
    {
        $model = new ConfigModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $config = $model->where('config_id', $id)->first();
        if ($config) {
            $data = [
                'config_id' => $config['config_id'],
                'config_name' => $config['config_name'],
                'config_value' => $config['config_value']
            ];
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Ubah Data Konfigurasi";
        $data['data_bread'] = "Ubah Data Konfigurasi";
        return view('maintemp/ubahconfig', $data);
    }

    public function ubahconfigproses()
    {
        $model = new ConfigModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');
        $config_id = $this->request->getVar('config_id');

        if ($button == "batal") {
            return redirect()->to('/manconfig');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'config_name' => [
                    'label'  => 'config_name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kode harus diisi',
                        'is_unique' => 'Kode yang digunakan sudah ada.',
                    ],
                ],
                'config_value' => [
                    'label'  => 'config_value',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Value harus diisi",
                    ],
                ]
            ]);

            if ($formvalid) {

                $config_id = $this->request->getVar('config_id');
                $config_name = $this->request->getVar('config_name');
                $config_value = $this->request->getVar('config_value');

                $dataconfig = array(
                    'config_name' => $config_name,
                    'config_value' => $config_value,
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->update($config_id, $dataconfig);

                $session->setFlashdata('msg', 'Data Konfigurasi berhasil diubah.');

                return redirect()->to('/manconfig');
            } else {
                $config = $model->where('config_id', $config_id)->first();
                if ($config) {
                    $data = [
                        'config_id' => $config['config_id'],
                        'config_name' => $config['config_name'],
                        'config_value' => $config['config_value']
                    ];
                }
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Ubah Data Konfigurasi";
                $data['data_bread'] = "Ubah Data Konfigurasi";
                $data['validation'] = $this->validator;
                return view('maintemp/ubahconfig', $data);
            }
        }
    }
}
