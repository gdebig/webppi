<?php

namespace App\Models;

use CodeIgniter\Model;

class KpregModel extends Model
{
    protected $table = 'tbl_kpreg';
    protected $primaryKey = 'kpreg_id';
    protected $allowedFields = ['kpreg_id', 'mhs_id', 'judul_kp', 'nilai_kpindustri', 'kp_laporan', 'link_video', 'lembar_pengesahan', 'lembar_persetujuan', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
