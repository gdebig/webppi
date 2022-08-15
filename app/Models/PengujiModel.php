<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class PengujiModel extends Model{
    protected $table = 'tbl_penguji';
    protected $primaryKey = 'uji_id';
    protected $allowedFields = ['uji_id', 'ta_id', 'user_id', 'penguji', 'nilai_dasar', 'ttd', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}