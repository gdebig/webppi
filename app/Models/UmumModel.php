<?php

namespace App\Models;

use CodeIgniter\Model;

class UmumModel extends Model
{
    protected $table = 'tbl_umum';
    protected $primaryKey = 'umum_id';
    protected $allowedFields = ['umum_name', 'umum_desc', 'umum_file', 'umum_tujuan', 'umum_softdelete', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
