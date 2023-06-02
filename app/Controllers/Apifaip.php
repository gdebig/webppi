<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProfileModel;

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
        $user = $model->where('softdelete', 'no')->join("tbl_profile", "tbl_user.user_id = tbl_profile.user_id", "left")->orderBy('tbl_user.user_id', 'DESC')->findall();
        if (!empty($user)) {
            $data['data_user'] = $user;
        } else {
            $data['data_user'] = 'kosong';
        }
        $data['title_page'] = "Kirim PPI RPL";
        $data['data_bread'] = "Kirim FAIP";
        return view('maintemp/listanggotafaip', $data);
    }

    public function sendfaip($id)
    {
        $session = session();
        if ($id != 16) {
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
                $data = "user_id=\"26906\"&periodstart=\"2023\"&periodend=\"2025\"&faip_type=\"00\"&certificate_type=\"IPP\"";
                $insertfaip = $sendfaip->insertfaip($token, '26906', $data);
                if ($insertfaip != "ok") {
                    $session->setFlashdata('err', "Insert FAIP gagal.");
                    return redirect()->to('/apifaip');
                }

                #insert FAIP 1.1.1
                $model111 = new ProfileModel();
                $user = $model111->where('tbl_profile.user_id', $id)->join('tbl_user', 'tbl_profile.user_id = tbl_user.user_id', 'left')->first();
                $data = "user_id=\"16906\"&addr_type=1&addr_desc='" . $user['HAddr'] . "'&addr_loc='" . $user['HCity'] . "'&addr_zip='" . $user['HPostnum'] . "'";
                $insertfaip111 = $sendfaip->sendfaip111($token, $data);
                if ($insertfaip111 != "ok") {
                    $session->setFlashdata('err', "Insert FAIP 1.1.1. gagal.");
                    return redirect()->to('/apifaip');
                }

                #insert FAIP 1.1.2
                $data = "user_id=\"16906\"&exp_name='" . $user['Position'] . "'&exp_loc='" . $user['WAddr'] . ", " . $user['WCity'] . "'&exp_zip='" . $user['Wpostnum'] . "'";
                $insertfaip112 = $sendfaip->sendfaip112($token, $data);
                echo $insertfaip112;
                if ($insertfaip112 != "ok") {
                    $session->setFlashdata('err', "Insert FAIP 1.1.2. gagal.");
                    return redirect()->to('/apifaip');
                } else {
                    $session->setFlashdata('msg', "Insert FAIP berhasil.");
                    return redirect()->to('/apifaip');
                }
            }
        }
    }
}
