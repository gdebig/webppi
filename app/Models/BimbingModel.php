<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class BimbingModel extends Model{
    protected $table = 'tbl_bimbing';
    protected $primaryKey = 'bimbing_id';
    protected $allowedFields = ['bimbing_id', 'mhs_id', 'dosen_id', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}