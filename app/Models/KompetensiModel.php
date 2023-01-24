<?php

namespace App\Models;

use CodeIgniter\Model;

class KompetensiModel extends Model
{
    protected $table = 'tbl_kompetensidosen';
    protected $primaryKey = 'kompetensi_id';
    protected $allowedFields = ['kompetensi_id', 'dosen_id', 'semester', 'tahun', 'posisi', 'namabadan', 'mewakili', 'saksiahli', 'waktupelaksanaan', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
