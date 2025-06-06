<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'tbl_user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_id', 'username', 'password', 'active', 'nodaftar', 'NPM', 'NIP', 'id_faip', 'status', 'thnajaran', 'semester', 'tipe_user', 'confirmcapes', 'confirmfair', 'confirm_faip', 'softdelete', 'signed', 'tipe_peserta', 'ajukanfair', 'sudahajukan', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
