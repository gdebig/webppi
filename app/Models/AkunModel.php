<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class AkunModel extends Model{
    protected $table = 'tbl_user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_id', 'username', 'password', 'active', 'nodaftar', 'NPM', 'NIP', 'status', 'thnajaran', 'semester', 'tipe_user', 'confirmcapes', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}