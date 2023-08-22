<?php

namespace App\Controllers;

use App\Models\UserModel;

class Manuser extends BaseController
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
        $user = $model->where('softdelete', 'no')->orderBy('user_id', 'DESC')->findall();
        if (!empty($user)) {
            $data['data_user'] = $user;
        } else {
            $data['data_user'] = 'kosong';
        }
        $data['title_page'] = "Data Anggota PPI RPL";
        $data['data_bread'] = "Anggota";
        return view('maintemp/anggota', $data);
    }

    public function tambahanggota()
    {
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Tambah Data Anggota";
        $data['data_bread'] = "Tambah Data Anggota";
        $data['user_id'] = $user_id;
        return view('maintemp/tambahanggota', $data);
    }

    public function tambahanggotaproses()
    {

        $model = new UserModel();
        $session = session();
        $issadmin = $session->get('issadmin');
        $logged_in = $session->get('logged_in');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');
        if ($button == "batal") {
            return redirect()->to('/manuser');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'username' => [
                    'label'  => 'username',
                    'rules'  => 'required|is_unique[tbl_user.username]',
                    'errors' => [
                        'required' => 'Field Username harus diisi',
                        'is_unique' => 'Username yang digunakan sudah ada.',
                    ],
                ],
                'pass1' => [
                    'label'  => 'pass1',
                    'rules'  => 'required|min_length[6]',
                    'errors' => [
                        'required' => "Field Password harus diisi",
                        'min_length' => "Panjang password minimal 6 karakter",
                    ]
                ],
                'confpass' => [
                    'label'  => 'confpass',
                    'rules'  => 'required|min_length[6]|matches[pass1]',
                    'errors' => [
                        'required' => "Field Password harus diisi",
                        'min_length' => "Panjang password minimal 6 karakter",
                        'matches' => "Konfirmasi Password tidak sama",
                    ]
                ],
                'thnajaran' => [
                    'label'  => 'thnajaran',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Tahun Ajaran harus diisi",
                    ]
                ],
                'filesigned' => [
                    'rules'  => 'ext_in[filesigned,jpg,jpeg,png]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file JPG, JPEG atau PNG",
                    ],
                ],
            ]);

            if ($formvalid) {

                $username = $this->request->getVar('username');
                $pass1 = $this->request->getVar('pass1');
                $aktif = $this->request->getVar('aktif');
                $nodaftar = $this->request->getVar('nodaftar');
                $npm = $this->request->getVar('npm');
                $nip = $this->request->getVar('nip');
                $id_faip = $this->request->getVar('id_faip');
                $status = $this->request->getVar('status');
                $thnajaran = $this->request->getVar('thnajaran');
                $semester = $this->request->getVar('semester');
                $superadmin = $this->request->getVar('superadmin') == "yes" ? "y" : "n";
                $admin = $this->request->getVar('admin') == "yes" ? "y" : "n";
                $penilai = $this->request->getVar('penilai') == "yes" ? "y" : "n";
                $peserta = $this->request->getVar('peserta') == "yes" ? "y" : "n";
                $tipe_user = $superadmin . $admin . $penilai . $peserta;
                $filesigned = $this->request->getFile('filesigned');
                $tipe_peserta = $this->request->getVar('tipepeserta');

                $ext = $filesigned->getClientExtension();
                if (!empty($ext)) {
                    $signedname = $nip . '_ttd.' . $ext;
                    $filesigned->move('uploads/ttd/', $signedname, true);
                } else {
                    $signedname = '';
                }

                $datauser = array(
                    'username' => $username,
                    'password' => password_hash($pass1, PASSWORD_DEFAULT),
                    'active' => $aktif,
                    'nodaftar' => $nodaftar,
                    'NPM' => $npm,
                    'NIP' => $nip,
                    'id_faip' => $id_faip,
                    'status' => $status,
                    'thnajaran' => $thnajaran,
                    'semester' => $semester,
                    'tipe_user' => $tipe_user,
                    'confirmcapes' => 'Ya',
                    'softdelete' => 'no',
                    'signed' => $signedname,
                    'tipe_peserta' => $tipe_peserta,
                    'date_created' => date('Y-m-d H:i:s'),
                    'date_modified' => date('Y-m-d H:i:s')
                );

                $model->save($datauser);

                $session->setFlashdata('msg', 'Data user berhasil ditambahkan.');

                return redirect()->to('/manuser');
            } else {
                $user_id = $session->get('user_id');
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Tambah Data Anggota";
                $data['data_bread'] = "Tambah Data Anggota";
                $data['validation'] = $this->validator;
                $data['user_id'] = $user_id;
                return view('maintemp/tambahanggota', $data);
            }
        }
    }

    public function hapusanggota($id)
    {
        $model = new UserModel();
        $session = session();
        $user_id = $session->get('user_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $data = array(
            'softdelete' => 'yes'
        );
        $model->update($id, $data);
        return redirect()->to('/manuser');
    }

    public function ubahanggota($id)
    {
        $model = new UserModel();
        $session = session();
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }
        $anggota = $model->where('user_id', $id)->first();
        if ($anggota) {
            $data = [
                'user_id' => $anggota['user_id'],
                'username' => $anggota['username'],
                'active' => $anggota['active'],
                'nodaftar' => $anggota['nodaftar'],
                'NPM' => $anggota['NPM'],
                'NIP' => $anggota['NIP'],
                'id_faip' => $anggota['id_faip'],
                'status' => $anggota['status'],
                'thnajaran' => $anggota['thnajaran'],
                'semester' => $anggota['semester'],
                'tipe_user' => $anggota['tipe_user'],
                'signed' => $anggota['signed'],
                'confirmcapes' => $anggota['confirmcapes'],
                'confirmfair' => $anggota['confirmfair'],
                'tipe_peserta' => $anggota['tipe_peserta']
            ];
        }
        $data['logged_in'] = $logged_in;
        $data['title_page'] = "Ubah Data Anggota";
        $data['data_bread'] = "Ubah Data Anggota";
        return view('maintemp/ubahanggota', $data);
    }

    public function ubahanggotaproses()
    {
        $model = new UserModel();
        $session = session();
        $user_id = $this->request->getVar('user_id');
        $logged_in = $session->get('logged_in');
        $issadmin = $session->get('issadmin');
        if ((!$logged_in) && (!$issadmin)) {
            return redirect()->to('/home');
        }

        $button = $this->request->getVar('submit');

        if ($button == "batal") {
            return redirect()->to('/manuser');
        } else {
            helper(['form', 'url']);

            $formvalid = $this->validate([
                'confpass' => [
                    'label'  => 'confpass',
                    'rules'  => 'matches[pass1]',
                    'errors' => [
                        'matches' => "Konfirmasi Password tidak sama",
                    ]
                ],
                'thnajaran' => [
                    'label'  => 'thnajaran',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => "Field Tahun Ajaran harus diisi",
                    ]
                ],
                'filesigned' => [
                    'rules'  => 'ext_in[filesigned,jpg,jpeg,png]',
                    'errors' => [
                        'ext_in' => "Hanya menerima file JPG, JPEG atau PNG",
                    ],
                ],
            ]);

            if ($formvalid) {
                $username = $this->request->getVar('username');
                $signed = $this->request->getVar('signed');
                $pass1 = $this->request->getVar('pass1');
                $aktif = $this->request->getVar('aktif');
                $nodaftar = $this->request->getVar('nodaftar');
                $npm = $this->request->getVar('npm');
                $nip = $this->request->getVar('nip');
                $id_faip = $this->request->getVar('id_faip');
                $status = $this->request->getVar('status');
                $thnajaran = $this->request->getVar('thnajaran');
                $semester = $this->request->getVar('semester');
                $superadmin = $this->request->getVar('superadmin') == "yes" ? "y" : "n";
                $admin = $this->request->getVar('admin') == "yes" ? "y" : "n";
                $penilai = $this->request->getVar('penilai') == "yes" ? "y" : "n";
                $peserta = $this->request->getVar('peserta') == "yes" ? "y" : "n";
                $tipe_user = $superadmin . $admin . $penilai . $peserta;
                $filesigned = $this->request->getFile('filesigned');
                $confirmcapes = $this->request->getVar('confirmcapes');
                $confirmfair = $this->request->getVar('confirmfair');
                $tipe_peserta = $this->request->getVar('tipepeserta');

                $ext1 = $filesigned->getClientExtension();
                if (!empty($ext1)) {
                    $oldfile = base_url() . '/uploads/ttd/' . $signed;
                    if (is_file($oldfile)) {
                        unlink($oldfile);
                    }
                    $signedname = $nip . '_ttd.' . $ext1;
                    $filesigned->move('uploads/ttd/', $signedname, true);
                } else {
                    $signedname = $signed;
                }

                if (!empty($pass1)) {
                    $datauser = array(
                        'password' => password_hash($pass1, PASSWORD_DEFAULT),
                        'active' => $aktif,
                        'nodaftar' => $nodaftar,
                        'NPM' => $npm,
                        'NIP' => $nip,
                        'id_faip' => $id_faip,
                        'status' => $status,
                        'thnajaran' => $thnajaran,
                        'semester' => $semester,
                        'tipe_user' => $tipe_user,
                        'confirmcapes' => $confirmcapes,
                        'confirmfair' => $confirmfair,
                        'signed' => $signedname,
                        'tipe_peserta' => $tipe_peserta,
                        'date_modified' => date('Y-m-d H:i:s')
                    );
                } else {
                    $datauser = array(
                        'active' => $aktif,
                        'nodaftar' => $nodaftar,
                        'NPM' => $npm,
                        'NIP' => $nip,
                        'id_faip' => $id_faip,
                        'status' => $status,
                        'thnajaran' => $thnajaran,
                        'semester' => $semester,
                        'tipe_user' => $tipe_user,
                        'confirmcapes' => $confirmcapes,
                        'confirmfair' => $confirmfair,
                        'signed' => $signedname,
                        'tipe_peserta' => $tipe_peserta,
                        'date_modified' => date('Y-m-d H:i:s')
                    );
                }
                $model->update($user_id, $datauser);

                $session->setFlashdata('msg', 'Data user berhasil diubah.');

                return redirect()->to('/manuser');
            } else {
                $anggota = $model->where('user_id', $user_id)->first();
                if ($anggota) {
                    $data = [
                        'user_id' => $anggota['user_id'],
                        'username' => $anggota['username'],
                        'active' => $anggota['active'],
                        'nodaftar' => $anggota['nodaftar'],
                        'NPM' => $anggota['NPM'],
                        'NIP' => $anggota['NIP'],
                        'id_faip' => $anggota['id_faip'],
                        'status' => $anggota['status'],
                        'thnajaran' => $anggota['thnajaran'],
                        'semester' => $anggota['semester'],
                        'tipe_user' => $anggota['tipe_user'],
                        'confirmcapes' => $anggota['confirmcapes'],
                        'confirmfair' => $anggota['confirmfair'],
                        'tipe_peserta' => $anggota['tipe_peserta']
                    ];
                }
                $data['logged_in'] = $logged_in;
                $data['title_page'] = "Ubah Data Anggota";
                $data['data_bread'] = "Ubah Data Anggota";
                $data['user_id'] = $user_id;
                $data['validation'] = $this->validator;
                return view('maintemp/ubahanggota', $data);
            }
        }
    }
}
