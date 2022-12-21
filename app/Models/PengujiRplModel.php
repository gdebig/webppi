<?php

namespace App\Models;

use CodeIgniter\Model;

class PengujiRplModel extends Model
{
    protected $table = 'tbl_pengujirpl';
    protected $primaryKey = 'uji_id';
    protected $allowedFields = ['ujirpl_id', 'dosenrpl_id', 'mhsrpl_id', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
