<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class CapesPendModel extends Model{
    protected $table = 'tbl_pendidikan';
    protected $primaryKey = 'Num';
    protected $allowedFields = ['Num', 'user_id', 'Rank', 'Name', 'Faculty', 'Major', 'City', 'Province', 'Country', 'GradYear', 'Degree', 'Title', 'Desc', 'Mark', 'Judicium', 'File', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}