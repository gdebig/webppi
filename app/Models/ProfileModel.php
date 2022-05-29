<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class ProfileModel extends Model{
    protected $table = 'tbl_profile';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['ID', 'user_id', 'FullName', 'BirthPlace', 'Birthdate', 'KTA', 'SIP', 'Vocational', 'HAddr', 'HCity', 'HPostnum', 'Work', 'Position', 'WAddr', 'WCity', 'Wpostnum', 'Hnum', 'Hfaks', 'Htelex', 'Hemail', 'Hpnum', 'Wnum', 'Wfaks', 'Wtelex', 'Wemail1', 'Wemail2', 'Photo', 'date_created', 'date_modified'];
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    
    protected $useTimestamps = false;
    protected $createdField  = 'date_created';
    protected $updatedField  = 'data_modified';
}