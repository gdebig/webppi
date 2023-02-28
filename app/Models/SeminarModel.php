<?php

namespace App\Models;

use CodeIgniter\Model;

class SeminarModel extends Model
{
    protected $table = 'tbl_semreg';
    protected $primaryKey = 'sem_id';
    protected $allowedFields = ['sem_id', 'mhs_id', 'sem_tahun', 'sem_term', 'sem_judul', 'sem_bukti', 'sem_nilai', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
