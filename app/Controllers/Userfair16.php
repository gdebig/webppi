<?php

namespace App\Controllers;

use App\Models\CapesSertModel;
use App\Models\KompModel;
use App\Libraries\Slug;

class Userfair16 extends BaseController
{
    public function docs($id = false)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }

        if (!empty($id)) {
            $user_id = $id;
        } else {
            $user_id = $session->get('user_id');
        }
        helper(['tanggal']);
        $model = new CapesSertModel();
        $latih = $model->where('user_id', $user_id)->where('Jenis', 'sertifikat')->findall();
        if (!empty($latih)) {
            $data['data_latih'] = $latih;
        } else {
            $data['data_latih'] = 'kosong';
        }

        $data['title_page'] = "I.6. Sertifikat Kompetensi dan Bidang Lainnya (yang Relevan) Yang Diikuti (#) (W1,W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Sertifikat Kompetensi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/fairdok16', $data);
    }

    public function tambahsert()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'W.1%' OR komp_cat LIKE 'W.4%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $user_id = $session->get('user_id');

        $data['title_page'] = "I.6. Sertifikat Kompetensi dan Bidang Lainnya (yang Relevan) Yang Diikuti (#) (W1,W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Sertifikat Kompetensi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/tambahsertuserfair', $data);
    }

    public function tambahsertproses()
    {
        $session = session();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new CapesSertModel();
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair16/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Sertifikat harus diisi.',
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
                ],
                'komp16' => [
                    'label'  => 'Kompetensi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kompetensi harus diisi.',
                    ],
                ]
            ]);

            if ($formvalid) {
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
                $komp = $this->request->getVar('komp16');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $nilai_q = $nilai_q + 2;
                    if ((substr($kp, 0, 3) == 'W.1') or (substr($kp, 0, 3) == 'W.4')) {
                        switch ($Length) {
                            case 'sd36':
                                $nilai_p = $nilai_p + 1;
                                break;
                            case 'smp100':
                                $nilai_p = $nilai_p + 2;
                                break;
                            case 'smp240':
                                $nilai_p = $nilai_p + 3;
                                break;
                            case 'lbih240':
                                $nilai_p = $nilai_p + 4;
                                break;
                        }
                        switch ($Level) {
                            case 'Dasar':
                                $nilai_r = $nilai_r + 2;
                                break;
                            case 'Lanjut':
                                $nilai_r = $nilai_r + 3;
                                break;
                        }
                    }
                    $i++;
                    if ($i != $totarray) {
                        $stringkp = $stringkp . $kp . ', ';
                    } else {
                        $stringkp = $stringkp . $kp;
                    }
                endforeach;
                $nilai_w1 = $nilai_p * $nilai_r;
                $nilai_w4 = $nilai_p * $nilai_r;


                $namasert = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if (!empty($ext)) {
                    $filename = $user_id . '_sertifikat_' . $namasert . '.' . $ext;
                    $File->move('uploads/docs/', $filename, true);
                } else {
                    $filename = "";
                }

                $data = array(
                    'user_id' => $user_id,
                    'Jenis' => 'sertifikat',
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
                    'kompetensi' => $stringkp,
                    'nilai_p' => $nilai_p,
                    'nilai_q' => $nilai_q,
                    'nilai_r' => $nilai_r,
                    'nilai_w1' => $nilai_w1,
                    'nilai_w4' => $nilai_w4,
                    'date_created' => date('Y-m-d'),
                    'date_modified' => date('Y-m-d')
                );

                $model->save($data);
                $session->setFlashdata('msg', 'Data Sertifikat Kompetensi berhasil ditambah.');

                return redirect()->to('/userfair16/docs');
            } else {
                $session = session();

                $data['datakomp'] = $this->request->getVar('komp16');

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.1%' OR komp_cat LIKE 'W.4%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "I.6. Sertifikat Kompetensi dan Bidang Lainnya (yang Relevan) Yang Diikuti (#) (W1,W4)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Tambah Sertifikat Kompetensi</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/tambahsertuserfairvalid', $data);
            }
        }
    }

    public function hapussert($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new CapesSertModel();

        $latih = $model->find($id);
        $path = './uploads/docs/' . $latih['File'];
        if (is_file($path)) {
            unlink($path);
        }
        $model->delete($id);
        $session->setFlashdata('msg', 'Data Sertifikat Kompetensi berhasil dihapus.');

        return redirect()->to('/userfair16/docs');
    }

    public function ubahsert($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new CapesSertModel();
        $latih = $model->where('Num', $id)->first();
        if ($latih) {
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
                'File' => $latih['File'],
                'datakomp' => explode(", ", $latih['kompetensi'])
            ];
        }

        $model1 = new KompModel();
        $where = "komp_cat LIKE 'W.1%' OR komp_cat LIKE 'W.4%'";
        $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

        $data['title_page'] = "I.6. Sertifikat Kompetensi dan Bidang Lainnya (yang Relevan) Yang Diikuti (#) (W1,W4)";
        $data['data_bread'] = '';
        $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Sertifikat Kompetensi</li>';
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/ubahsertuserfair', $data);
    }

    public function ubahsertproses()
    {
        $session = session();
        $slug = new Slug();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $model = new CapesSertModel();
        $Num = $this->request->getVar('Num');
        $user_id = $session->get('user_id');

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/userfair16/docs');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'Name' => [
                    'label'  => 'Name',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nama Sertifikat Kompetensi harus diisi.',
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
                ],
                'komp16' => [
                    'label'  => 'Kompetensi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Kompetensi harus diisi.',
                    ],
                ]
            ]);

            if ($formvalid) {
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
                $komp = $this->request->getVar('komp16');

                $nilai_p = 0;
                $nilai_q = 0;
                $nilai_r = 0;
                $stringkp = '';
                $totarray = count($komp);
                $i = 0;
                foreach ($komp as $kp) :
                    $nilai_q = $nilai_q + 2;
                    if ((substr($kp, 0, 3) == 'W.1') or (substr($kp, 0, 3) == 'W.4')) {
                        switch ($Length) {
                            case 'sd36':
                                $nilai_p = $nilai_p + 1;
                                break;
                            case 'smp100':
                                $nilai_p = $nilai_p + 2;
                                break;
                            case 'smp240':
                                $nilai_p = $nilai_p + 3;
                                break;
                            case 'lbih240':
                                $nilai_p = $nilai_p + 4;
                                break;
                        }
                        switch ($Level) {
                            case 'Dasar':
                                $nilai_r = $nilai_r + 2;
                                break;
                            case 'Lanjut':
                                $nilai_r = $nilai_r + 3;
                                break;
                        }
                    }
                    $i++;
                    if ($i != $totarray) {
                        $stringkp = $stringkp . $kp . ', ';
                    } else {
                        $stringkp = $stringkp . $kp;
                    }
                endforeach;
                $nilai_w1 = $nilai_p * $nilai_r;
                $nilai_w4 = $nilai_p * $nilai_r;

                $namasert = $slug->slugify($Name);
                $ext = $File->getClientExtension();
                if ((empty($filename)) && (!empty($ext))) {
                    $filenamenew = $user_id . '_sertifikat_' . $namasert . '.' . $ext;
                    $File->move('uploads/docs/', $filenamenew, true);
                } elseif ((!empty($filename)) && (!empty($ext))) {
                    $oldext = substr($filename, -4);
                    if ($oldext == $ext) {
                        $File->move('uploads/docs/', $filename, true);
                        $filenamenew = $filename;
                    } else {
                        $filenamenew = $user_id . '_sertifikat_' . $namasert . '.' . $ext;
                        $File->move('uploads/docs/', $filenamenew, true);
                    }
                } else {
                    $filenamenew = $filename;
                }

                $data = array(
                    'Name' => $Name,
                    'Jenis' => 'sertifikat',
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
                    'kompetensi' => $stringkp,
                    'nilai_p' => $nilai_p,
                    'nilai_q' => $nilai_q,
                    'nilai_r' => $nilai_r,
                    'nilai_w1' => $nilai_w1,
                    'nilai_w4' => $nilai_w4,
                    'date_modified' => date('Y-m-d')
                );

                $model->update($Num, $data);
                $session->setFlashdata('msg', 'Data Sertifikat Kompetensi berhasil diubah.');

                return redirect()->to('/userfair16/docs');
            } else {
                $latih = $model->where('Num', $Num)->first();
                if ($latih) {
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
                        'File' => $latih['File'],
                        'datakomp' => explode(", ", $latih['kompetensi'])
                    ];
                }

                $model1 = new KompModel();
                $where = "komp_cat LIKE 'W.2%' OR komp_cat LIKE 'W.4%' OR komp_cat LIKE 'P.10%'";
                $data['data_komp'] = $model1->where($where)->orderby('komp_id', 'ASC')->findall();

                $data['title_page'] = "I.6. Sertifikat Kompetensi dan Bidang Lainnya (yang Relevan) Yang Diikuti (#) (W1,W4)";
                $data['data_bread'] = '';
                $data['stringbread'] = '<li class="breadcrumb-item active"><a href="' . base_url() . "/userfair" . '">Dokumen FAIR</a></li><li class="breadcrumb-item active">Ubah Sertifikat Kompetensi</li>';
                $data['logged_in'] = $session->get('logged_in');
                $data['validation'] = $this->validator;
                return view('maintemp/ubahsertuserfair', $data);
            }
        }
    }
}
