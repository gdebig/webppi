<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CapesProfileModel;
use App\Models\CapesPendModel;
use App\Models\CapesKualifikasiModel;
use App\Models\CapesOrgModel;
use App\Models\CapesSertModel;
use App\Models\CapesKartulModel;
use App\Models\CapesSemModel;
use App\Models\BimbingModel;
use App\Models\PengujiRplModel;
use App\Models\NilairplModel;
use App\Models\ProfileModel;

class Manpeserta extends BaseController
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
        $model = new UserModel();
        $data['logged_in'] = $logged_in;
        $where = "tipe_user LIKE '___y'";
        $where1 = "status IN ('diterima', 'regular')";
        $user = $model->join('tbl_profile', 'tbl_user.user_id = tbl_profile.user_id', 'left')->join('tbl_bimbing', 'tbl_user.user_id = tbl_bimbing.mhs_id', 'left')->join('tbl_pengujirpl', 'tbl_user.user_id = tbl_pengujirpl.mhsrpl_id', 'left')->where($where1)->where($where)->where('tbl_user.softdelete', 'no')->orderby('tbl_user.user_id', 'DESC')->findall();
        if (!empty($user)) {
            $data['data_user'] = $user;
        } else {
            $data['data_user'] = 'kosong';
        }

        $where2 = "tipe_user LIKE '__y_'";
        $dosbing = $model->join('tbl_profile', 'tbl_user.user_id = tbl_profile.user_id', 'left')->where($where2)->where('tbl_user.softdelete', 'no')->orderby('tbl_user.user_id', 'DESC')->findall();
        if (!empty($dosbing)) {
            $data['data_dosbing'] = $dosbing;
        } else {
            $data['data_dosbing'] = 'kosong';
        }

        $data['title_page'] = "Daftar Peserta PPI RPL";
        $data['data_bread'] = "Peserta";
        return view('maintemp/peserta', $data);
    }

    public function profile($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $model = new CapesProfileModel();
        $user = $model->where('user_id', $id)->first();
        if ($user) {
            $data = [
                'ID' => $user['ID'],
                'user_id' => $user['user_id'],
                'FullName' => $user['FullName'],
                'BirthPlace' => $user['BirthPlace'],
                'BirthDate' => $user['Birthdate'],
                'KTA' => $user['KTA'],
                'SIP' => $user['SIP'],
                'Vocational' => $user['Vocational'],
                'HAddr' => $user['HAddr'],
                'HCity' => $user['HCity'],
                'HPostnum' => $user['HPostnum'],
                'Work' => $user['Work'],
                'Position' => $user['Position'],
                'WAddr' => $user['WAddr'],
                'WCity' => $user['WCity'],
                'Wpostnum' => $user['Wpostnum'],
                'Hnum' => $user['Hnum'],
                'Hfaks' => $user['Hfaks'],
                'Htelex' => $user['Htelex'],
                'Hemail' => $user['Hemail'],
                'Hpnum' => $user['Hpnum'],
                'Wnum' => $user['Wnum'],
                'Wfaks' => $user['Wfaks'],
                'Wtelex' => $user['Wtelex'],
                'Wemail1' => $user['Wemail1'],
                'Wemail2' => $user['Wemail2'],
                'Photo' => $user['Photo'],
                'pindahregular' => $user['pindahregular']
            ];
        } else {
            $data['kosong'] = "kosong";
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Profile Calon Peserta";
        $data['data_bread'] = "Profile Calon Peserta";
        return view('maintemp/capesprofile', $data);
    }

    public function doklengkap($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $model = new CapesProfileModel();
        $user = $model->where('user_id', $id)->first();
        if ($user) {
            $data = [
                'ID' => $user['ID'],
                'user_id' => $user['user_id'],
                'FullName' => $user['FullName'],
                'BirthPlace' => $user['BirthPlace'],
                'BirthDate' => $user['Birthdate'],
                'KTA' => $user['KTA'],
                'SIP' => $user['SIP'],
                'Vocational' => $user['Vocational'],
                'HAddr' => $user['HAddr'],
                'HCity' => $user['HCity'],
                'HPostnum' => $user['HPostnum'],
                'Work' => $user['Work'],
                'Position' => $user['Position'],
                'WAddr' => $user['WAddr'],
                'WCity' => $user['WCity'],
                'Wpostnum' => $user['Wpostnum'],
                'Hnum' => $user['Hnum'],
                'Hfaks' => $user['Hfaks'],
                'Htelex' => $user['Htelex'],
                'Hemail' => $user['Hemail'],
                'Hpnum' => $user['Hpnum'],
                'Wnum' => $user['Wnum'],
                'Wfaks' => $user['Wfaks'],
                'Wtelex' => $user['Wtelex'],
                'Wemail1' => $user['Wemail1'],
                'Wemail2' => $user['Wemail2'],
                'Photo' => $user['Photo'],
                'pindahregular' => $user['pindahregular']
            ];
        } else {
            $data['kosong'] = "kosong";
        }

        $model = new CapesPendModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $pend = $model->where('user_id', $id)->orderby('GradYear', 'DESC')->findall();
        if (!empty($pend)) {
            $data['data_pend'] = $pend;
        } else {
            $data['data_pend'] = 'kosong';
        }

        $model = new CapesKualifikasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kerja = $model->where('user_id', $id)->orderby('ProjValue', 'DESC')->findall();
        if (!empty($kerja)) {
            $data['data_kerja'] = $kerja;
        } else {
            $data['data_kerja'] = 'kosong';
        }

        $model = new CapesOrgModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $org = $model->where('user_id', $id)->orderby('StartPeriodYear', 'DESC')->findall();
        if (!empty($org)) {
            $data['data_org'] = $org;
        } else {
            $data['data_org'] = 'kosong';
        }

        $model = new CapesSertModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $latih = $model->where('user_id', $id)->where('Jenis', 'pelatihan')->orderby('StartYear', 'DESC')->findall();
        if (!empty($latih)) {
            $data['data_latih'] = $latih;
        } else {
            $data['data_latih'] = 'kosong';
        }

        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $latih = $model->where('user_id', $id)->where('Jenis', 'sertifikat')->orderby('StartYear', 'DESC')->findall();
        if (!empty($latih)) {
            $data['data_latih'] = $latih;
        } else {
            $data['data_latih'] = 'kosong';
        }

        $model = new CapesKartulModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kartul = $model->where('user_id', $id)->orderby('Year', 'DESC')->findall();
        if (!empty($kartul)) {
            $data['data_kartul'] = $kartul;
        } else {
            $data['data_kartul'] = 'kosong';
        }

        $model = new CapesSemModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $sem = $model->where('user_id', $id)->where('Type', 'Sem')->orderby('Year', 'DESC')->findall();
        if (!empty($sem)) {
            $data['data_sem'] = $sem;
        } else {
            $data['data_sem'] = 'kosong';
        }

        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Profile Calon Peserta";
        $data['data_bread'] = "Profile Calon Peserta";
        return view('maintemp/doklengkap', $data);
    }

    public function pendidikan($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new CapesPendModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $pend = $model->where('user_id', $id)->orderby('GradYear', 'DESC')->findall();
        if (!empty($pend)) {
            $data['data_pend'] = $pend;
        } else {
            $data['data_pend'] = 'kosong';
        }
        $data['title_page'] = "Data Pendidikan Calon Peserta PPI RPL";
        $data['data_bread'] = "Pendidikan";
        return view('maintemp/capespend', $data);
    }

    public function kerja($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new CapesKualifikasiModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kerja = $model->where('user_id', $id)->orderby('ProjValue', 'DESC')->findall();
        if (!empty($kerja)) {
            $data['data_kerja'] = $kerja;
        } else {
            $data['data_kerja'] = 'kosong';
        }
        $data['title_page'] = "Data Pengalaman Kerja Calon Peserta PPI RPL";
        $data['data_bread'] = "Pengalaman Kerja";
        return view('maintemp/capeskerja', $data);
    }

    public function organ($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new CapesOrgModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $org = $model->where('user_id', $id)->orderby('StartPeriodYear', 'DESC')->findall();
        if (!empty($org)) {
            $data['data_org'] = $org;
        } else {
            $data['data_org'] = 'kosong';
        }
        $data['title_page'] = "Data Organisasi Calon Peserta PPI RPL";
        $data['data_bread'] = "Organisasi";
        return view('maintemp/capesorg', $data);
    }

    public function latih($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new CapesSertModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $latih = $model->where('user_id', $id)->where('Jenis', 'pelatihan')->orderby('StartYear', 'DESC')->findall();
        if (!empty($latih)) {
            $data['data_latih'] = $latih;
        } else {
            $data['data_latih'] = 'kosong';
        }
        $data['title_page'] = "Data Pelatihan Teknik Calon Peserta PPI RPL";
        $data['data_bread'] = "Pelatihan";
        return view('maintemp/capeslatih', $data);
    }

    public function sert($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new CapesSertModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $latih = $model->where('user_id', $id)->where('Jenis', 'sertifikat')->orderby('StartYear', 'DESC')->findall();
        if (!empty($latih)) {
            $data['data_latih'] = $latih;
        } else {
            $data['data_latih'] = 'kosong';
        }
        $data['title_page'] = "Data Sertifikat Kompetensi Calon Peserta PPI RPL";
        $data['data_bread'] = "Sertifikat";
        return view('maintemp/capessert', $data);
    }

    public function kartul($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);
        $model = new CapesKartulModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $kartul = $model->where('user_id', $id)->orderby('Year', 'DESC')->findall();
        if (!empty($kartul)) {
            $data['data_kartul'] = $kartul;
        } else {
            $data['data_kartul'] = 'kosong';
        }
        $data['title_page'] = "Data Karya Tulis di Bidang Keinsinyuran Calon Peserta PPI RPL";
        $data['data_bread'] = "Karya Tulis";
        return view('maintemp/capeskartul', $data);
    }

    //Fungsi untuk link Seminarpenilaibimbing
    public function sem($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        $model = new CapesSemModel();
        $data['capeslogged_in'] = $session->get('capeslogged_in');
        $sem = $model->where('user_id', $id)->where('Type', 'Sem')->orderby('Year', 'DESC')->findall();
        if (!empty($sem)) {
            $data['data_sem'] = $sem;
        } else {
            $data['data_sem'] = 'kosong';
        }
        $data['title_page'] = "Data Seminarpenilaibimbing/Lokakarya Calon Peserta PPI RPL";
        $data['data_bread'] = "Seminarpenilaibimbing";
        return view('maintemp/capessem', $data);
    }

    public function prosesdosbing()
    {
        $session = session();
        $model = new BimbingModel();
        $model1 = new PengujiRplModel();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');

        if ($button == "setbimbing") {
            $userid = $this->request->getVar('user_id');
            $dosbing = $this->request->getVar('dosbing');
            if (!empty($userid)) {
                foreach ($userid as $id) {
                    $mhs = $model->where('mhs_id', $id)->countAllResults();
                    if ($mhs >= 2) {
                        $session->setFlashdata('errmsg', 'Mahasiswa yang sama, hanya boleh memiliki satu pembimbing.');
                        return redirect()->to('/manpeserta');
                    } else {
                        $data = array(
                            'mhs_id' => $id,
                            'dosen_id' => $dosbing,
                            'date_created' => date('Y-m-d'),
                            'date_modified' => date('Y-m-d')
                        );

                        $model->save($data);
                    }
                }

                $session->setFlashdata('msg', 'Dosen pembimbing berhasil ditetapkan.');

                return redirect()->to('/manpeserta');
            } else {

                $session->setFlashdata('errmsg', 'Tidak ada peserta yang dicentang.');

                return redirect()->to('/manpeserta');
            }
        } elseif ($button == "gantibimbing") {
            $user_id = $this->request->getVar('user_id');
            $dosbing = $this->request->getVar('dosbing');
            if (!empty($user_id)) {
                foreach ($user_id as $userid) {
                    $bimbing = $model->where('mhs_id', $userid)->first();
                    $data = array(
                        'dosen_id' => $dosbing,
                        'date_modified' => date('Y-m-d')
                    );

                    $model->update($bimbing['bimbing_id'], $data);
                }

                $session->setFlashdata('msg', 'Dosen pembimbing berhasil diubah.');

                return redirect()->to('/manpeserta');
            } else {

                $session->setFlashdata('errmsg', 'Tidak ada peserta yang dicentang.');

                return redirect()->to('/manpeserta');
            }
        } elseif ($button == "setpenilai") {
            $userid = $this->request->getVar('user_id');
            $dosbing = $this->request->getVar('dosbing');
            if (!empty($userid)) {
                foreach ($userid as $id) {
                    $mhs = $model1->where('mhsrpl_id', $id)->countAllResults();
                    if ($mhs >= 2) {
                        $session->setFlashdata('errmsg', 'Mahasiswa yang sama, hanya boleh memiliki satu penilai.');
                        return redirect()->to('/manpeserta');
                    } else {
                        $data = array(
                            'mhsrpl_id' => $id,
                            'dosenrpl_id' => $dosbing,
                            'date_created' => date('Y-m-d'),
                            'date_modified' => date('Y-m-d')
                        );

                        $model1->save($data);
                    }
                }

                $session->setFlashdata('msg', 'Dosen Penilai RPL berhasil ditetapkan.');

                return redirect()->to('/manpeserta');
            } else {

                $session->setFlashdata('errmsg', 'Tidak ada peserta yang dicentang.');

                return redirect()->to('/manpeserta');
            }
        } elseif ($button == "gantipenilai") {
            $user_id = $this->request->getVar('user_id');
            $dosbing = $this->request->getVar('dosbing');
            if (!empty($user_id)) {
                foreach ($user_id as $userid) {
                    $bimbing = $model1->where('mhsrpl_id', $userid)->first();
                    $data = array(
                        'dosenrpl_id' => $dosbing,
                        'date_modified' => date('Y-m-d')
                    );

                    $model1->update($bimbing['ujirpl_id'], $data);
                }

                $session->setFlashdata('msg', 'Dosen Penilai RPL berhasil diubah.');

                return redirect()->to('/manpeserta');
            } else {

                $session->setFlashdata('errmsg', 'Tidak ada peserta yang dicentang.');

                return redirect()->to('/manpeserta');
            }
        } else {
            return redirect()->to('/manpeserta');
        }
    }

    public function lihatnilairpl($id)
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        $isadmin = $session->get('isadmin');
        if ((!$logged_in) && ((!$issadmin) || (!$isadmin))) {
            return redirect()->to('/home');
        }
        helper(['tanggal']);

        $model = new ProfileModel();
        $mhsprofile = $model->where('user_id', $id)->first();
        if ($mhsprofile) {
            $data = [
                'FullName' => $mhsprofile['FullName'],
            ];
        } else {
            $data['kosong'] = 'kosong';
        }

        $model2 = new NilairplModel();

        //Nilai Kode Etik Pembimbing
        $kodeetikpenilaibimbing = $model2->where('mhs_id', $id)->where('tipedosen', 'Pembimbing')->where('namamk', 'kodeetikpenilai')->where('nilairpl_save', 'Ya')->findall();
        $jmlkodeetikpenilaibimbing = $model2->where('mhs_id', $id)->where('tipedosen', 'Pembimbing')->where('namamk', 'kodeetikpenilai')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($kodeetikpenilaibimbing)) {
            $nilaikodeetikpenilaibimbing = 0;
            foreach ($kodeetikpenilaibimbing as $nilaike) :
                $nilai = $nilaike['nilaiq'] * $nilaike['nilair'];
                $nilaikodeetikpenilaibimbing = $nilaikodeetikpenilaibimbing + $nilai;
            endforeach;
        } else {
            $nilaikodeetikpenilaibimbing = 0;
        }
        $data['nilaikodeetikpenilaibimbing'] = $nilaikodeetikpenilaibimbing;
        $data['jmlkodeetikpenilaibimbing'] = $jmlkodeetikpenilaibimbing;

        //Nilai Profesipenilaionalisme Pembimbing
        $profesipenilaibimbing = $model2->where('mhs_id', $id)->where('tipedosen', 'Pembimbing')->where('namamk', 'profesipenilai')->where('nilairpl_save', 'Ya')->findall();
        $jmlprofesipenilaibimbing = $model2->where('mhs_id', $id)->where('tipedosen', 'Pembimbing')->where('namamk', 'profesipenilai')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($profesipenilaibimbing)) {
            $nilaiprofesipenilaibimbing = 0;
            foreach ($profesipenilaibimbing as $nilaipro) :
                $nilai = $nilaipro['nilaiq'] * $nilaipro['nilair'];
                $nilaiprofesipenilaibimbing = $nilaiprofesipenilaibimbing + $nilai;
            endforeach;
        } else {
            $nilaiprofesipenilaibimbing = 0;
        }
        $data['nilaiprofesipenilaibimbing'] = $nilaiprofesipenilaibimbing;
        $data['jmlprofesipenilaibimbing'] = $jmlprofesipenilaibimbing;

        //Nilai k3lhpenilai Pembimbing
        $k3lhpenilaibimbing = $model2->where('mhs_id', $id)->where('tipedosen', 'Pembimbing')->where('namamk', 'k3lhpenilai')->where('nilairpl_save', 'Ya')->findall();
        $jmlk3lhpenilaibimbing = $model2->where('mhs_id', $id)->where('tipedosen', 'Pembimbing')->where('namamk', 'k3lhpenilai')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($k3lhpenilaibimbing)) {
            $nilaik3lhpenilaibimbing = 0;
            foreach ($k3lhpenilaibimbing as $nilaik3) :
                $nilai = $nilaik3['nilaiq'] * $nilaik3['nilair'];
                $nilaik3lhpenilaibimbing = $nilaik3lhpenilaibimbing + $nilai;
            endforeach;
        } else {
            $nilaik3lhpenilaibimbing = 0;
        }
        $data['nilaik3lhpenilaibimbing'] = $nilaik3lhpenilaibimbing;
        $data['jmlk3lhpenilaibimbing'] = $jmlk3lhpenilaibimbing;

        //Nilai Studi Kasus Pembimbing
        $studikasuspenilaibimbing = $model2->where('mhs_id', $id)->where('tipedosen', 'Pembimbing')->where('namamk', 'studikasuspenilai')->where('nilairpl_save', 'Ya')->findall();
        $jmlstudikasuspenilaibimbing = $model2->where('mhs_id', $id)->where('tipedosen', 'Pembimbing')->where('namamk', 'studikasuspenilai')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($studikasuspenilaibimbing)) {
            $nilaistudikasuspenilaibimbing = 0;
            foreach ($studikasuspenilaibimbing as $nilaisk) :
                $nilai = $nilaisk['nilaiq'] * $nilaisk['nilair'];
                $nilaistudikasuspenilaibimbing = $nilaistudikasuspenilaibimbing + $nilai;
            endforeach;
        } else {
            $nilaistudikasuspenilaibimbing = 0;
        }
        $data['nilaistudikasuspenilaibimbing'] = $nilaistudikasuspenilaibimbing;
        $data['jmlstudikasuspenilaibimbing'] = $jmlstudikasuspenilaibimbing;

        //Nilai Seminarpenilaibimbing Pembimbing
        $seminarpenilaibimbing = $model2->where('mhs_id', $id)->where('tipedosen', 'Pembimbing')->where('namamk', 'seminarpenilai')->where('nilairpl_save', 'Ya')->findall();
        $jmlseminarpenilaibimbing = $model2->where('mhs_id', $id)->where('tipedosen', 'Pembimbing')->where('namamk', 'seminarpenilai')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($seminarpenilaibimbing)) {
            $nilaiseminarpenilaibimbing = 0;
            foreach ($seminarpenilaibimbing as $nilaisem) :
                $nilai = $nilaisem['nilaiq'] * $nilaisem['nilair'];
                $nilaiseminarpenilaibimbing = $nilaiseminarpenilaibimbing + $nilai;
            endforeach;
        } else {
            $nilaiseminarpenilaibimbing = 0;
        }
        $data['nilaiseminarpenilaibimbing'] = $nilaiseminarpenilaibimbing;
        $data['jmlseminarpenilaibimbing'] = $jmlseminarpenilaibimbing;

        //Nilai Kode Etik Penilai
        $kodeetikpenilai = $model2->where('mhs_id', $id)->where('tipedosen', 'Penilai')->where('namamk', 'kodeetik')->where('nilairpl_save', 'Ya')->findall();
        $jmlkodeetikpenilai = $model2->where('mhs_id', $id)->where('tipedosen', 'Penilai')->where('namamk', 'kodeetik')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($kodeetikpenilai)) {
            $nilaikodeetikpenilai = 0;
            foreach ($kodeetikpenilai as $nilaike) :
                $nilai = $nilaike['nilaiq'] * $nilaike['nilair'];
                $nilaikodeetikpenilai = $nilaikodeetikpenilai + $nilai;
            endforeach;
        } else {
            $nilaikodeetikpenilai = 0;
        }
        $data['nilaikodeetikpenilai'] = $nilaikodeetikpenilai;
        $data['jmlkodeetikpenilai'] = $jmlkodeetikpenilai;

        //Nilai Profesionalisme Penilai
        $profesipenilai = $model2->where('mhs_id', $id)->where('tipedosen', 'Penilai')->where('namamk', 'profesi')->where('nilairpl_save', 'Ya')->findall();
        $jmlprofesipenilai = $model2->where('mhs_id', $id)->where('tipedosen', 'Penilai')->where('namamk', 'profesi')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($profesipenilai)) {
            $nilaiprofesipenilai = 0;
            foreach ($profesipenilai as $nilaipro) :
                $nilai = $nilaipro['nilaiq'] * $nilaipro['nilair'];
                $nilaiprofesipenilai = $nilaiprofesipenilai + $nilai;
            endforeach;
        } else {
            $nilaiprofesipenilai = 0;
        }
        $data['nilaiprofesipenilai'] = $nilaiprofesipenilai;
        $data['jmlprofesipenilai'] = $jmlprofesipenilai;

        //Nilai k3lh Penilai
        $k3lhpenilai = $model2->where('mhs_id', $id)->where('tipedosen', 'Penilai')->where('namamk', 'k3lh')->where('nilairpl_save', 'Ya')->findall();
        $jmlk3lhpenilai = $model2->where('mhs_id', $id)->where('tipedosen', 'Penilai')->where('namamk', 'k3lh')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($k3lhpenilai)) {
            $nilaik3lhpenilai = 0;
            foreach ($k3lhpenilai as $nilaik3) :
                $nilai = $nilaik3['nilaiq'] * $nilaik3['nilair'];
                $nilaik3lhpenilai = $nilaik3lhpenilai + $nilai;
            endforeach;
        } else {
            $nilaik3lhpenilai = 0;
        }
        $data['nilaik3lhpenilai'] = $nilaik3lhpenilai;
        $data['jmlk3lhpenilai'] = $jmlk3lhpenilai;

        //Nilai Studi Kasus Penilai
        $studikasuspenilai = $model2->where('mhs_id', $id)->where('tipedosen', 'Penilai')->where('namamk', 'studikasus')->where('nilairpl_save', 'Ya')->findall();
        $jmlstudikasuspenilai = $model2->where('mhs_id', $id)->where('tipedosen', 'Penilai')->where('namamk', 'studikasus')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($studikasuspenilai)) {
            $nilaistudikasuspenilai = 0;
            foreach ($studikasuspenilai as $nilaisk) :
                $nilai = $nilaisk['nilaiq'] * $nilaisk['nilair'];
                $nilaistudikasuspenilai = $nilaistudikasuspenilai + $nilai;
            endforeach;
        } else {
            $nilaistudikasuspenilai = 0;
        }
        $data['nilaistudikasuspenilai'] = $nilaistudikasuspenilai;
        $data['jmlstudikasuspenilai'] = $jmlstudikasuspenilai;

        //Nilai Seminar Penilai
        $seminarpenilai = $model2->where('mhs_id', $id)->where('tipedosen', 'Penilai')->where('namamk', 'seminar')->where('nilairpl_save', 'Ya')->findall();
        $jmlseminarpenilai = $model2->where('mhs_id', $id)->where('tipedosen', 'Penilai')->where('namamk', 'seminar')->where('nilairpl_save', 'Ya')->countAllResults();
        if (!empty($seminarpenilai)) {
            $nilaiseminarpenilai = 0;
            foreach ($seminarpenilai as $nilaisem) :
                $nilai = $nilaisem['nilaiq'] * $nilaisem['nilair'];
                $nilaiseminarpenilai = $nilaiseminarpenilai + $nilai;
            endforeach;
        } else {
            $nilaiseminarpenilai = 0;
        }
        $data['nilaiseminarpenilai'] = $nilaiseminarpenilai;
        $data['jmlseminarpenilai'] = $jmlseminarpenilai;

        $data['mhs_id'] = $id;
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Nilai RPL Peserta";
        $data['data_bread'] = "Nilai RPL Peserta";
        return view('maintemp/nilairplpeserta', $data);
    }
}
