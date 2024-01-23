<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\BimbingModel;
use App\Models\NilaitaModel;
use App\Models\TugasAkhirModel;
use App\Models\ProfileModel;
use App\Models\ConfigModel;
use App\Models\NilairplModel;

class Manbimbing extends BaseController
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
        $model = new BimbingModel();
        $model1 = new NilairplModel();
        $data['logged_in'] = $logged_in;
        $user = $model->where('tbl_bimbing.dosen_id', $user_id)->join('tbl_profile', 'tbl_bimbing.mhs_id = tbl_profile.user_id', 'left')->join('tbl_tugasakhir', 'tbl_bimbing.mhs_id = tbl_tugasakhir.user_id', 'left')->orderby('tbl_tugasakhir.ta_tahun', 'DESC')->orderby('tbl_profile.FullName', 'ASC')->findall();
        if (!empty($user)) {
            $data['data_user'] = $user;
            foreach ($user as $datauser) :
                $nilairpl = $model1->where('mhs_id', $datauser['mhs_id'])->where('tipedosen', 'Pembimbing')->first();
                if ($nilairpl) {
                    $nilairplsave[$datauser['mhs_id']] = $nilairpl['nilairpl_save'];
                    $nilairplsubmit[$datauser['mhs_id']] = $nilairpl['nilairpl_submit'];
                    $nilairplconfirm[$datauser['mhs_id']] = $nilairpl['nilairpl_confirm'];
                } else {
                    $nilairplsave[$datauser['mhs_id']] = "Tidak";
                    $nilairplsubmit[$datauser['mhs_id']] = "Tidak";
                    $nilairplconfirm[$datauser['mhs_id']] = "Tidak";
                }
            endforeach;
            $data['nilairplsave'] = $nilairplsave;
            $data['nilairplsubmit'] = $nilairplsubmit;
            $data['nilairplconfirm'] = $nilairplconfirm;
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

        $data['title_page'] = "Data Mahasiswa Bimbingan PPI RPL";
        $data['data_bread'] = "Bimbingan";
        return view('maintemp/bimbing', $data);
    }

    public function lihatnilai($mhs_id, $dosen_id, $ta_id)
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

        $model = new NilaitaModel();
        $nilaita = $model->where('ta_id', $ta_id)->join('tbl_profile', 'tbl_nilaita.dosen_id = tbl_profile.user_id')->orderby('nilaita_id', 'ASC')->findall();
        if (!empty($nilaita)) {
            $data['nilai_ta'] = $nilaita;
        } else {
            $data['nilai_ta'] = 'kosong';
        }

        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['logged_in'] = $logged_in;
        $data['user_id'] = $session->get('user_id');
        $data['mhs_id'] = $mhs_id;
        $data['dosen_id'] = $dosen_id;
        $data['ta_id'] = $ta_id;
        $data['title_page'] = "Lihat Nilai Praktek Keinsinyuran";
        $data['data_bread'] = "Nilai PK";
        return view('maintemp/lihatnilaipk', $data);
    }

    public function berinilai($mhs_id, $dosen_id, $ta_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        $user_id = $session->get('user_id');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

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
        $data['ta_id'] = $ta_id;
        $data['title_page'] = "Nilai Praktek Keinsinyuran Mahasiswa Bimbingan PPI RPL";
        $data['data_bread'] = "Nilai PK";
        return view('maintemp/nilaita', $data);
    }

    public function nilaitaproses()
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
        $ta_id = $this->request->getVar('ta_id');

        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $submit = $this->request->getVar('submit');
        if ($submit == "batal") {
            return redirect()->to('/manbimbing/lihatnilai/' . $mhs_id . '/' . $dosen_id . '/' . $ta_id);
        } else {
            $model = new NilaitaModel();
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
                $data['ta_id'] = $ta_id;
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
                'ta_id' => $ta_id,
                'dosen_id' => $dosen_id,
                'mhs_id' => $mhs_id,
                'tipedosen' => 'Pembimbing',
                'penulisan' => $penulisan,
                'presentasi' => $presentasi,
                'materi' => $materi,
                'signed' => $signedname,
                'date_created' => date('Y-m-d'),
                'date_modified' => date('Y-m-d')
            );

            $model->save($data);
            return redirect()->to('/manbimbing/lihatnilai/' . $mhs_id . '/' . $dosen_id . '/' . $ta_id);
        } else {
            $data['logged_in'] = $logged_in;
            $data['mhs_id'] = $mhs_id;
            $data['dosen_id'] = $dosen_id;
            $data['ta_id'] = $ta_id;
            $data['title_page'] = "Nilai Praktek Keinsinyuran Mahasiswa Bimbingan PPI RPL";
            $data['data_bread'] = "Nilai PK";
            $data['validation'] = $this->validator;
            return view('maintemp/nilaitavalid', $data);
        }
    }

    public function lihatformevaluasi($mhs_id, $dosen_id, $ta_id)
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

        $model = new BimbingModel();
        $bimbing = $model->where('mhs_id', $mhs_id)->first();
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

        $model = new TugasAkhirModel();
        $tugasakhir = $model->where('ta_id', $ta_id)->join('tbl_profile', 'tbl_tugasakhir.user_id = tbl_profile.user_id', 'left')->join('tbl_user', 'tbl_tugasakhir.user_id = tbl_user.user_id', 'left')->first();
        if ($tugasakhir) {
            $data['namamahasiswa'] = $tugasakhir['FullName'];
            $data['npm'] = $tugasakhir['NPM'];
            $data['instansi'] = $tugasakhir['instansi'];
            $data['divisi'] = $tugasakhir['divisi'];
            $data['periode'] = format_indo($tugasakhir['startdate']) . ' - ' . format_indo($tugasakhir['enddate']);
            $data['lapjudul'] = $tugasakhir['ta_usuljudul'];
            $data['confirm'] = $tugasakhir['ta_confirm'];
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

        $model = new NilaitaModel();
        $nilaita = $model->where('ta_id', $ta_id)->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->first();
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

    public function lihatadm($mhs_id, $dosen_id, $ta_id)
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

        $model = new BimbingModel();
        $bimbing = $model->where('mhs_id', $mhs_id)->first();
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

        $model = new TugasAkhirModel();
        $tugasakhir = $model->where('ta_id', $ta_id)->join('tbl_profile', 'tbl_tugasakhir.user_id = tbl_profile.user_id', 'left')->join('tbl_user', 'tbl_tugasakhir.user_id = tbl_user.user_id', 'left')->first();
        if ($tugasakhir) {
            $data['namamahasiswa'] = $tugasakhir['FullName'];
            $data['npm'] = $tugasakhir['NPM'];
            $data['instansi'] = $tugasakhir['instansi'];
            $data['divisi'] = $tugasakhir['divisi'];
            $data['periode'] = format_indo($tugasakhir['startdate']) . ' - ' . format_indo($tugasakhir['enddate']);
            $data['lapjudul'] = $tugasakhir['ta_usuljudul'];
            $data['confirm'] = $tugasakhir['ta_confirm'];
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

        $model = new NilaitaModel();
        $nilaita = $model->where('ta_id', $ta_id)->where('mhs_id', $mhs_id)->where('dosen_id', $dosen_id)->first();
        if ($nilaita) {
            $data['penulisan'] = $nilaita['penulisan'];
            $data['presentasi'] = $nilaita['presentasi'];
            $data['materi'] = $nilaita['materi'];
            $data['tipedosen'] = $nilaita['tipedosen'];
            $data['signed'] = $nilaita['signed'];
            $data['rerata'] = (0.3 * $nilaita['penulisan']) + (0.3 * $nilaita['presentasi']) + (0.4 * $nilaita['materi']);
            $data['nilaihuruf'] = nilai_huruf($data['rerata']);
        } else {
            return redirect()->to('/manbimbing');
        }

        $data['tglsekarang'] = format_indo(date("Y-m-d"));
        $data['title'] = 'Daftar Hadir';
        return view('maintemp/formdaftarhadir', $data);
    }
}
