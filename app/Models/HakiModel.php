<?php

namespace App\Models;

use CodeIgniter\Model;

class HakiModel extends Model
{
    protected $table = 'tbl_haki';
    protected $primaryKey = 'haki_id';
    protected $allowedFields = ['haki_id', 'dosen_id', 'semester', 'tahun', 'judul', 'jenis', 'nomorhaki', 'tanggalperoleh', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
