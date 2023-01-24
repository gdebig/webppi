<?php

namespace App\Models;

use CodeIgniter\Model;

class RisetModel extends Model
{
    protected $table = 'tbl_risetpengmas';
    protected $primaryKey = 'riset_id';
    protected $allowedFields = ['riset_id', 'dosen_id', 'semester', 'tahun', 'judul', 'tipe', 'asal_dana', 'namahibah', 'tanggalawal', 'tanggalakhir', 'jumlahdana', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
