<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class CapesSemModel extends Model{
    protected $table = 'tbl_makalahseminar';
    protected $primaryKey = 'Num';
    protected $allowedFields = ['Num', 'user_id', 'Type', 'PaperName', 'Name', 'Organizer', 'LocCity', 'LocProv', 'LocCountry', 'Year', 'Month', 'Level', 'DiffBenefit', 'Desc', 'File', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}