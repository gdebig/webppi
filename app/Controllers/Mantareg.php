<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProfileModel;
use App\Models\TarModel;
use App\Models\JadwalSidangRegModel;
use App\Models\NilaitarModel;
use App\Models\ConfigModel;

class Mantareg extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $user_id = $session->get('user_id');
        $model = new TarModel();
        $data['logged_in'] = $logged_in;
        $tugasakhir = $model->join('tbl_profile', 'tbl_tugasakhirreg.user_id = tbl_profile.user_id', 'left')->join('tbl_user', 'tbl_tugasakhirreg.user_id = tbl_user.user_id', 'left')->orderby('tbl_tugasakhirreg.tar_tahun', 'DESC')->orderby('tbl_tugasakhirreg.tar_semester', 'ASC')->orderby('tbl_profile.FullName', 'ASC')->findall();
        if (!empty($tugasakhir)) {
            $data['data_ta'] = $tugasakhir;
        } else {
            $data['data_ta'] = 'kosong';
        }

        //Koordinator TA Reguler
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['title_page'] = "Daftar Praktek Keinsinyuran Peserta PPI Reguler";
        $data['data_bread'] = "Praktek Keinsinyuran Peserta PPI Reguler";
        $data['logged_in'] = $logged_in;
        return view('maintemp/mantugasakhirreg', $data);
    }

    public function setjadwal($tar_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $model = new JadwalSidangRegModel();
        $jadwalsidang = $model->where('tbl_jadwalsidangreg.tar_id', $tar_id)->findall();
        if (!empty($jadwalsidang)) {
            $data['data_js'] = $jadwalsidang;
        } else {
            $data['data_js'] = 'kosong';
        }

        //Koordinator TA Reguler
        $id = $session->get('user_id');
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['tar_id'] = $tar_id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Jadwal Sidang Peserta PPI Reguler";
        $data['data_bread'] = "Jadwal Sidang";
        $data['logged_in'] = $logged_in;
        return view('maintemp/manjadwalsidangreg', $data);
    }

    public function tambahjadwal($tar_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        //Koordinator TA Reguler
        $id = $session->get('user_id');
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }


        $data['tar_id'] = $tar_id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Jadwal Sidang Peserta PPI Reguler";
        $data['data_bread'] = "Tambah Jadwal Sidang";
        $data['logged_in'] = $logged_in;
        return view('maintemp/tambahjadwalsidangreg', $data);
    }

    public function tambahjsproses()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $user_id = $this->request->getVar('user_id');
        $tar_id = $this->request->getVar('tar_id');
        $submit = $this->request->getVar('submit');
        if ($submit == "batal") {
            return redirect()->to('/mantareg/setjadwal/' . $tar_id . '/' . $user_id);
        } else {
            $model = new JadwalSidangRegModel();
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'sidang_ruang' => [
                    'label'  => 'sidang_ruang',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Ruang Sidang harus diisi.',
                    ],
                ],
                'sidang_tanggal' => [
                    'label'  => 'sidang_tanggal',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'Field Tanggal Sidang harus diisi.',
                    ],
                ]
            ]);
        }
        if ($formvalid) {
            $sidang_ruang = $this->request->getVar('sidang_ruang');
            $sidang_tanggal = $this->request->getVar('sidang_tanggal');

            $data = array(
                'tar_id' => $tar_id,
                'user_id' => $user_id,
                'sidang_ruang' => $sidang_ruang,
                'sidang_tanggal' => $sidang_tanggal,
                'date_created' => date('Y-m-d'),
                'date_modified' => date('Y-m-d')
            );

            $model->save($data);

            return redirect()->to('/mantareg/setjadwal/' . $tar_id . '/' . $user_id);
        } else {
            $data['tar_id'] = $tar_id;
            $data['user_id'] = $user_id;

            //Koordinator TA Reguler
            $id = $session->get('user_id');
            $model2 = new ConfigModel();
            $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $id)->first();
            if ($config) {
                $data['koor_tugasakhir'] = True;
            } else {
                $data['koor_tugasakhir'] = False;
            }

            $data['title_page'] = "Jadwal Sidang Peserta PPI Reguler";
            $data['data_bread'] = "Tambah Jadwal Sidang";
            $data['logged_in'] = $logged_in;
            $data['validation'] = $this->validator;
            return view('maintemp/tambahjadwalsidangregvalid', $data);
        }
    }

    public function hapusjadwal($id, $tar_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        $model = new JadwalSidangRegModel();
        $model->delete($id);
        $session->setFlashdata('msg', 'Data jadwal sidang berhasil dihapus.');

        return redirect()->to('/mantareg/setjadwal/' . $tar_id . '/' . $user_id);
    }

    public function setpenguji($tar_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        $model = new NilaitarModel();
        $penguji = $model->where('tar_id', $tar_id)->where('tipedosen', 'Penguji')->join('tbl_profile', 'tbl_nilaitar.dosen_id = tbl_profile.user_id', 'left')->orderby('tar_id', 'DESC')->findall();

        if ($penguji) {
            $data['data_uji'] = $penguji;
        } else {
            $data['data_uji'] = 'kosong';
        }

        //Koordinator TA Reguler
        $id = $session->get('user_id');
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        helper(['tanggal']);

        $data['tar_id'] = $tar_id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Daftar Penguji Proyek Akhir Peserta PPI Reguler";
        $data['data_bread'] = "Penguji Proyek Akhir";
        $data['logged_in'] = $logged_in;
        return view('maintemp/manpengujitar', $data);
    }

    public function tambahpenguji($tar_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new UserModel();
        $where = "tipe_user LIKE '__y_'";
        $user = $model->join('tbl_profile', 'tbl_user.user_id = tbl_profile.user_id', 'left')->where($where)->orderby('tbl_profile.FullName', 'ASC')->findall();
        if (!empty($user)) {
            $data['data_user'] = $user;
        } else {
            $data['data_user'] = 'kosong';
        }

        //Koordinator TA Reguler
        $id = $session->get('user_id');
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['tar_id'] = $tar_id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Tambah Penguji Proyek Akhir Peserta PPI Reguler";
        $data['data_bread'] = "Tambah Penguji";
        $data['logged_in'] = $logged_in;
        return view('maintemp/tambahpengujireg', $data);
    }

    public function tambahujiproses()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new NilaitarModel();
        $user_id = $this->request->getVar('user_id');
        $tar_id = $this->request->getVar('tar_id');
        $submit = $this->request->getVar('submit');
        if ($submit == "batal") {
            return redirect()->to('/mantareg/setpenguji/' . $tar_id . '/' . $user_id);
        } else {
            $penguji = $this->request->getVar('penguji');
            $tar_id = $this->request->getVar('tar_id');
            $user_id = $this->request->getVar('user_id');

            $dataarray = array(
                'tar_id' => $tar_id,
                'dosen_id' => $penguji,
                'mhs_id' => $user_id,
                'tipedosen' => 'Penguji',
                'date_created' => date('Y-m-d'),
                'date_modified' => date('Y-m-d')
            );

            $model->save($dataarray);

            $session->setFlashdata('msg', 'Penguji Praktek Keinsinyuran berhasil di set.');
            return redirect()->to('/mantareg/setpenguji/' . $tar_id . '/' . $user_id);
        }
    }

    public function hapusuji($nilaitar_id, $tar_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        $model = new NilaitarModel();
        $model->delete($nilaitar_id);
        $session->setFlashdata('msg', 'Data penguji berhasil dihapus.');

        return redirect()->to('/mantareg/setpenguji/' . $tar_id . '/' . $user_id);
    }

    public function setpembimbing($tar_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        $model = new NilaitarModel();
        $penguji = $model->where('tar_id', $tar_id)->where('tipedosen', 'Pembimbing')->join('tbl_profile', 'tbl_nilaitar.dosen_id = tbl_profile.user_id', 'left')->orderby('tar_id', 'DESC')->findall();

        if ($penguji) {
            $data['data_uji'] = $penguji;
        } else {
            $data['data_uji'] = 'kosong';
        }

        //Koordinator TA Reguler
        $id = $session->get('user_id');
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        helper(['tanggal']);

        $data['tar_id'] = $tar_id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Daftar Pembimbing Proyek Akhir Peserta PPI Reguler";
        $data['data_bread'] = "Pembimbing Proyek Akhir";
        $data['logged_in'] = $logged_in;
        return view('maintemp/manpembimbingtar', $data);
    }

    public function tambahpembimbing($tar_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new UserModel();
        $where = "tipe_user LIKE '__y_'";
        $user = $model->join('tbl_profile', 'tbl_user.user_id = tbl_profile.user_id', 'left')->where($where)->orderby('tbl_profile.FullName', 'ASC')->findall();
        if (!empty($user)) {
            $data['data_user'] = $user;
        } else {
            $data['data_user'] = 'kosong';
        }

        //Koordinator TA Reguler
        $id = $session->get('user_id');
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['tar_id'] = $tar_id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Tambah Pembimbing Proyek Akhir Peserta PPI Reguler";
        $data['data_bread'] = "Tambah Pembimbing";
        $data['logged_in'] = $logged_in;
        return view('maintemp/tambahpembimbingreg', $data);
    }

    public function tambahbimbingproses()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new NilaitarModel();
        $user_id = $this->request->getVar('user_id');
        $tar_id = $this->request->getVar('tar_id');
        $submit = $this->request->getVar('submit');
        if ($submit == "batal") {
            return redirect()->to('/mantareg/setpembimbing/' . $tar_id . '/' . $user_id);
        } else {
            $penguji = $this->request->getVar('penguji');
            $tar_id = $this->request->getVar('tar_id');
            $user_id = $this->request->getVar('user_id');

            $dataarray = array(
                'tar_id' => $tar_id,
                'dosen_id' => $penguji,
                'mhs_id' => $user_id,
                'tipedosen' => 'Pembimbing',
                'date_created' => date('Y-m-d'),
                'date_modified' => date('Y-m-d')
            );

            $model->save($dataarray);

            $session->setFlashdata('msg', 'Penguji Praktek Keinsinyuran berhasil di set.');
            return redirect()->to('/mantareg/setpembimbing/' . $tar_id . '/' . $user_id);
        }
    }

    public function hapusbimbing($id, $tar_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        $model = new NilaitarModel();
        $model->delete($tar_id);
        $session->setFlashdata('msg', 'Data Pembimbing berhasil dihapus.');

        return redirect()->to('/mantareg/setpembimbing/' . $tar_id . '/' . $user_id);
    }

    public function admta($tar_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }

        helper(['tanggal']);

        $model = new NilaitarModel();
        $bimbing = $model->where('tar_id', $tar_id)->where('tipedosen', 'Pembimbing')->first();
        if ($bimbing) {
            $data['bimbing_id'] = $bimbing['dosen_id'];
            $data['mhs_id'] = $bimbing['mhs_id'];
        } else {
            $data['bimbing_id'] = "kosong";
        }

        $uji = $model->where('tar_id', $tar_id)->where('tipedosen', 'Penguji')->first();
        if ($uji) {
            $data['uji_id'] = $uji['dosen_id'];
            $data['mhs_id'] = $uji['mhs_id'];
        } else {
            $data['uji_id'] = "kosong";
        }

        //Koordinator TA Reguler
        $id = $session->get('user_id');
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $data['tar_id'] = $tar_id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Daftar Administrasi Praktek Keinsinyuran";
        $data['data_bread'] = "Daftar Administrasi";
        $data['logged_in'] = $logged_in;
        return view('maintemp/daftaradmreg', $data);
    }

    public function lihatnilai($tar_id, $mhs_id)
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

        //Koordinator TA Reguler
        $model2 = new ConfigModel();
        $config = $model2->where('config_name', 'koor_tugasakhir')->where('config_value', $user_id)->first();
        if ($config) {
            $data['koor_tugasakhir'] = True;
        } else {
            $data['koor_tugasakhir'] = False;
        }

        $model = new NilaitarModel();
        $nilaita = $model->where('tar_id', $tar_id)->where('mhs_id', $mhs_id)->join('tbl_profile', 'tbl_nilaitar.dosen_id = tbl_profile.user_id')->orderby('nilaitar_id', 'ASC')->findall();
        if (!empty($nilaita)) {
            $data['nilai_ta'] = $nilaita;
        } else {
            $data['nilai_ta'] = 'kosong';
        }
        $data['logged_in'] = $logged_in;
        $data['user_id'] = $session->get('user_id');
        $data['title_page'] = "Lihat Nilai Praktek Keinsinyuran";
        $data['data_bread'] = "Nilai PK";
        return view('maintemp/lihatnilaireg', $data);
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
        $bimbing = $model->where('tar_id', $tar_id)->where('tipedosen', 'Pembimbing')->first();
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
        } else {
            return redirect()->to('/mantareg');
        }

        $data['tglsekarang'] = format_indo(date("Y-m-d"));
        $data['title'] = 'Form Evaluasi - ' . $data['namamahasiswa'];
        return view('maintemp/formevaluasi', $data);
    }

    public function daftarhadir($mhs_id, $tar_id)
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
        $bimbing = $model->where('tar_id', $tar_id)->where('tipedosen', 'Pembimbing')->first();
        if ($bimbing) {
            $bimbing_id = $bimbing['dosen_id'];
        }

        $model = new ProfileModel();
        $dosen = $model->where('user_id', $bimbing_id)->first();
        if ($dosen) {
            $data['namapembimbing'] = $dosen['FullName'];
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
        $nilaita = $model->where('tar_id', $tar_id)->join('tbl_profile', 'tbl_nilaitar.dosen_id = tbl_profile.user_id', 'left')->findall();
        if ($nilaita) {
            $data['nilaita'] = $nilaita;
        } else {
            return redirect()->to('/mantareg');
        }

        $data['tglsekarang'] = format_indo(date("Y-m-d"));
        $data['title'] = 'Daftar Hadir';
        return view('maintemp/formdaftarhadirall', $data);
    }

    public function beritaacara($mhs_id, $tar_id)
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

        $model = new JadwalSidangRegModel();
        $jadwalsidang = $model->where('tar_id', $tar_id)->first();
        if ($jadwalsidang) {
            $data['tanggal_sidang'] = format_indo($jadwalsidang['sidang_tanggal']);
            $data['jam_sidang'] = substr($jadwalsidang['sidang_tanggal'], 11, 8);
            $data['tempat_sidang'] = $jadwalsidang['sidang_ruang'];
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

        $model = new ConfigModel();
        $tahunaktif = $model->where('config_name', 'tahun_aktif')->first();
        if ($tahunaktif) {
            $tahunaktif = $tahunaktif['config_value'];
            $tahunaktif1 = $tahunaktif + 1;
            $data['tahunaktif'] = $tahunaktif . '/' . $tahunaktif1;
        }
        $semester = $model->where('config_name', 'sem_aktif')->first();
        if ($semester) {
            $data['semaktif'] = $semester['config_value'];
        }

        $model = new NilaitarModel();
        $nilaita = $model->where('tar_id', $tar_id)->join('tbl_profile', 'tbl_nilaitar.dosen_id = tbl_profile.user_id', 'left')->findall();
        if ($nilaita) {
            $data['nilaita'] = $nilaita;
        } else {
            return redirect()->to('/mantareg');
        }

        $data['tglsekarang'] = format_indo(date("Y-m-d"));
        $data['title'] = 'Berita Acara';
        return view('maintemp/beritaacara', $data);
    }

    function prosesconfirmtar()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        }
        $model = new TarModel();
        $button = $this->request->getVar('submit');
        if ($button == "set") {
            $taid = $this->request->getVar('tar_id');
            $confirmta = $this->request->getVar('confirmta');
            if (!empty($taid)) {
                foreach ($taid as $id) {
                    $data = array(
                        'tar_confirm' => $confirmta,
                        'date_modified' => date('Y-m-d')
                    );

                    $model->update($taid, $data);
                }

                $session->setFlashdata('msg', 'Konfirmasi PK berhasil dilakukan.');

                return redirect()->to('/mantareg');
            } else {

                $session->setFlashdata('errmsg', 'Tidak ada PK yang dicentang.');

                return redirect()->to('/mantareg');
            }
        }
    }
}
