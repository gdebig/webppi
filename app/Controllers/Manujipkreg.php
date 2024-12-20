<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BimbingModel;
use App\Models\NilaitarModel;
use App\Models\TarModel;
use App\Models\ProfileModel;
use App\Models\ConfigModel;

class Manujipkreg extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $user_id = $session->get('user_id');
        $model = new NilaitarModel();
        $data['logged_in'] = $logged_in;
        $user = $model->where('tbl_nilaitar.dosen_id', $user_id)->join('tbl_profile', 'tbl_nilaitar.mhs_id = tbl_profile.user_id', 'left')->join('tbl_tugasakhirreg', 'tbl_nilaitar.tar_id = tbl_tugasakhirreg.tar_id', 'left')->orderby('tbl_tugasakhirreg.tar_tahun', 'DESC')->orderby('tbl_profile.FullName', 'ASC')->findall();
        if (!empty($user)) {
            $data['data_user'] = $user;
        } else {
            $data['data_user'] = 'kosong';
        }

        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['title_page'] = "Data Peserta Ujian PK Reguler";
        $data['data_bread'] = "Ujian Reguler";
        return view('maintemp/ujipkreg', $data);
    }

    public function lihatnilai($mhs_id, $dosen_id, $tar_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        helper(['nilai']);
        $user_id = $session->get('user_id');

        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }


        $model = new NilaitarModel();
        $nilaita = $model->where('tar_id', $tar_id)->join('tbl_profile', 'tbl_nilaitar.dosen_id = tbl_profile.user_id')->orderby('nilaitar_id', 'ASC')->findall();
        if (!empty($nilaita)) {
            $data['nilai_ta'] = $nilaita;
        } else {
            $data['nilai_ta'] = 'kosong';
        }
        $data['logged_in'] = $logged_in;
        $data['user_id'] = $session->get('user_id');
        $data['mhs_id'] = $mhs_id;
        $data['dosen_id'] = $dosen_id;
        $data['tar_id'] = $tar_id;
        $data['title_page'] = "Lihat Nilai Praktek Keinsinyuran Reguler";
        $data['data_bread'] = "Nilai PK Reguler";
        return view('maintemp/lihatnilaiujipkreg', $data);
        //var_dump($data);
    }

    public function berinilai($mhs_id, $dosen_id, $tar_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $user_id = $session->get('user_id');
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }


        $data['logged_in'] = $logged_in;
        $data['mhs_id'] = $mhs_id;
        $data['dosen_id'] = $dosen_id;
        $data['tar_id'] = $tar_id;
        $data['title_page'] = "Nilai Ujian Praktek Keinsinyuran PPI Reguler";
        $data['data_bread'] = "Nilai PK";
        return view('maintemp/nilaiujipkreg', $data);
    }

    public function nilaiujipkproses()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $user_id = $session->get('user_id');
        $mhs_id = $this->request->getVar('mhs_id');
        $dosen_id = $this->request->getVar('dosen_id');
        $tar_id = $this->request->getVar('tar_id');

        $submit = $this->request->getVar('submit');
        if ($submit == "batal") {
            return redirect()->to('/manujipkreg/lihatnilai/' . $mhs_id . '/' . $dosen_id . '/' . $tar_id);
        } else {
            $model = new NilaitarModel();
            $nilaitar = $model->where('tar_id', $tar_id)->where('dosen_id', $dosen_id)->where('mhs_id', $mhs_id)->first();
            if ($nilaitar) {
                $nilaitar_id = $nilaitar['nilaitar_id'];
            } else {
                $nilaitar_id = 0;
            }

            helper(['form', 'url']);

            $formvalid = $this->validate([
                'penulisan' => [
                    'label'  => 'Penulisan Laporan',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Penulisan Laporan harus diisi.',
                    ],
                ],
                'presentasi' => [
                    'label'  => 'Nilai Presentasi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Nilai Presentasi harus diisi.',
                    ],
                ],
                'materi' => [
                    'label'  => 'Penguasaan Materi',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Penguasaan Materi harus diisi.',
                    ],
                ]
            ]);
        }
        if ($formvalid) {
            $penulisan = $this->request->getVar('penulisan');
            $presentasi = $this->request->getVar('presentasi');
            $materi = $this->request->getVar('materi');

            $file_string = $this->request->getVar('signed');
            $checksigned = $this->request->getVar('checksigned');
            if (empty($file_string) && empty($checksigned)) {
                $data['logged_in'] = $logged_in;
                $data['mhs_id'] = $mhs_id;
                $data['dosen_id'] = $dosen_id;
                $data['tar_id'] = $tar_id;
                $data['title_page'] = "Nilai Praktek Keinsinyuran Mahasiswa Bimbingan PPI RPL";
                $data['data_bread'] = "Nilai PK";
                $data['error'] = "Belum memberikan tanda tangan.";
                return view('maintemp/nilaitavalid', $data);
            } else {
                if (!empty($checksigned)) {
                    $model1 = new UserModel();
                    $dosen = $model1->where('user_id', $dosen_id)->first();
                    if ($dosen) {
                        $signedname = $dosen['signed'];
                    }
                } elseif (!empty($file_string)) {
                    $image = explode(";base64,", $file_string);
                    $image_type = explode("image/", $image[0]);
                    $image_type_png = $image_type[1];
                    $image_base64 = base64_decode($image[1]);
                    $folderPath = ROOTPATH . 'public/uploads/ttd/';
                    $signedname = uniqid() . '.' . $image_type_png;
                    $file = $folderPath . $signedname;
                    file_put_contents($file, $image_base64);
                }
            }

            $data = array(
                'tar_id' => $tar_id,
                'dosen_id' => $dosen_id,
                'mhs_id' => $mhs_id,
                'penulisan' => $penulisan,
                'presentasi' => $presentasi,
                'materi' => $materi,
                'signed' => $signedname,
                'date_created' => date('Y-m-d'),
                'date_modified' => date('Y-m-d')
            );

            $model->update($nilaitar_id, $data);

            return redirect()->to('/manujipkreg/lihatnilai/' . $mhs_id . '/' . $dosen_id . '/' . $tar_id);
        } else {

            $model2 = new ConfigModel();
            $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
            if ($config) {
                $data['koor_tugasakhir'] = True;
            } else {
                $data['koor_tugasakhir'] = False;
            }

            $data['logged_in'] = $logged_in;
            $data['mhs_id'] = $mhs_id;
            $data['dosen_id'] = $dosen_id;
            $data['tar_id'] = $tar_id;
            $data['title_page'] = "Nilai Ujian Praktek Keinsinyuran PPI RPL";
            $data['data_bread'] = "Nilai PK";
            $data['validation'] = $this->validator;
            return view('maintemp/nilaiujipkregvalid', $data);
        }
    }

    public function lihatformevaluasi($mhs_id, $dosen_id, $tar_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        helper(['nilai']);

        $model = new NilaitarModel();
        $bimbing = $model->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->where('tar_id', $tar_id)->first();
        if ($bimbing) {
            $bimbing_id = $bimbing['dosen_id'];
        }

        $model = new ProfileModel();
        $dosen = $model->where('user_id', $bimbing_id)->first();
        if ($dosen) {
            $data['namapembimbing'] = $dosen['FullName'];
        }

        $dosenttd = $model->where('user_id', $dosen_id)->first();
        if ($dosen) {
            $data['namattd'] = $dosenttd['FullName'];
        }

        $model = new UserModel();
        $dosennip = $model->where('user_id', $bimbing_id)->first();
        if ($dosennip) {
            $data['bimbingnip'] = $dosennip['NIP'];
        }

        $model = new UserModel();
        $dosennipttd = $model->where('user_id', $dosen_id)->first();
        if ($dosennip) {
            $data['nipttd'] = $dosennipttd['NIP'];
        }

        $model = new TarModel();
        $tugasakhir = $model->where('tar_id', $tar_id)->join('tbl_profile', 'tbl_tugasakhirreg.user_id = tbl_profile.user_id', 'left')->join('tbl_user', 'tbl_tugasakhirreg.user_id = tbl_user.user_id', 'left')->first();
        if ($tugasakhir) {
            $data['namamahasiswa'] = $tugasakhir['FullName'];
            $data['npm'] = $tugasakhir['NPM'];
            $data['instansi'] = $tugasakhir['instansi'];
            $data['divisi'] = $tugasakhir['divisi'];
            $data['periode'] = format_indo($tugasakhir['startdate']) . ' - ' . format_indo($tugasakhir['enddate']);
            $data['lapjudul'] = $tugasakhir['tar_usuljudul'];
            $data['confirm'] = $tugasakhir['tar_confirm'];
        }

        if ($data['confirm'] == 'Ya') {
            $model = new ConfigModel();
            $kaprodi = $model->where('config_name', 'kaprodi')->join('tbl_profile', 'tbl_config.config_value = tbl_profile.user_id', 'left')->join('tbl_user', 'tbl_config.config_value = tbl_user.user_id', 'left')->first();
            if ($kaprodi) {
                $data['namakaprodi'] = $kaprodi['FullName'];
                $data['nipkaprodi'] = $kaprodi['NIP'];
                $data['signkaprodi'] = $kaprodi['signed'];
            }
        }

        $model = new NilaitarModel();
        $nilaita = $model->where('tar_id', $tar_id)->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->first();
        if ($nilaita) {
            $data['penulisan'] = $nilaita['penulisan'];
            $data['presentasi'] = $nilaita['presentasi'];
            $data['materi'] = $nilaita['materi'];
            $data['tipedosen'] = $nilaita['tipedosen'];
            $data['signed'] = $nilaita['signed'];
            $data['rerata'] = (0.3 * $nilaita['penulisan']) + (0.3 * $nilaita['presentasi']) + (0.4 * $nilaita['materi']);
            $data['nilaihuruf'] = nilai_huruf($data['rerata']);
        }

        $data['tglsekarang'] = format_indo(date("Y-m-d"));
        $data['title'] = 'Form Evaluasi - ' . $data['namamahasiswa'];
        return view('maintemp/formevaluasi', $data);
    }

    public function lihatadm($mhs_id, $dosen_id, $tar_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        helper(['nilai']);

        $bimbing_id = $dosen_id;

        $model = new ProfileModel();
        $dosen = $model->where('user_id', $bimbing_id)->first();
        if ($dosen) {
            $data['namapembimbing'] = $dosen['FullName'];
        }

        $dosenttd = $model->where('user_id', $dosen_id)->first();
        if ($dosen) {
            $data['namattd'] = $dosenttd['FullName'];
        }

        $model = new UserModel();
        $dosennip = $model->where('user_id', $bimbing_id)->first();
        if ($dosennip) {
            $data['bimbingnip'] = $dosennip['NIP'];
        }

        $model = new UserModel();
        $dosennipttd = $model->where('user_id', $dosen_id)->first();
        if ($dosennip) {
            $data['nipttd'] = $dosennipttd['NIP'];
        }

        $model = new TarModel();
        $tugasakhir = $model->where('tar_id', $tar_id)->join('tbl_profile', 'tbl_tugasakhirreg.user_id = tbl_profile.user_id', 'left')->join('tbl_user', 'tbl_tugasakhirreg.user_id = tbl_user.user_id', 'left')->first();
        if ($tugasakhir) {
            $data['namamahasiswa'] = $tugasakhir['FullName'];
            $data['npm'] = $tugasakhir['NPM'];
            $data['instansi'] = $tugasakhir['instansi'];
            $data['divisi'] = $tugasakhir['divisi'];
            $data['periode'] = format_indo($tugasakhir['startdate']) . ' - ' . format_indo($tugasakhir['enddate']);
            $data['lapjudul'] = $tugasakhir['tar_usuljudul'];
            $data['confirm'] = $tugasakhir['tar_confirm'];
        }

        if ($data['confirm'] == 'Ya') {
            $model = new ConfigModel();
            $kaprodi = $model->where('config_name', 'kaprodi')->join('tbl_profile', 'tbl_config.config_value = tbl_profile.user_id', 'left')->join('tbl_user', 'tbl_config.config_value = tbl_user.user_id', 'left')->first();
            if ($kaprodi) {
                $data['namakaprodi'] = $kaprodi['FullName'];
                $data['nipkaprodi'] = $kaprodi['NIP'];
                $data['signkaprodi'] = $kaprodi['signed'];
            }
        }

        $model = new NilaitarModel();
        $nilaita = $model->where('tar_id', $tar_id)->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->first();
        if ($nilaita) {
            $data['penulisan'] = $nilaita['penulisan'];
            $data['presentasi'] = $nilaita['presentasi'];
            $data['materi'] = $nilaita['materi'];
            $data['tipedosen'] = $nilaita['tipedosen'];
            $data['signed'] = $nilaita['signed'];
            $data['rerata'] = (0.3 * $nilaita['penulisan']) + (0.3 * $nilaita['presentasi']) + (0.4 * $nilaita['materi']);
            $data['nilaihuruf'] = nilai_huruf($data['rerata']);
        } else {
            return redirect()->to('/manujipk');
        }

        $data['tglsekarang'] = format_indo(date("Y-m-d"));
        $data['title'] = 'Daftar Hadir';
        return view('maintemp/formdaftarhadir', $data);
    }
}
