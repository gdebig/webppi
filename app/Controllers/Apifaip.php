<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProfileModel;
use App\Models\CapesPendModel;
use App\Models\CapesOrgModel;

use App\Libraries\Sendfaip;

class Apifaip extends BaseController
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

        $user_id = $session->get('user_id');
        $model = new UserModel();
        $data['logged_in'] = $logged_in;
        $where = "id_faip <> ''";
        $user = $model->where('softdelete', 'no')->where($where)->join("tbl_profile", "tbl_user.user_id = tbl_profile.user_id", "left")->orderBy('tbl_user.user_id', 'DESC')->findall();
        if (!empty($user)) {
            $data['data_user'] = $user;
        } else {
            $data['data_user'] = 'kosong';
        }
        $data['title_page'] = "Kirim PPI RPL";
        $data['data_bread'] = "Kirim FAIP";
        return view('maintemp/listanggotafaip', $data);
    }

    public function sendfaip($id_faip, $user_id)
    {
        $session = session();
        if (empty($id_faip)) {
            $session->setFlashdata('err', "user_id belum terdaftar.");
            return redirect()->to('/apifaip');
        } else {
            $sendfaip = new Sendfaip();

            $token = $sendfaip->gettoken();

            if (($token == "Tidak mendapatkan token.") || ($token == "Curl tidak berhasil.")) {
                $session->setFlashdata('err', $token);
                return redirect()->to('/apifaip');
            } else {
                #insert FAIP
                $data = "user_id='" . $id_faip . "'&periodstart=\"2023\"&periodend=\"2025\"&faip_type=\"00\"&certificate_type=\"IPP\"";
                $insertfaip = $sendfaip->insertfaip($token, $id_faip, $data);
                if ($insertfaip != "ok") {
                    $session->setFlashdata('err', "Insert FAIP gagal.");
                    return redirect()->to('/apifaip');
                }

                #insert FAIP 1.1.1
                $model111 = new ProfileModel();
                $user = $model111->where('tbl_profile.user_id', $user_id)->join('tbl_user', 'tbl_profile.user_id = tbl_user.user_id', 'left')->first();
                $data = "user_id='" . $id_faip . "'&addr_type=1&addr_desc='" . $user['HAddr'] . "'&addr_loc='" . $user['HCity'] . "'&addr_zip='" . $user['HPostnum'] . "'";
                $insertfaip111 = $sendfaip->sendfaip111($token, $data);
                if ($insertfaip111 != "ok") {
                    $session->setFlashdata('err', "Insert FAIP 1.1.1. gagal.");
                    return redirect()->to('/apifaip');
                }

                #insert FAIP 1.1.2
                $data = "user_id='" . $id_faip . "'&exp_name='" . $user['Position'] . "'&exp_loc='" . $user['WAddr'] . ", " . $user['WCity'] . "'&exp_zip='" . $user['Wpostnum'] . "'";
                $insertfaip112 = $sendfaip->sendfaip112($token, $data);
                if ($insertfaip112 != "ok") {
                    $session->setFlashdata('err', "Insert FAIP 1.1.2. gagal.");
                    return redirect()->to('/apifaip');
                } else {
                    /*$session->setFlashdata('msg', "Insert FAIP berhasil.");
                    return redirect()->to('/apifaip');*/
                    $send_faip = "success";
                }

                #insert FAIP 1.1.3
                $data = "user_id='" . $id_faip . "'&phone_type='home_phone'&phone_value='" . $user['Hpnum'] . "'";
                $insertfaip113 = $sendfaip->sendfaip113($token, $data);
                if ($insertfaip113 != "ok") {
                    $session->setFlushdata("err", "Insert FAIP 1.1.3. gagal.");
                    return redirect()->to('/apifaip');
                } else {
                    $send_faip = "success";
                }
                $data = "user_id='" . $id_faip . "'&phone_type='office_phone'&phone_value='" . $user['Wnum'] . "'";
                $insertfaip113 = $sendfaip->sendfaip113($token, $data);
                if ($insertfaip113 != "ok") {
                    $session->setFlushdata("err", "Insert FAIP 1.1.3. gagal.");
                    return redirect()->to('/apifaip');
                } else {
                    $send_faip = "success";
                }

                #insert FAIP 1.2
                $model12 = new CapesPendModel();
                $datapend = $model12->where('user_id', $user_id)->findall();
                if (!empty($datapend)) {
                    foreach ($datapend as $pend) :
                        $data = "user_id='" . $id_faip . "'school_type='" . $pend['Rank'] . "'&school='" . $pend['Name'] . "'&fakultas='" . $pend['Faculty'] . "'&jurusan='" . $pend['Major'] . "'&kota='" . $pend['City'] . "'&provinsi='" . $pend['Province'] . "'&negara='" . $pend['Country'] . "'&tahun_lulus='" . $pend['GradYear'] . "'&title='" . $pend['Degree'] . "'&judul='" . $pend['Title'] . "'&uraian='" . $pend['Desc'] . "'&score='" . $pend['Mark'] . "'&judicium='" . $pend['Judicium'] . "'";
                        $insertfaip12 = $sendfaip->sendfaip12($token, $data);
                        if ($insertfaip12 != "ok") {
                            $session->setFlushdata("err", "Insert FAIP 1.2 gagal.");
                            return redirect()->to('/apifaip');
                        } else {
                            $send_faip = "success";
                        }
                    endforeach;
                } else {
                    $session->setFlushdata('err', 'Insert FAIP 1.2. gagal karena data kosong.');
                    return redirect()->to('/apifaip');
                }

                #insert FAIP 1.3
                $model13 = new CapesOrgModel();
                $dataorg = $model13->where('user_id', $user_id)->findall();
                if (!empty($dataorg)) {
                    foreach ($dataorg as $org) :
                        $data = "user_id='" . $id_faip . "'&nama_org='" . $org['Name'] . "'&tingkat='" . $org['OrgLevel'] . "'&jabatan='" . $org['Position'] . "'&lingkup='" . $org['OrgScp'] . "'&tempat='" . $org['City'] . "'&provinsi='" . $org['City'] . "'&negara='" . $org['Country'] . "'&startdate='" . $org['StartPeriodBulan'] . "'&startyear='" . $org['StartPeriodYear'] . "'&enddate='" . $org['EndPeriodBulan'] . "'&endyear='" . $org['EndPeriodYear'] . "'&is_present='0'&aktifitas='" . $org["Desc"] . "'&kompetensi='" . $org['kompetensi'] . "'";
                        $insertfaip13 = $sendfaip->sendfaip13($token, $data);
                        if ($insertfaip13 != "ok") {
                            $session->setFlushdata("err", "Insert FAIP 1.3. gagal.");
                            return redirect()->to('/apifaip');
                        } else {
                            $send_faip = "success";
                        }
                    endforeach;
                } else {
                    $session->setFlushdata('err', 'Insert FAIP 1.3. gagal karena data kosong.');
                    return redirect()->to('/apifaip');
                }
            }

            if ((isset($send_faip)) && ($send_faip == "success")) {
                $model = new UserModel();
                $datauser = array(
                    'confirm_faip' => 'sudah',
                    'date_modified' => date('Y-m-d H:i:s')
                );
                $model->update($user_id, $datauser);
                $session->setFlashdata('msg', "Kirim FAIP berhasil");
                return redirect()->to('/apifaip');
            }
        }
    }
}
