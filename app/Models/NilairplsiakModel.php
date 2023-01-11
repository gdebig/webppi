<?php

namespace App\Models;

use CodeIgniter\Model;

class NilairplsiakModel extends Model
{
    protected $table = 'tbl_nilairplsiak';
    protected $primaryKey = 'nilaisiak_id';
    protected $allowedFields = ['nilaisiak_id', 'mhs_id', 'tahun', 'semester', 'kodeetik', 'profesi', 'k3lh', 'studikasus', 'seminar', 'proyekkeinsinyuran', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
