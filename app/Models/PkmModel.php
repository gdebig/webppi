<?php

namespace App\Models;

use CodeIgniter\Model;

class PkmModel extends Model
{
    protected $table = 'tbl_pkm';
    protected $primaryKey = 'pkm_id';
    protected $allowedFields = ['pkm_id', 'dosen_id', 'semester', 'tahun', 'judul', 'sumberdana', 'waktupelaksanaan', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
