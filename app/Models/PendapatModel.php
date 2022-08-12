<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class PendapatModel extends Model{
    protected $table = 'tbl_pendapat';
    protected $primaryKey = 'Num';
    protected $allowedFields = ['Num', 'user_id', 'Desc', 'kompetensi', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}