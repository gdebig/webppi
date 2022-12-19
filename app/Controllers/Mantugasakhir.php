<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProfileModel;
use App\Models\TugasAkhirModel;
use App\Models\BimbingModel;
use App\Models\JadwalSidangModel;
use App\Models\NilaitaModel;
use App\Models\ConfigModel;

class Mantugasakhir extends BaseController
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
        $model = new TugasAkhirModel();
        $data['logged_in'] = $logged_in;
        $tugasakhir = $model->join('tbl_profile', 'tbl_tugasakhir.user_id = tbl_profile.user_id', 'left')->join('tbl_user', 'tbl_tugasakhir.user_id = tbl_user.user_id', 'left')->orderby('tbl_tugasakhir.ta_tahun', 'DESC')->orderby('tbl_tugasakhir.ta_semester', 'ASC')->orderby('tbl_profile.FullName', 'ASC')->findall();
        if (!empty($tugasakhir)) {
            $data['data_ta'] = $tugasakhir;
        } else {
            $data['data_ta'] = 'kosong';
        }
        $data['title_page'] = "Daftar Praktek Keinsinyuran Peserta PPI RPL";
        $data['data_bread'] = "Praktek Keinsinyuran Peserta PPI RPL";
        $data['logged_in'] = $logged_in;
        return view('maintemp/mantugasakhir', $data);
    }

    public function setjadwal($ta_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $model = new JadwalSidangModel();
        $jadwalsidang = $model->where('tbl_jadwalsidang.ta_id', $ta_id)->findall();
        if (!empty($jadwalsidang)) {
            $data['data_js'] = $jadwalsidang;
        } else {
            $data['data_js'] = 'kosong';
        }
        $data['ta_id'] = $ta_id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Jadwal Sidang Peserta PPI RPL";
        $data['data_bread'] = "Jadwal Sidang";
        $data['logged_in'] = $logged_in;
        return view('maintemp/manjadwalsidang', $data);
    }

    public function tambahjadwal($id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $data['ta_id'] = $id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Jadwal Sidang Peserta PPI RPL";
        $data['data_bread'] = "Tambah Jadwal Sidang";
        $data['logged_in'] = $logged_in;
        return view('maintemp/tambahjadwalsidang', $data);
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
        $ta_id = $this->request->getVar('ta_id');
        $submit = $this->request->getVar('submit');
        if ($submit == "batal") {
            return redirect()->to('/mantugasakhir/setjadwal/' . $ta_id . '/' . $user_id);
        } else {
            $model = new JadwalSidangModel();
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
                'ta_id' => $ta_id,
                'user_id' => $user_id,
                'sidang_ruang' => $sidang_ruang,
                'sidang_tanggal' => $sidang_tanggal,
                'date_created' => date('Y-m-d'),
                'date_modified' => date('Y-m-d')
            );

            $model->save($data);

            return redirect()->to('/mantugasakhir/setjadwal/' . $ta_id . '/' . $user_id);
        } else {
            $data['ta_id'] = $ta_id;
            $data['user_id'] = $user_id;
            $data['title_page'] = "Jadwal Sidang Peserta PPI RPL";
            $data['data_bread'] = "Tambah Jadwal Sidang";
            $data['logged_in'] = $logged_in;
            $data['validation'] = $this->validator;
            return view('maintemp/tambahjadwalsidangvalid', $data);
        }
    }

    public function hapusjadwal($id, $ta_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        $model = new JadwalSidangModel();
        $model->delete($id);
        $session->setFlashdata('msg', 'Data jadwal sidang berhasil dihapus.');

        return redirect()->to('/mantugasakhir/setjadwal/' . $ta_id . '/' . $user_id);
    }

    public function setpenguji($ta_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        $model = new TugasAkhirModel();
        $penguji = $model->where('ta_id', $ta_id)->join('tbl_profile', 'tbl_tugasakhir.ta_penguji = tbl_profile.user_id', 'left')->orderby('ta_id', 'DESC')->findall();

        if ($penguji) {
            $data['data_uji'] = $penguji;
        } else {
            $data['data_uji'] = 'kosong';
        }

        helper(['tanggal']);

        $data['ta_id'] = $ta_id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Daftar Penguji Proyek Akhir Peserta PPI RPL";
        $data['data_bread'] = "Penguji Proyek Akhir";
        $data['logged_in'] = $logged_in;
        return view('maintemp/manpenguji', $data);
    }

    public function tambahpenguji($id, $user_id)
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

        $data['ta_id'] = $id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Tambah Penguji Proyek Akhir Peserta PPI RPL";
        $data['data_bread'] = "Tambah Penguji";
        $data['logged_in'] = $logged_in;
        return view('maintemp/tambahpenguji', $data);
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
        $model = new TugasAkhirModel();
        $user_id = $this->request->getVar('user_id');
        $ta_id = $this->request->getVar('ta_id');
        $submit = $this->request->getVar('submit');
        if ($submit == "batal") {
            return redirect()->to('/mantugasakhir/setpenguji/' . $ta_id . '/' . $user_id);
        } else {
            $penguji = $this->request->getVar('penguji');
            $ta_id = $this->request->getVar('ta_id');
            $user_id = $this->request->getVar('user_id');

            $dataarray = array(
                'ta_penguji' => $penguji,
            );

            $model->update($ta_id, $dataarray);

            $session->setFlashdata('msg', 'Penguji Praktek Keinsinyuran berhasil di set.');
            return redirect()->to('/mantugasakhir/setpenguji/' . $ta_id . '/' . $user_id);
        }
    }

    public function hapusuji($id, $ta_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        $model = new TugasAkhirModel();

        $dataarray = array(
            'ta_penguji' => '',
        );

        $model->update($ta_id, $dataarray);
        $session->setFlashdata('msg', 'Data penguji berhasil dihapus.');

        return redirect()->to('/mantugasakhir/setpenguji/' . $ta_id . '/' . $user_id);
    }

    public function admta($ta_id, $user_id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }

        helper(['tanggal']);

        $model = new NilaitaModel();
        $bimbing = $model->where('ta_id', $ta_id)->where('tipedosen', 'Pembimbing')->first();
        if ($bimbing) {
            $data['bimbing_id'] = $bimbing['dosen_id'];
            $data['mhs_id'] = $bimbing['mhs_id'];
        } else {
            $data['bimbing_id'] = "kosong";
        }

        $uji = $model->where('ta_id', $ta_id)->where('tipedosen', 'Penguji')->first();
        if ($uji) {
            $data['uji_id'] = $uji['dosen_id'];
            $data['mhs_id'] = $uji['mhs_id'];
        } else {
            $data['uji_id'] = "kosong";
        }

        $data['ta_id'] = $ta_id;
        $data['user_id'] = $user_id;
        $data['title_page'] = "Daftar Administrasi Praktek Keinsinyuran";
        $data['data_bread'] = "Daftar Administrasi";
        $data['logged_in'] = $logged_in;
        return view('maintemp/daftaradm', $data);
    }

    public function lihatnilai($ta_id, $mhs_id)
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
        $data['logged_in'] = $logged_in;
        $data['user_id'] = $session->get('user_id');
        $data['title_page'] = "Lihat Nilai Praktek Keinsinyuran";
        $data['data_bread'] = "Nilai PK";
        return view('maintemp/lihatnilaipkadmin', $data);
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
        } else {
            return redirect()->to('/mantugasakhir');
        }

        $data['tglsekarang'] = format_indo(date("Y-m-d"));
        $data['title'] = 'Form Evaluasi - ' . $data['namamahasiswa'];
        return view('maintemp/formevaluasi', $data);
    }

    public function daftarhadir($mhs_id, $ta_id)
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
        $nilaita = $model->where('ta_id', $ta_id)->join('tbl_profile', 'tbl_nilaita.dosen_id = tbl_profile.user_id', 'left')->findall();
        if ($nilaita) {
            $data['nilaita'] = $nilaita;
        } else {
            return redirect()->to('/mantugasakhir');
        }

        $data['tglsekarang'] = format_indo(date("Y-m-d"));
        $data['title'] = 'Daftar Hadir';
        return view('maintemp/formdaftarhadirall', $data);
    }

    public function beritaacara($mhs_id, $ta_id)
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

        $model = new JadwalSidangModel();
        $jadwalsidang = $model->where('ta_id', $ta_id)->first();
        if ($jadwalsidang) {
            $data['tanggal_sidang'] = format_indo($jadwalsidang['sidang_tanggal']);
            $data['jam_sidang'] = substr($jadwalsidang['sidang_tanggal'], 11, 8);
            $data['tempat_sidang'] = $jadwalsidang['sidang_ruang'];
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

        $model = new NilaitaModel();
        $nilaita = $model->where('ta_id', $ta_id)->join('tbl_profile', 'tbl_nilaita.dosen_id = tbl_profile.user_id', 'left')->findall();
        if ($nilaita) {
            $data['nilaita'] = $nilaita;
        } else {
            return redirect()->to('/mantugasakhir');
        }

        $data['tglsekarang'] = format_indo(date("Y-m-d"));
        $data['title'] = 'Berita Acara';
        return view('maintemp/beritaacara', $data);
    }

    function prosesconfirmta()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        $ispenilai = $session->get('ispenilai');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin) || (!$ispenilai))) {
            return redirect()->to('/home');
        }
        $model = new TugasAkhirModel();
        $button = $this->request->getVar('submit');
        if ($button == "set") {
            $taid = $this->request->getVar('ta_id');
            $confirmta = $this->request->getVar('confirmta');
            if (!empty($taid)) {
                foreach ($taid as $id) {
                    $data = array(
                        'ta_confirm' => $confirmta,
                        'date_modified' => date('Y-m-d')
                    );

                    $model->update($taid, $data);
                }

                $session->setFlashdata('msg', 'Konfirmasi PK berhasil dilakukan.');

                return redirect()->to('/mantugasakhir');
            } else {

                $session->setFlashdata('errmsg', 'Tidak ada PK yang dicentang.');

                return redirect()->to('/mantugasakhir');
            }
        }
    }
}
