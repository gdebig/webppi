<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class KompModel extends Model{
    protected $table = 'tbl_kompetensi';
    protected $primaryKey = 'komp_id';
    protected $allowedFields = ['komp_id', 'komp_code', 'komp_desc', 'komp_cat', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}