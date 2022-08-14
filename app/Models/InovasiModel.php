<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class InovasiModel extends Model{
    protected $table = 'tbl_inovasi';
    protected $primaryKey = 'Num';
    protected $allowedFields = ['Num', 'user_id', 'Name', 'Year', 'Month', 'Publication', 'PubLevel', 'DiffBenefit', 'Desc', 'File', 'kompetensi', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}