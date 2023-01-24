<?php

namespace App\Models;

use CodeIgniter\Model;

class PublikasiModel extends Model
{
    protected $table = 'tbl_publikasi';
    protected $primaryKey = 'pub_id';
    protected $allowedFields = ['pub_id', 'dosen_id', 'semester', 'tahun', 'judul', 'jenis', 'tanggalpublikasi', 'linkpublikasi', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
