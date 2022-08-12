<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class MengajarModel extends Model{
    protected $table = 'tbl_pengalaman';
    protected $primaryKey = 'Num';
    protected $allowedFields = ['Num', 'user_id', 'Institution', 'Name', 'LocCity', 'LocProv', 'LocCountry', 'Period', 'StartPeriod', 'EndPeriod', 'Position', 'Skshour', 'Desc', 'File', 'kompetensi', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}