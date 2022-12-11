<?php

namespace App\Controllers;

use App\Models\AkunModel;

class Userfair extends BaseController
{
    public function index()
    {
        $session = session();
        $logged_in = $session->get('logged_in');
        $ispeserta = $session->get('ispeserta');
        if ((!$logged_in) && (!$ispeserta)) {
            return redirect()->to('/home');
        } else {
            $session->set('role', 'peserta');
        }
        $data['title_page'] = "Dokumen FAIR PPI RPL";
        $data['data_bread'] = "Dokumen FAIR";
        $data['logged_in'] = $session->get('logged_in');
        return view('maintemp/userfair', $data);
    }
}
