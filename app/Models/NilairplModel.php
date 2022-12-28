<?php

namespace App\Models;

use CodeIgniter\Model;

class NilairplModel extends Model
{
    protected $table = 'tbl_nilaimkrpl';
    protected $primaryKey = 'nilairpl_id';
    protected $allowedFields = ['nilairpl_id', 'mhs_id', 'dosen_id', 'tipedosen', 'id_tbl', 'namatbl', 'namamk', 'nilaip', 'nilaiq', 'nilair', 'nilairpl_save', 'nilairpl_submit', 'nilairpl_confirm', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';

    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}
