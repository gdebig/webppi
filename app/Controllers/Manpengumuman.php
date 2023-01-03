<?php

namespace App\Controllers;

use App\Models\UmumModel;

use App\Libraries\Slug;

class Manpengumuman extends BaseController
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

        $model = new UmumModel();
        $data['logged_in'] = $logged_in;
        $umum = $model->orderBy('umum_id', 'DESC')->findall();
        if (!empty($umum)) {
            $data['data_umum'] = $umum;
        } else {
            $data['data_umum'] = 'kosong';
        }
        $data['title_page'] = "Pengumuman";
        $data['data_bread'] = "Pengumuman";
        return view('maintemp/pengumuman', $data);
    }

    public function tambahumum()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Tambah Data Pengumuman";
        $data['data_bread'] = "Tambah Data Pengumuman";
        return view('maintemp/tambahumum', $data);
    }

    public function tambahumumproses()
    {

        $slug = new Slug();
        $session = session();
        $issadmin = $session->get('issadmin');
        $logged_in = $session->get('logged_in');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');
        if ($button == "batal") {
            return redirect()->to('/manpengumuman');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'umum_name' => [
                    'label'  => 'Nama Pengumuman',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Pengumuman harus diisi',
                    ],
                ],
                'umum_desc' => [
                    'label'  => 'Deskripsi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Deskripsi harus diisi",
                    ]
                ],
                'umum_tujuan' => [
                    'label'  => 'Target Pengumuman',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Target Pengumuman harus diisi",
                    ]
                ],
                'file' => [
                    'rules'  => 'ext_in[file,jpg,jpeg,png,pdf]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF, JPG, JPEG atau PNG"
                    ],
                ]
            ]);

            if ($formvalid) {

                $model = new UmumModel();

                $umum_name = $this->request->getVar('umum_name');
                $umum_desc = $this->request->getVar('umum_desc');
                $file = $this->request->getFile('file');
                $umum_tujuan = $this->request->getVar('umum_tujuan');

                $ext = $file->getClientExtension();
                if (!empty($ext)) {
                    $random = bin2hex(random_bytes(4));
                    $namaumum = $slug->slugify($umum_name);
                    $filename = $random . '_' . $namaumum . '.' . $ext;
                    $file->move('uploads/umum/', $filename, true);
                } else {
                    $filename = '';
                }

                $dataumum = array(
                    'umum_name' => $umum_name,
                    'umum_desc' => $umum_desc,
                    'umum_file' => $filename,
                    'umum_tujuan' => $umum_tujuan,
                    'umum_softdelete' => 'Tidak',
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($dataumum);

                $session->setFlashdata('msg', 'Data umum berhasil ditambahkan.');

                return redirect()->to('/Manpengumuman');
            } else {
                $umum_id = $session->get('umum_id');
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Tambah Data umum";
                $data['data_bread'] = "Tambah Data umum";
                $data['validation'] = $this->validator;
                $data['umum_id'] = $umum_id;
                return view('maintemp/tambahumumvalid', $data);
            }
        }
    }

    public function hapusumum($id)
    {
        $model = new UmumModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $model->delete($id);

        $session->setFlashdata('msg', 'Data umum berhasil dihapus.');

        return redirect()->to('/Manpengumuman');
    }

    public function ubahumum($id)
    {
        $model = new UmumModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $umum = $model->where('umum_id', $id)->first();
        if ($umum) {
            $data = [
                'umum_id' => $umum['umum_id'],
                'umum_name' => $umum['umum_name'],
                'umum_desc' => $umum['umum_desc'],
                'umum_file' => $umum['umum_file'],
                'umum_tujuan' => $umum['umum_tujuan']
            ];
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Ubah Data Pengumuman";
        $data['data_bread'] = "Ubah Data Pengumuman";
        return view('maintemp/ubahumum', $data);
    }

    public function ubahumumproses()
    {
        $model = new UmumModel();
        $session = session();
        $umum_id = $this->request->getVar('umum_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/Manpengumuman');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'umum_name' => [
                    'label'  => 'Nama Pengumuman',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Pengumuman harus diisi',
                    ],
                ],
                'umum_desc' => [
                    'label'  => 'Deskripsi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Deskripsi harus diisi",
                    ]
                ],
                'umum_tujuan' => [
                    'label'  => 'Target Pengumuman',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Target Pengumuman harus diisi",
                    ]
                ],
                'file' => [
                    'rules'  => 'ext_in[file,jpg,jpeg,png,pdf]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file PDF, JPG, JPEG atau PNG"
                    ],
                ]
            ]);

            if ($formvalid) {

                $slug = new Slug();

                $umum_name = $this->request->getVar('umum_name');
                $umum_desc = $this->request->getVar('umum_desc');
                $file = $this->request->getFile('file');
                $umum_tujuan = $this->request->getVar('umum_tujuan');
                $oldfile = $this->request->getVar('oldfile');

                $newext = $file->getClientExtension();
                if (!empty($newext)) {
                    $oldname = $_SERVER['DOCUMENT_ROOT'] . '/uploads/umum/' . $oldfile;
                    if (file_exists($oldname)) {
                        unlink($oldname);
                    }
                    $random = bin2hex(random_bytes(4));
                    $namaumum = $slug->slugify($umum_name);
                    $filename = $random . '_' . $namaumum . '.' . $newext;
                    $file->move('uploads/umum/', $filename, true);
                } else {
                    $filename = $oldfile;
                }

                $dataumum = array(
                    'umum_name' => $umum_name,
                    'umum_desc' => $umum_desc,
                    'umum_file' => $filename,
                    'umum_tujuan' => $umum_tujuan,
                    'umum_softdelete' => 'Tidak',
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->update($umum_id, $dataumum);

                $session->setFlashdata('msg', 'Data Pengumuman berhasil diubah.');

                return redirect()->to('/Manpengumuman');
            } else {
                $umum = $model->where('umum_id', $umum_id)->first();
                if ($umum) {
                    $data = [
                        'umum_id' => $umum['umum_id'],
                        'umum_name' => $umum['umum_name'],
                        'umum_desc' => $umum['umum_desc'],
                        'umum_file' => $umum['umum_file'],
                        'umum_tujuan' => $umum['umum_tujuan']
                    ];
                }
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Ubah Data Pengumuman";
                $data['data_bread'] = "Ubah Data Pengumuman";
                $data['umum_id'] = $umum_id;
                $data['validation'] = $this->validator;
                return view('maintemp/ubahumum', $data);
            }
        }
    }
}
