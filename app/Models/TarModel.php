<?php

namespace App\Models;

use CodeIgniter\Model;

class TarModel extends Model
{
    protected $table = 'tbl_tugasakhirreg';
    protected $primaryKey = 'tar_id';
    protected $allowedFields = ['tar_id', 'user_id', 'tar_usuljudul', 'tar_semester', 'tar_tahun', 'startdate', 'enddate', 'instansi', 'divisi', 'tar_buku', 'tar_log', 'tar_linkvideo', 'tar_bukurevisi', 'tar_penguji', 'tar_confirm', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
