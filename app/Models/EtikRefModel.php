<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class EtikRefModel extends Model{
    protected $table = 'tbl_ethicref';
    protected $primaryKey = 'Num';
    protected $allowedFields = ['Num', 'user_id', 'Name', 'Institute', 'Addr', 'City', 'Prov', 'Country', 'Pnum', 'Email', 'Relation', 'kompetensi', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}